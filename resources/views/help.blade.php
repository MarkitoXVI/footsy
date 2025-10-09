<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help & Rules - Footsy Fantasy Football</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        
        /* Help Content */
        .help-content {
            padding: 2rem;
        }
        
        .help-header {
            margin-bottom: 2rem;
        }
        
        .help-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        
        .help-subtitle {
            color: var(--gray);
        }
        
        /* Help Navigation */
        .help-nav {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .help-tab {
            padding: 0.75rem 1.5rem;
            background: white;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .help-tab.active {
            background: var(--gradient);
            color: white;
            border-color: var(--primary);
        }
        
        .help-tab:hover:not(.active) {
            border-color: var(--primary);
        }
        
        /* Rules Grid */
        .rules-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .rule-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary);
        }
        
        .rule-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        
        .rule-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .rule-card-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .rule-card-icon {
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
        
        .rule-card-content {
            color: var(--gray);
            line-height: 1.6;
        }
        
        /* Scoring System */
        .scoring-system {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
        
        .scoring-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .scoring-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        .scoring-tabs {
            display: flex;
            gap: 0.5rem;
        }
        
        .scoring-tab {
            padding: 0.5rem 1rem;
            border: 1px solid var(--light-gray);
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
        }
        
        .scoring-tab.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        .scoring-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .scoring-table th, .scoring-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .scoring-table th {
            font-weight: 600;
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .scoring-table td {
            font-size: 0.9rem;
        }
        
        .points-positive {
            color: var(--secondary);
            font-weight: 600;
        }
        
        .points-negative {
            color: var(--danger);
            font-weight: 600;
        }
        
        /* FAQ Section */
        .faq-section {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
        
        .faq-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .faq-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        .faq-search {
            display: flex;
            align-items: center;
            background: var(--light);
            border-radius: 50px;
            padding: 0.5rem 1rem;
            width: 300px;
        }
        
        .faq-search i {
            color: var(--gray);
            margin-right: 0.5rem;
        }
        
        .faq-search input {
            border: none;
            background: transparent;
            width: 100%;
            outline: none;
        }
        
        .faq-list {
            list-style: none;
        }
        
        .faq-item {
            border-bottom: 1px solid var(--light-gray);
        }
        
        .faq-item:last-child {
            border-bottom: none;
        }
        
        .faq-question {
            width: 100%;
            background: none;
            border: none;
            padding: 1.25rem 0;
            text-align: left;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s;
        }
        
        .faq-question:hover {
            color: var(--primary);
        }
        
        .faq-question i {
            transition: transform 0.3s;
        }
        
        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }
        
        .faq-answer {
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .faq-item.active .faq-answer {
            padding: 0 0 1.25rem;
            max-height: 500px;
        }
        
        .faq-answer p {
            color: var(--gray);
            line-height: 1.6;
        }
        
        /* Bonus Points Section */
        .bonus-section {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
        
        .bonus-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .bonus-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        .bonus-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .bonus-card {
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s;
        }
        
        .bonus-card:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
        }
        
        .bonus-rank {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            margin: 0 auto 1rem;
            color: white;
        }
        
        .rank-1 { background: linear-gradient(135deg, #FFD700, #FFA500); }
        .rank-2 { background: linear-gradient(135deg, #C0C0C0, #A0A0A0); }
        .rank-3 { background: linear-gradient(135deg, #CD7F32, #A66C2A); }
        
        .bonus-points {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }
        
        .bonus-description {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        /* Pro Tip */
        .pro-tip {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 2rem;
            color: white;
            margin-bottom: 2rem;
        }
        
        .pro-tip-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        
        .pro-tip-icon {
            font-size: 2rem;
        }
        
        .pro-tip-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.3rem;
            font-weight: 600;
        }
        
        .pro-tip-content {
            opacity: 0.9;
            line-height: 1.6;
        }
        
        /* Responsive Design */
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
            
            .help-nav {
                flex-direction: column;
            }
            
            .help-tab {
                text-align: center;
            }
            
            .rules-grid {
                grid-template-columns: 1fr;
            }
            
            .faq-search {
                width: 100%;
                margin-top: 1rem;
            }
            
            .bonus-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 576px) {
            .help-content {
                padding: 1rem;
            }
            
            .header {
                padding: 0 1rem;
            }
            
            .scoring-tabs {
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
                <a href="{{ route('help') }}" class="nav-link active">
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

        <!-- Help Content -->
        <div class="help-content">
            <div class="help-header">
                <h1 class="help-title">Help & Rules Center</h1>
                <p class="help-subtitle">Everything you need to know to master Footsy Fantasy Football</p>
            </div>

            <!-- Help Navigation -->
            <div class="help-nav">
                <div class="help-tab active" onclick="showHelpTab('rules')">Game Rules</div>
                <div class="help-tab" onclick="showHelpTab('scoring')">Scoring System</div>
                <div class="help-tab" onclick="showHelpTab('bonus')">Bonus Points</div>
                <div class="help-tab" onclick="showHelpTab('faq')">FAQ</div>
            </div>

            <!-- Rules Tab -->
            <div id="rules-tab" class="tab-content">
                <!-- Rules Grid -->
                <div class="rules-grid">
                    <div class="rule-card">
                        <div class="rule-card-header">
                            <h3 class="rule-card-title">Team Creation</h3>
                            <div class="rule-card-icon icon-primary">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="rule-card-content">
                            <p>Build your squad with a <strong>$100m budget</strong>. Select 15 players: 2 GKs, 5 DEFs, 5 MIDs, 3 FWDs. Maximum 3 players from any real team.</p>
                        </div>
                    </div>
                    
                    <div class="rule-card">
                        <div class="rule-card-header">
                            <h3 class="rule-card-title">Transfers</h3>
                            <div class="rule-card-icon icon-secondary">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                        </div>
                        <div class="rule-card-content">
                            <p><strong>1 free transfer</strong> per gameweek. Additional transfers cost -4 points each. Transfers lock at gameweek deadline.</p>
                        </div>
                    </div>
                    
                    <div class="rule-card">
                        <div class="rule-card-header">
                            <h3 class="rule-card-title">Captain & Vice-Captain</h3>
                            <div class="rule-card-icon icon-warning">
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="rule-card-content">
                            <p><strong>Captain earns double points</strong>. Vice-captain replaces captain if they don't play. Choose wisely for maximum points!</p>
                        </div>
                    </div>
                    
                    <div class="rule-card">
                        <div class="rule-card-header">
                            <h3 class="rule-card-title">Leagues</h3>
                            <div class="rule-card-icon icon-danger">
                                <i class="fas fa-trophy"></i>
                            </div>
                        </div>
                        <div class="rule-card-content">
                            <p>Join global leagues or create private leagues with friends. Compete weekly and climb the rankings to become the ultimate fantasy manager.</p>
                        </div>
                    </div>
                </div>

                <!-- Pro Tip -->
                <div class="pro-tip">
                    <div class="pro-tip-header">
                        <div class="pro-tip-icon">💡</div>
                        <h3 class="pro-tip-title">Pro Tip</h3>
                    </div>
                    <div class="pro-tip-content">
                        Always check upcoming fixtures before selecting your captain. Players facing weaker opposition often have higher scoring potential. Also, monitor player form and injury news to make informed transfer decisions.
                    </div>
                </div>
            </div>

            <!-- Scoring System Tab -->
            <div id="scoring-tab" class="tab-content" style="display: none;">
                <div class="scoring-system">
                    <div class="scoring-header">
                        <h3 class="scoring-title">Scoring System</h3>
                        <div class="scoring-tabs">
                            <span class="scoring-tab active" onclick="showScoringTab('attacking')">Attacking</span>
                            <span class="scoring-tab" onclick="showScoringTab('defensive')">Defensive</span>
                            <span class="scoring-tab" onclick="showScoringTab('disciplinary')">Disciplinary</span>
                        </div>
                    </div>
                    
                    <!-- Attacking Scoring -->
                    <div id="attacking-scoring" class="scoring-tab-content">
                        <table class="scoring-table">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Goal (Forward)</td>
                                    <td class="points-positive">+4</td>
                                </tr>
                                <tr>
                                    <td>Goal (Midfielder)</td>
                                    <td class="points-positive">+5</td>
                                </tr>
                                <tr>
                                    <td>Goal (Defender / GK)</td>
                                    <td class="points-positive">+6</td>
                                </tr>
                                <tr>
                                    <td>Assist</td>
                                    <td class="points-positive">+3</td>
                                </tr>
                                <tr>
                                    <td>Shot on Target</td>
                                    <td class="points-positive">+1</td>
                                </tr>
                                <tr>
                                    <td>Key Pass</td>
                                    <td class="points-positive">+1</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Defensive Scoring -->
                    <div id="defensive-scoring" class="scoring-tab-content" style="display: none;">
                        <table class="scoring-table">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Clean Sheet (DEF / GK)</td>
                                    <td class="points-positive">+4</td>
                                </tr>
                                <tr>
                                    <td>Clean Sheet (MID)</td>
                                    <td class="points-positive">+1</td>
                                </tr>
                                <tr>
                                    <td>Save (GK)</td>
                                    <td class="points-positive">+1</td>
                                </tr>
                                <tr>
                                    <td>Penalty Save</td>
                                    <td class="points-positive">+5</td>
                                </tr>
                                <tr>
                                    <td>Tackle Won</td>
                                    <td class="points-positive">+1</td>
                                </tr>
                                <tr>
                                    <td>Interception</td>
                                    <td class="points-positive">+1</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Disciplinary Scoring -->
                    <div id="disciplinary-scoring" class="scoring-tab-content" style="display: none;">
                        <table class="scoring-table">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Yellow Card</td>
                                    <td class="points-negative">-1</td>
                                </tr>
                                <tr>
                                    <td>Red Card</td>
                                    <td class="points-negative">-3</td>
                                </tr>
                                <tr>
                                    <td>Own Goal</td>
                                    <td class="points-negative">-2</td>
                                </tr>
                                <tr>
                                    <td>Penalty Miss</td>
                                    <td class="points-negative">-2</td>
                                </tr>
                                <tr>
                                    <td>Error Leading to Goal</td>
                                    <td class="points-negative">-2</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Bonus Points Tab -->
            <div id="bonus-tab" class="tab-content" style="display: none;">
                <div class="bonus-section">
                    <div class="bonus-header">
                        <h3 class="bonus-title">Bonus Points System (BPS)</h3>
                    </div>
                    <p style="margin-bottom: 1.5rem; color: var(--gray);">The Bonus Points System awards additional points to the top three performing players in each match, regardless of their team or position.</p>
                    
                    <div class="bonus-grid">
                        <div class="bonus-card">
                            <div class="bonus-rank rank-1">1st</div>
                            <div class="bonus-points">+3 pts</div>
                            <div class="bonus-description">Top performer in the match</div>
                        </div>
                        
                        <div class="bonus-card">
                            <div class="bonus-rank rank-2">2nd</div>
                            <div class="bonus-points">+2 pts</div>
                            <div class="bonus-description">Second best performer</div>
                        </div>
                        
                        <div class="bonus-card">
                            <div class="bonus-rank rank-3">3rd</div>
                            <div class="bonus-points">+1 pt</div>
                            <div class="bonus-description">Third best performer</div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 2rem; padding: 1.5rem; background: var(--light); border-radius: 8px;">
                        <h4 style="margin-bottom: 1rem; font-family: 'Montserrat', sans-serif;">How BPS Works</h4>
                        <p style="color: var(--gray); line-height: 1.6;">
                            Players earn BPS points for various actions during a match (goals, assists, tackles, passes, etc.). 
                            The top three players with the highest BPS receive bonus points. BPS is calculated automatically 
                            based on official match statistics.
                        </p>
                    </div>
                </div>
            </div>

            <!-- FAQ Tab -->
            <div id="faq-tab" class="tab-content" style="display: none;">
                <div class="faq-section">
                    <div class="faq-header">
                        <h3 class="faq-title">Frequently Asked Questions</h3>
                        <div class="faq-search">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search FAQs...">
                        </div>
                    </div>
                    
                    <ul class="faq-list">
                        <!-- Team Management FAQs -->
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>When do points get updated?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Points are usually updated shortly after each real-life match concludes. Major updates happen within a few hours of the final whistle, with live points updating during matches for goals, assists, and other key actions.</p>
                            </div>
                        </li>
                        
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>Can I change my captain after deadline?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>No, once the gameweek deadline passes, your team including captain selection is locked until the next gameweek. Make sure to set your captain and vice-captain before the deadline to avoid missing out on double points.</p>
                            </div>
                        </li>
                        
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>What happens if I don't use my free transfer?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>You can carry over one free transfer to the next gameweek, allowing you to make two free transfers. However, you cannot carry over more than one free transfer - any additional unused transfers beyond one are lost.</p>
                            </div>
                        </li>
                        
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>What if my player doesn't play in a gameweek?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>If your player doesn't feature at all in a gameweek, they'll score 0 points. If they're on your bench, your first substitute will automatically replace them if they don't play. If they're in your starting XI and don't play, no automatic substitution occurs for that position.</p>
                            </div>
                        </li>
                        
                        <!-- Scoring & Points FAQs -->
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>How are bonus points calculated?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Bonus points are awarded to the top-performing players in each match based on the Bonus Points System (BPS). Players earn BPS points for actions like completed passes, tackles, clearances, and key contributions. The top three players receive 3, 2, and 1 bonus points respectively.</p>
                            </div>
                        </li>
                        
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>Do substitutes earn points?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Substitutes only earn points if they automatically replace a player in your starting XI who didn't play. Your substitutes are used in order (first substitute replaces first non-playing starter, etc.). If a substitute comes on in real life but remains on your fantasy bench, they won't score points for your team.</p>
                            </div>
                        </li>
                        
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>What counts as an assist?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>An assist is awarded to the player who makes the final pass, cross, header, or shot that leads to a goal. This includes deflections that don't significantly change the direction of the ball. Own goals, penalties won, and rebounds don't count as assists unless it's the final pass before the goal.</p>
                            </div>
                        </li>
                        
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>How are clean sheet points awarded?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Clean sheet points (4 points) are awarded to goalkeepers and defenders who play 60 minutes or more and don't concede a goal. Midfielders don't receive clean sheet points. If a player is substituted before 60 minutes and their team keeps a clean sheet, they won't receive the points.</p>
                            </div>
                        </li>
                        
                        <!-- Transfers FAQs -->
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>When is the transfer deadline?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>The transfer deadline is typically 1 hour before the first match of each gameweek. This gives you time to make changes based on team news and lineups. Always check the exact deadline time as it may vary for different gameweeks, especially during busy festive periods.</p>
                            </div>
                        </li>
                        
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>Can I reverse a transfer?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Yes, you can reverse transfers made in the same gameweek as long as you haven't confirmed your team after the changes. Once you confirm your team or the deadline passes, transfers cannot be reversed. Use the "Undo" button before confirming to revert changes.</p>
                            </div>
                        </li>
                        
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>How do price changes work?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Player prices change based on transfer activity. If many managers bring in a player, their price rises; if many sell, it falls. Price changes typically occur overnight. You make a profit of 0.1M for every 0.1M price rise when selling players (e.g., buy at 8.0M, sell at 8.3M = 0.3M profit).</p>
                            </div>
                        </li>
                        
                        <!-- Leagues FAQs -->
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>How do I join a private league?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>To join a private league, you need the league code from the league administrator. Go to the "Leagues" section, click "Join League," and enter the code. You can join up to 20 private leagues. Your points will be automatically tracked from when you join.</p>
                            </div>
                        </li>
                        
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>Can I create my own league?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Yes! You can create unlimited private leagues. Go to the "Leagues" section and click "Create League." Choose a name, set whether it's public or private, and share the code with friends. You can also set up head-to-head leagues where you compete against a different manager each week.</p>
                            </div>
                        </li>
                        
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>What's the difference between classic and head-to-head leagues?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>In classic leagues, managers are ranked by total points. In head-to-head leagues, you face a different opponent each week - the manager with more points that week gets 3 points (like a win), draws get 1 point each. Head-to-head adds a competitive weekly matchup element to the game.</p>
                            </div>
                        </li>
                        
                        <!-- Bonus Points FAQs -->
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>How are bonus points calculated and awarded?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Bonus points are awarded using the Bonus Points System (BPS). Players earn BPS points for various actions during a match (goals, assists, tackles, passes, etc.). The top three players with the highest BPS receive 3, 2, and 1 bonus points respectively. BPS is calculated automatically based on official match statistics.</p>
                            </div>
                        </li>
                        
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>Which players typically earn bonus points?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Players who consistently earn bonus points include: creative midfielders who make key passes, dominant defenders who make many tackles and clearances, penalty takers, and players from teams that dominate possession. Defensive midfielders often score high BPS through their all-around contributions.</p>
                            </div>
                        </li>
                        
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>Can multiple players from the same team get bonus points?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Yes, bonus points are awarded to the top three performers in the match regardless of team. It's common to see two players from the winning team and one from the losing team, or sometimes all three from the same team in dominant performances.</p>
                            </div>
                        </li>
                        
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>Do bonus points affect my captain's double points?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Yes! If your captain earns bonus points, they are doubled along with all their other points. This makes bonus-point magnets excellent captain choices, as the extra points can significantly boost your gameweek score.</p>
                            </div>
                        </li>
                        
                        <!-- General FAQs -->
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>What happens during cup competitions?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Fantasy Football continues through cup competitions. Premier League matches are the primary source of points, but be aware of potential rotation as managers rest players for cup games. There's also a Fantasy Cup that starts around Gameweek 17 - qualified managers compete in knockout format.</p>
                            </div>
                        </li>
                        
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>Can I play with multiple teams?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>No, you can only manage one team per account. Multiple teams are against the rules and may result in all your teams being deleted. Focus on making your single team as competitive as possible - that's where the real challenge and satisfaction comes from!</p>
                            </div>
                        </li>
                        
                        <li class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <span>How do I reset my password?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Click "Forgot Password" on the login page and enter your registered email address. You'll receive a password reset link. If you don't receive the email, check your spam folder. For further assistance, contact support with your team name and registered email address.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab navigation for help sections
        function showHelpTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.style.display = 'none';
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('.help-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Show selected tab
            document.getElementById(tabName + '-tab').style.display = 'block';
            
            // Add active class to clicked tab
            event.target.classList.add('active');
        }

        // Tab navigation for scoring system
        function showScoringTab(tabName) {
            // Hide all scoring tabs
            document.querySelectorAll('.scoring-tab-content').forEach(tab => {
                tab.style.display = 'none';
            });
            
            // Remove active class from all scoring tabs
            document.querySelectorAll('.scoring-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Show selected scoring tab
            document.getElementById(tabName + '-scoring').style.display = 'block';
            
            // Add active class to clicked scoring tab
            event.target.classList.add('active');
        }

        // FAQ toggle functionality
        function toggleFAQ(element) {
            const faqItem = element.parentElement;
            faqItem.classList.toggle('active');
        }

        // Add interactivity to FAQ search
        document.querySelector('.faq-search input').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const faqItems = document.querySelectorAll('.faq-item');
            
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question span').textContent.toLowerCase();
                const answer = item.querySelector('.faq-answer p').textContent.toLowerCase();
                
                if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Initialize with first FAQ item open
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.faq-item').classList.add('active');
        });
    </script>
</body>
</html>