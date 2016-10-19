<?php

namespace TypedPHP\Functions\ArrayFunctions;

use TypedPHP\Functions\NumberFunctions;

/**
 * @param array $haystack
 * @param mixed $needle
 *
 * @return bool
 */
function contains(array $haystack, $needle)
{
    return in_array($needle, $haystack);
}

/**
 * @param array    $array
 * @param callable $callback
 *
 * @return array
 */
function each(array $array, callable $callback)
{
    array_walk($array, $callback);

    return $array;
}

/**
 * @param array $array
 * @param array $exclude
 *
 * @return array
 */
function exclude(array $array, array $exclude)
{
    return array_diff($array, $exclude);
}

/**
 * @param array    $array
 * @param callable $callback
 *
 * @return array
 */
function filter(array $array, callable $callback)
{
    return array_filter($array, $callback);
}

/**
 * @param array $array
 *
 * @return int
 */
function length(array $array)
{
    return count($array);
}

/**
 * @param array $array
 * @param mixed $needle
 *
 * @return bool
 */
function has(array $array, $needle)
{
    return array_key_exists($needle, $array);
}

/**
 * @param array  $array
 * @param string $glue
 *
 * @return string
 */
function join(array $array, $glue)
{
    return \join($glue, $array);
}

/**
 * @param array    $array
 * @param callable $callback
 *
 * @return array
 */
function map(array $array, callable $callback)
{
    return array_map($callback, $array);
}

/**
 * @param array $array
 * @param array $merge
 *
 * @return array
 */
function merge(array $array, array $merge)
{
    return array_merge($array, $merge);
}

/**
 * @param array $array
 * @param int   $offset
 * @param int   $limit
 *
 * @return array
 */
function slice(array $array, $offset = 0, $limit = 0)
{
    if ($limit == 0) {
        return array_slice($array, $offset);
    }

    return array_slice($array, $offset, $limit);
}

/**
 * @param array $array
 *
 * @return mixed
 */
function random(array $array)
{
    if (length($array) === 0) {
        return null;
    }

    $index = NumberFunctions\random(0, length($array) - 1);

    return $array[$index];
}
