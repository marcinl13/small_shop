<?php

namespace API;

use Core\Route;

require_once "endpoints/Categories.php";
require_once "endpoints/Products.php";

class Rest 
{
    private static function getRestUrl()
    {
        return get_rest_url( null, 'wp/v2/search');
    }

    public static function init()
    {
        if (!function_exists('register_rest_route')) {
			return false;
		}

        Route::get('/categoriesList', array(Categories::class, 'list'));
        Route::post('/addCategory', array(Categories::class, 'add'));
        Route::put('/updateCategory/(?P<id>\d+)', array(Categories::class, 'update'));
        Route::delete('/deleteCategory', array(Categories::class, 'delete'));

        Route::get('/productsList', array(Products::class, 'list'));
        Route::post('/addProduct', array(Products::class, 'add'));
        Route::put('/updateProduct/(?P<id>\d+)', array(Products::class, 'update'));
        Route::delete('/deleteProduct', array(Products::class, 'delete'));
    }
}