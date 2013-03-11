<?php
$session = (!empty($_COOKIE['session'])) ? $_COOKIE['session'] : md5(0);

$pdo->query("SELECT id FROM persona_users WHERE session = ?", $session);

if( count( $pdo->stmt->fetchAll() ) == 1 )
{
    $user = $pdo->stmt->fetch(PDO::FETCH_OBJ);
    $id = $user->id;
    $login = true;
}
