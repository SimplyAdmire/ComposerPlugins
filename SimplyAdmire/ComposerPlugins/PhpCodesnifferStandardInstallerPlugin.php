<?php
namespace SimplyAdmire\ComposerPlugins;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use SimplyAdmire\ComposerPlugins\Installers\PhpCodesnifferStandardInstaller;

class PhpCodesnifferStandardInstallerPlugin implements PluginInterface {

	/**
	 * @param Composer $composer
	 * @param IOInterface $io
	 * @return void
	 */
	public function activate(Composer $composer, IOInterface $io) {
		$installer = new PhpCodesnifferStandardInstaller($io, $composer);
		$composer->getInstallationManager()->addInstaller($installer);
	}
}
