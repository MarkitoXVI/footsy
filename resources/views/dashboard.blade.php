<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Footsy Fantasy Football</title>
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
            --sidebar-width: 280px;
            --sidebar-collapsed: 80px;
            --header-height: 70px;
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
        
        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--dark) 0%, #1e2a4a 100%);
            color: white;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 4px 0 25px rgba(58, 94, 229, 0.15);
            overflow-y: auto;
        }
        
        .sidebar.collapsed {
            width: var(--sidebar-collapsed);
        }
        
        .sidebar-header {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .sidebar-logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            font-size: 1.2rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(58, 94, 229, 0.3);
        }
        
        .sidebar-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 1.4rem;
            white-space: nowrap;
            transition: all 0.3s ease;
        }
        
        .sidebar.collapsed .sidebar-title {
            opacity: 0;
            width: 0;
            display: none;
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
            gap: 14px;
            padding: 0.875rem 1.5rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 4px solid transparent;
            white-space: nowrap;
        }
        
        .nav-link:hover, .nav-link.active {
            background: rgba(58, 94, 229, 0.2);
            color: white;
            border-left-color: var(--primary);
        }
        
        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        
        .nav-link span {
            transition: all 0.3s ease;
        }
        
        .sidebar.collapsed .nav-link span {
            opacity: 0;
            width: 0;
            display: none;
        }
        
        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 0.875rem 1rem;
        }
        
        /* Burger Menu Button */
        .burger-menu {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .burger-menu i {
            font-size: 1.2rem;
            color: var(--dark);
        }
        
        .burger-menu:hover {
            background: rgba(58, 94, 229, 0.1);
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 1;
        }
        
        .main-content.expanded {
            margin-left: var(--sidebar-collapsed);
        }
        
        /* Header */
        .header {
            height: var(--header-height);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 15px rgba(58, 94, 229, 0.08);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(58, 94, 229, 0.1);
        }
        
        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .page-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.3rem;
            font-weight: 600;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .search-bar {
            display: flex;
            align-items: center;
            background: var(--light);
            border-radius: 50px;
            padding: 0.5rem 1rem;
            width: 300px;
            border: 1px solid rgba(58, 94, 229, 0.1);
            transition: all 0.3s;
        }
        
        .search-bar:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(58, 94, 229, 0.1);
        }
        
        .search-bar i {
            color: var(--primary);
            margin-right: 0.5rem;
        }
        
        .search-bar input {
            border: none;
            background: transparent;
            width: 100%;
            outline: none;
            font-family: 'Open Sans', sans-serif;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .notification-bell {
            position: relative;
            color: var(--gray);
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .notification-bell:hover {
            color: var(--primary);
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--secondary);
            color: white;
            font-size: 0.7rem;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 12px;
            transition: all 0.3s;
        }
        
        .user-profile:hover {
            background: rgba(58, 94, 229, 0.05);
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(58, 94, 229, 0.2);
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
        
        /* Dashboard Content */
        .dashboard {
            padding: 2rem;
            flex: 1;
        }
        
        /* Welcome Banner */
        .welcome-banner {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(58, 94, 229, 0.2);
        }
        
        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 60%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1), transparent);
        }
        
        .welcome-content h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }
        
        .welcome-content p {
            opacity: 0.9;
        }
        
        .welcome-content a {
            color: white;
            text-decoration: underline;
        }
        
        .welcome-image {
            width: 120px;
            position: relative;
            z-index: 1;
        }
        
        .welcome-image i {
            font-size: 5rem;
            opacity: 0.2;
        }
        
        /* Stats Cards */
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            display: flex;
            align-items: center;
            transition: all 0.3s;
            border: 1px solid rgba(58, 94, 229, 0.1);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(58, 94, 229, 0.15);
            background: white;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(58, 94, 229, 0.1), rgba(58, 94, 229, 0.05));
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 1rem;
        }
        
        .stat-info h3 {
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .stat-info p {
            color: var(--gray);
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }
        
        /* Cards */
        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            margin-bottom: 2rem;
            border: 1px solid rgba(58, 94, 229, 0.1);
            transition: all 0.3s;
        }
        
        .card:hover {
            box-shadow: 0 12px 30px rgba(58, 94, 229, 0.12);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(58, 94, 229, 0.1);
        }
        
        .card-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark);
        }
        
        .view-all {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .view-all:hover {
            color: var(--primary-dark);
            transform: translateX(3px);
        }
        
        /* Player List */
        .player-list {
            list-style: none;
        }
        
        .player-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(58, 94, 229, 0.1);
            transition: all 0.3s;
        }
        
        .player-item:hover {
            background: rgba(58, 94, 229, 0.05);
            border-radius: 8px;
            padding: 1rem 0.75rem;
            margin: 0 -0.75rem;
        }
        
        .player-item:last-child {
            border-bottom: none;
        }
        
        .player-avatar {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: linear-gradient(135deg, rgba(58, 94, 229, 0.1), rgba(58, 94, 229, 0.05));
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-weight: 700;
            color: var(--primary);
            font-size: 1rem;
        }
        
        .player-info {
            flex: 1;
        }
        
        .player-name {
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: var(--dark);
        }
        
        .player-details {
            display: flex;
            font-size: 0.85rem;
            color: var(--gray);
            gap: 1rem;
        }
        
        .player-points {
            background: linear-gradient(135deg, rgba(58, 94, 229, 0.1), rgba(58, 94, 229, 0.05));
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-weight: 700;
            color: var(--primary);
        }
        
        /* Fixtures Preview */
        .fixture-preview-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .fixture-preview-item {
            padding: 1rem 0;
            border-bottom: 1px solid rgba(58, 94, 229, 0.1);
            transition: all 0.3s;
        }
        
        .fixture-preview-item:hover {
            background: rgba(58, 94, 229, 0.05);
            border-radius: 8px;
            padding: 1rem 0.75rem;
            margin: 0 -0.75rem;
        }
        
        .fixture-preview-item:last-child {
            border-bottom: none;
        }
        
        .fixture-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .fixture-teams {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }
        
        .team-side {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            min-width: 0;
        }
        
        .team-right {
            justify-content: flex-end;
            text-align: right;
        }
        
        .team-logo {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(58, 94, 229, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--dark);
            font-size: 0.8rem;
        }
        
        .team-name {
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .fixture-meta {
            text-align: center;
            color: var(--gray);
            font-size: 0.85rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.2rem;
            min-width: 140px;
        }
        
        .fixture-meta .kickoff {
            font-weight: 600;
            color: var(--primary);
        }
        
        .fixture-meta .venue {
            font-size: 0.8rem;
        }
        
        .scoreline {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            color: var(--primary);
            margin-top: 0.25rem;
        }
        
        .scorers-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.25rem 1rem;
            align-items: start;
            justify-items: stretch;
            margin-top: 0.5rem;
        }
        
        .scorers-list {
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 0.8rem;
            color: var(--gray);
        }
        
        .scorers-home {
            text-align: left;
        }
        
        .scorers-away {
            text-align: right;
        }
        
        /* Button styles */
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(58, 94, 229, 0.3);
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(58, 94, 229, 0.4);
        }
        
        /* Overlay for mobile */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        
        .overlay.active {
            display: block;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .search-bar {
                width: 200px;
            }
            
            .user-info {
                display: none;
            }
        }
        
        @media (max-width: 576px) {
            .header {
                padding: 0 1rem;
            }
            
            .search-bar {
                display: none;
            }
            
            .dashboard {
                padding: 1rem;
            }
            
            .welcome-banner {
                flex-direction: column;
                text-align: center;
            }
            
            .welcome-image {
                margin-top: 1rem;
            }
            
            .dashboard-stats {
                grid-template-columns: 1fr;
            }
            
            .fixture-teams {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .fixture-meta {
                min-width: auto;
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
        
        .stat-card, .card {
            animation: fadeInUp 0.5s ease forwards;
        }
    </style>
</head>
<body>
    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay" onclick="closeMobileSidebar()"></div>

    <!-- Sidebar Navigation -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">F</div>
            <div class="sidebar-title">Footsy</div>
        </div>
        
        <ul class="sidebar-nav">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('fantasy-team.index') }}" class="nav-link {{ request()->routeIs('fantasy-team.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>My Team</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('leagues.index') }}" class="nav-link {{ request()->routeIs('leagues.*') ? 'active' : '' }}">
                    <i class="fas fa-trophy"></i>
                    <span>Leagues</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('statistics.index') }}" class="nav-link {{ request()->routeIs('statistics.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Statistics</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('transfers.index') }}" class="nav-link {{ request()->routeIs('transfers.*') ? 'active' : '' }}">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Transfers</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('fixtures.index') }}" class="nav-link {{ request()->routeIs('fixtures.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Fixtures</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('help') }}" class="nav-link {{ request()->routeIs('help') ? 'active' : '' }}">
                    <i class="fas fa-question-circle"></i>
                    <span>Help and Support</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="nav-item">
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
    <div class="main-content" id="mainContent">
        <!-- Header -->
        <header class="header">
            <div class="header-left">
                <button class="burger-menu" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search players, teams, leagues...">
            </div>
            
            <div class="user-menu">
                <div class="notification-bell">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </div>
                
                <div class="user-profile">
                    <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <div class="user-info">
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="user-role">Team Manager</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard">
            <!-- Welcome Banner -->
            <div class="welcome-banner">
                <div class="welcome-content">
                    <h2>Welcome back, {{ Auth::user()->name }}!</h2>
                    @if($userStats['has_team'])
                        <p>Ready for the next gameweek? Check your team's performance below.</p>
                    @else
                        <p>You haven't created a fantasy team yet. <a href="{{ route('fantasy-team.create') }}">Create your team now</a> to start playing!</p>
                    @endif
                </div>
                <div class="welcome-image">
                    <i class="fas fa-futbol"></i>
                </div>
            </div>

            <!-- Stats Cards -->
            @if($userStats['has_team'])
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $userStats['global_rank'] ?? 'N/A' }}</h3>
                            <p>Global Rank</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $userStats['gw_points'] ?? 0 }}</h3>
                            <p>GW Points</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $userStats['leagues_joined'] ?? 0 }}</h3>
                            <p>Leagues Joined</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $userStats['free_transfers'] ?? '0/1' }}</h3>    
                            <p>Free Transfers</p>
                        </div>
                    </div>
                </div>
            @endif  

            <!-- Main Dashboard Grid -->
            <div class="dashboard-grid">
                <!-- Left Column -->
                <div class="left-column">
                    @if($userStats['has_team'])
                        <!-- My Team Card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">My Team</h3>
                                <a href="{{ route('fantasy-team.index') }}" class="view-all">Manage Team</a>
                            </div>
                            
                            <ul class="player-list">
                                @forelse($myTeamPlayers as $player)
                                    <li class="player-item">
                                        <div class="player-avatar">
                                            {{ strtoupper(substr($player->name, 0, 2)) }}
                                        </div>
                                        <div class="player-info">
                                            <div class="player-name">{{ $player->name }}</div>
                                            <div class="player-details">
                                                <span>{{ $player->team->short_name ?? ($player->team->name ?? 'N/A') }}</span>
                                                <span>£{{ $player->price }}m</span>
                                            </div>
                                        </div>
                                        <div class="player-points">{{ $player->points }} pts</div>
                                    </li>
                                @empty
                                    <li class="player-item">
                                        <div class="player-info">No players found.</div>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    @else
                        <!-- Prompt to create a team -->
                        <div class="card" style="text-align: center; padding: 2rem;">
                            <h3>You don't have a fantasy team yet</h3>
                            <p>Create your fantasy team to start competing with other managers</p>
                            <a href="{{ route('fantasy-team.create') }}" class="btn" style="margin-top: 1rem; display: inline-block; width: auto;">
                                Create Your Team
                            </a>
                        </div>
                    @endif

                    <!-- Upcoming Fixtures Section -->
                    @if(isset($topGames) && count($topGames) > 0)
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Top Games</h3>
                                <a href="{{ route('fixtures.index') }}" class="view-all">View All</a>
                            </div>
                            
                            <ul class="fixture-preview-list">
                                @foreach($topGames as $fixture)
                                    <li class="fixture-preview-item">
                                        <a href="{{ isset($fixture->id) ? route('fixtures.show', $fixture->id) : route('fixtures.index') }}" class="fixture-link">
                                            <div class="fixture-teams">
                                                <div class="team-side">
                                                    <div class="team-logo">
                                                        {{ isset($fixture->homeTeam) ? substr($fixture->homeTeam->short_name, 0, 3) : (isset($fixture->home_team) ? substr($fixture->home_team->short_name, 0, 3) : 'HOM') }}
                                                    </div>
                                                    <div class="team-name">
                                                        {{ isset($fixture->homeTeam) ? $fixture->homeTeam->name : (isset($fixture->home_team) ? $fixture->home_team->name : 'Home Team') }}
                                                    </div>
                                                </div>
                                                <div class="fixture-meta">
                                                    @if(isset($fixture->score_home) && isset($fixture->score_away))
                                                        <div class="scoreline">{{ $fixture->score_home }} - {{ $fixture->score_away }}</div>
                                                    @endif
                                                    @if(!empty($fixture->kickoff_time ?? null))
                                                        <div class="kickoff">
                                                            @if($fixture->kickoff_time instanceof \Carbon\Carbon)
                                                                {{ $fixture->kickoff_time->format('D, M j • g:i A') }}
                                                            @else
                                                                {{ \Carbon\Carbon::parse($fixture->kickoff_time)->format('D, M j • g:i A') }}
                                                            @endif
                                                        </div>
                                                    @endif
                                                    @if(!empty($fixture->stadium ?? ''))
                                                        <div class="venue">{{ $fixture->stadium }}</div>
                                                    @endif
                                                    @if(isset($fixture->scorers_home) || isset($fixture->scorers_away))
                                                        <div class="scorers-row">
                                                            <ul class="scorers-list scorers-home">
                                                                @foreach(($fixture->scorers_home ?? []) as $sh)
                                                                    <li>{{ $sh }}</li>
                                                                @endforeach
                                                            </ul>
                                                            <ul class="scorers-list scorers-away">
                                                                @foreach(($fixture->scorers_away ?? []) as $sa)
                                                                    <li>{{ $sa }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="team-side team-right">
                                                    <div class="team-name">
                                                        {{ isset($fixture->awayTeam) ? $fixture->awayTeam->name : (isset($fixture->away_team) ? $fixture->away_team->name : 'Away Team') }}
                                                    </div>
                                                    <div class="team-logo">
                                                        {{ isset($fixture->awayTeam) ? substr($fixture->awayTeam->short_name, 0, 3) : (isset($fixture->away_team) ? substr($fixture->away_team->short_name, 0, 3) : 'AWY') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                
                <!-- Right Column -->
                <div class="right-column">
                    <!-- League Standings Card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">League Standings</h3>
                            <a href="{{ route('leagues.index') }}" class="view-all">View All</a>
                        </div>
                        
                        <ul class="player-list">
                            <li class="player-item">
                                <div class="player-avatar" style="background: linear-gradient(135deg, #FFD700, #FFA500); color: white;">1</div>
                                <div class="player-info">
                                    <div class="player-name">Red Devils FC</div>
                                    <div class="player-details">
                                        <span>James Wilson</span>
                                    </div>
                                </div>
                                <div class="player-points">268</div>
                            </li>
                            
                            <li class="player-item">
                                <div class="player-avatar" style="background: linear-gradient(135deg, #C0C0C0, #A0A0A0); color: white;">2</div>
                                <div class="player-info">
                                    <div class="player-name">Blue Warriors</div>
                                    <div class="player-details">
                                        <span>Sarah Johnson</span>
                                    </div>
                                </div>
                                <div class="player-points">247</div>
                            </li>
                            
                            <li class="player-item">
                                <div class="player-avatar" style="background: linear-gradient(135deg, #CD7F32, #A66C2A); color: white;">3</div>
                                <div class="player-info">
                                    <div class="player-name">Cityzens</div>
                                    <div class="player-details">
                                        <span>Michael Brown</span>
                                    </div>
                                </div>
                                <div class="player-points">232</div>
                            </li>
                            
                            <li class="player-item" style="background: rgba(58, 94, 229, 0.08); border-radius: 12px; margin: 0 -0.75rem; padding: 1rem 0.75rem;">
                                <div class="player-avatar" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white;">124</div>
                                <div class="player-info">
                                    <div class="player-name">{{ Auth::user()->name }}</div>
                                    <div class="player-details">
                                        <span>Your Team</span>
                                    </div>
                                </div>
                                <div class="player-points">{{ $userStats['total_points'] ?? 0 }}</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sidebar toggle functionality
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const overlay = document.getElementById('overlay');
            
            if (window.innerWidth <= 768) {
                // Mobile behavior
                sidebar.classList.toggle('mobile-open');
                overlay.classList.toggle('active');
            } else {
                // Desktop behavior - collapse/expand
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            }
        }
        
        function closeMobileSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('active');
        }
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                !event.target.closest('.burger-menu')) {
                sidebar.classList.remove('mobile-open');
                overlay.classList.remove('active');
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            
            if (window.innerWidth > 768) {
                sidebar.classList.remove('mobile-open');
                overlay.classList.remove('active');
            }
        });
        
        // Simple notifications toggle
        document.addEventListener('DOMContentLoaded', function() {
            const notificationBell = document.querySelector('.notification-bell');
            
            if (notificationBell) {
                notificationBell.addEventListener('click', function() {
                    alert('You have 3 new notifications!');
                });
            }
        });
    </script>
</body>
</html>