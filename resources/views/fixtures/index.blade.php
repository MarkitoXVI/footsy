<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixtures - Footsy Fantasy Football</title>
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
            max-width: 1200px;
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
        
        /* Fixtures Content */
        .fixtures-content {
            padding: 2rem;
        }
        
        .fixtures-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .fixtures-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
        }
        
        .gameweek-selector {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
        
        .gameweek-btn {
            padding: 0.5rem 1rem;
            background: white;
            border: 1px solid var(--light-gray);
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .gameweek-btn.active {
            background: var(--gradient);
            color: white;
            border-color: var(--primary);
        }
        
        .gameweek-btn:hover:not(.active) {
            border-color: var(--primary);
        }
        
        /* Fixtures Grid */
        .fixtures-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 1.5rem;
        }
        
        .gameweek-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .gameweek-header {
            background: var(--gradient);
            color: white;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .gameweek-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        .gameweek-dates {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        .fixtures-list {
            padding: 0;
        }
        
        .fixture-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--light-gray);
            transition: all 0.3s;
        }
        
        .fixture-item:last-child {
            border-bottom: none;
        }
        
        .fixture-item:hover {
            background: #f9f9f9;
        }
        
        .teams {
            display: flex;
            align-items: center;
            flex: 1;
        }
        
        .home-team, .away-team {
            display: flex;
            align-items: center;
            flex: 1;
        }
        
        .away-team {
            justify-content: flex-end;
            text-align: right;
        }
        
        .team-name {
            font-weight: 500;
            margin: 0 0.75rem;
        }
        
        .team-logo {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--dark);
        }
        
        .vs {
            color: var(--gray);
            margin: 0 0.5rem;
        }
        
        .fixture-details {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-left: 1rem;
        }
        
        .fixture-time {
            font-weight: 600;
            color: var(--dark);
        }
        
        .fixture-date {
            font-size: 0.8rem;
            color: var(--gray);
        }
        
        .fixture-venue {
            font-size: 0.8rem;
            color: var(--gray);
            margin-top: 0.25rem;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .fixtures-grid {
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
            
            .fixtures-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .fixture-item {
                flex-direction: column;
                align-items: flex-start;
                padding: 1rem;
            }
            
            .teams {
                width: 100%;
                margin-bottom: 0.5rem;
            }
            
            .fixture-details {
                flex-direction: row;
                justify-content: space-between;
                width: 100%;
                margin-left: 0;
            }
        }
        
        @media (max-width: 576px) {
            .fixtures-content {
                padding: 1rem;
            }
            
            .header {
                padding: 0 1rem;
            }
            
            .gameweek-selector {
                flex-wrap: wrap;
            }
        }
    </style>
    <style>
        /* Results styling for finished fixtures */
        .gameweek-results { padding: 1rem 1.5rem 1.5rem; background: #fff; border-top: 1px solid var(--light-gray); }
        .gameweek-results-header { font-family: 'Montserrat', sans-serif; font-size: 1.2rem; font-weight: 600; margin-bottom: 0.75rem; }
        .results-list { list-style: none; padding: 0; margin: 0; display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 0.75rem; }
        .result-item { border: 1px solid var(--light-gray); border-radius: 8px; padding: 0.75rem 1rem; background: #fafbff; }
        .result-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem; font-weight: 600; }
        .result-teams { display: flex; gap: 0.5rem; align-items: center; }
        .result-score { font-family: 'Montserrat', sans-serif; font-weight: 700; color: var(--primary); }
        .scorers { margin: 0; padding-left: 1rem; }
        .scorers li { font-size: 0.9rem; color: var(--dark); }
        .scorer-team { font-weight: 600; margin-right: 0.25rem; }
        .no-events { font-size: 0.9rem; color: var(--gray); }
        /* Inline score in card center */
        .score-block { display: grid; grid-template-columns: 1fr 1fr; grid-template-rows: auto auto; align-items: start; justify-items: stretch; column-gap: 1rem; row-gap: 0.25rem; min-width: 240px; }
        .scoreline { font-family: 'Montserrat', sans-serif; font-weight: 700; color: var(--primary); }
        .scorers-inline { list-style: none; padding: 0; margin: 0; text-align: center; }
        .scorers-inline li { font-size: 0.8rem; color: var(--gray); }
        .scorers-inline .scorer-team { font-weight: 700; color: var(--dark); }
        .scorers-list { list-style: none; padding: 0; margin: 0; width: 100%; }
        .scorers-list li { font-size: 0.8rem; color: var(--gray); }
        .home-scorers { justify-self: start; text-align: left; grid-column: 1; grid-row: 2; }
        .away-scorers { justify-self: end; text-align: right; grid-column: 2; grid-row: 2; }
        .scoreline { grid-column: 1 / -1; grid-row: 1; justify-self: center; }
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
                <a href="{{ route('fixtures.index') }}" class="nav-link active">
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

        <!-- Fixtures Content -->
        <div class="fixtures-content">
            <div class="fixtures-header">
                <h1 class="fixtures-title">Premier League Fixtures</h1>
                <div class="gameweek-selector">
                    <button class="gameweek-btn active">Gameweek 6</button>
                    <button class="gameweek-btn">Gameweek 7</button>
                </div>
            </div>

            <div class="fixtures-grid">
                <!-- Gameweek 6 -->
                <div class="gameweek-card" id="gameweek-6">
                    <div class="gameweek-header">
                        <div class="gameweek-title">Gameweek 6</div>
                        <div class="gameweek-dates">Sep 27 - Sep 29, 2025</div>
                    </div>
                    <ul class="fixtures-list">
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">BRE</div>
                                    <div class="team-name">Brentford</div>
                                </div>
                                <div class="score-block">
                                    <ul class="scorers-list home-scorers">
                                        <li>Igor Thiago 8'</li>
                                        <li>Igor Thiago 20'</li>
                                        <li>Mathias Jensen 90+5'</li>
                                    </ul>
                                    <div class="scoreline">3 - 1</div>
                                    <ul class="scorers-list away-scorers">
                                        <li>Benjamin Šeško 26'</li>
                                    </ul>
                                </div>
                                <div class="away-team">
                                    <div class="team-name">Manchester United</div>
                                    <div class="team-logo">MUN</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">14:30</div>
                                <div class="fixture-date">Sat, Sep 27</div>
                                <div class="fixture-venue">Gtech Community Stadium</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">LEE</div>
                                    <div class="team-name">Leeds United</div>
                                </div>
                                <div class="score-block">
                                    <ul class="scorers-list home-scorers">
                                        <li>Joe Rodon 37'</li>
                                        <li>Sean Longstaff 54'</li>
                                    </ul>
                                    <div class="scoreline">2 - 2</div>
                                    <ul class="scorers-list away-scorers">
                                        <li>Antione Semenyo 26'</li>
                                        <li>Eli Junior Kroupi 90+3'</li>
                                    </ul>
                                </div>
                                <div class="away-team">
                                    <div class="team-name">Bournemouth</div>
                                    <div class="team-logo">BOU</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">17:00</div>
                                <div class="fixture-date">Sat, Sep 27</div>
                                <div class="fixture-venue">Elland Road</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">CHE</div>
                                    <div class="team-name">Chelsea</div>
                                </div>
                                <div class="score-block">
                                    <ul class="scorers-list home-scorers">
                                        <li>Enzo Fernández 24'</li>
                                    </ul>
                                    <div class="scoreline">1 - 3</div>
                                    <ul class="scorers-list away-scorers">
                                        <li>Danny Welbeck 77'</li>
                                        <li>Maxim De Cuyper 90' +2</li>
                                        <li>Danny Welbeck 90' +10</li>
                                    </ul>
                                </div>
                                <div class="away-team">
                                    <div class="team-name">Brighton</div>
                                    <div class="team-logo">BHA</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">17:00</div>
                                <div class="fixture-date">Sat, Sep 27</div>
                                <div class="fixture-venue">Stamford Bridge</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">MCI</div>
                                    <div class="team-name">Manchester City</div>
                                </div>
                                <div class="score-block">
                                    <ul class="scorers-list home-scorers">
                                        <li>Maxime Estève 12' (OG)</li>
                                        <li>Matheus Nunes 61'</li>
                                        <li>Maxime Estève 65' (OG)</li>
                                        <li>Erling Haaland 90'</li>
                                        <li>Erling Haaland 90' +3</li>
                                    </ul>
                                    <div class="scoreline">5 - 1</div>
                                    <ul class="scorers-list away-scorers">
                                        <li>Jaidon Anthony 38'</li>
                                    </ul>
                                </div>
                                <div class="away-team">
                                    <div class="team-name">Burnley</div>
                                    <div class="team-logo">BUR</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">17:00</div>
                                <div class="fixture-date">Sat, Sep 27</div>
                                <div class="fixture-venue">Etihad Stadium</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">CRY</div>
                                    <div class="team-name">Crystal Palace</div>
                                </div>
                                <div class="score-block">
                                    <ul class="scorers-list home-scorers">
                                        <li>Ismaïla Sarr 9'</li>
                                        <li>Edward Nketiah 90' +7</li>
                                    </ul>
                                    <div class="scoreline">2 - 1</div>
                                    <ul class="scorers-list away-scorers">
                                        <li>Federico Chiesa 87'</li>
                                    </ul>
                                </div>
                                <div class="away-team">
                                    <div class="team-name">Liverpool</div>
                                    <div class="team-logo">LIV</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">17:00</div>
                                <div class="fixture-date">Sat, Sep 27</div>
                                <div class="fixture-venue">Selhurst Park</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">NOT</div>
                                    <div class="team-name">Nottingham Forest</div>
                                </div>
                                <div class="score-block">
                                    <ul class="scorers-list home-scorers">
                                    </ul>
                                    <div class="scoreline">0 - 1</div>
                                    <ul class="scorers-list away-scorers">
                                        <li>Omar Alderete 38'</li>
                                    </ul>
                                </div>
                                <div class="away-team">
                                    <div class="team-name">Sunderland</div>
                                    <div class="team-logo">SUN</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">19:30</div>
                                <div class="fixture-date">Sat, Sep 27</div>
                                <div class="fixture-venue">City Ground</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">TOT</div>
                                    <div class="team-name">Tottenham</div>
                                </div>
                                <div class="score-block">
                                    <ul class="scorers-list home-scorers">
                                        <li>João Palhinha 90' +4</li>
                                    </ul>
                                    <div class="scoreline">1 - 1</div>
                                    <ul class="scorers-list away-scorers">
                                        <li>Santiago Bueno 54'</li>
                                    </ul>
                                </div>
                                <div class="away-team">
                                    <div class="team-name">Wolves</div>
                                    <div class="team-logo">WOL</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">22:00</div>
                                <div class="fixture-date">Sat, Sep 27</div>
                                <div class="fixture-venue">Tottenham Hotspur Stadium</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">AST</div>
                                    <div class="team-name">Aston Villa</div>
                                </div>
                                <div class="score-block">
                                    <ul class="scorers-list home-scorers">
                                        <li>Ollie Watkins 37'</li>
                                        <li>John McGinn 49'</li>
                                        <li>Emiliano Buendía 51'</li>
                                    </ul>
                                    <div class="scoreline">3 - 1</div>
                                    <ul class="scorers-list away-scorers">
                                        <li>Raúl Jiménez 3'</li>
                                    </ul>
                                </div>
                                <div class="away-team">
                                    <div class="team-name">Fulham</div>
                                    <div class="team-logo">FUL</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">16:00</div>
                                <div class="fixture-date">Sun, Sep 28</div>
                                <div class="fixture-venue">Villa Park</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">NEW</div>
                                    <div class="team-name">Newcastle</div>
                                </div>
                                <div class="score-block">
                                    <ul class="scorers-list home-scorers">
                                        <li>Nick Woltemade 34'</li>
                                    </ul>
                                    <div class="scoreline">1 - 2</div>
                                    <ul class="scorers-list away-scorers">
                                        <li>Mikel Merino 84'</li>
                                        <li>Gabriel Magalhães 90' +6</li>
                                    </ul>
                                </div>
                                <div class="away-team">
                                    <div class="team-name">Arsenal</div>
                                    <div class="team-logo">ARS</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">18:30</div>
                                <div class="fixture-date">Sun, Sep 28</div>
                                <div class="fixture-venue">St. James' Park</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">EVE</div>
                                    <div class="team-name">Everton</div>
                                </div>
                                <div class="score-block">
                                    <ul class="scorers-list home-scorers">
                                    </ul>
                                    <div class="scoreline">Game hasn't started yet</div>
                                    <ul class="scorers-list away-scorers">
                                    </ul>
                                </div>
                                <div class="away-team">
                                    <div class="team-name">West Ham</div>
                                    <div class="team-logo">WHU</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">22:00</div>
                                <div class="fixture-date">Sun, Sep 29</div>
                                <div class="fixture-venue">Hill Dickinson Stadium</div>
                            </div>
                        </li>
                    </ul>
                    

                <!-- Gameweek 7 -->
                <div class="gameweek-card" id="gameweek-7" style="display: none;">
                    <div class="gameweek-header">
                        <div class="gameweek-title">Gameweek 7</div>
                        <div class="gameweek-dates">Oct 3 - Oct 5, 2025</div>
                    </div>
                    <ul class="fixtures-list">
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">BOU</div>
                                    <div class="team-name">Bournemouth</div>
                                </div>
                                <div class="vs">vs</div>
                                <div class="away-team">
                                    <div class="team-name">Fulham</div>
                                    <div class="team-logo">FUL</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">22:00</div>
                                <div class="fixture-date">Fri, Oct 3</div>
                                <div class="fixture-venue">Vitality Stadium</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">LEE</div>
                                    <div class="team-name">Leeds United</div>
                                </div>
                                <div class="vs">vs</div>
                                <div class="away-team">
                                    <div class="team-name">Tottenham</div>
                                    <div class="team-logo">TOT</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">14:30</div>
                                <div class="fixture-date">Sat, Oct 4</div>
                                <div class="fixture-venue">Elland Road</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">MUN</div>
                                    <div class="team-name">Manchester United</div>
                                </div>
                                <div class="vs">vs</div>
                                <div class="away-team">
                                    <div class="team-name">Sunderland</div>
                                    <div class="team-logo">SUN</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">17:00</div>
                                <div class="fixture-date">Sat, Oct 4</div>
                                <div class="fixture-venue">Old Trafford</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">ARS</div>
                                    <div class="team-name">Arsenal</div>
                                </div>
                                <div class="vs">vs</div>
                                <div class="away-team">
                                    <div class="team-name">West Ham</div>
                                    <div class="team-logo">WHU</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">17:00</div>
                                <div class="fixture-date">Sat, Oct 4</div>
                                <div class="fixture-venue">Emirates Stadium</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">CHE</div>
                                    <div class="team-name">Chelsea</div>
                                </div>
                                <div class="vs">vs</div>
                                <div class="away-team">
                                    <div class="team-name">Liverpool</div>
                                    <div class="team-logo">LIV</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">19:30</div>
                                <div class="fixture-date">Sat, Oct 4</div>
                                <div class="fixture-venue">Stamford Bridge</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">EVE</div>
                                    <div class="team-name">Everton</div>
                                </div>
                                <div class="vs">vs</div>
                                <div class="away-team">
                                    <div class="team-name">Crystal Palace</div>
                                    <div class="team-logo">CRY</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">16:00</div>
                                <div class="fixture-date">Sun, Oct 5</div>
                                <div class="fixture-venue">Hill Dickinson Stadium</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">NEW</div>
                                    <div class="team-name">Newcastle</div>
                                </div>
                                <div class="vs">vs</div>
                                <div class="away-team">
                                    <div class="team-name">Nottingham Forest</div>
                                    <div class="team-logo">NFO</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">16:00</div>
                                <div class="fixture-date">Sun, Oct 5</div>
                                <div class="fixture-venue">St. James' Park</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">WOL</div>
                                    <div class="team-name">Wolverhampton</div>
                                </div>
                                <div class="vs">vs</div>
                                <div class="away-team">
                                    <div class="team-name">Brighton</div>
                                    <div class="team-logo">BHA</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">16:00</div>
                                <div class="fixture-date">Sun, Oct 5</div>
                                <div class="fixture-venue">Molineux Stadium</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">AST</div>
                                    <div class="team-name">Aston Villa</div>
                                </div>
                                <div class="vs">vs</div>
                                <div class="away-team">
                                    <div class="team-name">Burnley</div>
                                    <div class="team-logo">BUR</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">16:00</div>
                                <div class="fixture-date">Sun, Oct 5</div>
                                <div class="fixture-venue">Villa</div>
                            </div>
                        </li>
                        <li class="fixture-item">
                            <div class="teams">
                                <div class="home-team">
                                    <div class="team-logo">BRE</div>
                                    <div class="team-name">Brentford</div>
                                </div>
                                <div class="vs">vs</div>
                                <div class="away-team">
                                    <div class="team-name">Manchester City</div>
                                    <div class="team-logo">MCI</div>
                                </div>
                            </div>
                            <div class="fixture-details">
                                <div class="fixture-time">18:30</div>
                                <div class="fixture-date">Sun, Oct 5</div>
                                <div class="fixture-venue">Gtech Community Stadium</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gameweek selector functionality
            const gameweekButtons = document.querySelectorAll('.gameweek-btn');
            const gameweekCards = document.querySelectorAll('.gameweek-card');
            
            gameweekButtons.forEach((button, index) => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    gameweekButtons.forEach(btn => btn.classList.remove('active'));
                    
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    // Hide all gameweek cards
                    gameweekCards.forEach(card => card.style.display = 'none');
                    
                    // Show selected gameweek card
                    gameweekCards[index].style.display = 'block';
                });
            });
            
            // Add hover effects to fixture items
            const fixtureItems = document.querySelectorAll('.fixture-item');
            
            fixtureItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                    this.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = 'none';
                });
            });
        });
    </script>
</body>
</html>