<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Footsy Fantasy Football</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3a5ee5;
            --primary-dark: #2a48c5;
            --secondary: #34c759;
            --dark: #1a2238;
            --light: #f8f9fa;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --gradient: linear-gradient(135deg, var(--primary), var(--primary-dark));
            --sidebar-width: 260px;
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
            background-color: #f5f8fb;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
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
            margin-left: var(--sidebar-width);
            position: relative;
        }
        
        /* Header */
        .header {
            height: var(--header-height);
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
        
        .search-bar {
            display: flex;
            align-items: center;
            background: var(--light);
            border-radius: 50px;
            padding: 0.5rem 1rem;
            width: 300px;
        }
        
        .search-bar i {
            color: var(--gray);
            margin-right: 0.5rem;
        }
        
        .search-bar input {
            border: none;
            background: transparent;
            width: 100%;
            outline: none;
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
        
        /* Dashboard Content */
        .dashboard {
            padding: 2rem;
        }
        
        .welcome-banner {
            background: var(--gradient);
            color: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .welcome-content h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        
        .welcome-content p {
            opacity: 0.9;
        }
        
        .welcome-image {
            width: 120px;
        }
        
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background: rgba(58, 94, 229, 0.1);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 1rem;
        }
        
        .stat-info h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        
        .stat-info p {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }
        
        .card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .card-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        .view-all {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .player-list {
            list-style: none;
        }
        
        .player-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .player-item:last-child {
            border-bottom: none;
        }
        
        .player-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-weight: 600;
            color: var(--primary);
        }
        
        .player-info {
            flex: 1;
        }
        
        .player-name {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .player-details {
            display: flex;
            font-size: 0.85rem;
            color: var(--gray);
        }
        
        .player-details span {
            margin-right: 1rem;
        }
        
        .player-points {
            background: var(--light);
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            font-weight: 600;
            color: var(--primary);
        }
        
        .match-list {
            list-style: none;
        }
        
        .match-item {
            padding: 1rem 0;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .match-item:last-child {
            border-bottom: none;
        }
        
        .match-teams {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        
        .team {
            display: flex;
            align-items: center;
            font-weight: 600;
        }
        
        .team-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.5rem;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .vs {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .match-details {
            display: flex;
            justify-content: space-between;
            color: var(--gray);
            font-size: 0.85rem;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
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
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('fantasy-team.index') }}" class="nav-link {{ request()->routeIs('team.*') ? 'active' : '' }}">
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
        <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
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


<!-- Welcome Banner -->
<div class="welcome-banner">
    <div class="welcome-content">
        <h2>Welcome back, {{ Auth::user()->name }}!</h2>
        @if($userStats['has_team'])
            <p>Your team is currently ranked {{ $userStats['global_rank'] }}th overall. You have 2 upcoming matches this week.</p>
        @else
            <p>You haven't created a fantasy team yet. <a href="{{ route('fantasy-team.create') }}" style="color: white; text-decoration: underline;">Create your team now</a> to start playing!</p>
        @endif
    </div>
    <div class="welcome-image">
        <i class="fas fa-futbol" style="font-size: 5rem; opacity: 0.2;"></i>
    </div>
</div>

<!-- My Team Card - Only show if user has a team -->
@if($userStats['has_team'])
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">My Team</h3>
            <a href="{{ route('fantasy-team.index') }}" class="view-all">Manage Team</a>
        </div>
        
        <ul class="player-list">
            <!-- Sample player data - replace with actual team players -->
            <li class="player-item">
                <div class="player-avatar">HK</div>
                <div class="player-info">
                    <div class="player-name">Harry Kane</div>
                    <div class="player-details">
                        <span>TOT • FWD</span>
                        <span>£12.5m</span>
                    </div>
                </div>
                <div class="player-points">12 pts</div>
            </li>
            <!-- More players... -->
        </ul>
    </div>
@else
    <!-- Prompt to create a team -->
    <div class="card" style="text-align: center; padding: 2rem;">
        <h3>You don't have a fantasy team yet</h3>
        <p>Create your fantasy team to start competing with other managers</p>
        <a href="{{ route('fantasy-team.create') }}" class="btn btn-primary" style="margin-top: 1rem; display: inline-block; width: auto;">
            Create Your Team
        </a>
    </div>
@endif

            <!-- Stats Cards -->
            <div class="dashboard-stats">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stat-info">
                        <h3>124th</h3>
                        <p>Global Rank</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-info">
                        <h3>224</h3>
                        <p>Total Points</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3>2</h3>
                        <p>Leagues Joined</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <div class="stat-info">
                        <h3>1/1</h3>
                        <p>Free Transfers</p>
                    </div>
                </div>
            </div>

            <!-- Main Dashboard Grid -->
            <div class="dashboard-grid">
                <!-- Left Column -->
                <div class="left-column">
                    <!-- My Team Card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">My Team</h3>
                            <a href="#" class="view-all">Manage Team</a>
                        </div>
                        
                        <ul class="player-list">
                            <li class="player-item">
                                <div class="player-avatar">HK</div>
                                <div class="player-info">
                                    <div class="player-name">Harry Kane</div>
                                    <div class="player-details">
                                        <span>TOT • FWD</span>
                                        <span>£12.5m</span>
                                    </div>
                                </div>
                                <div class="player-points">12 pts</div>
                            </li>
                            
                            <li class="player-item">
                                <div class="player-avatar">KS</div>
                                <div class="player-info">
                                    <div class="player-name">Kevin De Bruyne</div>
                                    <div class="player-details">
                                        <span>MCI • MID</span>
                                        <span>£11.0m</span>
                                    </div>
                                </div>
                                <div class="player-points">8 pts</div>
                            </li>
                            
                            <li class="player-item">
                                <div class="player-avatar">MS</div>
                                <div class="player-info">
                                    <div class="player-name">Mohamed Salah</div>
                                    <div class="player-details">
                                        <span>LIV • FWD</span>
                                        <span>£13.0m</span>
                                    </div>
                                </div>
                                <div class="player-points">6 pts</div>
                            </li>
                            
                            <li class="player-item">
                                <div class="player-avatar">TS</div>
                                <div class="player-info">
                                    <div class="player-name">Trent Alexander-Arnold</div>
                                    <div class="player-details">
                                        <span>LIV • DEF</span>
                                        <span>£8.5m</span>
                                    </div>
                                </div>
                                <div class="player-points">5 pts</div>
                            </li>
                        </ul>
                    </div>
                    
                   
                            <!-- Upcoming Fixtures Section -->
@if(isset($upcomingFixtures) && count($upcomingFixtures) > 0)
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Upcoming Fixtures</h3>
            <a href="{{ route('fixtures.index') }}" class="view-all">View All</a>
        </div>
        
        <ul class="match-list">
            @foreach($upcomingFixtures as $fixture)
                <li class="match-item">
                    <div class="match-teams">
                        <div class="team">
                            <div class="team-avatar">
                                {{ isset($fixture->home_team->short_name) ? substr($fixture->home_team->short_name, 0, 3) : (isset($fixture->homeTeam) ? substr($fixture->homeTeam->short_name, 0, 3) : 'HOM') }}
                            </div>
                            <span>{{ isset($fixture->home_team->name) ? $fixture->home_team->name : (isset($fixture->homeTeam) ? $fixture->homeTeam->name : 'Home Team') }}</span>
                        </div>
                        <div class="vs">VS</div>
                        <div class="team">
                            <div class="team-avatar">
                                {{ isset($fixture->away_team->short_name) ? substr($fixture->away_team->short_name, 0, 3) : (isset($fixture->awayTeam) ? substr($fixture->awayTeam->short_name, 0, 3) : 'AWY') }}
                            </div>
                            <span>{{ isset($fixture->away_team->name) ? $fixture->away_team->name : (isset($fixture->awayTeam) ? $fixture->awayTeam->name : 'Away Team') }}</span>
                        </div>
                    </div>
                    <div class="match-details">
                        <span>Premier League</span>
                        <span>
                            @if($fixture->kickoff_time instanceof \Carbon\Carbon)
                                {{ $fixture->kickoff_time->format('D, M j • g:i A') }}
                            @else
                                {{ \Carbon\Carbon::parse($fixture->kickoff_time)->format('D, M j • g:i A') }}
                            @endif
                        </span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif
                
                <!-- Right Column -->
                <div class="right-column">
                    <!-- League Standings Card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">League Standings</h3>
                            <a href="#" class="view-all">View All</a>
                        </div>
                        
                        <ul class="player-list">
                            <li class="player-item">
                                <div class="player-avatar" style="background: #FFD700; color: #000;">1</div>
                                <div class="player-info">
                                    <div class="player-name">Red Devils FC</div>
                                    <div class="player-details">
                                        <span>James Wilson</span>
                                    </div>
                                </div>
                                <div class="player-points">268</div>
                            </li>
                            
                            <li class="player-item">
                                <div class="player-avatar" style="background: #C0C0C0; color: #000;">2</div>
                                <div class="player-info">
                                    <div class="player-name">Blue Warriors</div>
                                    <div class="player-details">
                                        <span>Sarah Johnson</span>
                                    </div>
                                </div>
                                <div class="player-points">247</div>
                            </li>
                            
                            <li class="player-item">
                                <div class="player-avatar" style="background: #CD7F32; color: #000;">3</div>
                                <div class="player-info">
                                    <div class="player-name">Cityzens</div>
                                    <div class="player-details">
                                        <span>Michael Brown</span>
                                    </div>
                                </div>
                                <div class="player-points">232</div>
                            </li>
                            
                            <li class="player-item" style="background: rgba(58, 94, 229, 0.05); border-radius: 8px;">
                                <div class="player-avatar">4</div>
                                <div class="player-info">
                                    <div class="player-name">{{ Auth::user()->name }}</div>
                                    <div class="player-details">
                                        <span>Your Team</span>
                                    </div>
                                </div>
                                <div class="player-points">224</div>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Recent News Card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Fantasy News</h3>
                            <a href="#" class="view-all">View All</a>
                        </div>
                        
                        <ul class="match-list">
                            <li class="match-item">
                                <div class="player-name" style="margin-bottom: 0.5rem;">Haaland injury update</div>
                                <div class="match-details">
                                    <span>Expected return: Gameweek 10</span>
                                    <span>2 hours ago</span>
                                </div>
                            </li>
                            
                            <li class="match-item">
                                <div class="player-name" style="margin-bottom: 0.5rem;">Price rises predicted</div>
                                <div class="match-details">
                                    <span>Saka, Maddison expected to rise</span>
                                    <span>5 hours ago</span>
                                </div>
                            </li>
                            
                            <li class="match-item">
                                <div class="player-name" style="margin-bottom: 0.5rem;">Gameweek 9 tips</div>
                                <div class="match-details">
                                    <span>Best captain choices</span>
                                    <span>1 day ago</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple notifications toggle
        document.addEventListener('DOMContentLoaded', function() {
            const notificationBell = document.querySelector('.notification-bell');
            
            notificationBell.addEventListener('click', function() {
                alert('You have 3 new notifications!');
            });
            
            // Active navigation highlighting
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    navLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>