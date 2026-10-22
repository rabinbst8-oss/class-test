
<?php
// Connect to MySQL database
$host = "mi-linux.wlv.ac.uk";
$username = "2440245";
$password = "Rabinbst123*";
$database = "db2440245";

$conn = new mysqli($host, $username, $password, $database);

// Check database connection
if ($conn->connect_error) {
    die("Database connection failed.");
}

// Get books from the database
$sql = "SELECT Book_name, Genre, Price, Date_of_release FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Books</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f4f4f4;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #2874a6;
            color: white;
        }

        tr:nth-child(even) {
            background: #eee;
        }
    </style>
</head>
<body>

<h1>Book List</h1>

<table>
    <tr>
        <th>Book name</th>
        <th>Genre</th>
        <th>Price (£)</th>
        <th>Date of release</th>
    </tr>

    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["Book_name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["Genre"]) . "</td>";
            echo "<td>£" . number_format((float)$row["Price"], 2) . "</td>";
            echo "<td>" . date(
                "d/m/Y",
                strtotime($row["Date_of_release"])
            ) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No books found</td></tr>";
    }

    $conn->close();
    ?>
</table>

</body>
</html>
