<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Your Fantasy Team - Footsy Fantasy</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary: #3a5ee5;
      --primary-dark: #2a48c5;
      --primary-light: #5b7ae8;
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
      background: linear-gradient(135deg, #f0f4ff 0%, #e8edff 50%, #f5f7ff 100%);
      color: var(--dark);
      margin: 0;
      display: flex;
      height: 100vh;
      overflow: hidden;
      position: relative;
    }

    /* Background decoration */
    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-image: 
        radial-gradient(circle at 10% 20%, rgba(58, 94, 229, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 90% 80%, rgba(58, 94, 229, 0.05) 0%, transparent 50%);
      pointer-events: none;
      z-index: 0;
    }

    /* LEFT PANEL (PLAYER SELECTION) */
    .sidebar {
      width: 360px;
      background: linear-gradient(180deg, var(--dark) 0%, #1e2a4a 100%);
      color: white;
      padding: 1.5rem;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
      position: relative;
      z-index: 1;
      box-shadow: 4px 0 25px rgba(58, 94, 229, 0.15);
    }

    .sidebar h2 {
      font-family: 'Montserrat', sans-serif;
      font-weight: 700;
      font-size: 1.4rem;
      margin-bottom: 1.25rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .sidebar h2 i {
      color: var(--pr imary-light);
    }

    .sidebar input,
    .sidebar select {
      width: 100%;
      padding: 0.7rem 1rem;
      border: none;
      border-radius: 10px;
      margin-bottom: 1rem;
      font-size: 0.9rem;
      box-sizing: border-box;
      font-family: 'Open Sans', sans-serif;
    }

    .sidebar input {
      background: white;
      color: var(--dark);
      border: 1px solid transparent;
      transition: all 0.3s;
    }

    .sidebar input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(58, 94, 229, 0.2);
    }

    .sidebar select {
      background: rgba(255, 255, 255, 0.9);
      color: var(--dark);
      cursor: pointer;
    }

    .player-list {
      display: flex;
      flex-direction: column;
      gap: 0.6rem;
      overflow-y: auto;
      max-height: calc(100vh - 250px);
      padding-right: 0.25rem;
    }

    /* Custom scrollbar */
    .player-list::-webkit-scrollbar {
      width: 5px;
    }

    .player-list::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 10px;
    }

    .player-list::-webkit-scrollbar-thumb {
      background: var(--primary);
      border-radius: 10px;
    }

    .player-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      padding: 0.8rem 1rem;
      color: var(--dark);
      display: flex;
      align-items: center;
      justify-content: space-between;
      cursor: pointer;
      transition: all 0.2s ease;
      border: 1px solid rgba(58, 94, 229, 0.1);
    }

    .player-card:hover {
      background: white;
      transform: translateX(3px);
      border-color: rgba(58, 94, 229, 0.3);
    }

    .player-card.selected {
      border: 2px solid var(--primary);
      background: rgba(58, 94, 229, 0.15);
    }

    .player-card .info {
      display: flex;
      flex-direction: column;
    }

    .player-card .info strong {
      font-weight: 600;
      margin-bottom: 0.2rem;
    }

    .player-card .info span {
      font-size: 0.75rem;
      color: var(--gray);
    }

    .player-card .price {
      font-weight: 700;
      color: var(--warning, #f59e0b);
      font-size: 0.9rem;
    }

    /* RIGHT PANEL (PITCH + STATUS) */
    .main {
      flex: 1;
      display: flex;
      flex-direction: column;
      overflow-y: auto;
      padding: 1.5rem 2rem;
      position: relative;
      z-index: 1;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .top-bar h1 {
      font-family: 'Montserrat', sans-serif;
      font-size: 1.8rem;
      font-weight: 700;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .status-box {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      padding: 0.8rem 1.5rem;
      border-radius: 12px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 2rem;
      box-shadow: 0 4px 15px rgba(58, 94, 229, 0.08);
      border: 1px solid rgba(58, 94, 229, 0.1);
    }

    .status-item {
      font-weight: 600;
      color: var(--dark);
    }

    .status-item span {
      color: var(--primary);
      font-size: 1.2rem;
      font-weight: 700;
    }

    /* TEAM NAME BOX */
    .team-name-box {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1.5rem;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      padding: 1rem 1.5rem;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(58, 94, 229, 0.08);
      max-width: 500px;
      border: 1px solid rgba(58, 94, 229, 0.1);
    }

    .team-name-box label {
      font-family: 'Montserrat', sans-serif;
      font-weight: 600;
      color: var(--dark);
      font-size: 1rem;
      white-space: nowrap;
    }

    .team-name-box input {
      flex: 1;
      padding: 0.7rem 1rem;
      border: 1px solid rgba(58, 94, 229, 0.2);
      border-radius: 10px;
      font-size: 0.95rem;
      color: var(--dark);
      background: white;
      transition: all 0.2s;
      font-family: 'Open Sans', sans-serif;
    }

    .team-name-box input:focus {
      border-color: var(--primary);
      outline: none;
      box-shadow: 0 0 0 3px rgba(58, 94, 229, 0.1);
    }

    /* PITCH AREA */
    .pitch-container {
      position: relative;
      width: 100%;
      max-width: 950px;
      height: 820px;
      margin: 1.5rem auto;
      padding: 2rem;
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(58, 94, 229, 0.15);
      background: linear-gradient(180deg, #2d8c5a 0%, #1a6b45 100%);
      display: grid;
      grid-template-rows: repeat(4, 1fr);
      gap: 26px;
      position: relative;
      overflow: hidden;
    }

    .pitch-container::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('https://upload.wikimedia.org/wikipedia/commons/thumb/d/d3/Soccer_field_-_empty.svg/1280px-Soccer_field_-_empty.svg.png') no-repeat center center;
      background-size: cover;
      opacity: 0.15;
      pointer-events: none;
    }

    .pitch-row {
      display: grid;
      grid-template-columns: repeat(12, 1fr);
      align-items: center;
      gap: 8px;
    }

    .field-player {
      grid-column: span 2;
      justify-self: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 16px;
      padding: 0.6rem 0.5rem;
      min-width: 95px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      transition: all 0.2s ease;
      border: 1px solid rgba(58, 94, 229, 0.2);
    }

    .field-player:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 25px rgba(58, 94, 229, 0.25);
      border-color: var(--primary);
    }

    .field-player-img {
      width: 60px;
      height: 75px;
      object-fit: cover;
      border-radius: 12px;
      margin-bottom: 0.35rem;
      background: var(--light);
    }

    .field-player-name {
      font-size: 0.85rem;
      font-weight: 700;
      text-transform: capitalize;
      line-height: 1.2;
      text-align: center;
      color: var(--dark);
    }

    /* BENCH */
    .bench-container {
      max-width: 950px;
      margin: 1rem auto;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 16px;
      padding: 1.5rem;
      box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
      text-align: center;
      border: 1px solid rgba(58, 94, 229, 0.1);
    }

    .bench-container h3 {
      font-family: 'Montserrat', sans-serif;
      font-size: 1.2rem;
      font-weight: 700;
      margin-bottom: 1rem;
      color: var(--dark);
    }

    .bench-row {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .bench-player {
      display: flex;
      flex-direction: column;
      align-items: center;
      background: rgba(58, 94, 229, 0.05);
      border-radius: 12px;
      padding: 0.7rem 0.5rem;
      width: 85px;
      transition: all 0.2s;
      border: 1px solid rgba(58, 94, 229, 0.1);
    }

    .bench-player:hover {
      transform: translateY(-2px);
      border-color: var(--primary);
    }

    .bench-player img {
      width: 55px;
      height: 70px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 0.3rem;
      background: white;
    }

    .bench-player span {
      font-size: 0.75rem;
      font-weight: 600;
      text-align: center;
    }

    .btn-submit {
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      border: none;
      color: white;
      padding: 1rem 2rem;
      font-weight: 700;
      font-size: 1rem;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.3s;
      margin: 1.5rem auto;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      justify-content: center;
      width: 250px;
      font-family: 'Montserrat', sans-serif;
      box-shadow: 0 4px 15px rgba(58, 94, 229, 0.3);
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(58, 94, 229, 0.4);
    }

    .warning {
      color: var(--danger);
      margin-top: 0.5rem;
      text-align: center;
      font-size: 0.9rem;
      font-weight: 500;
    }
  </style>
</head>
<body>

  <!-- LEFT: Player Selection -->
  <div class="sidebar">
    <h2><i class="fas fa-users"></i> Player Selection</h2>
    <input type="text" id="searchPlayer" placeholder="🔍 Search by name...">
    <select id="filterPosition">
      <option value="">All Positions</option>
      <option value="GK">Goalkeepers</option>
      <option value="DEF">Defenders</option>
      <option value="MID">Midfielders</option>
      <option value="FWD">Forwards</option>
    </select>

    <div class="player-list" id="playerList">
      @foreach($players as $p)
      <div class="player-card"
        data-id="{{ $p->code ?? $p->id }}"
        data-team="{{ $p->team->short_name ?? 'UNK' }}"
        data-position="{{ $p->position_label }}"
        data-name="{{ strtolower($p->web_name) }}"
        data-price="{{ $p->price }}"
        onclick="togglePlayer(this)">
        <div class="info">
          <strong>{{ $p->web_name }}</strong>
          <span>{{ $p->position_label }} • {{ $p->team->short_name ?? '-' }}</span>
        </div>
        <div class="price">£{{ number_format($p->price,1) }}m</div>
      </div>
      @endforeach
    </div>
  </div>

  <!-- RIGHT: Pitch & Status -->
  <div class="main">
    <div class="top-bar">
      <h1>Create Your Fantasy Team</h1>
      <div class="status-box">
        <div class="status-item"><i class="fas fa-users"></i> Players: <span id="playerCount">0</span>/15</div>
        <div class="status-item"><i class="fas fa-coins"></i> Budget: £<span id="budgetRemaining">100.0</span>m</div>
      </div>
    </div>

    <form id="teamForm" action="{{ route('fantasy-team.store') }}" method="POST">
      @csrf
      <div class="team-name-box">
        <label for="team_name"><i class="fas fa-tag"></i> Team Name</label>
        <input type="text" id="team_name" name="team_name" placeholder="Enter your team name..." maxlength="30" required>
      </div>

      <div class="pitch-container">
        <div class="pitch-row" id="fwdRow"></div>
        <div class="pitch-row" id="midRow"></div>
        <div class="pitch-row" id="defRow"></div>
        <div class="pitch-row" id="gkRow"></div>
      </div>

      <div class="bench-container">
        <h3><i class="fas fa-chair"></i> Bench</h3>
        <div class="bench-row" id="benchRow"></div>
      </div>

      <input type="hidden" name="players" id="selectedPlayersInput">
      <div class="warning" id="warningMessage"></div>
      <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Save Team</button>
    </form>
  </div>

<script>
let selectedPlayers = [];
let teamCount = {};
const MAX_PLAYERS = 15;
const MAX_PER_TEAM = 3;
const BUDGET = 100.0;

const warning = document.getElementById('warningMessage');
const playerCount = document.getElementById('playerCount');
const budgetRemaining = document.getElementById('budgetRemaining');

function addPlayerBubble(player) {
  const div = document.createElement('div');
  div.className = 'field-player';
  const imgSrc = `https://resources.premierleague.com/premierleague/photos/players/110x140/p${player.id}.png`;
  div.innerHTML = `
    <img src="${imgSrc}" onerror="this.src='https://cdn-icons-png.flaticon.com/512/847/847969.png';" alt="${player.name}" class="field-player-img">
    <div class="field-player-name">${player.name}</div>
  `;
  return div;
}

function togglePlayer(card) {
  const id = card.dataset.id;
  const team = card.dataset.team;
  const pos = normalizePosition(card.dataset.position);
  const price = parseFloat(card.dataset.price);
  const name = card.dataset.name;
  const exists = selectedPlayers.find(p => p.id === id);

  if (exists) {
    selectedPlayers = selectedPlayers.filter(p => p.id !== id);
    teamCount[team]--;
    card.classList.remove('selected');
    updateField();
  } else {
    const totalCost = selectedPlayers.reduce((sum, p) => sum + p.price, 0) + price;
    if (selectedPlayers.length >= MAX_PLAYERS) return showWarning("Max 15 players.");
    if (totalCost > BUDGET) return showWarning("Not enough budget.");
    if ((teamCount[team] || 0) >= MAX_PER_TEAM) return showWarning(`Max 3 players from ${team}.`);
    selectedPlayers.push({ id, team, pos, price, name });
    teamCount[team] = (teamCount[team] || 0) + 1;
    card.classList.add('selected');
    warning.textContent = "";
    updateField();
  }

  playerCount.textContent = selectedPlayers.length;
  const spent = selectedPlayers.reduce((s, p) => s + p.price, 0);
  budgetRemaining.textContent = (BUDGET - spent).toFixed(1);
}

function showWarning(msg) { warning.textContent = msg; }

function updateField() {
  ['gkRow','defRow','midRow','fwdRow','benchRow'].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.innerHTML = '';
  });

  const grouped = { GK: [], DEF: [], MID: [], FWD: [] };
  selectedPlayers.forEach(p => { if (grouped[p.pos]) grouped[p.pos].push(p); });

  const layoutMax = { GK: 1, DEF: 4, MID: 4, FWD: 2 };
  const columns = {
    GK: [6], DEF: [2, 5, 8, 11], MID: [2, 5, 8, 11], FWD: [5, 8]
  };

  Object.entries(layoutMax).forEach(([pos, max]) => {
    const rowEl = document.getElementById(pos.toLowerCase() + 'Row');
    const players = grouped[pos].slice(0, max);
    players.forEach((p, i) => {
      const el = addPlayerBubble(p);
      const col = (columns[pos] && columns[pos][i]) ? columns[pos][i] : 7;
      el.style.gridColumn = `${col} / span 2`;
      rowEl.appendChild(el);
    });
  });

  const allStarters = Object.entries(layoutMax).map(([pos, max]) => grouped[pos].slice(0, max)).flat();
  const benchPlayers = selectedPlayers.filter(p => !allStarters.includes(p));
  const benchRow = document.getElementById('benchRow');
  benchPlayers.slice(0, 4).forEach(p => {
    const b = document.createElement('div');
    b.className = 'bench-player';
    b.innerHTML = `
      <img src="https://resources.premierleague.com/premierleague/photos/players/110x140/p${p.id}.png"
           onerror="this.src='https://cdn-icons-png.flaticon.com/512/847/847969.png';" alt="${p.name}">
      <span>${p.name}</span>`;
    benchRow.appendChild(b);
  });
}

function normalizePosition(pos) {
  const map = {
    'GKP': 'GK', 'GK': 'GK', 'Goalkeeper': 'GK',
    'DEF': 'DEF', 'Defender': 'DEF',
    'MID': 'MID', 'Midfielder': 'MID',
    'FWD': 'FWD', 'Forward': 'FWD'
  };
  return map[pos] || 'BENCH';
}

// === SEARCH + FILTER ===
const searchInput = document.getElementById('searchPlayer');
const positionFilter = document.getElementById('filterPosition');
function filterPlayers() {
  const searchVal = searchInput.value.toLowerCase();
  const posVal = positionFilter.value;
  document.querySelectorAll('.player-card').forEach(card => {
    const matchesName = card.dataset.name.includes(searchVal);
    const matchesPos = !posVal || card.dataset.position === posVal;
    card.style.display = matchesName && matchesPos ? 'flex' : 'none';
  });
}
searchInput.addEventListener('input', filterPlayers);
positionFilter.addEventListener('change', filterPlayers);

// === FORM SUBMIT ===
document.getElementById('teamForm').addEventListener('submit', function(e) {
  if (selectedPlayers.length < 11) {
    e.preventDefault();
    return showWarning("You need at least 11 players to save your team.");
  }
  const teamName = document.getElementById('team_name').value.trim();
  if (!teamName) {
    e.preventDefault();
    return showWarning("Please enter a team name before saving.");
  }
  document.getElementById('selectedPlayersInput').value = JSON.stringify(selectedPlayers);
});
</script>

</body>
</html>