<?php
# Make Session Variable, Cannot be Empty, an Empty Binding will result in a Failed Query.
$session = (!empty($_COOKIE['session'])) ? $_COOKIE['session'] : 2;

# Check is Session Exists.
$query = Query("SELECT id FROM persona_users WHERE session = ?", $session);

# Check if a User is Authenticated with this session.
if( count( $query->fetchAll() ) == 1 )
{
    # Fetch Uer Information
    $query = Query("SELECT id FROM persona_users WHERE session = ?", $session);
    $user = $query->fetch(PDO::FETCH_OBJ);
    $id = $user->id;
    
    $login = true; # Set Login to True
}
