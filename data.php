<?php

define("SECONDS_IN_DAY", 86400);

$user_name = "";

$is_auth = !empty($_SESSION["user"]);
if ($is_auth) {
    $user_name = $_SESSION["user"];
};

date_default_timezone_set('Europe/Moscow');

if(!$link) {

    http_response_code(500); 
    header('Location: /error.php',true, 500);
    exit;
}   

else {

    // Запрос на получение списка категорий
    $categories_list = "SELECT id, category_code, category_name FROM categories ORDER BY id ASC";
    
    //Выполняем запрос и получаем результат
    $categories_result = mysqli_query($link, $categories_list);
    
    // Запрос выполнен успешно
    if ($categories_result) {
        
        // Получаем все категории в виде двухмерного массива
        $categories = mysqli_fetch_all($categories_result, MYSQLI_ASSOC);
 
    } else {
    
        // Получить текст последней ошибки
        
        http_response_code(404); 
        $content = header('Location: /error.php',true, 404);  
        exit;    
        
    }

}    

?>