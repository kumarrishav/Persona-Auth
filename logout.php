<?php
include 'config.php';

if($login)
{
    # Update Session
    $pdo->query("UPDATE persona_users SET session = ? WHERE email = ?", array('nihil',$email));
    setcookie('session', '', time());
    
    echo 'Successfully Logged Out.';
    redirect('index.php',1);
}
else
{
    echo 'You are not logged in.';
    redirect('index.php',1);
}