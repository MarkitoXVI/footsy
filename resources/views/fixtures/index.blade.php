<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixtures - Footsy Fantasy Football</title>
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
        
        /* Fixtures Content */
        .fixtures-content {
            padding: 2rem;
            flex: 1;
        }
        
        .fixtures-header {
            margin-bottom: 2rem;
        }
        
        .fixtures-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Calendar Styles */
        .calendar-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(58, 94, 229, 0.1);
        }
        
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .calendar-nav {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
        
        .calendar-btn {
            background: rgba(58, 94, 229, 0.1);
            border: none;
            border-radius: 10px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            color: var(--primary);
        }
        
        .calendar-btn:hover {
            background: var(--primary);
            color: white;
            transform: scale(1.05);
        }
        
        .calendar-month {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--dark);
        }
        
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 6px;
        }
        
        .calendar-day-header {
            text-align: center;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--gray);
            padding: 0.5rem 0;
        }
        
        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            font-weight: 500;
        }
        
        .calendar-day:hover {
            background: rgba(58, 94, 229, 0.1);
            transform: scale(1.05);
        }
        
        .calendar-day.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 4px 12px rgba(58, 94, 229, 0.3);
        }
        
        .calendar-day.has-fixtures {
            background: linear-gradient(135deg, rgba(58, 94, 229, 0.15), rgba(58, 94, 229, 0.25));
            border: 2px solid rgba(58, 94, 229, 0.4);
            font-weight: 700;
            color: var(--primary);
        }

        .calendar-day.has-fixtures:hover {
            background: linear-gradient(135deg, rgba(58, 94, 229, 0.25), rgba(58, 94, 229, 0.35));
            transform: scale(1.05);
        }
        
        .calendar-day.other-month {
            color: var(--light-gray);
            opacity: 0.5;
        }
        
        .calendar-day.today {
            border: 2px solid var(--primary);
            position: relative;
        }
        
        /* Fixtures Grid */
        .fixtures-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 1.5rem;
        }
        
        .date-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            border: 1px solid rgba(58, 94, 229, 0.1);
            transition: all 0.3s;
        }
        
        .date-card:hover {
            box-shadow: 0 12px 30px rgba(58, 94, 229, 0.12);
        }
        
        .date-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 1rem 1.5rem;
        }
        
        .date-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
        }
        
        .fixtures-list {
            padding: 0;
        }
        
        .fixture-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(58, 94, 229, 0.1);
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .fixture-item:last-child {
            border-bottom: none;
        }
        
        .fixture-item:hover {
            background: rgba(58, 94, 229, 0.05);
            transform: translateX(5px);
        }
        
        .teams {
            display: flex;
            align-items: center;
            flex: 1;
            gap: 1rem;
        }
        
        .home-team, .away-team {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex: 1;
        }
        
        .away-team {
            justify-content: flex-end;
            text-align: right;
        }
        
        .team-name {
            font-weight: 600;
        }
        
        .team-logo {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(58, 94, 229, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            color: var(--primary);
        }
        
        .vs {
            color: var(--primary);
            font-weight: 700;
            font-size: 1rem;
        }
        
        .fixture-details {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            margin-left: 1rem;
        }
        
        .fixture-time {
            font-weight: 600;
            color: var(--primary);
            font-size: 0.9rem;
        }
        
        .fixture-venue {
            font-size: 0.75rem;
            color: var(--gray);
            margin-top: 0.25rem;
        }
        
        .no-fixtures {
            padding: 3rem 2rem;
            text-align: center;
            color: var(--gray);
        }
        
        .no-fixtures i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
            color: var(--primary);
        }
        
        .no-fixtures h3 {
            margin-bottom: 0.5rem;
            color: var(--dark);
        }
        
        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        }
        
        .modal-overlay.active { 
            display: flex; 
        }
        
        .modal-content {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            width: 90%;
            max-width: 500px;
            padding: 2rem;
            position: relative;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            animation: popIn 0.3s ease;
            border: 1px solid rgba(58, 94, 229, 0.2);
        }
        
        @keyframes popIn { 
            from { transform: scale(0.9); opacity: 0; } 
            to { transform: scale(1); opacity: 1; } 
        }
        
        .close-modal {
            position: absolute;
            top: 1rem;
            right: 1.2rem;
            background: none;
            border: none;
            font-size: 1.8rem;
            color: var(--gray);
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .close-modal:hover { 
            color: var(--danger);
            transform: rotate(90deg);
        }
        
        .modal-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .modal-body {
            font-size: 1rem;
            color: var(--dark);
            line-height: 1.5;
        }
        
        .modal-body .teams {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            gap: 1rem;
        }
        
        .modal-body .team {
            text-align: center;
            flex: 1;
        }
        
        .modal-body .team-name {
            font-weight: 700;
            font-size: 1rem;
            margin-top: 0.5rem;
        }
        
        .modal-body .team-logo {
            width: 50px;
            height: 50px;
            margin: 0 auto;
            font-size: 1rem;
        }
        
        .modal-body .score {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .modal-body .info {
            text-align: center;
            font-size: 0.9rem;
            color: var(--gray);
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(58, 94, 229, 0.1);
        }
        
        .modal-body .info p {
            margin-bottom: 0.5rem;
        }
        
        .modal-body .info strong {
            color: var(--dark);
        }
        
        .modal-body ul {
            list-style: none;
            margin-top: 1rem;
        }
        
        .modal-body ul li {
            padding: 0.5rem;
            border-bottom: 1px solid rgba(58, 94, 229, 0.1);
            font-size: 0.85rem;
        }
        
        .modal-body ul li:last-child {
            border-bottom: none;
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
            .fixtures-grid {
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
            
            .fixtures-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .fixture-item {
                flex-direction: column;
                align-items: flex-start;
                padding: 1rem;
                gap: 0.75rem;
            }
            
            .teams {
                width: 100%;
            }
            
            .fixture-details {
                flex-direction: row;
                justify-content: space-between;
                width: 100%;
                margin-left: 0;
                align-items: center;
            }
        }
        
        @media (max-width: 576px) {
            .fixtures-content {
                padding: 1rem;
            }
            
            .header {
                padding: 0 1rem;
            }
            
            .calendar-grid {
                gap: 4px;
            }
            
            .calendar-day {
                font-size: 0.75rem;
            }
            
            .calendar-day-header {
                font-size: 0.7rem;
            }
            
            .team-name {
                font-size: 0.85rem;
            }
            
            .team-logo {
                width: 30px;
                height: 30px;
                font-size: 0.7rem;
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
        
        .date-card {
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
                <a href="{{ route('fixtures.index') }}" class="nav-link active">
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
                <h1 class="page-title">Fixtures</h1>
            </div>
            
            <div class="user-menu">
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

        <!-- Fixtures Content -->
        <div class="fixtures-content">
            <div class="fixtures-header">
                <h1 class="fixtures-title">Premier League Fixtures</h1>
            </div>

            <!-- Calendar -->
            <div class="calendar-container">
                <div class="calendar-header">
                    <div class="calendar-nav">
                        <button class="calendar-btn" id="prev-month">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <div class="calendar-month" id="current-month">September 2025</div>
                        <button class="calendar-btn" id="next-month">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <button class="calendar-btn" id="today-btn">
                        <i class="fas fa-calendar-day"></i> Today
                    </button>
                </div>
                <div class="calendar-grid">
                    <div class="calendar-day-header">Sun</div>
                    <div class="calendar-day-header">Mon</div>
                    <div class="calendar-day-header">Tue</div>
                    <div class="calendar-day-header">Wed</div>
                    <div class="calendar-day-header">Thu</div>
                    <div class="calendar-day-header">Fri</div>
                    <div class="calendar-day-header">Sat</div>
                </div>
            </div>

            <!-- Fixtures Display -->
            <div id="fixtures-display">
                <!-- Fixtures will be displayed here based on selected date -->
            </div>
        </div>
    </div>

    <!-- Match Info Modal -->
    <div id="matchModal" class="modal-overlay">
        <div class="modal-content">
            <button class="close-modal">&times;</button>
            <h2 class="modal-title">Match Details</h2>
            <div id="modalBody" class="modal-body"></div>
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

        document.addEventListener('DOMContentLoaded', function() {
            const fixturesData = @json($fixturesByDate);

            let currentDate = new Date();
            
            const monthNames = ["January","February","March","April","May","June","July","August","September","October","November","December"];

            function updateCalendar() {
                const calendarGrid = document.querySelector('.calendar-grid');
                const currentMonthElement = document.getElementById('current-month');
                
                // Keep only headers
                while (calendarGrid.children.length > 7) {
                    calendarGrid.removeChild(calendarGrid.lastChild);
                }
                
                currentMonthElement.textContent = `${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}`;
                
                const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).getDay();
                const daysInMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                // Empty days
                for (let i = 0; i < firstDay; i++) {
                    const empty = document.createElement('div');
                    empty.className = 'calendar-day other-month';
                    calendarGrid.appendChild(empty);
                }

                // Actual days
                for (let day = 1; day <= daysInMonth; day++) {
                    const dateString = `${currentDate.getFullYear()}-${String(currentDate.getMonth()+1).padStart(2,'0')}-${String(day).padStart(2,'0')}`;
                    const dayElement = document.createElement('div');
                    dayElement.className = 'calendar-day';
                    dayElement.textContent = day;

                    const cellDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), day);
                    if (cellDate.getTime() === today.getTime()) dayElement.classList.add('today');
                    if (fixturesData[dateString]) dayElement.classList.add('has-fixtures');

                    dayElement.addEventListener('click', () => {
                        document.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('active'));
                        dayElement.classList.add('active');
                        displayFixtures(dateString);
                    });

                    calendarGrid.appendChild(dayElement);
                }

                // Auto select today or first day with fixtures
                const todayInView = currentDate.getMonth() === today.getMonth() && currentDate.getFullYear() === today.getFullYear();
                if (todayInView) {
                    const todayEl = calendarGrid.querySelector('.today');
                    if (todayEl) todayEl.click();
                } else {
                    const firstFixture = Array.from(calendarGrid.children).find(el => el.classList.contains('has-fixtures'));
                    if (firstFixture) firstFixture.click();
                    else calendarGrid.children[7]?.click();
                }
            }

            function displayFixtures(dateString) {
                const fixturesDisplay = document.getElementById('fixtures-display');
                const fixtures = fixturesData[dateString] || [];

                if (fixtures.length === 0) {
                    fixturesDisplay.innerHTML = `
                        <div class="date-card">
                            <div class="date-header">
                                <div class="date-title">${new Date(dateString).toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</div>
                            </div>
                            <div class="no-fixtures">
                                <i class="fas fa-calendar-times"></i>
                                <h3>No Fixtures</h3>
                                <p>No Premier League matches on this date.</p>
                            </div>
                        </div>`;
                    return;
                }

                const formattedDate = new Date(dateString).toLocaleDateString('en-US', {
                    weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
                });

                let html = `
                    <div class="date-card">
                        <div class="date-header">
                            <div class="date-title">${formattedDate}</div>
                        </div>
                        <ul class="fixtures-list">
                `;

                fixtures.forEach(fixture => {
                    const score = fixture.finished ? `${fixture.home_score ?? 0} - ${fixture.away_score ?? 0}` : 'vs';
                    
                    html += `
                        <li class="fixture-item" data-fixture='${JSON.stringify(fixture)}'>
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">${fixture.home_short}</div>
                                    <div class="team-name">${fixture.home_team}</div>
                                </div>
                                <div class="vs">${score}</div>
                                <div class="away-team">
                                    <div class="team-name">${fixture.away_team}</div>
                                    <div class="team-logo">${fixture.away_short}</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">${new Date(fixture.kickoff_time).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</div>
                                <div class="fixture-venue">Matchweek ${fixture.event ?? '-'}</div>
                            </div>
                        </li>
                    `;
                });

                html += `</ul></div>`;
                fixturesDisplay.innerHTML = html;

                // Attach click listeners
                document.querySelectorAll('.fixture-item').forEach(item => {
                    item.addEventListener('click', function(e) {
                        e.stopPropagation();
                        const fixture = JSON.parse(this.getAttribute('data-fixture'));

                        const score = fixture.finished ? `${fixture.home_score ?? 0} - ${fixture.away_score ?? 0}` : 'vs';
                        const kickoff = new Date(fixture.kickoff_time).toLocaleString([], {
                            weekday: 'short', day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit'
                        });
                        const status = fixture.finished ? 'Finished' : 'Scheduled';

                        let goalsHTML = '';
                        if (fixture.goals && fixture.goals.length > 0) {
                            goalsHTML = `<h4 style="margin-top: 1rem; color: var(--primary);">Goalscorers</h4><ul class="scorers-list">`;
                            fixture.goals.forEach(g => {
                                goalsHTML += `<li>${g.player} (${g.minute}') ${g.team ? `(${g.team})` : ''}</li>`;
                            });
                            goalsHTML += `</ul>`;
                        } else if (fixture.finished) {
                            goalsHTML = `<p style="margin-top: 1rem;"><em>No goalscorers recorded.</em></p>`;
                        }

                        document.getElementById('modalBody').innerHTML = `
                            <div class="teams">
                                <div class="team">
                                    <div class="team-logo" style="margin: 0 auto;">${fixture.home_short}</div>
                                    <div class="team-name">${fixture.home_team}</div>
                                </div>
                                <div class="score">${score}</div>
                                <div class="team">
                                    <div class="team-logo" style="margin: 0 auto;">${fixture.away_short}</div>
                                    <div class="team-name">${fixture.away_team}</div>
                                </div>
                            </div>
                            <div class="info">
                                <p><strong>Status:</strong> ${status}</p>
                                <p><strong>Kick-off:</strong> ${kickoff}</p>
                                <p><strong>Venue:</strong> ${fixture.venue || 'Unknown Stadium'}</p>
                                <p><strong>Matchweek:</strong> ${fixture.event ?? '-'}</p>
                                ${goalsHTML}
                            </div>
                        `;

                        document.getElementById('matchModal').classList.add('active');
                    });
                });
            }

            // Navigation buttons
            document.getElementById('prev-month').addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                updateCalendar();
            });

            document.getElementById('next-month').addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                updateCalendar();
            });

            document.getElementById('today-btn').addEventListener('click', () => {
                currentDate = new Date();
                currentDate.setDate(1);
                updateCalendar();
            });

            // Initialize
            updateCalendar();
        });

        // Modal close handlers
        document.addEventListener('click', function(e) {
            const modal = document.getElementById('matchModal');
            if (e.target.classList.contains('close-modal') || e.target === modal) {
                modal.classList.remove('active');
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.getElementById('matchModal').classList.remove('active');
            }
        });
    </script>
</body>
</html>