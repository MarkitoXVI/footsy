<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Your Fantasy Team - Footsy Fantasy</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Open Sans', sans-serif;
      background: #f5f8fb;
      color: #1a2238;
      margin: 0;
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

    /* LEFT PANEL (PLAYER SELECTION) */
    .sidebar {
      width: 340px;
      background: #1a2238;
      color: white;
      padding: 1.5rem;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
    }

    .sidebar h2 {
      font-family: 'Montserrat', sans-serif;
      margin-top: 0;
      font-size: 1.4rem;
      margin-bottom: 1rem;
    }

    .sidebar input,
    .sidebar select {
      width: 100%;
      padding: 0.65rem 0.9rem;
      border: none;
      border-radius: 6px;
      margin-bottom: 1rem;
      font-size: 0.9rem;
      box-sizing: border-box;
    }

    .sidebar input {
      background: white;
      color: #333;
    }

    .sidebar select {
      background: #eaeef6;
      color: #1a2238;
    }

    .player-list {
      display: flex;
      flex-direction: column;
      gap: 0.6rem;
      overflow-y: auto;
      max-height: calc(100vh - 250px);
    }

    .player-card {
      background: white;
      border-radius: 8px;
      padding: 0.8rem;
      color: #1a2238;
      display: flex;
      align-items: center;
      justify-content: space-between;
      cursor: pointer;
      transition: 0.2s;
    }

    .player-card:hover {
      background: #e8ecff;
    }

    .player-card.selected {
      border: 2px solid #3a5ee5;
      background: rgba(58, 94, 229, 0.1);
    }

    .player-card .info {
      display: flex;
      flex-direction: column;
    }

    .player-card .price {
      font-weight: 600;
    }

    /* RIGHT PANEL (PITCH + STATUS) */
    .main {
      flex: 1;
      display: flex;
      flex-direction: column;
      overflow-y: auto;
      padding: 1.5rem 2rem;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .status-box {
      background: white;
      padding: 1rem 1.5rem;
      border-radius: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 2rem;
      box-shadow: 0 5px 10px rgba(0,0,0,0.05);
      flex-wrap: wrap;
    }

    .status-item {
      font-weight: 600;
    }

    /* PITCH AREA */
    .pitch-container {
      position: relative;
      width: 100%;
      max-width: 900px;
      height: 820px;
      margin: 2rem auto;
      padding: 2rem;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
      background:
        linear-gradient(180deg, #4db36a 0%, #2f8e5c 100%),
        url('https://upload.wikimedia.org/wikipedia/commons/thumb/d/d3/Soccer_field_-_empty.svg/1280px-Soccer_field_-_empty.svg.png') no-repeat center center;
      background-size: cover;
      background-position: center;
      display: grid;
      grid-template-rows: repeat(4, 1fr);
      gap: 26px;
    }

    .pitch-row {
      display: grid;
      grid-template-columns: repeat(12, 1fr);
      align-items: center;
    }

    .field-player {
      grid-column: span 2;
      justify-self: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      background: rgba(255,255,255,0.95);
      border-radius: 16px;
      padding: 0.55rem 0.6rem;
      min-width: 92px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.12);
      transition: transform 0.2s ease, background 0.2s ease;
    }

    .field-player-img {
      width: 60px;
      height: 75px;
      object-fit: cover;
      border-radius: 12px;
      margin-bottom: 0.35rem;
    }

    .field-player-name {
      font-size: 0.82rem;
      font-weight: 700;
      text-transform: capitalize;
      line-height: 1.1;
    }

    .field-player:hover {
      transform: translateY(-3px);
      background: rgba(58,94,229,0.92);
      color: #fff;
    }

    /* BENCH */
    .bench-container {
      max-width: 900px;
      margin: 2rem;
      background: #fff;
      border-radius: 16px;
      padding: 1.5rem 1rem;
      box-shadow: 0 5px 15px rgba(0,0,0,0.08);
      text-align: center;
    }

    .bench-container h3 {
      font-family: 'Montserrat', sans-serif;
      font-size: 1.3rem;
      margin-bottom: 1rem;
      color: #1a2238;
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
      background: #f8f9fa;
      border-radius: 12px;
      padding: 0.8rem 0.6rem;
      width: 80px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.08);
    }

    .bench-player img {
      width: 55px;
      height: 70px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 0.3rem;
    }

    .btn-submit {
      background: linear-gradient(135deg,#3a5ee5,#2a48c5);
      border: none;
      color: white;
      padding: 1rem 2rem;
      font-weight: 600;
      border-radius: 10px;
      cursor: pointer;
      transition: .3s;
      margin: 2rem auto;
      display: block;
    }

    .btn-submit:hover { opacity: 0.9; }

    .warning {
      color: #e53e3e;
      margin-top: 0.5rem;
      text-align: center;
      font-size: 0.9rem;
    }

    /* TEAM NAME BOX */
    .team-name-box {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1.5rem;
      background: white;
      padding: 1rem 1.5rem;
      border-radius: 10px;
      box-shadow: 0 5px 10px rgba(0,0,0,0.05);
      max-width: 600px;
    }

    .team-name-box label {
      font-family: 'Montserrat', sans-serif;
      font-weight: 600;
      color: #1a2238;
      font-size: 1rem;
      white-space: nowrap;
    }

    .team-name-box input {
      flex: 1;
      padding: 0.7rem 1rem;
      border: 1px solid #d3d9e2;
      border-radius: 8px;
      font-size: 0.95rem;
      color: #1a2238;
      background: #f5f8fb;
      transition: 0.2s;
    }

    .team-name-box input:focus {
      border-color: #3a5ee5;
      outline: none;
      background: #fff;
    }
  </style>
</head>
<body>

  <!-- LEFT: Player Selection -->
  <div class="sidebar">
    <h2>Player Selection</h2>
    <input type="text" id="searchPlayer" placeholder="Search by name...">
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
      <h1>Create Team</h1>
      <div class="status-box">
        <div class="status-item">Players Selected: <span id="playerCount">0</span>/15</div>
        <div class="status-item">Budget Remaining: £<span id="budgetRemaining">100.0</span>m</div>
      </div>
    </div>

    <form id="teamForm" action="{{ route('fantasy-team.store') }}" method="POST">
      @csrf
      <div class="team-name-box">
        <label for="team_name">Team Name</label>
        <input type="text" id="team_name" name="team_name" placeholder="Enter your team name..." maxlength="30" required>
      </div>

      <div class="pitch-container">
        <div class="pitch-row" id="fwdRow"></div>
        <div class="pitch-row" id="midRow"></div>
        <div class="pitch-row" id="defRow"></div>
        <div class="pitch-row" id="gkRow"></div>
      </div>

      <div class="bench-container">
        <h3>Bench</h3>
        <div class="bench-row" id="benchRow"></div>
      </div>

      <input type="hidden" name="players" id="selectedPlayersInput">
      <div class="warning" id="warningMessage"></div>
      <button type="submit" class="btn-submit">Save Team</button>
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
