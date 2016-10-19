<?php

namespace TypedPHP\Functions\NumberFunctions;

/**
 * @param int|float $number
 *
 * @return float
 */
function absolute($number)
{
    return (float) \abs($number);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function inverseCosine($number)
{
    return (float) \acos($number);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function inverseSine($number)
{
    return (float) \asin($number);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function inverseTangent($number)
{
    return (float) \atan($number);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function cosine($number)
{
    return (float) \cos($number);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function exponent($number)
{
    return (float) \exp($number);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function hyperbolicCosine($number)
{
    return (float) \cosh($number);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function hyperbolicSine($number)
{
    return (float) \sinh($number);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function hyperbolicTangent($number)
{
    return (float) \tanh($number);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function inverseHyperbolicCosine($number)
{
    return (float) \acosh($number);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function inverseHyperbolicSine($number)
{
    return (float) \asinh($number);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function inverseHyperbolicTangent($number)
{
    return (float) \atanh($number);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function logarithm($number)
{
    return (float) \log($number);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function sine($number)
{
    return (float) \sin($number);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function squareRoot($number)
{
    return (float) \sqrt($number);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function tangent($number)
{
    return (float) \tan($number);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function degrees($number)
{
    return (float) \rad2deg($number);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function radians($number)
{
    return (float) \deg2rad($number);
}

/**
 * @param int|float $number
 * @param int|float $divisor
 *
 * @return float
 */
function modulus($number, $divisor)
{
    return (float) \fmod($number, $divisor);
}

/**
 * @param int|float $number
 * @param int|float $power
 *
 * @return float
 */
function power($number, $power)
{
    return (float) \pow($number, $power);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function round($number)
{
    return (float) \round($number);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function ceiling($number)
{
    return (float) \ceil($number);
}

/**
 * @param int|float $number
 *
 * @return float
 */
function floor($number)
{
    return (float) \floor($number);
}

/**
 * @param int|float $min
 * @param int|float $max
 *
 * @return int
 */
function random($min, $max)
{
    return (int) \mt_rand($min, $max);
}

/**
 * @param int|float $number
 * @param int|float $min
 * @param int|float $max
 *
 * @return int|float
 */
function limit($number, $min, $max)
{
    if ($number < $min) {
        return $min;
    }

    if ($number > $max) {
        return $max;
    }

    return $number;
}
