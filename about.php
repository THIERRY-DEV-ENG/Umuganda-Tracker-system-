<?php
include 'config.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | Umuganda Tracker</title>
    <style>
        :root {
            --blue: #00A1DE;
            --yellow: #FAD201;
            --green: #00A651;
        }

        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            margin: 0;
            background: linear-gradient(135deg, var(--blue) 0%, var(--yellow) 50%, var(--green) 100%);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: #333;
            font-size: 16px;
        }

        h1, h2 {
            font-family: 'Roboto', 'Arial', sans-serif;
            font-weight: 700;
        }

        .header-bar {
            height: 8px;
            background: linear-gradient(to right, var(--blue) 33%, var(--yellow) 33%, var(--green) 66%);
        }

        header {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            text-align: left;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .logo {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--blue);
            margin: 0;
        }

        .logo span {
            color: var(--green);
        }

        .menu-btn {
            display: none;
            font-size: 1.5rem;
            background: none;
            border: none;
            color: var(--blue);
            cursor: pointer;
        }

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
            transition: background 0.3s, color 0.3s;
        }

        nav a:hover {
            background: var(--blue);
            color: white;
            text-decoration: underline;
        }

        .main-content {
            flex: 1 0 auto;
        }

        .about-container {
            max-width: 850px;
            margin: 30px auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .about-container h2 {
            font-size: 2rem;
            line-height: 1.3;
            color: var(--blue);
        }

        .about-container p {
            color: #333;
            font-size: 1.1rem;
            text-align: left;
            font-weight: 400;
        }

        ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        footer {
            flex-shrink: 0;
            background: var(--blue);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto;
            width: 100%;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            font-size: 1.1rem;
        }

        @media (max-width: 600px) {
            .menu-btn {
                display: block;
                position: absolute;
                top: 15px;
                right: 15px;
            }

            header {
                padding: 15px;
            }

            .logo {
                font-size: 1.5rem;
            }

            nav {
                display: none;
            }

            nav.active {
                display: flex;
                flex-direction: column;
                position: absolute;
                top: 50px;
                left: 0;
                width: 100%;
                background: rgba(255, 255, 255, 0.9);
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            nav.active a {
                width: 100%;
                padding: 15px;
                box-sizing: border-box;
            }

            .about-container {
                margin: 20px auto;
                padding: 20px;
            }

            body {
                font-size: 14px;
            }

            .about-container h2 {
                font-size: 1.6rem;
            }
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
            window.dispatchEvent(new Event('scroll'));
        });

        window.addEventListener('scroll', () => {
            const aboutSection = document.querySelector('.about-container');
            const sectionTop = aboutSection.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            if (sectionTop < windowHeight - 100) {
                aboutSection.style.opacity = '1';
                aboutSection.style.transform = 'translateY(0)';
            }
        });
    </script>
</head>
<body>
    <div class="header-bar"></div>
    <header>
        <div class="logo">Umuganda <span>Tracker</span></div>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
        </nav>
    </header>
    <div class="main-content">
        <section class="about-container">
            <h2>About Umuganda Tracker</h2>
            <p>Umuganda Tracker is a digital platform designed to enhance community participation in Rwanda's monthly Umuganda tradition. This initiative empowers citizens to contribute to nation-building by tracking their involvement and receiving recognition.</p>
            <h3>Our Purpose</h3>
            <ul>
                <li>Promote active participation in Umuganda activities.</li>
                <li>Provide a transparent way to document community work.</li>
                <li>Issue digital certificates to honor contributors.</li>
            </ul>
            <h3>Features</h3>
            <ul>
                <li>Registration and login for all Rwandans.</li>
                <li>Ability to upload proof after submitting two photos.</li>
                <li>Downloadable certificate upon validation.</li>
                <li>Admin tools to monitor community engagement.</li>
            </ul>
            <h3>Impact</h3>
            <p>By using Umuganda Tracker, communities grow stronger, environments improve, and individuals take pride in their contributions. Supported by the Rwanda Ministry of Local Government, this project fosters a culture of unity and progress.</p>
        </section>
    </div>
    <footer>
        <p>© 2025 Umuganda Tracker | Republic of Rwanda</p>
    </footer>
</body>
</html>