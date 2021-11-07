<?php

require_once "SmallShopCategories.php";

class SmallShopAPI 
{
    private static function getRestUrl()
    {
        return get_rest_url( null, 'wp/v2/search');
    }

    public static function init()
    {
        if ( ! function_exists( 'register_rest_route' ) ) {
            echo "register_rest_route";
			// The REST API wasn't integrated into core until 4.4, and we support 4.0+ (for now).
			return false;
		}

        $endpoint = new SmallShopCategories();
        $endpoint->register();
    }
}