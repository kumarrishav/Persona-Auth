<?php
include 'lib/persona.class.php';

$browserid = new Persona($_SERVER['HTTP_HOST'], $_POST['assertion']);
if($browserid->verify_assertion())
{
    echo 'Welcome '.$browserid->get_email().'<br />';
}
else
{
    echo 'Identification failure';
}