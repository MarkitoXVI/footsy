<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Footsy Fantasy Football</title>
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
            display: flex;
            flex-direction: column;
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
        
        /* Main Content */
        .main-content {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
            padding: 3rem 0;
        }
        
        .auth-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(58, 94, 229, 0.15);
            border: 1px solid rgba(58, 94, 229, 0.15);
        }
        
        .auth-left {
            flex: 1;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .auth-left::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15), transparent);
        }
        
        .auth-left::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1), transparent);
        }
        
        .auth-left h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 2;
            font-weight: 700;
        }
        
        .auth-left p {
            margin-bottom: 2rem;
            opacity: 0.9;
            position: relative;
            z-index: 2;
            line-height: 1.6;
        }
        
        .testimonial {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(5px);
            border-radius: 16px;
            padding: 1.5rem;
            margin-top: 2rem;
            position: relative;
            z-index: 2;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .testimonial p {
            font-style: italic;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }
        
        .user {
            display: flex;
            align-items: center;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 12px;
            font-size: 1rem;
        }
        
        .auth-right {
            flex: 1;
            padding: 3rem;
        }
        
        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .auth-header h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .auth-header p {
            color: var(--gray);
        }
        
        .auth-form {
            width: 100%;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark);
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 1rem;
        }
        
        .input-with-icon input {
            padding-left: 45px;
        }
        
        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--light-gray);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s;
            font-family: 'Open Sans', sans-serif;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(58, 94, 229, 0.1);
        }
        
        .form-control.input-error {
            border-color: #e74c3c;
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .password-toggle:hover {
            color: var(--primary);
        }
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        
        .remember-me input {
            margin-right: 0.5rem;
            cursor: pointer;
            accent-color: var(--primary);
        }
        
        .forgot-password {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .forgot-password:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        .btn {
            display: inline-block;
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Montserrat', sans-serif;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 4px 15px rgba(58, 94, 229, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.4);
        }
        
        .btn-google {
            background: white;
            color: var(--dark);
            border: 2px solid var(--light-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-top: 1rem;
        }
        
        .btn-google:hover {
            border-color: var(--primary);
            background: rgba(58, 94, 229, 0.05);
            transform: translateY(-2px);
        }
        
        .divider {
            text-align: center;
            position: relative;
            margin: 2rem 0;
        }
        
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--light-gray);
        }
        
        .divider span {
            background: white;
            padding: 0 1rem;
            position: relative;
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .auth-footer {
            text-align: center;
            margin-top: 2rem;
            color: var(--gray);
        }
        
        .auth-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .auth-footer a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        /* Error Messages */
        .error-message {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }
        
        /* Status Message */
        .status-message {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 0.9rem;
        }
        
        .status-success {
            background: linear-gradient(135deg, rgba(52, 199, 89, 0.1), rgba(52, 199, 89, 0.05));
            color: #2b8c3c;
            border: 1px solid rgba(52, 199, 89, 0.3);
        }
        
        .status-error {
            background: linear-gradient(135deg, rgba(231, 76, 60, 0.1), rgba(231, 76, 60, 0.05));
            color: #c0392b;
            border: 1px solid rgba(231, 76, 60, 0.3);
        }
        
        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: 2rem 0;
            text-align: center;
            margin-top: auto;
            position: relative;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 1.5rem;
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
        @media (max-width: 900px) {
            .auth-container {
                flex-direction: column;
                max-width: 500px;
            }
            
            .auth-left {
                padding: 2rem;
            }
        }
        
        @media (max-width: 576px) {
            .auth-left, .auth-right {
                padding: 1.5rem;
            }
            
            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .footer-links {
                gap: 1rem;
                flex-direction: column;
            }
        }
        
        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .auth-container {
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
                <a href="/" class="logo">
                    <div class="logo-icon">F</div>
                    Footsy
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="auth-container">
                <div class="auth-left">
                    <h2>Welcome Back to Footsy</h2>
                    <p>Sign in to manage your fantasy team, check live scores, and make transfers.</p>
                    
                    <div class="testimonial">
                        <p>"Footsy has completely transformed how I enjoy football. My friends and I have our own league and the competition is fierce!"</p>
                        <div class="user">
                            <div class="user-avatar">PJ</div>
                            <div>
                                <strong>Paul Johnson</strong>
                                <div style="font-size: 0.85rem; opacity: 0.8;">Footsy User for over a month</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="auth-right">
                    <div class="auth-header">
                        <h2>Sign In</h2>
                        <p>Welcome back! Please enter your details</p>
                    </div>
                    
                    <!-- Status Messages -->
                    @if(session('status'))
                        <div class="status-message status-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="status-message status-error">
                            @foreach($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif
                    
                    <form class="auth-form" method="POST" action="{{ route('login') }}">
                        <!-- CSRF Token -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <div class="input-with-icon">
                                <i class="fas fa-envelope"></i>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                            </div>
                            <!-- Validation Error -->
                            <div class="error-message">
                                @error('email') {{ $message }} @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-with-icon">
                                <i class="fas fa-lock"></i>
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Enter your password">
                                <span class="password-toggle" id="passwordToggle">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            <!-- Validation Error -->
                            <div class="error-message">
                                @error('password') {{ $message }} @enderror
                            </div>
                        </div>
                        
                        <div class="form-options">
                            <label class="remember-me">
                                <input type="checkbox" name="remember">
                                <span>Remember me</span>
                            </label>
                            
                            <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Sign In</button>
                        
                        <div class="divider">
                            <span>Or sign in with</span>
                        </div>
                        
                        <!-- Google Sign In Button -->
                        <a href="{{ route('google.login') }}" class="btn btn-google">
                            <i class="fab fa-google"></i>
                            <span>Sign in with Google</span>
                        </a>
                        
                        <div class="auth-footer">
                            <p>Don't have an account? <a href="{{ route('register') }}">Sign up here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

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
        // Password visibility toggle
        document.addEventListener('DOMContentLoaded', function() {
            const passwordToggle = document.getElementById('passwordToggle');
            const passwordField = document.getElementById('password');
            
            if (passwordToggle && passwordField) {
                passwordToggle.addEventListener('click', function() {
                    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordField.setAttribute('type', type);
                    
                    // Toggle eye icon
                    const eyeIcon = passwordToggle.querySelector('i');
                    if (type === 'password') {
                        eyeIcon.classList.remove('fa-eye-slash');
                        eyeIcon.classList.add('fa-eye');
                    } else {
                        eyeIcon.classList.remove('fa-eye');
                        eyeIcon.classList.add('fa-eye-slash');
                    }
                });
            }
            
            // Form validation
            const form = document.querySelector('.auth-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    let isValid = true;
                    const inputs = form.querySelectorAll('input[required]');
                    
                    inputs.forEach(input => {
                        if (!input.value.trim()) {
                            isValid = false;
                            input.classList.add('input-error');
                        } else {
                            input.classList.remove('input-error');
                        }
                    });
                    
                    if (!isValid) {
                        e.preventDefault();
                    }
                });
            }
        });
    </script>
</body>
</html>