<?php
/**
 * Plugin Name: Bookstore
 * Description: A plugin to manage books
 * Version: 1.0.1
 */

if (!defined("ABSPATH")) {
    exit();
}

// Register Book Post Type
add_action("init", "bookstore_register_book_post_type");
function bookstore_register_book_post_type()
{
    $args = [
        "labels" => [
            "name" => "Books",
            "menu_name" => "Books",
            "all_items" => "All Books",
            "add_new_item" => "Add New Book",
            "singular_name" => "Book",
            "edit_item" => "Edit Book",
            "view_item" => "View Book",
            "search_items" => "Search Books",
            "not_found" => "No Books Found",
            "not_found_in_trash" => "No Books Found in Trash",

            "add_new" => "Add New Book",
            "new_item" => "New Book",
        ],
        "public" => true,
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

    // Register ISBN Meta Field
    register_meta("post", "isbn", [
        "single" => true,
        "type" => "string",
        "default" => "",
        "show_in_rest" => true,
        "object_subtype" => "book",
    ]);
}

// Register Custom Rest Fields
add_action("rest_api_init", "bookstore_add_rest_fields");
function bookstore_add_rest_fields()
{
    register_rest_field("book", "isbn2", [
        "get_callback" => "bookstore_get_isbn",
        "update_callback" => "bookstore_update_isbn",
        "schema" => [
            "description" => "The ISBN of the book",
            "type" => "string",
        ],
    ]);
}

function bookstore_get_isbn($book)
{
    return get_post_meta($book["id"], "isbn2", true);
}

function bookstore_update_isbn($value, $book)
{
    return update_post_meta($book->ID, "isbn2", $value);
}

// Add ISBN to Quick Edit
add_filter("postmeta_form_keys", "bookstore_add_isbn_to_quick_edit", 10, 2);
function bookstore_add_isbn_to_quick_edit($keys, $post)
{
    if ($post->post_type === "book") {
        $keys[] = "isbn";
    }
    return $keys;
}

// Register Genre Taxonomy
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

// Register Author Taxonomy
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
    <div style="width:50%;">
        <h2>Books</h2>
        <form action="">
            <div>
                <label for="bookstore-book-title">Book Title</label>
                <input type="text" id="bookstore-book-title" placeholder="Title">
            </div>
            <div>
                <label for="bookstore-book-content">Book Content</label>
                <textarea id="bookstore-book-content" cols="100" rows="10"></textarea>
            </div>
            <div>
                <input type="button" id="bookstore-submit-book" value="Add">
            </div>
        </form>
    </div>
    <?php
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
