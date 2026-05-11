<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leagues - Footsy Fantasy Football</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3a5ee5;
            --primary-dark: #2a48c5;
            --primary-light: #5b7ae8;
            --secondary: #34c759;
            --danger: #e53e3e;
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
        
        /* Leagues Content */
        .leagues-content {
            padding: 2rem;
            flex: 1;
        }
        
        .leagues-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .leagues-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .create-league-btn {
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(58, 94, 229, 0.3);
        }
        
        .create-league-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(58, 94, 229, 0.4);
        }
        
        /* Search and Filter */
        .search-filter {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .search-box {
            position: relative;
            flex: 1;
            min-width: 250px;
        }
        
        .search-input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 2.75rem;
            border: 2px solid rgba(58, 94, 229, 0.1);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s;
            font-family: 'Open Sans', sans-serif;
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(58, 94, 229, 0.1);
        }
        
        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
        }
        
        .filter-select {
            padding: 0.875rem 1rem;
            border: 2px solid rgba(58, 94, 229, 0.1);
            border-radius: 12px;
            background: white;
            font-size: 1rem;
            color: var(--dark);
            font-family: 'Open Sans', sans-serif;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .filter-select:focus {
            outline: none;
            border-color: var(--primary);
        }
        
        /* League Sections */
        .league-section {
            margin-bottom: 3rem;
        }
        
        .section-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid rgba(58, 94, 229, 0.2);
            color: var(--dark);
        }
        
        /* League Cards */
        .league-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(58, 94, 229, 0.1);
        }
        
        .league-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(58, 94, 229, 0.15);
            background: white;
            border-color: rgba(58, 94, 229, 0.2);
        }
        
        .league-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        
        .league-name {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark);
        }
        
        .league-code {
            background: rgba(58, 94, 229, 0.1);
            color: var(--primary);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 0.25rem;
            display: inline-block;
        }
        
        .league-status {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .status-joined {
            background: rgba(52, 199, 89, 0.1);
            color: var(--secondary);
            border: 1px solid rgba(52, 199, 89, 0.2);
        }
        
        .status-admin {
            background: linear-gradient(135deg, rgba(58, 94, 229, 0.2), rgba(58, 94, 229, 0.1));
            color: var(--primary);
            border: 1px solid var(--primary);
        }
        
        .status-public {
            background: rgba(58, 94, 229, 0.1);
            color: var(--primary);
        }
        
        .status-private {
            background: rgba(108, 117, 125, 0.1);
            color: var(--gray);
        }
        
        .league-description {
            color: var(--gray);
            margin-bottom: 1rem;
            line-height: 1.6;
        }
        
        .league-admin {
            font-size: 0.9rem;
            color: var(--gray);
            margin-bottom: 1rem;
        }
        
        .league-details {
            display: flex;
            gap: 2rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }
        
        .league-detail {
            display: flex;
            flex-direction: column;
        }
        
        .detail-value {
            font-weight: 700;
            font-size: 1.2rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .detail-label {
            font-size: 0.8rem;
            color: var(--gray);
            font-weight: 500;
        }
        
        .league-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .league-btn {
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 2px 8px rgba(58, 94, 229, 0.2);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(58, 94, 229, 0.3);
        }
        
        .btn-secondary {
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
        }
        
        .btn-secondary:hover {
            background: rgba(58, 94, 229, 0.1);
            transform: translateY(-2px);
        }
        
        .btn-danger {
            background: white;
            color: var(--danger);
            border: 2px solid var(--danger);
        }
        
        .btn-danger:hover {
            background: rgba(229, 62, 62, 0.1);
            transform: translateY(-2px);
        }
        
        /* Success Message */
        .alert-success {
            background: linear-gradient(135deg, rgba(52, 199, 89, 0.1), rgba(52, 199, 89, 0.05));
            border: 1px solid rgba(52, 199, 89, 0.3);
            color: var(--secondary);
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        /* Empty State */
        .empty-state {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            border: 1px solid rgba(58, 94, 229, 0.1);
        }
        
        .empty-icon {
            font-size: 3rem;
            color: var(--primary);
            opacity: 0.5;
            margin-bottom: 1rem;
        }
        
        .empty-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.4rem;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }
        
        .empty-text {
            color: var(--gray);
            margin-bottom: 1.5rem;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            animation: modalFadeIn 0.3s ease;
        }
        
        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .modal-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--gray);
            transition: color 0.3s;
        }
        
        .close-modal:hover {
            color: var(--danger);
        }
        
        .modal-body {
            margin-bottom: 2rem;
            color: var(--gray);
        }
        
        .modal-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
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
            
            .leagues-header {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-filter {
                flex-direction: column;
            }
            
            .league-actions {
                flex-direction: column;
            }
            
            .league-btn {
                width: 100%;
                justify-content: center;
            }
        }
        
        @media (max-width: 576px) {
            .leagues-content {
                padding: 1rem;
            }
            
            .header {
                padding: 0 1rem;
            }
            
            .league-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .league-details {
                gap: 1rem;
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
        
        .league-card {
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
                <a href="{{ route('leagues.index') }}" class="nav-link active">
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
@if(Auth::user()->profile_photo_path)
    <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" 
         class="user-avatar" style="object-fit: cover;" alt="Avatar">
@else
    <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
@endif                    <div class="user-info">
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="user-role">Team Manager</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Leagues Content -->
        <div class="leagues-content">
            <div class="leagues-header">
                <a href="{{ route('leagues.create') }}" class="create-league-btn">
                    <i class="fas fa-plus"></i> Create New League
                </a>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert-success" id="successMessage">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Search and Filter -->
            <div class="search-filter">
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" id="searchInput" placeholder="Search leagues...">
                </div>
                <select class="filter-select" id="filterSelect">
                    <option value="all">All Leagues</option>
                    <option value="public">Public Leagues</option>
                    <option value="private">Private Leagues</option>
                    <option value="joined">Leagues I've Joined</option>
                    <option value="admin">My Leagues</option>
                </select>
            </div>

            <!-- ====================== MY LEAGUES (ADMIN) ====================== -->
            <div class="league-section" id="adminLeaguesSection">
                <h2 class="section-title">My Leagues</h2>
                
                @if($adminLeagues->isNotEmpty())
                    @foreach($adminLeagues as $league)
                        <div class="league-card" data-league-name="{{ strtolower($league->name) }}" data-league-type="admin" data-league-privacy="{{ $league->privacy ?? 'private' }}">
                            <div class="league-header">
                                <div>
                                    <h3 class="league-name">{{ $league->name }}</h3>
                                    <div class="league-code">Code: {{ $league->code }}</div>
                                </div>
                                <span class="league-status status-admin">Admin</span>
                            </div>
                            <p class="league-description">{{ $league->description ?? 'No description provided.' }}</p>
                            <p class="league-admin">
                                <i class="fas fa-user-shield"></i> Admin: {{ Auth::user()->name }} •
                                <i class="fas fa-calendar-alt"></i> Created: {{ $league->created_at->format('F j, Y') }}
                            </p>
                            <div class="league-details">
                                <div class="league-detail">
                                    <span class="detail-value">{{ $league->participants_count ?? 1 }}</span>
                                    <span class="detail-label">Participants</span>
                                </div>
                                <div class="league-detail">
                                    <span class="detail-value">{{ ucfirst($league->privacy ?? 'private') }}</span>
                                    <span class="detail-label">Privacy</span>
                                </div>
                                <div class="league-detail">
                                    <span class="detail-value">-</span>
                                    <span class="detail-label">Your Rank</span>
                                </div>
                            </div>
                            <div class="league-actions">
                                <a class="league-btn btn-primary" href="{{ route('leagues.show', $league->id) }}">
                                    <i class="fas fa-chart-line"></i> Manage League
                                </a>
                                <button type="button" class="league-btn btn-danger"
                                        onclick="deleteLeague({{ $league->id }}, '{{ addslashes($league->name) }}')">
                                    <i class="fas fa-trash"></i> Delete League
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <div class="empty-icon"><i class="fas fa-trophy"></i></div>
                        <h3 class="empty-title">No Leagues Created</h3>
                        <p class="empty-text">
                            You haven't created any leagues yet. Create your first league to start competing with friends!
                        </p>
                        <a href="{{ route('leagues.create') }}" class="create-league-btn">
                            <i class="fas fa-plus"></i> Create Your First League
                        </a>
                    </div>
                @endif
            </div>

            <!-- ====================== LEAGUES I'VE JOINED ====================== -->
            @if($participantLeagues->isNotEmpty())
                <div class="league-section" id="joinedLeaguesSection">
                    <h2 class="section-title">Leagues I've Joined</h2>
                    @foreach($participantLeagues as $league)
                        <div class="league-card" data-league-name="{{ strtolower($league->name) }}" data-league-type="joined" data-league-privacy="{{ $league->privacy ?? 'private' }}">
                           <div class="league-header">
                                <div>
                                    <h3 class="league-name">{{ $league->name }}</h3>
                                    @if($league->privacy === 'private')
                                        <div class="league-code">Code: {{ $league->code }}</div>
                                    @endif
                                </div>
                                <span class="league-status status-joined">Joined</span>
                            </div>
                            <p class="league-description">{{ $league->description ?? 'No description provided' }}</p>
                            <p class="league-admin">
                                <i class="fas fa-user-shield"></i> Admin: {{ $league->admin->name ?? 'Unknown' }} •
                                <i class="fas fa-calendar-alt"></i> Created: {{ $league->created_at->format('F j, Y') }}
                            </p>
                            <div class="league-details">
                                <div class="league-detail">
                                    <span class="detail-value">{{ $league->participants_count ?? 1 }}</span>
                                    <span class="detail-label">Participants</span>
                                </div>
                                <div class="league-detail">
                                    <span class="detail-value">{{ ucfirst($league->privacy ?? 'private') }}</span>
                                    <span class="detail-label">Privacy</span>
                                </div>
                                <div class="league-detail">
                                    <!-- FIXED: now reads from pivot -->
                                    <span class="detail-value">{{ $league->pivot->rank ?? '-' }}</span>
                                    <span class="detail-label">Your Rank</span>
                                </div>
                            </div>
                            <div class="league-actions">
                                <a class="league-btn btn-primary" href="{{ route('leagues.show', $league->id) }}">
                                    <i class="fas fa-chart-line"></i> View Standings
                                </a>
                                <button class="league-btn btn-danger" onclick="leaveLeague({{ $league->id }}, '{{ addslashes($league->name) }}')">
                                    <i class="fas fa-sign-out-alt"></i> Leave League
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Other Leagues Section -->
            <div class="league-section" id="otherLeaguesSection">
                <h2 class="section-title">Other Leagues to Join</h2>
                @if($otherLeagues->count() > 0)
                    @foreach($otherLeagues as $league)
                        <div class="league-card" data-league-name="{{ strtolower($league->name) }}" data-league-type="other" data-league-privacy="{{ $league->privacy ?? 'public' }}">
                            <div class="league-header">
                                <div>
                                    <h3 class="league-name">{{ $league->name }}</h3>
                                    <div class="league-code">Code: {{ $league->code }}</div>
                                </div>
                                <span class="league-status {{ $league->privacy === 'public' ? 'status-public' : 'status-private' }}">
                                    {{ ucfirst($league->privacy ?? 'public') }}
                                </span>
                            </div>
                            
                            <p class="league-description">{{ $league->description ?? 'No description provided' }}</p>
                            
                            <p class="league-admin">
                                <i class="fas fa-user-shield"></i> Admin: {{ $league->admin->name ?? 'Unknown' }} • 
                                <i class="fas fa-calendar-alt"></i> Created: {{ $league->created_at->format('F j, Y') }}
                            </p>
                            
                            <div class="league-details">
                                <div class="league-detail">
                                    <span class="detail-value">{{ $league->participants_count ?? 0 }}</span>
                                    <span class="detail-label">Participants</span>
                                </div>
                                <div class="league-detail">
                                    <span class="detail-value">{{ ucfirst($league->privacy ?? 'public') }}</span>
                                    <span class="detail-label">Privacy</span>
                                </div>
                            </div>
                            
                            <div class="league-actions">
                                <form method="POST" action="{{ route('leagues.join', $league->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="league-btn btn-primary">
                                        <i class="fas fa-sign-in-alt"></i> Join League
                                    </button>
                                </form>
                                <a class="league-btn btn-secondary" href="{{ route('leagues.show', $league->id) }}">
                                    <i class="fas fa-info-circle"></i> View Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="empty-title">No Other Leagues Available</h3>
                        <p class="empty-text">There are no other public leagues available to join at the moment. Create your own league and invite friends!</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Confirmation Modal -->
        <div class="modal" id="confirmationModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalTitle">Confirm Action</h3>
                    <button class="close-modal" onclick="closeModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage">Are you sure you want to perform this action?</p>
                </div>
                <div class="modal-actions">
                    <button class="league-btn btn-secondary" onclick="closeModal()">Cancel</button>
                    <button class="league-btn btn-primary" id="confirmAction">Confirm</button>
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
                sidebar.classList.toggle('mobile-open');
                overlay.classList.toggle('active');
            } else {
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

        // Modal functionality
        let currentAction = null;
        let currentLeagueId = null;

        function showModal(title, message, confirmCallback) {
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalMessage').textContent = message;
            document.getElementById('confirmationModal').style.display = 'flex';
            currentAction = confirmCallback;
        }

        function closeModal() {
            document.getElementById('confirmationModal').style.display = 'none';
            currentAction = null;
            currentLeagueId = null;
        }

        function showSuccess(message) {
            const successMessage = document.getElementById('successMessage');
            if (successMessage) {
                const successText = successMessage.querySelector('span');
                successText.textContent = message;
                successMessage.style.display = 'flex';
                
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 5000);
            } else {
                alert(message);
            }
        }

        // League actions
        function leaveLeague(leagueId, leagueName) {
            showModal(
                'Leave League',
                `Are you sure you want to leave "${leagueName}"? You will lose all your progress in this league.`,
                () => {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `{{ url('leagues') }}/${leagueId}/leave`;

                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';

                    form.appendChild(csrfInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            );
        }
        function deleteLeague(leagueId, leagueName) {
            showModal(
                'Delete League',
                `Are you sure you want to delete "${leagueName}"? This action cannot be undone and all league data will be permanently lost.`,
                () => {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    // Use the exact resource route pattern
                    form.action = `{{ url('leagues') }}/${leagueId}`;

                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';

                    form.appendChild(csrfInput);
                    form.appendChild(methodInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            );
        }

        // Search and filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const filterSelect = document.getElementById('filterSelect');
            const leagueCards = document.querySelectorAll('.league-card');

            // Modal confirm button
            const confirmBtn = document.getElementById('confirmAction');
            if (confirmBtn) {
                confirmBtn.addEventListener('click', function() {
                    if (currentAction) {
                        currentAction();
                    }
                });
            }

            // Search functionality
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    
                    leagueCards.forEach(card => {
                        const leagueName = card.querySelector('.league-name')?.textContent.toLowerCase() || '';
                        const leagueDescription = card.querySelector('.league-description')?.textContent.toLowerCase() || '';
                        
                        if (leagueName.includes(searchTerm) || leagueDescription.includes(searchTerm)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }

            // Filter functionality
            if (filterSelect) {
                filterSelect.addEventListener('change', function() {
                    const filterValue = this.value;
                    
                    leagueCards.forEach(card => {
                        const statusElement = card.querySelector('.league-status');
                        if (!statusElement) return;
                        
                        const statusText = statusElement.textContent.toLowerCase();
                        
                        switch (filterValue) {
                            case 'all':
                                card.style.display = 'block';
                                break;
                            case 'joined':
                                card.style.display = (statusText === 'joined') ? 'block' : 'none';
                                break;
                            case 'admin':
                                card.style.display = (statusText === 'admin') ? 'block' : 'none';
                                break;
                            case 'public':
                                card.style.display = (statusText === 'public') ? 'block' : 'none';
                                break;
                            case 'private':
                                card.style.display = (statusText === 'private') ? 'block' : 'none';
                                break;
                            default:
                                card.style.display = 'block';
                        }
                    });
                });
            }

            // Close modal when clicking outside
            const modal = document.getElementById('confirmationModal');
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeModal();
                    }
                });
            }

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeModal();
                }
            });

            // Auto-hide success message after 5 seconds
            const successMessage = document.getElementById('successMessage');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 5000);
            }
        });
    </script>
</body>
</html>