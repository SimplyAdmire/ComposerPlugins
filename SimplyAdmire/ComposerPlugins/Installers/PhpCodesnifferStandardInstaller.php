<?php
namespace SimplyAdmire\ComposerPlugins\Installers;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class PhpCodesnifferStandardInstaller extends LibraryInstaller {

	public function getPackageBasePath(PackageInterface $package) {
		$targetPathParts = explode('/', parent::getPackageBasePath($package));
		$targetPathParts = array_splice($targetPathParts, 0, -2);
		$targetPath = '/' . implode('/', $targetPathParts) . '/squizlabs/php_codesniffer/CodeSniffer/Standards/';

		$packageKeyParts = explode('/', $package->getPrettyName(), 2);

		$codeStandardName = str_replace('typo3', 'TYPO3', ucfirst($packageKeyParts[1]));
		$codeStandardName = preg_replace_callback('/-([a-z]{1})/', function($matches) { return strtoupper($matches[1]); }, $codeStandardName);

		// Fixed mapping for TYPO3 codesniffers
		$codeStandardName = str_replace('TYPO3sniffpool', 'TYPO3SniffPool', $codeStandardName);
		$codeStandardName = str_replace('TYPO3cms', 'TYPO3CMS', $codeStandardName);
		$codeStandardName = str_replace('TYPO3flow', 'TYPO3Flow', $codeStandardName);

		return $targetPath . $codeStandardName;
	}

	/**
	 * @param string $packageType
	 * @return boolean
	 */
	public function supports($packageType) {
		return $packageType === 'phpcodesniffer-standard';
	}

}

?>