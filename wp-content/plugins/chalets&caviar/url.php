<?php

defined('ABSPATH') or die();

add_filter('query_vars', function ($params) {
    $params[] = 'property_type';
    return $params;
});

add_action('pre_get_posts', function (WP_Query $query) {
    if (is_admin() || !$query->is_main_query() || !is_post_type_archive('properties')) {
        return;
    }
    $values = ['rent', 'buy'];
    if (in_array(get_query_var('property_type'), $values)) {

        $meta_query = $query->get('meta_query', []);
        $meta_query[] = [
            'key' => 'property_type',
            'value' => get_query_var('property_type')
        ];
        $query->set('meta_query', $meta_query);
    }
});

add_action('init', function () {
    add_rewrite_rule('properties/(buy|rent)/?$', 'index.php?post_type=properties&property_type=$matches[1]', 'top');
});
