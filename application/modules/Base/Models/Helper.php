<?php

namespace Base\Models;

/**
 * Class Helper
 * @package Models
 */
class Helper {

    public static function getImagePath($name) {
        if (empty($name)) {
            return '';
        }
        return 'upload' . DS . 'images' . DS . $name;
    }

    public static function getRootImagePath($name) {
        return HTDOCS . DS . self::getImagePath($name);
    }
    
    public function trim_txt($text) {
        //$text = nl2br(mb_substr(strip_tags($text, '<br/>'), 0, 155, 'UTF-8') ." &#8230;");
        $text = (mb_substr(strip_tags($text, '<br/>'), 0, 180, 'UTF-8'));            
        
        $tmp_txt = explode(" ", $text);        
        $tmp_txt[count($tmp_txt)-1] = " &#8230;";
        $text = implode(" ", $tmp_txt);

        return $text;
    }    
}