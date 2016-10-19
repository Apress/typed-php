<?php

namespace TypedPHP\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class PathPlugin implements PluginInterface
{
    /**
     * @param Composer    $composer
     * @param IOInterface $io
     *
     * @return void
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $installer = new PathPluginInstaller($io, $composer);

        $composer
            ->getInstallationManager()
            ->addInstaller($installer);
    }

}
