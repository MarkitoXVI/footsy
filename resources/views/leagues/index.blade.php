<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leagues - Footsy Fantasy Football</title>
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
        
        .status-admin {
            background: rgba(58, 94, 229, 0.2);
            color: var(--primary);
            border: 1px solid var(--primary);
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
            text-decoration: none;
            display: inline-block;
            font-size: 0.9rem;
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
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        .modal-content {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .modal-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .modal-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.4rem;
            font-weight: 600;
        }
        
        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--gray);
        }
        
        .modal-body {
            margin-bottom: 2rem;
        }
        
        .modal-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
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
            <div class="alert-success" id="successMessage" style="display: none;">
                <i class="fas fa-check-circle"></i>
                <span id="successText"></span>
            </div>

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

                <!-- Leagues where user is admin -->
                @if($myLeagues->where('is_admin', true)->count() > 0)
                    @foreach($myLeagues->where('is_admin', true) as $league)
                        <div class="league-card">
                            <div class="league-header">
                                <div>
                                    <h3 class="league-name">{{ $league->name }}</h3>
                                    <div class="league-code">Code: {{ $league->code }}</div>
                                </div>
                                <span class="league-status status-admin">Admin</span>
                            </div>
                            <p class="league-description">{{ $league->description ?? 'No description provided' }}</p>
                            <p class="league-admin">Admin: {{ Auth::user()->name }} • Created: {{ $league->created_at->format('F j, Y') }}</p>
                            <div class="league-details">
                                <div class="league-detail">
                                    <span class="detail-value">{{ $league->participants_count ?? 1 }}</span>
                                    <span class="detail-label">Participants</span>
                                </div>
                                <div class="league-detail">
                                    <span class="detail-value">{{ ucfirst($league->privacy) }}</span>
                                    <span class="detail-label">Privacy</span>
                                </div>
                                <div class="league-detail">
                                    <span class="detail-value">-</span>
                                    <span class="detail-label">Your Rank</span>
                                </div>
                            </div>
                            <div class="league-actions">
                                <a class="league-btn btn-primary" href="{{ route('leagues.show', $league->id) }}">Manage League</a>
                                <form method="POST" action="{{ route('leagues.destroy', $league->id) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="league-btn btn-danger" onclick="deleteLeague({{ $league->id }}, '{{ $league->name }}')">Delete League</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h3 class="empty-title">No Leagues Created</h3>
                        <p class="empty-text">You haven't created any leagues yet. Create your first league to start competing with friends!</p>
                        <a href="{{ route('leagues.create') }}" class="create-league-btn">
                            <i class="fas fa-plus"></i> Create Your First League
                        </a>
                    </div>
                @endif

                <!-- Leagues where user is participant (not admin) -->
                @if($myLeagues->where('is_admin', false)->count() > 0)
                    @foreach($myLeagues->where('is_admin', false) as $league)
                        <div class="league-card">
                            <div class="league-header">
                                <div>
                                    <h3 class="league-name">{{ $league->name }}</h3>
                                </div>
                                <span class="league-status status-joined">Joined</span>
                            </div>
                            <p class="league-description">{{ $league->description ?? 'No description provided' }}</p>
                            <p class="league-admin">Admin: {{ $league->admin->name ?? 'Unknown' }} • Created: {{ $league->created_at->format('F j, Y') }}</p>
                            <div class="league-details">
                                <div class="league-detail">
                                    <span class="detail-value">{{ $league->participants_count ?? 1 }}</span>
                                    <span class="detail-label">Participants</span>
                                </div>
                                <div class="league-detail">
                                    <span class="detail-value">{{ ucfirst($league->privacy) }}</span>
                                    <span class="detail-label">Privacy</span>
                                </div>
                                <div class="league-detail">
                                    <span class="detail-value">{{ $league->user_rank ?? '-' }}</span>
                                    <span class="detail-label">Your Rank</span>
                                </div>
                            </div>
                            <div class="league-actions">
                                <a class="league-btn btn-primary" href="{{ route('leagues.show', $league->id) }}">View Standings</a>
                                <button class="league-btn btn-danger" onclick="leaveLeague({{ $league->id }}, '{{ $league->name }}')">Leave League</button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Other Leagues Section -->
            <div class="league-section">
                <h2 class="section-title">Other Leagues</h2>

                <!-- Public leagues the user hasn't joined -->
                @if($otherLeagues->count() > 0)
                    @foreach($otherLeagues as $league)
                        <div class="league-card">
                            <div class="league-header">
                                <div>
                                    <h3 class="league-name">{{ $league->name }}</h3>
                                    <div class="league-code">Code: {{ $league->code }}</div>
                                </div>
                                <span class="league-status status-public">Public</span>
                            </div>
                            <p class="league-description">{{ $league->description ?? 'No description provided' }}</p>
                            <p class="league-admin">Admin: {{ $league->admin->name ?? 'Unknown' }} • Created: {{ $league->created_at->format('F j, Y') }}</p>
                            <div class="league-details">
                                <div class="league-detail">
                                    <span class="detail-value">{{ $league->participants_count ?? 0 }}</span>
                                    <span class="detail-label">Participants</span>
                                </div>
                                <div class="league-detail">
                                    <span class="detail-value">Public</span>
                                    <span class="detail-label">Privacy</span>
                                </div>
                            </div>
                            <div class="league-actions">
                                <form method="POST" action="{{ route('leagues.join', $league->id) }}">
                                    @csrf
                                    <button type="submit" class="league-btn btn-primary">Join League</button>
                                </form>
                                <a class="league-btn btn-secondary" href="{{ route('leagues.show', $league->id) }}">View Details</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="empty-title">No Other Leagues Available</h3>
                        <p class="empty-text">There are no other public leagues available to join at the moment.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Confirmation Modal -->
        <div class="modal" id="confirmationModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalTitle">Confirm Action</h3>
                    <button class="close-modal" onclick="closeModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage">Are you sure you want to perform this action?</p>
                </div>
                <div class="modal-actions">
                    <button class="league-btn btn-secondary" onclick="closeModal()">Cancel</button>
                    <button class="league-btn btn-primary" id="confirmAction">Confirm</button>
                </div>
            </div>
        </div>

        <script>
            // Modal functionality
            let currentAction = null;
            let currentLeagueId = null;

            function showModal(title, message, confirmCallback) {
                document.getElementById('modalTitle').textContent = title;
                document.getElementById('modalMessage').textContent = message;
                document.getElementById('confirmationModal').style.display = 'flex';
                currentAction = confirmCallback;
            }

            function closeModal() {
                document.getElementById('confirmationModal').style.display = 'none';
                currentAction = null;
                currentLeagueId = null;
            }

            function showSuccess(message) {
                const successMessage = document.getElementById('successMessage');
                const successText = document.getElementById('successText');
                successText.textContent = message;
                successMessage.style.display = 'flex';
                
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 5000);
            }

            // League actions
            function joinLeague(leagueId, leagueName) {
                showModal(
                    'Join League',
                    `Are you sure you want to join "${leagueName}"?`,
                    () => {
                        // Simulate API call
                        setTimeout(() => {
                            showSuccess(`Successfully joined "${leagueName}"!`);
                            closeModal();
                            // In real app, refresh the page or update UI
                        }, 1000);
                    }
                );
                currentLeagueId = leagueId;
            }

            function leaveLeague(leagueId, leagueName) {
                showModal(
                    'Leave League',
                    `Are you sure you want to leave "${leagueName}"? You will lose all your progress in this league.`,
                    () => {
                        // Simulate API call
                        setTimeout(() => {
                            showSuccess(`Successfully left "${leagueName}".`);
                            closeModal();
                            // In real app, remove the league card from UI
                            const leagueCard = document.querySelector(`[onclick*="${leagueId}"]`)?.closest('.league-card');
                            if (leagueCard) {
                                leagueCard.style.display = 'none';
                            }
                        }, 1000);
                    }
                );
                currentLeagueId = leagueId;
            }

            function deleteLeague(leagueId, leagueName) {
                showModal(
                    'Delete League',
                    `Are you sure you want to delete "${leagueName}"? This action cannot be undone and all league data will be permanently lost.`,
                    () => {
                        // Submit the form for this league
                        const form = document.querySelector(`form[action*="/leagues/${leagueId}"]`);
                        if (form) {
                            form.submit();
                        } else {
                            // Fallback if form not found
                            setTimeout(() => {
                                showSuccess(`League "${leagueName}" has been deleted successfully.`);
                                closeModal();
                                // In real app, remove the league card from UI
                                const leagueCard = document.querySelector(`[onclick*="${leagueId}"]`)?.closest('.league-card');
                                if (leagueCard) {
                                    leagueCard.style.display = 'none';
                                }
                            }, 1000);
                        }
                    }
                );
                currentLeagueId = leagueId;
            }

            // Search and filter functionality
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.querySelector('.search-input');
                const leagueCards = document.querySelectorAll('.league-card');
                const filterSelect = document.querySelector('.filter-select');

                // Modal confirm button
                document.getElementById('confirmAction').addEventListener('click', function() {
                    if (currentAction) {
                        currentAction();
                    }
                });

                // Search functionality
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

                // Filter functionality
                filterSelect.addEventListener('change', function() {
                    const filterValue = this.value;
                    
                    leagueCards.forEach(card => {
                        const statusElement = card.querySelector('.league-status');
                        if (!statusElement) return;
                        
                        const status = statusElement.textContent.toLowerCase();
                        
                        switch (filterValue) {
                            case 'all':
                                card.style.display = 'block';
                                break;
                            case 'joined':
                                card.style.display = (status === 'joined' || status === 'admin') ? 'block' : 'none';
                                break;
                            case 'public':
                                card.style.display = status === 'public' ? 'block' : 'none';
                                break;
                            case 'private':
                                card.style.display = status === 'private' ? 'block' : 'none';
                                break;
                        }
                    });
                });

                // Close modal when clicking outside
                document.getElementById('confirmationModal').addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeModal();
                    }
                });

                // Close modal with Escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        closeModal();
                    }
                });
            });
        </script>
    </div>
</body>
</html>