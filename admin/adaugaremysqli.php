<?php
session_start();
if (!isset($_SESSION['usernameAdmin']))
    header("location:login.php");
include("conectaremi.php");
if (isset($_POST['submit'])) {
    // preluam datele de pe formular
    $name = htmlentities($_POST['name'], ENT_QUOTES);
    $description = htmlentities($_POST['description'], ENT_QUOTES);
    $price = htmlentities($_POST['price'], ENT_QUOTES);
    $rrp = htmlentities($_POST['rrp'], ENT_QUOTES);
    $quantity = htmlentities($_POST['quantity'], ENT_QUOTES);
    $img = htmlentities($_POST['img'], ENT_QUOTES);
    // verificam daca sunt completate
    if ($name == '' || $price == '' || $quantity == '' || $img == '') {
        // daca sunt goale se afiseaza un mesaj
        $error = 'ERROR: Campuri goale!';
    } else {
        // insert
        if (isset($mysqli)) {
            if ($stmt = $mysqli->prepare("INSERT into products (name, description, price, rrp, quantity, img) VALUES (?, ?, ?, ?, ?, ?)")) {
                $stmt->bind_param('ssddis', $name, $description, $price, $rrp, $quantity, $img);
                $stmt->execute();
                $stmt->close();
            } // eroare le inserare
            else {
                echo "ERROR: Nu se poate executa insert.";
            }
        }
    }
}
// se inchide conexiune mysqli
$mysqli->close();
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head><title><?php echo "Inserare inregistrare"; ?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1><?php echo "Inserare inregistrare"; ?></h1>
<?php if (isset($error)) {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
} ?>
<form action="" method="post">
    <div>
        <strong>name: </strong> <input type="text" name="name" value=""/><br/>
        <strong>description: </strong> <input type="text" name="description" value=""/><br/>
        <strong>price: </strong> <input type="text" name="price" value=""/><br/>
        <strong>rrp: </strong> <input type="text" name="rrp" value=""/><br/>
        <strong>quantity: </strong> <input type="text" name="quantity" value=""/><br/>
        <strong>img: </strong> <input type="text" name="img" value=""/><br/>
        <input type="submit" name="submit" value="Submit"/>
        <a href="vizualizaremysqli.php">Index</a>
    </div>
</form>
</body>
</html>