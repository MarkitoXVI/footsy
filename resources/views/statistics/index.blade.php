<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Statistics Overview - Footsy</title>
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
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Open Sans', sans-serif; color: var(--dark); background: #f5f7ff; display: flex; }

        /* Sidebar */
        .sidebar { width: 260px; background: var(--dark); color: white; height: 100vh; position: fixed; overflow-y: auto; }
        .sidebar-header { padding: 1.5rem 1rem; display: flex; align-items: center; gap: 10px; border-bottom: 1px solid rgba(255,255,255,.1); }
        .sidebar-logo { width: 36px; height: 36px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary); font-weight: 700; }
        .sidebar-title { font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 1.4rem; }
        .nav-item { list-style: none; margin-bottom: .25rem; }
        .nav-link { display: flex; align-items: center; padding: .875rem 1.5rem; color: rgba(255,255,255,.7); text-decoration: none; border-left: 4px solid transparent; transition: .3s; }
        .nav-link:hover, .nav-link.active { background: rgba(255,255,255,.05); color: #fff; border-left-color: var(--primary); }
        .nav-link i { margin-right: 12px; width: 20px; text-align: center; }

        /* Main Layout */
        .main { flex: 1; margin-left: 260px; }
        .header { background: #fff; height: 70px; box-shadow: 0 2px 10px rgba(0,0,0,.05); padding: 0 2rem; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; }

        .header-left { display: flex; align-items: center; gap: 1rem; }
        .header-left h2 { font-family: 'Montserrat', sans-serif; }

        /* Dropdown Menu */
        .dropdown { position: relative; }
        .dropdown select {
            background: var(--gradient);
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            padding: .6rem 1.2rem;
            cursor: pointer;
            font-family: 'Montserrat', sans-serif;
            transition: background .2s;
        }
        .dropdown select:hover { background: var(--primary-dark); }
        .dropdown select option { color: #000; background: #fff; }

        .user-avatar { width: 40px; height: 40px; border-radius: 50%; background: var(--gradient); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; }

        /* Content */
        .page { padding: 2rem; }
        .cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .card { background: #fff; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,.05); padding: 1.5rem; text-align: center; }
        .card h3 { font-family: 'Montserrat', sans-serif; font-size: 1rem; color: var(--gray); }
        .card .value { font-size: 1.8rem; font-weight: 700; color: var(--primary); margin-top: .25rem; }

        .charts { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
        .chart-card { background: #fff; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,.05); padding: 1.5rem; }
        .chart-card h3 { font-family: 'Montserrat', sans-serif; font-weight: 600; font-size: 1.2rem; margin-bottom: 1rem; }

        .table-container { margin-top: 2rem; background: #fff; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,.05); padding: 1.5rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: .75rem; border-bottom: 1px solid var(--light-gray); text-align: left; }
        th { font-family: 'Montserrat', sans-serif; background: #fafbff; }

        @media (max-width: 992px) {
            .charts { grid-template-columns: 1fr; }
            .dropdown select { font-size: .9rem; padding: .5rem 1rem; }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">F</div>
            <div class="sidebar-title">Footsy</div>
        </div>

        <ul class="sidebar-nav">
            <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
            <li class="nav-item"><a href="{{ route('fantasy-team.index') }}" class="nav-link {{ request()->routeIs('fantasy-team.*') ? 'active' : '' }}"><i class="fas fa-users"></i><span>My Team</span></a></li>
            <li class="nav-item"><a href="{{ route('leagues.index') }}" class="nav-link {{ request()->routeIs('leagues.*') ? 'active' : '' }}"><i class="fas fa-trophy"></i><span>Leagues</span></a></li>
            <li class="nav-item"><a href="{{ route('statistics.index') }}" class="nav-link {{ request()->routeIs('statistics.*') ? 'active' : '' }}"><i class="fas fa-chart-line"></i><span>Statistics</span></a></li>
            <li class="nav-item"><a href="{{ route('transfers.index') }}" class="nav-link {{ request()->routeIs('transfers.*') ? 'active' : '' }}"><i class="fas fa-exchange-alt"></i><span>Transfers</span></a></li>
            <li class="nav-item"><a href="{{ route('fixtures.index') }}" class="nav-link {{ request()->routeIs('fixtures.*') ? 'active' : '' }}"><i class="fas fa-calendar-alt"></i><span>Fixtures</span></a></li>
            <li class="nav-item"><a href="{{ route('help') }}" class="nav-link {{ request()->routeIs('help') ? 'active' : '' }}"><i class="fas fa-question-circle"></i><span>Help & Support</span></a></li>
            <li class="nav-item"><a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}"><i class="fas fa-user"></i><span>Profile</span></a></li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i><span>Log Out</span>
                    </a>
                </form>
            </li>
        </ul>
    </aside>

    <!-- Main -->
    <div class="main">
        <header class="header">
            <div class="header-left">
                <h2>Statistics</h2>
                <div class="stats-dropdown-content" id="statsSwitcherMenu" role="menu" aria-hidden="true" style="z-index: 101;">
        <a href="{{ route('statistics.index') }}" class="{{ request()->routeIs('statistics.index') ? 'active' : '' }}">
            <i class="fas fa-chart-pie"></i> Overview
        </a>
        <a href="{{ route('statistics.players') }}" class="{{ request()->routeIs('statistics.players') ? 'active' : '' }}">
            <i class="fas fa-user"></i> Player Stats
        </a>
        <a href="{{ route('statistics.teams') }}" class="{{ request()->routeIs('statistics.teams') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Team Stats
        </a>
    </div>
            </div>
            <div style="display:flex;align-items:center;gap:.75rem">
                <span>{{ $user->name ?? 'Guest' }}</span>
                <div class="user-avatar">{{ substr($user->name ?? 'U',0,1) }}</div>
            </div>
        </header>

        <div class="page">
            <h1 style="font-family:'Montserrat',sans-serif;font-size:1.8rem;margin-bottom:1rem;">Your Team Summary</h1>

            <div class="cards">
                <div class="card"><h3>Total Points</h3><div class="value">{{ $totalPoints ?? 0 }}</div></div>
                <div class="card"><h3>Team Value (£m)</h3><div class="value">{{ number_format($teamValue ?? 0,1) }}</div></div>
                <div class="card"><h3>Goals Scored</h3><div class="value">{{ $totalGoals ?? 0 }}</div></div>
                <div class="card"><h3>Assists</h3><div class="value">{{ $totalAssists ?? 0 }}</div></div>
                <div class="card"><h3>Average Form</h3><div class="value">{{ number_format($avgForm ?? 0,1) }}</div></div>
            </div>

            <div class="charts">
                <div class="chart-card">
                    <h3>Top 5 Players (Total Points)</h3>
                    <canvas id="topPlayersChart" height="180"></canvas>
                </div>
                <div class="chart-card">
                    <h3>Team Breakdown by Position</h3>
                    <canvas id="positionChart" height="180"></canvas>
                </div>
            </div>

            <div class="table-container">
                <h3 style="font-family:'Montserrat',sans-serif;font-size:1.3rem;">Your Team Players</h3>
                <table>
                    <thead>
                        <tr><th>Player</th><th>Team</th><th>Pos</th><th>Points</th><th>Goals</th><th>Assists</th><th>Price (£m)</th></tr>
                    </thead>
                    <tbody>
                        @forelse($players as $p)
                            <tr>
                                <td>{{ $p->full_name ?? $p->web_name }}</td>
                                <td>{{ $p->team?->short_name }}</td>
                                <td>{{ $p->position_label }}</td>
                                <td>{{ $p->total_points }}</td>
                                <td>{{ $p->goals_scored }}</td>
                                <td>{{ $p->assists }}</td>
                                <td>£{{ number_format($p->price,1) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="7" style="text-align:center;color:var(--gray)">No players in your team yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart 1: Top 5 Players
        const ctx = document.getElementById('topPlayersChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($topPlayers->pluck('web_name')) !!},
                datasets: [{
                    label: 'Points',
                    data: {!! json_encode($topPlayers->pluck('total_points')) !!},
                    backgroundColor: 'rgba(58,94,229,0.8)'
                }]
            },
            options: { plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true}} }
        });

        // Chart 2: Team Position Breakdown
        const posCtx = document.getElementById('positionChart').getContext('2d');
        const posData = {!! json_encode($players->groupBy('position_label')->map->count()) !!};
        new Chart(posCtx, {
            type: 'pie',
            data: {
                labels: Object.keys(posData),
                datasets: [{
                    data: Object.values(posData),
                    backgroundColor: [
                        'rgba(58,94,229,0.8)',
                        'rgba(52,199,89,0.8)',
                        'rgba(255,193,7,0.8)',
                        'rgba(255,99,132,0.8)'
                    ]
                }]
            }
        });
    </script>
</body>
</html>
