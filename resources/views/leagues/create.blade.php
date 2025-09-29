<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create League - Footsy Fantasy Football</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3a5ee5;
            --primary-dark: #2a48c5;
            --secondary: #34c759;
            --danger: #e53e3e;
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
            background-color: #f5f7ff;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: 260px;
            background: var(--dark);
            color: white;
            height: 100vh;
            position: fixed;
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .sidebar-logo {
            width: 36px;
            height: 36px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        .sidebar-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1.4rem;
        }
        
        .sidebar-nav {
            padding: 1.5rem 0;
        }
        
        .nav-item {
            list-style: none;
            margin-bottom: 0.25rem;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.5rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 4px solid transparent;
        }
        
        .nav-link:hover, .nav-link.active {
            background: rgba(255, 255, 255, 0.05);
            color: white;
            border-left-color: var(--primary);
        }
        
        .nav-link i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            position: relative;
        }
        
        /* Header */
        .header {
            height: 70px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        .user-info {
            display: flex;
            flex-direction: column;
        }
        
        .user-name {
            font-weight: 600;
            font-size: 0.95rem;
        }
        
        .user-role {
            font-size: 0.8rem;
            color: var(--gray);
        }
        
        /* Create League Content */
        .create-league-content {
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .create-league-header {
            margin-bottom: 2rem;
        }
        
        .create-league-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        
        .create-league-subtitle {
            color: var(--gray);
        }
        
        /* Form Styles */
        .create-league-form {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .form-section {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        
        .section-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: var(--dark);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }
        
        .form-group.required label::after {
            content: " *";
            color: var(--danger);
        }
        
        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            font-family: 'Open Sans', sans-serif;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(58, 94, 229, 0.1);
        }
        
        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }
        
        .form-hint {
            font-size: 0.8rem;
            color: var(--gray);
            margin-top: 0.25rem;
        }
        
        /* Radio and Checkbox Groups */
        .radio-group, .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .radio-option, .checkbox-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .radio-option input[type="radio"],
        .checkbox-option input[type="checkbox"] {
            width: 18px;
            height: 18px;
        }
        
        .radio-label, .checkbox-label {
            font-weight: normal;
            margin-bottom: 0;
        }
        
        /* Privacy Options */
        .privacy-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .privacy-option {
            border: 2px solid var(--light-gray);
            border-radius: 8px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .privacy-option:hover {
            border-color: var(--primary);
        }
        
        .privacy-option.selected {
            border-color: var(--primary);
            background: rgba(58, 94, 229, 0.05);
        }
        
        .privacy-option input {
            display: none;
        }
        
        .privacy-icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }
        
        .privacy-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .privacy-description {
            font-size: 0.8rem;
            color: var(--gray);
        }
        
        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--light-gray);
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
        }
        
        .btn-primary {
            background: var(--gradient);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(58, 94, 229, 0.3);
        }
        
        .btn-secondary {
            background: white;
            color: var(--primary);
            border: 1px solid var(--primary);
        }
        
        .btn-secondary:hover {
            background: rgba(58, 94, 229, 0.1);
        }
        
        /* Auto-fill Information */
        .auto-fill-info {
            background: rgba(58, 94, 229, 0.05);
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 0.25rem 0;
        }
        
        .info-label {
            font-weight: 500;
            color: var(--gray);
        }
        
        .info-value {
            font-weight: 600;
            color: var(--primary);
        }
        
        /* Toast Notification */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: white;
            border-radius: 8px;
            padding: 1rem 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            z-index: 1000;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s ease;
        }
        
        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }
        
        .toast-success {
            border-left: 4px solid var(--secondary);
        }
        
        .toast-error {
            border-left: 4px solid var(--danger);
        }
        
        .toast-icon {
            font-size: 1.2rem;
        }
        
        .toast-success .toast-icon {
            color: var(--secondary);
        }
        
        .toast-error .toast-icon {
            color: var(--danger);
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                overflow: visible;
            }
            
            .sidebar-title, .nav-link span {
                display: none;
            }
            
            .sidebar-header {
                justify-content: center;
                padding: 1.5rem 0.5rem;
            }
            
            .nav-link {
                padding: 1rem;
                justify-content: center;
            }
            
            .nav-link i {
                margin-right: 0;
                font-size: 1.2rem;
            }
            
            .main-content {
                margin-left: 70px;
            }
            
            .header {
                padding: 0 1rem;
            }
            
            .user-info {
                display: none;
            }
            
            .create-league-content {
                padding: 1rem;
            }
            
            .create-league-form {
                padding: 1.5rem;
            }
            
            .privacy-options {
                grid-template-columns: 1fr;
            }
            
            .form-actions {
                flex-direction: column;
            }
        }
        
        @media (max-width: 576px) {
            .header {
                padding: 0 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">F</div>
            <div class="sidebar-title">Footsy</div>
        </div>
        
        <ul class="sidebar-nav">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('fantasy-team.index') }}" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>My Team</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('leagues.index') }}" class="nav-link">
                    <i class="fas fa-trophy"></i>
                    <span>Leagues</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('statistics.index') }}" class="nav-link">
                    <i class="fas fa-chart-line"></i>
                    <span>Statistics</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('transfers.index') }}" class="nav-link">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Transfers</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('fixtures.index') }}" class="nav-link">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Fixtures</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('profile.edit') }}" class="nav-link">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Log Out</span>
                    </a>
                </form>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="header">
            <div></div> <!-- Empty div for spacing -->
            
            <div class="user-menu">
                <div class="user-profile">
                    <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <div class="user-info">
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="user-role">Team Manager</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Create League Content -->
        <div class="create-league-content">
            <div class="create-league-header">
                <h1 class="create-league-title">Create New League</h1>
                <p class="create-league-subtitle">Set up your fantasy football league and invite other managers to compete</p>
            </div>

            <form class="create-league-form" id="createLeagueForm" method="POST" action="{{ route('leagues.store') }}">
                @csrf
                
                <!-- Basic Information Section -->
                <div class="form-section">
                    <h3 class="section-title">Basic Information</h3>
                    
                    <div class="form-group required">
                        <label for="league_name">League Name</label>
                        <input type="text" id="league_name" name="name" class="form-control" placeholder="Enter a unique league name" required>
                        <div class="form-hint">Choose a name that represents your league's theme or purpose</div>
                    </div>
                    
                    <div class="form-group required">
                        <label for="league_description">League Description</label>
                        <textarea id="league_description" name="league_description" class="form-control" placeholder="Describe your league's purpose, rules, or theme"></textarea>
                        <div class="form-hint">This description will help potential participants understand your league</div>
                    </div>
                </div>

                <!-- League Settings Section -->
                <div class="form-section">
                    <h3 class="section-title">League Settings</h3>
                    
                    <div class="form-group required">
                        <label for="max_participants">Maximum Participants</label>
                        <input type="number" id="max_participants" name="max_participants" class="form-control" min="2" max="100" value="20">
                        <div class="form-hint">Set the maximum number of teams allowed in your league (2-100)</div>
                    </div>
                    
                    <div class="form-group required">
                        <label>Privacy Settings</label>
                        <div class="privacy-options">
                            <div class="privacy-option" onclick="selectPrivacy('public')">
                                <input type="radio" id="privacy_public" name="type" value="public" checked>
                                <div class="privacy-icon">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <div class="privacy-title">Public League</div>
                                <div class="privacy-description">Anyone can join without approval</div>
                            </div>
                            
                            <div class="privacy-option" onclick="selectPrivacy('private')">
                                <input type="radio" id="privacy_private" name="type" value="private">
                                <div class="privacy-icon">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <div class="privacy-title">Private League</div>
                                <div class="privacy-description">Requires approval to join</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- League Rules Section (Optional) -->
                <div class="form-section">
                    <h3 class="section-title">League Rules (Optional)</h3>
                    
                    <div class="form-group">
                        <label for="custom_rules">Custom Rules</label>
                        <textarea id="custom_rules" name="custom_rules" class="form-control" placeholder="Add any custom rules or special scoring settings (optional)"></textarea>
                        <div class="form-hint">Specify any unique rules that differ from standard Footsy rules</div>
                    </div>
                    
                    <div class="checkbox-group">
                        <div class="checkbox-option">
                            <input type="checkbox" id="allow_transfers" name="allow_transfers" checked>
                            <label for="allow_transfers" class="checkbox-label">Allow unlimited transfers</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="use_wildcards" name="use_wildcards" checked>
                            <label for="use_wildcards" class="checkbox-label">Enable wildcard usage</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="show_rankings" name="show_rankings" checked>
                            <label for="show_rankings" class="checkbox-label">Publicly show league rankings</label>
                        </div>
                    </div>
                </div>

                <!-- Auto-filled Information -->
                <div class="auto-fill-info">
                    <div class="info-item">
                        <span class="info-label">Created Date:</span>
                        <span class="info-value" id="createdDate">{{ now()->format('F j, Y') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">League Admin:</span>
                        <span class="info-value" id="leagueAdmin">{{ Auth::user()->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">League Code:</span>
                        <span class="info-value" id="leagueCode">Will be generated upon creation</span>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('leagues.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Leagues
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create League
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <i class="fas fa-check-circle toast-icon" id="toastIcon"></i>
        <span id="toastMessage"></span>
    </div>

    <script>
        // Privacy selection functionality
        function selectPrivacy(privacyType) {
            // Remove selected class from all options
            document.querySelectorAll('.privacy-option').forEach(option => {
                option.classList.remove('selected');
            });
            
            // Add selected class to clicked option
            document.querySelector(`.privacy-option[onclick="selectPrivacy('${privacyType}')"]`).classList.add('selected');
            
            // Update the radio button
            document.getElementById(`privacy_${privacyType}`).checked = true;
        }
        
        // Initialize privacy selection
        document.addEventListener('DOMContentLoaded', function() {
            // Select public by default
            selectPrivacy('public');
            
            // No JS interception; the form submits normally to the server.
        });
        
        // Toast notification function
        function showToast(message, type) {
            const toast = document.getElementById('toast');
            const toastIcon = document.getElementById('toastIcon');
            const toastMessage = document.getElementById('toastMessage');
            
            // Set toast content and style
            toastMessage.textContent = message;
            toast.className = 'toast'; // Reset classes
            toast.classList.add(`toast-${type}`);
            
            // Set icon based on type
            if (type === 'success') {
                toastIcon.className = 'fas fa-check-circle toast-icon';
            } else {
                toastIcon.className = 'fas fa-exclamation-circle toast-icon';
            }
            
            // Show toast
            toast.classList.add('show');
            
            // Hide toast after 3 seconds
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }
        
        // Character counter for description
        document.getElementById('league_description').addEventListener('input', function() {
            const maxLength = 500;
            const currentLength = this.value.length;
            const hint = this.nextElementSibling;
            
            if (currentLength > maxLength) {
                this.value = this.value.substring(0, maxLength);
                hint.textContent = `Description too long (max ${maxLength} characters)`;
                hint.style.color = 'var(--danger)';
            } else {
                hint.textContent = `This description will help potential participants understand your league (${currentLength}/${maxLength} characters)`;
                hint.style.color = 'var(--gray)';
            }
        });
        
        // Participant count validation
        document.getElementById('max_participants').addEventListener('change', function() {
            const value = parseInt(this.value);
            if (value < 2) {
                this.value = 2;
            } else if (value > 100) {
                this.value = 100;
            }
        });
    </script>
</body>
</html>