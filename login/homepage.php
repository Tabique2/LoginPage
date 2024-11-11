<?php
session_start();
include("connect.php");

$sql = "SELECT Users.firstName, Users.lastName, Users.email, Profiles.bio, Profiles.age
        FROM Users
        LEFT JOIN Profiles ON Users.id = Profiles.user_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beautiful Landing Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Landing Page Header -->
<header>
    <div class="navbar">
        <h1 class="brand-name">My Beautiful Landing Page</h1>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- Main Content Section -->
<section class="content">
    <h2>Our Users</h2>
    <table class="user-table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Bio</th>
                <th>Age</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row["firstName"]); ?></td>
                    <td><?php echo htmlspecialchars($row["lastName"]); ?></td>
                    <td><?php echo htmlspecialchars($row["email"]); ?></td>
                    <td><?php echo $row["bio"] ? htmlspecialchars($row["bio"]) : 'No bio available'; ?></td>
                    <td><?php echo $row["age"] ? htmlspecialchars($row["age"]) : 'N/A'; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2024 Beautiful Landing Page</p>
</footer>

<style>

    /* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Body */
body {
    background-color: #f9f9f9;
    color: #333;
}

/* Header */
header {
    background-color: #3498db;
    padding: 20px;
    color: white;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar h1 {
    font-size: 28px;
}

nav ul {
    list-style-type: none;
    display: flex;
}

nav ul li {
    margin: 0 15px;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    transition: color 0.3s ease;
}

nav ul li a:hover {
    color: #ecf0f1;
}

/* Content */
.content {
    padding: 40px 10%;
    text-align: center;
}

h2 {
    font-size: 32px;
    margin-bottom: 20px;
    color: #2c3e50;
}

.user-table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

.user-table th, .user-table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: left;
}

.user-table th {
    background-color: #3498db;
    color: white;
}

.user-table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

.user-table tbody tr:hover {
    background-color: #ecf0f1;
}

/* Footer */
footer {
    background-color: #2c3e50;
    color: white;
    text-align: center;
    padding: 15px 0;
    position: fixed;
    width: 100%;
    bottom: 0;
}

</style>

</body>
</html>
