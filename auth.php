<?php
$session = (!empty($_COOKIE['session'])) ? $_COOKIE['session'] : md5(0);

$query = bindParams("SELECT id FROM persona_users WHERE session = ?", $session);
$query = mysql_query($query)or die($statement.' | '.mysql_error());

if( mysql_num_rows($query) == 1 )
{
    $user = mysql_fetch_object($query);
    $id = $user->id;
    $login = true;
}