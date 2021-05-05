<?php

/**
 * Plugin Name: Chalets & Caviar
 * Description: Ce plugin est nécessaire pour administrer les différents biens de l'agence Chalets&Caviar !
 */
defined('ABSPATH') or die();

register_activation_hook(__FILE__, 'flush_rewrite_rules');
register_deactivation_hook(__FILE__, 'flush_rewrite_rules');

add_action('init', function () {
    register_post_type('properties', [
        'label' => 'Biens',
        'labels' => [
            'name'                     => 'Bien',
            'singular_name'            => 'Biens',
            'add_new'                  => 'Ajouter',
            'add_new_item'             => 'Ajouter un nouveau bien',
            'edit_item'                => 'Modifier le bien',
            'new_item'                 => 'Ajouter un bien',
            'view_item'                => 'Voir le bien',
            'view_items'               => 'Voir les biens',
            'search_items'             => 'Rechercher un bien',
            'not_found'                => 'Aucun bien trouvé',
            'not_found_in_trash'       => 'Aucun bien trouvé dans la corbeille',
            'all_items'                => 'Tous les biens',
            'archives'                 => 'Archive des biens',
            'filter_items_list'        => 'Filtrer la liste des biens',
            'items_list_navigation'    => 'Navigation de la liste de biens',
            'items_list'               => 'Liste de biens',
            'item_published'           => 'Bien publié',
            'item_published_privately' => 'Bien publié en privé',
            'item_scheduled'           => 'Publication du bien plannifiée',
            'item_updated'             => 'Bien mis à jour',
        ],
        'description' => 'Biens proposés par l\'agence',
        'public' => true,
        'hierarchical' => false,
        'exclude_from_search' => false,
        'menu_position' => 3,
        'menu_icon' => 'dashicons-admin-home',
        'has_archive' => true,
        'taxonomies' => [],
        'supports' => ['title', 'editor', 'thumbnail']
    ]);
});
