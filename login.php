<?php

//cazul logout, stergem ultima pagina accesata
if (isset($_SESSION['username'])) {
    unset($_SESSION['lastpage']);
}
unset($_SESSION['username']);

include_once 'class.user.php';
$user = new User();

if (isset($_REQUEST['submit'])) {
    extract($_REQUEST);
    $login = $user->check_login($emailusername, $password);
    if ($login) {
        // Inregistrare cu succes
        $_SESSION['username'] = $emailusername;
        //daca am venit de pe pagina Cart si ne-am logat, ne reintoarcem pe Cart
        if (isset($_SESSION['lastpage']) && ($_SESSION['lastpage'] == 'cart')) {
            $_SESSION['lastpage'] = 'Logout';
        }
        header("location:index.php");
    } else {
        // Inregistrare cu esec
        echo 'Username sau parola gresita!';
    }
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style><!--
    #container {
        width: 500px;
        margin: 0 auto;
    }

    --></style>
<script type="text/javascript" language="javascript">

    function submitLogin() {
        const form = document.login;
        if (form.emailusername.value === "") {
            alert("Introdu email sau username.");
            return false;
        } else if (form.password.value === "") {
            alert("Introdu parola.");
            return false;
        }
    }
</script>
<span>
    <div id="container">
</span>
<h2>Login Here</h2>
<form action="" method="post" name="login">
    <table>
        <tbody>
        <tr>
            <th>Username sau Email:</th>
            <td><label>
                    <input type="text" name="emailusername" required=""/>
                </label>
            </td>
        </tr>
        <tr>
            <th>Password:</th>
            <td><label>
                    <input type="password" name="password" required=""/>
                </label>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input onclick="return(submitLogin());" type="submit" name="submit" value="Login"/></td>
        </tr>
        <tr>
            <td></td>
            <td><a href="registration.php">User nou? Click aici!</a></td>
        </tr>
        </tbody>
    </table>
</form>
