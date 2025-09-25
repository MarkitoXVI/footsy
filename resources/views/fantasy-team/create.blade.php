<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Team - Footsy Fantasy Football</title>
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
        
        /* Team Creation Content */
        .team-creation-content {
            padding: 2rem;
        }
        
        .team-creation-header {
            margin-bottom: 2rem;
        }
        
        .team-creation-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        
        .team-creation-subtitle {
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
        
        .formation-select {
            padding: 0.5rem 1rem;
            border: 1px solid var(--light-gray);
            border-radius: 6px;
            background: white;
        }
        
        /* Team Layout */
        .team-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
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
        
        /* Football Pitch */
        .pitch-container {
            background: linear-gradient(#2e7d32, #1b5e20);
            border: 2px solid #1b5e20;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            position: relative;
            overflow: hidden;
        }
        
        .pitch {
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 50 L100 50 M50 0 L50 100 M0 0 L100 100 M100 0 L0 100' stroke='%23ffffff' stroke-width='0.5' stroke-opacity='0.1' fill='none'/%3E%3Ccircle cx='50' cy='50' r='10' stroke='%23ffffff' stroke-width='0.5' stroke-opacity='0.1' fill='none'/%3E%3C/svg%3E");
            background-size: 100px 100px;
            min-height: 400px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            position: relative;
        }
        
        /* Player Positions */
        .position-row {
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
            position: absolute;
        }
        
        .goalkeeper-row { top: 5%; left: 0; right: 0; }
        .defenders-row { top: 25%; left: 0; right: 0; }
        .midfielders-row { top: 50%; left: 0; right: 0; }
        .forwards-row { top: 75%; left: 0; right: 0; }
        
        /* Player Card */
        .player-card {
            width: 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .player-card:hover {
            transform: translateY(-5px);
        }
        
        .player-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 1.2rem;
            position: relative;
        }
        
        .player-avatar.empty {
            border: 2px dashed rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
        }
        
        .player-avatar.filled {
            border: 2px solid white;
            background: var(--gradient);
            color: white;
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
        }
        
        .player-name {
            color: white;
            font-size: 0.7rem;
            text-align: center;
            margin-top: 0.25rem;
            max-width: 80px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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
            border: 2px dashed var(--light-gray);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            gap: 1rem;
        }
        
        .bench-player:hover {
            border-color: var(--primary);
            background: rgba(58, 94, 229, 0.05);
        }
        
        .bench-player.filled {
            border-style: solid;
            border-color: var(--light-gray);
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
        }
        
        .bench-avatar.empty {
            border: 2px dashed var(--light-gray);
            background: var(--light);
            color: var(--gray);
        }
        
        .bench-avatar.filled {
            border: 2px solid var(--primary);
            background: var(--gradient);
            color: white;
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
        
        /* Player Selection Modal */
        .modal {
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
        
        .modal-content {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .modal-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.4rem;
        }
        
        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--gray);
        }
        
        .modal-body {
            padding: 1.5rem;
            max-height: 60vh;
            overflow-y: auto;
        }
        
        .players-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .player-option {
            border: 2px solid var(--light-gray);
            border-radius: 8px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .player-option:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
        }
        
        .player-option.selected {
            border-color: var(--primary);
            background: rgba(58, 94, 229, 0.05);
        }
        
        .option-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        
        .option-team {
            font-size: 0.8rem;
            color: var(--gray);
            font-weight: 600;
        }
        
        .option-price {
            background: var(--warning);
            color: white;
            padding: 0.2rem 0.5rem;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .option-name {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .option-position {
            font-size: 0.8rem;
            color: var(--gray);
            margin-bottom: 0.5rem;
        }
        
        .option-stats {
            display: flex;
            gap: 1rem;
            font-size: 0.8rem;
        }
        
        .stat {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .stat-value {
            font-weight: 600;
            color: var(--primary);
        }
        
        .stat-label {
            color: var(--gray);
        }
        
        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--light-gray);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }
        
        /* Validation Errors */
        .validation-error {
            background: rgba(229, 62, 62, 0.1);
            border: 1px solid rgba(229, 62, 62, 0.2);
            color: var(--danger);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: none;
        }
        
        /* Loading Spinner */
        .fa-spin {
            animation: fa-spin 2s infinite linear;
        }
        
        @keyframes fa-spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
            
            .players-grid {
                grid-template-columns: 1fr;
            }
            
            .bench-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 576px) {
            .team-creation-content {
                padding: 1rem;
            }
            
            .header {
                padding: 0 1rem;
            }
            
            .pitch {
                min-height: 300px;
            }
            
            .player-card {
                width: 60px;
            }
            
            .player-avatar {
                width: 50px;
                height: 50px;
                font-size: 1rem;
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

        <!-- Team Creation Content -->
        <div class="team-creation-content">
            <div class="team-creation-header">
                <h1 class="team-creation-title">Create Your Fantasy Team</h1>
                <p class="team-creation-subtitle">Select 11 starting players and 4 substitutes within your £100M budget</p>
            </div>

            <!-- Team Name Input -->
            <div style="margin-bottom: 1.5rem;">
                <label for="teamName" style="font-weight:600;display:block;margin-bottom:0.5rem;">Team Name</label>
                <input type="text" id="teamName" name="team_name" maxlength="30" placeholder="Enter your team name"
                    style="width:100%;max-width:400px;padding:0.75rem 1rem;border:1px solid var(--light-gray);border-radius:8px;font-size:1rem;">
            </div>
            <!-- End Team Name Input -->

            <!-- Budget Display -->
            <div class="budget-display">
                <div class="budget-info">
                    <div class="budget-item">
                        <div class="budget-value budget-total">£100.0M</div>
                        <div class="budget-label">Total Budget</div>
                    </div>
                    <div class="budget-item">
                        <div class="budget-value budget-spent" id="spentBudget">£0.0M</div>
                        <div class="budget-label">Money Spent</div>
                    </div>
                    <div class="budget-item">
                        <div class="budget-value budget-remaining" id="remainingBudget">£100.0M</div>
                        <div class="budget-label">Remaining</div>
                    </div>
                </div>
                <div class="formation-selector">
                    <span class="formation-label">Formation:</span>
                    <select class="formation-select" id="formationSelect">
                        <option value="4-4-2">4-4-2</option>
                        <option value="4-3-3">4-3-3</option>
                        <option value="3-5-2">3-5-2</option>
                        <option value="4-5-1">4-5-1</option>
                    </select>
                </div>
            </div>

            <!-- Validation Error -->
            <div class="validation-error" id="validationError">
                <i class="fas fa-exclamation-circle"></i>
                <span id="errorMessage"></span>
            </div>

            <!-- Team Layout -->
            <div class="team-layout">
                <!-- Starting XI -->
                <div class="starting-xi">
                    <h3 class="section-title">Starting XI</h3>
                    
                    <div class="pitch-container">
                        <div class="pitch">
                            <!-- Goalkeeper -->
                            <div class="position-row goalkeeper-row">
                                <div class="player-card" onclick="openPlayerModal('goalkeeper', 0)">
                                    <div class="player-avatar empty" id="gk-avatar">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div class="player-position">Goalkeeper</div>
                                    <div class="player-name" id="gk-name"></div>
                                </div>
                            </div>
                            
                            <!-- Defenders -->
                            <div class="position-row defenders-row" id="defendersRow">
                                <!-- Defenders will be generated based on formation -->
                            </div>
                            
                            <!-- Midfielders -->
                            <div class="position-row midfielders-row" id="midfieldersRow">
                                <!-- Midfielders will be generated based on formation -->
                            </div>
                            
                            <!-- Forwards -->
                            <div class="position-row forwards-row" id="forwardsRow">
                                <!-- Forwards will be generated based on formation -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Substitute Bench -->
                <div class="substitute-bench">
                    <h3 class="section-title">Substitute Bench</h3>
                    
                    <div class="bench-grid">
                        <!-- Goalkeeper Substitute -->
                        <div class="bench-player" onclick="openPlayerModal('goalkeeper', 'sub1')">
                            <div class="bench-avatar empty">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="bench-info">
                                <div class="bench-position">Goalkeeper</div>
                                <div class="bench-name" id="sub1-name">Select Player</div>
                                <div class="bench-price" id="sub1-price"></div>
                            </div>
                        </div>
                        
                        <!-- Defender Substitute -->
                        <div class="bench-player" onclick="openPlayerModal('defender', 'sub2')">
                            <div class="bench-avatar empty">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="bench-info">
                                <div class="bench-position">Defender</div>
                                <div class="bench-name" id="sub2-name">Select Player</div>
                                <div class="bench-price" id="sub2-price"></div>
                            </div>
                        </div>
                        
                        <!-- Midfielder Substitute -->
                        <div class="bench-player" onclick="openPlayerModal('midfielder', 'sub3')">
                            <div class="bench-avatar empty">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="bench-info">
                                <div class="bench-position">Midfielder</div>
                                <div class="bench-name" id="sub3-name">Select Player</div>
                                <div class="bench-price" id="sub3-price"></div>
                            </div>
                        </div>
                        
                        <!-- Forward Substitute -->
                        <div class="bench-player" onclick="openPlayerModal('forward', 'sub4')">
                            <div class="bench-avatar empty">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="bench-info">
                                <div class="bench-position">Forward</div>
                                <div class="bench-name" id="sub4-name">Select Player</div>
                                <div class="bench-price" id="sub4-price"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('fantasy-team.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Team
                </a>
                <button class="btn btn-primary" id="createTeamBtn" onclick="createTeam()" disabled>
                    <i class="fas fa-check"></i> Create Team
                </button>
            </div>
        </div>
    </div>

    <!-- Player Selection Modal -->
    <div class="modal" id="playerModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Select Player</h3>
                <button class="modal-close" onclick="closePlayerModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="players-grid" id="playersGrid">
                    <!-- Players will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closePlayerModal()">Cancel</button>
                <button class="btn btn-primary" id="selectPlayerBtn" onclick="selectPlayer()">Select Player</button>
            </div>
        </div>
    </div>

    <script>
        // Team data structure
        const teamData = {
            formation: '4-4-2',
            players: {
                // Starting XI
                gk: null,
                defenders: [null, null, null, null],
                midfielders: [null, null, null, null],
                forwards: [null, null],
                // Substitutes
                substitutes: {
                    sub1: null, // GK
                    sub2: null, // DEF
                    sub3: null, // MID
                    sub4: null  // FWD
                }
            },
            totalBudget: 100.0,
            spentBudget: 0.0
        };

        // Sample player data with realistic prices
        const playersData = {
            goalkeeper: [
                { id: 1, name: 'Alisson Becker', team: 'LIV', price: 6.0, position: 'Goalkeeper', points: 128 },
                { id: 3, name: 'David Raya', team: 'ARS', price: 5.0, position: 'Goalkeeper', points: 105 },
                { id: 4, name: 'Nick Pope', team: 'NEW', price: 4.5, position: 'Goalkeeper', points: 98 },
                { id: 5, name: 'Emiliano Martínez', team: 'AVL', price: 5.5, position: 'Goalkeeper', points: 92 },
                { id: 26, name: 'Robert Sánchez', team: 'CHE', price: 5.0, position: 'Goalkeeper', points: 90 },
                { id: 27, name: 'Kepa Arrizabalaga', team: 'ARS', price: 5.0, position: 'Goalkeeper', points: 85 },
                { id: 28, name: 'Jordan Pickford', team: 'EVE', price: 5.0, position: 'Goalkeeper', points: 80 },
                { id: 31, name: 'Illan Meslier', team: 'LEE', price: 4.5, position: 'Goalkeeper', points: 70 },
                { id: 32, name: 'Lukasz Fabianski', team: 'WHA', price: 4.5, position: 'Goalkeeper', points: 65 },
                { id: 2, name: 'Daniel Iversen', team: 'LEI', price: 4.0, position: 'Goalkeeper', points: 55 }
            ],
            defender: [
                { id: 7, name: 'Virgil van Dijk', team: 'LIV', price: 6.5, position: 'Defender', points: 132 },
                { id: 8, name: 'Ruben Dias', team: 'MCI', price: 6.0, position: 'Defender', points: 125 },
                { id: 9, name: 'William Saliba', team: 'ARS', price: 5.5, position: 'Defender', points: 118 },
                { id: 10, name: 'Kieran Trippier', team: 'NEW', price: 5.0, position: 'Defender', points: 112 },
                { id: 11, name: 'Ben White', team: 'ARS', price: 5.0, position: 'Defender', points: 108 },
                { id: 12, name: 'Andy Robertson', team: 'LIV', price: 5.0, position: 'Defender', points: 105 },
                { id: 30, name: 'Gabriel Magalhães', team: 'ARS', price: 5.0, position: 'Defender', points: 100 },
                { id: 34, name: 'Luke Shaw', team: 'MUN', price: 5.0, position: 'Defender', points: 85 },
                { id: 37, name: 'James Tarkowski', team: 'EVE', price: 4.5, position: 'Defender', points: 70 },
                { id: 39, name: 'Tyrone Mings', team: 'AVL', price: 4.5, position: 'Defender', points: 60 }
            ],
            midfielder: [
                { id: 14, name: 'Mohamed Salah', team: 'LIV', price: 12.5, position: 'Midfielder', points: 210 },
                { id: 15, name: 'Bruno Fernandes', team: 'MUN', price: 9.5, position: 'Midfielder', points: 168 },
                { id: 16, name: 'Bukayo Saka', team: 'ARS', price: 8.5, position: 'Midfielder', points: 155 },
                { id: 18, name: 'Martin Ødegaard', team: 'ARS', price: 8.0, position: 'Midfielder', points: 148 },
                { id: 19, name: 'James Maddison', team: 'TOT', price: 7.5, position: 'Midfielder', points: 142 },
                { id: 21, name: 'Jarrod Bowen', team: 'WHU', price: 7.5, position: 'Midfielder', points: 140 },
                { id: 33, name: 'Andreas Pereira', team: 'FUL', price: 5.5, position: 'Midfielder', points: 90 },
                { id: 36, name: 'Jacob Ramsey', team: 'AVL', price: 5.5, position: 'Midfielder', points: 85 },
                { id: 41, name: 'Harvey Barnes', team: 'NEW', price: 6.0, position: 'Midfielder', points: 95 },
                { id: 42, name: 'Emile Smith Rowe', team: 'FUL', price: 6.0, position: 'Midfielder', points: 100 },
                { id: 44, name: 'Eberechi Eze', team: 'ARS', price: 5.5, position: 'Midfielder', points: 70 },
            ],
            forward: [
                { id: 20, name: 'Erling Haaland', team: 'MCI', price: 14.0, position: 'Forward', points: 245 },
                { id: 23, name: 'Ollie Watkins', team: 'AVL', price: 8.0, position: 'Forward', points: 158 },
                { id: 24, name: 'Gabriel Jesus', team: 'ARS', price: 7.5, position: 'Forward', points: 152 },
                { id: 29, name: 'Alexander Isak', team: 'LIV', price: 6.5, position: 'Forward', points: 130 },
                { id: 35, name: 'Callum Wilson', team: 'WHU', price: 6.5, position: 'Forward', points: 115 },
                { id: 40, name: 'Cameron Archer', team: 'AVL', price: 5.0, position: 'Forward', points: 80 },
            ]
        };

        // Modal state
        let currentPosition = '';
        let currentSlot = '';
        let selectedPlayer = null;

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            updateFormation();
            updateBudgetDisplay();
            checkTeamCompletion();
            
            // Formation change handler
            document.getElementById('formationSelect').addEventListener('change', function() {
                teamData.formation = this.value;
                updateFormation();
            });
        });

        // Update formation based on selection
        function updateFormation() {
            const formation = teamData.formation.split('-');
            const defendersCount = parseInt(formation[0]);
            const midfieldersCount = parseInt(formation[1]);
            const forwardsCount = parseInt(formation[2]);
            
            // Update defenders
            teamData.players.defenders = new Array(defendersCount).fill(null);
            renderPositionRow('defendersRow', defendersCount, 'defender', 'Defender');
            
            // Update midfielders
            teamData.players.midfielders = new Array(midfieldersCount).fill(null);
            renderPositionRow('midfieldersRow', midfieldersCount, 'midfielder', 'Midfielder');
            
            // Update forwards
            teamData.players.forwards = new Array(forwardsCount).fill(null);
            renderPositionRow('forwardsRow', forwardsCount, 'forward', 'Forward');
            
            // Re-render existing players
            renderExistingPlayers();
        }

        // Render position row
        function renderPositionRow(rowId, count, position, label) {
            const row = document.getElementById(rowId);
            row.innerHTML = '';
            
            for (let i = 0; i < count; i++) {
                const playerCard = document.createElement('div');
                playerCard.className = 'player-card';
                playerCard.onclick = () => openPlayerModal(position, i);
                playerCard.innerHTML = `
                    <div class="player-avatar empty" id="${position}-avatar-${i}">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="player-position">${label}</div>
                    <div class="player-name" id="${position}-name-${i}"></div>
                `;
                row.appendChild(playerCard);
            }
        }

        // Render existing players
        function renderExistingPlayers() {
            // Render goalkeeper
            renderPlayerSlot('gk', 'gk', 'goalkeeper');
            
            // Render defenders
            teamData.players.defenders.forEach((player, index) => {
                renderPlayerSlot(`defender-${index}`, index, 'defender');
            });
            
            // Render midfielders
            teamData.players.midfielders.forEach((player, index) => {
                renderPlayerSlot(`midfielder-${index}`, index, 'midfielder');
            });
            
            // Render forwards
            teamData.players.forwards.forEach((player, index) => {
                renderPlayerSlot(`forward-${index}`, index, 'forward');
            });
            
            // Render substitutes
            Object.keys(teamData.players.substitutes).forEach(subKey => {
                renderSubstituteSlot(subKey);
            });
        }

        // Open player selection modal
        function openPlayerModal(position, slot) {
            currentPosition = position;
            currentSlot = slot;
            selectedPlayer = null;
            
            // Set correct modal title based on position
            let modalTitle = '';
            if (slot === 'sub1' || slot === 'sub2' || slot === 'sub3' || slot === 'sub4') {
                modalTitle = `Select Substitute ${position.charAt(0).toUpperCase() + position.slice(1)}`;
            } else {
                modalTitle = `Select ${position.charAt(0).toUpperCase() + position.slice(1)}`;
            }
            
            document.getElementById('modalTitle').textContent = modalTitle;
            document.getElementById('playersGrid').innerHTML = '';
            
            // Use correct position key for goalkeepers
            const positionKey = position === 'goalkeeper' ? 'goalkeeper' : position;
            
            // Filter players by position and sort by price
            const availablePlayers = playersData[positionKey]
                .filter(player => !isPlayerInTeam(player.id))
                .sort((a, b) => b.price - a.price);
            
            if (availablePlayers.length === 0) {
                document.getElementById('playersGrid').innerHTML = '<p>No available players for this position.</p>';
            } else {
                availablePlayers.forEach(player => {
                    const playerOption = document.createElement('div');
                    playerOption.className = 'player-option';
                    playerOption.onclick = () => selectPlayerOption(player, playerOption);
                    playerOption.innerHTML = `
                        <div class="option-header">
                            <span class="option-team">${player.team}</span>
                            <span class="option-price">£${player.price}M</span>
                        </div>
                        <div class="option-name">${player.name}</div>
                        <div class="option-position">${player.position}</div>
                        <div class="option-stats">
                            <div class="stat">
                                <div class="stat-value">${player.points}</div>
                                <div class="stat-label">Points</div>
                            </div>
                        </div>
                    `;
                    document.getElementById('playersGrid').appendChild(playerOption);
                });
            }
            
            document.getElementById('playerModal').style.display = 'flex';
        }

        // Select player option in modal
        function selectPlayerOption(player, element) {
            // Remove selected class from all options
            document.querySelectorAll('.player-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            
            // Add selected class to clicked option
            element.classList.add('selected');
            selectedPlayer = player;
        }

        // Close player modal
        function closePlayerModal() {
            document.getElementById('playerModal').style.display = 'none';
        }

        // Select player and add to team
        function selectPlayer() {
            if (!selectedPlayer) {
                alert('Please select a player');
                return;
            }
            
            // Check if player can be afforded
            if (teamData.spentBudget + selectedPlayer.price > teamData.totalBudget) {
                showError(`Cannot afford this player. Need £${(teamData.spentBudget + selectedPlayer.price - teamData.totalBudget).toFixed(1)}M more.`);
                return;
            }
            
            // Add player to team
            if (currentSlot === 'sub1' || currentSlot === 'sub2' || currentSlot === 'sub3' || currentSlot === 'sub4') {
                teamData.players.substitutes[currentSlot] = selectedPlayer;
            } else {
                if (currentPosition === 'goalkeeper') {
                    teamData.players.gk = selectedPlayer;
                } else if (currentPosition === 'defender') {
                    teamData.players.defenders[currentSlot] = selectedPlayer;
                } else if (currentPosition === 'midfielder') {
                    teamData.players.midfielders[currentSlot] = selectedPlayer;
                } else if (currentPosition === 'forward') {
                    teamData.players.forwards[currentSlot] = selectedPlayer;
                }
            }
            
            // Update budget
            teamData.spentBudget += selectedPlayer.price;
            
            // Update UI
            if (currentSlot === 'sub1' || currentSlot === 'sub2' || currentSlot === 'sub3' || currentSlot === 'sub4') {
                renderSubstituteSlot(currentSlot);
            } else if (currentPosition === 'goalkeeper') {
                renderPlayerSlot('gk', 'gk', 'goalkeeper');
            } else {
                renderPlayerSlot(currentSlot, currentSlot, currentPosition);
            }
            
            updateBudgetDisplay();
            checkTeamCompletion();
            closePlayerModal();
            hideError();
        }

        // Render player slot
        function renderPlayerSlot(slot, index, position) {
            let player;
            
            if (slot === 'sub1' || slot === 'sub2' || slot === 'sub3' || slot === 'sub4') {
                player = teamData.players.substitutes[slot];
                const benchPlayer = document.querySelector(`[onclick="openPlayerModal('${position}', '${slot}')"]`);
                
                if (player) {
                    benchPlayer.classList.add('filled');
                    benchPlayer.querySelector('.bench-avatar').className = 'bench-avatar filled';
                    benchPlayer.querySelector('.bench-avatar').innerHTML = player.team;
                    benchPlayer.querySelector('.bench-name').textContent = player.name;
                    benchPlayer.querySelector('.bench-price').textContent = `£${player.price}M`;
                } else {
                    benchPlayer.classList.remove('filled');
                    benchPlayer.querySelector('.bench-avatar').className = 'bench-avatar empty';
                    benchPlayer.querySelector('.bench-avatar').innerHTML = '<i class="fas fa-plus"></i>';
                    benchPlayer.querySelector('.bench-name').textContent = 'Select Player';
                    benchPlayer.querySelector('.bench-price').textContent = '';
                }
            } else {
                // Handle goalkeeper with different ID structure
                if (position === 'goalkeeper') {
                    player = teamData.players.gk;
                    const avatar = document.getElementById('gk-avatar');
                    const name = document.getElementById('gk-name');
                    
                    if (player) {
                        avatar.className = 'player-avatar filled';
                        avatar.innerHTML = player.team + '<div class="player-price">£' + player.price + 'M</div>';
                        name.textContent = player.name;
                    } else {
                        avatar.className = 'player-avatar empty';
                        avatar.innerHTML = '<i class="fas fa-plus"></i>';
                        name.textContent = '';
                    }
                } else {
                    // Handle other positions normally
                    if (position === 'defender') {
                        player = teamData.players.defenders[index];
                    } else if (position === 'midfielder') {
                        player = teamData.players.midfielders[index];
                    } else if (position === 'forward') {
                        player = teamData.players.forwards[index];
                    }
                    
                    const avatar = document.getElementById(`${position}-avatar-${index}`);
                    const name = document.getElementById(`${position}-name-${index}`);
                    
                    if (player) {
                        avatar.className = 'player-avatar filled';
                        avatar.innerHTML = player.team + '<div class="player-price">£' + player.price + 'M</div>';
                        name.textContent = player.name;
                    } else {
                        avatar.className = 'player-avatar empty';
                        avatar.innerHTML = '<i class="fas fa-plus"></i>';
                        name.textContent = '';
                    }
                }
            }
        }

        // Render substitute slot
        function renderSubstituteSlot(slot) {
            const player = teamData.players.substitutes[slot];
            
            // Find the correct bench player element
            const benchPlayers = document.querySelectorAll('.bench-player');
            let benchPlayer = null;
            
            benchPlayers.forEach(bp => {
                if (bp.onclick && bp.onclick.toString().includes(slot)) {
                    benchPlayer = bp;
                }
            });
            
            if (!benchPlayer) return;
            
            if (player) {
                benchPlayer.classList.add('filled');
                const avatar = benchPlayer.querySelector('.bench-avatar');
                const name = benchPlayer.querySelector('.bench-name');
                const price = benchPlayer.querySelector('.bench-price');
                
                avatar.className = 'bench-avatar filled';
                avatar.textContent = player.team;
                name.textContent = player.name;
                price.textContent = `£${player.price}M`;
            } else {
                benchPlayer.classList.remove('filled');
                const avatar = benchPlayer.querySelector('.bench-avatar');
                const name = benchPlayer.querySelector('.bench-name');
                const price = benchPlayer.querySelector('.bench-price');
                
                avatar.className = 'bench-avatar empty';
                avatar.innerHTML = '<i class="fas fa-plus"></i>';
                name.textContent = 'Select Player';
                price.textContent = '';
            }
        }

        // Check if player is already in team
        function isPlayerInTeam(playerId) {
            // Check starting XI
            if (teamData.players.gk && teamData.players.gk.id === playerId) return true;
            
            for (const defender of teamData.players.defenders) {
                if (defender && defender.id === playerId) return true;
            }
            
            for (const midfielder of teamData.players.midfielders) {
                if (midfielder && midfielder.id === playerId) return true;
            }
            
            for (const forward of teamData.players.forwards) {
                if (forward && forward.id === playerId) return true;
            }
            
            // Check substitutes
            for (const sub of Object.values(teamData.players.substitutes)) {
                if (sub && sub.id === playerId) return true;
            }
            
            return false;
        }

        // Update budget display
        function updateBudgetDisplay() {
            document.getElementById('spentBudget').textContent = `£${teamData.spentBudget.toFixed(1)}M`;
            document.getElementById('remainingBudget').textContent = `£${(teamData.totalBudget - teamData.spentBudget).toFixed(1)}M`;
            
            // Update color based on budget status
            const remaining = teamData.totalBudget - teamData.spentBudget;
            const remainingElement = document.getElementById('remainingBudget');
            
            if (remaining < 0) {
                remainingElement.style.color = 'var(--danger)';
            } else if (remaining < 10) {
                remainingElement.style.color = 'var(--warning)';
            } else {
                remainingElement.style.color = 'var(--secondary)';
            }
        }

        // Check if team is complete
        function checkTeamCompletion() {
            const createButton = document.getElementById('createTeamBtn');
            
            // Check if all positions are filled
            const isComplete = teamData.players.gk &&
                teamData.players.defenders.every(def => def) &&
                teamData.players.midfielders.every(mid => mid) &&
                teamData.players.forwards.every(fwd => fwd) &&
                Object.values(teamData.players.substitutes).every(sub => sub) &&
                teamData.spentBudget <= teamData.totalBudget;
            
            createButton.disabled = !isComplete;
        }

        // Show error message
        function showError(message) {
            document.getElementById('errorMessage').textContent = message;
            document.getElementById('validationError').style.display = 'flex';
        }

        // Hide error message
        function hideError() {
            document.getElementById('validationError').style.display = 'none';
        }

        // Create team (actual form submission)
        function createTeam() {
            // Validate team
            if (teamData.spentBudget > teamData.totalBudget) {
                showError('Team exceeds budget limit!');
                return;
            }

            const teamName = document.getElementById('teamName').value.trim();
            if (!teamName) {
                showError('Please enter a team name.');
                return;
            }

            // Prepare team data for submission
            const teamSubmission = {
                team_name: teamName,
                formation: teamData.formation,
                players: {
                    goalkeeper: teamData.players.gk ? teamData.players.gk.id : null,
                    defenders: teamData.players.defenders.map(def => def ? def.id : null),
                    midfielders: teamData.players.midfielders.map(mid => mid ? mid.id : null),
                    forwards: teamData.players.forwards.map(fwd => fwd ? fwd.id : null),
                    substitutes: {
                        sub1: teamData.players.substitutes.sub1 ? teamData.players.substitutes.sub1.id : null,
                        sub2: teamData.players.substitutes.sub2 ? teamData.players.substitutes.sub2.id : null,
                        sub3: teamData.players.substitutes.sub3 ? teamData.players.substitutes.sub3.id : null,
                        sub4: teamData.players.substitutes.sub4 ? teamData.players.substitutes.sub4.id : null
                    }
                },
                total_budget: teamData.totalBudget,
                spent_budget: teamData.spentBudget
            };

            // Show loading state
            const createButton = document.getElementById('createTeamBtn');
            createButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Team...';
            createButton.disabled = true;

            // Submit team data to server
            fetch('/fantasy-team', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(teamSubmission)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.team_id) {
            window.location.href = `/fantasy-team/${data.team_id}`;
        } else {
            showError('Failed to create team. Please try again.');
        }
    })
    .catch(() => {
        showError('Failed to create team. Please try again.');
    });
}
    </script>
</body>
</html>