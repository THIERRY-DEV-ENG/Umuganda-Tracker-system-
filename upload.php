<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$photo_count = $conn->query("SELECT COUNT(*) as count FROM photos WHERE user_id = $user_id")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Proof | Umuganda Tracker</title>
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        
        .flag-bar {
            height: 8px;
            background: linear-gradient(to right, var(--blue) 33%, var(--yellow) 33%, var(--green) 66%);
        }

        header {
            padding: 20px;
            text-align: center;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: var(--blue);
        }

        .logo span {
            color: var(--green);
        }

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

        nav a:hover {
            background: var(--blue);
            color: white;
        }

        
        .upload-section {
            padding: 40px 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .instruction-card {
            width: 200px;
            padding: 15px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .instruction-card h3 {
            color: var(--blue);
            margin-bottom: 10px;
        }

        .instruction-card p {
            color: #666;
            font-size: 0.9rem;
        }

        .cards {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        
        .btn {
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .btn-yellow {
            background: var(--yellow);
            color: #333;
        }

        .btn-yellow:hover {
            background: var(--green);
            color: white;
        }

        .btn-green {
            background: var(--green);
            color: white;
        }

        .btn-green:hover {
            background: var(--yellow);
            color: #333;
        }

        
        #previewArea img {
            max-width: 200px;
            margin: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        #waitMessage {
            color: var(--green);
            margin-top: 15px;
            font-size: 1.1rem;
        }

        #gpsStatus {
            margin-top: 15px;
            font-size: 1rem;
        }

        #cameraView {
            margin-bottom: 20px;
        }


        footer {
            background: var(--blue);
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
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
    <section class="upload-section">
        <h2>Submit Your Proof</h2>
        <div class="cards">
            <div class="instruction-card">
                <h3>Location</h3>
                <p>Enable GPS to verify your spot</p>
            </div>
            <div class="instruction-card">
                <h3>Photos</h3>
                <p>Take 2 photos 1 hour apart</p>
            </div>
        </div>
        <form id="uploadForm" action="process_upload.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="gps_coords" name="gps_coords">
            <input type="hidden" id="photo_data" name="photo_data">
            <div id="cameraView">
                <video id="video" width="100%" autoplay style="border: 1px solid #ddd; border-radius: 4px;"></video>
                <canvas id="canvas" style="display:none;"></canvas>
            </div>
            <div>
                <button type="button" id="captureBtn" class="btn btn-yellow">Capture Photo</button>
            </div>
            <div id="previewArea"></div>
            <div id="waitMessage"></div>
            <button type="submit" class="btn btn-green" id="submitBtn" disabled>Submit Proof</button>
            <p id="gpsStatus">📍 Waiting for GPS...</p>
        </form>
    </section>
    <footer>
        <p>Republic of Rwanda - Ministry of Local Government</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>