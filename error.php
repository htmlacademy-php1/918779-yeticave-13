<?php
require_once('init.php');
require_once('helpers.php');
require_once('functions.php');
require_once('data.php');

if (http_response_code === 404) {
    $main_content = include_template('error_main.php', [
    'categories' => $categories
]);

$layout_content = include_template('layout.php', [
    'is_auth' => $is_auth,
    'content' => $main_content,
    'categories' => $categories,
    'title' => 'Ошибка',
    'user_name' => $user_name
]);

print($layout_content);

?>