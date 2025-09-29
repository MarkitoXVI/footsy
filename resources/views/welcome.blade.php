<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footsy</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3a5ee5;
            --primary-dark: #2a48c5;
            --secondary: #34c759;
            --dark: #1a2238;
            --light: #f8f9fa;
            --gray: #6c757d;
            --gradient: linear-gradient(135deg, var(--primary), var(--primary-dark));
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            color: var(--dark);
            background-color: var(--light);
            line-height: 1.6;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header Styles */
        header {
            background: var(--gradient);
            padding: 1.5rem 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 100;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            font-weight: 700;
            font-size: 1.8rem;
            text-decoration: none;
        }
        
        .logo-icon {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: bold;
        }
        
        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s;
        }
        
        .nav-links a:hover {
            opacity: 0.8;
        }
        
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .btn-primary {
            background: white;
            color: var(--primary);
        }
        
        .btn-primary:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .btn-outline {
            border: 2px solid white;
            color: white;
            background: transparent;
        }
        
        .btn-outline:hover {
            background: white;
            color: var(--primary);
            transform: translateY(-2px);
        }
        
        /* Hero Section */
        .hero {
            position: relative;
            padding: 6rem 0;
            background: var(--gradient);
            color: white;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 60%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle cx="100" cy="100" r="80" fill="white" opacity="0.05"/></svg>') no-repeat center right;
            background-size: cover;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 600px;
        }
        
        .hero h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 3.5rem;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }
        
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .hero-buttons {
            display: flex;
            gap: 1rem;
        }
        
        /* Features Section */
        .features {
            padding: 5rem 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .section-title h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.5rem;
            color: var(--dark);
            margin-bottom: 1rem;
        }
        
        .section-title p {
            color: var(--gray);
            max-width: 600px;
            margin: 0 auto;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .feature-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: white;
            font-size: 1.5rem;
        }
        
        .feature-card h3 {
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 1rem;
        }
        
        .feature-card p {
            color: var(--gray);
        }
        
        /* How It Works */
        .how-it-works {
            padding: 5rem 0;
            background: #f0f4ff;
        }
        
        .steps {
            display: flex;
            justify-content: space-between;
            max-width: 900px;
            margin: 0 auto;
        }
        
        .step {
            text-align: center;
            flex: 1;
            position: relative;
            padding: 0 1.5rem;
        }
        
        .step-number {
            width: 50px;
            height: 50px;
            background: var(--gradient);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            margin: 0 auto 1.5rem;
        }
        
        .step h3 {
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 1rem;
        }
        
        .step p {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        /* CTA Section */
        .cta {
            padding: 5rem 0;
            text-align: center;
            background: var(--gradient);
            color: white;
        }
        
        .cta h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }
        
        .cta p {
            max-width: 600px;
            margin: 0 auto 2rem;
            opacity: 0.9;
        }
        
        .cta .btn {
            background: white;
            color: var(--primary);
            padding: 1rem 2rem;
            font-size: 1.1rem;
        }
        
        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: 3rem 0;
            text-align: center;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .footer-links a {
            color: white;
            text-decoration: none;
            transition: opacity 0.3s;
        }
        
        .footer-links a:hover {
            opacity: 0.8;
        }
        
        .copyright {
            opacity: 0.7;
            font-size: 0.9rem;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero-buttons {
                flex-direction: column;
            }
            
            .steps {
                flex-direction: column;
                gap: 2rem;
            }
            
            .nav-links {
                display: none;
            }
            
            .mobile-menu-btn {
                display: block;
            }
        }
    </style>
</head>
<body>
    <!-- Header with Navigation -->
    <header>
        <div class="container">
            <nav>
                <a href="#" class="logo">
                    <div class="logo-icon">F</div>
                    Footsy
                </a>
                <div class="nav-links">
                    <a href="#">Features</a>
                    <a href="#">How It Works</a>
                    <a href="#">Pricing</a>
                    <a href="{{ route('login') }}" class="btn btn-outline">Log In</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Build Your Ultimate Fantasy Football Team</h1>
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
                    <div class="feature-icon">⚽</div>
                    <h3>Real Player Stats</h3>
                    <p>Access real-time player statistics and performance data to make informed decisions for your fantasy team.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🏆</div>
                    <h3>Compete in Leagues</h3>
                    <p>Create private leagues with friends or join public leagues to compete against managers worldwide.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
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
                &copy; 2023 Footsy - Fantasy Football Platform. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        // Simple animation for feature cards on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const featureCards = document.querySelectorAll('.feature-card');
            
            function checkScroll() {
                featureCards.forEach(card => {
                    const cardPosition = card.getBoundingClientRect().top;
                    const screenPosition = window.innerHeight / 1.3;
                    
                    if (cardPosition < screenPosition) {
                        card.style.opacity = 1;
                        card.style.transform = 'translateY(0)';
                    }
                });
            }
            
            // Initial state for animation
            featureCards.forEach(card => {
                card.style.opacity = 0;
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            });
            
            window.addEventListener('scroll', checkScroll);
            checkScroll(); // Check on initial load
        });
    </script>
</body>
</html>