<?php

namespace API;

require_once SMALL_SHOP__PLUGIN_API . "InterfaceAPI.php";

class Products implements API
{
    private const TABLE = 'small_shop_products';

    public const ROUTE_LIST = 'wp/v2/sm-shop/productsList';
    public const ROUTE_ADD = 'wp/v2/sm-shop/addProduct';
    public const ROUTE_DELETE = 'wp/v2/sm-shop/deleteProduct';
    public const ROUTE_UPDATE = 'wp/v2/sm-shop/updateProduct';

    private $db;

    public function __construct()
    {
        global $wpdb;

        $this->db = $wpdb;
    }

    // init hooks
    public function register()
    {
        register_rest_route('wp/v2/sm-shop', '/productsList', array(
            'methods' => 'GET',
            'callback' => function($request) {
                return $this->list($request);
            } 
        ), true );

        register_rest_route('wp/v2/sm-shop', '/addProduct', array(
            'methods' => 'POST',
            'callback' => function($request) {
                return $this->add($request);
            } 
        ), true );

        register_rest_route('wp/v2/sm-shop', '/deleteProduct', array(
            'methods' => 'DELETE',
            'callback' => function($request) {
               return $this->delete($request);
            } 
        ), true );
        
        register_rest_route('wp/v2/sm-shop', '/updateProduct/(?P<id>\d+)', array(
            'methods' => 'PUT',
            'callback' => function($request) {
                return $this->update($request);
            } 
        ), true );
    }

    public function list(\WP_REST_Request $request): \WP_REST_Response
    {
        $q = $request->get_param('q') ?? null;
        $limit = $request->get_param('perPage') ?? 5;
        $page = $request->get_param('page') ?? 1;

        $whereQuery = "where p.name like '%" . $q . "%'";

        $sql = sprintf("select p.id, p.name, p.price, p.category_id, p.image from %s p %s;", self::TABLE, $whereQuery);
        $total = count($this->db->get_results($sql));

        $sql = sprintf("select p.id, p.name, p.price, p.category_id, c.name as category_name, p.image from %s p left join small_shop_categories c on p.category_id = c.id %s limit %d, %d;", self::TABLE, $whereQuery, ($page - 1) * $limit, $limit);
        $result = $this->db->get_results($sql);
        $last = ceil($total/$limit);
        $last = $last > 0 ? $last : 1;

        return new \WP_REST_Response([
            'page' => (int) $page,
            'last' => (int) $last,
            'total' => (int) $total,
            'result' => $result
        ], 200);
    }
    
    // TODO: return message + refactor + translations
    public function add(\WP_REST_Request $request): \WP_REST_Response
    {
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
        $this->db->insert(self::TABLE, $data, ['%s']);
        $insertID = $this->db->insert_id;

        return new \WP_REST_Response($insertID, 201); 
    }

    // TODO: return message + refactor + translations
    public function delete(\WP_REST_Request $request): \WP_REST_Response
    {
        $params = $request->get_body();
        $params = json_decode($params, true);

        $id = $params['id'] ?? null;
        
        if (!isset($id)) {
            return new \WP_REST_Response('no id provided', 500);
        }

        $data = ['id' => $id];

        $deleted = $this->db->delete(self::TABLE, $data, ['%d']);
    }

    // TODO: refactor + translations
    public function update(\WP_REST_Request $request): \WP_REST_Response
    {
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

        if($this->db->update(self::TABLE, $data, $where)){
            return new \WP_REST_Response(__CLASS__ .' updated', 200); 
        }

        return new \WP_REST_Response('oops something goeas wrong!!', 500); 
    }
}