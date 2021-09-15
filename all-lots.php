<?php
require_once('init.php');
require_once('data.php');
require_once('helpers.php');
require_once('functions.php');
require_once("getwinner.php");

$cat = $_GET["category_id"];


if ($cat) {
    $current_page = (int)($_GET["page"] ?? 1);    

    $page_items = 9;

    $offset = ($current_page - 1) * $page_items;

    $sql = "SELECT COUNT(*) as count FROM lots WHERE category_id = ?";

    $stmt = db_get_prepare_stmt($link, $sql, [$cat]);
    mysqli_stmt_execute($stmt);
    $result= mysqli_stmt_get_result($stmt);

    $items_count = mysqli_fetch_assoc($result)['count'];

    $pages_count = ceil($items_count / $page_items);

    if($current_page === 0 || $current_page > $pages_count) {

        header("Location: /index.php");
    }
    
    $pages = range(1, $pages_count);
  
        $sql = "SELECT lots.id, lots.lot_name, lots.price, lots.photo, lots.date_expiration, categories.category_name FROM lots
        JOIN categories ON lots.category_id=categories.id
        WHERE lots.category_id = ? LIMIT " . $page_items . " OFFSET " . $offset;

        $stmt = db_get_prepare_stmt($link, $sql, [$cat]);
        mysqli_stmt_execute($stmt);
        $result= mysqli_stmt_get_result($stmt);    

        if ($result) {

                $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);

        }
};




$main_content = include_template("all-lots_main.php", [
    "categories" => $categories,
    "cat" => $cat,
    "lots" => $lots,
    "pages_count" => $pages_count,
    "pages" => $pages,
    "current_page" => $current_page
]);
$layout_content = include_template("layout.php", [
    "content" => $main_content,
    "categories" => $categories,
    "title" => "Лоты категории",
    "cat" => $cat,
    "is_auth" => $is_auth,
    "user_name" => $user_name
]);


print($layout_content);

?>
