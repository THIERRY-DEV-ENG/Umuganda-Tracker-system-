<?php
include 'config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $national_id = $_POST['national_id'];
    $zone = $_POST['sector'];
    $password = hash('sha256', $national_id . $name);
    $stmt = $conn->prepare("INSERT INTO users (username, phone_number, national_id, zone, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $phone, $national_id, $zone, $password);
    if ($stmt->execute()) {
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE phone_number = ? AND national_id = ?");
        $stmt->bind_param("ss", $phone, $national_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $name;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Registration failed. Phone or ID may exist.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Umuganda Tracker</title>
    <style>
        :root { --blue: #00A1DE; --yellow: #FAD201; --green: #00A651; }
        body { font-family: Arial, sans-serif; margin: 0; background: #f9f9f9; }
        .flag-bar { height: 8px; background: linear-gradient(to right, var(--blue) 33%, var(--yellow) 33%, var(--green) 66%); }
        header {
            padding: 20px;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex; 
            justify-content: space-between; 
            align-items: center;
        }
        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: var(--blue);
            margin: 0; 
        }
        .logo span { color: var(--green); }
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
        nav a:hover { background: var(--blue); color: white; }
        .register-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; color: #333; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button {
            background: var(--green);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            width: 100%;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover { background: var(--yellow); color: #333; }
        #error-message { color: #EF3340; text-align: center; margin-bottom: 15px; }
        .link { text-align: center; margin-top: 15px; }
        .link a { color: var(--blue); text-decoration: none; }
        .link a:hover { text-decoration: underline; }
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
            <a href="index.php">Home</a>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </nav>
    </header>
    <div class="register-container">
        <h2>Register</h2>
        <div id="error-message"><?php echo isset($error) ? $error : ''; ?></div>
        <form method="POST">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="+25078XXXXXXX" required>
            </div>
            <div class="form-group">
                <label for="national_id">National ID</label>
                <input type="text" id="national_id" name="national_id" placeholder="12005XXXXXXXXXX" required>
            </div>
            <div class="form-group">
                <label for="sector">Sector</label>
                <select id="sector" name="sector" required>
                    <option value="">Select Sector</option>
                    <option value="Gasabo">Gasabo</option>
                    <option value="Kicukiro">Kicukiro</option>
                    <option value="Nyarugenge">Nyarugenge</option>
                </select>
            </div>
            <button type="submit">Register</button>
        </form>
        <div class="link">Already registered? <a href="login.php">Login</a></div>
    </div>
</body>
</html>