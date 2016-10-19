<?php

namespace TypedPHP\Composer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;
use Composer\Repository\InstalledRepositoryInterface;

class HookPluginInstaller extends LibraryInstaller
{
    /**
     * @param InstalledRepositoryInterface $repository
     * @param PackageInterface             $package
     *
     * @return array
     */
    public function install(InstalledRepositoryInterface $repository, PackageInterface $package)
    {
        $hooks = [];
        $extra = $package->getExtra();

        if (isset($extra["hooks"])) {
            $hooks = $extra["hooks"];
        }

        foreach ($hooks as $hook) {
            $this->addHook($hook);
        }

        parent::install($repository, $package);
    }

    /**
     * @param array $hook
     *
     * @return void
     */
    protected function addHook(array $hook)
    {
        if (empty($hook["key"])) {
            return;
        }

        if (empty($hook["classes"])) {
            return;
        }

        if (empty($hook["file"]) or !file_exists($hook["file"])) {
            return;
        }

        $this->addHookToFile(
            $hook["key"],
            $hook["classes"],
            $hook["file"]
        );
    }

    /**
     * @param string $key
     * @param array  $classes
     * @param string $file
     *
     * @return void
     */
    protected function addHookToFile($key, array $classes, $file)
    {
        $data     = include($file);
        $source   = file_get_contents($file);
        $previous = $this->getArrayValueByKey($data, $key);

        if (empty($previous)) {
            return;
        }

        $index    = $this->getInsertionIndex($previous, $source);
        $append   = $this->addClasses($classes, $previous);
        $modified = "";

        if (count($append)) {
            $modified .= substr($source, 0, $index);

            if ($modified[strlen($modified) - 1] == ",") {
                $modified .= "\n";
            } else {
                $modified .= ",\n";
            }

            $new = "";

            foreach ($append as $key => $value) {
                if (is_string($key)) {
                    $new .= "'{$key}' => {$value},\n";
                } else {
                    $new .= "{$value},\n";
                }
            }

            $modified .= trim($new);
            $modified .= substr($source, $index);

            file_put_contents($file, $modified);
        }
    }

    /**
     * @param array  $array
     * @param string $key
     *
     * @return array
     */
    public function getArrayValueByKey(array $array, $key)
    {
        if (isset($array[$key])) {
            return $array[$key];
        }

        foreach (explode(".", $key) as $segment) {
            if (!array_key_exists($segment, $array)) {
                return null;
            }

            $array = $array[$segment];
        }

        return $array;
    }

    /**
     * @param array  $items
     * @param string $source
     *
     * @return int
     */
    protected function getInsertionIndex(array $items, $source)
    {
        $last   = end($items);
        $single = strpos($source, $last);
        $double = strpos($source, str_replace("\\", "\\\\", $last));

        if (is_numeric($single)) {
            $index = strpos($source, "\n", $single);
        }

        if (is_numeric($double)) {
            $index = strpos($source, "\n", $double);
        }

        if ($index) {
            return $index;
        }

        return -1;
    }

    /**
     * @param array $classes
     * @param array $previous
     *
     * @return array
     */
    protected function addClasses(array $classes, array $previous)
    {
        $append = [];

        foreach ($classes as $key => $value) {
            if (is_string($key)) {
                if (!isset($previous[$key])) {
                    $append[$key] = "'{$value}'";
                }
            } else {
                if (!in_array($value, $previous)) {
                    $append[] = "'{$value}'";
                }
            }
        }

        return $append;
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
