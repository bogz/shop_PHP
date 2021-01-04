<?php
session_start();
if (isset($_SESSION['usernameAdmin'])) {
    ?>
    <html>
    <head>
        <title>Admin</title>
    </head>
    <body>
    <h1>Paginile proiectului</h1>
    <p><a href="vizualizaremysqli.php">Vizualizare date</p>
    <p><a href="adaugaremysqli.php">Inserare date</p>
    <p><a href="modificamysqli.php">Modificare date</p>
    <p><a href="stergemysqli.php">Stergere date</p>
    <br \><br \>
    <a href="logout.php">Log out</a>
    </body>
    </html>
    <?php
} else {
    header("location:login.php");
}
?>