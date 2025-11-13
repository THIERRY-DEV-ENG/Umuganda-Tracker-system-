<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Support | Umuganda Tracker</title>
    <style>
    
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: #f5f5f5;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    
    .header-bar {
        height: 8px;
        background: linear-gradient(to right, #00A1DE 33%, #FAD201 33%, #00A651 66%);
    }
    
    header {
        background: white;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .logo {
        font-size: 2rem;
        font-weight: bold;
        color: #00A1DE;
    }
    
    .logo span {
        color: #00A651;
    }
    
    
    nav {
        display: flex;
        align-items: center;
    }
    
    nav a, .dropbtn {
        display: inline-block;
        padding: 8px 15px;
        text-decoration: none;
        color: #333;
        margin: 0 5px;
    }
    
    nav a:hover, .dropbtn:hover {
        background: #00A1DE;
        color: white;
        border-radius: 4px;
    }
    
    
    .dropdown {
        position: relative;
        display: inline-block;
    }
    
    .dropdown-content {
        display: none;
        position: absolute;
        background: white;
        min-width: 160px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        z-index: 1;
    }
    
    .dropdown:hover .dropdown-content {
        display: block;
    }
    
    .dropdown-content a {
        display: block;
        padding: 10px 15px;
    }
    
    
    .content {
        max-width: 500px;
        margin: 50px auto;
        padding: 30px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        flex: 1; 
    }
    
    h2 {
        color: #00A1DE;
        text-align: center;
    }
    
    
    footer {
        background: #00A1DE;
        color: white;
        text-align: center;
        padding: 15px;
        margin-top: auto; 
        width: 100%;
    }
    </style>
</head>
<body>
    <div class="header-bar"></div>
    <header>
        <h1 class="logo">Umuganda <span>Tracker</span></h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <div class="dropdown">
                <span class="dropbtn">Contact</span>
                <div class="dropdown-content">
                    <a href="login.php">Login</a>
                    <a href="register.php">Signup</a>
                    <a href="support.php">Support</a>
                </div>
            </div>
        </nav>
    </header>
    
    <div class="content">
        <h2>Support</h2>
        <p>For assistance, contact us at: <a href="mailto:support@umugandatracker.rw">support@umugandatracker.rw</a></p>
        <p>Phone: +250780889631</p>
    </div>
    
    <footer>
        <p>© 2025 Umuganda Tracker | Republic of Rwanda</p>
    </footer>
</body>
</html>