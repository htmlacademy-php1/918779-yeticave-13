<?php
$is_auth = rand(0, 1);

date_default_timezone_set('Europe/Moscow');

$user_name = "Антон"; // укажите здесь ваше имя

if(!$link) {

    $error = mysqli_connect_error();
    $connect = header('Location: http://localhost/error.php',true, 500);
}   

else {

    // Запрос на получение списка категорий
    $sql = 'SELECT category_code, category_name FROM categories ORDER BY id ASC';
    
    //Выполняем запрос и получаем результат
    $result = mysqli_query($link, $sql);
    
    // Запрос выполнен успешно
    if ($result) {
        
        // Получаем все категории в виде двухмерного массива
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    } else {
    
        // Получить текст последней ошибки
        
        $error = mysqli_error($link);
        $content = header('Location: http://localhost/error.php',true, 404);      
        
    }
}

?>
