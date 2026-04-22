<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Player Statistics - Footsy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            gap: 1rem;
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
            font-size: 1rem;
            box-shadow: 0 4px 12px rgba(58, 94, 229, 0.2);
            object-fit: cover;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.95rem;
        }

        /* Page Content */
        .page {
            padding: 2rem;
            flex: 1;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-header h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        /* Stats Dropdown */
        .stats-dropdown {
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
        }

        .stats-dropdown-btn {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(58, 94, 229, 0.2);
            border-radius: 12px;
            padding: 0.75rem 1.25rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'Montserrat', sans-serif;
            transition: all 0.3s;
            color: var(--dark);
        }

        .stats-dropdown-btn:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .stats-dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            min-width: 220px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            z-index: 200;
            margin-top: 0.5rem;
        }

        .stats-dropdown.open .stats-dropdown-content {
            display: block;
        }

        .stats-dropdown-content a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.75rem 1.25rem;
            color: var(--dark);
            text-decoration: none;
            transition: all 0.3s;
        }

        .stats-dropdown-content a i {
            width: 20px;
            color: var(--primary);
        }

        .stats-dropdown-content a:hover {
            background: rgba(58, 94, 229, 0.1);
        }

        .stats-dropdown-content a.active {
            background: rgba(58, 94, 229, 0.15);
            color: var(--primary);
            font-weight: 600;
        }

        /* Filters */
        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            border: 1px solid rgba(58, 94, 229, 0.1);
        }

        .filters input,
        .filters select {
            padding: 0.75rem 1rem;
            border: 2px solid rgba(58, 94, 229, 0.1);
            border-radius: 12px;
            background: white;
            font-size: 0.95rem;
            flex: 1;
            min-width: 180px;
            font-family: 'Open Sans', sans-serif;
            transition: all 0.3s;
        }

        .filters input:focus,
        .filters select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(58, 94, 229, 0.1);
        }

        .filters button {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
            font-family: 'Montserrat', sans-serif;
        }

        .filters button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(58, 94, 229, 0.3);
        }

        /* Table Container */
        .table-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            border: 1px solid rgba(58, 94, 229, 0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 1rem;
            border-bottom: 1px solid rgba(58, 94, 229, 0.1);
        }

        th {
            background: rgba(58, 94, 229, 0.03);
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        th:hover {
            background: rgba(58, 94, 229, 0.08);
        }

        th[data-dir="asc"]::after {
            content: " ↑";
            color: var(--primary);
        }

        th[data-dir="desc"]::after {
            content: " ↓";
            color: var(--primary);
        }

        tr:hover td {
            background: rgba(58, 94, 229, 0.03);
        }

        .player-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 0.75rem;
            background: var(--light);
        }

        .player-name {
            display: flex;
            align-items: center;
            font-weight: 600;
            color: var(--dark);
        }

        .position-badge {
            display: inline-block;
            padding: 0.25rem 0.6rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .pos-gk { background: rgba(58, 94, 229, 0.1); color: var(--primary); }
        .pos-def { background: rgba(52, 199, 89, 0.1); color: var(--secondary); }
        .pos-mid { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .pos-fwd { background: rgba(229, 62, 62, 0.1); color: var(--danger); }

        .points-badge {
            font-weight: 700;
            color: var(--primary);
        }

        .compare-btn {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.4rem 0.9rem;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .compare-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(58, 94, 229, 0.3);
        }

        /* Compare Modal */
        .compare-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
            z-index: 10000;
        }

        .compare-modal.active {
            display: flex;
        }

        .compare-content {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 2rem;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(58, 94, 229, 0.2);
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

        .compare-close {
            float: right;
            font-size: 1.8rem;
            color: var(--gray);
            cursor: pointer;
            transition: all 0.3s;
            line-height: 1;
        }

        .compare-close:hover {
            color: var(--danger);
            transform: rotate(90deg);
        }

        .compare-content h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .compare-table {
            width: 100%;
            border-collapse: collapse;
        }

        .compare-table th,
        .compare-table td {
            padding: 0.75rem;
            text-align: center;
            border: 1px solid rgba(58, 94, 229, 0.1);
        }

        .compare-table th {
            background: rgba(58, 94, 229, 0.05);
            font-weight: 600;
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
            
            .user-name {
                display: none;
            }
            
            .filters {
                flex-direction: column;
            }
            
            .filters input,
            .filters select {
                min-width: 100%;
            }
            
            .table-container {
                overflow-x: auto;
            }
        }

        @media (max-width: 576px) {
            .page {
                padding: 1rem;
            }
            
            .header {
                padding: 0 1rem;
            }
            
            th, td {
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>

@php 
    $user = Auth::user(); 
@endphp

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
                <i class="fas fa-home"></i><span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('fantasy-team.index') }}" class="nav-link">
                <i class="fas fa-users"></i><span>My Team</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('leagues.index') }}" class="nav-link">
                <i class="fas fa-trophy"></i><span>Leagues</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('statistics.index') }}" class="nav-link">
                <i class="fas fa-chart-line"></i><span>Statistics</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('transfers.index') }}" class="nav-link">
                <i class="fas fa-exchange-alt"></i><span>Transfers</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('fixtures.index') }}" class="nav-link">
                <i class="fas fa-calendar-alt"></i><span>Fixtures</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('help') }}" class="nav-link">
                <i class="fas fa-question-circle"></i><span>Help and Support</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('profile.edit') }}" class="nav-link">
                <i class="fas fa-user"></i><span>Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link" style="background:none;border:none;width:100%;text-align:left;">
                    <i class="fas fa-sign-out-alt"></i><span>Log Out</span>
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
            @if(Auth::user()->profile_photo_path)
                <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" 
                     class="user-avatar" style="object-fit: cover;" alt="Avatar">
            @else
                <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
            @endif
            <span class="user-name">{{ Auth::user()->name }}</span>
        </div>
    </header>

    <div class="page">
        <div class="page-header">
            <h1>Player Statistics</h1>
            <p>Analyze player performance across the Premier League</p>
        </div>
        
        <!-- Stats Switcher (Dropdown) -->
        <div class="stats-dropdown" id="statsDropdown">
            <button class="stats-dropdown-btn" id="statsSwitcherBtn">
                <i class="fas fa-chart-bar"></i>
                <span id="statsSwitcherLabel">
                    @if(request()->routeIs('statistics.players')) Player Statistics
                    @elseif(request()->routeIs('statistics.teams')) Team Statistics
                    @else Overview
                    @endif
                </span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="stats-dropdown-content">
                <a href="{{ route('statistics.index') }}" class="{{ request()->routeIs('statistics.index') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie"></i> Overview
                </a>
                <a href="{{ route('statistics.players') }}" class="{{ request()->routeIs('statistics.players') ? 'active' : '' }}">
                    <i class="fas fa-user"></i> Player Stats
                </a>
                <a href="{{ route('statistics.teams') }}" class="{{ request()->routeIs('statistics.teams') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Team Stats
                </a>
            </div>
        </div>

        <!-- Filters -->
        <form method="GET" class="filters" id="filterForm">
            <input type="text" name="search" placeholder="🔍 Search player..." value="{{ request('search') }}" id="searchInput">
            <select name="team_id" id="teamSelect">
                <option value="">All Teams</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ request('team_id') == $team->id ? 'selected' : '' }}>
                        {{ $team->name }}
                    </option>
                @endforeach
            </select>
            <select name="position" id="positionSelect">
                <option value="">All Positions</option>
                <option value="GK" {{ request('position') == 'GK' ? 'selected' : '' }}>Goalkeepers</option>
                <option value="DEF" {{ request('position') == 'DEF' ? 'selected' : '' }}>Defenders</option>
                <option value="MID" {{ request('position') == 'MID' ? 'selected' : '' }}>Midfielders</option>
                <option value="FWD" {{ request('position') == 'FWD' ? 'selected' : '' }}>Forwards</option>
            </select>
            <button type="submit"><i class="fas fa-filter"></i> Filter</button>
        </form>

        <!-- Table Container -->
        <div class="table-container">
            <table id="playersTable">
                <thead>
                    <tr>
                        <th data-sort="web_name">Player</th>
                        <th data-sort="team">Team</th>
                        <th data-sort="position">Position</th>
                        <th data-sort="total_points">Points</th>
                        <th data-sort="goals_scored">Goals</th>
                        <th data-sort="assists">Assists</th>
                        <th data-sort="price">Price (£m)</th>
                        <th>Compare</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($players as $p)
                    <tr>
                        <td class="player-name">
                            <img src="https://resources.premierleague.com/premierleague/photos/players/110x140/p{{ $p->code ?? '0' }}.png" 
                                 onerror="this.src='https://cdn-icons-png.flaticon.com/512/847/847969.png';"
                                 alt="{{ $p->web_name }}" class="player-img">
                            {{ $p->web_name }}
                        </td>
                        <td>{{ $p->team->short_name ?? '-' }}</td>
                        <td>
                            @php
                                $posClass = '';
                                if($p->position_label == 'GK') $posClass = 'pos-gk';
                                elseif($p->position_label == 'DEF') $posClass = 'pos-def';
                                elseif($p->position_label == 'MID') $posClass = 'pos-mid';
                                elseif($p->position_label == 'FWD') $posClass = 'pos-fwd';
                            @endphp
                            <span class="position-badge {{ $posClass }}">{{ $p->position_label }}</span>
                        </td>
                        <td class="points-badge">{{ $p->total_points }}</td>
                        <td>{{ $p->goals_scored }}</td>
                        <td>{{ $p->assists }}</td>
                        <td>£{{ number_format($p->price,1) }}</td>
                        <td>
                            <button class="compare-btn" onclick="addToCompare('{{ $p->web_name }}', {{ $p->total_points }}, {{ $p->goals_scored }}, {{ $p->assists }}, {{ $p->price }})">
                                Compare
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Compare Modal -->
<div class="compare-modal" id="compareModal">
    <div class="compare-content">
        <span class="compare-close" onclick="closeCompare()">&times;</span>
        <h2>Player Comparison</h2>
        <table class="compare-table" id="compareTable">
            <thead>
                <tr><th>Player</th><th>Points</th><th>Goals</th><th>Assists</th><th>Price (£m)</th></tr>
            </thead>
            <tbody></tbody>
        </table>
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

    // Dropdown functionality
    const dropdown = document.getElementById('statsDropdown');
    const dropdownBtn = document.getElementById('statsSwitcherBtn');
    
    if (dropdownBtn) {
        dropdownBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdown.classList.toggle('open');
        });
        
        document.addEventListener('click', function(e) {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove('open');
            }
        });
    }

    // Comparison array
    let comparePlayers = [];

    function addToCompare(name, points, goals, assists, price) {
        if (comparePlayers.length >= 4) {
            alert('You can compare up to 4 players at a time.');
            return;
        }
        
        comparePlayers.push({ name, points, goals, assists, price });
        updateCompareModal();
        document.getElementById('compareModal').classList.add('active');
    }

    function updateCompareModal() {
        const tbody = document.querySelector('#compareTable tbody');
        tbody.innerHTML = '';
        
        comparePlayers.forEach(p => {
            const row = tbody.insertRow();
            row.insertCell(0).innerHTML = p.name;
            row.insertCell(1).innerHTML = p.points;
            row.insertCell(2).innerHTML = p.goals;
            row.insertCell(3).innerHTML = p.assists;
            row.insertCell(4).innerHTML = '£' + p.price + 'm';
        });
    }

    function closeCompare() {
        document.getElementById('compareModal').classList.remove('active');
        comparePlayers = [];
    }

    // Sort functionality
    let sortColumn = 'total_points';
    let sortDirection = 'desc';
    
    document.querySelectorAll('th[data-sort]').forEach(th => {
        th.addEventListener('click', function() {
            const col = this.getAttribute('data-sort');
            if (sortColumn === col) {
                sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                sortColumn = col;
                sortDirection = 'desc';
            }
            
            // Update sort indicators
            document.querySelectorAll('th[data-sort]').forEach(h => h.removeAttribute('data-dir'));
            this.setAttribute('data-dir', sortDirection);
            
            // Submit form with sort params
            const url = new URL(window.location.href);
            url.searchParams.set('sort', sortColumn);
            url.searchParams.set('direction', sortDirection);
            window.location.href = url.toString();
        });
        
        if (th.getAttribute('data-sort') === '{{ request('sort', 'total_points') }}') {
            th.setAttribute('data-dir', '{{ request('direction', 'desc') }}');
        }
    });
</script>

</body>
</html>