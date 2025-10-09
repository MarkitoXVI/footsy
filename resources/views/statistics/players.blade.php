<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Player Statistics - Footsy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3a5ee5;
            --primary-dark: #2a48c5;
            --secondary: #34c759;
            --gray: #6c757d;
            --light-gray: #f1f3f8;
            --dark: #1a2238;
            --sidebar-bg: #1a2238;
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
            background: #f5f8fb;
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
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
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
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
            margin-bottom: 1.5rem;
        }

        /* Stats Dropdown */
        .stats-dropdown {
            position: relative;
        }

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

        .stats-dropdown-btn:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 8px rgba(58, 94, 229, 0.1);
        }

        .stats-dropdown-content {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: #fff;
        min-width: 220px;
        border-radius: 8px;
        box-shadow: 0 8px 16px rgba(0,0,0,.1);overflow: hidden;
}

        .stats-dropdown-content.active {
            display: block !important;
        }


        .stats-dropdown-content a {
            color: var(--dark);
            padding: 0.75rem 1rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .stats-dropdown-content a:hover {
            background-color: rgba(58, 94, 229, 0.05);
            border-left-color: var(--primary);
        }

        .stats-dropdown-content a.active {
            background-color: rgba(58, 94, 229, 0.1);
            border-left-color: var(--primary);
            color: var(--primary);
            font-weight: 600;
        }

        .stats-dropdown-content a i {
            width: 20px;
            text-align: center;
        }

        .stats-dropdown:hover .stats-dropdown-content {
            display: block;
        }

        /* Filters */
        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .filters input,
        .filters select {
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: white;
            font-size: 0.95rem;
            flex: 1;
            min-width: 180px;
        }

        .filters button {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.25rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filters button:hover {
            background: var(--primary-dark);
        }

        /* Table Container */
        .table-container {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 0.75rem;
            border-bottom: 1px solid var(--light-gray);
        }

        th {
            background: #fafbff;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }

        tr:hover {
            background: rgba(58,94,229,0.05);
        }

        .player-img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 0.5rem;
        }

        .player-name {
            display: flex;
            align-items: center;
        }

        .compare-btn {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 0.35rem 0.8rem;
            font-size: 0.8rem;
            cursor: pointer;
        }

        .compare-btn:hover {
            background: var(--primary-dark);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }

        .pagination a,
        .pagination span {
            padding: 0.5rem 0.9rem;
            border-radius: 6px;
            background: #fff;
            border: 1px solid #ddd;
            font-size: 0.9rem;
            color: var(--dark);
            text-decoration: none;
            transition: all 0.2s;
        }

        .pagination a:hover {
            background: var(--light-gray);
        }

        .pagination .active span {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .pagination .disabled span {
            color: var(--gray);
            background: #f8f9fa;
            cursor: not-allowed;
        }

        /* Compare Modal */
        .compare-modal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            align-items: center; justify-content: center;
            z-index: 999;
        }

        .compare-content {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .compare-close {
            float: right;
            font-size: 1.5rem;
            color: var(--gray);
            cursor: pointer;
            line-height: 1;
        }

        .compare-close:hover {
            color: var(--dark);
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
            
            .filters {
                flex-direction: column;
            }
            
            .filters input,
            .filters select {
                min-width: 100%;
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
        <h2>Player Statistics</h2>
        <div class="user-menu">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search...">
            </div>
            <div class="notification-bell">
                <i class="fas fa-bell"></i>
                <div class="notification-badge">3</div>
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
        <h1>Player Statistics</h1>
        
        <!-- Stats Switcher (Dropdown) -->
<div class="stats-dropdown" style="position:relative; display:inline-block;">
    <button class="stats-dropdown-btn" id="statsSwitcherBtn" aria-expanded="false">
        <i class="fas fa-chart-bar"></i>
        <span id="statsSwitcherLabel">
            @if(request()->routeIs('statistics.players')) Player Statistics
            @elseif(request()->routeIs('statistics.teams')) Team Statistics
            @else Overview
            @endif
        </span>
        <i class="fas fa-chevron-down" style="margin-left:.35rem;"></i>
    </button>

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

        <form method="GET" class="filters">
            <input type="text" name="search" placeholder="Search player..." value="{{ request('search') }}">
            <select name="team_id">
                <option value="">All Teams</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ request('team_id') == $team->id ? 'selected' : '' }}>
                        {{ $team->name }}
                    </option>
                @endforeach
            </select>
            <select name="position">
                <option value="">All Positions</option>
                <option value="GK">Goalkeepers</option>
                <option value="DEF">Defenders</option>
                <option value="MID">Midfielders</option>
                <option value="FWD">Forwards</option>
            </select>
            <button type="submit"><i class="fas fa-filter"></i> Filter</button>
        </form>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Player</th>
                        <th>Team</th>
                        <th>Position</th>
                        <th>Points</th>
                        <th>Goals</th>
                        <th>Assists</th>
                        <th>Price (£m)</th>
                        <th>Compare</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($players as $p)
                    <tr>
                        <td class="player-name">
                            <img src="https://resources.premierleague.com/premierleague/photos/players/110x140/p{{ $p->code ?? '0' }}.png" 
                                 onerror="this.src='https://cdn-icons-png.flaticon.com/512/847/847969.png';"
                                 alt="{{ $p->web_name }}" class="player-img">
                            {{ $p->web_name }}
                        </td>
                        <td>{{ $p->team->short_name ?? '-' }}</td>
                        <td>{{ $p->position_label }}</td>
                        <td>{{ $p->total_points }}</td>
                        <td>{{ $p->goals_scored }}</td>
                        <td>{{ $p->assists }}</td>
                        <td>{{ number_format($p->price,1) }}</td>
                        <td><button class="compare-btn" onclick="addToCompare('{{ $p->web_name }}', {{ $p->total_points }}, {{ $p->goals_scored }}, {{ $p->assists }}, {{ $p->price }})">Compare</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Compare Modal -->
<div class="compare-modal" id="compareModal">
    <div class="compare-content">
        <span class="compare-close" onclick="closeCompare()">&times;</span>
        <h2>Player Comparison</h2>
        <table class="compare-table" id="compareTable">
            <thead>
                <tr><th>Player</th><th>Points</th><th>Goals</th><th>Assists</th><th>Price (£m)</th></tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<script>
  const tableBody = document.querySelector("table tbody");
  const searchInput = document.querySelector("input[name='search']");
  const teamSelect = document.querySelector("select[name='team_id']");
  const positionSelect = document.querySelector("select[name='position']");
  const sortHeaders = document.querySelectorAll("th[data-sort]");

  let sortColumn = 'total_points';
  let sortDirection = 'desc';
  let typingTimer;

  async function fetchPlayers() {
    const params = new URLSearchParams({
      search: searchInput?.value || '',
      team_id: teamSelect?.value || '',
      position: positionSelect?.value || '',
      sort: sortColumn,
      direction: sortDirection
    });

    const res = await fetch(`{{ route('statistics.players') }}?${params.toString()}`, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    });

    if (!res.ok) {
      console.error('Failed to fetch players');
      return;
    }

    const data = await res.json();
    renderPlayers(data.players || []);
  }

  function renderPlayers(players) {
    tableBody.innerHTML = "";
    if (!players.length) {
      tableBody.innerHTML = `<tr><td colspan="8" style="text-align:center;">No players found</td></tr>`;
      return;
    }

    players.forEach(p => {
      const row = document.createElement('tr');
      const code = p.code ?? '0';
      const price = Number(p.price || 0).toFixed(1);

      row.innerHTML = `
        <td class="player-name">
          <img src="https://resources.premierleague.com/premierleague/photos/players/110x140/p${code}.png"
               onerror="this.src='https://cdn-icons-png.flaticon.com/512/847/847969.png';"
               alt="${p.web_name}" class="player-img">
          ${p.web_name}
        </td>
        <td>${p.team ? (p.team.short_name || p.team.name) : '-'}</td>
        <td>${p.position_label || ''}</td>
        <td>${p.total_points ?? 0}</td>
        <td>${p.goals_scored ?? 0}</td>
        <td>${p.assists ?? 0}</td>
        <td>${price}</td>
        <td>
          <button class="compare-btn"
            onclick="addToCompare('${p.web_name}', ${p.total_points ?? 0}, ${p.goals_scored ?? 0}, ${p.assists ?? 0}, ${price})">
            Compare
          </button>
        </td>
      `;
      tableBody.appendChild(row);
    });
  }

  // Live search
  if (searchInput) {
    searchInput.addEventListener("input", () => {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(fetchPlayers, 350);
    });
  }

  // Filter change
  teamSelect?.addEventListener("change", fetchPlayers);
  positionSelect?.addEventListener("change", fetchPlayers);

  // Sort headers
  sortHeaders.forEach(th => {
    th.style.cursor = 'pointer';
    th.addEventListener('click', () => {
      const col = th.getAttribute('data-sort');
      if (!col) return;
      sortDirection = (sortColumn === col && sortDirection === 'asc') ? 'desc' : 'asc';
      sortColumn = col;

      // Simple sort indicator
      sortHeaders.forEach(h => h.removeAttribute('data-dir'));
      th.setAttribute('data-dir', sortDirection);

      fetchPlayers();
    });
  });

  // Initial load
  fetchPlayers();
</script>


<script>
  (function () {
    const wrapper = document.querySelector('.stats-dropdown');
    const btn = document.getElementById('statsSwitcherBtn');
    const menu = document.getElementById('statsSwitcherMenu');

    function closeMenu() {
      wrapper.classList.remove('open');
      btn.setAttribute('aria-expanded', 'false');
      menu.setAttribute('aria-hidden', 'true');
    }

    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const isOpen = wrapper.classList.toggle('open');
      btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      menu.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
    });

    document.addEventListener('click', (e) => {
      if (!wrapper.contains(e.target)) closeMenu();
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeMenu();
    });
  })();
</script>


</body>
</html>