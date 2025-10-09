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
        
        /* Calendar Styles */
        .calendar-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .calendar-nav {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
        
        .calendar-btn {
            background: var(--light);
            border: none;
            border-radius: 6px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .calendar-btn:hover {
            background: var(--primary);
            color: white;
        }
        
        .calendar-month {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 1.2rem;
        }
        
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 4px;
        }
        
        .calendar-day-header {
            text-align: center;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--gray);
            padding: 0.5rem 0;
        }
        
        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }
        
        .calendar-day:hover {
            background: var(--light);
        }
        
        .calendar-day.active {
            background: var(--gradient);
            color: white;
        }
        
        .calendar-day.has-fixtures::after {
            content: '';
            position: absolute;
            bottom: 4px;
            width: 4px;
            height: 4px;
            background: var(--secondary);
            border-radius: 50%;
        }
        
        .calendar-day.other-month {
            color: var(--light-gray);
        }
        
        .calendar-day.today {
            border: 2px solid var(--primary);
        }
        
        /* Fixtures Grid */
        .fixtures-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 1.5rem;
        }
        
        .date-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .date-header {
            background: var(--gradient);
            color: white;
            padding: 1rem 1.5rem;
        }
        
        .date-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
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
        
        .fixture-venue {
            font-size: 0.8rem;
            color: var(--gray);
            margin-top: 0.25rem;
        }
        
        .no-fixtures {
            padding: 3rem 2rem;
            text-align: center;
            color: var(--gray);
        }
        
        .no-fixtures i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        
        /* Results styling for finished fixtures */
        .score-block { 
            display: grid; 
            grid-template-columns: 1fr 1fr; 
            grid-template-rows: auto auto; 
            align-items: start; 
            justify-items: stretch; 
            column-gap: 1rem; 
            row-gap: 0.25rem; 
            min-width: 240px; 
        }
        
        .scoreline { 
            font-family: 'Montserrat', sans-serif; 
            font-weight: 700; 
            color: var(--primary); 
        }
        
        .scorers-list { 
            list-style: none; 
            padding: 0; 
            margin: 0; 
            width: 100%; 
        }
        
        .scorers-list li { 
            font-size: 0.8rem; 
            color: var(--gray); 
        }
        
        .home-scorers { 
            justify-self: start; 
            text-align: left; 
            grid-column: 1; 
            grid-row: 2; 
        }
        
        .away-scorers { 
            justify-self: end; 
            text-align: right; 
            grid-column: 2; 
            grid-row: 2; 
        }
        
        .scoreline { 
            grid-column: 1 / -1; 
            grid-row: 1; 
            justify-self: center; 
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
            
            .calendar-grid {
                gap: 2px;
            }
            
            .calendar-day {
                font-size: 0.8rem;
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
                <a href="{{ route('fixtures.index') }}" class="nav-link active">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Fixtures</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('help') }}" class="nav-link">
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

        <!-- Fixtures Content -->
        <div class="fixtures-content">
            <div class="fixtures-header">
                <h1 class="fixtures-title">Premier League Fixtures</h1>
            </div>

            <!-- Calendar -->
            <div class="calendar-container">
                <div class="calendar-header">
                    <div class="calendar-nav">
                        <button class="calendar-btn" id="prev-month">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <div class="calendar-month" id="current-month">September 2025</div>
                        <button class="calendar-btn" id="next-month">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <button class="calendar-btn" id="today-btn">
                        Today
                    </button>
                </div>
                <div class="calendar-grid">
                    <div class="calendar-day-header">Sun</div>
                    <div class="calendar-day-header">Mon</div>
                    <div class="calendar-day-header">Tue</div>
                    <div class="calendar-day-header">Wed</div>
                    <div class="calendar-day-header">Thu</div>
                    <div class="calendar-day-header">Fri</div>
                    <div class="calendar-day-header">Sat</div>
                    <!-- Calendar days will be populated by JavaScript -->
                </div>
            </div>

            <!-- Fixtures Display -->
            <div id="fixtures-display">
                <!-- Fixtures will be displayed here based on selected date -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fixtures data organized by date
            const fixturesData = {
                '2025-09-27': [
                    {
                        homeTeam: 'Brentford',
                        homeLogo: 'BRE',
                        awayTeam: 'Manchester United',
                        awayLogo: 'MUN',
                        time: '14:30',
                        venue: 'Gtech Community Stadium',
                        score: '3 - 1',
                        homeScorers: ['Igor Thiago 8\'', 'Igor Thiago 20\'', 'Mathias Jensen 90+5\''],
                        awayScorers: ['Benjamin Šeško 26\'']
                    },
                    {
                        homeTeam: 'Leeds United',
                        homeLogo: 'LEE',
                        awayTeam: 'Bournemouth',
                        awayLogo: 'BOU',
                        time: '17:00',
                        venue: 'Elland Road',
                        score: '2 - 2',
                        homeScorers: ['Joe Rodon 37\'', 'Sean Longstaff 54\''],
                        awayScorers: ['Antione Semenyo 26\'', 'Eli Junior Kroupi 90+3\'']
                    },
                    {
                        homeTeam: 'Chelsea',
                        homeLogo: 'CHE',
                        awayTeam: 'Brighton',
                        awayLogo: 'BHA',
                        time: '17:00',
                        venue: 'Stamford Bridge',
                        score: '1 - 3',
                        homeScorers: ['Enzo Fernández 24\''],
                        awayScorers: ['Danny Welbeck 77\'', 'Maxim De Cuyper 90+2', 'Danny Welbeck 90+10']
                    },
                    {
                        homeTeam: 'Manchester City',
                        homeLogo: 'MCI',
                        awayTeam: 'Burnley',
                        awayLogo: 'BUR',
                        time: '17:00',
                        venue: 'Etihad Stadium',
                        score: '5 - 1',
                        homeScorers: ['Maxime Estève 12\' (OG)', 'Matheus Nunes 61\'', 'Maxime Estève 65\' (OG)', 'Erling Haaland 90\'', 'Erling Haaland 90+3'],
                        awayScorers: ['Jaidon Anthony 38\'']
                    },
                    {
                        homeTeam: 'Crystal Palace',
                        homeLogo: 'CRY',
                        awayTeam: 'Liverpool',
                        awayLogo: 'LIV',
                        time: '17:00',
                        venue: 'Selhurst Park',
                        score: '2 - 1',
                        homeScorers: ['Ismaïla Sarr 9\'', 'Edward Nketiah 90+7'],
                        awayScorers: ['Federico Chiesa 87\'']
                    },
                    {
                        homeTeam: 'Nottingham Forest',
                        homeLogo: 'NOT',
                        awayTeam: 'Sunderland',
                        awayLogo: 'SUN',
                        time: '19:30',
                        venue: 'City Ground',
                        score: '0 - 1',
                        homeScorers: [],
                        awayScorers: ['Omar Alderete 38\'']
                    },
                    {
                        homeTeam: 'Tottenham',
                        homeLogo: 'TOT',
                        awayTeam: 'Wolves',
                        awayLogo: 'WOL',
                        time: '22:00',
                        venue: 'Tottenham Hotspur Stadium',
                        score: '1 - 1',
                        homeScorers: ['João Palhinha 90+4'],
                        awayScorers: ['Santiago Bueno 54\'']
                    }
                ],
                '2025-09-28': [
                    {
                        homeTeam: 'Aston Villa',
                        homeLogo: 'AST',
                        awayTeam: 'Fulham',
                        awayLogo: 'FUL',
                        time: '16:00',
                        venue: 'Villa Park',
                        score: '3 - 1',
                        homeScorers: ['Ollie Watkins 37\'', 'John McGinn 49\'', 'Emiliano Buendía 51\''],
                        awayScorers: ['Raúl Jiménez 3\'']
                    },
                    {
                        homeTeam: 'Newcastle',
                        homeLogo: 'NEW',
                        awayTeam: 'Arsenal',
                        awayLogo: 'ARS',
                        time: '18:30',
                        venue: 'St. James\' Park',
                        score: '1 - 2',
                        homeScorers: ['Nick Woltemade 34\''],
                        awayScorers: ['Mikel Merino 84\'', 'Gabriel Magalhães 90+6']
                    }
                ],
                '2025-09-29': [
                    {
                        homeTeam: 'Everton',
                        homeLogo: 'EVE',
                        awayTeam: 'West Ham',
                        awayLogo: 'WHU',
                        time: '22:00',
                        venue: 'Hill Dickinson Stadium',
                        score: '1 - 1',
                        homeScorers: ['Michael Keane 18\''],
                        awayScorers: ['Jarrod Bowen 65\'']
                    },
                ],
                '2025-10-03': [
                    {
                        homeTeam: 'Bournemouth',
                        homeLogo: 'BOU',
                        awayTeam: 'Fulham',
                        awayLogo: 'FUL',
                        time: '22:00',
                        venue: 'Vitality Stadium',
                        score: '3 - 1',
                        homeScorers: ['Antoine Semenyo 78\'', 'Antoine Semenyo 90+6\'', 'Justin Kluivert 84\''],
                        awayScorers: ['Ryan Sessegnon 70\'']
                    }
                ],
                '2025-10-04': [
                    {
                        homeTeam: 'Leeds United',
                        homeLogo: 'LEE',
                        awayTeam: 'Tottenham',
                        awayLogo: 'TOT',
                        time: '14:30',
                        venue: 'Elland Road',
                        score: '1 - 2',
                        homeScorers: ['Noah Okafor 34\''],
                        awayScorers: ['Mathys Tel 23\'', 'Mohammed Kudus 57\'']
                    },
                    {
                        homeTeam: 'Manchester United',
                        homeLogo: 'MUN',
                        awayTeam: 'Sunderland',
                        awayLogo: 'SUN',
                        time: '17:00',
                        venue: 'Old Trafford',
                        score: '2 - 0',
                        homeScorers: ['Mason Mount 8\'', 'Benjamin Šeško 31\''],
                        awayScorers: [null]
                    },
                    {
                        homeTeam: 'Arsenal',
                        homeLogo: 'ARS',
                        awayTeam: 'West Ham',
                        awayLogo: 'WHU',
                        time: '17:00',
                        venue: 'Emirates Stadium',
                        score: '2 - 0',
                        homeScorers: ['Declan Rice 38\'', 'Bukayo Saka 67\' (pen)'],
                        awayScorers: []
                    },
                    {
                        homeTeam: 'Chelsea',
                        homeLogo: 'CHE',
                        awayTeam: 'Liverpool',
                        awayLogo: 'LIV',
                        time: '19:30',
                        venue: 'Stamford Bridge',
                        score: '2 - 1',
                        homeScorers: ['Moisés Caicedo 14\'', 'Estêvão 90+5\''],
                        awayScorers: ['Cody Gakpo 63\'']
                    }
                ],
                '2025-10-05': [
                    {
                        homeTeam: 'Everton',
                        homeLogo: 'EVE',
                        awayTeam: 'Crystal Palace',
                        awayLogo: 'CRY',
                        time: '16:00',
                        venue: 'Hill Dickinson Stadium',
                        score: '2 - 1',
                        homeScorers: ['Iliman Ndiaye 76\' (pen)', 'Jack Grealish 90+3\''],
                        awayScorers: ['Daniel Muñoz 37\'']
                    },
                    {
                        homeTeam: 'Newcastle',
                        homeLogo: 'NEW',
                        awayTeam: 'Nottingham Forest',
                        awayLogo: 'NFO',
                        time: '16:00',
                        venue: 'St. James\' Park',
                        score: '2 - 0',
                        homeScorers: ['Bruno Guimarães 58\'', 'Nick Woltemade 84\' (pen)'],
                        awayScorers: []
                    },
                    {
                        homeTeam: 'Wolverhampton',
                        homeLogo: 'WOL',
                        awayTeam: 'Brighton',
                        awayLogo: 'BHA',
                        time: '16:00',
                        venue: 'Molineux Stadium',
                        score: '1 - 1',
                        homeScorers: ['Bart Verbruggen 21\' (OG)'],
                        awayScorers: ['Jan Paul van Hecke 86\'']
                    },
                    {
                        homeTeam: 'Aston Villa',
                        homeLogo: 'AST',
                        awayTeam: 'Burnley',
                        awayLogo: 'BUR',
                        time: '16:00',
                        venue: 'Villa Park',
                        score: '2 - 1',
                        homeScorers: ['Donyell Malen 25\'', 'Donyell Malen 63\''],
                        awayScorers: ['Lesley Ugochukwu 78\'']
                    },
                    {
                        homeTeam: 'Brentford',
                        homeLogo: 'BRE',
                        awayTeam: 'Manchester City',
                        awayLogo: 'MCI',
                        time: '18:30',
                        venue: 'Gtech Community Stadium',
                        score: '0 - 1',
                        homeScorers: [],
                        awayScorers: ['Erling Haaland 9\'']
                    }
                ],
                 '2025-10-18': [
                    {
                        homeTeam: 'Nottingham Forest',
                        homeLogo: 'NOT',
                        awayTeam: 'Chelsea',
                        awayLogo: 'CHE',
                        time: '14:30',
                        venue: 'City Ground',
                        score: null,
                        homeScorers: [],
                        awayScorers: []
                    },
                    {
                        homeTeam: 'Brighton',
                        homeLogo: 'BHA',
                        awayTeam: 'Newcastle United',
                        awayLogo: 'NEW',
                        time: '17:00',
                        venue: 'Amex Stadium',
                        score: null,
                        homeScorers: [],
                        awayScorers: []
                    },
                    {
                        homeTeam: 'Burnley',
                        homeLogo: 'BUR',
                        awayTeam: 'Leeds United',
                        awayLogo: 'LEE',
                        time: '17:00',
                        venue: 'Turf Moor',
                        score: null,
                        homeScorers: [],
                        awayScorers: []
                    },
                    {
                        homeTeam: 'Crystal Palace',
                        homeLogo: 'CRY',
                        awayTeam: 'Bournemouth',
                        awayLogo: 'BOU',
                        time: '17:00',
                        venue: 'Selhurst Park',
                        score: null,
                        homeScorers: [],
                        awayScorers: []
                    },
                    {
                        homeTeam: 'Manchester City',
                        homeLogo: 'MCI',
                        awayTeam: 'Everton',
                        awayLogo: 'EVE',
                        time: '17:00',
                        venue: 'Etihad Stadium',
                        score: null,
                        homeScorers: [],
                        awayScorers: []
                    },
                    {
                        homeTeam: 'Sunderland',
                        homeLogo: 'SUN',
                        awayTeam: 'Wolverhampton',
                        awayLogo: 'WOL',
                        time: '17:00',
                        venue: 'Stadium of Light',
                        score: null,
                        homeScorers: [],
                        awayScorers: []
                    },
                    {
                        homeTeam: 'Fulham',
                        homeLogo: 'FUL',
                        awayTeam: 'Arsenal',
                        awayLogo: 'ARS',
                        time: '19:30',
                        venue: 'Craven Cottage',
                        score: null,
                        homeScorers: [],
                        awayScorers: []
                    }
                ],
                '2025-10-19': [
                    {
                        homeTeam: 'Tottenham',
                        homeLogo: 'TOT',
                        awayTeam: 'Aston Villa',
                        awayLogo: 'AST',
                        time: '16:00',
                        venue: 'Tottenham Hotspur Stadium',
                        score: null,
                        homeScorers: [],
                        awayScorers: []
                    },
                    {
                        homeTeam: 'Liverpool',
                        homeLogo: 'LIV',
                        awayTeam: 'Manchester United',
                        awayLogo: 'MUN',
                        time: '18:30',
                        venue: 'Anfield',
                        score: null,
                        homeScorers: [],
                        awayScorers: []
                    }
                ],
                '2025-10-20': [
                    {
                        homeTeam: 'West Ham',
                        homeLogo: 'WHU',
                        awayTeam: 'Brentford',
                        awayLogo: 'BRE',
                        time: '22:00',
                        venue: 'London Stadium',
                        score: null,
                        homeScorers: [],
                        awayScorers: []
                    }
                ]
            };

            

            // Calendar functionality
            let currentDate = new Date();
            
            const monthNames = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];

            function updateCalendar() {
                const calendarGrid = document.querySelector('.calendar-grid');
                const currentMonthElement = document.getElementById('current-month');
                
                // Clear existing calendar days (keep headers)
                while (calendarGrid.children.length > 7) {
                    calendarGrid.removeChild(calendarGrid.lastChild);
                }
                
                // Update month display
                currentMonthElement.textContent = `${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}`;
                
                // Get first day of month and number of days
                const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
                const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
                const daysInMonth = lastDay.getDate();
                const startingDay = firstDay.getDay();
                
                // Add empty cells for days before the first day of the month
                for (let i = 0; i < startingDay; i++) {
                    const emptyDay = document.createElement('div');
                    emptyDay.className = 'calendar-day other-month';
                    calendarGrid.appendChild(emptyDay);
                }
                
                // Add days of the month
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                
                for (let day = 1; day <= daysInMonth; day++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'calendar-day';
                    dayElement.textContent = day;
                    
                    const dateString = `${currentDate.getFullYear()}-${String(currentDate.getMonth() + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    
                    // Check if today
                    const cellDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), day);
                    if (cellDate.getTime() === today.getTime()) {
                        dayElement.classList.add('today');
                    }
                    
                    // Check if has fixtures
                    if (fixturesData[dateString]) {
                        dayElement.classList.add('has-fixtures');
                    }
                    
                    // Add click event
                    dayElement.addEventListener('click', function() {
                        // Remove active class from all days
                        document.querySelectorAll('.calendar-day').forEach(day => {
                            day.classList.remove('active');
                        });
                        
                        // Add active class to clicked day
                        this.classList.add('active');
                        
                        // Display fixtures for selected date
                        displayFixtures(dateString);
                    });
                    
                    calendarGrid.appendChild(dayElement);
                }
                
                // Auto-select today if it's in the current month view
                if (currentDate.getMonth() === today.getMonth() && currentDate.getFullYear() === today.getFullYear()) {
                    const todayElement = calendarGrid.children[7 + today.getDate() + startingDay - 1];
                    if (todayElement) {
                        todayElement.click();
                    }
                } else {
                    // Select first day with fixtures, or first day of month
                    let selected = false;
                    for (let i = 7; i < calendarGrid.children.length; i++) {
                        const dayElement = calendarGrid.children[i];
                        if (dayElement.classList.contains('has-fixtures')) {
                            dayElement.click();
                            selected = true;
                            break;
                        }
                    }
                    if (!selected && calendarGrid.children.length > 7) {
                        calendarGrid.children[7].click();
                    }
                }
            }
            
            function displayFixtures(dateString) {
                const fixturesDisplay = document.getElementById('fixtures-display');
                const fixtures = fixturesData[dateString];
                
                if (fixtures && fixtures.length > 0) {
                    const date = new Date(dateString);
                    const formattedDate = date.toLocaleDateString('en-US', { 
                        weekday: 'long', 
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric' 
                    });
                    
                    let fixturesHTML = `
                        <div class="date-card">
                            <div class="date-header">
                                <div class="date-title">${formattedDate}</div>
                            </div>
                            <ul class="fixtures-list">
                    `;
                    
                    fixtures.forEach(fixture => {
                        fixturesHTML += `
                            <li class="fixture-item">
                                <div class="teams">
                                    <div class="home-team">
                                        <div class="team-logo">${fixture.homeLogo}</div>
                                        <div class="team-name">${fixture.homeTeam}</div>
                                    </div>
                                    ${fixture.score ? `
                                        <div class="score-block">
                                            <ul class="scorers-list home-scorers">
                                                ${fixture.homeScorers.map(scorer => `<li>${scorer}</li>`).join('')}
                                            </ul>
                                            <div class="scoreline">${fixture.score}</div>
                                            <ul class="scorers-list away-scorers">
                                                ${fixture.awayScorers.map(scorer => `<li>${scorer}</li>`).join('')}
                                            </ul>
                                        </div>
                                    ` : `<div class="vs">vs</div>`}
                                    <div class="away-team">
                                        <div class="team-name">${fixture.awayTeam}</div>
                                        <div class="team-logo">${fixture.awayLogo}</div>
                                    </div>
                                </div>
                                <div class="fixture-details">
                                    <div class="fixture-time">${fixture.time}</div>
                                    <div class="fixture-venue">${fixture.venue}</div>
                                </div>
                            </li>
                        `;
                    });
                    
                    fixturesHTML += `
                            </ul>
                        </div>
                    `;
                    
                    fixturesDisplay.innerHTML = fixturesHTML;
                } else {
                    fixturesDisplay.innerHTML = `
                        <div class="date-card">
                            <div class="date-header">
                                <div class="date-title">${new Date(dateString).toLocaleDateString('en-US', { 
                                    weekday: 'long', 
                                    year: 'numeric', 
                                    month: 'long', 
                                    day: 'numeric' 
                                })}</div>
                            </div>
                            <div class="no-fixtures">
                                <i class="fas fa-calendar-times"></i>
                                <h3>No Fixtures Scheduled</h3>
                                <p>There are no Premier League matches scheduled for this date.</p>
                            </div>
                        </div>
                    `;
                }
            }
            
            // Event listeners for calendar navigation
            document.getElementById('prev-month').addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() - 1);
                updateCalendar();
            });
            
            document.getElementById('next-month').addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() + 1);
                updateCalendar();
            });
            
            document.getElementById('today-btn').addEventListener('click', function() {
                currentDate = new Date();
                currentDate.setDate(1);
                updateCalendar();
            });
            
            // Initialize calendar
            updateCalendar();
            
            // Add hover effects to fixture items
            document.addEventListener('mouseover', function(e) {
                if (e.target.closest('.fixture-item')) {
                    const fixtureItem = e.target.closest('.fixture-item');
                    fixtureItem.style.transform = 'translateY(-2px)';
                    fixtureItem.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
                }
            });
            
            document.addEventListener('mouseout', function(e) {
                if (e.target.closest('.fixture-item')) {
                    const fixtureItem = e.target.closest('.fixture-item');
                    fixtureItem.style.transform = 'translateY(0)';
                    fixtureItem.style.boxShadow = 'none';
                }
            });
        });
    </script>
</body>
</html>