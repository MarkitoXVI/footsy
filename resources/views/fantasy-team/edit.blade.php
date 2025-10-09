<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Team - Footsy Fantasy Football</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3a5ee5;
            --primary-dark: #2a48c5;
            --secondary: #34c759;
            --danger: #e53e3e;
            --warning: #f59e0b;
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
        
        /* Team Content */
        .team-content {
            padding: 2rem;
        }
        
        .team-header {
            margin-bottom: 2rem;
        }
        
        .team-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        
        .team-subtitle {
            color: var(--gray);
        }
        
        /* Budget Display */
        .budget-display {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .budget-info {
            display: flex;
            gap: 2rem;
        }
        
        .budget-item {
            display: flex;
            flex-direction: column;
        }
        
        .budget-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .budget-total {
            color: var(--primary);
        }
        
        .budget-spent {
            color: var(--danger);
        }
        
        .budget-remaining {
            color: var(--secondary);
        }
        
        .budget-label {
            font-size: 0.9rem;
            color: var(--gray);
        }
        
        .formation-selector {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .formation-label {
            font-weight: 600;
        }
        
        .formation-display {
            padding: 0.5rem 1rem;
            background: var(--light-gray);
            border-radius: 6px;
            font-weight: 600;
        }
        
        /* Team Layout */
        .team-layout {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        
        /* Starting XI */
        .starting-xi {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .section-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--light-gray);
        }
        
        /* Football Pitch - More Spacious */
        .pitch-container {
            background: linear-gradient(#2e7d32, #1b5e20);
            border: 2px solid #1b5e20;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 1rem;
            position: relative;
            overflow: hidden;
        }
        
        .pitch {
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 50 L100 50 M50 0 L50 100 M0 0 L100 100 M100 0 L0 100' stroke='%23ffffff' stroke-width='0.5' stroke-opacity='0.1' fill='none'/%3E%3Ccircle cx='50' cy='50' r='10' stroke='%23ffffff' stroke-width='0.5' stroke-opacity='0.1' fill='none'/%3E%3C/svg%3E");
            background-size: 100px 100px;
            min-height: 600px; /* Increased height for more space */
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            position: relative;
        }
        
        /* Player Positions - More Spacious Layout */
        .position-row {
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
            position: absolute;
        }
        
        .goalkeeper-row { 
            top: 3%; 
            left: 0; 
            right: 0; 
        }
        .defenders-row { 
            top: 20%; 
            left: 0; 
            right: 0; 
        }
        .midfielders-row { 
            top: 45%; 
            left: 0; 
            right: 0; 
        }
        .forwards-row { 
            top: 75%; 
            left: 0; 
            right: 0; 
        }
        
        /* Player Card - Larger for better visibility */
        .player-card {
            width: 100px; /* Increased width */
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: all 0.3s ease;
            margin: 0 10px; /* Added spacing between players */
            cursor: pointer;
            position: relative;
        }
        
        .player-card:hover {
            transform: translateY(-5px);
        }
        
        .player-card.pending-swap {
            border: 2px solid var(--warning);
            border-radius: 8px;
            padding: 5px;
        }
        
        .player-avatar {
            width: 80px; /* Larger avatar */
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 1.2rem;
            position: relative;
            border: 2px solid white;
            background: var(--gradient);
            color: white;
        }
        
        .player-avatar.pending-swap {
            background: var(--warning);
        }
        
        .player-price {
            position: absolute;
            bottom: -5px;
            right: -5px;
            background: var(--warning);
            color: white;
            font-size: 0.7rem;
            padding: 0.2rem 0.4rem;
            border-radius: 10px;
            font-weight: 600;
        }
        
        .player-position {
            color: white;
            font-size: 0.8rem;
            text-align: center;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
            margin-bottom: 0.25rem;
        }
        
        .player-name {
            color: white;
            font-size: 0.85rem; /* Slightly larger text */
            text-align: center;
            margin-top: 0.25rem;
            max-width: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-weight: 600;
        }
        
        .player-team {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.65rem;
            text-align: center;
            margin-top: 0.1rem;
        }
        
        /* Substitute Bench */
        .substitute-bench {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .bench-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        
        .bench-player {
            display: flex;
            align-items: center;
            padding: 1rem;
            border: 2px solid var(--light-gray);
            border-radius: 8px;
            transition: all 0.3s ease;
            gap: 1rem;
            cursor: pointer;
        }
        
        .bench-player:hover {
            border-color: var(--primary);
            background: rgba(58, 94, 229, 0.05);
        }
        
        .bench-player.filled {
            border-style: solid;
            border-color: var(--light-gray);
        }
        
        .bench-player.pending-swap {
            border: 2px solid var(--warning);
            background: rgba(245, 158, 11, 0.1);
        }
        
        .bench-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
            border: 2px solid var(--primary);
            background: var(--gradient);
            color: white;
        }
        
        .bench-avatar.pending-swap {
            background: var(--warning);
            border-color: var(--warning);
        }
        
        .bench-info {
            flex: 1;
        }
        
        .bench-position {
            font-size: 0.8rem;
            color: var(--gray);
            margin-bottom: 0.25rem;
        }
        
        .bench-name {
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .bench-price {
            font-size: 0.8rem;
            color: var(--warning);
            font-weight: 600;
        }
        
        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--light-gray);
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
        }
        
        .btn-primary {
            background: var(--gradient);
            color: white;
        }
        
        .btn-primary:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(58, 94, 229, 0.3);
        }
        
        .btn-secondary {
            background: white;
            color: var(--primary);
            border: 1px solid var(--primary);
        }
        
        .btn-secondary:hover {
            background: rgba(58, 94, 229, 0.1);
        }
        
        .btn:disabled {
            background: var(--light-gray);
            color: var(--gray);
            cursor: not-allowed;
        }
        
        /* Swap Instructions */
        .swap-instructions {
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
            color: var(--primary);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        /* Error Popup */
        .error-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            justify-content: center;
            align-items: center;
        }
        
        .error-popup-content {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 400px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .error-popup-icon {
            font-size: 3rem;
            color: var(--danger);
            margin-bottom: 1rem;
        }
        
        .error-popup-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.4rem;
            margin-bottom: 1rem;
            color: var(--dark);
        }
        
        .error-popup-message {
            color: var(--gray);
            margin-bottom: 2rem;
            line-height: 1.5;
        }
        
        .error-popup-close {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .error-popup-close:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        /* Responsive Design */
        @media (max-width: 1200px) {
            .team-layout {
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
            
            .budget-display {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
            
            .budget-info {
                flex-wrap: wrap;
            }
            
            .bench-grid {
                grid-template-columns: 1fr;
            }
            
            .pitch {
                min-height: 500px;
            }
            
            .player-card {
                width: 80px;
            }
            
            .player-avatar {
                width: 65px;
                height: 65px;
            }
        }
        
        @media (max-width: 576px) {
            .team-content {
                padding: 1rem;
            }
            
            .header {
                padding: 0 1rem;
            }
            
            .pitch {
                min-height: 450px;
            }
            
            .player-card {
                width: 70px;
            }
            
            .player-avatar {
                width: 55px;
                height: 55px;
                font-size: 1rem;
            }
            
            .player-name {
                font-size: 0.75rem;
            }
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <a href="{{ route('standings.index') }}" class="nav-link">
                    <i class="fas fa-list-ol"></i>
                    <span>Standings</span>
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

        <!-- Team Content -->
        <div class="team-content">
            <div class="team-header">
                <h1 class="team-title">Edit Your Fantasy Team</h1>
                <p class="team-subtitle">Click on any player to swap with a substitute of the same position</p>
            </div>

            @if($fantasyTeam)
                <!-- Budget Display -->
                <div class="budget-display">
                    <div class="budget-info">
                        <div class="budget-item">
                            <div class="budget-value budget-total">£{{ number_format($fantasyTeam->total_budget, 1) }}M</div>
                            <div class="budget-label">Total Budget</div>
                        </div>
                        <div class="budget-item">
                            <div class="budget-value budget-spent" id="spentBudget">£{{ number_format($fantasyTeam->spent_budget, 1) }}M</div>
                            <div class="budget-label">Money Spent</div>
                        </div>
                        <div class="budget-item">
                            <div class="budget-value budget-remaining" id="remainingBudget">£{{ number_format($fantasyTeam->remaining_budget, 1) }}M</div>
                            <div class="budget-label">Remaining</div>
                        </div>
                    </div>
                    <div class="formation-selector">
                        <span class="formation-label">Formation:</span>
                        <div class="formation-display">{{ $fantasyTeam->formation }}</div>
                    </div>
                </div>

                <!-- Swap Instructions -->
                <div class="swap-instructions" id="swapInstructions">
                    <i class="fas fa-info-circle"></i>
                    <span id="instructionsText">Click on any player to select them for swapping, then click on another player of the same position to swap them.</span>
                </div>

                <!-- Team Layout -->
                <div class="team-layout">
                    <!-- Starting XI -->
                    <div class="starting-xi">
                        <h3 class="section-title">Starting XI - {{ $fantasyTeam->formation }}</h3>
                        
                        <div class="pitch-container">
                            <div class="pitch">
                                @php
                                    // Get formation numbers
                                    $formation = explode('-', $fantasyTeam->formation);
                                    $defendersCount = (int)$formation[0];
                                    $midfieldersCount = (int)$formation[1];
                                    $forwardsCount = (int)$formation[2];
                                    
                                    // Get players grouped by position and substitute status
                                    $startingPlayers = $fantasyTeam->players->where('pivot.is_substitute', false)->sortBy('pivot.position_order');
                                    $substitutePlayers = $fantasyTeam->players->where('pivot.is_substitute', true)->sortBy('pivot.position_order');
                                    
                                    // Organize players by position according to formation
                                    $goalkeepers = $startingPlayers->where('position', 'Goalkeeper');
                                    $defenders = $startingPlayers->where('position', 'Defender')->take($defendersCount);
                                    $midfielders = $startingPlayers->where('position', 'Midfielder')->take($midfieldersCount);
                                    $forwards = $startingPlayers->where('position', 'Forward')->take($forwardsCount);
                                @endphp

                                <!-- Goalkeeper -->
                                <div class="position-row goalkeeper-row">
                                    @foreach($goalkeepers as $player)
                                    <div class="player-card" data-player-id="{{ $player->id }}" data-position="goalkeeper" data-is-substitute="false" onclick="selectPlayer(this, {{ $player->id }}, 'goalkeeper', false)">
                                        <div class="player-avatar">
                                            @if($player->team && is_object($player->team))
                                                {{ $player->team->abbreviation ?? substr($player->team->name, 0, 3) }}
                                            @else
                                                {{ substr($player->team ?? 'N/A', 0, 3) }}
                                            @endif
                                            <div class="player-price">£{{ number_format($player->price, 1) }}M</div>
                                        </div>
                                        <div class="player-position">Goalkeeper</div>
                                        <div class="player-name">{{ $player->first_name }} {{ $player->last_name }}</div>
                                        <div class="player-team">
                                            @if($player->team && is_object($player->team))
                                                {{ $player->team->name }}
                                            @else
                                                {{ $player->team ?? 'No Team' }}
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                
                                <!-- Defenders -->
                                <div class="position-row defenders-row">
                                    @foreach($defenders as $index => $player)
                                    <div class="player-card" data-player-id="{{ $player->id }}" data-position="defender" data-is-substitute="false" onclick="selectPlayer(this, {{ $player->id }}, 'defender', false)">
                                        <div class="player-avatar">
                                            @if($player->team && is_object($player->team))
                                                {{ $player->team->abbreviation ?? substr($player->team->name, 0, 3) }}
                                            @else
                                                {{ substr($player->team ?? 'N/A', 0, 3) }}
                                            @endif
                                            <div class="player-price">£{{ number_format($player->price, 1) }}M</div>
                                        </div>
                                        <div class="player-position">Defender</div>
                                        <div class="player-name">{{ $player->first_name }} {{ $player->last_name }}</div>
                                        <div class="player-team">
                                            @if($player->team && is_object($player->team))
                                                {{ $player->team->name }}
                                            @else
                                                {{ $player->team ?? 'No Team' }}
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                
                                <!-- Midfielders -->
                                <div class="position-row midfielders-row">
                                    @foreach($midfielders as $index => $player)
                                    <div class="player-card" data-player-id="{{ $player->id }}" data-position="midfielder" data-is-substitute="false" onclick="selectPlayer(this, {{ $player->id }}, 'midfielder', false)">
                                        <div class="player-avatar">
                                            @if($player->team && is_object($player->team))
                                                {{ $player->team->abbreviation ?? substr($player->team->name, 0, 3) }}
                                            @else
                                                {{ substr($player->team ?? 'N/A', 0, 3) }}
                                            @endif
                                            <div class="player-price">£{{ number_format($player->price, 1) }}M</div>
                                        </div>
                                        <div class="player-position">Midfielder</div>
                                        <div class="player-name">{{ $player->first_name }} {{ $player->last_name }}</div>
                                        <div class="player-team">
                                            @if($player->team && is_object($player->team))
                                                {{ $player->team->name }}
                                            @else
                                                {{ $player->team ?? 'No Team' }}
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                
                                <!-- Forwards -->
                                <div class="position-row forwards-row">
                                    @foreach($forwards as $index => $player)
                                    <div class="player-card" data-player-id="{{ $player->id }}" data-position="forward" data-is-substitute="false" onclick="selectPlayer(this, {{ $player->id }}, 'forward', false)">
                                        <div class="player-avatar">
                                            @if($player->team && is_object($player->team))
                                                {{ $player->team->abbreviation ?? substr($player->team->name, 0, 3) }}
                                            @else
                                                {{ substr($player->team ?? 'N/A', 0, 3) }}
                                            @endif
                                            <div class="player-price">£{{ number_format($player->price, 1) }}M</div>
                                        </div>
                                        <div class="player-position">Forward</div>
                                        <div class="player-name">{{ $player->first_name }} {{ $player->last_name }}</div>
                                        <div class="player-team">
                                            @if($player->team && is_object($player->team))
                                                {{ $player->team->name }}
                                            @else
                                                {{ $player->team ?? 'No Team' }}
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Substitute Bench -->
                    <div class="substitute-bench">
                        <h3 class="section-title">Substitute Bench</h3>
                        
                        <div class="bench-grid">
                            @foreach($substitutePlayers as $index => $player)
                            <div class="bench-player filled" data-player-id="{{ $player->id }}" data-position="{{ strtolower($player->position) }}" data-is-substitute="true" onclick="selectPlayer(this, {{ $player->id }}, '{{ strtolower($player->position) }}', true)">
                                <div class="bench-avatar">
                                    @if($player->team && is_object($player->team))
                                        {{ $player->team->abbreviation ?? substr($player->team->name, 0, 3) }}
                                    @else
                                        {{ substr($player->team ?? 'N/A', 0, 3) }}
                                    @endif
                                </div>
                                <div class="bench-info">
                                    <div class="bench-position">{{ $player->position }}</div>
                                    <div class="bench-name">{{ $player->first_name }} {{ $player->last_name }}</div>
                                    <div class="bench-price">£{{ number_format($player->price, 1) }}M</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('fantasy-team.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Team
                    </a>
                    <button class="btn btn-primary" id="saveTeamBtn" onclick="saveTeam()">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            @else
                <!-- No Team State -->
                <div class="no-team-state">
                    <div class="empty-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h2 class="empty-title">No Fantasy Team Found</h2>
                    <div class="empty-text">
                        You don't have a fantasy team yet. Create your team first to make edits.
                    </div>
                    <a href="{{ route('fantasy-team.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create Your Team
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Error Popup -->
    <div class="error-popup" id="errorPopup">
        <div class="error-popup-content">
            <div class="error-popup-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 class="error-popup-title" id="errorPopupTitle">Invalid Swap</h3>
            <p class="error-popup-message" id="errorPopupMessage"></p>
            <button class="error-popup-close" onclick="closeErrorPopup()">OK</button>
        </div>
    </div>

    <script>
        // Team data structure
        const teamData = {
            teamId: {{ $fantasyTeam->id ?? 0 }},
            formation: '{{ $fantasyTeam->formation ?? "" }}',
            swaps: [], // Track player swaps
            totalBudget: {{ $fantasyTeam->total_budget ?? 100 }},
            spentBudget: {{ $fantasyTeam->spent_budget ?? 0 }}
        };

        // Swap state
        let firstSelectedPlayer = null;
        let secondSelectedPlayer = null;

        // Select player for swapping
        function selectPlayer(element, playerId, position, isSubstitute) {
            const playerData = {
                element: element,
                playerId: playerId,
                position: position,
                isSubstitute: isSubstitute,
                price: parseFloat(element.querySelector('.player-price, .bench-price')?.textContent.replace('£', '').replace('M', '') || 0),
                name: element.querySelector('.player-name, .bench-name').textContent
            };

            if (!firstSelectedPlayer) {
                // First player selection
                firstSelectedPlayer = playerData;
                element.classList.add('pending-swap');
                if (element.querySelector('.player-avatar, .bench-avatar')) {
                    element.querySelector('.player-avatar, .bench-avatar').classList.add('pending-swap');
                }
                document.getElementById('instructionsText').textContent = `Selected ${playerData.name}. Now select another ${position} to swap with.`;
            } else {
                // Second player selection
                if (firstSelectedPlayer.position !== position) {
                    showErrorPopup(
                        'Invalid Position',
                        `Cannot swap players of different positions. Please select another ${firstSelectedPlayer.position}.`
                    );
                    return;
                }

                if (firstSelectedPlayer.playerId === playerId) {
                    showErrorPopup(
                        'Invalid Selection',
                        'Cannot swap a player with themselves. Please select a different player.'
                    );
                    return;
                }

                secondSelectedPlayer = playerData;
                
                // Perform the swap
                performSwap();
            }
        }

        // Show error popup
        function showErrorPopup(title, message) {
            document.getElementById('errorPopupTitle').textContent = title;
            document.getElementById('errorPopupMessage').textContent = message;
            document.getElementById('errorPopup').style.display = 'flex';
        }

        // Close error popup
        function closeErrorPopup() {
            document.getElementById('errorPopup').style.display = 'none';
        }

        // Perform the actual swap
        function performSwap() {
            if (!firstSelectedPlayer || !secondSelectedPlayer) return;

            // Add swap to team data
            teamData.swaps.push({
                player1: firstSelectedPlayer,
                player2: secondSelectedPlayer
            });

            // Swap the players visually
            swapPlayerElements(firstSelectedPlayer.element, secondSelectedPlayer.element);

            // Reset selection
            resetSelection();

            // Update instructions
            document.getElementById('instructionsText').textContent = 'Swap successful! Click on any player to make another swap.';
        }

        // Swap player elements visually
        function swapPlayerElements(element1, element2) {
            // For player cards (pitch)
            if (element1.classList.contains('player-card') && element2.classList.contains('player-card')) {
                const tempContent = element1.innerHTML;
                element1.innerHTML = element2.innerHTML;
                element2.innerHTML = tempContent;
            }
            // For bench players
            else if (element1.classList.contains('bench-player') && element2.classList.contains('bench-player')) {
                const tempContent = element1.innerHTML;
                element1.innerHTML = element2.innerHTML;
                element2.innerHTML = tempContent;
            }
            // Cross-swap (pitch <-> bench)
            else {
                // Store original data
                const element1Data = {
                    avatar: element1.querySelector('.player-avatar, .bench-avatar').innerHTML,
                    position: element1.querySelector('.player-position, .bench-position').textContent,
                    name: element1.querySelector('.player-name, .bench-name').textContent,
                    team: element1.querySelector('.player-team, .bench-info .bench-position + .bench-name')?.textContent || '',
                    price: element1.querySelector('.player-price, .bench-price')?.textContent || ''
                };

                const element2Data = {
                    avatar: element2.querySelector('.player-avatar, .bench-avatar').innerHTML,
                    position: element2.querySelector('.player-position, .bench-position').textContent,
                    name: element2.querySelector('.player-name, .bench-name').textContent,
                    team: element2.querySelector('.player-team, .bench-info .bench-position + .bench-name')?.textContent || '',
                    price: element2.querySelector('.player-price, .bench-price')?.textContent || ''
                };

                // Swap the content
                element1.querySelector('.player-avatar, .bench-avatar').innerHTML = element2Data.avatar;
                element1.querySelector('.player-position, .bench-position').textContent = element2Data.position;
                element1.querySelector('.player-name, .bench-name').textContent = element2Data.name;
                if (element1.querySelector('.player-team')) {
                    element1.querySelector('.player-team').textContent = element2Data.team;
                }
                if (element1.querySelector('.player-price, .bench-price')) {
                    element1.querySelector('.player-price, .bench-price').textContent = element2Data.price;
                }

                element2.querySelector('.player-avatar, .bench-avatar').innerHTML = element1Data.avatar;
                element2.querySelector('.player-position, .bench-position').textContent = element1Data.position;
                element2.querySelector('.player-name, .bench-name').textContent = element1Data.name;
                if (element2.querySelector('.player-team')) {
                    element2.querySelector('.player-team').textContent = element1Data.team;
                }
                if (element2.querySelector('.player-price, .bench-price')) {
                    element2.querySelector('.player-price, .bench-price').textContent = element1Data.price;
                }
            }

            // Update data attributes
            const tempPlayerId = element1.getAttribute('data-player-id');
            const tempIsSubstitute = element1.getAttribute('data-is-substitute');
            
            element1.setAttribute('data-player-id', element2.getAttribute('data-player-id'));
            element1.setAttribute('data-is-substitute', element2.getAttribute('data-is-substitute'));
            
            element2.setAttribute('data-player-id', tempPlayerId);
            element2.setAttribute('data-is-substitute', tempIsSubstitute);
        }

        // Reset selection state
        function resetSelection() {
            if (firstSelectedPlayer) {
                firstSelectedPlayer.element.classList.remove('pending-swap');
                if (firstSelectedPlayer.element.querySelector('.player-avatar, .bench-avatar')) {
                    firstSelectedPlayer.element.querySelector('.player-avatar, .bench-avatar').classList.remove('pending-swap');
                }
            }
            if (secondSelectedPlayer) {
                secondSelectedPlayer.element.classList.remove('pending-swap');
                if (secondSelectedPlayer.element.querySelector('.player-avatar, .bench-avatar')) {
                    secondSelectedPlayer.element.querySelector('.player-avatar, .bench-avatar').classList.remove('pending-swap');
                }
            }
            
            firstSelectedPlayer = null;
            secondSelectedPlayer = null;
        }

        // Save team changes
        function saveTeam() {
            if (teamData.swaps.length === 0) {
                showErrorPopup('No Changes', 'No changes made to save.');
                return;
            }

            // Prepare swap data for submission
            const swapData = {
                swaps: teamData.swaps.map(swap => ({
                    player1_id: swap.player1.playerId,
                    player2_id: swap.player2.playerId,
                    player1_was_substitute: swap.player1.isSubstitute,
                    player2_was_substitute: swap.player2.isSubstitute
                }))
            };

            // Show loading state
            const saveButton = document.getElementById('saveTeamBtn');
            const originalText = saveButton.innerHTML;
            saveButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
            saveButton.disabled = true;

            // Submit swap data to server
            fetch(`/fantasy-team/${teamData.teamId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify(swapData)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Server error: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Team updated successfully!');
                    window.location.href = data.redirect_url || "{{ route('fantasy-team.index') }}";
                } else {
                    throw new Error(data.message || 'Failed to update team');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorPopup('Save Error', 'An error occurred while saving changes. Please try again.');
                saveButton.innerHTML = originalText;
                saveButton.disabled = false;
            });
        }

        // Add some interactive animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate player cards on load
            const playerCards = document.querySelectorAll('.player-card');
            playerCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.style.animation = 'fadeInUp 0.6s ease-out forwards';
            });

            // Animate bench players
            const benchPlayers = document.querySelectorAll('.bench-player');
            benchPlayers.forEach((player, index) => {
                player.style.animationDelay = `${index * 0.1 + 0.6}s`;
                player.style.animation = 'fadeIn 0.5s ease-out forwards';
            });
        });

        // Add CSS animations
        const style = document.createElement('style');
        style.textContent = `
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
            
            @keyframes fadeIn {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }
            
            .player-card, .bench-player {
                opacity: 0;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>