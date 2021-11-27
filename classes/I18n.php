<?php

class I18n 
{
    private static $domain = SMALL_SHOP_TEXT_DOMAIN;

    static function loadTranslation()
    {
        $locale = apply_filters( 'plugin_locale', determine_locale(), SMALL_SHOP_TEXT_DOMAIN );
        $mofile = SMALL_SHOP_TEXT_DOMAIN . '-' . $locale . '.mo';
    
        // default translation file
        if(!file_exists(SMALL_SHOP__PLUGIN_LANGUAGES_DIR . $mofile)) {
            $locale = 'en_US';
            $mofile = SMALL_SHOP_TEXT_DOMAIN . '-' . $locale . '.mo';
        }
    
        load_textdomain( SMALL_SHOP_TEXT_DOMAIN, SMALL_SHOP__PLUGIN_LANGUAGES_DIR . $mofile );
    }

    public static function translate(string $text)
    {
        return __( $text, SMALL_SHOP_TEXT_DOMAIN );
    }

    public static function t(string $text): string
    {
        return __( $text, self::$domain );
    }
}