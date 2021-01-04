<?php

session_start();
if (!isset($_SESSION['usernameAdmin']))
    header("location:login.php");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Vizualizare Inregistrari</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1>Inregistrarile din tabela products</h1>
<p><b>Toate inregistrarile din products</b</p>
<?php
// connectare bazadedate
include("conectaremi.php");
// se preiau inregistrarile din baza de date
if ($result = $mysqli->query("SELECT * FROM products ORDER BY id ")) { // Afisare inregistrari pe ecran
    if ($result->num_rows > 0) {
        // afisarea inregistrarilor intr-o table
        echo "<table border='1' cellpadding='10'>";

        // antetul tabelului
        echo
        "<tr><th>ID</th><th>name</th><th>price</th><th>rrp</th><th>quantity</th><th>img</th><th colspan=2>actions</th></tr>";
        while ($row = $result->fetch_object()) {
            // definirea unei linii pt fiecare inregistrare
            echo "<tr>";
            echo "<td>" . $row->id . "</td>";
            echo "<td>" . $row->name . "</td>";
            echo "<td>" . $row->price . "</td>";
            echo "<td>" . $row->rrp . "</td>";
            echo "<td>" . $row->quantity . "</td>";
            echo "<td>" . $row->img . "</td>";
            echo "<td><a href='modificamysqli.php?id=" . $row->id . "'>Modificare</a></td>";
            echo "<td><a href='stergemysqli.php?id=" . $row->id . "'>Stergere</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } // daca nu sunt inregistrari se afiseaza un rezultat de eroare
    else {
        echo "Nu sunt inregistrari in tabela!";
    }
} // eroare in caz de insucces in interogare
else {
    echo "Error: " . $mysqli->error();
}

// se inchide
$mysqli->close();
?>
<a href="adaugaremysqli.php">Adaugarea unei noi inregistrari</a>
</body>
</html>