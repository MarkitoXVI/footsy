@extends('layouts.footsy')

@section('title', 'Team Statistics - Footsy')
@section('header-title', 'Statistics')

@section('header-dropdown')
<div class="stats-dropdown">
    <button class="stats-dropdown-btn">
        <i class="fas fa-chart-bar"></i>
        <span>Team Statistics</span>
        <i class="fas fa-chevron-down"></i>
    </button>
    <div class="stats-dropdown-content">
        <a href="{{ route('statistics.index') }}"><i class="fas fa-chart-pie"></i> Overview</a>
        <a href="{{ route('statistics.players') }}"><i class="fas fa-user"></i> Player Stats</a>
        <a href="{{ route('statistics.teams') }}" class="active"><i class="fas fa-users"></i> Team Stats</a>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Stats Overview Cards */
    .stats-overview {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        text-align: center;
        transition: transform 0.3s;
    }
    .stat-card:hover {
        transform: translateY(-3px);
    }
    .stat-icon {
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
    .stat-value {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }
    .stat-label {
        color: var(--gray);
        font-size: 0.9rem;
    }

    /* Table Container */
    .table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        overflow: hidden;
        margin-bottom: 2rem;
    }
    .table-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--light-gray);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .table-header h3 {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.3rem;
        margin: 0;
        color: var(--dark);
    }
    .table-controls {
        display: flex;
        gap: 1rem;
        align-items: center;
    }
    .search-control {
        position: relative;
    }
    .search-control input {
        padding: 0.5rem 1rem 0.5rem 2.5rem;
        border: 1px solid var(--light-gray);
        border-radius: 6px;
        font-size: 0.9rem;
        width: 250px;
    }
    .search-control i {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
    }
    .sort-control select {
        padding: 0.5rem 1rem;
        border: 1px solid var(--light-gray);
        border-radius: 6px;
        font-size: 0.9rem;
        background: white;
        cursor: pointer;
    }

    /* Table Styles */
    .team-table {
        width: 100%;
        border-collapse: collapse;
    }
    .team-table thead {
        background: #fafbff;
    }
    .team-table th {
        padding: 1rem;
        text-align: left;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        color: var(--dark);
        border-bottom: 1px solid var(--light-gray);
        cursor: pointer;
        transition: background 0.2s;
        user-select: none;
    }
    .team-table th:hover {
        background: rgba(58, 94, 229, 0.05);
    }
    .team-table th i {
        margin-left: 0.5rem;
        color: var(--gray);
        font-size: 0.8rem;
    }
    .team-table td {
        padding: 1rem;
        border-bottom: 1px solid var(--light-gray);
        transition: background 0.2s;
    }
    .team-table tbody tr:hover {
        background: rgba(58, 94, 229, 0.03);
    }
    .team-table tbody tr:last-child td {
        border-bottom: none;
    }
    .team-cell {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .team-logo {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--dark);
        overflow: hidden;
        flex-shrink: 0;
    }
    .team-logo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .team-name {
        font-weight: 500;
    }
    .team-short {
        color: var(--gray);
        font-size: 0.85rem;
    }
    .goals-cell, .points-cell {
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        text-align: center;
    }
    .goals-cell { color: var(--secondary); }
    .points-cell { color: var(--primary); }

    .top-badge {
        background: var(--secondary);
        color: white;
        font-size: 0.7rem;
        padding: 0.2rem 0.5rem;
        border-radius: 10px;
        margin-left: 0.5rem;
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 2rem;
    }
    .pagination a, .pagination span {
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

    /* Responsive */
    @media (max-width: 768px) {
        .table-header {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }
        .table-controls {
            width: 100%;
            justify-content: space-between;
        }
        .search-control input {
            width: 100%;
        }
    }
    @media (max-width: 576px) {
        .stats-overview {
            grid-template-columns: 1fr;
        }
        .table-controls {
            flex-direction: column;
            gap: 0.75rem;
        }
        .search-control input {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<h1>Team Statistics</h1>

<!-- Stats Overview Cards -->
<div class="stats-overview">
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-trophy"></i></div>
        <div class="stat-value">{{ $teams->count() }}</div>
        <div class="stat-label">Total Teams</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-futbol"></i></div>
        <div class="stat-value">{{ $teams->sum('total_goals') ?? 0 }}</div>
        <div class="stat-label">Total Goals</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
        <div class="stat-value">{{ $teams->sum('total_points') ?? 0 }}</div>
        <div class="stat-label">Total Points</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-star"></i></div>
        <div class="stat-value">{{ $teams->max('total_points') ?? 0 }}</div>
        <div class="stat-label">Highest Points</div>
    </div>
</div>

<!-- Team Statistics Table -->
<div class="table-container">
    <div class="table-header">
        <h3>Premier League Team Statistics</h3>
        <div class="table-controls">
            <div class="search-control">
                <i class="fas fa-search"></i>
                <input type="text" id="teamSearch" placeholder="Search teams...">
            </div>
            <div class="sort-control">
                <select id="sortSelect">
                    <option value="name">Sort by Name</option>
                    <option value="short_name">Sort by Short Name</option>
                    <option value="goals">Sort by Goals</option>
                    <option value="points" selected>Sort by Points</option>
                </select>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="team-table">
            <thead>
                <tr>
                    <th data-sort="name">Team <i class="fas fa-sort"></i></th>
                    <th data-sort="short_name">Short Name <i class="fas fa-sort"></i></th>
                    <th data-sort="goals">Goals <i class="fas fa-sort"></i></th>
                    <th data-sort="points">Points <i class="fas fa-sort"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach($teams as $team)
                    <tr>
                        <td>
                            <div class="team-cell">
                                <div class="team-logo">
                                    @if(!empty($team->code))
                                        <img src="https://resources.premierleague.com/premierleague/badges/70/t{{ $team->code }}.png"
                                             alt="{{ $team->name }}"
                                             onerror="this.style.display='none'; this.parentElement.querySelector('.fallback').style.display='flex';">
                                    @endif
                                    <div class="fallback" style="display: {{ empty($team->code) ? 'flex' : 'none' }}; width:100%; height:100%; align-items:center; justify-content:center; background:#f8f9fa; border-radius:50%; font-size:0.7rem; font-weight:700;">
                                        {{ strtoupper(substr($team->short_name ?? $team->name, 0, 3)) }}
                                    </div>
                                </div>
                                <div>
                                    <div class="team-name">{{ $team->name }}</div>
                                    <div class="team-short">{{ $team->short_name ?? 'N/A' }}</div>
                                </div>
                                @if($loop->index < 3)
                                    <span class="top-badge">Top {{ $loop->index + 1 }}</span>
                                @endif
                            </div>
                        </td>
                        <td>{{ $team->short_name ?? 'N/A' }}</td>
                        <td class="goals-cell">{{ $team->total_goals ?? 0 }}</td>
                        <td class="points-cell">{{ $team->total_points ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
@if(method_exists($teams, 'links'))
    <div class="pagination">
        {{ $teams->links() }}
    </div>
@endif
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const table = document.querySelector('.team-table');
        const headers = table.querySelectorAll('th[data-sort]');
        const searchInput = document.getElementById('teamSearch');
        const sortSelect = document.getElementById('sortSelect');

        let currentSort = { column: 'points', direction: 'desc' };

        // Header click sorting
        headers.forEach(header => {
            header.addEventListener('click', () => {
                const column = header.getAttribute('data-sort');
                sortTable(column);
            });
        });

        // Dropdown sorting
        sortSelect.addEventListener('change', () => {
            const column = sortSelect.value;
            sortTable(column);
        });

        // Search functionality
        searchInput.addEventListener('input', () => {
            filterTable(searchInput.value.toLowerCase().trim());
        });

        function sortTable(column) {
            const tbody = table.querySelector('tbody');
            let rows = Array.from(tbody.querySelectorAll('tr'));

            if (currentSort.column === column) {
                currentSort.direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
            } else {
                currentSort.column = column;
                currentSort.direction = (column === 'name' || column === 'short_name') ? 'asc' : 'desc';
            }

            rows.sort((a, b) => {
                let aValue = getCellValue(a, column);
                let bValue = getCellValue(b, column);

                if (typeof aValue === 'string') {
                    return currentSort.direction === 'asc' 
                        ? aValue.localeCompare(bValue) 
                        : bValue.localeCompare(aValue);
                } else {
                    return currentSort.direction === 'asc' 
                        ? aValue - bValue 
                        : bValue - aValue;
                }
            });

            rows.forEach(row => tbody.appendChild(row));
            updateSortIndicators(column);
        }

        function getCellValue(row, column) {
            switch(column) {
                case 'name':
                    return row.cells[0].querySelector('.team-name').textContent.trim().toLowerCase();
                case 'short_name':
                    return row.cells[1].textContent.trim().toLowerCase();
                case 'goals':
                    return parseInt(row.cells[2].textContent) || 0;
                case 'points':
                    return parseInt(row.cells[3].textContent) || 0;
                default:
                    return 0;
            }
        }

        function updateSortIndicators(column) {
            headers.forEach(header => {
                const icon = header.querySelector('i');
                if (header.getAttribute('data-sort') === column) {
                    icon.className = currentSort.direction === 'asc' ? 'fas fa-sort-up' : 'fas fa-sort-down';
                } else {
                    icon.className = 'fas fa-sort';
                }
            });
        }

        function filterTable(searchTerm) {
            const rows = table.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const teamName = row.cells[0].querySelector('.team-name').textContent.toLowerCase();
                const shortName = row.cells[1].textContent.toLowerCase();
                const shouldShow = teamName.includes(searchTerm) || shortName.includes(searchTerm);
                row.style.display = shouldShow ? '' : 'none';
            });
        }

        // Initial sort by points (descending)
        sortTable('points');
    });
</script>
@endpush