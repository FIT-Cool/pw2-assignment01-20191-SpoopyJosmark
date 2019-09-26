<?php
$loginPressed = filter_input(INPUT_POST, 'btnLogin');

if(isset($loginPressed))
{
    $username = filter_input(INPUT_POST, 'txtUsername');
    $password = filter_input(INPUT_POST, 'txtPassword');

    $user = login($username, $password);

    if($user != null && $user['username'] == $username)
    {
        $_SESSION['user_logged'] = true;
        $_SESSION['name'] = $user['name'];

        header("location:index.php");
    } else
    {
        $errMsg = "Invalid username or password";
    }
}

if (isset($errMsg))
{
    echo '<div class="err-msg">' . $errMsg .' </div>';
}
?>

<form method="post">
    <fieldset>
        <legend>Login Form</legend>

        <label for="txtUsernameIdx" class="form-label">Username</label>
        <input id="txtUsernameIdx" name="txtUsername" type="text" autofocus required placeholder="Your username" class="form-input">

        <label for="txtPasswordIdx" class="form-label">Password</label>
        <input id="txtPasswordIdx" name="txtPassword" type="text" autofocus required placeholder="Your password" class="form=-input">

        <input type="submit" name="btnLogin" value="Login" class="button button-primary">
    </fieldset>
</form>
