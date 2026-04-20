<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footsy Features - Ultimate Fantasy Football Experience</title>
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

        .features-page {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .back-button-container {
            margin-bottom: 2rem;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s;
            background: rgba(255,255,255,0.95);
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            border: 1px solid rgba(58, 94, 229, 0.2);
        }

        .back-button:hover {
            background: white;
            transform: translateX(-3px);
            box-shadow: 0 4px 12px rgba(58, 94, 229, 0.15);
            border-color: var(--primary);
        }

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-header h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-header p {
            font-size: 1.2rem;
            color: var(--gray);
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(58, 94, 229, 0.15);
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(58, 94, 229, 0.15);
            background: white;
            border-color: rgba(58, 94, 229, 0.3);
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 8px 20px rgba(58, 94, 229, 0.2);
        }

        .feature-card h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .feature-card p {
            color: var(--gray);
            margin-bottom: 1.5rem;
        }

        .feature-list {
            list-style: none;
            margin-top: 1.5rem;
        }

        .feature-list li {
            padding: 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s ease;
        }

        .feature-list li:hover {
            transform: translateX(5px);
        }

        .feature-list li i {
            color: var(--primary);
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .stats-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            margin-bottom: 4rem;
            border: 1px solid rgba(58, 94, 229, 0.15);
        }

        .stats-section h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            text-align: center;
            margin-bottom: 2rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .stat-item {
            text-align: center;
            padding: 1.5rem;
            background: rgba(58, 94, 229, 0.05);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
            background: rgba(58, 94, 229, 0.1);
        }

        .stat-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--gray);
            font-size: 1rem;
            font-weight: 500;
        }

        .cta-section {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border-radius: 16px;
            padding: 3rem 2rem;
            text-align: center;
            margin-bottom: 4rem;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
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

        .cta-section h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2rem;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .cta-section p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .cta-button {
            display: inline-block;
            background: white;
            color: var(--primary);
            padding: 0.9rem 2rem;
            border-radius: 50px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            position: relative;
            z-index: 1;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .testimonials {
            margin-top: 4rem;
        }

        .testimonials h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            text-align: center;
            margin-bottom: 2rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .testimonial-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            transition: all 0.3s ease;
            border: 1px solid rgba(58, 94, 229, 0.15);
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(58, 94, 229, 0.15);
            background: white;
        }

        .testimonial-content {
            font-style: italic;
            margin-bottom: 1.5rem;
            color: var(--dark);
            line-height: 1.6;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            margin-right: 1rem;
            box-shadow: 0 4px 12px rgba(58, 94, 229, 0.2);
        }

        .author-info h4 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1rem;
            margin-bottom: 0.25rem;
            font-weight: 700;
        }

        .author-info p {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .faq-section {
            margin-top: 4rem;
        }

        .faq-section h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            text-align: center;
            margin-bottom: 2rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .faq-grid {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            margin-bottom: 1rem;
            box-shadow: 0 4px 15px rgba(58, 94, 229, 0.08);
            overflow: hidden;
            border: 1px solid rgba(58, 94, 229, 0.15);
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            border-color: rgba(58, 94, 229, 0.3);
        }

        .faq-question {
            padding: 1.5rem;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--dark);
            transition: all 0.3s ease;
        }

        .faq-question:hover {
            background: rgba(58, 94, 229, 0.05);
        }

        .faq-answer {
            padding: 0 1.5rem 1.5rem;
            color: var(--gray);
            display: none;
            line-height: 1.6;
        }

        .faq-item.active .faq-answer {
            display: block;
        }

        .faq-item.active .faq-question i {
            transform: rotate(180deg);
            color: var(--primary);
        }

        .faq-question i {
            transition: transform 0.3s;
            color: var(--primary);
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
        @media (max-width: 768px) {
            .features-page {
                padding: 2rem 1rem;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .feature-card {
                padding: 1.5rem;
            }

            .stats-section, .cta-section {
                padding: 2rem 1.5rem;
            }

            .stat-value {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .testimonial-grid {
                grid-template-columns: 1fr;
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

    <section class="features-page">
        <!-- Back Button -->
        <div class="back-button-container">
            <a href="{{ url()->previous() }}" class="back-button">
                <i class="fas fa-arrow-left"></i>
                Back to Welcome Page
            </a>
        </div>
        
        <div class="page-header">
            <h1>Footsy Features</h1>
            <p>Discover everything that makes Footsy the ultimate fantasy football experience</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>Live Player Statistics</h3>
                <p>Access real-time Premier League player data with our advanced API integration</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i> Live points updates during matches</li>
                    <li><i class="fas fa-check-circle"></i> Detailed player performance metrics</li>
                    <li><i class="fas fa-check-circle"></i> Historical data and trends</li>
                    <li><i class="fas fa-check-circle"></i> Injury and availability status</li>
                </ul>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <h3>Fantasy Leagues</h3>
                <p>Create and join private or public leagues to compete with friends and rivals</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i> Private leagues with custom rules</li>
                    <li><i class="fas fa-check-circle"></i> Public leagues with thousands of managers</li>
                    <li><i class="fas fa-check-circle"></i> Head-to-head and classic scoring options</li>
                    <li><i class="fas fa-check-circle"></i> League-specific leaderboards</li>
                </ul>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <h3>Advanced Analytics</h3>
                <p>Gain insights with comprehensive team and player analytics tools</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i> Team performance breakdowns</li>
                    <li><i class="fas fa-check-circle"></i> Player comparison tools</li>
                    <li><i class="fas fa-check-circle"></i> Form guides and fixture difficulty ratings</li>
                    <li><i class="fas fa-check-circle"></i> Transfer recommendation engine</li>
                </ul>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3>Real-Time Updates</h3>
                <p>Stay informed with instant notifications and live match updates</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i> Live score updates during matches</li>
                    <li><i class="fas fa-check-circle"></i> Goal and assist notifications</li>
                    <li><i class="fas fa-check-circle"></i> Price change alerts</li>
                    <li><i class="fas fa-check-circle"></i> Team news and lineups</li>
                </ul>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>Mobile Experience</h3>
                <p>Manage your team on the go with our responsive mobile interface</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i> Fully responsive design</li>
                    <li><i class="fas fa-check-circle"></i> Push notifications</li>
                    <li><i class="fas fa-check-circle"></i> Touch-optimized interface</li>
                    <li><i class="fas fa-check-circle"></i> Offline access to your team</li>
                </ul>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Secure & Reliable</h3>
                <p>Your data is safe with enterprise-grade security and 99.9% uptime</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i> SSL encrypted connections</li>
                    <li><i class="fas fa-check-circle"></i> Regular data backups</li>
                    <li><i class="fas fa-check-circle"></i> DDoS protection</li>
                    <li><i class="fas fa-check-circle"></i> 24/7 monitoring</li>
                </ul>
            </div>
        </div>

        <div class="stats-section">
            <h2>Footsy By The Numbers</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-value">2,500+</div>
                    <div class="stat-label">Active Managers</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">500+</div>
                    <div class="stat-label">Leagues Created</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">99.9%</div>
                    <div class="stat-label">Uptime Reliability</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">1M+</div>
                    <div class="stat-label">Daily API Calls</div>
                </div>
            </div>
        </div>

        <div class="cta-section">
            <h2>Ready to Join Footsy?</h2>
            <p>Create your account today and start building your fantasy football legacy. Compete with friends, climb the leaderboards, and prove your managerial skills.</p>
            <a href="{{ route('register') }}" class="cta-button">Get Started Now</a>
        </div>

        <div class="testimonials">
            <h2>What Managers Say</h2>
            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        "Footsy has completely transformed how I play fantasy football. The live stats and analytics help me make informed decisions that have taken me from mid-table to champion in my league!"
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">NC</div>
                        <div class="author-info">
                            <h4>Nathan Coles</h4>
                            <p>My great friend</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        "The private league feature is fantastic! I've created a league with my coworkers, and the banter in the chat has made our workdays much more enjoyable. Footsy brings people together."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">BJ</div>
                        <div class="author-info">
                            <h4>Bharat Jain</h4>
                            <p>My friend</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        "As a stats nerd, I love the depth of analytics Footsy provides. The player comparison tools and form guides have helped me identify hidden gems that other managers miss."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">PJ</div>
                        <div class="author-info">
                            <h4>Paul Johnson</h4>
                            <p>We have a little beef</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="faq-section">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-grid">
                <div class="faq-item">
                    <div class="faq-question">
                        How often are player statistics updated?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Player statistics are updated in real-time during matches. For non-match data like prices and availability, updates occur at least once daily, with more frequent updates during peak periods.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        Can I create multiple teams?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Each user account can manage one primary team. However, you can join multiple leagues with your single team and compete across different formats and scoring systems.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        Is there a mobile app available?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Footsy is a fully responsive web application that works seamlessly on all devices. While we don't have dedicated mobile apps in app stores, you can add Footsy to your home screen for an app-like experience.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        How do private leagues work?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Private leagues allow you to create a custom competition with your own rules and scoring system. You can invite friends via a unique code, set entry requirements, and customize the league to your preferences.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        Is Footsy free to play?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Yes! Footsy is completely free to play. Create your account, build your team, and join leagues at no cost. We believe everyone should enjoy the fantasy football experience without barriers.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // FAQ toggle functionality
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const item = question.parentElement;
                item.classList.toggle('active');
            });
        });

        // Animation for feature cards on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Apply initial styles and observe feature cards
        document.querySelectorAll('.feature-card, .stat-item, .testimonial-card, .faq-item').forEach(element => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'opacity 0.5s, transform 0.5s';
            observer.observe(element);
        });
    </script>
</body>
</html>