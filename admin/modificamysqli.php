<?php

session_start();
if (!isset($_SESSION['usernameAdmin']))
    header("location:login.php");

// connectare bazadedate
include("conectaremi.php");
//Modificare datelor
// se preia id din pagina vizualizare
if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) { // verificam daca id-ul din URL este unul valid
        if (is_numeric($_POST['id'])) { // preluam variabilele din URL/form
            $id = $_POST['id'];
            $name = htmlentities($_POST['name'], ENT_QUOTES);
            $description = htmlentities($_POST['description'], ENT_QUOTES);
            $price = htmlentities($_POST['price'], ENT_QUOTES);
            $rrp = htmlentities($_POST['rrp'], ENT_QUOTES);
            $quantity = htmlentities($_POST['quantity'], ENT_QUOTES);
            $img = htmlentities($_POST['img'], ENT_QUOTES);

            // verificam daca name, price, rrp, quantity si img nu sunt goale
            if ($name == '' || $price == '' || $quantity == '' || $img == '') { // daca sunt goale afisam mesaj de eroare
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            } else { // daca nu sunt erori se face update
                if ($stmt = $mysqli->prepare("UPDATE products SET name=?, description=?, price=?, rrp=?, quantity=?, img=? WHERE id='" . $id . "'")) {
                    $stmt->bind_param('ssddis', $name, $description, $price, $rrp, $quantity, $img);
                    $stmt->execute();
                    $stmt->close();
                }// mesaj de eroare in caz ca nu se poate face update
                else {
                    echo "ERROR: nu se poate executa update.";
                }
            }
        } // daca variabila 'id' nu este valida, afisam mesaj de eroare
        else {
            echo "id incorect!";
        }
    }
} ?>
<html>
<head><title> <?php if ($_GET['id'] != '') {
            echo "Modificare inregistrare";
        } ?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1><?php if ($_GET['id'] != '') {
        echo "Modificare Inregistrare";
    } ?></h1>
<?php if (isset($error)) {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
} ?>
<form action="" method="post">
    <div>
        <?php if ($_GET['id'] != '') { ?>
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
        <p>ID: <?php echo $_GET['id'];
            if ($result = $mysqli->query("SELECT * FROM products where id='" . $_GET['id'] . "'"))
            {
            if ($result->num_rows > 0)
            {
            $row = $result->fetch_object(); ?></p>
        <strong>Name: </strong> <input type="text" name="name" value="<?php echo $row->name; ?>"/><br/>
        <strong>Description: </strong> <input type="text" name="description"
                                              value="<?php echo $row->description; ?>"/><br/>
        <strong>Pret: </strong> <input type="text" name="price" value="<?php echo $row->price; ?>"/><br/>
        <strong>RRP: </strong> <input type="text" name="rrp" value="<?php echo $row->rrp; ?>"/><br/>
        <strong>Quantity: </strong> <input type="text" name="quantity" value="<?php echo $row->quantity; ?>"/><br/>
        <strong>Image: </strong> <input type="text" name="img" value="<?php echo $row->img;
        }
        }
        } ?>"/> <br/>
        <input type="submit" name="submit" value="Submit"/>
        <a href="vizualizaremysqli.php">Index</a>
    </div>
</form>
</body>
</html>