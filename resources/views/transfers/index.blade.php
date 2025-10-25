@extends('layouts.app')

@section('content')
@php
// Make sure we always have a collection of associative arrays
$players = collect($fantasyTeam->players ?? [])
    ->map(function ($p) {
        // Convert any string items to structured placeholder
        if (is_string($p)) {
            return [
                'id' => null,
                'name' => $p,
                'position' => '-',
                'team' => 'Unknown',
                'price' => 0,
                'points' => 0,
            ];
        }

        // Ensure keys exist for all array players
        return [
            'id' => $p['id'] ?? null,
            'name' => $p['name'] ?? ($p['web_name'] ?? 'Unknown'),
            'position' => $p['position'] ?? ($p['position_label'] ?? '-'),
            'team' => $p['team'] ?? 'Unknown',
            'price' => $p['price'] ?? 0,
            'points' => $p['points'] ?? 0,
        ];
    });
@endphp


<div class="transfers-container">
    <!-- Header -->
    <div class="transfers-header">
        <div class="header-content">
            <h1>Transfers</h1>
            <p>Manage your squad and make strategic changes</p>
        </div>
        <div class="budget-card">
            <div class="budget-item">
                <div class="budget-icon">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="budget-info">
                    <span class="budget-label">Remaining Budget</span>
                    <span class="budget-value">£{{ number_format($fantasyTeam->remaining_budget, 1) }}M</span>
                </div>
            </div>
            <div class="budget-item">
                <div class="budget-icon">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <div class="budget-info">
                    <span class="budget-label">Free Transfers</span>
                    <span class="budget-value">{{ $freeTransfers ?? 1 }}/1</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="transfers-main">
        <!-- My Team -->
        <div class="team-section">
            <div class="section-header">
                <div class="section-title">
                    <h3>My Team</h3>
                    <span class="player-count">{{ $players->count() }} players</span>
                </div>
                <div class="section-actions">
                    <button class="action-btn" onclick="autoSelectTeam()">
                        <i class="fas fa-robot"></i> Auto Select
                    </button>
                </div>
            </div>
            
            <div class="players-grid" id="myTeamPlayers">
                @foreach($players as $player)
                <div class="player-card" data-player-id="{{ $player['id'] ?? '' }}"
                     data-position="{{ $player['position'] ?? '' }}" 
                     data-price="{{ $player['price'] ?? '' }}" 
                     data-name="{{ $player['first_name'] ?? '' }} {{ $player['last_name'] ?? '' }}"
                     data-team="{{ $player['team']['name'] ?? 'Unknown' }}"
                     data-form="{{ $player['form'] ?? 0 }}"
                     onclick="selectPlayer(this)">
                    <div class="player-header">
                        <div class="player-team-badge" data-team="{{ $player->team->name ?? 'Unknown' }}">
                            {{ $player->team->abbreviation ?? substr($player->team->name ?? 'N/A', 0, 3) }}
                        </div>
                        <div class="player-price">£{{ number_format($player->price, 1) }}M</div>
                    </div>
                    <div class="player-image">
                        <div class="player-img-placeholder">
                            {{ substr($player->first_name, 0, 1) }}{{ substr($player->last_name, 0, 1) }}
                        </div>
                    </div>
                    <div class="player-info">
                        <div class="player-name">{{ $player->first_name }} {{ $player->last_name }}</div>
                        <div class="player-position">{{ $player->position }}</div>
                        <div class="player-stats">
                            <span>{{ $player->total_points ?? 0 }} pts</span>
                            <span class="form-indicator" data-form="{{ $player->form ?? 0 }}">{{ $player->form ?? 0 }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Available Players -->
        <div class="available-section">
            <div class="section-header">
                <div class="section-title">
                    <h3>Available Players</h3>
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="playerSearch" placeholder="Search players..." onkeyup="filterPlayers()">
                    </div>
                </div>
                <div class="filters">
                    <select id="positionFilter" onchange="filterPlayers()">
                        <option value="">All Positions</option>
                        <option value="Goalkeeper">Goalkeepers</option>
                        <option value="Defender">Defenders</option>
                        <option value="Midfielder">Midfielders</option>
                        <option value="Forward">Forwards</option>
                    </select>
                    <select id="teamFilter" onchange="filterPlayers()">
                        <option value="">All Teams</option>
                        <!-- Team options will be populated dynamically -->
                    </select>
                    <select id="sortFilter" onchange="filterPlayers()">
                        <option value="points">Points</option>
                        <option value="price">Price</option>
                        <option value="form">Form</option>
                    </select>
                </div>
            </div>

            <div class="players-list" id="availablePlayers">
                <!-- Players will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Transfer Summary -->
    <div class="transfer-summary" id="transferSummary">
        <div class="summary-header">
            <h3>Transfer Summary</h3>
            <div class="summary-actions">
                <button class="action-btn secondary" onclick="saveTransfers()">
                    <i class="fas fa-save"></i> Save Draft
                </button>
                <button class="action-btn danger" onclick="clearTransfers()">
                    <i class="fas fa-trash"></i> Clear All
                </button>
            </div>
        </div>
        
        <div class="transfers-list" id="transfersList">
            <!-- Transfers will be listed here -->
        </div>
        
        <div class="summary-footer">
            <div class="budget-info">
                <div class="budget-change">
                    <span>Budget Change:</span>
                    <span id="budgetChange">£0.0M</span>
                </div>
                <div class="new-budget">
                    <span>New Budget:</span>
                    <span id="newBudget">£{{ number_format($fantasyTeam->remaining_budget, 1) }}M</span>
                </div>
            </div>
            <button class="confirm-btn" id="confirmBtn" onclick="confirmTransfers()" disabled>
                <i class="fas fa-check-circle"></i>
                Confirm Transfers
            </button>
        </div>
    </div>
</div>

<style>
:root {
    --primary: #3a5ee5;
    --primary-dark: #2a48c5;
    --secondary: #6c757d;
    --success: #34c759;
    --danger: #e53e3e;
    --warning: #f59e0b;
    --light: #f8f9fa;
    --dark: #1a2238;
    --card-shadow: 0 4px 20px rgba(0,0,0,0.08);
    --hover-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.transfers-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

/* Header */
.transfers-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 30px;
    gap: 30px;
}

.header-content h1 {
    font-size: 2.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--primary), #6c5ce7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin: 0 0 8px 0;
}

