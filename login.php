<?php
include 'config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phone = $_POST['phone'];
    $national_id = $_POST['national_id'];
    $password = hash('sha256', $national_id . $_POST['name']);
    $stmt = $conn->prepare("SELECT user_id, username FROM users WHERE phone_number = ? AND national_id = ? AND password = ?");
    $stmt->bind_param("sss", $phone, $national_id, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid phone, ID, or name.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Umuganda Tracker</title>
    <style>
        :root { 
            --blue: #00A1DE; 
            --yellow: #FAD201; 
            --green: #00A651; }
        body { 
            font-family: Arial, sans-serif;
             margin: 0; background: #f9f9f9;
              min-height: 100vh; 
              display: flex;
               flex-direction: column; }
        .flag-bar { 
            height: 8px; 
            background: linear-gradient(to right, var(--blue) 33%, var(--yellow) 33%, var(--green) 66%); }
        header {
            padding: 5px; 
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
        .logo span { color: var(--green); }
        nav {
            margin-top: 0;
            display: flex;
            gap: 20px;
        }
        nav a {
            text-decoration: none;
            color: #333;
            padding: 10px 20px; 
            border-radius: 4px;
            transition: background 0.3s;
        }
        nav a:hover { background: var(--blue); color: white; }
        .login-container {
            max-width: 450px; 
            margin: 50px auto; 
            padding: 50px; 
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .register-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .form-group { 
            margin-bottom: 25px; }
        label { 
            display: block; 
            margin-bottom: 8px; 
            color: #333; }
        input { 
            width: 100%; 
            padding: 12px; 
            border: 1px solid #ddd; 
            border-radius: 4px; 
            box-sizing: border-box; }
        input:invalid {
            border-color: #EF3340;
        }
        input:valid {
            border-color: #00A651;
        }
        button {
            background: var(--yellow);
            color: #333;
            border: none;
            padding: 14px; 
            border-radius: 4px;
            width: 100%;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover { 
            background: var(--green); 
            color: white; }
        #error-message { 
            color: #EF3340; 
            text-align: center; 
            margin-bottom: 20px;  }
        .validation-message {
            color: #EF3340;
            font-size: 0.9rem;
            margin-top: 5px;
            display: none;
        }
        .link { 
            text-align: center;
             margin-top: 20px;  }
        .link a { 
            color: var(--blue);
             text-decoration: none; }
        .link a:hover {
             text-decoration: underline; }
        @media (max-width: 600px) {
            header { padding: 20px; }
            .logo { font-size: 2rem;  }
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
            nav.active a { 
                width: 100%;
                 padding: 15px;
                  box-sizing: border-box; }
            .login-container {
                 margin: 30px auto; 
                 padding: 25px; 
                  max-width: 90%;  }
        }
    </style>
    
  
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
    <div class="login-container">
        <h2>Login</h2>
        <div id="error-message"><?php echo isset($error) ? $error : ''; ?></div>
        <form method="POST">
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="+25078XXXXXXX" required>
            </div>
            <div class="form-group">
                <label for="national_id">National ID</label>
                <input type="text" id="national_id" name="national_id" placeholder="12005XXXXXXXXXX" required>
            </div>
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="link">New user? <a href="register.php">Register here</a></div>
    </div>
</body>
</html>