<?php
include 'config.php';

if($login)
{
    # Update Session
    query("UPDATE persona_users SET session = ? WHERE email = ?", array('nihil',$email)); # Wipe Previous Session
    setcookie('session', '', time()); # Remove Cookie
    
    echo 'Successfully Logged Out.';
    redirect('index.php',1);
}
else
{
    echo 'You are not logged in.';
    redirect('index.php',1);
}