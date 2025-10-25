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
        
        .calendar-day.has-fixtures {
            background: linear-gradient(135deg, rgba(58, 94, 229, 0.15), rgba(58, 94, 229, 0.25));
            border: 1px solid rgba(58, 94, 229, 0.4);
            font-weight: 600;
            color: var(--primary);
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(58, 94, 229, 0.2);
        }

        .calendar-day.has-fixtures:hover {
            background: linear-gradient(135deg, rgba(58, 94, 229, 0.25), rgba(58, 94, 229, 0.35));
            transform: scale(1.05);
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
            <!-- <li class="nav-item">
                <a href="{{ route('transfers.index') }}" class="nav-link">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Transfers</span>
                </a>
            </li> -->
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
           const fixturesData = @json($fixturesByDate);

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
                const score = fixture.finished ? `${fixture.home_score ?? 0} - ${fixture.away_score ?? 0}` : null;

                fixturesHTML += `
                    <li class="fixture-item">
                        <div class="teams">
                            <div class="home-team">
                                <div class="team-logo">${fixture.home_short}</div>
                                <div class="team-name">${fixture.home_team}</div>
                            </div>
                            ${score ? `<div class="vs">${score}</div>` : `<div class="vs">vs</div>`}
                            <div class="away-team">
                                <div class="team-name">${fixture.away_team}</div>
                                <div class="team-logo">${fixture.away_short}</div>
                            </div>
                        </div>
                        <div class="fixture-details">
                            <div class="fixture-time">${new Date(fixture.kickoff_time).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</div>
                            <div class="fixture-venue">Matchweek ${fixture.event ?? '-'}</div>
                        </div>
                    </li>
                `;
            });

            fixturesDisplay.innerHTML = fixturesHTML;

        fixturesDisplay.innerHTML = fixturesHTML;

        // 🎯 Add click-to-open modal with detailed info
        document.querySelectorAll('.fixture-item').forEach((item, index) => {
            item.addEventListener('click', () => {
                const fixture = fixtures[index]; // get full data for this fixture
                const home = fixture.home_team;
                const away = fixture.away_team;
                const score = fixture.finished ? `${fixture.home_score ?? 0} - ${fixture.away_score ?? 0}` : 'vs';
                const kickoff = new Date(fixture.kickoff_time).toLocaleString([], { weekday: 'short', day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit' });
                const venue = fixture.venue ?? 'Unknown Stadium';
                const matchweek = fixture.event ?? '-';
                const status = fixture.finished ? 'Finished' : 'Scheduled';

                // Format goalscorers if available
                let goalsHTML = '';
                if (fixture.goals && fixture.goals.length > 0) {
                    goalsHTML = '<h4 style="margin-top:1rem;">Goalscorers</h4><ul style="list-style:none;padding:0;">';
                    fixture.goals.forEach(goal => {
                        goalsHTML += `<li>${goal.player} (${goal.minute}')</li>`;
                    });
                    goalsHTML += '</ul>';
                } else if (fixture.finished) {
                    goalsHTML = '<p><em>No goals recorded.</em></p>';
                } else {
                    goalsHTML = '<p><em>Match not started.</em></p>';
                }

                // Build modal HTML
                const modalBody = document.getElementById('modalBody');
                modalBody.innerHTML = `
                    <div class="teams">
                        <div class="team"><div class="team-name">${home}</div></div>
                        <div class="score">${score}</div>
                        <div class="team"><div class="team-name">${away}</div></div>
                    </div>
                    <div class="info">
                        <p><strong>Status:</strong> ${status}</p>
                        <p><strong>Kick-off:</strong> ${kickoff}</p>
                        <p><strong>Venue:</strong> ${venue}</p>
                        <p><strong>Matchweek:</strong> ${matchweek}</p>
                        ${goalsHTML}
                    </div>
                `;

                document.getElementById('matchModal').classList.add('active');
            });
        });

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

        // Close modal logic
        document.addEventListener('click', function(e) {
            const modal = document.getElementById('matchModal');
            if (e.target.classList.contains('close-modal') || e.target === modal) {
                modal.classList.remove('active');
            }
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.getElementById('matchModal').classList.remove('active');
            }
        });
    </script>
    <!-- Match Info Modal -->
    <div id="matchModal" class="modal-overlay">
        <div class="modal-content">
            <button class="close-modal">&times;</button>
            <h2 class="modal-title">Match Details</h2>
            <div id="modalBody" class="modal-body"></div>
        </div>
    </div>

    <style>
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 10000;
    }
    .modal-overlay.active { display: flex; }

    .modal-content {
        background: #fff;
        border-radius: 14px;
        width: 90%;
        max-width: 500px;
        padding: 2rem;
        position: relative;
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        animation: popIn 0.25s ease;
    }
    @keyframes popIn { 
        from { transform: scale(0.9); opacity: 0; } 
        to { transform: scale(1); opacity: 1; } 
    }

    .close-modal {
        position: absolute;
        top: 1rem;
        right: 1.2rem;
        background: none;
        border: none;
        font-size: 1.8rem;
        color: var(--gray);
        cursor: pointer;
    }
    .close-modal:hover { color: var(--primary); }

    .modal-title {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.4rem;
        margin-bottom: 1rem;
    }

    .modal-body {
        font-size: 1rem;
        color: var(--dark);
        line-height: 1.5;
    }
    .modal-body .teams {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }
    .modal-body .team {
        text-align: center;
    }
    .modal-body .team-name {
        font-weight: 600;
    }
    .modal-body .score {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary);
    }
    .modal-body .info {
        text-align: center;
        font-size: 0.9rem;
        color: var(--gray);
        margin-top: 1rem;
    }

    .modal-body ul li {
        padding: 4px 0;
        border-bottom: 1px solid #eee;
    }
    .modal-body ul li:last-child {
        border-bottom: none;
    }
    </style>    
</body>
</html>