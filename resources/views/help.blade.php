<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help & Rules - Footsy Fantasy Football</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3a5ee5;
            --primary-dark: #2a48c5;
            --primary-light: #5b7ae8;
            --secondary: #34c759;
            --danger: #e53e3e;
            --warning: #f59e0b;
            --info: #0ea5e9;
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
        
        /* Help Content */
        .help-content {
            padding: 2rem;
            flex: 1;
        }
        
        .help-header {
            margin-bottom: 2rem;
        }
        
        .help-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .help-subtitle {
            color: var(--gray);
            font-size: 1rem;
        }
        
        /* Help Navigation */
        .help-nav {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .help-tab {
            padding: 0.75rem 1.5rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(58, 94, 229, 0.1);
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--dark);
        }
        
        .help-tab.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border-color: transparent;
            box-shadow: 0 4px 12px rgba(58, 94, 229, 0.3);
        }
        
        .help-tab:hover:not(.active) {
            border-color: var(--primary);
            transform: translateY(-2px);
        }
        
        /* Rules Grid */
        .rules-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .rule-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary);
            border: 1px solid rgba(58, 94, 229, 0.1);
        }
        
        .rule-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(58, 94, 229, 0.15);
        }
        
        .rule-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .rule-card-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
        }
        
        .rule-card-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }
        
        .icon-primary { background: rgba(58, 94, 229, 0.1); color: var(--primary); }
        .icon-secondary { background: rgba(52, 199, 89, 0.1); color: var(--secondary); }
        .icon-warning { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .icon-danger { background: rgba(229, 62, 62, 0.1); color: var(--danger); }
        
        .rule-card-content {
            color: var(--gray);
            line-height: 1.6;
        }
        
        .rule-card-content strong {
            color: var(--primary);
        }
        
        /* Scoring System */
        .scoring-system {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            margin-bottom: 2rem;
            border: 1px solid rgba(58, 94, 229, 0.1);
        }
        
        .scoring-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .scoring-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark);
        }
        
        .scoring-tabs {
            display: flex;
            gap: 0.5rem;
        }
        
        .scoring-tab {
            padding: 0.5rem 1rem;
            border: 1px solid rgba(58, 94, 229, 0.2);
            border-radius: 50px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s;
            background: white;
        }
        
        .scoring-tab.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border-color: transparent;
        }
        
        .scoring-tab:hover:not(.active) {
            border-color: var(--primary);
        }
        
        .scoring-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .scoring-table th, .scoring-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(58, 94, 229, 0.1);
        }
        
        .scoring-table th {
            font-weight: 600;
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .scoring-table td {
            font-size: 0.9rem;
        }
        
        .points-positive {
            color: var(--secondary);
            font-weight: 700;
        }
        
        .points-negative {
            color: var(--danger);
            font-weight: 700;
        }
        
        /* FAQ Section */
        .faq-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            margin-bottom: 2rem;
            border: 1px solid rgba(58, 94, 229, 0.1);
        }
        
        .faq-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .faq-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark);
        }
        
        .faq-search {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 50px;
            padding: 0.5rem 1rem;
            width: 300px;
            border: 1px solid rgba(58, 94, 229, 0.2);
            transition: all 0.3s;
        }
        
        .faq-search:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(58, 94, 229, 0.1);
        }
        
        .faq-search i {
            color: var(--primary);
            margin-right: 0.5rem;
        }
        
        .faq-search input {
            border: none;
            background: transparent;
            width: 100%;
            outline: none;
            font-family: 'Open Sans', sans-serif;
        }
        
        .faq-list {
            list-style: none;
        }
        
        .faq-item {
            border-bottom: 1px solid rgba(58, 94, 229, 0.1);
        }
        
        .faq-item:last-child {
            border-bottom: none;
        }
        
        .faq-question {
            width: 100%;
            background: none;
            border: none;
            padding: 1.25rem 0;
            text-align: left;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s;
            color: var(--dark);
            font-size: 1rem;
        }
        
        .faq-question:hover {
            color: var(--primary);
        }
        
        .faq-question i {
            transition: transform 0.3s;
            color: var(--primary);
        }
        
        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }
        
        .faq-answer {
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .faq-item.active .faq-answer {
            padding: 0 0 1.25rem;
            max-height: 500px;
        }
        
        .faq-answer p {
            color: var(--gray);
            line-height: 1.6;
        }
        
        /* Bonus Points Section */
        .bonus-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            margin-bottom: 2rem;
            border: 1px solid rgba(58, 94, 229, 0.1);
        }
        
        .bonus-header {
            margin-bottom: 1.5rem;
        }
        
        .bonus-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }
        
        .bonus-description-text {
            color: var(--gray);
            margin-bottom: 1.5rem;
        }
        
        .bonus-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .bonus-card {
            border: 2px solid rgba(58, 94, 229, 0.1);
            border-radius: 16px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s;
            background: white;
        }
        
        .bonus-card:hover {
            border-color: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(58, 94, 229, 0.1);
        }
        
        .bonus-rank {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.3rem;
            margin: 0 auto 1rem;
            color: white;
        }
        
        .rank-1 { background: linear-gradient(135deg, #FFD700, #FFA500); }
        .rank-2 { background: linear-gradient(135deg, #C0C0C0, #A0A0A0); }
        .rank-3 { background: linear-gradient(135deg, #CD7F32, #A66C2A); }
        
        .bonus-points {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }
        
        .bonus-description {
            color: var(--gray);
            font-size: 0.85rem;
        }
        
        .bps-info {
            margin-top: 1.5rem;
            padding: 1.5rem;
            background: rgba(58, 94, 229, 0.05);
            border-radius: 12px;
        }
        
        .bps-info h4 {
            margin-bottom: 0.75rem;
            font-family: 'Montserrat', sans-serif;
            color: var(--primary);
        }
        
        .bps-info p {
            color: var(--gray);
            line-height: 1.6;
        }
        
        /* Pro Tip */
        .pro-tip {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 20px;
            padding: 2rem;
            color: white;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .pro-tip::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 60%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1), transparent);
        }
        
        .pro-tip-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }
        
        .pro-tip-icon {
            font-size: 2rem;
        }
        
        .pro-tip-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
        }
        
        .pro-tip-content {
            opacity: 0.95;
            line-height: 1.6;
            position: relative;
            z-index: 1;
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
            .rules-grid {
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
            
            .user-info {
                display: none;
            }
            
            .help-nav {
                flex-direction: column;
            }
            
            .help-tab {
                text-align: center;
            }
            
            .scoring-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .scoring-tabs {
                width: 100%;
            }
            
            .scoring-tab {
                flex: 1;
                text-align: center;
            }
            
            .faq-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .faq-search {
                width: 100%;
            }
        }
        
        @media (max-width: 576px) {
            .help-content {
                padding: 1rem;
            }
            
            .header {
                padding: 0 1rem;
            }
            
            .bonus-grid {
                grid-template-columns: 1fr;
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
        
        .rule-card, .scoring-system, .faq-section, .bonus-section, .pro-tip {
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
                <a href="{{ route('help') }}" class="nav-link active">
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
                    <button type="submit" class="nav-link" style="background:none;border:none;width:100%;text-align:left;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Log Out</span>
                    </button>
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
            
            <div class="user-menu">
                <div class="user-profile">
                                @if(Auth::user()->profile_photo_path)
                <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" 
                    class="user-avatar" style="object-fit: cover;" alt="Avatar">
            @else
                <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
            @endif
                    <div class="user-info">
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="user-role">Team Manager</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Help Content -->
        <div class="help-content">
            <div class="help-header">
                <h1 class="help-title">Help & Rules Center</h1>
                <p class="help-subtitle">Everything you need to know to master Footsy Fantasy Football</p>
            </div>

            <!-- Help Navigation -->
            <div class="help-nav">
                <div class="help-tab active" onclick="showHelpTab('rules', this)">Game Rules</div>
                <div class="help-tab" onclick="showHelpTab('scoring', this)">Scoring System</div>
                <div class="help-tab" onclick="showHelpTab('bonus', this)">Bonus Points</div>
                <div class="help-tab" onclick="showHelpTab('faq', this)">FAQ</div>
            </div>

            <!-- Rules Tab -->
            <div id="rules-tab" class="tab-content">
                <!-- Rules Grid -->
                <div class="rules-grid">
                    <div class="rule-card">
                        <div class="rule-card-header">
                            <h3 class="rule-card-title">Team Creation</h3>
                            <div class="rule-card-icon icon-primary">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="rule-card-content">
                            <p>Build your squad with a <strong>$100m budget</strong>. Select 15 players: 2 GKs, 5 DEFs, 5 MIDs, 3 FWDs. Maximum 3 players from any real team.</p>
                        </div>
                    </div>
                    
                    <div class="rule-card">
                        <div class="rule-card-header">
                            <h3 class="rule-card-title">Transfers</h3>
                            <div class="rule-card-icon icon-secondary">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                        </div>
                        <div class="rule-card-content">
                            <p><strong>1 free transfer</strong> per gameweek. Additional transfers cost -4 points each. Transfers lock at gameweek deadline.</p>
                        </div>
                    </div>
                    
                    <div class="rule-card">
                        <div class="rule-card-header">
                            <h3 class="rule-card-title">Captain & Vice-Captain</h3>
                            <div class="rule-card-icon icon-warning">
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="rule-card-content">
                            <p><strong>Captain earns double points</strong>. Vice-captain replaces captain if they don't play. Choose wisely for maximum points!</p>
                        </div>
                    </div>
                    
                    <div class="rule-card">
                        <div class="rule-card-header">
                            <h3 class="rule-card-title">Leagues</h3>
                            <div class="rule-card-icon icon-danger">
                                <i class="fas fa-trophy"></i>
                            </div>
                        </div>
                        <div class="rule-card-content">
                            <p>Join global leagues or create private leagues with friends. Compete weekly and climb the rankings to become the ultimate fantasy manager.</p>
                        </div>
                    </div>
                </div>

                <!-- Pro Tip -->
                <div class="pro-tip">
                    <div class="pro-tip-header">
                        <div class="pro-tip-icon">💡</div>
                        <h3 class="pro-tip-title">Pro Tip</h3>
                    </div>
                    <div class="pro-tip-content">
                        Always check upcoming fixtures before selecting your captain. Players facing weaker opposition often have higher scoring potential. Also, monitor player form and injury news to make informed transfer decisions.
                    </div>
                </div>
            </div>

            <!-- Scoring System Tab -->
            <div id="scoring-tab" class="tab-content" style="display: none;">
                <div class="scoring-system">
                    <div class="scoring-header">
                        <h3 class="scoring-title">Scoring System</h3>
                        <div class="scoring-tabs">
                            <span class="scoring-tab active" onclick="showScoringTab('attacking', this)">Attacking</span>
                            <span class="scoring-tab" onclick="showScoringTab('defensive', this)">Defensive</span>
                            <span class="scoring-tab" onclick="showScoringTab('disciplinary', this)">Disciplinary</span>
                        </div>
                    </div>
                    
                    <!-- Attacking Scoring -->
                    <div id="attacking-scoring" class="scoring-tab-content">
                        <table class="scoring-table">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>Goal (Forward)</td><td class="points-positive">+4</td></tr>
                                <tr><td>Goal (Midfielder)</td><td class="points-positive">+5</td></tr>
                                <tr><td>Goal (Defender / GK)</td><td class="points-positive">+6</td></tr>
                                <tr><td>Assist</td><td class="points-positive">+3</td></tr>
                                <tr><td>Shot on Target</td><td class="points-positive">+1</td></tr>
                                <tr><td>Key Pass</td><td class="points-positive">+1</td></tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Defensive Scoring -->
                    <div id="defensive-scoring" class="scoring-tab-content" style="display: none;">
                        <table class="scoring-table">
                            <thead><tr><th>Action</th><th>Points</th></tr></thead>
                            <tbody>
                                <tr><td>Clean Sheet (DEF / GK)</td><td class="points-positive">+4</td></tr>
                                <tr><td>Clean Sheet (MID)</td><td class="points-positive">+1</td></tr>
                                <tr><td>Save (GK)</td><td class="points-positive">+1</td></tr>
                                <tr><td>Penalty Save</td><td class="points-positive">+5</td></tr>
                                <tr><td>Tackle Won</td><td class="points-positive">+1</td></tr>
                                <tr><td>Interception</td><td class="points-positive">+1</td></tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Disciplinary Scoring -->
                    <div id="disciplinary-scoring" class="scoring-tab-content" style="display: none;">
                        <table class="scoring-table">
                            <thead><tr><th>Action</th><th>Points</th></tr></thead>
                            <tbody>
                                <tr><td>Yellow Card</td><td class="points-negative">-1</td></tr>
                                <tr><td>Red Card</td><td class="points-negative">-3</td></tr>
                                <tr><td>Own Goal</td><td class="points-negative">-2</td></tr>
                                <tr><td>Penalty Miss</td><td class="points-negative">-2</td></tr>
                                <tr><td>Error Leading to Goal</td><td class="points-negative">-2</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Bonus Points Tab -->
            <div id="bonus-tab" class="tab-content" style="display: none;">
                <div class="bonus-section">
                    <div class="bonus-header">
                        <h3 class="bonus-title">Bonus Points System (BPS)</h3>
                        <p class="bonus-description-text">The Bonus Points System awards additional points to the top three performing players in each match, regardless of their team or position.</p>
                    </div>
                    
                    <div class="bonus-grid">
                        <div class="bonus-card">
                            <div class="bonus-rank rank-1">1st</div>
                            <div class="bonus-points">+3 pts</div>
                            <div class="bonus-description">Top performer in the match</div>
                        </div>
                        <div class="bonus-card">
                            <div class="bonus-rank rank-2">2nd</div>
                            <div class="bonus-points">+2 pts</div>
                            <div class="bonus-description">Second best performer</div>
                        </div>
                        <div class="bonus-card">
                            <div class="bonus-rank rank-3">3rd</div>
                            <div class="bonus-points">+1 pt</div>
                            <div class="bonus-description">Third best performer</div>
                        </div>
                    </div>
                    
                    <div class="bps-info">
                        <h4>How BPS Works</h4>
                        <p>Players earn BPS points for various actions during a match (goals, assists, tackles, passes, etc.). The top three players with the highest BPS receive bonus points. BPS is calculated automatically based on official match statistics.</p>
                    </div>
                </div>
            </div>

            <!-- FAQ Tab -->
            <div id="faq-tab" class="tab-content" style="display: none;">
                <div class="faq-section">
                    <div class="faq-header">
                        <h3 class="faq-title">Frequently Asked Questions</h3>
                        <div class="faq-search">
                            <i class="fas fa-search"></i>
                            <input type="text" id="faqSearchInput" placeholder="Search FAQs...">
                        </div>
                    </div>
                    
                    <ul class="faq-list" id="faqList">
                        <li class="faq-item"><button class="faq-question" onclick="toggleFAQ(this)"><span>When do points get updated?</span><i class="fas fa-chevron-down"></i></button><div class="faq-answer"><p>Points are usually updated shortly after each real-life match concludes. Major updates happen within a few hours of the final whistle, with live points updating during matches for goals, assists, and other key actions.</p></div></li>
                        <li class="faq-item"><button class="faq-question" onclick="toggleFAQ(this)"><span>Can I change my captain after deadline?</span><i class="fas fa-chevron-down"></i></button><div class="faq-answer"><p>No, once the gameweek deadline passes, your team including captain selection is locked until the next gameweek.</p></div></li>
                        <li class="faq-item"><button class="faq-question" onclick="toggleFAQ(this)"><span>What happens if I don't use my free transfer?</span><i class="fas fa-chevron-down"></i></button><div class="faq-answer"><p>You can carry over one free transfer to the next gameweek, allowing you to make two free transfers.</p></div></li>
                        <li class="faq-item"><button class="faq-question" onclick="toggleFAQ(this)"><span>What if my player doesn't play in a gameweek?</span><i class="fas fa-chevron-down"></i></button><div class="faq-answer"><p>If on bench, first substitute replaces them. If in starting XI and doesn't play, no substitution occurs.</p></div></li>
                        <li class="faq-item"><button class="faq-question" onclick="toggleFAQ(this)"><span>How are bonus points calculated?</span><i class="fas fa-chevron-down"></i></button><div class="faq-answer"><p>Bonus points are awarded using the Bonus Points System (BPS). Top three players receive 3, 2, and 1 bonus points respectively.</p></div></li>
                        <li class="faq-item"><button class="faq-question" onclick="toggleFAQ(this)"><span>Do substitutes earn points?</span><i class="fas fa-chevron-down"></i></button><div class="faq-answer"><p>Only if they automatically replace a non-playing starter. Substitutes are used in bench order.</p></div></li>
                        <li class="faq-item"><button class="faq-question" onclick="toggleFAQ(this)"><span>What counts as an assist?</span><i class="fas fa-chevron-down"></i></button><div class="faq-answer"><p>Final pass, cross, header, or shot leading to a goal. Deflections that don't significantly change direction count.</p></div></li>
                        <li class="faq-item"><button class="faq-question" onclick="toggleFAQ(this)"><span>How are clean sheet points awarded?</span><i class="fas fa-chevron-down"></i></button><div class="faq-answer"><p>GK/DEF must play 60+ minutes without conceding. Midfielders don't get clean sheet points.</p></div></li>
                        <li class="faq-item"><button class="faq-question" onclick="toggleFAQ(this)"><span>When is the transfer deadline?</span><i class="fas fa-chevron-down"></i></button><div class="faq-answer"><p>1 hour before the first match of each gameweek. Check exact times as they may vary.</p></div></li>
                        <li class="faq-item"><button class="faq-question" onclick="toggleFAQ(this)"><span>Can I reverse a transfer?</span><i class="fas fa-chevron-down"></i></button><div class="faq-answer"><p>Yes, before confirming your team. Once confirmed or deadline passes, irreversible.</p></div></li>
                        <li class="faq-item"><button class="faq-question" onclick="toggleFAQ(this)"><span>How do price changes work?</span><i class="fas fa-chevron-down"></i></button><div class="faq-answer"><p>Based on transfer activity. Rise with high demand, fall with high sales. Changes occur overnight.</p></div></li>
                        <li class="faq-item"><button class="faq-question" onclick="toggleFAQ(this)"><span>How do I join a private league?</span><i class="fas fa-chevron-down"></i></button><div class="faq-answer"><p>Need league code from admin. Go to Leagues → Join League → Enter code.</p></div></li>
                        <li class="faq-item"><button class="faq-question" onclick="toggleFAQ(this)"><span>Can I create my own league?</span><i class="fas fa-chevron-down"></i></button><div class="faq-answer"><p>Yes! Create unlimited private leagues. Share code with friends to invite them.</p></div></li>
                        <li class="faq-item"><button class="faq-question" onclick="toggleFAQ(this)"><span>Classic vs Head-to-Head leagues?</span><i class="fas fa-chevron-down"></i></button><div class="faq-answer"><p>Classic: ranked by total points. H2H: weekly matchups (win=3pts, draw=1pt each).</p></div></li>
                        <li class="faq-item"><button class="faq-question" onclick="toggleFAQ(this)"><span>Do bonus points affect my captain's double points?</span><i class="fas fa-chevron-down"></i></button><div class="faq-answer"><p>Yes! Captain's bonus points are doubled along with all other points.</p></div></li>
                        <li class="faq-item"><button class="faq-question" onclick="toggleFAQ(this)"><span>How do I reset my password?</span><i class="fas fa-chevron-down"></i></button><div class="faq-answer"><p>Click "Forgot Password" on login page. Check spam folder if no email.</p></div></li>
                    </ul>
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
        
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !e.target.closest('.burger-menu')) {
                sidebar.classList.remove('mobile-open');
                document.getElementById('overlay').classList.remove('active');
            }
        });
        
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth > 768) {
                sidebar.classList.remove('mobile-open');
                document.getElementById('overlay').classList.remove('active');
            }
        });

        // Tab navigation for help sections
        function showHelpTab(tabName, element) {
            document.querySelectorAll('.tab-content').forEach(tab => tab.style.display = 'none');
            document.querySelectorAll('.help-tab').forEach(tab => tab.classList.remove('active'));
            document.getElementById(tabName + '-tab').style.display = 'block';
            element.classList.add('active');
        }

        // Tab navigation for scoring system
        function showScoringTab(tabName, element) {
            document.querySelectorAll('.scoring-tab-content').forEach(tab => tab.style.display = 'none');
            document.querySelectorAll('.scoring-tab').forEach(tab => tab.classList.remove('active'));
            document.getElementById(tabName + '-scoring').style.display = 'block';
            element.classList.add('active');
        }

        // FAQ toggle functionality
        function toggleFAQ(element) {
            const faqItem = element.parentElement;
            faqItem.classList.toggle('active');
        }

        // FAQ search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('faqSearchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const faqItems = document.querySelectorAll('.faq-item');
                    faqItems.forEach(item => {
                        const question = item.querySelector('.faq-question span').textContent.toLowerCase();
                        const answer = item.querySelector('.faq-answer p').textContent.toLowerCase();
                        item.style.display = (question.includes(searchTerm) || answer.includes(searchTerm)) ? 'block' : 'none';
                    });
                });
            }
            document.querySelector('.faq-item')?.classList.add('active');
        });
    </script>
</body>
</html>