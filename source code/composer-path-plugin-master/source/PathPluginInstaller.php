<?php

namespace TypedPHP\Composer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class PathPluginInstaller extends LibraryInstaller
{
    /**
     * @param PackageInterface $package
     *
     * @return string
     */
    public function getPackageBasePath(PackageInterface $package)
    {
        $root = $this->composer->getPackage();

        if ($rootPath = $this->getRootPath($root, $package)) {
            return $rootPath . "/" . $package->getName();
        }

        if ($packagePath = $this->getPackagePath($package)) {
            return $packagePath . "/" . $package->getName();
        }

        return parent::getPackageBasePath($package);
    }

    /**
     * @param PackageInterface $root
     * @param PackageInterface $package
     *
     * @return mixed
     */
    public function getRootPath(PackageInterface $root, PackageInterface $package)
    {
        $extra = $root->getExtra();
        $name  = $package->getName();

        if (isset($extra["paths"]) and is_array($extra["paths"])) {
            foreach ($extra["paths"] as $pattern => $path) {
                if ($this->matches($name, $pattern)) {
                    return $path;
                }
            }
        }

        return null;
    }

    /**
     * @param string $string
     * @param string $pattern
     *
     * @return bool
     */
    public function matches($string, $pattern)
    {
        if ($pattern == $string) {
            return true;
        }

        $pattern = preg_quote($pattern, "#");
        $pattern = str_replace("\\*", ".*", $pattern);
        $pattern = "#^" . $pattern . "$#";

        return (boolean) preg_match($pattern, $string);
    }

    /**
     * @param PackageInterface $package
     *
     * @return mixed
     */
    public function getPackagePath(PackageInterface $package)
    {
        $extra = $package->getExtra();

        if (isset($extra["path"])) {
            return $extra["path"];
        }

        return null;
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    public function supports($type)
    {
        return true;
    }
}
