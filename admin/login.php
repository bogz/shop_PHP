<?php
session_start();
if (isset($_SESSION['usernameAdmin']))
    echo "ESTI AUTENTIFICAT!<br \><a href='logout.php'>Logout</a>";
else {
    include_once 'class.user.php';
    $user = new users();

    if (isset($_REQUEST['submit'])) {
        extract($_REQUEST);
        $login = $user->check_login($emailusername, $password);
        if ($login) {
            // Inregistrare cu succes
            $_SESSION['usernameAdmin'] = $emailusername;
            //daca am venit de pe pagina Cart si ne-am logat, ne reintoarcem pe Cart
            header("location:index.php");
        } else {
            // Inregistrare cu esec
            echo 'username sau password gresit!';
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

        function submitlogin() {
            var form = document.login;
            if (form.emailusername.value === "") {
                alert("Introdu email sau username.");
                return false;
            } else if (form.password.value === "") {
                alert("Introdu password.");
                return false;
            }
        }

            ?
        >
    </script>
    <span style="font-family: 'Courier 12, Courier, monospace; font-size: 12px; font-style: normal; line-height: 1;"><div
                id="container"></span>
    <h1>Login Here</h1>
    <form action="" method="post" name="login">
        <table>
            <tbody>
            <tr>
                <th>UserName sau Email:</th>
                <td><input type="text" name="emailusername" required=""/></td>
            </tr>
            <tr>
                <th>Password:</th>
                <td><input type="password" name="password" required=""/></td>
            </tr>
            <tr>
                <td></td>
                <td><input onclick="return(submitlogin());" type="submit" name="submit" value="Login"/></td>
            </tr>
            <tr>
                <td></td>
                <!-- <td><a href="registration.php">Nou user</a></td> -->
            </tr>
            </tbody>
        </table>
    </form></div>
    <?php
}
?>