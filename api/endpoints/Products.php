<?php

namespace API;

use Core\Pagination;

require_once SMALL_SHOP__PLUGIN_API . "InterfaceAPI.php";

class Products implements API
{
    private const TABLE = 'small_shop_products';

    public const ROUTE_LIST = 'wp/v2/sm-shop/productsList';
    public const ROUTE_ADD = 'wp/v2/sm-shop/addProduct';
    public const ROUTE_DELETE = 'wp/v2/sm-shop/deleteProduct';
    public const ROUTE_UPDATE = 'wp/v2/sm-shop/updateProduct';

    public function __construct(){}

    public function list($request): \WP_REST_Response
    {
        $query = $request->get_param('q') ?? null;
        $limit = $request->get_param('perPage') ?? 5;
        $page = $request->get_param('page') ?? 1;
       
        $whereQuery = "where p.name like '%" . $query . "%'";
        $newSQL =  sprintf("select p.id, p.name, p.price, p.category_id, c.name as category_name, p.image from %s p 
                            left join small_shop_categories c on p.category_id = c.id %s", self::TABLE, $whereQuery);

        $pagination = Pagination::createFromQuery($newSQL, $page, $limit);

        return new \WP_REST_Response([
            'page' => (int) $page,
            'last' => $pagination->last,
            'total' =>  $pagination->total,
            'result' => $pagination->results
        ], 200);
    }
    
    // TODO: return message + refactor + translations
    public function add($request): \WP_REST_Response
    {
        global $wpdb;

        $params = $request->get_body();
        $params = json_decode($params, true);

        $name = $params['name'] ?? null;
        $price = $params['price'] ?? null;
        $category_id = $params['category_id'] ?? 1;
        $image = $params['image'] ?? null;
        
        if (!isset($name) || !isset($price) || !isset($category_id) || !isset($image)) {
            return new \WP_REST_Response('Provide required fields', 500);
        }
        
        $data = [
            'name' => $name,
            'price' => $price,
            'category_id' => $category_id,
            'image' => $image
        ];
        $wpdb->insert(self::TABLE, $data, ['%s']);
        $insertID = $wpdb->insert_id;

        return new \WP_REST_Response($insertID, 201); 
    }

    // TODO: return message + refactor + translations
    public function delete($request): \WP_REST_Response
    {
        global $wpdb;
        
        $params = $request->get_body();
        $params = json_decode($params, true);

        $id = $params['id'] ?? null;
        
        if (!isset($id)) {
            return new \WP_REST_Response('no id provided', 500);
        }

        $data = ['id' => $id];

        $deleted = $wpdb->delete(self::TABLE, $data, ['%d']);
    }

    // TODO: refactor + translations
    public function update($request): \WP_REST_Response
    {
        global $wpdb;
        
        $id = $request->get_param('id') ?? null;
        if (!isset($id)) {
            return new \WP_REST_Response('no id provided', 500);
        }

        $params = $request->get_body();
        $params = json_decode($params, true);

        $name = $params['name'] ?? null;
        $price = $params['price'] ?? null;
        $category_id = $params['category_id'] ?? 1;
        $image = $params['image'] ?? null;
        
        if (!isset($name) || !isset($price) || !isset($category_id) || !isset($image)) {
            return new \WP_REST_Response('Provide required fields', 500);
        }

        $data = [
            'name' => $name,
            'price' => $price,
            'category_id' => $category_id,
            'image' => $image
        ];
        $where = ['id' => $id];

        if($wpdb->update(self::TABLE, $data, $where)){
            return new \WP_REST_Response(__CLASS__ .' updated', 200); 
        }

        return new \WP_REST_Response('oops something goeas wrong!!', 500); 
    }
}