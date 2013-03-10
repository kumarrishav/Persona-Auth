<?php
include 'config.php';

if($login)
{
    # Update Session
    $query = bindParams("UPDATE persona_users SET session = ? WHERE email = ?", array('nihil',$email));
    mysql_query($query)or die($statement.' | '.mysql_error());
    
    setcookie('session', '', time());
    
    echo 'Successfully Logged Out.';
    redirect('index.php',1);
}
else
{
    echo 'You are not logged in.';
    redirect('index.php',1);
}