<?php
require_once('helpers.php');
require_once('functions.php');
require_once('init.php');
require_once('data.php');

//Запрос на показ лотов
$id_num = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);


$sql = "SELECT lots.id, lots.lot_name, lots.price, lots.photo, lots.user_description, lots.date_expiration, categories.category_name, MAX(bets.sum) as current_price 
       FROM lots
       JOIN categories ON lots.category_id=categories.id
       JOIN bets ON bets.lot_id=lots.id
       WHERE lots.id = $id_num
       GROUP BY lots.id";

if ($res = mysqli_query($link, $sql)) {

    if (!mysqli_num_rows($res)) {
        http_response_code(404);
        header('Location: /error.php',true, 404);
        exit;
    }

    else {

        $lot = mysqli_fetch_array($res, MYSQLI_ASSOC);

        $main_content = include_template('lot_main.php', [
            'categories' => $categories,
            'lot' => $lot
        ]);
        
        $layout_content = include_template('lot_layout.php', [
            'is_auth' => $is_auth,
            'content' => $main_content,
            'categories' => $categories,
            'title' => $lot['lot_name'],
            'user_name' => $user_name
        ]);

    }
}

else {

    header('Location: /error.php',true, 500);
    exit;
}

print($layout_content);

?>
