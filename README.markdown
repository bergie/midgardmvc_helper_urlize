URL-safe text handler [![Build Status](https://secure.travis-ci.org/bergie/midgardmvc_helper_urlize.png)](http://travis-ci.org/bergie/midgardmvc_helper_urlize)
=====================

This library can be used for generating URL-safe names for entities from their titles.

Examples:

    <?php
    $string = 'älä lyö ääliö ööliä läikkyy';
    $url = midgardmvc_helper_urlize::string($string); 
    var_dump($url); // ala_lyo_aalio_oolia_laikkyy

    $string = 'Контакты';
    $url = midgardmvc_helper_urlize::string($string);
    var_dump($url); // kontakty

The UTF-8 handling code comes from the [PHP UTF-8 Project](http://sourceforge.net/projects/phputf8/).
