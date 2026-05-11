<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Fantasy Team - Footsy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        .header h2 {
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

        /* Page Content */
        .page {
            padding: 2rem;
            flex: 1;
        }

        /* Team Info */
        .team-info {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1.5rem 2rem;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(58, 94, 229, 0.1);
        }

        .team-name {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .team-stats {
            display: flex;
            gap: 2rem;
        }

        .stat {
            text-align: center;
            padding: 0.5rem 1rem;
            background: rgba(58, 94, 229, 0.05);
            border-radius: 12px;
            min-width: 100px;
        }

        .stat-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            font-size: 0.85rem;
            color: var(--gray);
            font-weight: 500;
        }

        /* Pitch Container */
        .pitch-container {
            position: relative;
            width: 100%;
            max-width: 1000px;
            margin: 2rem auto;
            height: 820px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(58, 94, 229, 0.15);
            background: linear-gradient(180deg, #2d8c5a 0%, #1a6b45 100%);
            display: grid;
            grid-template-rows: repeat(4, 1fr);
            gap: 26px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .pitch-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://upload.wikimedia.org/wikipedia/commons/thumb/d/d3/Soccer_field_-_empty.svg/1280px-Soccer_field_-_empty.svg.png') no-repeat center center;
            background-size: cover;
            opacity: 0.15;
            pointer-events: none;
        }

        .pitch-row {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            align-items: center;
            gap: 8px;
        }

        .field-player {
            grid-column: span 2;
            justify-self: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 0.75rem 0.6rem;
            min-width: 100px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            position: relative;
            border: 1px solid rgba(58, 94, 229, 0.2);
        }

        .field-player:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(58, 94, 229, 0.25);
            border-color: var(--primary);
        }

        .player-points {
            position: absolute;
            top: -8px;
            right: -8px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.2rem 0.5rem;
            border-radius: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .field-player-img {
            width: 65px;
            height: 80px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 0.5rem;
            background: var(--light);
        }

        .field-player-name {
            font-size: 0.85rem;
            font-weight: 700;
            text-align: center;
            line-height: 1.2;
            margin-bottom: 0.25rem;
            color: var(--dark);
        }

        .player-position {
            font-size: 0.7rem;
            color: var(--gray);
            font-weight: 600;
            text-transform: uppercase;
        }

        /* Bench Container */
        .bench-container {
            max-width: 1000px;
            margin: 2rem auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            border: 1px solid rgba(58, 94, 229, 0.1);
        }

        .bench-header {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            text-align: center;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }

        .bench-row {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .bench-player {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(58, 94, 229, 0.05);
            border-radius: 16px;
            padding: 1rem 0.8rem;
            width: 100px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            position: relative;
            border: 1px solid rgba(58, 94, 229, 0.1);
        }

        .bench-player:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(58, 94, 229, 0.15);
            border-color: var(--primary);
        }

        .bench-player .player-points {
            top: -6px;
            right: -6px;
        }

        .bench-player img {
            width: 60px;
            height: 75px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 0.5rem;
            background: white;
        }

        .bench-player span {
            font-size: 0.8rem;
            font-weight: 600;
            text-align: center;
            line-height: 1.2;
            color: var(--dark);
        }

        .bench-position {
            font-size: 0.7rem;
            color: var(--gray);
            margin-top: 0.25rem;
            font-weight: 500;
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

        /* Drag & Drop Styles */
        .dragging {
            opacity: 0.5;
            transform: scale(1.05);
        }

        .drag-over {
            outline: 3px dashed var(--primary);
            border-radius: 12px;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .pitch-container {
                height: 720px;
                gap: 20px;
            }
            
            .field-player {
                min-width: 85px;
                padding: 0.6rem 0.5rem;
            }
            
            .field-player-img {
                width: 55px;
                height: 70px;
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
            
            .team-info {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
                padding: 1.5rem;
            }
            
            .team-stats {
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .pitch-container {
                height: 650px;
                padding: 1rem;
                gap: 15px;
            }
            
            .field-player {
                min-width: 75px;
                padding: 0.5rem 0.4rem;
            }
            
            .field-player-img {
                width: 50px;
                height: 65px;
            }
            
            .field-player-name {
                font-size: 0.7rem;
            }
        }

        @media (max-width: 576px) {
            .header {
                padding: 0 1rem;
            }
            
            .search-bar {
                display: none;
            }
            
            .page {
                padding: 1rem;
            }
            
            .pitch-container {
                height: 550px;
            }
            
            .field-player {
                min-width: 65px;
            }
            
            .field-player-img {
                width: 45px;
                height: 60px;
            }
            
            .bench-player {
                width: 80px;
                padding: 0.8rem 0.6rem;
            }
            
            .bench-player img {
                width: 50px;
                height: 65px;
            }
            
            .stat {
                min-width: 80px;
                padding: 0.3rem 0.5rem;
            }
            
            .stat-value {
                font-size: 1.2rem;
            }
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
                <a href="{{ route('fantasy-team.index') }}" class="nav-link active">
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
            <div class="user-menu">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search players...">
                </div>
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

        <div class="page">
            <div class="team-info">
                <div class="team-name">{{ $team->team_name }}</div>
                <div class="team-stats">
                    <div class="stat">
                        <div class="stat-value">{{ $gwPoints ?? 0 }}</div>
                        <div class="stat-label">GW Points</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">{{ $teamValue ?? '£0.0' }}m</div>
                        <div class="stat-label">Team Value</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">{{ $freeTransfers ?? 1 }}</div>
                        <div class="stat-label">Free Transfers</div>
                    </div>
                </div>
            </div>

            <!-- Pitch -->
            <div class="pitch-container">
                <div class="pitch-row" id="fwdRow"></div>
                <div class="pitch-row" id="midRow"></div>
                <div class="pitch-row" id="defRow"></div>
                <div class="pitch-row" id="gkRow"></div>
            </div>

            <!-- Bench -->
            <div class="bench-container">
                <h3 class="bench-header">Bench</h3>
                <div class="bench-row" id="benchRow"></div>
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

        const players = @json($mapped);

        console.log("Players received:", players);

        const grouped = { GK: [], DEF: [], MID: [], FWD: [] };

        players.forEach(p => {
            let pos = p.position;
            if (pos === 'GKP') pos = 'GK';
            if (grouped[pos]) grouped[pos].push(p);
        });

        const layout = { GK: 1, DEF: 4, MID: 4, FWD: 2 };
        const columns = {
            GK: [6],
            DEF: [2, 5, 8, 11],
            MID: [2, 5, 8, 11],
            FWD: [5, 8]
        };

        const positionLabels = {
            'GK': 'Goalkeeper',
            'DEF': 'Defender',
            'MID': 'Midfielder',
            'FWD': 'Forward'
        };

        // Render Starting XI
        Object.entries(layout).forEach(([pos, max]) => {
            const row = document.getElementById(pos.toLowerCase() + 'Row');
            if (!row) return;

            row.innerHTML = '';

            grouped[pos].slice(0, max).forEach((p, i) => {
                const div = document.createElement('div');
                div.className = 'field-player draggable-player droppable-slot';
                div.setAttribute('draggable', 'true');
                div.setAttribute('data-player-id', p.id);
                div.setAttribute('data-position', p.position);
                div.style.gridColumn = `${columns[pos][i]} / span 2`;

                div.innerHTML = `
                    <div class="player-points">${p.event_points ?? 0}</div>
                    <img src="https://resources.premierleague.com/premierleague/photos/players/110x140/p${p.code}.png"
                         onerror="this.src='https://cdn-icons-png.flaticon.com/512/847/847969.png';" 
                         alt="${p.web_name}" class="field-player-img">
                    <div class="field-player-name">${p.web_name}</div>
                    <div class="player-position">${positionLabels[pos] || pos}</div>
                `;
                row.appendChild(div);
            });
        });

        // Render Bench
        const starters = Object.entries(layout)
            .flatMap(([pos, max]) => grouped[pos].slice(0, max));

        const benchPlayers = players.filter(p => !starters.some(s => s.id === p.id));
        const benchRow = document.getElementById('benchRow');
        benchRow.innerHTML = '';

        benchPlayers.slice(0, 4).forEach(p => {
            let pos = p.position;
            if (pos === 'GKP') pos = 'GK';

            const b = document.createElement('div');
            b.className = 'bench-player draggable-player droppable-slot';
            b.setAttribute('draggable', 'true');
            b.setAttribute('data-player-id', p.id);
            b.setAttribute('data-position', p.position);

            b.innerHTML = `
                <div class="player-points">${p.event_points ?? 0}</div>
                <img src="https://resources.premierleague.com/premierleague/photos/players/110x140/p${p.code}.png"
                     onerror="this.src='https://cdn-icons-png.flaticon.com/512/847/847969.png';"
                     alt="${p.web_name}">
                <span>${p.web_name}</span>
                <div class="bench-position">${positionLabels[pos] || pos}</div>
            `;
            benchRow.appendChild(b);
        });

        // Update total points
        function calculateTotalPoints() {
            let total = 0;
            document.querySelectorAll('.field-player .player-points').forEach(el => {
                total += parseInt(el.textContent) || 0;
            });
            const statEl = document.querySelector('.stat-value');
            if (statEl && statEl.parentElement.querySelector('.stat-label')?.textContent === 'GW Points') {
                statEl.textContent = total;
            }
        }

        calculateTotalPoints();
    </script>
</body>
</html>