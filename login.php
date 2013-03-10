<?php
include 'config.php';
include 'lib/persona.class.php';

$browserid = new Persona($_SERVER['HTTP_HOST'], $_POST['assertion']);
if($browserid->verify_assertion())
{
    $email = $browserid->get_email();
    
    $query = bindParams("SELECT * FROM persona_users WHERE email = ?", $email);
    $query = mysql_query($query)or die($statement.' | '.mysql_error());
    
    # If user doesn't have account yet, make one for identifiaction.
    if( mysql_num_rows($query) == 0 )
    {
        # Email Does not Exist, Create User.
        $query = bindParams("INSERT INTO persona_users (email) VALUES (?)", $email);
        $query = mysql_query($query)or die($statement.' | '.mysql_error());
        
        $id = mysql_insert_id();
    }
    else
    {
        $fetch = mysql_fetch_object($query);
        $id = $fetch->id;
    }
    
    # Make Session
    $session = $id.uniqid();
    
    setcookie('session',$session, time()+(60*60*24*31*12));
    
    # Update Session
    $query = bindParams("UPDATE persona_users SET session = ? WHERE email = ?", array($session,$email));
    mysql_query($query)or die($statement.' | '.mysql_error());
    
    echo 'Welcome '.$browserid->get_email().'<br />';
    redirect('index.php',2);
}
else
{
    echo 'Identification failure';
}