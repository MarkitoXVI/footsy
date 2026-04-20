<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Fantasy Team - Footsy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        /* Sidebar */
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
            background: var(--light-gray);
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

        /* Page Content */
        .page {
            padding: 2rem;
        }

        h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        .team-info {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .team-name {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--primary);
        }

        .team-stats {
            display: flex;
            gap: 2rem;
        }

        .stat {
            text-align: center;
        }

        .stat-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--gray);
        }

        /* Chips Section */
        .chips-section {
            max-width: 900px;
            margin: 0 auto 2rem;
        }

        .chips-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .chips-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }

        .chip-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            cursor: pointer;
        }

        .chip-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .chip-card.active {
            border-color: var(--primary);
            background: rgba(58, 94, 229, 0.05);
        }

        .chip-card.used {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .chip-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: rgba(58, 94, 229, 0.1);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 1rem;
        }

        .chip-name {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .chip-description {
            font-size: 0.85rem;
            color: var(--gray);
            margin-bottom: 1rem;
            line-height: 1.4;
        }

        .chip-status {
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            display: inline-block;
        }

        .chip-status.available {
            background: rgba(52, 199, 89, 0.1);
            color: var(--secondary);
        }

        .chip-status.used {
            background: rgba(108, 117, 125, 0.1);
            color: var(--gray);
        }

        .chip-action {
            margin-top: 0.5rem;
        }

        .btn-chip {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-chip:hover {
            background: var(--primary-dark);
        }

        .btn-chip:disabled {
            background: var(--gray);
            cursor: not-allowed;
        }


        .pitch-container {
            position: relative;
            width: 100%;
            max-width: 900px;
            margin: 2rem auto;
            height: 820px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            background:
                linear-gradient(180deg, #4db36a 0%, #2f8e5c 100%),
                url('https://upload.wikimedia.org/wikipedia/commons/thumb/d/d3/Soccer_field_-_empty.svg/1280px-Soccer_field_-_empty.svg.png') no-repeat center center;
            background-size: cover;
            display: grid;
            grid-template-rows: repeat(4, 1fr);
            gap: 26px;
            padding: 2rem;
        }

        .pitch-row {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            align-items: center;
        }

        .field-player {
            grid-column: span 2;
            justify-self: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(255,255,255,0.95);
            border-radius: 16px;
            padding: 0.55rem 0.6rem;
            min-width: 92px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.12);
            transition: 0.2s ease;
            position: relative;
        }

        .field-player:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .field-player-img {
            width: 60px;
            height: 75px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 0.35rem;
        }

        .field-player-name {
            font-size: 0.82rem;
            font-weight: 700;
            text-align: center;
            line-height: 1.1;
            margin-bottom: 0.25rem;
        }

        .player-position {
            font-size: 0.7rem;
            color: var(--gray);
            font-weight: 600;
            text-transform: uppercase;
        }

        .bench-container {
            max-width: 900px;
            margin: 2rem auto;
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .bench-header {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            text-align: center;
            color: var(--dark);
        }

        .bench-row {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .bench-player {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1rem 0.8rem;
            width: 90px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.08);
            transition: 0.2s ease;
            position: relative;
        }

        .bench-player:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(0,0,0,0.12);
        }

        .bench-player img {
            width: 55px;
            height: 70px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 0.5rem;
        }

        .bench-player span {
            font-size: 0.8rem;
            font-weight: 600;
            text-align: center;
            line-height: 1.1;
        }

        .bench-position {
            font-size: 0.7rem;
            color: var(--gray);
            margin-top: 0.25rem;
        }

        /* Drag & Drop Animation Styles */
        .dragging {
            opacity: 0.5;
            transform: scale(1.05);
        }

        .drag-over {
            outline: 3px dashed var(--primary);
            border-radius: 12px;
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
            
            .search-bar {
                width: 200px;
            }
            
            .user-info {
                display: none;
            }
            
            .team-info {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
            
            .team-stats {
                justify-content: center;
            }
            
            .pitch-container {
                height: 700px;
                padding: 1.5rem;
            }
            
            .field-player {
                min-width: 80px;
                padding: 0.5rem;
            }
            
            .field-player-img {
                width: 50px;
                height: 65px;
            }
        }

        @media (max-width: 576px) {
            .header {
                padding: 0 1rem;
            }
            
            .search-bar {
                display: none;
            }
            
            .page {
                padding: 1rem;
            }
            
            .pitch-container {
                height: 600px;
                gap: 20px;
            }
            
            .field-player {
                min-width: 70px;
            }
            
            .field-player-img {
                width: 45px;
                height: 60px;
            }
            
            .bench-player {
                width: 80px;
                padding: 0.8rem 0.6rem;
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
                <a href="{{ route('fantasy-team.index') }}" class="nav-link active">
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
            <!-- <li class="nav-item">
                <a href="{{ route('transfers.index') }}" class="nav-link">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Transfers</span>
                </a>
            </li> -->
            <li class="nav-item">
                <a href="{{ route('fixtures.index') }}" class="nav-link">
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
            <h2>My Fantasy Team</h2>
            <div class="user-menu">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search...">
                </div>
                <div class="notification-bell">
                    <i class="fas fa-bell"></i>
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

        <div class="page">
            <div class="team-info">
                <div class="team-name">{{ $team->team_name }}</div>
                <div class="team-stats">
                    <div class="stat">
                        <div class="stat-value">{{ $totalPoints ?? 0 }}</div>
                        <div class="stat-label">Total Points</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">{{ $teamValue ?? '£0.0' }}m</div>
                        <div class="stat-label">Team Value</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">{{ $freeTransfers ?? 1 }}</div>
                        <div class="stat-label">Free Transfers</div>
                    </div>
                </div>
            </div>

            <!-- CHIPS SECTION
        <div class="chips-container">
            <div class="chip-card">
                <i class="fas fa-users chip-icon"></i>
                <div class="chip-info">
                    <h3>Bench Boost</h3>
                    <p>Play all 15 players' points this week</p>
                </div>
                <div class="chip-status available">Available</div>
                <button class="btn-chip" onclick="activateChip('bench-boost')">Activate</button>
                
            </div>

            <div class="chip-card">
                <i class="fas fa-crown chip-icon"></i>
                <div class="chip-info">
                    <h3>Triple Captain</h3>
                    <p>Triple your captain’s points</p>
                </div>
                <div class="chip-status available">Available</div>
                <button class="btn-chip" onclick="activateChip('triple-captain')">Activate</button>
            </div>

            <div class="chip-card">
                <i class="fas fa-random chip-icon"></i>
                <div class="chip-info">
                    <h3>Wildcard</h3>
                    <p>Unlimited transfers for one week</p>
                </div>
                <div class="chip-status available">Available</div>
                <button class="btn-chip" onclick="activateChip('wildcard')">Activate</button>
            </div>

            <div class="chip-card">
                <i class="fas fa-sync-alt chip-icon"></i>
                <div class="chip-info">
                    <h3>Free Hit</h3>
                    <p>Change your team for one week</p>
                </div>
                <div class="chip-status available">Available</div>
                <button class="btn-chip" onclick="activateChip('free-hit')">Activate</button>
            </div>
        </div> -->


            <div class="pitch-container">
                <div class="pitch-row" id="fwdRow"></div>
                <div class="pitch-row" id="midRow"></div>
                <div class="pitch-row" id="defRow"></div>
                <div class="pitch-row" id="gkRow"></div>
            </div>

            <div class="bench-container">
                <h3 class="bench-header">Bench</h3>
                <div class="bench-row" id="benchRow"></div>
            </div>
        </div>
    </div>

<script>
    const players = @json($mapped);   // Make sure this is not empty!

    console.log("Players received:", players); // ← Add this for debugging

    const grouped = { GK: [], DEF: [], MID: [], FWD: [] };

    players.forEach(p => {
        let pos = p.position;
        // Normalize position names
        if (pos === 'GKP') pos = 'GK';
        if (grouped[pos]) grouped[pos].push(p);
    });

    const layout = { GK: 1, DEF: 4, MID: 4, FWD: 2 };
    const columns = {
        GK: [6],
        DEF: [2, 5, 8, 11],
        MID: [2, 5, 8, 11],
        FWD: [5, 8]
    };

    const positionLabels = {
        'GK': 'Goalkeeper',
        'DEF': 'Defender',
        'MID': 'Midfielder',
        'FWD': 'Forward'
    };

    // Render Starting XI
    Object.entries(layout).forEach(([pos, max]) => {
        const row = document.getElementById(pos.toLowerCase() + 'Row');
        if (!row) return;

        row.innerHTML = ''; // Clear first

        grouped[pos].slice(0, max).forEach((p, i) => {
            const div = document.createElement('div');
            div.className = 'field-player draggable-player droppable-slot';
            div.setAttribute('draggable', 'true');
            div.setAttribute('data-player-id', p.id);
            div.setAttribute('data-position', p.position);
            div.style.gridColumn = `${columns[pos][i]} / span 2`;

            div.innerHTML = `
                <div class="player-points">${p.event_points ?? 0}</div>
                <img src="https://resources.premierleague.com/premierleague/photos/players/110x140/p${p.code}.png"
                     onerror="this.src='https://cdn-icons-png.flaticon.com/512/847/847969.png';" 
                     alt="${p.web_name}" class="field-player-img">
                <div class="field-player-name">${p.web_name}</div>
                <div class="player-position">${positionLabels[pos] || pos}</div>
            `;
            row.appendChild(div);
        });
    });

    // Render Bench
    const starters = Object.entries(layout)
        .flatMap(([pos, max]) => grouped[pos].slice(0, max));

    const benchPlayers = players.filter(p => !starters.some(s => s.id === p.id));
    const benchRow = document.getElementById('benchRow');
    benchRow.innerHTML = '';

    benchPlayers.slice(0, 4).forEach(p => {
        let pos = p.position;
        if (pos === 'GKP') pos = 'GK';

        const b = document.createElement('div');
        b.className = 'bench-player draggable-player droppable-slot';
        b.setAttribute('draggable', 'true');
        b.setAttribute('data-player-id', p.id);
        b.setAttribute('data-position', p.position);

        b.innerHTML = `
            <div class="player-points">${p.event_points ?? 0}</div>
            <img src="https://resources.premierleague.com/premierleague/photos/players/110x140/p${p.code}.png"
                 onerror="this.src='https://cdn-icons-png.flaticon.com/512/847/847969.png';"
                 alt="${p.web_name}">
            <span>${p.web_name}</span>
            <div class="bench-position">${positionLabels[pos] || pos}</div>
        `;
        benchRow.appendChild(b);
    });

    // Update total points
    function calculateTotalPoints() {
        let total = 0;
        document.querySelectorAll('.field-player .player-points').forEach(el => {
            total += parseInt(el.textContent) || 0;
        });
        const statEl = document.querySelector('.stat-value');
        if (statEl) statEl.textContent = total;
    }

    calculateTotalPoints();
</script>

</body>
</html>