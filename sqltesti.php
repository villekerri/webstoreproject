<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'webstore');
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
} else {
    echo "Connection to the database works. <br>";
}

$createuser = "INSERT INTO users (userid, username, password, address) VALUES (99, 'kayttaja', 'salasana', 'osoite')";

if (mysqli_query($link, $createuser)) {
    echo "User added. <br>";
} else {
    echo "Adding user failed: " . $createuser . "<br>" . mysqli_error($link) . "<br>";
}

$searchuser = "SELECT userid, username, password FROM users WHERE userid=99";
$result = mysqli_query($link, $searchuser);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row["userid"]. " - username: " . $row["username"]. " - password: " . $row["password"]. "<br>";
    }
} else {
    echo "0 results. <br>";
}

$deleteuser = "DELETE FROM users WHERE userid=99";

if (mysqli_query($link, $deleteuser)) {
    echo "User deleted. <br>";
} else {
    echo "Deleting user failed: " . mysqli_error($link) . "<br>";
}

function addproduct($link, $productid, $productname, $producttype, $productprice, $productquantity){
    $createproduct = "INSERT INTO product (productid, productname, producttype, productprice, productquantity) VALUES ($productid, '$productname', '$producttype', $productprice, $productquantity)";
    if (mysqli_query($createproduct, $link)){
        echo "Product " . $productname . " added. <br>";
    } else {
        echo "Failed to add the product: " . $createproduct . "<br>";
    }
}

function getproducts($link){
    $getproducts = "SELECT productname, productprice, productquantity FROM product";
    $result = mysqli_query($link, $getproducts);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "Product: " . $row["productname"]. " - Price: " . $row["productprice"]. " Quantity:" . $row["productquantity"]. "<br>";
        }
    } else {
        echo "0 results. <br>";
    }
}

function deleteproduct($link, $id){
    $deleteproduct = "DELETE FROM product WHERE productid='$id'";
    if (mysqli_query($link, $deleteproduct)) {
        echo "Product removed. <br>";
    } else {
        echo "Removing product failed: " . mysqli_error($link) . "<br>";
    }
}

mysqli_close($link);

?>