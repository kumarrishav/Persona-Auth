<?php
include 'config.php';
include 'lib/persona.class.php';

$browserid = new Persona($_SERVER['HTTP_HOST'], $_POST['assertion']);
if($browserid->verify_assertion())
{
    $email = $browserid->get_email();
    
    $pdo->query("SELECT * FROM persona_users WHERE email = ?", $email);

    if( count( $pdo->stmt->fetchAll() ) == 0 )
    {
        # Email Does not Exist, Create User.
        $pdo->query("INSERT INTO persona_users (email) VALUES (?)", $email);
        $id = $pdo->insert_id();
    }
    else
    {
        $fetch = $pdo->stmt->fetch(PDO::FETCH_OBJ);
        $id = $fetch->id;
    }
    
    # Make Session
    $session = $id.uniqid();
    setcookie('session',$session, time()+(60*60*24*31*12));
    
    # Update Session
    $pdo->query("UPDATE persona_users SET session = ? WHERE email = ?", array($session,$email));
    
    echo 'Welcome '.$browserid->get_email().'<br />';
    redirect('index.php',2);
}
else
{
    echo 'Identification failure';
}