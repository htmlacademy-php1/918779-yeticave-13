
<?php
require_once("helpers.php");
require_once("functions.php");
require_once("init.php");
require_once("data.php");
require_once('vendor/autoload.php');

$lots = get_lot_date_finish($link);
$bets_win = [];

foreach($lots as $lot) {
    $id = (int)$lot["id"];
    $bet = get_last_bet($link, $id);
    if (!empty($bet)) {
    $id_lot = $lot["id"];
    $bets_win[] = $bet;
    $res = add_winner($link, $bet["user_id"], $id);
    }
}

if (!empty($bets_win)) {

$win_users = [];
foreach($bets_win as $bet) {
    $id = intval($bet["lot_id"]);
    $data = get_user_win($link, $id);
    $win_users[] = $data;
}

$recipients =[];
foreach($bets_win as $bet) {
    $id = intval($bet["user_id"]);
    $user_data = get_user_contacts ($link, $id);
    $recipients[$user_data["email"]] = $user_data["user_name"];
}

$transport = new Swift_SmtpTransport("smtp.mailtrap.io", 2525);
$transport -> setUsername("d753198b29c4db");
$transport -> setPassword("59e88ca28b5e22");

$mailer = new Swift_Mailer($transport);

$message = new Swift_Message();
$message -> setSubject("Ваша ставка победила!");
$message-> setFrom(["keks@phpdemo" => "Yeticave"]);
$message-> setTo($recipients);

$msg_content = include_template("email.php", ["win_users" => $win_users]);
$message -> setBody($msg_content, "text/html");

$result = $mailer -> send($message);

if ($result) {
    print ("Рассылка успешно отправленна");
} else {
    print ("Не удалось отправить рассылку");
    }
}

?>