<?php

require_once 'helpers.php';
require_once 'functions.php';
$db = require_once 'db.php';

$link = mysqli_connect('localhost', 'root', '', 'yeticave');
mysqli_set_charset($link, 'utf-8');

?>