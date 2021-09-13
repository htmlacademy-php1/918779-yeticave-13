<?php

require_once("init.php");
require_once("helpers.php");
require_once("functions.php");
require_once("data.php");

$categories_id = [];

if ($categories_result) {
    $categories_id = array_column($categories, "id");
}

if (!$is_auth) {
    $main_content = include_template("403_main.php", [
        "categories" => $categories
    ]);
    $layout_content = include_template("layout.php", [
        "content" => $main_content,
        "categories" => $categories,
        "title" => $title,
        "is_auth" => $is_auth,
        "user_name" => $user_name
    ]);
    print($layout_content);
    exit();
}

$main_content = include_template("sign-up_main.php", [
    "categories" => $categories
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $required = ["email", "user_password", "user_name", "contacts"];
    $errors = [];

    $rules = [
        "email" => function($value) {
            return is_email_valid($value);
        },
        "user_password" => function($value) {
            return is_length_valid ($value, 6, 8);
        },
        "user_message" => function($value) {
            return is_length_valid ($value, 12, 1000);
        }
    ];
    
    $user = filter_input_array(INPUT_POST,
    [
        "email"=>FILTER_VALIDATE_EMAIL,
        "user_password"=>FILTER_DEFAULT,
        "user_name"=>FILTER_DEFAULT,
        "contacts"=>FILTER_DEFAULT
    ], true);

    foreach ($user as $field => $value) {
        if (isset($rules[$field])) {
            $rule = $rules[$field];
            $errors[$field] = $rule($value);
        }
        if (in_array($field, $required) && empty($value)) {
            $errors[$field] = "Это поле нужно заполнить";
        }
    }

    $errors = array_filter($errors);


    if (count($errors)) {
        $main_content = include_template("sign-up_main.php", [
            "categories" => $categories,
            "user" => $user,
            "errors" => $errors
        ]);
    } else {

            if (!$link) {
                $error = mysqli_connect_error();
            }

 
            $sql = "SELECT id FROM users WHERE email = ?";            

            if (is_email_used($link, $sql, [$user['email']])) {
            $errors["email"] = 'Пользователь с этим email уже зарегистрирован';
            }
            
            if (count($errors)) {
                $main_content = include_template("sign-up_main.php", [
                    "categories" => $categories,
                    "user" => $user,
                    "errors" => $errors
                ]);

            } else {

                $password = password_hash($user["user_password"], PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (email, user_name, user_password, contacts) VALUES (?, ?, ?, ?)";
            
                $stmt = db_get_prepare_stmt($link, $sql, [$user['email'], $user['user_name'], $password, $user['contacts']]);
                $res = mysqli_stmt_execute($stmt);
                
                if ($res) {
                    header("Location: /login.php");
                } else {
                    $error = mysqli_error($link);
                }
            }
    }

}

$layout_content = include_template("layout.php", [
    "content" => $main_content,
    "categories" => $categories,
    "title" => "Регистрация",
    "is_auth" => $is_auth,
    "user_name" => $user_name
]);

print($layout_content);

?>
