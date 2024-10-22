<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PWL POS - Landing Page</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary-blue: #0066cc;
            --secondary-blue: #003366;
        }

        body {
            background: url('download.jpeg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }

        .header {
            position: fixed;
            top: 0;
            right: 0;
            padding: 20px;
            z-index: 1000;
        }

        .login-btn {
            background-color: var(--primary-blue);
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background-color: var(--secondary-blue);
            color: white;
        }

        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            color: black;
            text-align: center;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('download.jpeg') no-repeat center center;
            background-size: cover;
            filter: blur(5px);
            z-index: 0;
        }

        .hero-content {
            z-index: 1;
            padding: 2rem;
            border-radius: 15px;
            background-color: #EEEDEB;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--primary-blue);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .hero p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            color: var(--secondary-blue);
        }

        .btn-custom {
            background-color: transparent;
            border: 2px solid var(--primary-blue);
            color: var(--primary-blue);
        }

        .btn-custom:hover {
            background-color: var(--primary-blue);
            color: #fff;
        }

        .about-pos {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 80px 20px;
            text-align: center;
            margin: 50px auto;
            max-width: 1200px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .about-pos h2 {
            color: var(--secondary-blue);
            margin-bottom: 30px;
            font-size: 2.5rem;
        }

        .about-pos p {
            color: #444;
            font-size: 1.2rem;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto 20px;
        }



        .footer {
            background-color: var(--secondary-blue);
            color: white;
            padding: 40px 0;
            text-align: center;
            margin-top: 50px;
        }

        .footer h3 {
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        .social-links {
            margin: 20px 0;
        }

        .social-links a {
            color: white;
            margin: 0 10px;
            font-size: 24px;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            color: #ccc;
        }

        .footer p {
            margin: 10px 0;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.2rem;
            }

            .about-pos,
            .pos-web-apps {
                margin: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="{{ 'login' }}" class="login-btn">Masuk</a>
    </header>

    <div class="main-container">
        <section class="hero">
            <div class="hero-content">
                <h1>PWL POS</h1>
                <p>Point Of Sale</p>
                <a href="#about-pos" class="btn btn-custom btn-lg scroll-link">View More</a>
            </div>
        </section>

        <section id="about-pos" class="about-pos">
            <h2>What is POS?</h2>
            <p>A Point of Sale (POS) system is the heart of any retail or restaurant business. It's where all your transactions come together - the moment where customer and business exchange goods or services for payment. Our PWL POS system is more than just a cash register; it's a complete business management solution.</p>
            <p>Modern POS systems like PWL POS handle everything from sales and inventory management to customer relationships and detailed analytics. They help streamline operations, reduce errors, and provide valuable insights into your business performance. With features like real-time inventory tracking, sales reporting, and employee management, PWL POS empowers businesses to make data-driven decisions and grow efficiently.</p>
        </section>


    </div>

    <footer class="footer">
        <div class="container">
            <h3>About Developer</h3>
            <p>Created by Suhatta</p>
            <p>3A - Business Information Systems </p>
            {{-- <div class="social-links">
                <a href="#"><i class="fab fa-github"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div> --}}
            <p>&copy; 2024 PWL POS. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll functionality
        document.querySelectorAll('.scroll-link').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                document.querySelector(targetId).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>