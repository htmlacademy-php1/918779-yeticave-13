<?php
require_once('init.php');
require_once('data.php');
require_once('helpers.php');
require_once('functions.php');
require_once("getwinner.php");

$bet =[];

//Запрос на показ лотов
$sql = 'SELECT lots.id, lots.lot_name, lots.price, lots.photo, lots.date_expiration, categories.category_name, MAX(bets.sum) as current_price 
FROM lots JOIN categories ON lots.category_id=categories.id 
JOIN bets ON bets.lot_id=lots.id 
WHERE lots.date_expiration > NOW() 
GROUP BY lots.id';
    
$res = mysqli_query($link, $sql);
if ($res) {
    $advertise = mysqli_fetch_all($res, MYSQLI_ASSOC);

} else {
    http_response_code(404);        
    header('Location: /error.php',true, 404);
    exit;
}

$get_winner = include_template("getwinner.php", [
    "lots" => $lots,
    "bet" => $bet  
]);

$main_content = include_template('main.php', [
    'categories' => $categories,
    'advertise' => $advertise
]);

$layout_content = include_template('layout.php', [
    'content' => $main_content,
    'categories' => $categories,
    'title' => 'Главная',
    'is_auth' => $is_auth,
    'user_name' => $user_name
]);

print($layout_content);

?>
