<?php
include 'lib/functions.php';
include 'settings.php';

try # Try to connect
{
    $pdo = new PDO('mysql:host='.$details['host'].';dbname='.$details['db'], $details['user'], $details['pass'], array( PDO::ATTR_PERSISTENT => false)); # PDO Connection
}
catch( PDOException $error ) # Catch Error
{
    die('Connection failed: '.$error->getMessage()); # Print Error, Oldschool Style
}

include 'auth.php';
