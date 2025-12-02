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
        "rest_base" => "books",
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

add_action("init", "bookstore_register_author_taxonomy");
function bookstore_register_author_taxonomy()
{
    $args = [
        "labels" => [
            "name" => "Authors",
            "singular_name" => "Author",
            "edit_item" => "Edit Author",
            "update_item" => "Update Author",
            "add_new_item" => "Add New Author",
            "new_item_name" => "New Author Name",
            "menu_name" => "Authors",
            "all_items" => "All Authors",
            "view_item" => "View Author",
        ],
        "hierarchical" => false,
        "rewrite" => ["slug" => "author"],
        "show_in_rest" => true,
    ];

    register_taxonomy("author", "book", $args);
}

// Admin Menu
add_action("admin_menu", "bookstore_add_admin_menu");
function bookstore_add_admin_menu()
{
    add_submenu_page(
        "edit.php?post_type=book",
        "Book List",
        "Book List",
        "edit_posts",
        "book-list",
        "bookstore_render_booklist",
    );
}

function bookstore_render_booklist()
{
    ?>
    <div class="wrap">
        <h1>Actions</h1>
        <button id="bookstore-load-books">Load Books</button>
        <button id="bookstore-fetch-books">Fetch Books</button>
        <h2>Books</h2>
        <textarea id="bookstore-bookslist" cols="130" rows="20"></textarea>
    </div>
    <?php
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

// Admin Scripts
add_action("admin_enqueue_scripts", "bookstore_admin_enqueue_scripts");
function bookstore_admin_enqueue_scripts()
{
    wp_enqueue_script(
        "bookstore-admin-scripts",
        plugin_dir_url(__FILE__) . "admin_bookstore.js",
        ["wp-api", "wp-api-fetch"],
        "1.0.0",
        true,
    );
}
