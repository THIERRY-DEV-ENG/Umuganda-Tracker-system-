<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Umuganda Tracker</title>
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
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            margin-top: 10px;
        }
        nav a, nav .dropbtn {
            text-decoration: none;
            color: #333;
            padding: 8px 15px;
            border-radius: 4px;
            transition: background 0.3s, color 0.3s;
            display: inline-block;
        }
        nav a:hover, nav .dropbtn:hover {
            background: var(--blue);
            color: white;
            text-decoration: underline;
        }
        nav .dropdown {
            position: relative;
            display: inline-block;
        }
        nav .dropbtn {
            cursor: pointer;
        }
        nav .dropdown-content {
            display: none;
            position: absolute;
            background: rgba(255, 255, 255, 0.9);
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 4px;
        }
        nav .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        nav .dropdown-content a:hover {
            background: var(--blue);
            color: white;
        }
        nav .dropdown:hover .dropdown-content {
            display: block;
        }
        .main-content {
            flex: 1 0 auto;
        }
        .welcome, .section {
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
        .welcome h1 {
            font-size: 2.2rem;
            line-height: 1.3;
            text-align: center;
        }
        .section h2 {
            font-size: 2rem;
            line-height: 1.3;
            text-align: center;
        }
        .welcome p, .section p {
            color: #333;
            font-size: 1.1rem;
            text-align: left;
            font-weight: 400;
        }
        .welcome .gallery {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
        }
        .welcome .gallery img {
            width: 300px;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            cursor: pointer;
            position: relative;
        }
        .welcome .gallery img:hover {
            transform: scale(1.03);
        }
        .gallery .tooltip {
            display: none;
            position: absolute;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 0.9rem;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
        }
        .gallery img:hover .tooltip {
            display: block;
        }
        .get-started {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background: var(--green);
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: background 0.3s;
        }
        .get-started:hover {
            background: var(--yellow);
            color: #333;
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
                text-align: left;
                padding: 15px;
            }
            nav {
                display: none;
            }
            nav.active {
                display: block;
                position: absolute;
                top: 50px;
                left: 0;
                width: 100%;
                background: rgba(255, 255, 255, 0.9);
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
            }
            nav a, nav .dropbtn {
                width: 100%;
                text-align: left;
                padding: 15px;
            }
            nav .dropdown {
                width: 100%;
            }
            nav .dropdown-content {
                position: static;
                width: 100%;
                box-shadow: none;
            }
            nav .dropdown-content a {
                padding: 15px;
            }
            .welcome .gallery {
                flex-direction: column;
            }
            .welcome .gallery img {
                width: 100%;
                height: auto;
            }
            body {
                font-size: 14px;
            }
            .welcome h1 {
                font-size: 1.8rem;
            }
            .section h2 {
                font-size: 1.6rem;
            }
            .logo {
                font-size: 2rem;
            }
            footer {
                padding: 10px;
            }
            .get-started {
                padding: 10px 20px;
            }
        }
    </style>
    <script>
        function toggleMenu() {
            document.querySelector('nav').classList.toggle('active');
        }

        
        window.addEventListener('scroll', () => {
            document.querySelectorAll('.welcome, .section').forEach(section => {
                const sectionTop = section.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                if (sectionTop < windowHeight - 100) {
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }
            });
        });

        
        window.addEventListener('load', () => {
            window.dispatchEvent(new Event('scroll'));

            
            const images = document.querySelectorAll('.welcome .gallery img');
            images.forEach((img, index) => {
            
                const tooltip = document.createElement('div');
                tooltip.className = 'tooltip';
                tooltip.textContent = index === 0 ? 'Joining Umuganda Community' : 'Community Work in Action';
                img.appendChild(tooltip);

                
                img.addEventListener('click', () => {
                    if (!img.classList.contains('zoomed')) {
                        img.style.transform = 'scale(1.5)';
                        img.classList.add('zoomed');
                    } else {
                        img.style.transform = 'scale(1)';
                        img.classList.remove('zoomed');
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="header-bar"></div>
    <main>
      <header>
        <h1 class="logo">Umuganda <span>Tracker</span></h1>
        <button class="menu-btn" onclick="toggleMenu()">☰</button>
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
    </main>
    <div class="main-content">
        <section class="welcome" id="welcome">
            <h1>Welcome to Umuganda Tracker</h1>
            <p>Track your Umuganda participation, submit proof, and earn a certificate to build a stronger Rwanda!</p>
            <div class="gallery">
                <img src="gallery/1.jpeg" alt="Join Umuganda">
                <img src="gallery/2.jpeg" alt="Community Work">
            </div>
            <a href="login.php" class="get-started">Get Started</a>
        </section>
        <section class="section">
            <h2>How It Works</h2>
            <p>Sign up, log in, submit two photos, and download your certificate. It's easy and boosts community growth!</p>
            <div class="government-link">
                <p>Supported by: <a href="https://www.minaloc.gov.rw/" target="_blank">Rwanda Ministry</a></p>
            </div>
        </section>
    </div>
    <footer>
        <p>© 2025 Umuganda Tracker | Republic of Rwanda</p>
    </footer>
</body>
</html>