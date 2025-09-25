<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfers - Footsy Fantasy Football</title>
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
        
        /* Transfers Content */
        .transfers-content {
            padding: 2rem;
        }
        
        .transfers-header {
            margin-bottom: 2rem;
        }
        
        .transfers-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        
        .transfers-subtitle {
            color: var(--gray);
        }
        
        /* Transfer Info Cards */
        .transfer-info-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .info-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .info-card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        
        .info-card-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .info-card-icon.budget {
            background: linear-gradient(135deg, #34c759, #2aa34d);
            color: white;
        }
        
        .info-card-icon.transfers {
            background: linear-gradient(135deg, #3a5ee5, #2a48c5);
            color: white;
        }
        
        .info-card-icon.deadline {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }
        
        .info-card-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .info-card-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .info-card-label {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        /* Transfer Layout */
        .transfer-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        /* Current Team */
        .current-team {
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .section-badge {
            background: var(--light-gray);
            color: var(--gray);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        /* Player List */
        .player-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .player-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border: 2px solid var(--light-gray);
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .player-item:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .player-item.selected {
            border-color: var(--primary);
            background: rgba(58, 94, 229, 0.05);
        }
        
        .player-item.to-sell {
            border-color: var(--danger);
            background: rgba(229, 62, 62, 0.05);
        }
        
        .player-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
            margin-right: 1rem;
            background: var(--gradient);
            color: white;
        }
        
        .player-details {
            flex: 1;
        }
        
        .player-name {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .player-meta {
            display: flex;
            gap: 1rem;
            font-size: 0.8rem;
            color: var(--gray);
        }
        
        .player-price {
            font-weight: 600;
            color: var(--warning);
        }
        
        .player-points {
            color: var(--primary);
        }
        
        .player-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-small {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.8rem;
        }
        
        .btn-sell {
            background: var(--danger);
            color: white;
        }
        
        .btn-sell:hover {
            background: #c53030;
        }
        
        .btn-cancel {
            background: var(--light-gray);
            color: var(--gray);
        }
        
        .btn-cancel:hover {
            background: #d1d5db;
        }
        
        /* Transfer Market */
        .transfer-market {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .market-filters {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }
        
        .filter-select {
            padding: 0.5rem 1rem;
            border: 1px solid var(--light-gray);
            border-radius: 6px;
            background: white;
            font-size: 0.9rem;
        }
        
        .search-box {
            flex: 1;
            min-width: 200px;
            padding: 0.5rem 1rem;
            border: 1px solid var(--light-gray);
            border-radius: 6px;
            font-size: 0.9rem;
        }
        
        .market-players {
            display: grid;
            gap: 1rem;
            max-height: 600px;
            overflow-y: auto;
        }
        
        .market-player {
            display: flex;
            align-items: center;
            padding: 1rem;
            border: 2px solid var(--light-gray);
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .market-player:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
        }
        
        .market-player.selected {
            border-color: var(--secondary);
            background: rgba(52, 199, 89, 0.05);
        }
        
        .transfer-actions {
            display: flex;
            gap: 0.5rem;
            margin-left: auto;
        }
        
        .btn-buy {
            background: var(--secondary);
            color: white;
        }
        
        .btn-buy:hover {
            background: #2aa34d;
        }
        
        .btn-buy:disabled {
            background: var(--light-gray);
            color: var(--gray);
            cursor: not-allowed;
        }
        
        /* Transfer Summary */
        .transfer-summary {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
        
        .summary-grid {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 2rem;
            align-items: center;
        }
        
        .transfer-arrow {
            font-size: 2rem;
            color: var(--primary);
            text-align: center;
        }
        
        .summary-player {
            text-align: center;
            padding: 1rem;
            border-radius: 8px;
            background: var(--light);
        }
        
        .summary-player.sell {
            border: 2px solid var(--danger);
        }
        
        .summary-player.buy {
            border: 2px solid var(--secondary);
        }
        
        .summary-price {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            margin-top: 0.5rem;
        }
        
        .price-sell {
            color: var(--danger);
        }
        
        .price-buy {
            color: var(--secondary);
        }
        
        .transfer-details {
            grid-column: 1 / -1;
            text-align: center;
            padding-top: 1rem;
            border-top: 1px solid var(--light-gray);
        }
        
        .net-cost {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0.5rem 0;
        }
        
        .net-positive {
            color: var(--secondary);
        }
        
        .net-negative {
            color: var(--danger);
        }
        
        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
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
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--gray);
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
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
            .transfer-layout {
                grid-template-columns: 1fr;
            }
            
            .summary-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }
            
            .transfer-arrow {
                transform: rotate(90deg);
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
            
            .transfer-info-cards {
                grid-template-columns: 1fr;
            }
            
            .market-filters {
                flex-direction: column;
            }
            
            .search-box {
                min-width: auto;
            }
        }
        
        @media (max-width: 576px) {
            .transfers-content {
                padding: 1rem;
            }
            
            .player-item, .market-player {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }
            
            .player-actions, .transfer-actions {
                justify-content: center;
            }
            
            .player-details {
                text-align: center;
            }
            
            .form-actions {
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
                <a href="{{ route('transfers.index') }}" class="nav-link active">
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

        <!-- Transfers Content -->
        <div class="transfers-content">
            <div class="transfers-header">
                <h1 class="transfers-title">Transfer Market</h1>
                <p class="transfers-subtitle">Buy and sell players to optimize your fantasy team</p>
            </div>

            <!-- Transfer Info Cards -->
            <div class="transfer-info-cards">
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon budget">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div>
                            <div class="info-card-title">Available Budget</div>
                            <div class="info-card-value" id="availableBudget">£45.2M</div>
                            <div class="info-card-label">After pending transfers</div>
                        </div>
                    </div>
                </div>
                
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon transfers">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <div>
                            <div class="info-card-title">Free Transfers</div>
                            <div class="info-card-value" id="freeTransfers">1</div>
                            <div class="info-card-label">Resets in 3 days</div>
                        </div>
                    </div>
                </div>
                
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon deadline">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <div class="info-card-title">Next Deadline</div>
                            <div class="info-card-value" id="nextDeadline">Sat 11:30</div>
                            <div class="info-card-label">Gameweek 15</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transfer Layout -->
            <div class="transfer-layout">
                <!-- Current Team -->
                <div class="current-team">
                    <h3 class="section-title">
                        Your Team
                        <span class="section-badge" id="teamCount">15 players</span>
                    </h3>
                    
                    <div class="player-list" id="currentTeamList">
                        <!-- Players will be loaded here -->
                    </div>
                </div>

                <!-- Transfer Market -->
                <div class="transfer-market">
                    <h3 class="section-title">
                        Transfer Market
                        <span class="section-badge" id="marketCount">248 players</span>
                    </h3>
                    
                    <div class="market-filters">
                        <select class="filter-select" id="positionFilter">
                            <option value="">All Positions</option>
                            <option value="goalkeeper">Goalkeepers</option>
                            <option value="defender">Defenders</option>
                            <option value="midfielder">Midfielders</option>
                            <option value="forward">Forwards</option>
                        </select>
                        
                        <select class="filter-select" id="teamFilter">
                            <option value="">All Teams</option>
                            <option value="ARS">Arsenal</option>
                            <option value="MCI">Man City</option>
                            <option value="LIV">Liverpool</option>
                            <option value="MUN">Man United</option>
                            <option value="CHE">Chelsea</option>
                            <option value="TOT">Tottenham</option>
                            <!-- More teams... -->
                        </select>
                        
                        <select class="filter-select" id="priceFilter">
                            <option value="">Any Price</option>
                            <option value="0-5">Under £5M</option>
                            <option value="5-8">£5M - £8M</option>
                            <option value="8-10">£8M - £10M</option>
                            <option value="10-15">£10M+</option>
                        </select>
                        
                        <input type="text" class="search-box" id="playerSearch" placeholder="Search players...">
                    </div>
                    
                    <div class="market-players" id="marketPlayers">
                        <!-- Market players will be loaded here -->
                    </div>
                </div>
            </div>

            <!-- Transfer Summary -->
            <div class="transfer-summary" id="transferSummary" style="display: none;">
                <h3 class="section-title">Transfer Summary</h3>
                
                <div class="summary-grid">
                    <div class="summary-player sell">
                        <div class="player-avatar" id="sellPlayerAvatar">-</div>
                        <div class="player-name" id="sellPlayerName">No player selected</div>
                        <div class="summary-price price-sell" id="sellPlayerPrice">-</div>
                    </div>
                    
                    <div class="transfer-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                    
                    <div class="summary-player buy">
                        <div class="player-avatar" id="buyPlayerAvatar">-</div>
                        <div class="player-name" id="buyPlayerName">No player selected</div>
                        <div class="summary-price price-buy" id="buyPlayerPrice">-</div>
                    </div>
                    
                    <div class="transfer-details">
                        <div>Net Cost</div>
                        <div class="net-cost" id="netCost">£0.0M</div>
                        <div class="info-card-label">After this transfer</div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('fantasy-team.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Team
                </a>
                <button class="btn btn-primary" id="confirmTransferBtn" onclick="confirmTransfer()" disabled>
                    <i class="fas fa-check"></i> Confirm Transfer
                </button>
            </div>
        </div>
    </div>

    <script>
        // Transfer data
        const transferData = {
            availableBudget: 45.2,
            freeTransfers: 1,
            teamPlayers: [],
            marketPlayers: [],
            selectedSellPlayer: null,
            selectedBuyPlayer: null
        };

        // Sample team players data
        const teamPlayersData = [
            { id: 1, name: 'Alisson Becker', team: 'LIV', price: 6.0, position: 'Goalkeeper', points: 128, positionType: 'goalkeeper' },
            { id: 7, name: 'Virgil van Dijk', team: 'LIV', price: 6.5, position: 'Defender', points: 132, positionType: 'defender' },
            { id: 8, name: 'Ruben Dias', team: 'MCI', price: 6.0, position: 'Defender', points: 125, positionType: 'defender' },
            { id: 14, name: 'Mohamed Salah', team: 'LIV', price: 12.5, position: 'Midfielder', points: 210, positionType: 'midfielder' },
            { id: 20, name: 'Erling Haaland', team: 'MCI', price: 14.0, position: 'Forward', points: 245, positionType: 'forward' },
            { id: 23, name: 'Ollie Watkins', team: 'AVL', price: 8.0, position: 'Forward', points: 158, positionType: 'forward' }
        ];

        // Sample market players data
        const marketPlayersData = [
            { id: 3, name: 'David Raya', team: 'ARS', price: 5.0, position: 'Goalkeeper', points: 105, positionType: 'goalkeeper' },
            { id: 9, name: 'William Saliba', team: 'ARS', price: 5.5, position: 'Defender', points: 118, positionType: 'defender' },
            { id: 15, name: 'Bruno Fernandes', team: 'MUN', price: 9.5, position: 'Midfielder', points: 168, positionType: 'midfielder' },
            { id: 16, name: 'Bukayo Saka', team: 'ARS', price: 8.5, position: 'Midfielder', points: 155, positionType: 'midfielder' },
            { id: 24, name: 'Gabriel Jesus', team: 'ARS', price: 7.5, position: 'Forward', points: 152, positionType: 'forward' },
            { id: 29, name: 'Alexander Isak', team: 'LIV', price: 6.5, position: 'Forward', points: 130, positionType: 'forward' }
        ];

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            loadTeamPlayers();
            loadMarketPlayers();
            setupEventListeners();
        });

        // Load team players
        function loadTeamPlayers() {
            transferData.teamPlayers = teamPlayersData;
            renderTeamPlayers();
            updateTeamCount();
        }

        // Load market players
        function loadMarketPlayers() {
            transferData.marketPlayers = marketPlayersData;
            renderMarketPlayers();
            updateMarketCount();
        }

        // Setup event listeners
        function setupEventListeners() {
            // Filter event listeners
            document.getElementById('positionFilter').addEventListener('change', filterMarketPlayers);
            document.getElementById('teamFilter').addEventListener('change', filterMarketPlayers);
            document.getElementById('priceFilter').addEventListener('change', filterMarketPlayers);
            document.getElementById('playerSearch').addEventListener('input', filterMarketPlayers);
        }

        // Render team players
        function renderTeamPlayers() {
            const container = document.getElementById('currentTeamList');
            container.innerHTML = '';

            if (transferData.teamPlayers.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-users"></i>
                        <div>No players in your team</div>
                    </div>
                `;
                return;
            }

            transferData.teamPlayers.forEach(player => {
                const playerItem = document.createElement('div');
                playerItem.className = `player-item ${transferData.selectedSellPlayer?.id === player.id ? 'to-sell' : ''}`;
                playerItem.innerHTML = `
                    <div class="player-avatar">${player.team}</div>
                    <div class="player-details">
                        <div class="player-name">${player.name}</div>
                        <div class="player-meta">
                            <span class="player-position">${player.position}</span>
                            <span class="player-price">£${player.price}M</span>
                            <span class="player-points">${player.points} pts</span>
                        </div>
                    </div>
                    <div class="player-actions">
                        ${transferData.selectedSellPlayer?.id === player.id ? 
                            `<button class="btn-small btn-cancel" onclick="cancelSellPlayer()">Cancel</button>` :
                            `<button class="btn-small btn-sell" onclick="selectSellPlayer(${player.id})">Sell</button>`
                        }
                    </div>
                `;
                container.appendChild(playerItem);
            });
        }

        // Render market players
        function renderMarketPlayers(filteredPlayers = null) {
            const container = document.getElementById('marketPlayers');
            const playersToRender = filteredPlayers || transferData.marketPlayers;
            
            container.innerHTML = '';

            if (playersToRender.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-search"></i>
                        <div>No players found matching your criteria</div>
                    </div>
                `;
                return;
            }

            playersToRender.forEach(player => {
                const canAfford = canAffordPlayer(player);
                const marketPlayer = document.createElement('div');
                marketPlayer.className = `market-player ${transferData.selectedBuyPlayer?.id === player.id ? 'selected' : ''}`;
                marketPlayer.innerHTML = `
                    <div class="player-avatar">${player.team}</div>
                    <div class="player-details">
                        <div class="player-name">${player.name}</div>
                        <div class="player-meta">
                            <span class="player-position">${player.position}</span>
                            <span class="player-price">£${player.price}M</span>
                            <span class="player-points">${player.points} pts</span>
                        </div>
                    </div>
                    <div class="transfer-actions">
                        <button class="btn-small btn-buy" 
                                onclick="selectBuyPlayer(${player.id})"
                                ${!canAfford ? 'disabled' : ''}>
                            ${transferData.selectedBuyPlayer?.id === player.id ? 'Selected' : 'Buy'}
                        </button>
                    </div>
                `;
                container.appendChild(marketPlayer);
            });
        }

        // Filter market players
        function filterMarketPlayers() {
            const positionFilter = document.getElementById('positionFilter').value;
            const teamFilter = document.getElementById('teamFilter').value;
            const priceFilter = document.getElementById('priceFilter').value;
            const searchTerm = document.getElementById('playerSearch').value.toLowerCase();

            const filteredPlayers = transferData.marketPlayers.filter(player => {
                // Position filter
                if (positionFilter && player.positionType !== positionFilter) return false;
                
                // Team filter
                if (teamFilter && player.team !== teamFilter) return false;
                
                // Price filter
                if (priceFilter) {
                    const [min, max] = priceFilter.split('-').map(Number);
                    if (max && (player.price < min || player.price > max)) return false;
                    if (!max && player.price < min) return false;
                }
                
                // Search filter
                if (searchTerm && !player.name.toLowerCase().includes(searchTerm)) return false;
                
                return true;
            });

            renderMarketPlayers(filteredPlayers);
            updateMarketCount(filteredPlayers.length);
        }

        // Select player to sell
        function selectSellPlayer(playerId) {
            const player = transferData.teamPlayers.find(p => p.id === playerId);
            if (!player) return;

            transferData.selectedSellPlayer = player;
            renderTeamPlayers();
            updateTransferSummary();
        }

        // Cancel sell selection
        function cancelSellPlayer() {
            transferData.selectedSellPlayer = null;
            transferData.selectedBuyPlayer = null;
            renderTeamPlayers();
            renderMarketPlayers();
            hideTransferSummary();
        }

        // Select player to buy
        function selectBuyPlayer(playerId) {
            const player = transferData.marketPlayers.find(p => p.id === playerId);
            if (!player) return;

            transferData.selectedBuyPlayer = player;
            renderMarketPlayers();
            updateTransferSummary();
        }

        // Check if player can be afforded
        function canAffordPlayer(player) {
            if (!transferData.selectedSellPlayer) {
                return player.price <= transferData.availableBudget;
            }
            
            const netCost = player.price - transferData.selectedSellPlayer.price;
            return netCost <= transferData.availableBudget;
        }

        // Update transfer summary
        function updateTransferSummary() {
            const summary = document.getElementById('transferSummary');
            const confirmBtn = document.getElementById('confirmTransferBtn');

            if (!transferData.selectedSellPlayer && !transferData.selectedBuyPlayer) {
                summary.style.display = 'none';
                confirmBtn.disabled = true;
                return;
            }

            summary.style.display = 'block';

            if (transferData.selectedSellPlayer) {
                document.getElementById('sellPlayerAvatar').textContent = transferData.selectedSellPlayer.team;
                document.getElementById('sellPlayerName').textContent = transferData.selectedSellPlayer.name;
                document.getElementById('sellPlayerPrice').textContent = `£${transferData.selectedSellPlayer.price}M`;
            }

            if (transferData.selectedBuyPlayer) {
                document.getElementById('buyPlayerAvatar').textContent = transferData.selectedBuyPlayer.team;
                document.getElementById('buyPlayerName').textContent = transferData.selectedBuyPlayer.name;
                document.getElementById('buyPlayerPrice').textContent = `£${transferData.selectedBuyPlayer.price}M`;
            }

            // Calculate net cost
            const sellPrice = transferData.selectedSellPlayer ? transferData.selectedSellPlayer.price : 0;
            const buyPrice = transferData.selectedBuyPlayer ? transferData.selectedBuyPlayer.price : 0;
            const netCost = buyPrice - sellPrice;

            const netCostElement = document.getElementById('netCost');
            netCostElement.textContent = `£${Math.abs(netCost).toFixed(1)}M`;
            netCostElement.className = `net-cost ${netCost >= 0 ? 'net-negative' : 'net-positive'}`;

            // Enable/disable confirm button
            confirmBtn.disabled = !transferData.selectedBuyPlayer || netCost > transferData.availableBudget;
        }

        // Hide transfer summary
        function hideTransferSummary() {
            document.getElementById('transferSummary').style.display = 'none';
            document.getElementById('confirmTransferBtn').disabled = true;
        }

        // Update team count
        function updateTeamCount() {
            document.getElementById('teamCount').textContent = `${transferData.teamPlayers.length} players`;
        }

        // Update market count
        function updateMarketCount(count = null) {
            const actualCount = count !== null ? count : transferData.marketPlayers.length;
            document.getElementById('marketCount').textContent = `${actualCount} players`;
        }

        // Confirm transfer
        function confirmTransfer() {
            if (!transferData.selectedBuyPlayer) {
                alert('Please select a player to buy');
                return;
            }

            if (transferData.freeTransfers <= 0) {
                if (!confirm('You have no free transfers left. This will cost you 4 points. Continue?')) {
                    return;
                }
            }

            // Show loading state
            const confirmBtn = document.getElementById('confirmTransferBtn');
            confirmBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
            confirmBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // In a real app, this would be an API call to your backend
                console.log('Transfer confirmed:', {
                    sellPlayer: transferData.selectedSellPlayer,
                    buyPlayer: transferData.selectedBuyPlayer
                });

                // Show success message
                alert('Transfer completed successfully!');

                // Redirect to team page
                window.location.href = "{{ route('fantasy-team.index') }}";
            }, 2000);
        }
    </script>
</body>
</html>