<?php
include 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$photo_count = $conn->query("SELECT COUNT(*) as count FROM photos WHERE user_id = $user_id")->fetch_assoc()['count'];
$verified_count = $conn->query("SELECT COUNT(DISTINCT p.photo_id) as count FROM photos p 
    WHERE p.user_id = $user_id AND p.photo_id IN (SELECT photo_id FROM photos GROUP BY photo_id HAVING COUNT(*) = 2)")->fetch_assoc()['count'];


if (!isset($_SESSION['validated']) && $verified_count > 0) {
    $_SESSION['validated'] = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Umuganda Tracker</title>
    <style>
        :root { 
            --blue: #00A1DE; 
            --yellow: #FAD201;
             --green: #00A651; }
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
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }
        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: var(--blue);
            margin: 0;
        }
        .logo span { 
            color: var(--green); }
        nav {
            margin-top: 0;
            display: flex;
            gap: 20px;
        }
        nav a {
            text-decoration: none;
            color: #333;
            padding: 8px 15px;
            border-radius: 4px;
            transition: background 0.3s;
        }
        nav a:hover {
             background: var(--blue); color: white; }
        .dashboard-section {
            padding: 40px 20px;
            text-align: center;
            flex: 1 0 auto;
        }
        .card {
            display: inline-block;
            width: 250px;
            padding: 20px;
            margin: 10px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .card h3 { 
            color: var(--blue);
            margin-bottom: 10px; }
        .card p { 
            margin: 5px 0; 
            color: #666; }
        .btn { 
            padding: 10px 20px; 
            text-decoration: none;
             border-radius: 4px; 
             font-weight: bold; }
        .btn-yellow {
             background: var(--yellow);
              color: #333; }
        .btn-yellow:hover {
             background: var(--green);
              color: white; }
        .btn-blue {
             background: var(--blue); 
             color: white; }
        .btn-blue:hover { 
            background: var(--green); }
        #message { 
            color: var(--green); 
            margin-top: 15px; 
            font-size: 1.1rem; }
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
        @media (max-width: 600px) {
            header { padding: 15px; }
            .logo { font-size: 1.5rem; }
            nav { display: none; }
            nav.active {
                display: flex;
                flex-direction: column;
                position: absolute;
                top: 50px;
                left: 0;
                width: 100%;
                background: white;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                text-align: center;
            }
            nav.active a { width: 100%; padding: 15px; box-sizing: border-box; }
        }
    </style>
    <script>
        function toggleMenu() {
            document.querySelector('nav').classList.toggle('active');
        }
        window.addEventListener('load', () => {
            if (window.innerWidth <= 600) {
                const menuBtn = document.createElement('button');
                menuBtn.className = 'menu-btn';
                menuBtn.innerHTML = '☰';
                menuBtn.onclick = toggleMenu;
                document.querySelector('header').insertBefore(menuBtn, document.querySelector('nav'));
            }
        });
    </script>
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
    <section class="dashboard-section">
        <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
        <div class="card">
            <h3>Your Participation</h3>
            <p>Photos Submitted: <?php echo $photo_count; ?>/2</p>
            <p>Verified Sessions: <?php echo $verified_count; ?></p>
        </div>
        <?php if ($photo_count < 2): ?>
            <a href="upload.php" class="btn btn-yellow">Take Photos</a>
            <div id="message">Submit 2 photos 1 minute apart.</div>
        <?php elseif (isset($_SESSION['validated']) && $_SESSION['validated']): ?>
            <a href="certificate.php" class="btn btn-blue">Download Certificate</a>
            <div id="message">Validation accepted!</div>
        <?php else: ?>
            <div id="message">Awaiting validation...</div>
        <?php endif; ?>
    </section>
    <footer>
        <p>Republic of Rwanda - Ministry of Local Government</p>
    </footer>
</body>
</html>