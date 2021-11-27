<?php

namespace API;

interface API
{
    public function add(\WP_REST_Request $request): \WP_REST_Response;
    public function delete(\WP_REST_Request $request): \WP_REST_Response;
    public function update(\WP_REST_Request $request): \WP_REST_Response;
    public function list(\WP_REST_Request $request): \WP_REST_Response;
    public function register();
}