<?php
class Database
{
    private $db;

    /**
     * Constructor to initialize the database connection.
     *
     * @param string $host The hostname of the database server.
     * @param string $dbname The name of the database.
     * @param string $username The username for the database connection.
     * @param string $password The password for the database connection.
     */
    public function __construct($host, $dbname, $username, $password)
    {
        // Use the $dbname parameter dynamically
        $dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";

        try {
            $this->db = new PDO($dsn, $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit();
        }
    }

    /**
     * Executes a SQL query with optional parameters.
     *
     * @param string $sql The SQL query to execute.
     * @param array $params The parameters to bind to the query.
     * @return PDOStatement The result of the executed query.
     */
    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}

// ------------------------
// Connect to Railway DB
// ------------------------
$host = "maglev.proxy.rlwy.net";
$dbname = "railway"; // Your Railway database name
$username = "root";
$password = "llwRSjTkpowntofUGcLqEzHQOgOvCLCW";

// Create a new Database instance
$database = new Database($host, $dbname, $username, $password);

// Test the connection
try {
    $stmt = $database->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo "✅ Connected successfully! Tables in database:<br>";
    foreach ($tables as $table) {
        echo $table . "<br>";
    }
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}
?>
