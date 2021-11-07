<?php

class SmallShop 
{
    public function __construct()
    {
        
    }
    
    public static function init()
    {
        add_action( 'wp_enqueue_scripts', 'addAlpineJS' );
    }

    public function addAlpineJS()
    {
        wp_enqueue_script( 'alpinejs', 'https://unpkg.com/alpinejs@3.4.2/dist/cdn.min.js', false, true, true );
    }
}