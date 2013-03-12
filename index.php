<?php
include 'config.php';
?>
<html>
<header>
<script src="https://browserid.org/include.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function browserID()
{
    navigator.id.getVerifiedEmail(function(assertion)
    {
        if (assertion)
        {
        	document.getElementById('browserid_assertion').value = assertion;
        	document.getElementById('browserid_form').submit();
        }
        else
        {
            alert('Could not complete identification');
        }
    });
    
    return false;
}
-->
</script>
</header>

<body>
<?php
if($login)
{
    # Select User info, or at least whatever we have from them.
    $query = query("SELECT id,email,username FROM persona_users WHERE session = ?", $session);
    $my = $query->fetch(PDO::FETCH_OBJ);
    
    /**
     * You can totally get rid of this junk here, it's for example purposes!
     */
    function sprint($input)
    {
        global $my;
        return htmlspecialchars($my->$input);
    }
    
    if(!empty($my->username))
    {
        echo 'Welcome, <strong>'.sprint('username').'</strong>. (<a href="logout.php">Logout</a>)<br />
        Your email Adress is: '.sprint('email').'.';
    }
    else
    {
        echo 'You are now Logged In! (<a href="logout.php">Logout</a>)<br />
        Your email Adress is: '.sprint('email').'.';
    }
}
else
{
    ?>
    <form action="login.php" method="post" id="browserid_form" onSubmit="return browserID();">
    <input type="hidden" name="assertion" value="" id="browserid_assertion" />
    <input type="submit" value="Sign In" />
    <?
}
?>
</body>
</html>
