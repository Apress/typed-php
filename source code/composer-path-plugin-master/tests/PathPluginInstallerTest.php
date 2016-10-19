<?php

namespace TypedPHP\Composer\Tests;

use Composer\Composer;
use Composer\Package\PackageInterface;
use Mockery;
use TypedPHP\Composer\PathPluginInstaller;

class PathPluginInstallerTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function installerReturnsPackageBasePath()
    {
        $root = $this->getNewPackageMock();

        $composer = $this->getNewComposerMock();
        $composer->shouldReceive("getPackage")->andReturn($root);

        $package = $this->getNewPackageMock();
        $package->shouldReceive("getName")->andReturn("bar/baz");

        $installer           = $this->getNewInstallerMock();
        $installer->composer = $composer;

        $installer->shouldReceive("getRootPath")->once();
        $installer->shouldReceive("getPackagePath")->once();

        $this->assertEquals("mocked parent method", $installer->getPackageBasePath($package));

        $installer->shouldReceive("getRootPath")->once();
        $installer->shouldReceive("getPackagePath")->once()->andReturn("foo");

        $this->assertEquals("foo/bar/baz", $installer->getPackageBasePath($package));

        $installer->shouldReceive("getRootPath")->once()->andReturn("bar");

        $this->assertEquals("bar/bar/baz", $installer->getPackageBasePath($package));
    }

    /**
     * @test
     *
     * @return void
     */
    public function installerReturnsRootPathWhenSet()
    {
        $root = $this->getNewPackageMock();
        $root->shouldReceive("getExtra")->once();

        $package = $this->getNewPackageMock();
        $package->shouldReceive("getName")->andReturn("foo/bar");

        $installer = new PathPluginInstaller();
        $this->assertNull($installer->getRootPath($root, $package));

        $root->shouldReceive("getExtra")->once()->andReturn(["paths" => ["foo/bar" => "baz"]]);
        $this->assertEquals("baz", $installer->getRootPath($root, $package));
    }

    /**
     * @test
     *
     * @return void
     */
    public function installerMatchesStringsWithPatterns()
    {
        $installer = new PathPluginInstaller();

        $this->assertTrue($installer->matches("foo/bar", "foo/bar"));
        $this->assertFalse($installer->matches("bar/baz", "foo/*"));
        $this->assertTrue($installer->matches("foo/baz", "foo/*"));
        $this->assertFalse($installer->matches("foo/bar", "*/baz"));
        $this->assertTrue($installer->matches("foo/baz", "*/baz"));
    }

    /**
     * @test
     *
     * @return void
     */
    public function installerReturnsPackagePathIfSet()
    {
        $installer = new PathPluginInstaller();

        $package = $this->getNewPackageMock();

        $package->shouldReceive("getExtra")->once();
        $this->assertNull($installer->getPackagePath($package));

        $package->shouldReceive("getExtra")->once()->andReturn(["path" => "foo"]);
        $this->assertEquals("foo", $installer->getPackagePath($package));
    }

    /**
     * @return PackageInterface
     */
    protected function getNewPackageMock()
    {
        return Mockery::mock(PackageInterface::class);
    }

    /**
     * @test
     *
     * @return void
     */
    public function installerSupportsAllTypes()
    {
        $installer = new PathPluginInstaller();

        $this->assertTrue($installer->supports("foo"));
    }

    /**
     * @return Composer
     */
    protected function getNewComposerMock()
    {
        return Mockery::mock(Composer::class);
    }

    /**
     * @return PathPluginInstaller
     */
    protected function getNewInstallerMock()
    {
        return Mockery::mock(PathPluginInstaller::class)->makePartial();
    }
}
