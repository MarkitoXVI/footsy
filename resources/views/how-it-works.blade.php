<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How Footsy Works</title>
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

        .how-it-works-page {
            padding: 4rem 2rem;
            max-width: 1000px;
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

        .steps-container {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .step-card {
            background: white;
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            display: flex;
            align-items: flex-start;
            gap: 2rem;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
        }

        .step-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .step-number {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--gradient);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .step-content {
            flex: 1;
        }

        .step-content h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .step-content p {
            color: var(--gray);
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }

        .step-features {
            list-style: none;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .step-features li {
            padding: 0.75rem;
            background: rgba(58, 94, 229, 0.05);
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .step-features li i {
            color: var(--secondary);
            font-size: 0.9rem;
        }

        .visual-guide {
            background: white;
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 4rem;
        }

        .visual-guide h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .guide-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .guide-step {
            text-align: center;
            padding: 1.5rem;
        }

        .guide-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(58, 94, 229, 0.1);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1rem;
        }

        .guide-step h4 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .guide-step p {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .cta-section {
            background: var(--gradient);
            color: white;
            border-radius: 12px;
            padding: 3rem 2rem;
            text-align: center;
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

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
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

        .cta-button.secondary {
            background: transparent;
            color: white;
            border: 2px solid rgba(255,255,255,0.3);
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        .tips-section {
            margin-top: 4rem;
        }

        .tips-section h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .tips-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .tip-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            text-align: center;
        }

        .tip-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background: rgba(52, 199, 89, 0.1);
            color: var(--secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 1.5rem;
        }

        .tip-card h4 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .tip-card p {
            color: var(--gray);
        }

        @media (max-width: 768px) {
            .how-it-works-page {
                padding: 2rem 1rem;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .step-card {
                flex-direction: column;
                padding: 2rem;
                text-align: center;
            }

            .step-features {
                grid-template-columns: 1fr;
            }

            .guide-steps {
                grid-template-columns: repeat(2, 1fr);
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .cta-button {
                width: 100%;
                max-width: 250px;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .guide-steps {
                grid-template-columns: 1fr;
            }

            .tips-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <section class="how-it-works-page">
        <!-- Back Button -->
        <div class="back-button-container">
            <a href="{{ url()->previous() }}" class="back-button">
                <i class="fas fa-arrow-left"></i>
                Back to Previous Page
            </a>
        </div>

        <div class="page-header">
            <h1>How Footsy Works</h1>
            <p>Your complete guide to mastering fantasy football in just a few simple steps</p>
        </div>

        <div class="steps-container">
            <div class="step-card">
                <div class="step-number">1</div>
                <div class="step-content">
                    <h3>Create Your Account</h3>
                    <p>Join thousands of fantasy football managers and start your Footsy journey</p>
                    <ul class="step-features">
                        <li><i class="fas fa-check"></i> Quick 2-minute signup process</li>
                        <li><i class="fas fa-check"></i> Secure account with email verification</li>
                        <li><i class="fas fa-check"></i> Customizable manager profile</li>
                        <li><i class="fas fa-check"></i> Set your favorite team preferences</li>
                    </ul>
                </div>
            </div>

            <div class="step-card">
                <div class="step-number">2</div>
                <div class="step-content">
                    <h3>Build Your Dream Team</h3>
                    <p>Use your £100m budget to select 15 players following formation rules</p>
                    <ul class="step-features">
                        <li><i class="fas fa-check"></i> Choose from 500+ Premier League players</li>
                        <li><i class="fas fa-check"></i> Must select 2 GKs, 5 DEFs, 5 MIDs, 3 FWDs</li>
                        <li><i class="fas fa-check"></i> Max 3 players from any single club</li>
                        <li><i class="fas fa-check"></i> Real-time price fluctuations</li>
                    </ul>
                </div>
            </div>

            <div class="step-card">
                <div class="step-number">3</div>
                <div class="step-content">
                    <h3>Join The Competition</h3>
                    <p>Enter leagues and compete against friends or the global Footsy community</p>
                    <ul class="step-features">
                        <li><i class="fas fa-check"></i> Create private leagues with friends</li>
                        <li><i class="fas fa-check"></i> Join public leagues with thousands</li>
                        <li><i class="fas fa-check"></i> Head-to-head and classic scoring</li>
                        <li><i class="fas fa-check"></i> Cup competitions throughout season</li>
                    </ul>
                </div>
            </div>

            <div class="step-card">
                <div class="step-number">4</div>
                <div class="step-content">
                    <h3>Manage & Dominate</h3>
                    <p>Track performance, make transfers, and use chips to climb the rankings</p>
                    <ul class="step-features">
                        <li><i class="fas fa-check"></i> 1 free transfer per week</li>
                        <li><i class="fas fa-check"></i> Wildcard, Free Hit & Bench Boost chips</li>
                        <li><i class="fas fa-check"></i> Live points during matches</li>
                        <li><i class="fas fa-check"></i> Captain selection for double points</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="visual-guide">
            <h2>Your Weekly Footsy Routine</h2>
            <div class="guide-steps">
                <div class="guide-step">
                    <div class="guide-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h4>Research</h4>
                    <p>Analyze fixtures, form, and stats to identify the best picks</p>
                </div>
                <div class="guide-step">
                    <div class="guide-icon">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <h4>Transfer</h4>
                    <p>Make your weekly transfers before the deadline</p>
                </div>
                <div class="guide-step">
                    <div class="guide-icon">
                        <i class="fas fa-user-cog"></i>
                    </div>
                    <h4>Set Team</h4>
                    <p>Choose starting XI, captain, and formation</p>
                </div>
                <div class="guide-step">
                    <div class="guide-icon">
                        <i class="fas fa-tv"></i>
                    </div>
                    <h4>Watch & Track</h4>
                    <p>Follow matches and monitor your points in real-time</p>
                </div>
            </div>
        </div>

        <div class="tips-section">
            <h2>Pro Tips for Success</h2>
            <div class="tips-grid">
                <div class="tip-card">
                    <div class="tip-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4>Fixture Analysis</h4>
                    <p>Focus on players with favorable upcoming fixtures. Check our fixture difficulty ratings.</p>
                </div>
                <div class="tip-card">
                    <div class="tip-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h4>Budget Management</h4>
                    <p>Balance expensive stars with budget enablers. Don't spend all your money upfront.</p>
                </div>
                <div class="tip-card">
                    <div class="tip-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4>Patience Pays</h4>
                    <p>Avoid knee-jerk transfers. Give your players time to deliver over multiple gameweeks.</p>
                </div>
            </div>
        </div>

        <div class="cta-section">
            <h2>Ready to Start Your Journey?</h2>
            <p>Join Footsy today and experience fantasy football like never before. Compete, strategize, and prove your managerial skills!</p>
            <div class="cta-buttons">
                <a href="{{ route('register') }}" class="cta-button">
                    <i class="fas fa-user-plus"></i>
                    Sign Up Now
                </a>
                <a href="https://www.youtube.com/watch?v=xYWmhnsOqs0" class="cta-button secondary">
                    <i class="fas fa-play-circle"></i>
                    Watch Tutorial
                </a>
            </div>
        </div>
    </section>

    <script>
        // Simple animation for step cards on scroll
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

        // Apply initial styles and observe step cards
        document.querySelectorAll('.step-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s, transform 0.5s';
            observer.observe(card);
        });

        // Animate guide steps with staggered delay
        document.querySelectorAll('.guide-step').forEach((step, index) => {
            step.style.opacity = '0';
            step.style.transform = 'translateY(20px)';
            step.style.transition = `opacity 0.5s ${index * 0.1}s, transform 0.5s ${index * 0.1}s`;
            observer.observe(step);
        });
    </script>
</body>
</html>