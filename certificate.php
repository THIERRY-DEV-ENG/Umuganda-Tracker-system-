<?php
include 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT gps_coordinates, MIN(timestamp) as start_time, MAX(timestamp) as end_time
        FROM photos
        WHERE user_id = ?
        GROUP BY gps_coordinates
        HAVING COUNT(*) >= 2";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$participation = $result->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Umuganda Certificate</title>
    <style>
    
    :root {
        --blue: #00A1DE;
        --yellow: #FAD201;
        --green: #00A651;
    }

    
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        background: #f9f9f9;
    }


    .certificate {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    
    .certificate h1 {
        color: var(--blue);
        font-size: 2.5rem;
        margin-bottom: 20px;
    }

    .certificate h2 {
        color: var(--green);
        font-size: 1.8rem;
        margin: 10px 0;
    }

    
    .details {
        margin: 20px 0;
    }

    .details p {
        color: #333;
        font-size: 1.1rem;
        margin: 5px 0;
    }

    .instructions {
        color: #666;
        font-size: 0.9rem;
        margin-top: 20px;
    }

    
    @media print {
        body {
            background: none;
        }
        .certificate {
            box-shadow: none;
        }
    }
    </style>
</head>
<body>
    <header>
        <header>
        <nav>
            <a href="dashboard.php">Back to Dashboard</a>
        </nav>
    </header>
    <div class="certificate">
        <h1>Umuganda Participation Certificate</h1>
        <p>This certifies that you have participated in umuganda program:</p>
        <h2><?php echo htmlspecialchars($_SESSION['name']); ?></h2>
        
        <p class="instructions">To save as PDF, use 'Print' (Ctrl+P or Cmd+P) and select 'Save as PDF'.</p>
    </div>
</body>
</html>