.header-content p {
    color: var(--secondary);
    margin: 0;
    font-size: 1.1rem;
    font-weight: 500;
}

.budget-card {
    background: white;
    padding: 24px;
    border-radius: 16px;
    box-shadow: var(--card-shadow);
    min-width: 280px;
    border: 1px solid rgba(0,0,0,0.05);
}

.budget-item {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding: 12px 0;
}

.budget-item:last-child {
    margin-bottom: 0;
}

.budget-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--primary), #6c5ce7);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 16px;
    color: white;
    font-size: 1.2rem;
}

.budget-info {
    display: flex;
    flex-direction: column;
}

.budget-label {
    color: var(--secondary);
    font-size: 0.9rem;
    font-weight: 500;
}

.budget-value {
    font-weight: 700;
    color: var(--dark);
    font-size: 1.2rem;
}

/* Main Content */
.transfers-main {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-bottom: 30px;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 15px;
}

.section-title {
    display: flex;
    align-items: center;
    gap: 20px;
}

.section-title h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--dark);
    margin: 0;
}

.player-count {
    background: var(--light);
    color: var(--secondary);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

/* Search and Filters */
.search-box {
    position: relative;
    display: flex;
    align-items: center;
}

.search-box i {
    position: absolute;
    left: 12px;
    color: var(--secondary);
    z-index: 1;
}

.search-box input {
    padding: 10px 12px 10px 36px;
    border: 1px solid #e0e7ff;
    border-radius: 10px;
    width: 220px;
    background: white;
    transition: all 0.2s ease;
}

.search-box input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(58, 94, 229, 0.1);
    outline: none;
}

