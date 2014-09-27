

<?php


$conn; 

$dbconfig = array(
    'host'      => 'localhost',
    'dbname'    => 'elmnainen',
    'username'  => 'elmnainen',
    'password'  => 'ZJg3K3wI',
    'prefix'    => 'shoppinglist_'
);

$dbconfig["dsn"] = "mysql:host=" . $dbconfig["host"] . ";dbname=" . $dbconfig["dbname"];

try{
            
    $conn = new PDO($dbconfig["dsn"], $dbconfig["username"], $dbconfig["password"]);

    //set errmode to exception to get all the juicy bits
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    $error = $e;

}
/*
foreach( $conn->query("SELECT * FROM shoppinglist_items") as $row){
    var_dump($row);
}
  */      
var_dump($conn);