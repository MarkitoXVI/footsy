<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Footsy Fantasy Football</title>
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

        /* Authentication Container */
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

        /* Left Side - Benefits */
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

        .benefits {
            list-style: none;
            position: relative;
            z-index: 2;
        }

        .benefits li {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            gap: 12px;
        }

        .benefits i {
            background: rgba(255, 255, 255, 0.2);
            width: 32px;
            height: 32px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        /* Right Side - Form */
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

        /* Input fields with icons */
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

        /* Password toggle */
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

        /* Team Selection */
        .team-selection {
            margin-bottom: 1.5rem;
        }

        .team-select {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--light-gray);
            border-radius: 12px;
            font-size: 1rem;
            background: white;
            cursor: pointer;
            transition: all 0.3s;
            appearance: none;
            font-family: 'Open Sans', sans-serif;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%233a5ee5' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px;
        }

        .team-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(58, 94, 229, 0.1);
        }

        .team-select.input-error {
            border-color: #e74c3c;
        }

        /* Team Preview */
        .team-preview {
            margin-top: 1rem;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: rgba(58, 94, 229, 0.08);
            border-radius: 12px;
            display: none;
            border: 1px solid rgba(58, 94, 229, 0.15);
        }

        .team-preview.active {
            display: flex;
        }

        .team-logo-preview {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: contain;
            background: white;
            padding: 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .team-name-preview {
            font-weight: 600;
            color: var(--dark);
            font-size: 1rem;
        }

        /* Form Options */
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

        .remember-me a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .remember-me a:hover {
            text-decoration: underline;
        }

        /* Button Styles */
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

        /* Google Button */
        .btn-google {
            background: white;
            color: #757575;
            border: 2px solid var(--light-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-top: 1rem;
            padding: 0.875rem 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-google:hover {
            border-color: var(--primary);
            background: rgba(58, 94, 229, 0.05);
            transform: translateY(-2px);
        }

        .btn-google i {
            color: #4285f4;
            font-size: 1.1rem;
        }

        /* Divider */
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
            
            .team-preview {
                flex-direction: column;
                text-align: center;
                gap: 8px;
            }
            
            .footer-links {
                gap: 1rem;
                flex-direction: column;
            }
            
            .benefits li {
                font-size: 0.9rem;
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
                    <h2>Join the Footsy Community</h2>
                    <p>Create your account and start building your fantasy football team today.</p>
                    <ul class="benefits">
                        <li><i class="fas fa-check"></i> Build your ultimate fantasy team</li>
                        <li><i class="fas fa-check"></i> Compete with friends and rivals</li>
                        <li><i class="fas fa-check"></i> Track real-time player statistics</li>
                        <li><i class="fas fa-check"></i> Win prizes and bragging rights</li>
                    </ul>
                </div>
                <div class="auth-right">
                    <div class="auth-header">
                        <h2>Create Account</h2>
                        <p>Join thousands of football fans managing their fantasy teams</p>
                    </div>
                    
                    <!-- Registration Form -->
                    <form class="auth-form" method="POST" action="{{ route('register') }}">
                        <!-- CSRF Token -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <div class="input-with-icon">
                                <i class="fas fa-user"></i>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter your full name">
                            </div>
                            <div class="error-message">
                                @error('name') {{ $message }} @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <div class="input-with-icon">
                                <i class="fas fa-envelope"></i>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Enter your email">
                            </div>
                            <div class="error-message">
                                @error('email') {{ $message }} @enderror
                            </div>
                        </div>
                        
                        <!-- Team Selection -->
                        <div class="form-group team-selection">
                            <label for="favorite_team">Select Your Favorite Team</label>
                            <select id="favorite_team" name="favorite_team" class="team-select form-control" required>
                                <option value="">Choose your favorite Premier League team</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->short_name }}" 
                                            data-logo="https://resources.premierleague.com/premierleague/badges/70/t{{ $team->code }}.png"
                                            data-name="{{ $team->name }}">
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Team Preview -->
                            <div id="teamPreview" class="team-preview">
                                <img id="teamLogo" src="" alt="Team Logo" class="team-logo-preview">
                                <span id="teamName" class="team-name-preview"></span>
                            </div>

                            <div class="error-message">
                                @error('favorite_team') {{ $message }} @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-with-icon">
                                <i class="fas fa-lock"></i>
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Create a password">
                                <span class="password-toggle" id="passwordToggle">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            <div class="error-message">
                                @error('password') {{ $message }} @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <div class="input-with-icon">
                                <i class="fas fa-lock"></i>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm your password">
                            </div>
                        </div>
                        
                        <div class="form-options">
                            <label class="remember-me">
                                <input type="checkbox" name="terms" required>
                                <span>I agree to the <a href="#">Terms & Conditions</a></span>
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Create Account</button>
                        
                        <div class="divider">
                            <span>Or sign up with</span>
                        </div>
                        
                        <!-- Google Sign In Button -->
                        <a href="{{ route('google.login') }}" class="btn btn-google">
                            <i class="fab fa-google"></i>
                            <span>Sign up with Google</span>
                        </a>

                        <div class="auth-footer">
                            <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
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
            
            // Team selection preview
            const teamSelect = document.getElementById('favorite_team');
            const teamPreview = document.getElementById('teamPreview');
            const teamLogo = document.getElementById('teamLogo');
            const teamName = document.getElementById('teamName');
            
            if (teamSelect) {
                teamSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const logoUrl = selectedOption.getAttribute('data-logo');
                    const teamNameText = selectedOption.getAttribute('data-name');
                    
                    if (this.value) {
                        // Show preview
                        teamLogo.src = logoUrl;
                        teamName.textContent = teamNameText;
                        teamPreview.classList.add('active');
                        this.classList.remove('input-error');
                    } else {
                        // Hide preview
                        teamPreview.classList.remove('active');
                    }
                });
            }
            
            // Form validation
            const form = document.querySelector('.auth-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    let isValid = true;
                    const inputs = form.querySelectorAll('input[required], select[required]');
                    
                    inputs.forEach(input => {
                        if (!input.value.trim()) {
                            isValid = false;
                            input.classList.add('input-error');
                        } else {
                            input.classList.remove('input-error');
                        }
                    });
                    
                    // Check if passwords match
                    const password = document.getElementById('password');
                    const confirmPassword = document.getElementById('password_confirmation');
                    
                    if (password && confirmPassword && password.value !== confirmPassword.value) {
                        isValid = false;
                        confirmPassword.classList.add('input-error');
                        // Add error message if not exists
                        let errorDiv = confirmPassword.closest('.form-group').querySelector('.error-message');
                        if (errorDiv && !errorDiv.textContent) {
                            errorDiv.textContent = 'Passwords do not match';
                        }
                    }
                    
                    // Check if team is selected
                    if (teamSelect && !teamSelect.value) {
                        isValid = false;
                        teamSelect.classList.add('input-error');
                    }
                    
                    // Check terms checkbox
                    const termsCheckbox = document.querySelector('input[name="terms"]');
                    if (termsCheckbox && !termsCheckbox.checked) {
                        isValid = false;
                        alert('Please agree to the Terms & Conditions');
                    }
                    
                    if (!isValid) {
                        e.preventDefault();
                    }
                });
            }
        });
    </script>
</body>
</html>