<?php
/**
 * Plugin Name: Bookstore
 * Description: A plugin to manage books
 * Version: 1.0
 */

if (!defined("ABSPATH")) {
    exit();
}

add_action("init", "bookstore_register_book_post_type");
function bookstore_register_book_post_type()
{
    $args = [
        "labels" => [
            "name" => "Books",
            "singular_name" => "Book",
            "menu_name" => "Books",
            "add_new" => "Add New Book",
            "add_new_item" => "Add New Book",
            "new_item" => "New Book",
            "edit_item" => "Edit Book",
            "view_item" => "View Book",
            "all_items" => "All Books",
        ],
        "public" => true,
        "has_archive" => true,
        "show_in_rest" => true,
        "supports" => [
            "title",
            "editor",
            "author",
            "thumbnail",
            "excerpt",
            "custom-fields",
        ],
    ];

    register_post_type("book", $args);
}

add_action("init", "bookstore_register_genre_taxonomy");
function bookstore_register_genre_taxonomy()
{
    $args = [
        "labels" => [
            "name" => "Genres",
            "singular_name" => "Genre",
            "edit_item" => "Edit Genre",
            "update_item" => "Update Genre",
            "add_new_item" => "Add New Genre",
            "new_item_name" => "New Genre Name",
            "menu_name" => "Genres",
            "all_items" => "All Genres",
            "view_item" => "View Genre",
        ],
        "hierarchical" => true,
        "rewrite" => ["slug" => "genre"],
        "show_in_rest" => true,
    ];

    register_taxonomy("genre", "book", $args);
}

add_filter("postmeta_form_keys", "bookstore_add_isbn_to_quick_edit", 10, 2);
function bookstore_add_isbn_to_quick_edit($keys, $post)
{
    if ($post->post_type === "book") {
        $keys[] = "isbn";
    }
    return $keys;
}

// Styles
add_action("wp_enqueue_scripts", "bookstore_enqueue_styles");
function bookstore_enqueue_styles()
{
    wp_enqueue_style(
        "bookstore-styles",
        plugin_dir_url(__FILE__) . "bookstore-styles.css",
    );
}

// Scripts
add_action("wp_enqueue_scripts", "bookstore_enqueue_scripts");
function bookstore_enqueue_scripts()
{
    wp_enqueue_script(
        "bookstore-scripts",
        plugin_dir_url(__FILE__) . "bookstore-scripts.js",
    );
}
