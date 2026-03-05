<?php
namespace Modules\Users\Generators;

class ClassParser
{
	private $content;
	private $tokens;
	private $namespace;
	private $className;

	public function __construct(string $content)
	{
		$this->content = $content;
		$this->tokens = token_get_all($content);
		$this->parseClassInfo();
	}

	/**
	 * Parse namespace dan nama class dari token
	 */
	private function parseClassInfo()
	{
		$namespace = "";
		$className = "";
		$count = count($this->tokens);
		$i = 0;

		while ($i < $count) {
			$token = $this->tokens[$i];
			if (is_array($token)) {
				if ($token[0] === T_NAMESPACE) {
					$i += 2;
					$namespaceParts = [];
					while (
						$i < $count &&
						is_array($this->tokens[$i]) &&
						($this->tokens[$i][0] === T_STRING ||
							$this->tokens[$i][0] === T_NS_SEPARATOR)
					) {
						$namespaceParts[] = $this->tokens[$i][1];
						$i++;
					}
					$namespace = implode("", $namespaceParts);
				} elseif ($token[0] === T_CLASS) {
					$i += 2;
					if (
						$i < $count &&
						is_array($this->tokens[$i]) &&
						$this->tokens[$i][0] === T_STRING
					) {
						$className = $this->tokens[$i][1];
						break;
					}
				}
			}
			$i++;
		}

		$this->namespace = $namespace;
		$this->className = $className;
	}

	public function getNamespace(): ?string
	{
		return $this->namespace;
	}

	public function getClassName(): ?string
	{
		return $this->className;
	}

	/**
	 * Cek apakah trait sudah digunakan di dalam class (use trait)
	 */
	public function hasTrait(string $traitName): bool
	{
		$shortName = $this->extractShortName($traitName);
		$pattern = "/use\s+([\\\\\\w]+)?{$shortName}[,\\s;]/";
		return preg_match($pattern, $this->content) > 0;
	}

	/**
	 * Cek apakah use statement sudah ada di level namespace
	 */
	public function hasNamespaceUse(string $traitName): bool
	{
		$pattern =
			"/^use\\s+" . preg_quote($traitName, "/") . "(\\s+as\\s+\\w+)?\\s*;/m";
		return preg_match($pattern, $this->content) > 0;
	}

	/**
	 * Dapatkan semua trait yang digunakan di dalam class
	 */
	public function getUsedTraits(): array
	{
		$traits = [];
		$lines = explode("\n", $this->content);
		$inClass = false;

		foreach ($lines as $line) {
			$trimmed = trim($line);

			if (strpos($trimmed, "class {$this->className}") === 0) {
				$inClass = true;
				continue;
			}

			if (
				$inClass &&
				strpos($trimmed, "use ") === 0 &&
				strpos($trimmed, ";") !== false
			) {
				$traitLine = trim(substr($trimmed, 3, -1));
				$traitNames = array_map("trim", explode(",", $traitLine));
				$traits = array_merge($traits, $traitNames);
			}

			// Hentikan jika bertemu properti/metode pertama
			if (
				$inClass &&
				(strpos($trimmed, 'protected $') === 0 ||
					strpos($trimmed, 'public $') === 0 ||
					strpos($trimmed, 'private $') === 0 ||
					strpos($trimmed, "function ") === 0 ||
					strpos($trimmed, "/**") === 0)
			) {
				break;
			}
		}

		return $traits;
	}

	private function extractShortName(string $fqcn): string
	{
		$parts = explode("\\", $fqcn);
		return end($parts);
	}
}
