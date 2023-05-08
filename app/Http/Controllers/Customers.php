<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Show a list of all of the application's users.
     */
    public function index(): View
    {
        $users = DB::select('select * from users where active = ?', [1]);

        return view('user.index', ['users' => $users]);
    }
}

class DatabaseConnection
{
    private $serverName;
    private $connectionOptions;
    private $conn;

    public function __construct($serverName, $database, $UID, $PWD)
    {
        $this->serverName = $serverName;
        $this->connectionOptions = array(
            "Database" => $database,
            "UID" => $UID,
            "PWD" => $PWD
        );
    }

    public function connect()
    {
        $this->conn = sqlsrv_connect($this->serverName, $this->connectionOptions);

        if (!$this->conn) {
            die("Connection could not be established.");
        }
    }

    public function executeQuery($tsql)
    {
        $stmt = sqlsrv_query($this->conn, $tsql);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $result = array();

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $result[] = $row;
        }

        sqlsrv_free_stmt($stmt);

        return $result;
    }

    public function close()
    {
        sqlsrv_close($this->conn);
    }
}

// Usage
error_reporting(E_ALL);
ini_set('display_errors', 1);
phpinfo();

$databaseConnection = new DatabaseConnection(
    "MATEBOOK-TELMO",
    "PMotors",
    "telmosilva",
    "Administrador13579"
);

$databaseConnection->connect();

$result = $databaseConnection->executeQuery("SELECT * from Vehicle");

foreach ($result as $row) {
    echo $row['CustomerID'] . ", " . $row['Name'] . "<br>";
}

$databaseConnection->close();
