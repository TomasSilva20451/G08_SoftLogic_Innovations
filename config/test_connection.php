<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
phpinfo();

$serverName = "MATEBOOK-TELMO";
$connectionOptions = array(
    "Database" => "PMotors",
    "UID" => "telmosilva",
    "PWD" => "Administrador13579"
);

// Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn) {
    echo "Connection established.<br>";
    
    // Retrieves some data from the database
    $tsql = "SELECT * from Vehicle";
    $stmt = sqlsrv_query($conn, $tsql);
    
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo $row['CustomerID'] . ", " . $row['Name'] . "<br>";
    }
    
    sqlsrv_free_stmt($stmt);
} else {
    die("Connection could not be established.");
}

?>