<?php
namespace Modules\Users\Services;

use Modules\Users\Interfaces\SocialProvider;

class SocialProviderManager
{
	protected array $providers = [];

	/**
	 * Daftarkan provider
	 */
	public function register(SocialProvider $provider): void
	{
		$this->providers[$provider->getName()] = $provider;
	}

	/**
	 * Ambil semua provider yang terdaftar
	 */
	public function getProviders(): array
	{
		return $this->providers;
	}

	/**
	 * Ambil provider berdasarkan nama
	 */
	public function getProvider(string $name): ?SocialProvider
	{
		return $this->providers[$name] ?? null;
	}
}
