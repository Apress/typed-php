<?php

namespace TypedPHP\Functions\StringFunctions;

use TypedPHP\Functions\TypeFunctions;

/**
 * @param mixed $variable
 *
 * @return bool
 */
function isExpression($variable)
{
    return TypeFunctions\isExpression($variable);
}

/**
 * @param mixed $variable
 *
 * @return bool
 */
function isArray($variable)
{
    return TypeFunctions\isArray($variable);
}

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return bool
 */
function startsWith($haystack, $needle)
{
    if (isExpression($needle)) {
        return startsWithExpression($haystack, $needle);
    }

    return startsWithString($haystack, $needle);
}

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return bool
 */
function startsWithString($haystack, $needle)
{
    return slice($haystack, 0, length($needle)) === $needle;
}

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return bool
 */
function startsWithExpression($haystack, $needle)
{
    $pattern = slice($needle, 1, length($needle) - 2);

    return matches($haystack, "#^{$pattern}#");
}

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return bool
 */
function endsWith($haystack, $needle)
{
    if (isExpression($needle)) {
        return endsWithExpression($haystack, $needle);
    }

    return endsWithString($haystack, $needle);
}

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return bool
 */
function endsWithString($haystack, $needle)
{
    return slice($haystack, -1 * length($needle)) === $needle;
}

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return bool
 */
function endsWithExpression($haystack, $needle)
{
    $pattern = slice($needle, 1, length($needle) - 2);

    return matches($haystack, "#{$pattern}$#");
}

/**
 * @param string $haystack
 * @param string $needle
 * @param int    $offset
 *
 * @return int
 */
function indexOf($haystack, $needle, $offset = 0)
{
    if (isExpression($needle)) {
        return indexOfExpression($haystack, $needle, $offset);
    }

    return indexOfString($haystack, $needle, $offset);
}

/**
 * @param string $haystack
 * @param string $needle
 * @param int    $offset
 *
 * @return int
 */
function indexOfString($haystack, $needle, $offset = 0)
{
    $index = -1;
    $match = strpos($haystack, $needle, $offset);

    if ($match !== false) {
        $index = $match;
    }

    return $index;
}

/**
 * @param string $haystack
 * @param string $needle
 * @param int    $offset
 *
 * @return int
 */
function indexOfExpression($haystack, $needle, $offset = 0)
{
    $index = -1;

    $match = preg_match(
        $needle, $haystack, $matches,
        PREG_OFFSET_CAPTURE, $offset
    );

    if ($match) {
        $index = $matches[0][1];
    }

    return $index;
}

/**
 * @param string $string
 *
 * @return int
 */
function length($string)
{
    return strlen($string);
}

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return bool
 */
function matches($haystack, $needle)
{
    if (isExpression($needle)) {
        return matchesExpression($haystack, $needle);
    }

    return matchesString($haystack, $needle);
}

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return bool
 */
function matchesString($haystack, $needle)
{
    if ($needle === $haystack) {
        return true;
    }

    return false;
}

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return bool
 */
function matchesExpression($haystack, $needle)
{
    if (preg_match($needle, $haystack)) {
        return true;
    }

    return false;
}

/**
 * @param string       $haystack
 * @param string|array $needle
 * @param string|array $replacement
 *
 * @return string
 */
function replace($haystack, $needle, $replacement)
{
    if (isArray($needle) and isArray($replacement)) {
        return replaceWithArray(
            $haystack, $needle, $replacement
        );
    }

    if (isExpression($needle)) {
        return replaceWithExpression(
            $haystack, $needle, $replacement
        );
    }

    return replaceWithString(
        $haystack, $needle, $replacement
    );
}

/**
 * @param string $haystack
 * @param array  $needle
 * @param array  $replacement
 *
 * @return string
 */
function replaceWithArray($haystack, array $needle, array $replacement)
{
    foreach ($needle as $i => $next) {
        $haystack = replace($haystack, $next, $replacement[$i]);
    }

    return $haystack;
}

/**
 * @param string       $haystack
 * @param string|array $needle
 * @param string|array $replacement
 *
 * @return string
 */
function replaceWithString($haystack, $needle, $replacement)
{
    return str_replace($needle, $replacement, $haystack);
}

/**
 * @param string       $haystack
 * @param string|array $needle
 * @param string|array $replacement
 *
 * @return string
 */
function replaceWithExpression($haystack, $needle, $replacement)
{
    return (string) preg_replace(
        $needle, $replacement, $haystack
    );
}

/**
 * @param string $string
 * @param int    $offset
 * @param int    $limit
 *
 * @return string
 */
function slice($string, $offset = 0, $limit = 0)
{
    if ($limit == 0) {
        return substr($string, $offset);
    }

    return substr($string, $offset, $limit);
}

/**
 * @param string      $haystack
 * @param string|null $needle
 * @param int         $limit
 *
 * @return array
 */
function split($haystack, $needle = null, $limit = 0)
{
    if ($needle === null) {
        return splitWithNull($haystack, $limit);
    }

    if (isExpression($needle)) {
        return splitWithExpression($haystack, $needle, $limit);
    }

    return splitWithString($haystack, $needle, $limit);
}

/**
 * @param string $haystack
 * @param int    $limit
 *
 * @return array
 */
function splitWithNull($haystack, $limit = 0)
{
    if ($limit === 0) {
        return str_split($haystack);
    }

    return str_split($haystack, $limit);
}

/**
 * @param string $haystack
 * @param string $needle
 * @param int    $limit
 *
 * @return array
 */
function splitWithString($haystack, $needle, $limit = 0)
{
    if ($limit === 0) {
        return explode($needle, $haystack);
    }

    return explode($needle, $haystack, $limit);
}

/**
 * @param string $haystack
 * @param string $needle
 * @param int    $limit
 *
 * @return array
 */
function splitWithExpression($haystack, $needle, $limit = 0)
{
    if ($limit === 0) {
        return preg_split($needle, $haystack);
    }

    return preg_split($needle, $haystack, $limit);
}

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return string
 */
function trim($haystack, $needle)
{
    if (isExpression($needle)) {
        return trimWithExpression($haystack, $needle);
    }

    return trimWithString($haystack, $needle);
}

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return string
 */
function trimWithString($haystack, $needle)
{
    return \trim($haystack, $needle);
}

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return string
 */
function trimWithExpression($haystack, $needle)
{
    $pattern = slice($needle, 1, length($needle) - 2);

    return (string) preg_replace(
        "#^{$pattern}|{$pattern}$#", "", $haystack
    );
}

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return string
 */
function trimLeft($haystack, $needle)
{
    if (isExpression($needle)) {
        return trimLeftWithExpression($haystack, $needle);
    }

    return trimLeftWithString($haystack, $needle);
}

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return string
 */
function trimLeftWithString($haystack, $needle)
{
    return ltrim($haystack, $needle);
}

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return string
 */
function trimLeftWithExpression($haystack, $needle)
{
    $pattern = slice($needle, 1, length($needle) - 2);

    return (string) preg_replace(
        "#^{$pattern}#", "", $haystack
    );
}

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return string
 */
function trimRight($haystack, $needle)
{
    if (isExpression($needle)) {
        return trimRightWithExpression($haystack, $needle);
    }

    return trimRightWithString($haystack, $needle);
}

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return string
 */
function trimRightWithString($haystack, $needle)
{
    return rtrim($haystack, $needle);
}

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return string
 */
function trimRightWithExpression($haystack, $needle)
{
    $pattern = slice($needle, 1, length($needle) - 2);

    return (string) preg_replace(
        "#{$pattern}$#", "", $haystack
    );
}
