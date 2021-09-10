<?php

require_once("init.php");
require_once("helpers.php");
require_once("functions.php");
require_once("data.php");

$categories_id = [];

if ($categories_result) {
    $categories_id = array_column($categories, "id");
}

$main_content = include_template("sign-up_main.php", ["categories" => $categories]);

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
        "email"=>FILTER_DEFAULT,
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
            $sql = "SELECT email, user_name FROM users";
            
            $result = mysqli_query($link, $sql);
            $rows = mysqli_num_rows($result);
            
            if ($rows === 1) {
                $row = mysqli_fetch_assoc($result);
            } else if ($rows > 1) {
                $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }

            if ($result) {
                $users_data = $row;
            }
            $error = mysqli_error($link);

            $emails = array_column($users_data, "email");
            $names = array_column($users_data, "user_name");

      
        if (in_array($user["email"], $emails)) {
            $errors["email"] = "Пользователь таким e-mail уже зарегистрирован";
        }

        if (in_array($user["user_name"], $names)) {
            $errors["user_name"] = "Пользователь с таким именем уже зарегистрирован";
        }

        if (count($errors)) {
            $main_content = include_template("sign-up_main.php", [
                "categories" => $categories,
                "user" => $user,
                "errors" => $errors
            ]);
        } else {

            $sql = "INSERT INTO users (email, user_name, user_password, contacts) VALUES (?, ?, ?, ?)";
            $user["user_password"] = password_hash($user["user_password"], PASSWORD_DEFAULT);
        
            $stmt = db_get_prepare_stmt($link, $sql, $user);
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
