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
        
        /* Team Content */
        .team-content {
            padding: 2rem;
        }
        
        .team-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .team-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
        }
        
        .create-team-btn {
            padding: 0.75rem 1.5rem;
            background: var(--gradient);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        
        .create-team-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(58, 94, 229, 0.3);
        }
        
        .team-stats {
            display: flex;
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .stat-item {
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .stat-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.25rem;
        }
        
        .stat-label {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        /* Success Message */
        .alert-success {
            background: rgba(52, 199, 89, 0.1);
            border: 1px solid rgba(52, 199, 89, 0.2);
            color: var(--secondary);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        /* Football Pitch */
        .pitch-container {
            background: linear-gradient(#2e7d32, #1b5e20);
            border: 2px solid #1b5e20;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .pitch {
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 50 L100 50 M50 0 L50 100 M0 0 L100 100 M100 0 L0 100' stroke='%23ffffff' stroke-width='0.5' stroke-opacity='0.1' fill='none'/%3E%3Ccircle cx='50' cy='50' r='10' stroke='%23ffffff' stroke-width='0.5' stroke-opacity='0.1' fill='none'/%3E%3C/svg%3E");
            background-size: 100px 100px;
            min-height: 500px;
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
        
        /* Player Slot */
        .player-slot {
            width: 80px;
            height: 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .player-slot:hover {
            transform: translateY(-5px);
        }
        
        .slot-circle {
            width: 60px;
            height: 60px;
            border: 2px dashed rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .player-slot:hover .slot-circle {
            border-color: rgba(255, 255, 255, 0.8);
            background: rgba(255, 255, 255, 0.2);
        }
        
        .slot-circle i {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.7);
        }
        
        .player-slot:hover .slot-circle i {
            color: white;
        }
        
        .slot-position {
            color: white;
            font-size: 0.8rem;
            text-align: center;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }
        
        /* Substitute Bench */
        .substitutes {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .substitutes-header {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .substitutes-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }
        
        .substitute-slot {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            border: 2px dashed var(--light-gray);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .substitute-slot:hover {
            border-color: var(--primary);
            background: rgba(58, 94, 229, 0.05);
        }
        
        .substitute-circle {
            width: 50px;
            height: 50px;
            border: 2px dashed var(--light-gray);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .substitute-slot:hover .substitute-circle {
            border-color: var(--primary);
        }
        
        .substitute-circle i {
            font-size: 1.2rem;
            color: var(--gray);
        }
        
        .substitute-slot:hover .substitute-circle i {
            color: var(--primary);
        }
        
        .substitute-label {
            color: var(--gray);
            font-size: 0.8rem;
        }
        
        /* Empty State */
        .empty-state {
            background: white;
            border-radius: 12px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
        
        .empty-icon {
            font-size: 4rem;
            color: var(--light-gray);
            margin-bottom: 1rem;
        }
        
        .empty-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.4rem;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }
        
        .empty-text {
            color: var(--gray);
            margin-bottom: 1.5rem;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .pitch {
                min-height: 400px;
            }
            
            .player-slot {
                width: 70px;
                height: 90px;
            }
            
            .slot-circle {
                width: 50px;
                height: 50px;
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
            
            .team-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .team-stats {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .substitutes-grid {
                grid-template-columns: repeat(2, 1fr);
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
                min-height: 300px;
            }
            
            .player-slot {
                width: 60px;
                height: 80px;
            }
            
            .slot-circle {
                width: 40px;
                height: 40px;
            }
            
            .slot-circle i {
                font-size: 1.2rem;
            }
            
            .substitutes-grid {
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

        <!-- Team Content -->
        <div class="team-content">
            <div class="team-header">
                <h1 class="team-title">My Fantasy Team</h1>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(!$fantasyTeam)
                <!-- Empty State - No Team Created -->
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="empty-title">No Team Created Yet</h3>
                    <p class="empty-text">You haven't created a fantasy team yet. Build your dream team by selecting players for each position.</p>
                    <a href="{{ route('fantasy-team.create') }}" class="create-team-btn">Create Your Team</a>
                </div>
            @else
                <!-- Team Stats -->
                <div class="team-stats">
                    <div class="stat-item">
                        <div class="stat-value">£{{ number_format($fantasyTeam->budget, 1) }}m</div>
                        <div class="stat-label">Remaining Budget</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">{{ $fantasyTeam->players->count() }}/15</div>
                        <div class="stat-label">Players Selected</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">{{ $fantasyTeam->total_points }}</div>
                        <div class="stat-label">Total Points</div>
                    </div>
                </div>

                <!-- Football Pitch with Player Slots -->
                <div class="pitch-container">
                    <div class="pitch">
                        <!-- Goalkeeper -->
                        <div class="position-row goalkeeper-row">
                            <div class="player-slot" onclick="window.location.href='{{ route('players.select', ['position' => 'goalkeeper']) }}'">
                                <div class="slot-circle">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="slot-position">Goalkeeper</div>
                            </div>
                        </div>
                        
                        <!-- Defenders -->
                        <div class="position-row defenders-row">
                            @for($i = 0; $i < 4; $i++)
                                <div class="player-slot" onclick="window.location.href='{{ route('players.select', ['position' => 'defender']) }}'">
                                    <div class="slot-circle">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div class="slot-position">Defender</div>
                                </div>
                            @endfor
                        </div>
                        
                        <!-- Midfielders -->
                        <div class="position-row midfielders-row">
                            @for($i = 0; $i < 4; $i++)
                                <div class="player-slot" onclick="window.location.href='{{ route('players.select', ['position' => 'midfielder']) }}'">
                                    <div class="slot-circle">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div class="slot-position">Midfielder</div>
                                </div>
                            @endfor
                        </div>
                        
                        <!-- Forwards -->
                        <div class="position-row forwards-row">
                            @for($i = 0; $i < 2; $i++)
                                <div class="player-slot" onclick="window.location.href='{{ route('players.select', ['position' => 'forward']) }}'">
                                    <div class="slot-circle">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div class="slot-position">Forward</div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Substitute Bench -->
                <div class="substitutes">
                    <h3 class="substitutes-header">Substitutes</h3>
                    <div class="substitutes-grid">
                        <div class="substitute-slot" onclick="window.location.href='{{ route('players.select', ['position' => 'goalkeeper']) }}'">
                            <div class="substitute-circle">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="substitute-label">Goalkeeper</div>
                        </div>
                        <div class="substitute-slot" onclick="window.location.href='{{ route('players.select', ['position' => 'defender']) }}'">
                            <div class="substitute-circle">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="substitute-label">Defender</div>
                        </div>
                        <div class="substitute-slot" onclick="window.location.href='{{ route('players.select', ['position' => 'midfielder']) }}'">
                            <div class="substitute-circle">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="substitute-label">Midfielder</div>
                        </div>
                        <div class="substitute-slot" onclick="window.location.href='{{ route('players.select', ['position' => 'forward']) }}'">
                            <div class="substitute-circle">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="substitute-label">Forward</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation to player slots
            const playerSlots = document.querySelectorAll('.player-slot, .substitute-slot');
            
            playerSlots.forEach(slot => {
                slot.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                
                slot.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
            
            // Add pulse animation to plus icons
            const plusIcons = document.querySelectorAll('.fa-plus');
            
            setInterval(() => {
                plusIcons.forEach(icon => {
                    icon.style.transition = 'all 0.5s ease';
                    icon.style.transform = 'scale(1.1)';
                    
                    setTimeout(() => {
                        icon.style.transform = 'scale(1)';
                    }, 500);
                });
            }, 2000);
        });
    </script>
</body>
</html>