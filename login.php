<?php
include 'config.php';
include 'lib/persona.class.php';

# Call Browserid Code for this Domain
$browserid = new Persona($_SERVER['HTTP_HOST'], $_POST['assertion']);

# Verify Assertion
if($browserid->verify_assertion())
{
    # Get Email Adress
    $email = $browserid->get_email();
    
    # Check to see if there is a user with this Email
    $query = query("SELECT * FROM persona_users WHERE email = ?", $email);
    
    # Insert or Fetch Data, depending if they already exist or not.
    if( count( $query->fetchAll() ) == 0 )
    {
        # Email Does not Exist, Create User, Set newly Created ID.
        query("INSERT INTO persona_users (email) VALUES (?)", $email);
        $id = $pdo->lastInsertId();
    }
    else
    {
        # Fetch User Id.
        $fetch = $query->fetch(PDO::FETCH_OBJ);
        $id = $fetch->id;
    }
    
    # Make Session
    $session = $id.uniqid(); # This will always be unique...
    setcookie('session',$session, time()+(60*60*24*31*12));
    
    # Update Session
    query("UPDATE persona_users SET session = ? WHERE email = ?", array($session,$email));
    
    # Do Some Welcoming.
    echo 'Welcome '.$browserid->get_email().'<br />';
    redirect('index.php',2); # Redirect to homepage.
}
else
{
    echo 'Identification failure';
}