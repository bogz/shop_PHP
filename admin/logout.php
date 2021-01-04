<?php
session_start();
if (isset($_SESSION['usernameAdmin'])) {
    unset($_SESSION['usernameAdmin']);
    echo "Ai fost deconectat cu succes";
    echo "<br \>";
    echo "<a href='../index.php'>Intoarce-te la magazin</a>";
} else
    echo "<strong>Nu esti conectat!</strong>";
?>