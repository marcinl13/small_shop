<?php

interface API
{
    public function add(\WP_REST_Request $request);
    public function delete(\WP_REST_Request $request);
    public function update(\WP_REST_Request $request);
    public function list(\WP_REST_Request $request);
    public function register();
}