.filters {
    display: flex;
    gap: 12px;
    align-items: center;
}

.filters select {
    padding: 10px 12px;
    border: 1px solid #e0e7ff;
    border-radius: 10px;
    background: white;
    color: var(--dark);
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.filters select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(58, 94, 229, 0.1);
    outline: none;
}

/* Action Buttons */
.action-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    background: var(--primary);
    color: white;
    border: none;
    padding: 10px 16px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.action-btn:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
}

.action-btn.secondary {
    background: var(--light);
    color: var(--dark);
}

.action-btn.secondary:hover {
    background: #e9ecef;
}

.action-btn.danger {
    background: var(--danger);
}

.action-btn.danger:hover {
    background: #c53030;
}

/* Player Cards */
.players-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
}

.player-card {
    background: white;
    border: 1px solid rgba(0,0,0,0.05);
    border-radius: 16px;
    padding: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.player-card:hover {
    border-color: var(--primary);
    transform: translateY(-5px);
    box-shadow: var(--hover-shadow);
}

.player-card.selected {
    border-color: var(--primary);
    background: linear-gradient(135deg, #f0f4ff, #e6eeff);
}

.player-card.selected::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), #6c5ce7);
}

.player-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.player-team-badge {
    color: white;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    background-color: #6c757d; /* Default color */
}

.player-price {
    color: var(--warning);
    font-weight: 700;
    font-size: 1rem;
}

.player-image {
    display: flex;
    justify-content: center;
    margin-bottom: 16px;
}

.player-img-placeholder {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), #6c5ce7);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1.5rem;
}

.player-info {
    text-align: center;
}

.player-name {
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 4px;
    font-size: 1.1rem;
}

.player-position {
    color: var(--secondary);
    font-size: 0.9rem;
    margin-bottom: 12px;
}

.player-stats {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.85rem;
    font-weight: 600;
}

.form-indicator {
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 700;
}

.form-good {
    background: rgba(52, 199, 89, 0.15);
    color: var(--success);
}

.form-average {
    background: rgba(245, 158, 11, 0.15);
    color: var(--warning);
}

.form-poor {
    background: rgba(229, 62, 62, 0.15);
    color: var(--danger);
}

/* Players List */
.players-list {
    display: grid;
    gap: 15px;
    max-height: 650px;
    overflow-y: auto;
    padding-right: 5px;
}

/* Transfer Summary */
.transfer-summary {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: var(--card-shadow);
    border: 1px solid rgba(0,0,0,0.05);
}

.summary-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.summary-header h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--dark);
    margin: 0;
}

.summary-actions {
    display: flex;
    gap: 12px;
}

.transfers-list {
    min-height: 120px;
    margin-bottom: 20px;
}

.transfer-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px;
    background: var(--light);
    border-radius: 12px;
    margin-bottom: 12px;
    transition: all 0.2s ease;
}

.transfer-item:hover {
    background: #e9ecef;
}

.transfer-out, .transfer-in {
    display: flex;
    align-items: center;
    gap: 16px;
    flex: 1;
}

.transfer-arrow {
    color: var(--secondary);
    margin: 0 20px;
    font-size: 1.2rem;
}

.transfer-name {
    font-weight: 600;
    color: var(--dark);
}

.transfer-details {
    color: var(--secondary);
    font-size: 0.85rem;
}

.summary-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
}

.budget-info {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.budget-change, .new-budget {
    display: flex;
    justify-content: space-between;
    width: 200px;
}

#budgetChange {
    font-weight: 700;
    color: var(--success);
}

#budgetChange.negative {
    color: var(--danger);
}

#newBudget {
    font-weight: 700;
    color: var(--primary);
}

.confirm-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, var(--primary), #6c5ce7);
    color: white;
    border: none;
    padding: 14px 28px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(58, 94, 229, 0.3);
}

.confirm-btn:hover:not(:disabled) {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(58, 94, 229, 0.4);
}

