<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>League Standings - Footsy Fantasy Football</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3a5ee5;
            --primary-dark: #2a48c5;
            --secondary: #34c759;
            --danger: #e53e3e;
            --warning: #ffc107;
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
        
        /* League Show Content */
        .league-content {
            padding: 2rem;
        }
        
        .league-header {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
        
        .league-info {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }
        
        .league-main-info h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .league-description {
            color: var(--gray);
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }
        
        .league-meta {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }
        
        .meta-item {
            display: flex;
            flex-direction: column;
        }
        
        .meta-value {
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--primary);
        }
        
        .meta-label {
            font-size: 0.8rem;
            color: var(--gray);
        }
        
        .league-actions {
            display: flex;
            gap: 1rem;
        }
        
        .action-btn {
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
        
        .btn-danger {
            background: white;
            color: var(--danger);
            border: 1px solid var(--danger);
        }
        
        .btn-danger:hover {
            background: rgba(229, 62, 62, 0.1);
        }
        
        /* Tabs */
        .league-tabs {
            display: flex;
            background: white;
            border-radius: 12px;
            padding: 0.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .tab {
            padding: 1rem 1.5rem;
            border: none;
            background: none;
            cursor: pointer;
            font-weight: 600;
            color: var(--gray);
            transition: all 0.3s;
            border-radius: 8px;
            flex: 1;
            text-align: center;
        }
        
        .tab.active {
            background: var(--gradient);
            color: white;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        /* Standings Table */
        .standings-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
        
        .table-header {
            background: var(--gradient);
            color: white;
            padding: 1.5rem;
            display: grid;
            grid-template-columns: 60px 1fr 80px 80px 80px 80px 80px 80px;
            gap: 1rem;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
        }
        
        .table-row {
            padding: 1rem 1.5rem;
            display: grid;
            grid-template-columns: 60px 1fr 80px 80px 80px 80px 80px 80px;
            gap: 1rem;
            align-items: center;
            border-bottom: 1px solid var(--light-gray);
            transition: all 0.3s;
        }
        
        .table-row:hover {
            background: #f9f9f9;
        }
        
        .table-row:last-child {
            border-bottom: none;
        }
        
        .position {
            font-weight: 700;
            font-size: 1.1rem;
            text-align: center;
        }
        
        .position-1 { color: gold; }
        .position-2 { color: silver; }
        .position-3 { color: #cd7f32; } /* bronze */
        
        .team-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .team-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--primary);
        }
        
        .team-name {
            font-weight: 600;
        }
        
        .team-manager {
            font-size: 0.8rem;
            color: var(--gray);
        }
        
        .stat {
            text-align: center;
            font-weight: 600;
        }
        
        .user-team {
            background: rgba(58, 94, 229, 0.05);
            border-left: 4px solid var(--primary);
        }
        
        /* Statistics Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            text-align: center;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(58, 94, 229, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: var(--primary);
            font-size: 1.5rem;
        }
        
        .stat-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        /* Members List */
        .members-list {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .member-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .member-item:last-child {
            border-bottom: none;
        }
        
        .member-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .member-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
        }
        
        .member-details h4 {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .member-details p {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .admin-badge {
            background: rgba(52, 199, 89, 0.1);
            color: var(--secondary);
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .member-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        /* Settings Form */
        .settings-form {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }
        
        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(58, 94, 229, 0.1);
        }
        
        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
        }
        
        /* Success Message */
        .alert-success {
            background: rgba(52, 199, 89, 0.1);
            border: 1px solid rgba(52, 199, 89, 0.2);
            color: var(--secondary);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        /* Responsive Design */
        @media (max-width: 1200px) {
            .table-header, .table-row {
                grid-template-columns: 50px 1fr 70px 70px 70px 70px 70px 70px;
                gap: 0.5rem;
            }
        }
        
        @media (max-width: 992px) {
            .table-header, .table-row {
                grid-template-columns: 40px 1fr 60px 60px 60px 60px;
            }
            
            .table-header span:nth-child(7),
            .table-header span:nth-child(8),
            .table-row span:nth-child(7),
            .table-row span:nth-child(8) {
                display: none;
            }
            
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }
        
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
            
            .league-info {
                flex-direction: column;
                gap: 1.5rem;
            }
            
            .league-actions {
                width: 100%;
                justify-content: center;
            }
            
            .league-tabs {
                flex-direction: column;
            }
            
            .table-header, .table-row {
                grid-template-columns: 40px 1fr 50px 50px 50px;
                padding: 1rem;
                gap: 0.5rem;
            }
            
            .table-header span:nth-child(6),
            .table-row span:nth-child(6) {
                display: none;
            }
            
            .member-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .member-actions {
                width: 100%;
                justify-content: flex-end;
            }
        }
        
        @media (max-width: 576px) {
            .league-content {
                padding: 1rem;
            }
            
            .header {
                padding: 0 1rem;
            }
            
            .table-header, .table-row {
                grid-template-columns: 30px 1fr 40px 40px;
                padding: 0.75rem;
                font-size: 0.9rem;
            }
            
            .table-header span:nth-child(5),
            .table-row span:nth-child(5) {
                display: none;
            }
            
            .team-info {
                gap: 0.5rem;
            }
            
            .team-avatar {
                width: 30px;
                height: 30px;
                font-size: 0.8rem;
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
                <a href="{{ route('help') }}" class="nav-link">
                    <i class="fas fa-question-circle"></i>
                    <span>Help and Support</span>
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
                    <div class="user-avatar">U</div>
                    <div class="user-info">
                        <div class="user-name">User</div>
                        <div class="user-role">Team Manager</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- League Content -->
        <div class="league-content">
            <!-- League Header -->
            <div class="league-header">
                <div class="league-info">
                    <div class="league-main-info">
                        <h1>Premier Champions</h1>
                        <p class="league-description">Standard scoring league for serious competitors</p>
                        <div class="league-meta">
                            <div class="meta-item">
                                <span class="meta-value">CHAMP2024</span>
                                <span class="meta-label">League Code</span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-value">12/20</span>
                                <span class="meta-label">Participants</span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-value">Private</span>
                                <span class="meta-label">Privacy</span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-value">John Smith</span>
                                <span class="meta-label">Admin</span>
                            </div>
                        </div>
                    </div>
                    <div class="league-actions">
                        <a href="{{ route('leagues.index') }}" class="action-btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Leagues
                        </a>
                        <button class="action-btn btn-danger" onclick="leaveLeague()">
                            <i class="fas fa-sign-out-alt"></i> Leave League
                        </button>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            <div class="alert-success" id="successMessage" style="display: none;">
                <i class="fas fa-check-circle"></i>
                <span id="successText"></span>
            </div>

            <!-- Tabs -->
            <div class="league-tabs">
                <button class="tab active" onclick="switchTab('standings')">Standings</button>
                <button class="tab" onclick="switchTab('statistics')">Statistics</button>
                <button class="tab" onclick="switchTab('members')">Members</button>
                <button class="tab" onclick="switchTab('settings')">Settings</button>
            </div>

            <!-- Standings Tab -->
            <div id="standings" class="tab-content active">
                <div class="standings-table">
                    <div class="table-header">
                        <span>#</span>
                        <span>Team</span>
                        <span>P</span>
                        <span>W</span>
                        <span>D</span>
                        <span>L</span>
                        <span>GF</span>
                        <span>PTS</span>
                    </div>
                    
                    <div class="table-row user-team">
                        <span class="position position-1">1</span>
                        <div class="team-info">
                            <div class="team-avatar">TD</div>
                            <div>
                                <div class="team-name">Thunder Dragons</div>
                                <div class="team-manager">You</div>
                            </div>
                        </div>
                        <span class="stat">6</span>
                        <span class="stat">5</span>
                        <span class="stat">1</span>
                        <span class="stat">0</span>
                        <span class="stat">14</span>
                        <span class="stat">16</span>
                    </div>
                    
                    <div class="table-row">
                        <span class="position position-2">2</span>
                        <div class="team-info">
                            <div class="team-avatar">RS</div>
                            <div>
                                <div class="team-name">Red Storm</div>
                                <div class="team-manager">Mike Johnson</div>
                            </div>
                        </div>
                        <span class="stat">6</span>
                        <span class="stat">4</span>
                        <span class="stat">2</span>
                        <span class="stat">0</span>
                        <span class="stat">12</span>
                        <span class="stat">14</span>
                    </div>
                    
                    <div class="table-row">
                        <span class="position position-3">3</span>
                        <div class="team-info">
                            <div class="team-avatar">BG</div>
                            <div>
                                <div class="team-name">Blue Giants</div>
                                <div class="team-manager">Sarah Wilson</div>
                            </div>
                        </div>
                        <span class="stat">6</span>
                        <span class="stat">4</span>
                        <span class="stat">1</span>
                        <span class="stat">1</span>
                        <span class="stat">11</span>
                        <span class="stat">13</span>
                    </div>
                    
                    <!-- Additional rows -->
                    <div class="table-row">
                        <span class="position">4</span>
                        <div class="team-info">
                            <div class="team-avatar">GF</div>
                            <div>
                                <div class="team-name">Golden Falcons</div>
                                <div class="team-manager">Alex Chen</div>
                            </div>
                        </div>
                        <span class="stat">6</span>
                        <span class="stat">3</span>
                        <span class="stat">2</span>
                        <span class="stat">1</span>
                        <span class="stat">10</span>
                        <span class="stat">11</span>
                    </div>
                    
                    <div class="table-row">
                        <span class="position">5</span>
                        <div class="team-info">
                            <div class="team-avatar">SW</div>
                            <div>
                                <div class="team-name">Silver Wolves</div>
                                <div class="team-manager">David Brown</div>
                            </div>
                        </div>
                        <span class="stat">6</span>
                        <span class="stat">2</span>
                        <span class="stat">3</span>
                        <span class="stat">1</span>
                        <span class="stat">8</span>
                        <span class="stat">9</span>
                    </div>
                </div>
            </div>

            <!-- Statistics Tab -->
            <div id="statistics" class="tab-content">
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="stat-value">1st</div>
                        <div class="stat-label">Your Position</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-value">+3</div>
                        <div class="stat-label">Position Change</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-futbol"></i>
                        </div>
                        <div class="stat-value">14</div>
                        <div class="stat-label">Goals For</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="stat-value">4</div>
                        <div class="stat-label">Goals Against</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-percentage"></i>
                        </div>
                        <div class="stat-value">83%</div>
                        <div class="stat-label">Win Rate</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-fire"></i>
                        </div>
                        <div class="stat-value">5</div>
                        <div class="stat-label">Winning Streak</div>
                    </div>
                </div>
            </div>

            <!-- Members Tab -->
            <div id="members" class="tab-content">
                <div class="members-list">
                    <div class="member-item">
                        <div class="member-info">
                            <div class="member-avatar">JS</div>
                            <div class="member-details">
                                <h4>John Smith</h4>
                                <p>Thunder Dragons • 1st Place</p>
                            </div>
                        </div>
                        <span class="admin-badge">Admin</span>
                    </div>
                    
                    <div class="member-item">
                        <div class="member-info">
                            <div class="member-avatar">MJ</div>
                            <div class="member-details">
                                <h4>Mike Johnson</h4>
                                <p>Red Storm • 2nd Place</p>
                            </div>
                        </div>
                        <div class="member-actions">
                            <button class="action-btn btn-secondary" onclick="messageMember('Mike Johnson')">
                                <i class="fas fa-envelope"></i> Message
                            </button>
                        </div>
                    </div>
                    
                    <div class="member-item">
                        <div class="member-info">
                            <div class="member-avatar">SW</div>
                            <div class="member-details">
                                <h4>Sarah Wilson</h4>
                                <p>Blue Giants • 3rd Place</p>
                            </div>
                        </div>
                        <div class="member-actions">
                            <button class="action-btn btn-secondary" onclick="messageMember('Sarah Wilson')">
                                <i class="fas fa-envelope"></i> Message
                            </button>
                        </div>
                    </div>
                    
                    <div class="member-item">
                        <div class="member-info">
                            <div class="member-avatar">AC</div>
                            <div class="member-details">
                                <h4>Alex Chen</h4>
                                <p>Golden Falcons • 4th Place</p>
                            </div>
                        </div>
                        <div class="member-actions">
                            <button class="action-btn btn-secondary" onclick="messageMember('Alex Chen')">
                                <i class="fas fa-envelope"></i> Message
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Tab -->
            <div id="settings" class="tab-content">
                <div class="settings-form">
                    <div class="form-group">
                        <label class="form-label">League Name</label>
                        <input type="text" class="form-input" value="Premier Champions">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">League Description</label>
                        <textarea class="form-textarea">Standard scoring league for serious competitors</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Privacy Setting</label>
                        <select class="form-select">
                            <option value="public">Public</option>
                            <option value="private" selected>Private</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Maximum Participants</label>
                        <input type="number" class="form-input" value="20" min="2" max="50">
                    </div>
                    
                    <div class="form-actions">
                        <button class="action-btn btn-secondary">Cancel</button>
                        <button class="action-btn btn-primary" onclick="saveSettings()">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab switching functionality
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Show selected tab content
            document.getElementById(tabName).classList.add('active');
            
            // Add active class to clicked tab
            event.target.classList.add('active');
        }

        // Success message function
        function showSuccess(message) {
            const successMessage = document.getElementById('successMessage');
            const successText = document.getElementById('successText');
            successText.textContent = message;
            successMessage.style.display = 'flex';
            
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 5000);
        }

        // League actions
        function leaveLeague() {
            if (confirm('Are you sure you want to leave this league? You will lose all your progress in this league.')) {
                // Simulate API call
                setTimeout(() => {
                    showSuccess('You have successfully left the league.');
                    // Redirect to leagues index
                    setTimeout(() => {
                        window.location.href = "{{ route('leagues.index') }}";
                    }, 1500);
                }, 1000);
            }
        }

        function messageMember(memberName) {
            alert(`Message feature would open for ${memberName}. This would typically open a chat modal.`);
        }

        function saveSettings() {
            // Simulate API call
            setTimeout(() => {
                showSuccess('League settings updated successfully!');
            }, 1000);
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Any initialization code can go here
            console.log('League show page loaded');
        });
    </script>
</body>
</html>