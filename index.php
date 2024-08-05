<?php
// Database connection parameters
$host = 'your-postgresql-host';
$port = '5432'; // Default PostgreSQL port
$dbname = 'your_database_name';
$user = 'your_db_user';
$password = 'your_db_password';

// Create a connection to the PostgreSQL database
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = pg_escape_string($_POST['name']);
    $email = pg_escape_string($_POST['email']);
    
    // Insert data into the database
    $query = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    
    $result = pg_query($conn, $query);
    
    if ($result) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . pg_last_error();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit User Details</title>
</head>
<body>
    <h1>Submit Your Details</h1>
    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
