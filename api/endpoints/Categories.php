<?php

namespace API;

require_once SMALL_SHOP__PLUGIN_API . "InterfaceAPI.php";

class Categories implements API
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
        
        register_rest_route('wp/v2/sm-shop', '/updateCategory/(?P<id>\d+)', array(
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

        $whereQuery = "where name like '%" . $q . "%'";

        $sql = sprintf("select id, name from %s %s;", self::TABLE, $whereQuery);
        $total = count($this->db->get_results($sql));

        $sql = sprintf("select id, name from %s %s limit %d, %d;", self::TABLE, $whereQuery, ($page - 1) * $limit, $limit);
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
        
        if (!isset($name)) {
            return new \WP_REST_Response('no name provided', 500);
        }

        $data = ['name' => $name];
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
        
        if (!isset($name)) {
            return new \WP_REST_Response('no name provided', 500);
        }

        $data = ['name' => $name];
        $where = ['id' => $id];

        if($this->db->update(self::TABLE, $data, $where)){
            return new \WP_REST_Response('updated', 200); 
        }

        return new \WP_REST_Response('oops something goeas wrong!!', 500); 
    }
}