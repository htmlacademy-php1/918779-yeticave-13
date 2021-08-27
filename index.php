<?php
require_once('helpers.php');
require_once('functions.php');
require_once('init.php');
require_once('data.php');

if(!$link) {

    $error = mysqli_connect_error();
    $connect = include_template('error.php', ['error' => $error]);
    http_response_code();

}   

else {

    //Запрос на показ лотов
    $sql = 'SELECT lots.lot_name, lots.price, lots.photo, lots.date_expiration, categories.category_name, MAX(bets.sum) as current_price 
    FROM lots JOIN categories ON lots.category_id=categories.id 
    JOIN bets ON bets.lot_id=lots.id 
    WHERE lots.date_expiration > NOW() 
    GROUP BY lots.id';
    
    $res = mysqli_query($link, $sql);

    if ($res) {

       $advertise = mysqli_fetch_all($res, MYSQLI_ASSOC);

    } else {
        
       $error = header('Location: http://localhost/error.php',true, 404);
    }

    $main_content = include_template('main.php', [
        'categories' => $categories,
        'advertise' => $advertise
    ]);

    $layout_content = include_template('layout.php', [
        'is_auth' => $is_auth,
        'content' => $main_content,
        'categories' => $categories,
        'title' => 'Главная',
        'user_name' => $user_name
    ]);

}

print($layout_content);

?>
