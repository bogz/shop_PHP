<?php
include_once 'class.user.php';
$user = new User();
// Verific daca user este login sau nu

if (isset($_REQUEST['submit'])) {
    extract($_REQUEST);
    $register = $user->reg_user($fullname, $uname, $upass, $uemail);
    if ($register) {
// Inregistrare cu success
        echo 'Inregistrare cu succes <a href="login.php">Click aici</a> pt login';
    } else {
// Inregistrara nu a reusit
        echo 'Inregistrare esuata!';
    }
}
?>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
<style><!--
    #container {
        width: 400px;
        margin: 0 auto;
    }
    --></style>

<script type="text/javascript" language="javascript">
    function submitReg() {
        var form = document.reg;
        if (form.name.value === "") {
            alert(" Introdu name.");
            return false;
        } else if (form.uname.value === "") {
            alert(" Introdu username.");
            return false;
        } else if (form.upass.value === "") {
            alert(" Introdu password.");
            return false;
        } else if (form.uemail.value === "") {
            alert("Introdu email.");
            return false;
        }
    }
</script>
<div id="container">
    <h2>Inregistrare utilizator nou</h2>
    <form action="" method="post" name="reg">
        <table>
            <tbody>
            <tr>
                <th>Nume complet:</th>
                <td><label>
                        <input type="text" name="fullname" required=""/>
                    </label></td>
            </tr>
            <tr>
                <th>Nume utilizator:</th>
                <td><label>
                        <input type="text" name="uname" required=""/>
                    </label>
                </td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><label>
                        <input type="text" name="uemail" required=""/>
                    </label>
                </td>
            </tr>
            <tr>
                <th>Password:</th>
                <td><label>
                        <input type="password" name="upass" required=""/>
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input onclick="return(submitReg());" type="submit" name="submit" value="Register"/></td>
            </tr>
            <tr>
                <td></td>
                <td><a href="login.php">Deja inregistrat? Click aici!</a></td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
