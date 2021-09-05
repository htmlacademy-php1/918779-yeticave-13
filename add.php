<?php

require_once("init.php");
require_once("helpers.php");
require_once("functions.php");
require_once("data.php");

$categories_id = [];

if ($result) {
    $categories_id = array_column($categories, "id");
}

$main_content = include_template("add_main.php", ["categories" => $categories]);

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    $required = ["lot_name", "category_id", "user_description", "price", "step", "date_expiration"];
    $errors = [];
    
    $rules = [
        "category_id" => function($value) use ($categories_id) {
            return is_category_valid($value, $categories_id);
        },
        "price" => function($value) {
            return is_number_valid ($value);
        },
        "step" => function($value) {
            return is_number_valid ($value);
        },
        "date_expiration" => function($value) {
            return valid_date ($value);
        }
    ];
    
    $lot = filter_input_array(INPUT_POST,
    [
        "lot_name" => FILTER_DEFAULT,
        "category_id" => FILTER_DEFAULT,
        "user_description" => FILTER_DEFAULT,
        "price" => FILTER_DEFAULT,
        "step" => FILTER_DEFAULT,
        "date_expiration" => FILTER_DEFAULT
    ], true);
    
    foreach ($lot as $field => $value) {
        if (isset($rules[$field])) {
            $rule = $rules[$field];
            $errors[$field] = $rule($value);
        }
        if (in_array($field, $required) && empty($value)) {
            $errors[$field] = "Это поле необходимо заполнить";
        }
    }
    
    $errors = array_filter($errors);
    
    if (!empty($_FILES["photo"]["name"])) {
        $tmp_name = $_FILES["photo"]["tmp_name"];
        $path = $_FILES["photo"]["name"];
    
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);
        if ($file_type === "image/jpeg") {
            $ext = ".jpg";
        } else if ($file_type === "image/png") {
            $ext = ".png";
        };
        if ($ext) {
            $filename = uniqid() . $ext;
            $lot["path"] = "uploads/". $filename;
            move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/". $filename);
        } else {
            $errors["photo"] = "Допустимые форматы файлов: jpg, jpeg, png";
        }
    } else {
        $errors["photo"] = "Вы не загрузили изображение";
    }
    
    if (count($errors)) {
        $main_content = include_template("add_main.php", [
            "categories" => $categories,
            "lot" => $lot,
            "errors" => $errors
         ]);
    } else {
        $sql = "INSERT INTO lots (lot_name, category_id, user_description, price, step, date_expiration, user_id, photo, create_datе) VALUES (?, ?, ?, ?, ?, ?, 1, ?, NOW())";
        $stmt = db_get_prepare_stmt($link, $sql, $lot);
        $res = mysqli_stmt_execute($stmt);
    
        if ($res) {
            $lot_id = mysqli_insert_id($link);
            header("Location: /lot.php?id=" . $lot_id);
    
        } else {
            header("Location: /error.php", true, 404);
            exit;
        }
    }

}
    
$layout_content = include_template("add_layout.php", [
    "is_auth" => $is_auth,
    "content" => $main_content,
    "categories" => $categories,
    "title" => "Добавляет лот",
    "user_name" => $user_name
    ]
);
    
print($layout_content);
    
?>
