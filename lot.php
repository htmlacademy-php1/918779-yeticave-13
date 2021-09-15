<?php
require_once("helpers.php");
require_once("functions.php");
require_once("init.php");
require_once("data.php");

//Запрос на показ лотов
$id_num = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$lot_list = "SELECT lots.id, lots.lot_name, lots.price, lots.photo, lots.user_description, lots.date_expiration, lots.step, categories.category_name
       FROM lots
       JOIN categories ON lots.category_id=categories.id
       WHERE lots.id = $id_num
       GROUP BY lots.id";

if ($lot_result = mysqli_query($link, $lot_list)) {

    if (!mysqli_num_rows($lot_result)) {
        http_response_code(404);
        header("Location: /error.php",true, 404);
        exit;
    }

    else {

        $lot = mysqli_fetch_array($lot_result, MYSQLI_ASSOC);

        $history = is_get_bets_history($link, $id_num);
        $current_price = max($lot["price"], $history[0]["sum"]);
        $min_bet = $current_price + $lot["step"];
        $bet_counter = is_bet_counter ($link, $id_num);

        $main_content = include_template("lot_main.php", [
            "categories" => $categories,
            "lot" => $lot,
            "is_auth" => $is_auth,
            "user_name" => $user_name,
            "current_price" => $current_price,
            "min_bet" => $min_bet,
            "id_num" => $id_num,
            "history" => $history,
            "bet_counter" => "$bet_counter"

        ]);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $error = [];

            $bet = filter_input(INPUT_POST, "sum", FILTER_VALIDATE_INT);
        
            if ($bet < $min_bet) {
                $error = "Ставка не может быть меньше $min_bet";
            }
            if (empty($bet)) {
                $error = "Ставка должна быть целым числом, болше ноля";
            }
        
            if ($error) {
                $main_content = include_template("lot_main.php", [
                    "categories" => $categories,
                    "lot" => $lot,
                    "is_auth" => $is_auth,
                    "current_price" => $current_price,
                    "min_bet" => $min_bet,
                    "error" => $error,
                    "id_num" => $id_num,
                    "history" => $history
                ]);
            } else {
                $res = is_add_bet_db($link, $bet, $_SESSION["id"], $id_num);
                $bet_counter = is_bet_counter ($link, $id_num);
                header("Location: /lot.php?id=" .$id_num);
            }
        } 
        
        $layout_content = include_template("layout.php", [            
            "content" => $main_content,
            "categories" => $categories,
            "title" => $lot["lot_name"],
            "is_auth" => $is_auth,
            "user_name" => $user_name
        ]);

    }
}

else {

    header("Location: /error.php",true, 500);
    exit;
}

print($layout_content);

?>
