<?php

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
}

function is_category_valid ($id, $allowed_list) {
    if (!in_array($id, $allowed_list)) {
        return "Указанная категория не существует";
    }
}

function is_number_valid ($num) {
    if (!empty($num)) {
        $num *= 1;
        if (is_numeric($num) && $num > 0) {
            return NULL;
        }
        return "Содержимое поля должно быть целым числом больше нуля";
    }
};

function valid_date ($date) {
    if (is_date_valid($date)) {
        $now = date_create("now");
        $d = date_create($date);
        $diff = date_diff($d, $now);
        $interval = date_interval_format($diff, "%d");

        if ($interval < 1) {
            return "Дата должна быть больше текущей не менее чем на один день";
        };
    } else {
        return "Содержимое поля «дата завершения» должно быть датой в формате «ГГГГ-ММ-ДД»";
    }
};

?>
