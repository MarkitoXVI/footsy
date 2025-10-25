<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footsy Features</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3a5ee5;
            --primary-dark: #2a48c5;
            --secondary: #34c759;
            --dark: #1a2238;
            --light: #f8f9fa;
            --gray: #6c757d;
            --light-gray: #e9ecef;
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
            background: #f5f7ff;
            line-height: 1.6;
        }

        .features-page {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
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
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .back-button:hover {
            background: var(--light-gray);
            transform: translateX(-3px);
        }

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-header h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .page-header p {
            font-size: 1.2rem;
            color: var(--gray);
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .feature-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 12px;
            background: rgba(58, 94, 229, 0.1);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
        }

        .feature-card h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 1rem;
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
            align-items: flex-start;
        }

        .feature-list li i {
            color: var(--secondary);
            margin-right: 0.75rem;
            margin-top: 0.25rem;
            flex-shrink: 0;
        }

        .stats-section {
            background: white;
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 4rem;
        }

        .stats-section h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .stat-item {
            text-align: center;
            padding: 1.5rem;
        }

        .stat-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--gray);
            font-size: 1rem;
        }

        .cta-section {
            background: var(--gradient);
            color: white;
            border-radius: 12px;
            padding: 3rem 2rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .cta-section h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .cta-section p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            opacity: 0.9;
        }

        .cta-button {
            display: inline-block;
            background: white;
            color: var(--primary);
            padding: 0.9rem 2rem;
            border-radius: 50px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            text-decoration: none;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        .testimonials {
            margin-top: 4rem;
        }

        .testimonials h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .testimonial-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .testimonial-content {
            font-style: italic;
            margin-bottom: 1.5rem;
            color: var(--dark);
        }

        .testimonial-author {
            display: flex;
            align-items: center;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 1rem;
        }

        .author-info h4 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1rem;
            margin-bottom: 0.25rem;
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
        }

        .faq-grid {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background: white;
            border-radius: 8px;
            margin-bottom: 1rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .faq-question {
            padding: 1.5rem;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-answer {
            padding: 0 1.5rem 1.5rem;
            color: var(--gray);
            display: none;
        }

        .faq-item.active .faq-answer {
            display: block;
        }

        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }

        .faq-question i {
            transition: transform 0.3s;
        }

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
        }
    </style>
</head>
<body>
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
                    <li><i class="fas fa-check"></i> Live points updates during matches</li>
                    <li><i class="fas fa-check"></i> Detailed player performance metrics</li>
                    <li><i class="fas fa-check"></i> Historical data and trends</li>
                    <li><i class="fas fa-check"></i> Injury and availability status</li>
                </ul>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <h3>Fantasy Leagues</h3>
                <p>Create and join private or public leagues to compete with friends and rivals</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check"></i> Private leagues with custom rules</li>
                    <li><i class="fas fa-check"></i> Public leagues with thousands of managers</li>
                    <li><i class="fas fa-check"></i> Head-to-head and classic scoring options</li>
                    <li><i class="fas fa-check"></i> League-specific leaderboards</li>
                </ul>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <h3>Advanced Analytics</h3>
                <p>Gain insights with comprehensive team and player analytics tools</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check"></i> Team performance breakdowns</li>
                    <li><i class="fas fa-check"></i> Player comparison tools</li>
                    <li><i class="fas fa-check"></i> Form guides and fixture difficulty ratings</li>
                    <li><i class="fas fa-check"></i> Transfer recommendation engine</li>
                </ul>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3>Real-Time Updates</h3>
                <p>Stay informed with instant notifications and live match updates</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check"></i> Live score updates during matches</li>
                    <li><i class="fas fa-check"></i> Goal and assist notifications</li>
                    <li><i class="fas fa-check"></i> Price change alerts</li>
                    <li><i class="fas fa-check"></i> Team news and lineups</li>
                </ul>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>Mobile Experience</h3>
                <p>Manage your team on the go with our responsive mobile interface</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check"></i> Fully responsive design</li>
                    <li><i class="fas fa-check"></i> Push notifications</li>
                    <li><i class="fas fa-check"></i> Touch-optimized interface</li>
                    <li><i class="fas fa-check"></i> Offline access to your team</li>
                </ul>
            </div>
        </div>

        <div class="stats-section">
            <h2>Footsy By The Numbers</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-value">2 or 3</div>
                    <div class="stat-label">Active Managers</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">5</div>
                    <div class="stat-label">Leagues Created</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">99.8%</div>
                    <div class="stat-label">Uptime Reliability</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">0</div>
                    <div class="stat-label">Daily Transfers yet</div>
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

        // Simple animation for feature cards on scroll
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
        document.querySelectorAll('.feature-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s, transform 0.5s';
            observer.observe(card);
        });
    </script>
</body>
</html>