.confirm-btn:disabled {
    background: var(--secondary);
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

/* Empty States */
.empty-state {
    text-align: center;
    padding: 40px 20px;
    color: var(--secondary);
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 16px;
    opacity: 0.5;
}

.empty-state p {
    margin: 0;
    font-size: 1.1rem;
}

.small-text {
    font-size: 0.9rem;
    margin-top: 8px;
}

/* Scrollbar Styling */
.players-list::-webkit-scrollbar {
    width: 6px;
}

.players-list::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.players-list::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
}

.players-list::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Responsive */
@media (max-width: 1024px) {
    .transfers-main {
        grid-template-columns: 1fr;
    }
    
    .players-grid {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    }
}

@media (max-width: 768px) {
    .transfers-header {
        flex-direction: column;
    }
    
    .section-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .section-title {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .search-box input {
        width: 100%;
    }
    
    .filters {
        flex-wrap: wrap;
    }
    
    .summary-footer {
        flex-direction: column;
        gap: 20px;
        align-items: stretch;
    }
    
    .budget-info {
        width: 100%;
    }
}
</style>

<script>
let selectedPlayer = null;
let transfers = [];

// Team colors mapping
const teamColors = {
    'Arsenal': '#EF0107',
    'Chelsea': '#034694',
    'Liverpool': '#C8102E',
    'Manchester United': '#DA291C',
    'Manchester City': '#6CABDD',
    'Tottenham': '#132257',
    'Newcastle': '#241F20',
    'Brighton': '#0057B8',
    'West Ham': '#7A263A',
    'Crystal Palace': '#1B458F',
    'Everton': '#003399',
    'Leicester': '#003090',
    'Wolves': '#FDB913',
    'Aston Villa': '#670E36',
    'Leeds': '#FFCD00',
    'Southampton': '#D71920',
    'Fulham': '#000000',
    'Nottingham Forest': '#DD0000',
    'Bournemouth': '#DA291C',
    'Brentford': '#E30613',
    'Unknown': '#6c757d'
};

// Initialize team badges and form indicators when page loads
document.addEventListener('DOMContentLoaded', function() {
    initializeTeamBadges();
    initializeFormIndicators();
    loadAvailablePlayers();
    
    // Load any saved transfer drafts
    const savedDraft = localStorage.getItem('transferDraft');
    if (savedDraft) {
        if (confirm('You have a saved transfer draft. Would you like to load it?')) {
            transfers = JSON.parse(savedDraft);
            updateTransferSummary();
        }
    }
});

// Initialize team badge colors
function initializeTeamBadges() {
    document.querySelectorAll('.player-team-badge').forEach(badge => {
        const teamName = badge.getAttribute('data-team') || badge.closest('.player-card').getAttribute('data-team');
        const color = teamColors[teamName] || '#6c757d';
        badge.style.backgroundColor = color;
    });
}

// Initialize form indicators
function initializeFormIndicators() {
    document.querySelectorAll('.form-indicator').forEach(indicator => {
        const formValue = parseInt(indicator.getAttribute('data-form')) || 0;
        updateFormIndicator(indicator, formValue);
    });
}

// Update form indicator color based on value
function updateFormIndicator(element, formValue) {
    if (formValue >= 7) {
        element.classList.add('form-good');
        element.classList.remove('form-average', 'form-poor');
    } else if (formValue >= 4) {
        element.classList.add('form-average');
        element.classList.remove('form-good', 'form-poor');
    } else {
        element.classList.add('form-poor');
        element.classList.remove('form-good', 'form-average');
    }
}

// Get team color
function getTeamColor(teamName) {
    return teamColors[teamName] || '#6c757d';
}

// Load available players
function loadAvailablePlayers() {
    const availablePlayers = document.getElementById('availablePlayers');
    availablePlayers.innerHTML = `
        <div class="empty-state">
            <i class="fas fa-spinner fa-spin"></i>
            <p>Loading players...</p>
        </div>
    `;

    // Mock data - replace with actual API call
    setTimeout(() => {
        const players = [
            { id: 101, name: 'Kevin De Bruyne', position: 'Midfielder', team: 'Manchester City', price: 11.5, points: 187, form: 8 },
            { id: 102, name: 'Harry Kane', position: 'Forward', team: 'Manchester United', price: 12.5, points: 210, form: 9 },
            { id: 103, name: 'Trent Alexander-Arnold', position: 'Defender', team: 'Liverpool', price: 8.0, points: 145, form: 6 },
            { id: 104, name: 'Ederson', position: 'Goalkeeper', team: 'Manchester City', price: 5.5, points: 128, form: 7 },
            { id: 105, name: 'Son Heung-min', position: 'Forward', team: 'Tottenham', price: 9.5, points: 178, form: 5 },
            { id: 106, name: 'Virgil van Dijk', position: 'Defender', team: 'Liverpool', price: 6.5, points: 132, form: 7 },
            { id: 107, name: 'Mohamed Salah', position: 'Forward', team: 'Liverpool', price: 12.8, points: 205, form: 8 },
            { id: 108, name: 'Bruno Fernandes', position: 'Midfielder', team: 'Manchester United', price: 8.5, points: 168, form: 6 }
        ];

        displayAvailablePlayers(players);
    }, 1000);
}

// Display available players
function displayAvailablePlayers(players) {
    const availablePlayers = document.getElementById('availablePlayers');
    
    if (players.length === 0) {
        availablePlayers.innerHTML = `
            <div class="empty-state">
                <i class="fas fa-search"></i>
                <p>No players found</p>
            </div>
        `;
        return;
    }

    availablePlayers.innerHTML = players.map(player => {
        const teamColor = getTeamColor(player.team);
        const formClass = player.form >= 7 ? 'form-good' : player.form >= 4 ? 'form-average' : 'form-poor';
        
        return `
        <div class="player-card" onclick="selectReplacement(${player.id}, '${player.position}', ${player.price}, '${player.name.replace(/'/g, "\\'")}', '${player.team}', ${player.form})">
            <div class="player-header">
                <div class="player-team-badge" style="background-color: ${teamColor}">
                    ${player.team.substring(0, 3)}
                </div>
                <div class="player-price">£${player.price}M</div>
            </div>
            <div class="player-image">
                <div class="player-img-placeholder">
                    ${player.name.split(' ').map(n => n[0]).join('')}
                </div>
            </div>
            <div class="player-info">
                <div class="player-name">${player.name}</div>
                <div class="player-position">${player.position}</div>
                <div class="player-stats">
                    <span>${player.points} pts</span>
                    <span class="form-indicator ${formClass}">${player.form}</span>
                </div>
            </div>
        </div>
        `;
    }).join('');
}

// Filter players
function filterPlayers() {
    // This would filter based on search and position
    // For now, just reload
    loadAvailablePlayers();
}

// Select player from team
function selectPlayer(element) {
    // Clear previous selection
    document.querySelectorAll('.player-card').forEach(card => {
        card.classList.remove('selected');
    });
    
    // Select new player
    element.classList.add('selected');
    
    // Extract player data from data attributes
    selectedPlayer = {
        id: element.getAttribute('data-player-id'),
        position: element.getAttribute('data-position'),
        price: parseFloat(element.getAttribute('data-price')),
        name: element.getAttribute('data-name'),
        team: element.getAttribute('data-team')
    };
}

// Select replacement
function selectReplacement(id, position, price, name, team, form) {
    if (!selectedPlayer) {
        alert('Please select a player from your team first');
        return;
    }

    if (selectedPlayer.position !== position) {
        alert(`Must replace with same position (${selectedPlayer.position})`);
        return;
    }

    // Add transfer
    transfers.push({
        out: selectedPlayer,
        in: { id, position, price, name, team, form }
    });

    // Clear selection
    selectedPlayer = null;
    document.querySelectorAll('.player-card').forEach(card => {
        card.classList.remove('selected');
    });

    updateTransferSummary();
}

// Update transfer summary
function updateTransferSummary() {
    const transfersList = document.getElementById('transfersList');
    const budgetChange = document.getElementById('budgetChange');
    const newBudget = document.getElementById('newBudget');
    const confirmBtn = document.getElementById('confirmBtn');

    if (transfers.length === 0) {
        transfersList.innerHTML = `
            <div class="empty-state">
                <i class="fas fa-exchange-alt"></i>
                <p>No transfers selected</p>
                <p class="small-text">Select a player from your team, then choose a replacement</p>
            </div>
        `;
        confirmBtn.disabled = true;
        return;
    }

    // Calculate budget change
    const totalChange = transfers.reduce((sum, transfer) => {
        return sum + (transfer.in.price - transfer.out.price);
    }, 0);
    
    const currentBudget = {{ $fantasyTeam->remaining_budget }};
    const updatedBudget = currentBudget + totalChange;

    // Update UI
    transfersList.innerHTML = transfers.map(transfer => {
        const outTeamColor = getTeamColor(transfer.out.team);
        const inTeamColor = getTeamColor(transfer.in.team);
        
        return `
        <div class="transfer-item">
            <div class="transfer-out">
                <div class="player-team-badge" style="background-color: ${outTeamColor}">${transfer.out.team.substring(0, 3)}</div>
                <div>
                    <div class="transfer-name">${transfer.out.name}</div>
                    <div class="transfer-details">${transfer.out.position} • £${transfer.out.price}M</div>
                </div>
            </div>
            <div class="transfer-arrow">
                <i class="fas fa-long-arrow-alt-right"></i>
            </div>
            <div class="transfer-in">
                <div class="player-team-badge" style="background-color: ${inTeamColor}">${transfer.in.team.substring(0, 3)}</div>
                <div>
                    <div class="transfer-name">${transfer.in.name}</div>
                    <div class="transfer-details">${transfer.in.position} • £${transfer.in.price}M</div>
                </div>
            </div>
        </div>
        `;
    }).join('');

    budgetChange.textContent = `£${totalChange.toFixed(1)}M`;
    budgetChange.className = totalChange >= 0 ? '' : 'negative';
    newBudget.textContent = `£${updatedBudget.toFixed(1)}M`;
    confirmBtn.disabled = false;
}

// Clear all transfers
function clearTransfers() {
    if (transfers.length === 0) return;
    
    if (confirm('Are you sure you want to clear all transfers?')) {
        transfers = [];
        selectedPlayer = null;
        document.querySelectorAll('.player-card').forEach(card => {
            card.classList.remove('selected');
        });
        updateTransferSummary();
    }
}

// Save transfers as draft
function saveTransfers() {
    if (transfers.length === 0) {
        alert('No transfers to save');
        return;
    }
    
    // In a real app, this would save to localStorage or send to backend
    localStorage.setItem('transferDraft', JSON.stringify(transfers));
    alert('Transfer draft saved successfully!');
}

// Auto select team (placeholder function)
function autoSelectTeam() {
    alert('Auto select feature would optimize your team based on form and fixtures');
}

// Confirm transfers
function confirmTransfers() {
    if (transfers.length === 0) return;

    // Calculate budget
    const totalChange = transfers.reduce((sum, transfer) => {
        return sum + (transfer.in.price - transfer.out.price);
    }, 0);
    const newBudget = {{ $fantasyTeam->remaining_budget }} + totalChange;

    if (newBudget < 0) {
        alert('Cannot complete transfers - would exceed budget');
        return;
    }

    // Show loading
    const btn = document.getElementById('confirmBtn');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
    btn.disabled = true;

    // Simulate API call
    setTimeout(() => {
        alert('Transfers completed successfully!');
        clearTransfers();
        btn.innerHTML = originalText;
        loadAvailablePlayers(); // Refresh available players
        
        // In a real app, we would refresh the page or update data
        window.location.reload();
    }, 1500);
}
</script>
@endsection