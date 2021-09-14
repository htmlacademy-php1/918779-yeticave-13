

<?php

require_once("init.php");
require_once("helpers.php");
require_once("data.php");

function decorate_price ($input) {
    $output = "";
    $input = ceil($input);

    if ($input >= 1000) {

        $input = number_format($input, 0, '',' ');

    }

    $output = $input . " " . "<span>&#8381;</span>";

    return $output;
}

function date_range ($date_input) {

    $date_output = array();

    $date01 = strtotime($date_input);
    $date02 = strtotime('now');

    $diff = $date01 - $date02;

    $hours = floor($diff / 3600);

    $hours_end = $diff - ($hours * 3600);
    $minutes = ceil($hours_end / 60);

    $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
    $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);

    $date_output[] = $hours;
    $date_output[] = $minutes;

    return $date_output;
}

function date_warning ($data_input) {

    $data = (int)$data_input;

    $data_output = "";

    if ($data < 1) {

    $data_output = "timer--finishing";

    }

    return $data_output;

}

function decorate_time ($data_input) {

    $data_output = $data_input[0] . ':' . $data_input[1];

    return $data_output;
};

function is_category_valid ($id, $allowed_list) {
    if (!in_array($id, $allowed_list)) {
        return "Указанная категория не существует";
    }
};

function is_number_valid ($num) {

    if (empty($num) || !ctype_digit($num) || $num < 0) { 
    
        return 'Содержимое поля должно быть целым числом больше нуля';
    }

};

function valid_date ($date) {
    if (is_date_valid($date)) {

        $date01 = strtotime($date);
        $date02 = strtotime("now");
        
        if ($date01 < $date02 + SECONDS_IN_DAY) {

            return 'Дата должна быть больше текущей не менее чем на один день';       
        
        }

    } else {

        return "Содержимое поля «дата завершения» должно быть датой в формате «ГГГГ-ММ-ДД»";
    }
};


function is_email_valid ($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "E-mail должен быть корректным";
    }
};

function is_length_valid ($value, $min, $max) {
    if ($value) {
        $len = strlen($value);
        if ($len < $min or $len > $max) {
            return "Значение должно быть от $min до $max символов";
        }
    }
};

function is_email_used ($link, $data) {

    $sql = "SELECT id FROM users WHERE email = ?";

    $stmt = db_get_prepare_stmt($link, $sql, $data);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_bind_result($stmt, $res);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    return $res;
};

function is_login_data_correct ($link, $data) {

    $sql = "SELECT  id, email, user_name, user_password FROM users WHERE email = ?";

    $stmt = db_get_prepare_stmt($link, $sql, $data);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    return $res;
};

?>
