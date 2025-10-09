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
    }

    .sidebar input, .sidebar select {
      width: 100%;
      padding: 0.6rem 0.9rem;
      border: none;
      border-radius: 6px;
      margin-bottom: 1rem;
      font-size: 0.9rem;
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

    /* RIGHT PANEL (TRANSFERS / PITCH) */
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
        margin: 2rem auto;
        border-radius: 15px;
        overflow: hidden;
        background: linear-gradient(180deg, #4db36a 0%, #2f8e5c 100%);
        aspect-ratio: 2 / 3; /* ensures the field keeps its shape */
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .pitch-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
        opacity: 0.15; /* faint lines visible */
    }

    .player-spot {
        position: absolute;
        width: 100%;
        display: flex;
        justify-content: center;
        gap: 1rem;
        z-index: 2; /* ensures players show above pitch */
    }

    .gk-row  { top: 85%; }
    .def-row { top: 65%; }
    .mid-row { top: 45%; }
    .fwd-row { top: 25%; }

    .field-player {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,0.9);
        border-radius: 10px;
        padding: 0.5rem 0.4rem;
        text-align: center;
        min-width: 80px;
        font-size: 0.8rem;
        font-weight: 600;
        box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        transition: 0.2s;
    }

    .field-player-img {
        width: 55px;
        height: 70px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 0.3rem;
        }

        .field-player-name {
        font-size: 0.75rem;
        text-transform: capitalize;
        }

    .field-player:hover {
        transform: translateY(-2px);
        background: rgba(58,94,229,0.9);
        color: white;
    }

    /* SUBMIT BUTTON */
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

  <!-- RIGHT: Transfers / Pitch -->
  <div class="main">
    <div class="top-bar">
      <h1>Transfers</h1>
      <div class="status-box">
        <div class="status-item">Players Selected: <span id="playerCount">0</span>/15</div>
        <div class="status-item">Budget Remaining: £<span id="budgetRemaining">100.0</span>m</div>
        <div class="status-item">Free Transfers: 1</div>
      </div>
    </div>

    <div class="pitch-container">
    <img
        src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d3/Soccer_field_-_empty.svg/1280px-Soccer_field_-_empty.svg.png"
        alt="Football Pitch"
        class="pitch-img"
    >

    <div class="player-spot fwd-row" id="fwdRow"></div>
    <div class="player-spot mid-row" id="midRow"></div>
    <div class="player-spot def-row" id="defRow"></div>
    <div class="player-spot gk-row" id="gkRow"></div>
    </div>


    <div class="warning" id="warningMessage"></div>
    <button type="submit" class="btn-submit">Save Team</button>
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
const fieldRows = {
  GK: document.getElementById('gkRow'),
  DEF: document.getElementById('defRow'),
  MID: document.getElementById('midRow'),
  FWD: document.getElementById('fwdRow')
};

function addPlayerBubble(player, container) {
  const div = document.createElement('div');
  div.className = 'field-player';

  // Use the same image source logic as in your player cards
  const imgSrc = `https://resources.premierleague.com/premierleague/photos/players/110x140/p${player.id}.png`;

  div.innerHTML = `
    <img src="${imgSrc}"
         onerror="this.src='https://cdn-icons-png.flaticon.com/512/847/847969.png';"
         alt="${player.name}"
         class="field-player-img">
    <div class="field-player-name">${player.name}</div>
  `;
  
  container.appendChild(div);
}


function togglePlayer(card) {
  const id = card.dataset.id;
  const team = card.dataset.team;
  const pos = card.dataset.position;
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

    selectedPlayers.push({id, team, pos, price, name});
    teamCount[team] = (teamCount[team] || 0) + 1;
    card.classList.add('selected');
    warning.textContent = "";
    updateField();
  }

  playerCount.textContent = selectedPlayers.length;
  const spent = selectedPlayers.reduce((s, p) => s + p.price, 0);
  budgetRemaining.textContent = (BUDGET - spent).toFixed(1);
}

function showWarning(msg){ warning.textContent = msg; }

function updateField() {
  Object.values(fieldRows).forEach(row => row.innerHTML = '');
  const grouped = { GK: [], DEF: [], MID: [], FWD: [] };
  selectedPlayers.forEach(p => { if (grouped[p.pos]) grouped[p.pos].push(p); });

  const layout = { GK: 1, DEF: 4, MID: 4, FWD: 2 };
  Object.entries(layout).forEach(([pos, max]) => {
    grouped[pos].slice(0, max).forEach(p => {
      const div = document.createElement('div');
      div.className = 'field-player';
      div.textContent = p.name;
      fieldRows[pos].appendChild(div);
    });
  });
}

document.getElementById('searchPlayer').addEventListener('input', filterPlayers);
document.getElementById('filterPosition').addEventListener('change', filterPlayers);
function filterPlayers() {
  const searchVal = searchPlayer.value.toLowerCase();
  const posVal = filterPosition.value;
  document.querySelectorAll('.player-card').forEach(card => {
    const matchesName = card.dataset.name.includes(searchVal);
    const matchesPos = !posVal || card.dataset.position === posVal;
    card.style.display = matchesName && matchesPos ? 'flex' : 'none';
  });
}
</script>

</body>
</html>
