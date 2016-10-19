<?php

namespace TypedPHP\Composer\Tests;

use Composer\Composer;
use Composer\IO\IOInterface;
use Mockery;
use TypedPHP\Composer\PathPlugin;
use TypedPHP\Composer\PathPluginInstaller;

class PathPluginTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function pluginActivatesInstaller()
    {
        $composer = $this->getNewComposerMock();

        $composer
            ->shouldReceive("getInstallationManager")
            ->atLeast()->once()
            ->andReturn($composer);

        $composer
            ->shouldReceive("addInstaller")
            ->atLeast()->once()
            ->with(
                Mockery::type(PathPluginInstaller::class)
            );

        $plugin = new PathPlugin();

        $plugin->activate(
            $composer,
            $this->getNewInterfaceMock()
        );
    }

    /**
     * @return Composer
     */
    protected function getNewComposerMock()
    {
        return Mockery::mock(Composer::class);
    }

    /**
     * @return IOInterface
     */
    protected function getNewInterfaceMock()
    {
        return Mockery::mock(IOInterface::class);
    }
}
