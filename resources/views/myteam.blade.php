<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Team - Footsy Fantasy Football</title>
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
        
        /* My Team Content */
        .team-content {
            padding: 2rem;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .page-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            color: var(--dark);
        }
        
        .team-info {
            display: flex;
            gap: 1rem;
            color: var(--gray);
        }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        /* Chips Section */
        .chips-container {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .chip {
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .chip-primary {
            background: var(--gradient);
            color: white;
        }
        
        .chip-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
        }
        
        .chip-disabled {
            background: var(--light-gray);
            color: var(--gray);
            cursor: not-allowed;
        }
        
        .chip:hover:not(.chip-disabled) {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        /* Team Formation */
        .team-formation {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
            position: relative;
        }
        
        .formation-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .formation-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        .formation-select {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            border: 1px solid var(--light-gray);
            background: white;
            color: var(--dark);
            font-family: 'Open Sans', sans-serif;
        }
        
        /* Pitch Design */
        .pitch {
            background: #3a8d5b;
            border: 2px solid #fff;
            border-radius: 8px;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            min-height: 500px;
        }
        
        .pitch::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                linear-gradient(to right, transparent 49%, rgba(255,255,255,0.2) 49%, rgba(255,255,255,0.2) 51%, transparent 51%),
                linear-gradient(to bottom, transparent 49%, rgba(255,255,255,0.2) 49%, rgba(255,255,255,0.2) 51%, transparent 51%);
            pointer-events: none;
        }
        
        .pitch::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 80px;
            height: 80px;
            border: 2px solid rgba(255,255,255,0.5);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }
        
        .position-row {
            display: flex;
            justify-content: space-around;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 2;
        }
        
        .player-card {
            width: 80px;
            background: white;
            border-radius: 6px;
            padding: 0.75rem 0.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .player-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }
        
        .player-card.captain::before {
            content: 'C';
            position: absolute;
            top: -8px;
            right: -8px;
            width: 20px;
            height: 20px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            font-size: 0.7rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .player-card.vice-captain::before {
            content: 'VC';
            position: absolute;
            top: -8px;
            right: -8px;
            width: 20px;
            height: 20px;
            background: var(--secondary);
            color: white;
            border-radius: 50%;
            font-size: 0.7rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .player-number {
            font-size: 0.8rem;
            color: var(--gray);
            margin-bottom: 0.25rem;
        }
        
        .player-name {
            font-weight: 600;
            font-size: 0.85rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .player-team {
            font-size: 0.75rem;
            color: var(--gray);
            margin-top: 0.25rem;
        }
        
        /* Substitutes */
        .substitutes {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .substitutes-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .substitutes-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }
        
        /* Player Details Modal */
        .player-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        .player-modal.active {
            display: flex;
        }
        
        .modal-content {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
        }
        
        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: var(--light-gray);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
        }
        
        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--light-gray);
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .modal-player-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--primary);
            font-weight: bold;
        }
        
        .modal-player-info {
            flex: 1;
        }
        
        .modal-player-name {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            margin-bottom: 0.25rem;
        }
        
        .modal-player-details {
            color: var(--gray);
            margin-bottom: 0.5rem;
        }
        
        .modal-player-price {
            font-weight: 600;
            color: var(--dark);
        }
        
        .modal-actions {
            display: flex;
            gap: 1rem;
        }
        
        .action-btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
        }
        
        .action-btn-primary {
            background: var(--primary);
            color: white;
        }
        
        .action-btn-outline {
            background: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
        }
        
        .action-btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        .modal-section {
            margin-bottom: 2rem;
        }
        
        .modal-section-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }
        
        .stat-item {
            background: var(--light);
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
        }
        
        .stat-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.25rem;
        }
        
        .stat-label {
            font-size: 0.85rem;
            color: var(--gray);
        }
        
        .fixtures-list {
            list-style: none;
        }
        
        .fixture-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .fixture-item:last-child {
            border-bottom: none;
        }
        
        .fixture-teams {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .fixture-team {
            font-weight: 600;
        }
        
        .fixture-vs {
            color: var(--gray);
        }
        
        .fixture-details {
            text-align: right;
        }
        
        .fixture-date {
            font-size: 0.85rem;
            color: var(--gray);
        }
        
        .fixture-time {
            font-weight: 600;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
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
            
            .position-row {
                flex-wrap: wrap;
                gap: 1rem;
                justify-content: center;
            }
            
            .substitutes-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 576px) {
            .header {
                padding: 0 1rem;
            }
            
            .search-bar {
                display: none;
            }
            
            .team-content {
                padding: 1rem;
            }
            
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .chips-container {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .modal-header {
                flex-direction: column;
                text-align: center;
            }
            
            .modal-actions {
                flex-direction: column;
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
                <a href="/dashboard" class="nav-link">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/myteam" class="nav-link active">
                    <i class="fas fa-users"></i>
                    <span>My Team</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-trophy"></i>
                    <span>Leagues</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-chart-line"></i>
                    <span>Statistics</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Transfers</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Fixtures</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
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

        <!-- My Team Content -->
        <div class="team-content">
            <div class="page-header">
                <h1 class="page-title">My Team</h1>
                <div class="team-info">
                    <div class="info-item">
                        <i class="fas fa-coins"></i>
                        <span>£98.5m</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-exchange-alt"></i>
                        <span>1/1 Free Transfers</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-chart-line"></i>
                        <span>1,248 Points</span>
                    </div>
                </div>
            </div>

            <!-- Chips Section -->
            <div class="chips-container">
                <div class="chip chip-primary">
                    <i class="fas fa-layer-group"></i>
                    <span>Bench Boost</span>
                </div>
                <div class="chip chip-outline">
                    <i class="fas fa-star"></i>
                    <span>Triple Captain</span>
                </div>
                <div class="chip chip-outline">
                    <i class="fas fa-sync-alt"></i>
                    <span>Wildcard</span>
                </div>
                <div class="chip chip-disabled">
                    <i class="fas fa-bolt"></i>
                    <span>Free Hit</span>
                </div>
            </div>

            <!-- Team Formation -->
            <div class="team-formation">
                <div class="formation-header">
                    <h2 class="formation-title">Starting XI</h2>
                    <select class="formation-select">
                        <option>4-4-2 Formation</option>
                        <option>4-3-3 Formation</option>
                        <option>3-5-2 Formation</option>
                        <option>3-4-3 Formation</option>
                    </select>
                </div>

                <div class="pitch">
                    <!-- Goalkeeper -->
                    <div class="position-row">
                        <div class="player-card" data-player-id="1">
                            <div class="player-number">1</div>
                            <div class="player-name">Alisson</div>
                            <div class="player-team">LIV</div>
                        </div>
                    </div>

                    <!-- Defenders -->
                    <div class="position-row">
                        <div class="player-card" data-player-id="2">
                            <div class="player-number">2</div>
                            <div class="player-name">Alexander-Arnold</div>
                            <div class="player-team">LIV</div>
                        </div>
                        <div class="player-card" data-player-id="3">
                            <div class="player-number">3</div>
                            <div class="player-name">Van Dijk</div>
                            <div class="player-team">LIV</div>
                        </div>
                        <div class="player-card" data-player-id="4">
                            <div class="player-number">4</div>
                            <div class="player-name">Dias</div>
                            <div class="player-team">MCI</div>
                        </div>
                        <div class="player-card" data-player-id="5">
                            <div class="player-number">5</div>
                            <div class="player-name">Cancelo</div>
                            <div class="player-team">MCI</div>
                        </div>
                    </div>

                    <!-- Midfielders -->
                    <div class="position-row">
                        <div class="player-card" data-player-id="6">
                            <div class="player-number">6</div>
                            <div class="player-name">De Bruyne</div>
                            <div class="player-team">MCI</div>
                        </div>
                        <div class="player-card captain" data-player-id="7">
                            <div class="player-number">7</div>
                            <div class="player-name">Salah</div>
                            <div class="player-team">LIV</div>
                        </div>
                        <div class="player-card" data-player-id="8">
                            <div class="player-number">8</div>
                            <div class="player-name">Son</div>
                            <div class="player-team">TOT</div>
                        </div>
                        <div class="player-card" data-player-id="9">
                            <div class="player-number">9</div>
                            <div class="player-name">Fernandes</div>
                            <div class="player-team">MUN</div>
                        </div>
                    </div>

                    <!-- Forwards -->
                    <div class="position-row">
                        <div class="player-card" data-player-id="10">
                            <div class="player-number">10</div>
                            <div class="player-name">Haaland</div>
                            <div class="player-team">MCI</div>
                        </div>
                        <div class="player-card vice-captain" data-player-id="11">
                            <div class="player-number">11</div>
                            <div class="player-name">Kane</div>
                            <div class="player-team">TOT</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Substitutes -->
            <div class="substitutes">
                <h2 class="substitutes-title">Substitutes</h2>
                <div class="substitutes-grid">
                    <div class="player-card" data-player-id="12">
                        <div class="player-number">12</div>
                        <div class="player-name">Ramsdale</div>
                        <div class="player-team">ARS</div>
                    </div>
                    <div class="player-card" data-player-id="13">
                        <div class="player-number">13</div>
                        <div class="player-name">White</div>
                        <div class="player-team">ARS</div>
                    </div>
                    <div class="player-card" data-player-id="14">
                        <div class="player-number">14</div>
                        <div class="player-name">Martinelli</div>
                        <div class="player-team">ARS</div>
                    </div>
                    <div class="player-card" data-player-id="15">
                        <div class="player-number">15</div>
                        <div class="player-name">Toney</div>
                        <div class="player-team">BRE</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Player Details Modal -->
    <div class="player-modal" id="playerModal">
        <div class="modal-content">
            <div class="modal-close" id="modalClose">
                <i class="fas fa-times"></i>
            </div>
            
            <div class="modal-header">
                <div class="modal-player-image">HK</div>
                <div class="modal-player-info">
                    <h2 class="modal-player-name">Harry Kane</h2>
                    <div class="modal-player-details">Tottenham • Forward</div>
                    <div class="modal-player-price">£12.5m</div>
                </div>
                <div class="modal-actions">
                    <button class="action-btn action-btn-primary" id="makeCaptain">
                        <i class="fas fa-crown"></i> Make Captain
                    </button>
                    <button class="action-btn action-btn-outline" id="makeViceCaptain">
                        <i class="fas fa-star"></i> Make Vice Captain
                    </button>
                </div>
            </div>
            
            <div class="modal-body">
                <div class="modal-section">
                    <h3 class="modal-section-title">Player Stats</h3>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-value">12</div>
                            <div class="stat-label">Goals</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">8</div>
                            <div class="stat-label">Assists</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">142</div>
                            <div class="stat-label">Points</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">87%</div>
                            <div class="stat-label">Pass Accuracy</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">42</div>
                            <div class="stat-label">Shots on Target</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">12</div>
                            <div class="stat-label">Yellow Cards</div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-section">
                    <h3 class="modal-section-title">Next Fixtures</h3>
                    <ul class="fixtures-list">
                        <li class="fixture-item">
                            <div class="fixture-teams">
                                <span class="fixture-team">TOT</span>
                                <span class="fixture-vs">vs</span>
                                <span class="fixture-team">MUN</span>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-date">Oct 22, 2023</div>
                                <div class="fixture-time">16:30 GMT</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="fixture-teams">
                                <span class="fixture-team">TOT</span>
                                <span class="fixture-vs">vs</span>
                                <span class="fixture-team">NEW</span>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-date">Oct 29, 2023</div>
                                <div class="fixture-time">15:00 GMT</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="fixture-teams">
                                <span class="fixture-team">CHE</span>
                                <span class="fixture-vs">vs</span>
                                <span class="fixture-team">TOT</span>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-date">Nov 5, 2023</div>
                                <div class="fixture-time">17:30 GMT</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const playerCards = document.querySelectorAll('.player-card');
            const playerModal = document.getElementById('playerModal');
            const modalClose = document.getElementById('modalClose');
            const makeCaptainBtn = document.getElementById('makeCaptain');
            const makeViceCaptainBtn = document.getElementById('makeViceCaptain');
            
            // Open player modal on card click
            playerCards.forEach(card => {
                card.addEventListener('click', function() {
                    const playerId = this.getAttribute('data-player-id');
                    // In a real app, you would fetch player data based on ID
                    playerModal.classList.add('active');
                });
            });
            
            // Close modal
            modalClose.addEventListener('click', function() {
                playerModal.classList.remove('active');
            });
            
            // Make captain
            makeCaptainBtn.addEventListener('click', function() {
                alert('Harry Kane is now your captain!');
                playerModal.classList.remove('active');
            });
            
            // Make vice captain
            makeViceCaptainBtn.addEventListener('click', function() {
                alert('Harry Kane is now your vice captain!');
                playerModal.classList.remove('active');
            });
            
            // Close modal if clicked outside
            window.addEventListener('click', function(event) {
                if (event.target === playerModal) {
                    playerModal.classList.remove('active');
                }
            });
            
            // Chip functionality
            const chips = document.querySelectorAll('.chip:not(.chip-disabled)');
            chips.forEach(chip => {
                chip.addEventListener('click', function() {
                    const chipType = this.querySelector('span').textContent;
                    alert(`You activated ${chipType} chip!`);
                });
            });
        });
    </script>
</body>
</html>