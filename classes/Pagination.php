<?php

namespace Core;

class Pagination
{
    public int $last;
    public int $total;
    public array $results;

    public function __construct(int $last, int $total, array $results)
    {
        $this->last = $last;
        $this->total = $total;
        $this->results = $results;
    }

    public static function createFromQuery(string $query, int $page = 1, int $limit = 5): Pagination
    {
        global $wpdb;

        $queryForTotal = sprintf("%s;", $query);
        $queryForResults = sprintf("%s limit %d, %d;", $query, ($page - 1) * $limit, $limit);

        $total = sizeof($wpdb->get_results($queryForTotal));
        $results = $wpdb->get_results($queryForResults);

        $last = ceil($total/$limit);
        $last = $last > 0 ? $last : 1;

        return new Pagination($last, $total, $results);
    }
}