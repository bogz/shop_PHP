<?php
define('DB_SERVER', '192.168.0.2');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'secret');
define('DB_NAME', 'cumparaturi');

function pdo_connect_mysql() {
    $DB_SERVER = '192.168.0.2';
    $DB_USERNAME = 'root';
    $DB_PASSWORD = 'secret';
    $DB_NAME = 'cumparaturi';
    try {
        return new PDO('mysql:host=' . $DB_SERVER . ';dbname=' . $DB_NAME . ';charset=utf8', $DB_USERNAME, $DB_PASSWORD);
    } catch (PDOException $exception) {
        // If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to database!');
    }
}
// Template header, feel free to customize this
function template_header($title) {
    // Get the amount of items in the shopping cart, this will be displayed in the header.
    $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    $username = (!empty($_SESSION) && isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) ? $_SESSION["username"] : "";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?=$title?></title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <header>
            <div class="content-wrapper">
                <h1>Magazinul de la Colt</h1>
                <nav>
                    <a href="index.php">Acasa</a>
                    <a href="index.php?page=products">Produse</a>
                </nav>
                <div class="link-icons">
                    <?php if($username) { ?>
                        <a href="index.php?page=logout">
                            Logout
                        </a>
                    <?php } else { ?>
                        <a href="index.php?page=login">
                            Login
                        </a>
                    <?php } ?>
                    <a href="index.php?page=cart">
                        <i class="fas fa-shopping-cart"></i>
                        <span><?=$num_items_in_cart?></span>
                    </a>
                </div>
            </div>
        </header>
        <main>
<?php
}
// Template footer
function template_footer()
{
    $year = date('Y');
    echo <<<EOT
        </main>
        <footer>
            <div class="content-wrapper">
                <p>&copy; $year, Magazinul de la Colt</p>
            </div>
        </footer>
        <script src="script.js"></script>
    </body>
</html>
EOT;
}
?>