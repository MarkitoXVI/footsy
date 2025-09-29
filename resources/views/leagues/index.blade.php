<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leagues - Footsy Fantasy FootballV</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3a5ee5;
            --primary-dark: #2a48c5;
            --secondary: #34c759;
            --danger: #e53e3e;
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
        
        /* Leagues Content */
        .leagues-content {
            padding: 2rem;
        }
        
        .leagues-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .leagues-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
        }
        
        .create-league-btn {
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
        
        .create-league-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(58, 94, 229, 0.3);
        }
        
        /* League Cards */
        .league-section {
            margin-bottom: 3rem;
        }
        
        .section-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.4rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--light-gray);
        }
        
        .league-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .league-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        
        .league-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .league-name {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        .league-code {
            background: rgba(58, 94, 229, 0.1);
            color: var(--primary);
            padding: 0.25rem 0.75rem;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .league-status {
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .status-joined {
            background: rgba(52, 199, 89, 0.1);
            color: var(--secondary);
        }
        
        .status-public {
            background: rgba(58, 94, 229, 0.1);
            color: var(--primary);
        }
        
        .status-private {
            background: rgba(108, 117, 125, 0.1);
            color: var(--gray);
        }
        
        .status-pending {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }
        
        .league-details {
            display: flex;
            gap: 2rem;
            margin-bottom: 1rem;
        }
        
        .league-detail {
            display: flex;
            flex-direction: column;
        }
        
        .detail-value {
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--primary);
        }
        
        .detail-label {
            font-size: 0.8rem;
            color: var(--gray);
        }
        
        .league-description {
            color: var(--gray);
            margin-bottom: 1rem;
            line-height: 1.5;
        }
        
        .league-admin {
            font-size: 0.9rem;
            color: var(--gray);
            margin-bottom: 1rem;
        }
        
        .league-actions {
            display: flex;
            gap: 1rem;
        }
        
        .league-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background: var(--gradient);
            color: white;
        }
        
        .btn-primary:hover {
            opacity: 0.9;
        }
        
        .btn-secondary {
            background: white;
            color: var(--primary);
            border: 1px solid var(--primary);
        }
        
        .btn-secondary:hover {
            background: rgba(58, 94, 229, 0.1);
        }
        
        .btn-danger {
            background: white;
            color: var(--danger);
            border: 1px solid var(--danger);
        }
        
        .btn-danger:hover {
            background: rgba(229, 62, 62, 0.1);
        }
        
        .btn-disabled {
            background: var(--light-gray);
            color: var(--gray);
            cursor: not-allowed;
        }
        
        /* Search and Filter */
        .search-filter {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            align-items: center;
        }
        
        .search-box {
            position: relative;
            flex: 1;
        }
        
        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            font-size: 1rem;
        }
        
        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }
        
        .filter-select {
            padding: 0.75rem 1rem;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            background: white;
            font-size: 1rem;
            color: var(--dark);
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
        
        /* Empty State */
        .empty-state {
            background: white;
            border-radius: 12px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .empty-icon {
            font-size: 3rem;
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
            .league-details {
                flex-wrap: wrap;
                gap: 1rem;
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
            
            .leagues-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .search-filter {
                flex-direction: column;
                align-items: stretch;
            }
            
            .league-actions {
                flex-direction: column;
            }
        }
        
        @media (max-width: 576px) {
            .leagues-content {
                padding: 1rem;
            }
            
            .header {
                padding: 0 1rem;
            }
            
            .league-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
            
            .league-status {
                align-self: flex-start;
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
                <a href="{{ route('leagues.index') }}" class="nav-link active">
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

        <!-- Leagues Content -->
        <div class="leagues-content">
            <div class="leagues-header">
                <h1 class="leagues-title">Leagues</h1>
                <a href="{{ route('leagues.create') }}" class="create-league-btn">
                    <i class="fas fa-plus"></i> Create New League
                </a>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Search and Filter -->
            <div class="search-filter">
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Search leagues...">
                </div>
                <select class="filter-select">
                    <option value="all">All Leagues</option>
                    <option value="public">Public Leagues</option>
                    <option value="private">Private Leagues</option>
                    <option value="joined">Leagues I've Joined</option>
                </select>
            </div>

            <!-- My Leagues Section -->
            <div class="league-section">
                <h2 class="section-title">My Leagues</h2>
                
                @if($userLeagues->count() > 0)
                    @foreach($userLeagues as $league)
                    <div class="league-card">
                        <div class="league-header">
                            <div>
                                <h3 class="league-name">{{ $league->name }}</h3>
                                <div class="league-code">Code: {{ $league->code }}</div>
                            </div>
                            <span class="league-status status-joined">Joined</span>
                        </div>
                        <p class="league-description">{{ $league->scoring_system === 'standard' ? 'Standard scoring league' : '' }}</p>
                        <p class="league-admin">Admin: {{ optional($league->admin)->name }} • Created: {{ $league->created_at?->format('F j, Y') }}</p>
                        <div class="league-details">
                            <div class="league-detail">
                                <span class="detail-value">{{ $league->participants_count }}/{{ $league->max_participants ?? '∞' }}</span>
                                <span class="detail-label">Participants</span>
                            </div>
                            <div class="league-detail">
                                <span class="detail-value">{{ ucfirst($league->type) }}</span>
                                <span class="detail-label">Privacy</span>
                            </div>
                            <div class="league-detail">
                                <span class="detail-value">--</span>
                                <span class="detail-label">Your Rank</span>
                            </div>
                        </div>
                        <div class="league-actions">
                            <a class="league-btn btn-primary" href="{{ route('leagues.show', $league) }}">View Standings</a>
                            @if($league->admin_id != Auth::id())
                                <button class="league-btn btn-danger" onclick="leaveLeague({{ $league->id }}, @json($league->name))">Leave League</button>
                            @else
                                <button class="league-btn btn-danger" onclick="deleteLeague({{ $league->id }}, @json($league->name))">Delete League</button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h3 class="empty-title">No Leagues Joined</h3>
                        <p class="empty-text">You haven't joined any leagues yet. Join a league or create your own to start competing!</p>
                        <a href="{{ route('leagues.create') }}" class="create-league-btn">Create a League</a>
                    </div>
                @endif
            </div>

            <!-- Other Leagues Section -->
            <div class="league-section">
                <h2 class="section-title">Other Leagues</h2>
                
                @if($otherLeagues->count() > 0)
                    @foreach($otherLeagues as $league)
                    <div class="league-card">
                        <div class="league-header">
                            <div>
                                <h3 class="league-name">{{ $league->name }}</h3>
                                <div class="league-code">Code: {{ $league->code }}</div>
                            </div>
                            <span class="league-status status-{{ $league->type }}">{{ ucfirst($league->type) }}</span>
                        </div>
                        <p class="league-description">{{ $league->scoring_system === 'standard' ? 'Standard scoring league' : '' }}</p>
                        <p class="league-admin">Admin: {{ optional($league->admin)->name }} • Created: {{ $league->created_at?->format('F j, Y') }}</p>
                        <div class="league-details">
                            <div class="league-detail">
                                <span class="detail-value">{{ $league->participants_count }}/{{ $league->max_participants ?? '∞' }}</span>
                                <span class="detail-label">Participants</span>
                            </div>
                            <div class="league-detail">
                                <span class="detail-value">{{ ucfirst($league->type) }}</span>
                                <span class="detail-label">Privacy</span>
                            </div>
                        </div>
                        <div class="league-actions">
                            @if($league->type == 'public')
                                <button class="league-btn btn-primary" onclick="joinLeague({{ $league->id }}, @json($league->name))">Join League</button>
                            @else
                                <button class="league-btn btn-primary" onclick="requestToJoin({{ $league->id }}, @json($league->name))">Request to Join</button>
                            @endif
                            <a class="league-btn btn-secondary" href="{{ route('leagues.show', $league) }}">View Details</a>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="empty-title">No Other Leagues Available</h3>
                        <p class="empty-text">There are no other leagues available to join at the moment.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    
    <script>
        // League actions
        function joinLeague(leagueId, leagueName) {
            if (confirm(`Are you sure you want to join "${leagueName}"?`)) {
                window.location.href = `/leagues/${leagueId}/join`;
            }
        }

        function requestToJoin(leagueId, leagueName) {
            alert(`Join request sent for "${leagueName}". Waiting for approval.`);
            // In real app, make API call to request joining
        }

        function leaveLeague(leagueId, leagueName) {
            if (confirm(`Are you sure you want to leave "${leagueName}"?`)) {
                window.location.href = `/leagues/${leagueId}/leave`;
            }
        }

        function deleteLeague(leagueId, leagueName) {
            if (confirm(`Are you sure you want to delete "${leagueName}"? This action cannot be undone.`)) {
                alert(`League "${leagueName}" deleted successfully.`);
                // In real app, make API call to delete league
            }
        }

        // standings handled via anchor links

        function viewLeagueDetails(leagueId) {
            alert(`Showing details for league ID: ${leagueId}`);
            // In real app, show league details modal
        }

        // Search and filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.search-input');
            const leagueCards = document.querySelectorAll('.league-card');
            const filterSelect = document.querySelector('.filter-select');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                leagueCards.forEach(card => {
                    const leagueName = card.querySelector('.league-name').textContent.toLowerCase();
                    const leagueDescription = card.querySelector('.league-description').textContent.toLowerCase();
                    
                    if (leagueName.includes(searchTerm) || leagueDescription.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });

            filterSelect.addEventListener('change', function() {
                const filterValue = this.value;
                
                leagueCards.forEach(card => {
                    if (filterValue === 'all') {
                        card.style.display = 'block';
                    } else if (filterValue === 'joined') {
                        const status = card.querySelector('.league-status').textContent;
                        if (status === 'Joined') {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    } else if (filterValue === 'public') {
                        const status = card.querySelector('.league-status').textContent;
                        if (status === 'Public') {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    } else if (filterValue === 'private') {
                        const status = card.querySelector('.league-status').textContent;
                        if (status === 'Private') {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>