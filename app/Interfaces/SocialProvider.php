<?php
namespace Modules\Users\Interfaces;

interface SocialProvider
{
	/**
	 * Nama unik provider (misal: 'google', 'github')
	 */
	public function getName(): string;

	/**
	 * Label yang ditampilkan (misal: 'Google')
	 */
	public function getLabel(): string;

	/**
	 * Class icon Bootstrap Icons (misal: 'bi bi-google')
	 */
	public function getIcon(): string;

	/**
	 * Route atau URL untuk memulai autentikasi
	 */
	public function getLoginUrl(): string;
}
