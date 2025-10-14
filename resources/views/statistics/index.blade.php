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
        .sidebar { width: 260px; background: var(--dark); color: white; height: 100vh; position: fixed; overflow-y: auto; }
        .sidebar-header { padding: 1.5rem 1rem; display: flex; align-items: center; gap: 10px; border-bottom: 1px solid rgba(255,255,255,.1); }
        .sidebar-logo { width: 36px; height: 36px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary); font-weight: 700; }
        .sidebar-title { font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 1.4rem; }
        .nav-item { list-style: none; margin-bottom: .25rem; }
        .nav-link { display: flex; align-items: center; padding: .875rem 1.5rem; color: rgba(255,255,255,.7); text-decoration: none; border-left: 4px solid transparent; transition: .3s; }
        .nav-link:hover, .nav-link.active { background: rgba(255,255,255,.05); color: #fff; border-left-color: var(--primary); }
        .nav-link i { margin-right: 12px; width: 20px; text-align: center; }

        .main { flex: 1; margin-left: 260px; }
        .header { background: #fff; height: 70px; box-shadow: 0 2px 10px rgba(0,0,0,.05); padding: 0 2rem; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; }

        .header-left { display: flex; align-items: center; gap: 1rem; }
        .header-left h2 { font-family: 'Montserrat', sans-serif; }

        .stats-dropdown { position: relative; }
        .stats-dropdown-btn {
            background: white;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            color: var(--dark);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }
        .stats-dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background: #fff;
            min-width: 220px;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0,0,0,.1);
            overflow: hidden;
        }
        .stats-dropdown:hover .stats-dropdown-content { display: block; }

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
            <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
            <li class="nav-item"><a href="{{ route('fantasy-team.index') }}" class="nav-link"><i class="fas fa-users"></i><span>My Team</span></a></li>
            <li class="nav-item"><a href="{{ route('leagues.index') }}" class="nav-link"><i class="fas fa-trophy"></i><span>Leagues</span></a></li>
            <li class="nav-item"><a href="{{ route('statistics.index') }}" class="nav-link active"><i class="fas fa-chart-line"></i><span>Statistics</span></a></li>
            <li class="nav-item"><a href="{{ route('transfers.index') }}" class="nav-link"><i class="fas fa-exchange-alt"></i><span>Transfers</span></a></li>
            <li class="nav-item"><a href="{{ route('fixtures.index') }}" class="nav-link"><i class="fas fa-calendar-alt"></i><span>Fixtures</span></a></li>
            <li class="nav-item"><a href="{{ route('help') }}" class="nav-link"><i class="fas fa-question-circle"></i><span>Help</span></a></li>
            <li class="nav-item"><a href="{{ route('profile.edit') }}" class="nav-link"><i class="fas fa-user"></i><span>Profile</span></a></li>
        </ul>
    </aside>

    <div class="main">
        <header class="header">
            <div class="header-left">
                <h2>Statistics</h2>
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
                @if($players->isNotEmpty())
                    <table class="stats-table">
                        <thead>
                            <tr>
                                <th>Player</th>
                                <th>Team</th>
                                <th>Pos</th>
                                <th>Pts</th>
                                <th>Goals</th>
                                <th>Assists</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($players as $p)
                                <tr>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->team }}</td>
                                    <td>{{ $p->position }}</td>
                                    <td>{{ $p->points }}</td>
                                    <td>{{ $p->goals }}</td>
                                    <td>{{ $p->assists }}</td>
                                    <td>£{{ number_format($p->price, 1) }}m</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No players found in your team yet.</p>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart: Top 5 global players
        new Chart(document.getElementById('topPlayersChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($topPlayers->pluck('name')) !!},
                datasets: [{
                    label: 'Points',
                    data: {!! json_encode($topPlayers->pluck('points')) !!},
                    backgroundColor: 'rgba(58,94,229,0.8)'
                }]
            },
            options: { plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true}} }
        });

        // Chart: Team position breakdown
        const posData = {!! json_encode($positionBreakdown) !!};

        new Chart(document.getElementById('positionChart'), {
    type: 'pie',
    data: {
        labels: ['Goalkeepers', 'Defenders', 'Midfielders', 'Forwards'],
        datasets: [{
            data: [
                posData.GK ?? 0,
                posData.DEF ?? 0,
                posData.MID ?? 0,
                posData.FWD ?? 0
            ],
            backgroundColor: [
                'rgba(58,94,229,0.8)',  // GK - Blue
                'rgba(52,199,89,0.8)',  // DEF - Green
                'rgba(255,193,7,0.8)',  // MID - Yellow
                'rgba(255,99,132,0.8)'  // FWD - Red
            ]
        }]
    },
    options: {
        plugins: {
            legend: { position: 'bottom' }
        }
    }
});

    </script>
</body>
</html>
