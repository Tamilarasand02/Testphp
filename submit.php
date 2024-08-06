<?php
// Fetch connection details from environment variables
$db = getenv('DATABASE_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$conn_string = "host=/cloudsql/" . getenv('INSTANCE_CONNECTION_NAME') . " dbname=$db user=$user password=$pass";

// Create connection
$conn = pg_connect($conn_string);

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

$name = $_POST['name'];
$email = $_POST['email'];

// Insert data into the database
$query = "INSERT INTO users (name, email) VALUES ($1, $2)";
$result = pg_query_params($conn, $query, array($name, $email));

if ($result) {
    echo "Details submitted successfully!";
} else {
    echo "Error: " . pg_last_error($conn);
}

// Close the connection
pg_close($conn);
?>
