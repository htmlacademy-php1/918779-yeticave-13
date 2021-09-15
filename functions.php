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

    $output = $input . " " . "&#8381;";

    return $output;
}

function get_arrow ($result_query) {
    $row = mysqli_num_rows($result_query);
    if ($row === 1) {
        $arrow = mysqli_fetch_assoc($result_query);
    } else if ($row > 1) {
        $arrow = mysqli_fetch_all($result_query, MYSQLI_ASSOC);
    }

    return $arrow;
};

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

function is_get_bets_history ($link, $data) {
    if (!$link) {
    $error = mysqli_connect_error();
    return $error;
    } else {
        $sql = "SELECT users.user_name, bets.sum, DATE_FORMAT(date_bet, '%d.%m.%y %H:%i') AS date_bet
        FROM bets
        JOIN lots ON bets.lot_id=lots.id
        JOIN users ON bets.user_id=users.id
        WHERE lots.id = $data
        ORDER BY bets.date_bet DESC LIMIT 10;";
        $result = mysqli_query($link, $sql);
        if ($result) {
            $list_bets = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $list_bets;
        }
        $error = mysqli_error($link);
        return $error;
    }
};

function is_add_bet_db($link, $sum, $user_id, $lot_id) {
    $sql = "INSERT INTO bets (sum, user_id, lot_id) VALUE (?, ?, ?)";
    $stmt = db_get_prepare_stmt($link, $sql, [$sum, $user_id, $lot_id]);
    $result = mysqli_stmt_execute($stmt);
    if ($result) {
        return $result;
    }
    $error = mysqli_error($link);
    return $error;
};

function is_bet_counter($link, $data) {

    $result = mysqli_query($link, "SELECT COUNT(*) as cnt FROM bets
    JOIN lots ON bets.lot_id=lots.id
    WHERE lots.id = $data");
    $bets_count = mysqli_fetch_assoc($result)['cnt'];

    if ($result) {
        return $bets_count;
    }
    $error = mysqli_error($link);
    return $error;

};

function is_get_bets ($link, $data) {

    if (!$link) {

    $error = mysqli_connect_error();
    return $error;

    } else {

        $sql = "SELECT DATE_FORMAT(bets.date_bet, '%d.%m.%y %H:%i') AS date_bet, bets.sum, lots.lot_name, lots.user_description, lots.photo, lots.date_expiration, lots.id, lots.winner_id, categories.category_name, users.contacts
        FROM bets
        JOIN lots ON bets.lot_id = lots.id
        JOIN users ON bets.user_id = users.id
        JOIN categories ON lots.category_id = categories.id
        WHERE bets.user_id = $data
        ORDER BY bets.date_bet DESC;";
        $result = mysqli_query($link, $sql);

        if ($result) {

            $bets_list = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $bets_list;
        }

        $error = mysqli_error($link);
        return $error;

    }
};

function is_get_user_data ($link, $data) {

    if (!$link) {
    $error = mysqli_connect_error();
    return $error;

    } else {

        $sql = "SELECT  users.contacts AS user_data FROM lots
        JOIN users ON users.id = lots.user_id
        WHERE lots.id = $data";

        $result = mysqli_query($link, $sql);

        if ($result) {
            $contacts = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        $error = mysqli_error($link);
        return $error;
    }
};

function is_time_left ($date) {
    date_default_timezone_set('Europe/Moscow');
    $final_date = date_create($date);
    $current_date = date_create("now");
    if ($current_date >= $final_date) {
        $res = ["00", "00"];
        return $res;
    }
    $diff = date_diff($final_date, $current_date);
    $format_diff = date_interval_format($diff, "%d %H %I");
    $arr = explode(" ", $format_diff);

    $hours = $arr[0] * 24 + $arr[1];
    $minutes = intval($arr[2]);
    $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
    $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);

    $res[] = $hours;
    $res[] = $minutes;

    return $res;
};

function get_lot_date_finish ($link) {
    if (!$link) {
        $error = mysqli_connect_error();
        return $error;
    } else {
        $sql = "SELECT * FROM lots WHERE winner_id IS NULL && date_expiration <= NOW()";
        $result = mysqli_query($link, $sql);
        if ($result) {
            $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $lots;
        }
        $error = mysqli_error($link);
        return $error;
    }
};

function get_last_bet ($link, $id) {
    if (!$link) {
        $error = mysqli_connect_error();
        return $error;
    } else {
        $sql = "SELECT * FROM bets
        WHERE lot_id = $id
        ORDER BY date_bet DESC LIMIT 1;";
        $result = mysqli_query($link, $sql);
        if ($result) {
            $bet = get_arrow($result);
            return $bet;
        }
        $error = mysqli_error($con);
        return $error;
    }
};

function add_winner ($link, $winer_id, $lot_id) {
    if (!$link) {
        $error = mysqli_connect_error();
        return $error;
    } else {
        $sql = "UPDATE lots SET winner_id = $winer_id WHERE id = $lot_id";
        $result = mysqli_query($link, $sql);
        if ($result) {
            return $result;
        }
            $error = mysqli_error($link);
            return $error;
    }
};

function get_user_win ($link, $id) {
    if (!$link) {
    $error = mysqli_connect_error();
    return $error;
    } else {
        $sql = "SELECT lots.id, lots.lot_name, users.user_name, users.contacts
        FROM bets
        JOIN lots ON bets.lot_id=lots.id
        JOIN users ON bets.user_id=users.id
        WHERE lots.id = $id";
        $result = mysqli_query($link, $sql);
        if ($result) {
            $data = get_arrow($result);
            return $data;
        }
        $error = mysqli_error($con);
        return $error;
    }
};

function get_user_contacts ($link, $id) {
    if (!$link) {
    $error = mysqli_connect_error();
    return $error;
    } else {
        $sql = "SELECT users.user_name, users.email, users.contacts FROM users
        WHERE id=$id";
        $result = mysqli_query($link, $sql);
        if ($result) {
            $user_date = get_arrow($result);
            return $user_date;
        }
        $error = mysqli_error($link);
        return $error;
    }
};

?>
