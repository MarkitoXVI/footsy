<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics - Footsy Fantasy Football</title>
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
        }
        
        .user-name {
            font-weight: 600;
            font-size: 0.95rem;
        }
        
        /* Statistics Content */
        .statistics-content {
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
        
        .page-header p {
            color: var(--gray);
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
        
        .stats-dropdown:hover .stats-dropdown-content {
            display: block;
        }
        
        .stats-dropdown-content a {
            display: block;
            padding: 0.75rem 1.25rem;
            color: var(--dark);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .stats-dropdown-content a:hover {
            background: rgba(58, 94, 229, 0.1);
            color: var(--primary);
        }
        
        /* Stats Cards Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            border: 1px solid rgba(58, 94, 229, 0.1);
            transition: all 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(58, 94, 229, 0.15);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: rgba(58, 94, 229, 0.1);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin: 0 auto 1rem;
        }
        
        .stat-card h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--gray);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stat-value {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Charts Grid */
        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .chart-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            border: 1px solid rgba(58, 94, 229, 0.1);
            transition: all 0.3s;
        }
        
        .chart-card:hover {
            box-shadow: 0 12px 30px rgba(58, 94, 229, 0.12);
        }
        
        .chart-card h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .chart-card h3 i {
            color: var(--primary);
        }
        
        canvas {
            max-height: 280px;
            width: 100%;
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
        
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .table-header h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark);
        }
        
        .table-header i {
            color: var(--primary);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(58, 94, 229, 0.1);
        }
        
        th {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            color: var(--dark);
            background: rgba(58, 94, 229, 0.03);
            font-size: 0.9rem;
        }
        
        td {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        tr:hover td {
            background: rgba(58, 94, 229, 0.03);
        }
        
        .player-name {
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
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--gray);
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
            color: var(--primary);
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
            .charts-grid {
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
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .table-container {
                overflow-x: auto;
            }
            
            th, td {
                white-space: nowrap;
            }
        }
        
        @media (max-width: 576px) {
            .statistics-content {
                padding: 1rem;
            }
            
            .header {
                padding: 0 1rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .page-header h1 {
                font-size: 1.5rem;
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
        
        .stat-card, .chart-card, .table-container {
            animation: fadeInUp 0.5s ease forwards;
        }
    </style>
</head>
<body>

@php 
    $user = Auth::user(); 
@endphp

<!-- Overlay for mobile -->
<div class="overlay" id="overlay" onclick="closeMobileSidebar()"></div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">F</div>
        <div class="sidebar-title">Footsy</div>
    </div>
    <ul class="sidebar-nav">
        <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
        <li class="nav-item"><a href="{{ route('fantasy-team.index') }}" class="nav-link"><i class="fas fa-users"></i><span>My Team</span></a></li>
        <li class="nav-item"><a href="{{ route('leagues.index') }}" class="nav-link"><i class="fas fa-trophy"></i><span>Leagues</span></a></li>
        <li class="nav-item"><a href="{{ route('statistics.index') }}" class="nav-link active"><i class="fas fa-chart-line"></i><span>Statistics</span></a></li>
        <li class="nav-item"><a href="{{ route('transfers.index') }}" class="nav-link"><i class="fas fa-exchange-alt"></i><span>Transfers</span></a></li>
        <li class="nav-item"><a href="{{ route('fixtures.index') }}" class="nav-link"><i class="fas fa-calendar-alt"></i><span>Fixtures</span></a></li>
        <li class="nav-item"><a href="{{ route('help') }}" class="nav-link"><i class="fas fa-question-circle"></i><span>Help and Support</span></a></li>
        <li class="nav-item"><a href="{{ route('profile.edit') }}" class="nav-link"><i class="fas fa-user"></i><span>Profile</span></a></li>
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

<div class="main-content" id="mainContent">
    <!-- Header -->
    <header class="header">
        <div class="header-left">
            <button class="burger-menu" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <div class="user-menu">
            <div class="user-avatar">{{ substr($user->name ?? 'U', 0, 1) }}</div>
            <span class="user-name">{{ $user->name }}</span>
        </div>
    </header>

    <div class="statistics-content">
        <div class="page-header">
            <h1>Your Team Statistics</h1>
            <p>Track your team's performance and analyze key metrics</p>
        </div>

        <!-- Stats Switcher -->
        <div class="stats-dropdown">
            <button class="stats-dropdown-btn">
                <i class="fas fa-chart-bar"></i>
                <span>Overview</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="stats-dropdown-content">
                <a href="{{ route('statistics.index') }}">Overview</a>
                <a href="{{ route('statistics.players') }}">Player Statistics</a>
                <a href="{{ route('statistics.teams') }}">Team Statistics</a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                <h3>Total Points</h3>
                <div class="stat-value">{{ $totalPoints ?? 0 }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-coins"></i></div>
                <h3>Team Value</h3>
                <div class="stat-value">£{{ number_format($teamValue ?? 0, 1) }}m</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-futbol"></i></div>
                <h3>Goals Scored</h3>
                <div class="stat-value">{{ $totalGoals ?? 0 }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-handshake"></i></div>
                <h3>Assists</h3>
                <div class="stat-value">{{ $totalAssists ?? 0 }}</div>
            </div>
        </div>

        <!-- Charts -->
        <div class="charts-grid">
            <div class="chart-card">
                <h3><i class="fas fa-trophy"></i> Top 5 Players (Total Points)</h3>
                <canvas id="topPlayersChart" height="250"></canvas>
            </div>
            <div class="chart-card">
                <h3><i class="fas fa-chart-pie"></i> Team Breakdown by Position</h3>
                <canvas id="positionChart" height="250"></canvas>
            </div>
        </div>

        <!-- Players Table -->
        <div class="table-container">
            <div class="table-header">
                <h3><i class="fas fa-users"></i> Your Team Players</h3>
                <span class="player-count">{{ isset($players) ? $players->count() : 0 }} players</span>
            </div>
            
            @if(isset($players) && $players->isNotEmpty())
                <table>
                    <thead>
                        <tr>
                            <th>Player</th>
                            <th>Team</th>
                            <th>Pos</th>
                            <th>Pts</th>
                            <th>Goals</th>
                            <th>Assists</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($players as $p)
                            <tr>
                                <td class="player-name">{{ $p->name }}</td>
                                <td>{{ $p->team->short_name ?? $p->team ?? 'N/A' }}</td>
                                <td>
                                    @php
                                        $posClass = '';
                                        if($p->position == 'GK') $posClass = 'pos-gk';
                                        elseif($p->position == 'DEF') $posClass = 'pos-def';
                                        elseif($p->position == 'MID') $posClass = 'pos-mid';
                                        elseif($p->position == 'FWD') $posClass = 'pos-fwd';
                                    @endphp
                                    <span class="position-badge {{ $posClass }}">{{ $p->position }}</span>
                                </td>
                                <td class="points-badge">{{ $p->points }}</td>
                                <td>{{ $p->goals ?? 0 }}</td>
                                <td>{{ $p->assists ?? 0 }}</td>
                                <td>£{{ number_format($p->price ?? 0, 1) }}m</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <i class="fas fa-users"></i>
                    <p>No players found in your team yet.</p>
                    <p style="font-size: 0.9rem; margin-top: 0.5rem;">Create your fantasy team to see player statistics.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
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
    document.addEventListener('click', function(e) {
        const sidebar = document.getElementById('sidebar');
        if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !e.target.closest('.burger-menu')) {
            sidebar.classList.remove('mobile-open');
            document.getElementById('overlay').classList.remove('active');
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        const sidebar = document.getElementById('sidebar');
        if (window.innerWidth > 768) {
            sidebar.classList.remove('mobile-open');
            document.getElementById('overlay').classList.remove('active');
        }
    });

    // Top Players Chart
    const topPlayersLabels = {!! json_encode($topPlayers->pluck('name') ?? []) !!};
    const topPlayersData = {!! json_encode($topPlayers->pluck('points') ?? []) !!};
    
    if (topPlayersLabels.length > 0) {
        new Chart(document.getElementById('topPlayersChart'), {
            type: 'bar',
            data: {
                labels: topPlayersLabels,
                datasets: [{
                    label: 'Points',
                    data: topPlayersData,
                    backgroundColor: 'rgba(58, 94, 229, 0.85)',
                    borderRadius: 8,
                    barPercentage: 0.7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: { 
                    legend: { display: false },
                    tooltip: { backgroundColor: '#1a2238', titleColor: '#fff', bodyColor: '#ccc' }
                },
                scales: { 
                    y: { 
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)' },
                        title: { display: true, text: 'Points', color: '#6c757d' }
                    },
                    x: { 
                        grid: { display: false },
                        ticks: { font: { size: 11 } }
                    }
                }
            }
        });
    }

    // Position Breakdown Chart
    const posData = {!! json_encode($positionBreakdown ?? []) !!};
    
    new Chart(document.getElementById('positionChart'), {
        type: 'pie',
        data: {
            labels: ['Goalkeepers', 'Defenders', 'Midfielders', 'Forwards'],
            datasets: [{
                data: [
                    posData.GK ?? 0,
                    posData.DEF ?? 0,
                    posData.MID ?? 0,
                    posData.FWD ?? 0
                ],
                backgroundColor: ['#3a5ee5', '#34c759', '#f59e0b', '#e53e3e'],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { 
                    position: 'bottom',
                    labels: { font: { size: 12 }, usePointStyle: true, boxWidth: 10 }
                },
                tooltip: { backgroundColor: '#1a2238', titleColor: '#fff', bodyColor: '#ccc' }
            }
        }
    });
</script>

</body>
</html>