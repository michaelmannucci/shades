<?php

namespace Michaelmannucci\Shades\Modifiers;

use Statamic\Modifiers\Modifier;

class Shades extends Modifier
{
    public function index($value, $params, $context)
    {

        // Remove "#" from hex
        $hex = str_replace('#', '', $value);

        // Tailwind
        if (array_get($params, 0) == "tailwind") {

            // Tint loop
            for ($i = 1; $i <= 4; $i++) {

                // Convert string to 3 decimal values (0-255)
                $rgbTint = array_map('hexdec', str_split($hex, 2));

                // Make adjustments
                $rgbTint[0] = round($rgbTint[0] + (((10 - ($i * 2))/10) * (255 - $rgbTint[0])));
                $rgbTint[1] = round($rgbTint[1] + (((10 - ($i * 2))/10) * (255 - $rgbTint[1])));
                $rgbTint[2] = round($rgbTint[2] + (((10 - ($i * 2))/10) * (255 - $rgbTint[2])));

                //Convert back to hex
                $newHex = str_pad(dechex($rgbTint[0]), 2, "0", STR_PAD_LEFT).str_pad(dechex($rgbTint[1]), 2, "0", STR_PAD_LEFT).str_pad(dechex($rgbTint[2]), 2, "0", STR_PAD_LEFT);

                // Assign Tailwind number
                $tintNum = $i."00";

                // Generate Tailwind tints
                $tints[] = "--".array_get($params, 1)."-".$tintNum.":#".$newHex;
                
            }

            // -50 Tint

                // Convert string to 3 decimal values (0-255)
                $rgbTint = array_map('hexdec', str_split($hex, 2));

                // Make adjustments
                $rgbTint[0] = round($rgbTint[0] + (.90 * (255 - $rgbTint[0])));
                $rgbTint[1] = round($rgbTint[1] + (.90 * (255 - $rgbTint[1])));
                $rgbTint[2] = round($rgbTint[2] + (.90 * (255 - $rgbTint[2])));

                //Convert back to hex
                $newHex = implode('', array_map('dechex', $rgbTint));

                // Assign Tailwind number
                $tintNum ="50";

                $tailwindTint = "--".array_get($params, 1)."-".$tintNum.":#".$newHex;

                // Push to tints array
                array_unshift($tints,$tailwindTint);

            // Shades loop
            for ($i = 0; $i <= 4; $i++) {

                // Convert string to 3 decimal values (0-255)
                $rgbShade = array_map('hexdec', str_split($hex, 2));

                // Make adjustments
                $rgbShade[0] = round($rgbShade[0] * ((10 - ($i * 2))/10));
                $rgbShade[1] = round($rgbShade[1] * ((10 - ($i * 2))/10));
                $rgbShade[2] = round($rgbShade[2] * ((10 - ($i * 2))/10));

                //Convert back to hex
                $newHex = str_pad(dechex($rgbShade[0]), 2, "0", STR_PAD_LEFT).str_pad(dechex($rgbShade[1]), 2, "0", STR_PAD_LEFT).str_pad(dechex($rgbShade[2]), 2, "0", STR_PAD_LEFT);

                // Assign Tailwind number
                $shadeNum = ($i + 5)."00";

                // Generate Tailwind tints
                $shades[] = "--".array_get($params, 1)."-".$shadeNum.":#".$newHex;
                
            }
    
            // Return
            return "<style>:root{".implode(";", $tints).";".implode(";", $shades).";}</style>";
        }

        // Manual tint
        elseif (array_get($params, 0) == "tint") {

            // Convert string to 3 decimal values (0-255)
            $rgbTint = array_map('hexdec', str_split($hex, 2));
            
            // Make adjustments
            $rgbTint[0] = round($rgbTint[0] + ((array_get($params, 1) /100) * (255 - $rgbTint[0])));
            $rgbTint[1] = round($rgbTint[1] + ((array_get($params, 1) /100) * (255 - $rgbTint[1])));
            $rgbTint[2] = round($rgbTint[2] + ((array_get($params, 1) /100) * (255 - $rgbTint[2])));

            //Convert back to hex
            $newHex = str_pad(dechex($rgbTint[0]), 2, "0", STR_PAD_LEFT).str_pad(dechex($rgbTint[1]), 2, "0", STR_PAD_LEFT).str_pad(dechex($rgbTint[2]), 2, "0", STR_PAD_LEFT);

            return "#".$newHex;
        }

        // Manual shade
        elseif (array_get($params, 0) == "shade") {

            // Convert string to 3 decimal values (0-255)
            $rgbShade = array_map('hexdec', str_split($hex, 2));
            
            // Make adjustments
            $rgbShade[0] = round($rgbShade[0] * ((100 - array_get($params, 1)) /100));
            $rgbShade[1] = round($rgbShade[1] * ((100 - array_get($params, 1)) /100));
            $rgbShade[2] = round($rgbShade[2] * ((100 - array_get($params, 1)) /100));

            //Convert back to hex
            $newHex = str_pad(dechex($rgbShade[0]), 2, "0", STR_PAD_LEFT).str_pad(dechex($rgbShade[1]), 2, "0", STR_PAD_LEFT).str_pad(dechex($rgbShade[2]), 2, "0", STR_PAD_LEFT);

            return "#".$newHex;
            
        }
    }
}
