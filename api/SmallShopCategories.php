<?php

require_once "InterfaceAPI.php";

class SmallShopCategories implements API
{
    private const TABLE = 'small_shop_categories';

    public const ROUTE_LIST = 'wp/v2/sm-shop/categoriesList';
    public const ROUTE_ADD = 'wp/v2/sm-shop/addCategory';
    public const ROUTE_DELETE = 'wp/v2/sm-shop/deleteCategory';
    public const ROUTE_UPDATE = 'wp/v2/sm-shop/updateCategory';

    private $db;

    public function __construct()
    {
        global $wpdb;

        $this->db = $wpdb;
    }

    // init hooks
    public function register()
    {
        register_rest_route('wp/v2/sm-shop', '/categoriesList', array(
            'methods' => 'GET',
            'callback' => function($request) {
                return $this->list($request);
            } 
        ), true );

        register_rest_route('wp/v2/sm-shop', '/addCategory', array(
            'methods' => 'POST',
            'callback' => function($request) {
                return $this->add($request);
            } 
        ), true );

        register_rest_route('wp/v2/sm-shop', '/deleteCategory', array(
            'methods' => 'DELETE',
            'callback' => function($request) {
               return $this->delete($request);
            } 
        ), true );
        
        register_rest_route('wp/v2/sm-shop', '/updateCategory', array(
            'methods' => 'PUT',
            'callback' => function($request) {
                return $this->update($request);
            } 
        ), true );
    }

    
    public function list(\WP_REST_Request $request)
    {
        $query = sprintf("select id, name from %s limit %d;", self::TABLE, 10);

        $result = $this->db->get_results($query, ARRAY_A);

        return $result; 
    }

    public function add(\WP_REST_Request $request)
    {
        $params = $request->get_body();
        $params = json_decode($params, true);

        $name = $params['name'] ?? null;
        
        if (!isset($name)) {
            return new \WP_REST_Response('no name provided', 500);
        }

        $data = ['name' => $name];
        $this->db->insert(self::TABLE, $data, ['%s']);
        $insertID = $this->db->insert_id;

        return new \WP_REST_Response($insertID, 201); 
    }

    // TODO: return message
    public function delete(\WP_REST_Request $request)
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

    // TODO: create update
    public function update(\WP_REST_Request $request)
    {
        $data = [
            'column1' => 'value1',   // string
            'column2' => 'value2'    // integer (number) 
        ];

        $format = ['%s', '%d'];

        $where = ['id' => 6];
        $whereFormat = ['%d'];

        $this->db->update(self::TABLE, $data, $where, $format, $whereFormat);
    }

    // save product
}