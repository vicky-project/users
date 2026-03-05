<?php
namespace Modules\Users\Generators;

use Exception;

class TraitInserter
{
	/**
	 * Menyisipkan trait ke dalam class PHP
	 *
	 * @param string $traitName Nama trait (dengan namespace lengkap)
	 * @param string|null $traitAlias Alias untuk trait (opsional)
	 * @param string|null $filePath Path ke file PHP target
	 * @return array Hasil operasi
	 */
	public static function insertTrait(
		string $traitName,
		?string $traitAlias = null,
		?string $filePath = null,
	): array {
		try {
			if ($filePath === null) {
				$filePath = base_path("app/Models/User.php");
			}

			if (!file_exists($filePath)) {
				throw new Exception("File tidak ditemukan di: $filePath");
			}

			$content = file_get_contents($filePath);
			$parser = new ClassParser($content);

			if (!$parser->getClassName()) {
				throw new Exception(
					"File tidak mengandung deklarasi class yang valid.",
				);
			}

			if ($parser->hasTrait($traitName)) {
				return [
					"success" => false,
					"message" => "Trait '$traitName' sudah ada dalam class.",
					"file" => $filePath,
				];
			}

			// Tambahkan use statement namespace jika perlu
			$content = self::addNamespaceUse(
				$content,
				$traitName,
				$traitAlias,
				$parser,
			);

			// Tambahkan trait ke dalam class
			$content = self::addTraitToClass(
				$content,
				$traitName,
				$traitAlias,
				$parser,
			);

			if (file_put_contents($filePath, $content) === false) {
				throw new Exception("Gagal menyimpan file: $filePath");
			}

			$backupPath = self::createBackup($filePath);

			return [
				"success" => true,
				"message" => "Trait '$traitName' berhasil ditambahkan ke class.",
				"file" => $filePath,
				"backup" => $backupPath,
			];
		} catch (Exception $e) {
			return [
				"success" => false,
				"message" => $e->getMessage(),
				"file" => $filePath ?? "unknown",
			];
		}
	}

	/**
	 * Rollback perubahan dari file backup
	 *
	 * @param string $backupPath Path file backup
	 * @return array Hasil operasi
	 */
	public static function rollback(string $backupPath): array
	{
		try {
			if (!file_exists($backupPath)) {
				throw new Exception("File backup tidak ditemukan: $backupPath");
			}

			$originalPath = preg_replace('/\.backup\.\d{8}_\d{6}$/', "", $backupPath);
			if (!file_exists($originalPath)) {
				throw new Exception("File asli tidak ditemukan: $originalPath");
			}

			if (!copy($backupPath, $originalPath)) {
				throw new Exception("Gagal mengembalikan file dari backup.");
			}

			return [
				"success" => true,
				"message" => "File berhasil dikembalikan dari backup.",
				"file" => $originalPath,
				"backup" => $backupPath,
			];
		} catch (Exception $e) {
			return [
				"success" => false,
				"message" => $e->getMessage(),
				"backup" => $backupPath,
			];
		}
	}

	/**
	 * Menambahkan use statement di namespace
	 */
	private static function addNamespaceUse(
		string $content,
		string $traitName,
		?string $alias,
		ClassParser $parser,
	): string {
		if ($parser->hasNamespaceUse($traitName)) {
			return $content;
		}

		$traitShortName = self::extractShortName($traitName);
		if ($alias && $alias === $traitShortName) {
			$traitName = $traitShortName;
		}

		$useStatement = "use $traitName" . ($alias ? " as $alias" : "") . ";\n";

		$lines = explode("\n", $content);
		$newLines = [];
		$inserted = false;
		$afterNamespace = false;

		foreach ($lines as $line) {
			$newLines[] = $line;

			if (!$inserted && strpos(trim($line), "namespace ") === 0) {
				$afterNamespace = true;
			}

			if ($afterNamespace && !$inserted) {
				$trimmedLine = trim($line);
				if (
					empty($trimmedLine) ||
					(strpos($trimmedLine, "use ") !== 0 &&
						strpos($trimmedLine, "class ") === 0)
				) {
					array_splice($newLines, -1, 0, $useStatement);
					$inserted = true;
				}
			}
		}

		if (!$inserted) {
			$classPattern = "class " . $parser->getClassName();
			foreach ($newLines as $index => $line) {
				if (strpos(trim($line), $classPattern) === 0) {
					array_splice($newLines, $index, 0, $useStatement);
					$inserted = true;
					break;
				}
			}
		}

		return implode("\n", $newLines);
	}

	/**
	 * Menambahkan trait ke dalam body class
	 */
	private static function addTraitToClass(
		string $content,
		string $traitName,
		?string $alias,
		ClassParser $parser,
	): string {
		$traitToUse = $alias ?: self::extractShortName($traitName);
		$className = $parser->getClassName();
		$classPattern = "class $className";

		$lines = explode("\n", $content);
		$newLines = [];
		$classFound = false;
		$traitLineFound = false;
		$inserted = false;

		foreach ($lines as $i => $line) {
			$newLines[] = $line;

			if (!$classFound && strpos(trim($line), $classPattern) === 0) {
				$classFound = true;
				continue;
			}

			if ($classFound && !$inserted) {
				$trimmedLine = trim($line);

				if (
					strpos($trimmedLine, "use ") === 0 &&
					strpos($trimmedLine, ";") !== false
				) {
					$traitLineFound = true;
					$nextLine = isset($lines[$i + 1]) ? trim($lines[$i + 1]) : "";

					if (strpos($nextLine, "use ") !== 0) {
						$line = rtrim($line, ";");
						$line .=
							substr($line, -1) === "," ? " $traitToUse;" : ", $traitToUse;";
						$newLines[count($newLines) - 1] = $line;
						$inserted = true;
					}
				} elseif (
					$traitLineFound &&
					!$inserted &&
					(strpos($trimmedLine, 'protected $') === 0 ||
						strpos($trimmedLine, 'public $') === 0 ||
						strpos($trimmedLine, 'private $') === 0 ||
						strpos($trimmedLine, "function ") === 0 ||
						strpos($trimmedLine, "/**") === 0)
				) {
					array_splice($newLines, -1, 0, "    use $traitToUse;\n");
					$inserted = true;
				}
			}
		}

		if (!$inserted && $classFound) {
			foreach ($newLines as $index => $line) {
				if (strpos(trim($line), $classPattern) === 0) {
					for ($j = $index; $j < count($newLines); $j++) {
						if (strpos($newLines[$j], "{") !== false) {
							array_splice($newLines, $j + 1, 0, "\n    use $traitToUse;");
							$inserted = true;
							break;
						}
					}
					break;
				}
			}
		}

		return implode("\n", $newLines);
	}

	private static function extractShortName(string $fqcn): string
	{
		$parts = explode("\\", $fqcn);
		return end($parts);
	}

	private static function createBackup(string $filePath): string
	{
		$backupPath = $filePath . ".backup." . date("Ymd_His");
		return copy($filePath, $backupPath) ? $backupPath : "";
	}
}
