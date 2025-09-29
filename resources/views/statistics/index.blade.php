<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics - Footsy Fantasy Football</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #3a5ee5;
            --primary-dark: #2a48c5;
            --secondary: #34c759;
            --danger: #e53e3e;
            --warning: #f59e0b;
            --info: #0ea5e9;
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
            max-width: 1400px;
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
        
        /* Statistics Content */
        .statistics-content {
            padding: 2rem;
        }
        
        .statistics-header {
            margin-bottom: 2rem;
        }
        
        .statistics-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        
        .statistics-subtitle {
            color: var(--gray);
        }
        
        /* Stats Navigation */
        .stats-nav {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .stat-tab {
            padding: 0.75rem 1.5rem;
            background: white;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .stat-tab.active {
            background: var(--gradient);
            color: white;
            border-color: var(--primary);
        }
        
        .stat-tab:hover:not(.active) {
            border-color: var(--primary);
        }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .stat-card-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .stat-card-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }
        
        .icon-primary { background: rgba(58, 94, 229, 0.1); color: var(--primary); }
        .icon-secondary { background: rgba(52, 199, 89, 0.1); color: var(--secondary); }
        .icon-warning { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .icon-danger { background: rgba(229, 62, 62, 0.1); color: var(--danger); }
        
        .stat-card-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .stat-card-change {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.9rem;
        }
        
        .change-positive { color: var(--secondary); }
        .change-negative { color: var(--danger); }
        
        /* Charts Container */
        .charts-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .chart-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .chart-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .chart-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .chart-action {
            padding: 0.25rem 0.5rem;
            border: 1px solid var(--light-gray);
            border-radius: 4px;
            font-size: 0.8rem;
            cursor: pointer;
        }
        
        .chart-action.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        .chart-container {
            position: relative;
            height: 300px;
        }
        
        /* Top Performers */
        .top-performers {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
        
        .performers-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .performers-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        .performers-tabs {
            display: flex;
            gap: 0.5rem;
        }
        
        .performer-tab {
            padding: 0.5rem 1rem;
            border: 1px solid var(--light-gray);
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
        }
        
        .performer-tab.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        .performers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }
        
        .performer-card {
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            padding: 1rem;
            transition: all 0.3s;
        }
        
        .performer-card:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
        }
        
        .performer-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }
        
        .performer-rank {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--gradient);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .performer-team {
            font-size: 0.8rem;
            color: var(--gray);
            font-weight: 600;
        }
        
        .performer-name {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .performer-position {
            font-size: 0.8rem;
            color: var(--gray);
            margin-bottom: 0.5rem;
        }
        
        .performer-stats {
            display: flex;
            justify-content: space-between;
        }
        
        .performer-stat {
            text-align: center;
        }
        
        .stat-number {
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--primary);
        }
        
        .stat-label {
            font-size: 0.7rem;
            color: var(--gray);
        }
        
        /* Comparison Table */
        .comparison-table {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .table-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        .table-container {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--light-gray);
        }
        
        th {
            font-weight: 600;
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        td {
            font-size: 0.9rem;
        }
        
        .player-cell {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .player-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .trend-up {
            color: var(--secondary);
        }
        
        .trend-down {
            color: var(--danger);
        }
        
        /* Responsive Design */
        @media (max-width: 1200px) {
            .charts-container {
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
            
            .header {
                padding: 0 1rem;
            }
            
            .user-info {
                display: none;
            }
            
            .stats-nav {
                flex-direction: column;
            }
            
            .stat-tab {
                text-align: center;
            }
            
            .charts-container {
                grid-template-columns: 1fr;
            }
            
            .performers-grid {
                grid-template-columns: 1fr;
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
                <a href="{{ route('statistics.index') }}" class="nav-link active">
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

        <!-- Statistics Content -->
        <div class="statistics-content">
            <div class="statistics-header">
                <h1 class="statistics-title">Football Statistics</h1>
                <p class="statistics-subtitle">Analytics and insights to help you make better fantasy football decisions</p>
            </div>

            <!-- Stats Navigation -->
            <div class="stats-nav">
                <div class="stat-tab active" onclick="showTab('overview')">Overview</div>
                <div class="stat-tab" onclick="showTab('players')">Player Stats</div>
                <div class="stat-tab" onclick="showTab('teams')">Team Stats</div>
                <div class="stat-tab" onclick="showTab('fixtures')">Fixture Analysis</div>
                <div class="stat-tab" onclick="showTab('trends')">Trends</div>
            </div>

            <!-- Overview Tab -->
            <div id="overview-tab" class="tab-content">
                <!-- Key Stats Grid -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <h3 class="stat-card-title">Total Points</h3>
                            <div class="stat-card-icon icon-primary">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                        <div class="stat-card-value">0</div>
                        <div class="stat-card-change change-positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>You haven't created any team yet</span>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <h3 class="stat-card-title">Global Rank</h3>
                            <div class="stat-card-icon icon-secondary">
                                <i class="fas fa-trophy"></i>
                            </div>
                        </div>
                        <div class="stat-card-value">#1,024</div>
                        <div class="stat-card-change change-positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>Can't determine change</span>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <h3 class="stat-card-title">Team Value</h3>
                            <div class="stat-card-icon icon-warning">
                                <i class="fas fa-coins"></i>
                            </div>
                        </div>
                        <div class="stat-card-value">£100.0m</div>
                        <div class="stat-card-change change-positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>You haven't created any team yet</span>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <h3 class="stat-card-title">Transfers Made</h3>
                            <div class="stat-card-icon icon-danger">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                        </div>
                        <div class="stat-card-value">0</div>
                        <div class="stat-card-change change-negative">
                            <i class="fas fa-arrow-down"></i>
                            <span>3 free transfers remaining</span>
                        </div>
                    </div>
                </div>

                <!-- Charts Container -->
                <div class="charts-container">
                    <!-- Points Progress Chart -->
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Points Progress</h3>
                            <div class="chart-actions">
                                <span class="chart-action active">Weekly</span>
                                <span class="chart-action">Monthly</span>
                                <span class="chart-action">Season</span>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="pointsChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Position Distribution -->
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Team Distribution</h3>
                            <div class="chart-actions">
                                <span class="chart-action active">Formation</span>
                                <span class="chart-action">Value</span>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="formationChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Top Performers -->
                <div class="top-performers">
                    <div class="performers-header">
                        <h3 class="performers-title">Top Performers</h3>
                        <div class="performers-tabs">
                            <span class="performer-tab active">This Week</span>
                            <span class="performer-tab">Season</span>
                            <span class="performer-tab">By Position</span>
                        </div>
                    </div>
                    <div class="performers-grid">
                        <div class="performer-card">
                            <div class="performer-header">
                                <div class="performer-rank">1</div>
                                <div class="performer-team">MCI</div>
                            </div>
                            <div class="performer-name">Erling Haaland</div>
                            <div class="performer-position">Forward • £14.0M</div>
                            <div class="performer-stats">
                                <div class="performer-stat">
                                    <div class="stat-number">18</div>
                                    <div class="stat-label">Points</div>
                                </div>
                                <div class="performer-stat">
                                    <div class="stat-number">3</div>
                                    <div class="stat-label">Goals</div>
                                </div>
                                <div class="performer-stat">
                                    <div class="stat-number">245</div>
                                    <div class="stat-label">Total</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="performer-card">
                            <div class="performer-header">
                                <div class="performer-rank">2</div>
                                <div class="performer-team">LIV</div>
                            </div>
                            <div class="performer-name">Mohamed Salah</div>
                            <div class="performer-position">Midfielder • £12.5M</div>
                            <div class="performer-stats">
                                <div class="performer-stat">
                                    <div class="stat-number">16</div>
                                    <div class="stat-label">Points</div>
                                </div>
                                <div class="performer-stat">
                                    <div class="stat-number">2</div>
                                    <div class="stat-label">Goals</div>
                                </div>
                                <div class="performer-stat">
                                    <div class="stat-number">210</div>
                                    <div class="stat-label">Total</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="performer-card">
                            <div class="performer-header">
                                <div class="performer-rank">3</div>
                                <div class="performer-team">TOT</div>
                            </div>
                            <div class="performer-name">Harry Kane</div>
                            <div class="performer-position">Forward • £12.5M</div>
                            <div class="performer-stats">
                                <div class="performer-stat">
                                    <div class="stat-number">14</div>
                                    <div class="stat-label">Points</div>
                                </div>
                                <div class="performer-stat">
                                    <div class="stat-number">2</div>
                                    <div class="stat-label">Goals</div>
                                </div>
                                <div class="performer-stat">
                                    <div class="stat-number">215</div>
                                    <div class="stat-label">Total</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Player Comparison Table -->
                <div class="comparison-table">
                    <div class="table-header">
                        <h3 class="table-title">Player Comparison</h3>
                        <select class="formation-select">
                            <option>Forwards</option>
                            <option>Midfielders</option>
                            <option>Defenders</option>
                            <option>Goalkeepers</option>
                        </select>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Player</th>
                                    <th>Team</th>
                                    <th>Price</th>
                                    <th>Points</th>
                                    <th>Goals</th>
                                    <th>Assists</th>
                                    <th>Form</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="player-cell">
                                            <div class="player-avatar">EH</div>
                                            <span>Erling Haaland</span>
                                        </div>
                                    </td>
                                    <td>MCI</td>
                                    <td>£14.0M</td>
                                    <td>245</td>
                                    <td>28</td>
                                    <td>7</td>
                                    <td class="trend-up">↑ 8.5</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="player-cell">
                                            <div class="player-avatar">HK</div>
                                            <span>Harry Kane</span>
                                        </div>
                                    </td>
                                    <td>TOT</td>
                                    <td>£12.5M</td>
                                    <td>215</td>
                                    <td>24</td>
                                    <td>5</td>
                                    <td class="trend-up">↑ 7.2</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="player-cell">
                                            <div class="player-avatar">MS</div>
                                            <span>Mohamed Salah</span>
                                        </div>
                                    </td>
                                    <td>LIV</td>
                                    <td>£12.5M</td>
                                    <td>210</td>
                                    <td>19</td>
                                    <td>11</td>
                                    <td class="trend-up">↑ 6.8</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="player-cell">
                                            <div class="player-avatar">KDB</div>
                                            <span>Kevin De Bruyne</span>
                                        </div>
                                    </td>
                                    <td>MCI</td>
                                    <td>£10.5M</td>
                                    <td>185</td>
                                    <td>9</td>
                                    <td>18</td>
                                    <td class="trend-down">↓ 5.2</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="player-cell">
                                            <div class="player-avatar">BF</div>
                                            <span>Bruno Fernandes</span>
                                        </div>
                                    </td>
                                    <td>MUN</td>
                                    <td>£9.5M</td>
                                    <td>168</td>
                                    <td>11</td>
                                    <td>14</td>
                                    <td class="trend-up">↑ 6.1</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Other Tabs (Hidden by default) -->
            <div id="players-tab" class="tab-content" style="display: none;">
                <!-- Player statistics content would go here -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">Player Performance Analysis</h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="playersChart"></canvas>
                    </div>
                </div>
            </div>

            <div id="teams-tab" class="tab-content" style="display: none;">
                <!-- Team statistics content would go here -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">Team Performance Comparison</h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="teamsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab navigation
        function showTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.style.display = 'none';
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('.stat-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Show selected tab
            document.getElementById(tabName + '-tab').style.display = 'block';
            
            // Add active class to clicked tab
            event.target.classList.add('active');
        }

        // Initialize charts when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Points Progress Chart
            const pointsCtx = document.getElementById('pointsChart').getContext('2d');
            new Chart(pointsCtx, {
                type: 'line',
                data: {
                    labels: ['GW1', 'GW2', 'GW3', 'GW4', 'GW5'],
                    datasets: [{
                        label: 'Your Points',
                        data: [0, 0, 0, 0, 0],
                        borderColor: '#3a5ee5',
                        backgroundColor: 'rgba(58, 94, 229, 0.1)',
                        tension: 0.3,
                        fill: true
                    }, {
                        label: 'Average Points',
                        data: [52, 55, 58, 61, 59, 63, 65, 68],
                        borderColor: '#6c757d',
                        backgroundColor: 'rgba(108, 117, 125, 0.1)',
                        tension: 0.3,
                        fill: true,
                        borderDash: [5, 5]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Points'
                            }
                        }
                    }
                }
            });

            // Formation Chart
            const formationCtx = document.getElementById('formationChart').getContext('2d');
            new Chart(formationCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Goalkeepers', 'Defenders', 'Midfielders', 'Forwards'],
                    datasets: [{
                        data: [1, 4, 4, 2],
                        backgroundColor: [
                            '#3a5ee5',
                            '#34c759',
                            '#f59e0b',
                            '#e53e3e'
                        ],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    }
                }
            });

            // Players Chart
            const playersCtx = document.getElementById('playersChart').getContext('2d');
            new Chart(playersCtx, {
                type: 'bar',
                data: {
                    labels: ['Haaland', 'Salah', 'Kane', 'De Bruyne', 'Fernandes'],
                    datasets: [{
                        label: 'Total Points',
                        data: [245, 210, 215, 185, 168],
                        backgroundColor: 'rgba(58, 94, 229, 0.8)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Teams Chart
            // const teamsCtx = document.getElementById('teamsChart').getContext('2d');
            // new Chart(teamsCtx, {
            //     type: 'radar',
            //     data: {
            //         labels: ['Attack', 'Defense', 'Midfield', 'Set Pieces', 'Form'],
            //         datasets: [{
            //             label: 'Man City',
            //             data: [95, 88, 92, 85, 90],
            //             borderColor: '#6c757d',
            //             backgroundColor: 'rgba(108, 117, 125, 0.1)',
            //             pointBackgroundColor: '#6c757d'
            //         }, {
            //             label: 'Liverpool',
            //             data: [88, 82, 90, 80, 85],
            //             borderColor: '#e53e3e',
            //             backgroundColor: 'rgba(229, 62, 62, 0.1)',
            //             pointBackgroundColor: '#e53e3e'
            //         }, {
            //             label: 'Arsenal',
            //             data: [85, 90, 87, 82, 88],
            //             borderColor: '#3a5ee5',
            //             backgroundColor: 'rgba(58, 94, 229, 0.1)',
            //             pointBackgroundColor: '#3a5ee5'
            //         }]
            //     },
            //     options: {
            //         responsive: true,
            //         maintainAspectRatio: false,
            //         scales: {
            //             r: {
            //                 angleLines: {
            //                     display: true
            //                 },
            //                 suggestedMin: 0,
            //                 suggestedMax: 100
            //             }
            //         }
            //     }
            // });
        });

        // Add interactivity to performer tabs
        document.querySelectorAll('.performer-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.performer-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Add interactivity to chart actions
        document.querySelectorAll('.chart-action').forEach(action => {
            action.addEventListener('click', function() {
                const parent = this.parentElement;
                parent.querySelectorAll('.chart-action').forEach(a => a.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>