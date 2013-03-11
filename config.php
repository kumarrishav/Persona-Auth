<?php
include 'lib/functions.php';
include 'settings.php';

# Connect To DB
$pdo = new Database('mysql:host='.$details['host'].';dbname='.$details['db'], $details['user'], $details['pass'], array( PDO::ATTR_PERSISTENT => false));

include 'auth.php';
