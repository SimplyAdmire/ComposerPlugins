<?php
namespace SimplyAdmire\ComposerPlugins\Installers;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class PhpCodesnifferStandardInstaller extends LibraryInstaller {

	protected function getPackageBasePath(PackageInterface $package) {
		$this->initializeVendorDir();

		$targetPath = ($this->vendorDir ? $this->vendorDir.'/' : '');

		$codeSnifferStandardsPathParts = array('squizlabs', 'php_codesniffer', 'CodeSniffer', 'Standards');
		$targetPath .= implode(DIRECTORY_SEPARATOR, $codeSnifferStandardsPathParts) . DIRECTORY_SEPARATOR;

		$packageKeyParts = explode('/', $package->getPrettyName(), 2);

		$codeStandardName = str_replace('Typo3', 'TYPO3', ucfirst($packageKeyParts[1]));
		$codeStandardName = preg_replace_callback('/-([a-z]{1})/', function($matches) { return strtoupper($matches[1]); }, $codeStandardName);

		// Fixed mapping for TYPO3 codesniffers
		$codeStandardName = str_replace('TYPO3sniffpool', 'TYPO3SniffPool', $codeStandardName);
		$codeStandardName = str_replace('TYPO3cms', 'TYPO3CMS', $codeStandardName);
		$codeStandardName = str_replace('TYPO3flow', 'TYPO3Flow', $codeStandardName);
		
		// Fixed mapping for PrestaShop coding standard
		$codeStandardName = str_replace('PrestashopCodingstandard', 'Prestashop', $codeStandardName);
		
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
