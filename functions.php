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

    date_default_timezone_set('Europe/Moscow');

    $date_output = array();

    $date01 = strtotime($date_input);
    $date02 = strtotime('now');

    $diff = $date01 - $date02;

    $hours = floor($diff / 3600);

    $hours_end = $diff - ($hours * 3600);
    $minutes = ceil($hours_end / 60);

    $hours = str_pad($hours, 2, "0", STR_PAD_RIGHT);
    $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);

    $date_output[] = $hours;
    $date_output[] = $minutes;

    return $date_output;
}

?>
