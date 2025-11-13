<?php
include 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Umuganda Tracker</title>
    <style>
        :root { --blue: #00A1DE; --yellow: #FAD201; --green: #00A651; }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f9f9f9;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .flag-bar { height: 8px; background: linear-gradient(to right, var(--blue) 33%, var(--yellow) 33%, var(--green) 66%); }
        header {
            padding: 20px;
            text-align: center;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: var(--blue);
        }
        .logo span { color: var(--green); }
        nav {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
        }
        nav a {
            text-decoration: none;
            color: #333;
            padding: 8px 15px;
            border-radius: 4px;
        }
        nav a:hover { background: var(--blue); color: white; }
        .admin-section {
            padding: 40px 20px;
            max-width: 1000px;
            margin: 0 auto;
            flex: 1 0 auto;
        }
        .admin-section h2 {
            color: var(--blue);
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th { background: var(--blue); color: white; }
        tr:nth-child(even) { background: #f9f9f9; }
        tr:hover { background: #e0f7fa; }
        footer {
            background: var(--blue);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto;
            width: 100%;
            box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <div class="flag-bar"></div>
    <header>
        <div class="logo">Umuganda <span>Tracker</span></div>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="upload.php">Submit Proof</a>
            <a href="admin.php">Admin</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <section class="admin-section">
        <h2>Participation Overview</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Photos Submitted</th>
                <th>Verified</th>
            </tr>
            <?php
            $result = $conn->query("SELECT u.username, COUNT(p.photo_id) as photo_count,
                CASE
                    WHEN COUNT(p.photo_id) = 2 THEN 'Yes'
                    ELSE 'No'
                END as verified
                FROM users u LEFT JOIN photos p ON u.user_id = p.user_id
                GROUP BY u.user_id, u.username");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                echo "<td>" . ($row['photo_count'] ? $row['photo_count'] : 0) . "</td>";
                echo "<td>" . $row['verified'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </section>
    <footer>
        <p> © 2025 Umuganda Tracker | Republic of Rwanda</p>
    </footer>
</body>
</html>