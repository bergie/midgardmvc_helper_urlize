<?php
class midgardmvc_helper_urlize
{
    public static function string($string, $replacer = '-')
    {
        if (empty($string))
        {
            throw new InvalidArgumentException("String may not be empty");
        }

        require_once(dirname(__FILE__) . '/utf8_to_ascii.php');

        $orig_string = $string;

        $string = trim(utf8_to_ascii($string, $replacer));

        // Ultimate fall-back, if we couldn't get anything out of the transliteration we use the UTF-8 character hexes as the name string to have *something*
        if (   empty($string)
               || preg_match("/^{$replacer}+$/", $string))
        {
            $i = 0;
            // make sure this is not mb_strlen (ie mb automatic overloading off)
            $len = strlen($orig_string);
            $string = '';
            while ($i < $len)
            {
                $byte = $orig_string[$i];
                $string .= str_pad(dechex(ord($byte)), '0', STR_PAD_LEFT);
                $i++;
            }
        }

        // Rest of spaces to underscores
        $string = preg_replace('/\s+/', '_', $string);

        // Regular expression for characters to replace (the ^ means an inverted character class, ie characters *not* in this class are replaced)
        $regexp = '/[^a-zA-Z0-9_-]/';
        // Replace the unsafe characters with the given replacer (which is supposed to be safe...)
        $safe = preg_replace($regexp, $replacer, $string);

        // Strip trailing {$replacer}s and underscores from start and end of string
        $safe = preg_replace("/^[{$replacer}_]+|[{$replacer}_]+$/", '', $safe);

        // Clean underscores around $replacer
        $safe = preg_replace("/_{$replacer}|{$replacer}_/", $replacer, $safe);

        // Any other cleanup routines ?

        // We're done here, return $string lowercased
        $safe = strtolower($safe);

        return $safe;
    }
}
