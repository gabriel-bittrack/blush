<?php

/**
 * Validates the HTML type length (not to be confused with CSS's length).
 *
 * This accepts integer pixels or percentages as lengths for certain
 * HTML attributes.
 */

class HTMLPurifier_AttrDef_HTML_Length extends HTMLPurifier_AttrDef_HTML_Pixels
{

    public function validate($string, $config, $context)
    {

        $string = trim($string);
        if ($string === '') return FALSE;

        $parent_result = parent::validate($string, $config, $context);
        if ($parent_result !== FALSE) return $parent_result;

        $length = strlen($string);
        $last_char = $string[$length - 1];

        if ($last_char !== '%') return FALSE;

        $points = substr($string, 0, $length - 1);

        if (!is_numeric($points)) return FALSE;

        $points = (int)$points;

        if ($points < 0) return '0%';
        if ($points > 100) return '100%';

        return ((string)$points) . '%';

    }

}

// vim: et sw=4 sts=4
