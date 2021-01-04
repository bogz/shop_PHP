<?php

include_once "../functions.php";

/*** se creaza un obiect mysqli ***/
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

/* se verifica daca s-a realizat conexiunea */
if (!mysqli_connect_errno()) {

    echo 'Connectat la baza de date: ' . DB_NAME;

// $mysqli->close();
} else {
    echo 'Nu se poate connecta';
    exit();
}