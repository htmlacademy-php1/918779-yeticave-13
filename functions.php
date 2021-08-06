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

function include_template($name, array $data = []) {
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}

?>
