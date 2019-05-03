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
}

$createuser = "INSERT INTO users (username, password, userid, address) VALUES ('kayttaja', 'salasana', 1, 'osoite')";

if (mysqli_query($link, $createuser)) {
    echo "onnistui. ";
} else {
    echo "ei onnistunut: " . $createuser . "<br>" . mysqli_error($link);
}

$searchuser = "SELECT username, password, userid FROM users WHERE userid=1";
$result = mysqli_query($link, $searchuser);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "user: " . $row["username"]. " - password: " . $row["password"]. " id:" . $row["userid"]. "<br>";
    }
} else {
    echo "0 results";
}

$deleteuser = "DELETE FROM users WHERE userid=1";

if (mysqli_query($link, $deleteuser)) {
    echo "käyttäjä poistettu. ";
} else {
    echo "ei onnistunut" . mysqli_error($link);
}

$productid = 'tuote';
$productname = 'pusero';
$producttype = 'paita';
$productprice = 12.4;
$productquantity = 30;

$uusituote = "INSERT INTO product (productid, productname, producttype, productprice, productquantity) VALUES ('$productid', '$productname', '$producttype', $productprice, $productquantity)";


if (mysqli_query($link, $uusituote)) {
    echo "onnistui. ";
} else {
    echo "ei onnistunut: " . $uusituote . "<br>" . mysqli_error($link);
}
$poistatuote = "DELETE FROM product WHERE productid='tuote'";

if (mysqli_query($link, $poistatuote)) {
    echo "tuote poistettu. ";
} else {
    echo "ei onnistunut" . mysqli_error($link);
}


function addproduct($link, $productid, $productname, $producttype, $productprice, $productquantity){
    $createproduct = "INSERT INTO product (productid, productname, producttype, productprice, productquantity) VALUES ('$productid', '$productname', '$producttype', $productprice, $productquantity)";
    if (mysqli_query($createproduct, $link)){
        echo "Tuote " . $productname . " lisätty. ";
    } else {
        echo "Tuotetta ei lisätty. " . $createproduct . "<br>";
    }
}

function getproducts($link){
    $getproducts = "SELECT productname, productprice, productquantity FROM product";
    $result = mysqli_query($link, $getproducts);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "Product: " . $row[""]. " - password: " . $row["password"]. " id:" . $row["userid"]. "<br>";
        }
    } else {
        echo "0 results. ";
    }
}

function deleteproduct($link, $id){
    $deleteproduct = "DELETE FROM product WHERE productid='$id'";
    if (mysqli_query($link, $deleteproduct)) {
        echo "tuote poistettu. ";
    } else {
        echo "ei onnistunut " . mysqli_error($link);
    }
}

addproduct($link, 'hattu', 'Hattu', 'Vaate', 1, 10);
addproduct($link, 'huivi', 'Huivi', 'Vaate', 1, 7);
addproduct($link, 'leipa', 'Leipa', 'Elintarvike', 1, 46);

getproducts($link);

deleteproduct($link, 'hattu');
deleteproduct($link, 'huivi');
deleteproduct($link, 'leipa');





















mysqli_close($link);


?>