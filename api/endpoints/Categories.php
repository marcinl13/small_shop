<?php

namespace API;

use Core\Pagination;
use Error;

require_once SMALL_SHOP__PLUGIN_API . "InterfaceAPI.php";

class Categories implements API
{
    private const TABLE = 'small_shop_categories';

    public const ROUTE_LIST = 'wp/v2/sm-shop/categoriesList';
    public const ROUTE_ADD = 'wp/v2/sm-shop/addCategory';
    public const ROUTE_DELETE = 'wp/v2/sm-shop/deleteCategory';
    public const ROUTE_UPDATE = 'wp/v2/sm-shop/updateCategory';
    
    public function __construct(){}
    
    public function list($request): \WP_REST_Response
    {
        $q = $request->get_param('q') ?? null;
        $limit = $request->get_param('perPage') ?? 5;
        $page = $request->get_param('page') ?? 1;

        $whereQuery = "where name like '%" . $q . "%'";
        $newSQL = sprintf("select id, name from %s %s", self::TABLE, $whereQuery);
        
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
        
        if (!isset($name)) {
            return new \WP_REST_Response('no name provided', 500);
        }

        $data = ['name' => $name];
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
        
        if (!isset($name)) {
            return new \WP_REST_Response('no name provided', 500);
        }

        $data = ['name' => $name];
        $where = ['id' => $id];

        if($wpdb->update(self::TABLE, $data, $where)){
            return new \WP_REST_Response('updated', 200); 
        }

        return new \WP_REST_Response('oops something goeas wrong!!', 500); 
    }
}


