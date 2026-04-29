<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footsy - Ultimate Fantasy Football Experience</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3a5ee5;
            --primary-dark: #2a48c5;
            --primary-light: #5b7ae8;
            --secondary: #34c759;
            --dark: #1a2238;
            --light: #f8f9fa;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --gradient: linear-gradient(135deg, var(--primary), var(--primary-dark));
            --gradient-light: linear-gradient(135deg, #e8edff, #dce4ff);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            color: var(--dark);
            background: linear-gradient(135deg, #f0f4ff 0%, #e8edff 50%, #f5f7ff 100%);
            line-height: 1.6;
            min-height: 100vh;
            position: relative;
        }
        
        /* Background decoration */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(58, 94, 229, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 90% 80%, rgba(58, 94, 229, 0.05) 0%, transparent 50%),
                repeating-linear-gradient(45deg, rgba(58, 94, 229, 0.02) 0px, rgba(58, 94, 229, 0.02) 2px, transparent 2px, transparent 8px);
            pointer-events: none;
            z-index: 0;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }
        
        /* Header Styles */
        header {
            background: rgba(26, 34, 56, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(58, 94, 229, 0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(58, 94, 229, 0.2);
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            font-weight: 800;
            font-size: 1.8rem;
            text-decoration: none;
            font-family: 'Montserrat', sans-serif;
        }
        
        .logo-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.4rem;
            box-shadow: 0 4px 15px rgba(58, 94, 229, 0.3);
        }
        
        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-links a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            font-size: 1rem;
        }
        
        .nav-links a:hover {
            color: white;
            transform: translateY(-2px);
        }
        
        .btn {
            display: inline-block;
            padding: 0.75rem 1.8rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 0.95rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 4px 15px rgba(58, 94, 229, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(58, 94, 229, 0.4);
        }
        
        .btn-outline {
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            background: transparent;
        }
        
        .btn-outline:hover {
            background: white;
            color: var(--primary);
            transform: translateY(-2px);
            border-color: white;
        }
        
        /* Hero Section */
        .hero {
            min-height: 90vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, var(--dark) 0%, var(--primary-dark) 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .hero-content {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem 0;
        }

        .hero h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 3.8rem;
            line-height: 1.1;
            font-weight: 800;
            margin-bottom: 1.5rem;
        }

        .hero p {
            font-size: 1.25rem;
            max-width: 600px;
            margin: 0 auto 2.5rem;
            opacity: 0.9;
        }

        .hero-buttons {
            display: flex;
            justify-content: center;
            gap: 1.2rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.9rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.05rem;
        }

        .btn-primary {
            background: white;
            color: var(--primary-dark);
        }

        .btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .btn-outline {
            border: 2px solid rgba(255,255,255,0.6);
            color: white;
        }

        .btn-outline:hover {
            background: white;
            color: var(--primary-dark);
        }
        
        /* Features Section */
        .features {
            padding: 5rem 0;
            position: relative;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .section-title h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .section-title p {
            color: var(--gray);
            max-width: 600px;
            margin: 0 auto;
            font-size: 1.1rem;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .feature-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            transition: all 0.3s ease;
            border: 1px solid rgba(58, 94, 229, 0.15);
            text-align: center;
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(58, 94, 229, 0.15);
            background: white;
            border-color: rgba(58, 94, 229, 0.3);
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 1.8rem;
            box-shadow: 0 8px 20px rgba(58, 94, 229, 0.2);
        }
        
        .feature-card h3 {
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }
        
        .feature-card p {
            color: var(--gray);
        }
        
        /* How It Works */
        .how-it-works {
            padding: 5rem 0;
            background: linear-gradient(135deg, rgba(58, 94, 229, 0.05), rgba(58, 94, 229, 0.02));
            position: relative;
        }
        
        .steps {
            display: flex;
            justify-content: space-between;
            max-width: 1000px;
            margin: 0 auto;
            gap: 1rem;
        }
        
        .step {
            text-align: center;
            flex: 1;
            position: relative;
            padding: 2rem 1.5rem;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            transition: all 0.3s ease;
            border: 1px solid rgba(58, 94, 229, 0.1);
        }
        
        .step:hover {
            transform: translateY(-5px);
            background: white;
            box-shadow: 0 10px 30px rgba(58, 94, 229, 0.1);
        }
        
        .step-number {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.3rem;
            margin: 0 auto 1.5rem;
            box-shadow: 0 4px 12px rgba(58, 94, 229, 0.3);
        }
        
        .step h3 {
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }
        
        .step p {
            color: var(--gray);
            font-size: 0.95rem;
        }
        
        /* CTA Section */
        .cta {
            padding: 5rem 0;
            text-align: center;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .cta::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: pulse 4s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 0.5;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }
        }
        
        .cta h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
            position: relative;
            z-index: 1;
        }
        
        .cta p {
            max-width: 600px;
            margin: 0 auto 2rem;
            opacity: 0.9;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }
        
        .cta .btn {
            background: white;
            color: var(--primary);
            padding: 1rem 2rem;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }
        
        .cta .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        
        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: 3rem 0;
            text-align: center;
            position: relative;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .footer-links a:hover {
            color: white;
            transform: translateY(-2px);
        }
        
        .social-icons {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .social-icons a {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .social-icons a:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }
        
        .copyright {
            opacity: 0.6;
            font-size: 0.9rem;
        }
        
        /* Floating shapes */
        .floating-shape {
            position: fixed;
            background: linear-gradient(135deg, rgba(58, 94, 229, 0.08), rgba(58, 94, 229, 0.03));
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }
        
        .shape-1 {
            width: 300px;
            height: 300px;
            top: 20%;
            left: -100px;
        }
        
        .shape-2 {
            width: 400px;
            height: 400px;
            bottom: 10%;
            right: -150px;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .steps {
                flex-wrap: wrap;
            }
            
            .step {
                min-width: calc(50% - 1rem);
            }
        }
        
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero-buttons {
                flex-direction: column;
            }
            
            .steps {
                flex-direction: column;
            }
            
            .step {
                min-width: auto;
            }
            
            .nav-links {
                display: none;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
            
            .cta h2 {
                font-size: 1.8rem;
            }
        }
        
        @media (max-width: 576px) {
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .footer-links {
                flex-direction: column;
                gap: 1rem;
            }
        }
        
        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate {
            animation: fadeInUp 0.6s ease forwards;
        }
    </style>
</head>
<body>
    <!-- Floating shapes -->
    <div class="floating-shape shape-1"></div>
    <div class="floating-shape shape-2"></div>

    <!-- Header with Navigation -->
    <header>
        <div class="container">
            <nav>
                <a href="{{ route('home') }}" class="logo">
                    <div class="logo-icon">F</div>
                    Footsy
                </a>
                <div class="nav-links">
                    <a href="{{ route('features') }}">Features</a>
                    <a href="{{ route('how-it-works') }}">How It Works</a>
                    <a href="{{ route('login') }}" class="btn btn-outline">Log In</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section - Now Perfectly Centered -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Build Your Ultimate<br>Fantasy Football Team</h1>
                <p>Join thousands of football fans managing their fantasy teams, competing with friends, and proving their managerial skills.</p>
                <div class="hero-buttons">
                    <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                    <a href="#" class="btn btn-outline">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="section-title">
                <h2>Why Choose Footsy?</h2>
                <p>Experience fantasy football like never before with our powerful features</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-futbol"></i>
                    </div>
                    <h3>Real Player Stats</h3>
                    <p>Access real-time player statistics and performance data to make informed decisions for your fantasy team.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3>Compete in Leagues</h3>
                    <p>Create private leagues with friends or join public leagues to compete against managers worldwide.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Live Points Tracking</h3>
                    <p>Watch your points update in real-time as matches progress with our advanced live scoring system.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works">
        <div class="container">
            <div class="section-title">
                <h2>How It Works</h2>
                <p>Get started with Footsy in just a few simple steps</p>
            </div>
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Sign Up</h3>
                    <p>Create your free account and set up your profile</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h3>Build Your Team</h3>
                    <p>Select players within your budget to create your fantasy squad</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Join Leagues</h3>
                    <p>Compete against friends or join public leagues</p>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <h3>Track & Manage</h3>
                    <p>Monitor your team's performance and make transfers</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta">
        <div class="container">
            <h2>Ready to Build Your Fantasy Team?</h2>
            <p>Join thousands of football enthusiasts who are already enjoying the ultimate fantasy football experience with Footsy.</p>
            <a href="{{ route('register') }}" class="btn">Sign Up Now</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">     
            <div class="footer-links">
                <a href="#">About Us</a>
                <a href="#">Terms of Service</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Contact</a>
                <a href="#">Help Center</a>
            </div>
            <div class="copyright">
                &copy; 2025 Footsy - Fantasy Football Platform. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        // Animation for feature cards on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const animatedElements = document.querySelectorAll('.feature-card, .step');
            
            function checkScroll() {
                animatedElements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const screenPosition = window.innerHeight / 1.2;
                    
                    if (elementPosition < screenPosition) {
                        element.classList.add('animate');
                    }
                });
            }
            
            // Add initial class for animation
            animatedElements.forEach(element => {
                element.style.opacity = '0';
            });
            
            window.addEventListener('scroll', checkScroll);
            checkScroll(); // Check on initial load
        });
    </script>
</body>
</html>