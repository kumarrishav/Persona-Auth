<?php
include 'lib/functions.php';
include 'settings.php';

# Connect To DB
mysql_connect($details['host'], $details['user'], $details['pass'])or die(mysql_error());
mysql_select_db($details['db'])or die(mysql_error());

include 'auth.php';
