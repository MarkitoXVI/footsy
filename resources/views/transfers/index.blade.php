@extends('layouts.app')

@section('content')
@php
    $myTeamPlayers = collect($fantasyTeam->players ?? [])
        ->map(function ($p) {
            if (is_string($p)) {
                return [
                    'id'       => null,
                    'name'     => $p,
                    'position' => '-',
                    'team'     => 'Unknown',
                    'price'    => 0,
                    'points'   => 0,
                ];
            }
            return [
                'id'       => $p['id'] ?? null,
                'name'     => $p['name'] ?? ($p['web_name'] ?? 'Unknown Player'),
                'position' => $p['position'] ?? ($p['position_label'] ?? '-'),
                'team'     => $p['team'] ?? 'Unknown',
                'price'    => $p['price'] ?? 0,
                'points'   => $p['points'] ?? 0,
            ];
        });
@endphp

<div class="xfr-wrap">

    <!-- Header -->
    <header class="xfr-header">
        <div class="xfr-header__left">
            <div class="xfr-header__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M7 16V4m0 0L3 8m4-4l4 4"/><path d="M17 8v12m0 0l4-4m-4 4l-4-4"/></svg>
            </div>
            <div>
                <h1 class="xfr-header__title">Transfers</h1>
                <p class="xfr-header__sub">Gameweek {{ $currentGameweek ?? '—' }} &bull; Manage your squad</p>
            </div>
        </div>
        <div class="xfr-header__stats">
            <div class="xfr-stat">
                <span class="xfr-stat__label">Budget</span>
                <span class="xfr-stat__value" id="headerBudget">£{{ number_format($fantasyTeam->remaining_budget ?? 0, 1) }}M</span>
            </div>
            <div class="xfr-stat-divider"></div>
            <div class="xfr-stat">
                <span class="xfr-stat__label">Free Transfers</span>
                <span class="xfr-stat__value">{{ $freeTransfers ?? 1 }}/1</span>
            </div>
            <div class="xfr-stat-divider"></div>
            <div class="xfr-stat">
                <span class="xfr-stat__label">Squad</span>
                <span class="xfr-stat__value" id="headerSquad">{{ $myTeamPlayers->count() }}/15</span>
            </div>
        </div>
    </header>

    <!-- Toast notification -->
    <div class="xfr-toast" id="xfrToast" role="alert" aria-live="assertive"></div>

    <!-- Two-column layout -->
    <div class="xfr-grid">

        <!-- LEFT: My Team -->
        <section class="xfr-panel" aria-labelledby="myTeamHeading">
            <div class="xfr-panel__head">
                <div class="xfr-panel__title-row">
                    <svg class="xfr-panel__ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <h2 id="myTeamHeading" class="xfr-panel__title">My Team</h2>
                    <span class="xfr-badge" id="squadCount">{{ $myTeamPlayers->count() }}/15</span>
                </div>
                <button class="xfr-btn xfr-btn--ghost" onclick="autoSelectTeam()" title="Auto select best XI">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 1 0-14.14 14.14A10 10 0 0 0 19.07 4.93z"/><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
                    Auto Select
                </button>
            </div>

            <div class="xfr-instructions" id="selectionHint">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                Click a player to select them for transfer
            </div>

            <div class="xfr-players-grid" id="myTeamPlayers">
                @forelse($myTeamPlayers as $player)
                    <div class="xfr-card"
                         data-player-id="{{ $player['id'] ?? '' }}"
                         data-position="{{ $player['position'] }}"
                         data-price="{{ $player['price'] }}"
                         data-name="{{ $player['name'] }}"
                         data-team="{{ $player['team'] }}"
                         data-points="{{ $player['points'] }}"
                         onclick="selectPlayer(this)"
                         role="button"
                         tabindex="0"
                         aria-label="Select {{ $player['name'] }} for transfer"
                         onkeydown="if(event.key==='Enter'||event.key===' ')selectPlayer(this)">
                        <div class="xfr-card__top">
                            <span class="xfr-card__badge" data-team="{{ $player['team'] }}">{{ substr($player['team'], 0, 3) }}</span>
                            <span class="xfr-card__pos pos-{{ strtolower($player['position']) }}">{{ $player['position'] }}</span>
                        </div>
                        <div class="xfr-card__avatar">
                            {{ strtoupper(substr($player['name'], 0, 2)) }}
                        </div>
                        <div class="xfr-card__name">{{ $player['name'] }}</div>
                        <div class="xfr-card__meta">
                            <span class="xfr-card__price">£{{ number_format($player['price'], 1) }}M</span>
                            <span class="xfr-card__pts">{{ $player['points'] }} pts</span>
                        </div>
                        <div class="xfr-card__select-ring" aria-hidden="true"></div>
                    </div>
                @empty
                    <div class="xfr-empty">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                        <p>No players in your team yet.</p>
                        <a href="{{ route('fantasy-team.index') }}" class="xfr-btn xfr-btn--primary" style="margin-top:1rem">Go to Team Management</a>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- RIGHT: Available Players -->
        <section class="xfr-panel" aria-labelledby="availableHeading">
            <div class="xfr-panel__head">
                <div class="xfr-panel__title-row">
                    <svg class="xfr-panel__ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                    <h2 id="availableHeading" class="xfr-panel__title">Available Players</h2>
                    <span class="xfr-badge" id="availableCount">—</span>
                </div>
            </div>

            <div class="xfr-filters">
                <div class="xfr-search">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input type="text" id="playerSearch" placeholder="Search players…" oninput="filterPlayers()" aria-label="Search available players">
                </div>
                <select id="positionFilter" onchange="filterPlayers()" aria-label="Filter by position">
                    <option value="">All Positions</option>
                    <option value="GK">GK</option>
                    <option value="DEF">DEF</option>
                    <option value="MID">MID</option>
                    <option value="FWD">FWD</option>
                </select>
                <select id="sortBy" onchange="filterPlayers()" aria-label="Sort players">
                    <option value="points">By Points</option>
                    <option value="price_asc">Price ↑</option>
                    <option value="price_desc">Price ↓</option>
                    <option value="form">By Form</option>
                </select>
            </div>

            <div class="xfr-players-scroll" id="availablePlayers" role="list">
                <div class="xfr-loading">
                    <div class="xfr-spinner" aria-hidden="true"></div>
                    <p>Loading Premier League players…</p>
                </div>
            </div>
        </section>
    </div>

    <!-- Transfer Summary -->
    <section class="xfr-summary" id="transferSummary" aria-labelledby="summaryHeading">
        <div class="xfr-summary__head">
            <h3 id="summaryHeading">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                Transfer Summary
                <span class="xfr-badge" id="transferCount">0</span>
            </h3>
            <div class="xfr-summary__actions">
                <button class="xfr-btn xfr-btn--ghost xfr-btn--danger" onclick="saveDraft()" id="saveDraftBtn" disabled>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save Draft
                </button>
                <button class="xfr-btn xfr-btn--ghost xfr-btn--danger" onclick="clearTransfers()" id="clearBtn" disabled>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                    Clear All
                </button>
            </div>
        </div>

        <div class="xfr-transfers-list" id="transfersList" role="list" aria-live="polite">
            <div class="xfr-empty xfr-empty--inline">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M7 16V4m0 0L3 8m4-4l4 4"/><path d="M17 8v12m0 0l4-4m-4 4l-4-4"/></svg>
                <p>No transfers selected</p>
                <p class="xfr-empty__hint">Select a player from your team, then choose their replacement</p>
            </div>
        </div>

        <div class="xfr-summary__footer">
            <div class="xfr-budget-row">
                <div class="xfr-budget-item">
                    <span class="xfr-budget-item__label">Budget Change</span>
                    <span class="xfr-budget-item__val" id="budgetChange">£0.0M</span>
                </div>
                <div class="xfr-budget-item">
                    <span class="xfr-budget-item__label">Remaining Budget</span>
                    <span class="xfr-budget-item__val xfr-budget-item__val--primary" id="newBudget">£{{ number_format($fantasyTeam->remaining_budget ?? 0, 1) }}M</span>
                </div>
                <div class="xfr-budget-item">
                    <span class="xfr-budget-item__label">Hit Penalty</span>
                    <span class="xfr-budget-item__val" id="penaltyInfo">-0 pts</span>
                </div>
            </div>
            <button class="xfr-btn xfr-btn--primary xfr-btn--confirm" id="confirmBtn" onclick="confirmTransfers()" disabled aria-disabled="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                Confirm Transfers
            </button>
        </div>
    </section>
</div>

<style>
/* =========================================
   TRANSFERS — DESIGN SYSTEM
   ========================================= */
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap');

*, *::before, *::after { box-sizing: border-box; }

:root {
    --c-bg:        #f4f6fb;
    --c-surface:   #ffffff;
    --c-border:    #e2e8f4;
    --c-border-md: #c9d3e8;
    --c-text:      #0f172a;
    --c-muted:     #64748b;
    --c-faint:     #94a3b8;
    --c-blue:      #2563eb;
    --c-blue-dk:   #1d4ed8;
    --c-blue-lt:   #dbeafe;
    --c-blue-mid:  #93c5fd;
    --c-green:     #16a34a;
    --c-green-lt:  #dcfce7;
    --c-red:       #dc2626;
    --c-red-lt:    #fee2e2;
    --c-amber:     #d97706;
    --c-amber-lt:  #fef3c7;
    --pos-gk:      #f59e0b;
    --pos-def:     #10b981;
    --pos-mid:     #3b82f6;
    --pos-fwd:     #ef4444;
    --radius-sm:   6px;
    --radius-md:   10px;
    --radius-lg:   16px;
    --radius-xl:   20px;
    --shadow-sm:   0 1px 3px rgba(0,0,0,.07), 0 1px 2px rgba(0,0,0,.04);
    --shadow-md:   0 4px 16px rgba(15,23,42,.08);
    --shadow-lg:   0 10px 30px rgba(15,23,42,.1);
    --font:        'DM Sans', system-ui, sans-serif;
    --font-mono:   'DM Mono', monospace;
    --transition:  0.18s cubic-bezier(.4,0,.2,1);
}

/* =========================================
   LAYOUT
   ========================================= */
.xfr-wrap {
    max-width: 1380px;
    margin: 0 auto;
    padding: 1.75rem 1.5rem 3rem;
    font-family: var(--font);
    color: var(--c-text);
}

/* =========================================
   HEADER
   ========================================= */
.xfr-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.5rem;
    background: var(--c-surface);
    border: 1px solid var(--c-border);
    border-radius: var(--radius-xl);
    padding: 1.25rem 1.75rem;
    margin-bottom: 1.5rem;
    box-shadow: var(--shadow-sm);
    flex-wrap: wrap;
}

.xfr-header__left {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.xfr-header__icon {
    width: 46px;
    height: 46px;
    background: var(--c-blue);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    flex-shrink: 0;
}

.xfr-header__icon svg { width: 22px; height: 22px; }

.xfr-header__title {
    font-size: 1.6rem;
    font-weight: 700;
    letter-spacing: -0.02em;
    margin: 0 0 2px;
    color: var(--c-text);
}

.xfr-header__sub {
    font-size: 0.8rem;
    color: var(--c-muted);
    margin: 0;
}

.xfr-header__stats {
    display: flex;
    align-items: center;
    gap: 0;
    background: var(--c-bg);
    border: 1px solid var(--c-border);
    border-radius: var(--radius-md);
    overflow: hidden;
}

.xfr-stat {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0.6rem 1.25rem;
    gap: 2px;
}

.xfr-stat__label {
    font-size: 0.68rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: .06em;
    color: var(--c-muted);
}

.xfr-stat__value {
    font-size: 1rem;
    font-weight: 700;
    color: var(--c-text);
    font-family: var(--font-mono);
}

.xfr-stat-divider {
    width: 1px;
    height: 36px;
    background: var(--c-border);
}

/* =========================================
   TOAST
   ========================================= */
.xfr-toast {
    position: fixed;
    bottom: 1.5rem;
    left: 50%;
    transform: translateX(-50%) translateY(120%);
    background: var(--c-text);
    color: #fff;
    padding: 0.75rem 1.5rem;
    border-radius: var(--radius-md);
    font-size: 0.875rem;
    font-weight: 500;
    z-index: 9999;
    transition: transform .3s cubic-bezier(.34,1.56,.64,1);
    white-space: nowrap;
    box-shadow: var(--shadow-lg);
}

.xfr-toast.show {
    transform: translateX(-50%) translateY(0);
}

.xfr-toast.success { background: var(--c-green); }
.xfr-toast.error   { background: var(--c-red); }
.xfr-toast.info    { background: var(--c-blue); }

/* =========================================
   TWO-COLUMN GRID
   ========================================= */
.xfr-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.25rem;
    margin-bottom: 1.25rem;
    align-items: start;
}

/* =========================================
   PANELS
   ========================================= */
.xfr-panel {
    background: var(--c-surface);
    border: 1px solid var(--c-border);
    border-radius: var(--radius-xl);
    padding: 1.5rem;
    box-shadow: var(--shadow-sm);
}

.xfr-panel__head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
    gap: 1rem;
}

.xfr-panel__title-row {
    display: flex;
    align-items: center;
    gap: 0.625rem;
}

.xfr-panel__ico {
    width: 18px;
    height: 18px;
    color: var(--c-blue);
    flex-shrink: 0;
}

.xfr-panel__title {
    font-size: 1rem;
    font-weight: 700;
    margin: 0;
    color: var(--c-text);
}

/* =========================================
   BADGE
   ========================================= */
.xfr-badge {
    display: inline-flex;
    align-items: center;
    background: var(--c-blue-lt);
    color: var(--c-blue);
    font-size: 0.7rem;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 20px;
    font-family: var(--font-mono);
}

/* =========================================
   INSTRUCTIONS
   ========================================= */
.xfr-instructions {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--c-blue-lt);
    color: var(--c-blue);
    border-radius: var(--radius-md);
    padding: 0.6rem 0.875rem;
    font-size: 0.8rem;
    font-weight: 500;
    margin-bottom: 1rem;
    transition: var(--transition);
}

.xfr-instructions svg { width: 14px; height: 14px; flex-shrink: 0; }

.xfr-instructions.highlight {
    background: #fef9c3;
    color: #92400e;
}

/* =========================================
   PLAYER CARDS GRID
   ========================================= */
.xfr-players-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
    gap: 0.75rem;
}

.xfr-players-scroll {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
    gap: 0.75rem;
    max-height: 560px;
    overflow-y: auto;
    padding-right: 4px;
    scrollbar-width: thin;
    scrollbar-color: var(--c-border-md) transparent;
}

.xfr-players-scroll::-webkit-scrollbar { width: 5px; }
.xfr-players-scroll::-webkit-scrollbar-track { background: transparent; }
.xfr-players-scroll::-webkit-scrollbar-thumb { background: var(--c-border-md); border-radius: 10px; }

/* =========================================
   PLAYER CARD
   ========================================= */
.xfr-card {
    position: relative;
    background: var(--c-surface);
    border: 1.5px solid var(--c-border);
    border-radius: var(--radius-lg);
    padding: 0.875rem 0.75rem 0.75rem;
    cursor: pointer;
    text-align: center;
    transition: border-color var(--transition), box-shadow var(--transition), transform var(--transition);
    outline: none;
    overflow: hidden;
}

.xfr-card:hover {
    border-color: var(--c-blue-mid);
    box-shadow: 0 0 0 3px rgba(37,99,235,.08);
    transform: translateY(-2px);
}

.xfr-card:focus-visible {
    box-shadow: 0 0 0 3px rgba(37,99,235,.3);
}

.xfr-card.selected {
    border-color: var(--c-blue);
    background: #eff6ff;
    box-shadow: 0 0 0 3px rgba(37,99,235,.12);
    transform: translateY(-2px);
}

.xfr-card.in-transfer {
    border-color: var(--c-red);
    background: #fff5f5;
    opacity: .7;
    pointer-events: none;
}

.xfr-card__top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.625rem;
}

.xfr-card__badge {
    font-size: 0.6rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .04em;
    color: #fff;
    background: #64748b;
    padding: 2px 6px;
    border-radius: 4px;
}

.xfr-card__pos {
    font-size: 0.6rem;
    font-weight: 700;
    text-transform: uppercase;
    padding: 2px 6px;
    border-radius: 4px;
}

.pos-gk  { background: #fef3c7; color: #92400e; }
.pos-def { background: #d1fae5; color: #065f46; }
.pos-mid { background: #dbeafe; color: #1e40af; }
.pos-fwd { background: #fee2e2; color: #991b1b; }
.pos--   { background: #f1f5f9; color: #64748b; }

.xfr-card__avatar {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--c-blue), var(--c-blue-dk));
    color: #fff;
    font-weight: 700;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.5rem;
}

.xfr-card__name {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--c-text);
    line-height: 1.2;
    margin-bottom: 0.375rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.xfr-card__meta {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.7rem;
    font-family: var(--font-mono);
}

.xfr-card__price { color: var(--c-amber); font-weight: 600; }
.xfr-card__pts   { color: var(--c-blue); font-weight: 600; }

.xfr-card__select-ring {
    position: absolute;
    inset: 0;
    border-radius: inherit;
    pointer-events: none;
    border: 2px solid transparent;
    transition: border-color var(--transition);
}

.xfr-card.selected .xfr-card__select-ring { border-color: var(--c-blue); }

/* Available player cards (list style inside grid) */
.xfr-avail-card {
    position: relative;
    background: var(--c-surface);
    border: 1.5px solid var(--c-border);
    border-radius: var(--radius-lg);
    padding: 0.875rem 0.75rem 0.75rem;
    cursor: pointer;
    text-align: center;
    transition: border-color var(--transition), box-shadow var(--transition), transform var(--transition);
}

.xfr-avail-card:hover {
    border-color: var(--c-blue-mid);
    box-shadow: 0 0 0 3px rgba(37,99,235,.08);
    transform: translateY(-2px);
}

.xfr-avail-card__top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
}

.xfr-avail-card__avatar {
    width: 46px;
    height: 46px;
    border-radius: 50%;
    color: #fff;
    font-weight: 700;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.5rem;
}

.xfr-avail-card__name {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--c-text);
    line-height: 1.2;
    margin-bottom: 0.25rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.xfr-avail-card__meta {
    display: flex;
    justify-content: center;
    gap: 0.4rem;
    font-size: 0.68rem;
    font-family: var(--font-mono);
    flex-wrap: wrap;
}

.xfr-avail-card__price { color: var(--c-amber); font-weight: 600; }
.xfr-avail-card__pts   { color: var(--c-blue); font-weight: 600; }

.form-pill {
    font-size: 0.6rem;
    font-weight: 700;
    padding: 1px 5px;
    border-radius: 4px;
}
.form-good   { background: var(--c-green-lt); color: var(--c-green); }
.form-avg    { background: var(--c-amber-lt); color: var(--c-amber); }
.form-poor   { background: var(--c-red-lt);   color: var(--c-red); }

/* =========================================
   FILTERS
   ========================================= */
.xfr-filters {
    display: flex;
    gap: 0.625rem;
    margin-bottom: 1rem;
    flex-wrap: wrap;
    align-items: center;
}

.xfr-search {
    position: relative;
    flex: 1;
    min-width: 140px;
}

.xfr-search svg {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    width: 14px;
    height: 14px;
    color: var(--c-muted);
    pointer-events: none;
}

.xfr-search input {
    width: 100%;
    padding: 0.5rem 0.75rem 0.5rem 2rem;
    border: 1.5px solid var(--c-border);
    border-radius: var(--radius-md);
    font-family: var(--font);
    font-size: 0.82rem;
    color: var(--c-text);
    background: var(--c-surface);
    transition: border-color var(--transition), box-shadow var(--transition);
}

.xfr-search input:focus {
    outline: none;
    border-color: var(--c-blue);
    box-shadow: 0 0 0 3px rgba(37,99,235,.1);
}

.xfr-filters select {
    padding: 0.5rem 0.75rem;
    border: 1.5px solid var(--c-border);
    border-radius: var(--radius-md);
    font-family: var(--font);
    font-size: 0.82rem;
    color: var(--c-text);
    background: var(--c-surface);
    cursor: pointer;
    transition: border-color var(--transition);
}

.xfr-filters select:focus {
    outline: none;
    border-color: var(--c-blue);
}

/* =========================================
   BUTTONS
   ========================================= */
.xfr-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-family: var(--font);
    font-size: 0.82rem;
    font-weight: 600;
    border-radius: var(--radius-md);
    padding: 0.5rem 1rem;
    cursor: pointer;
    border: 1.5px solid transparent;
    transition: all var(--transition);
    text-decoration: none;
    white-space: nowrap;
}

.xfr-btn svg { width: 14px; height: 14px; flex-shrink: 0; }

.xfr-btn--primary {
    background: var(--c-blue);
    color: #fff;
    border-color: var(--c-blue);
}
.xfr-btn--primary:hover { background: var(--c-blue-dk); border-color: var(--c-blue-dk); }

.xfr-btn--ghost {
    background: transparent;
    color: var(--c-muted);
    border-color: var(--c-border);
}
.xfr-btn--ghost:hover { background: var(--c-bg); color: var(--c-text); border-color: var(--c-border-md); }

.xfr-btn--danger { color: var(--c-red); }
.xfr-btn--danger:hover { border-color: var(--c-red); background: var(--c-red-lt); }

.xfr-btn--confirm {
    padding: 0.7rem 1.75rem;
    font-size: 0.9rem;
}
.xfr-btn--confirm:disabled {
    background: var(--c-bg);
    color: var(--c-faint);
    border-color: var(--c-border);
    cursor: not-allowed;
    transform: none !important;
}

.xfr-btn:not(:disabled):hover { transform: translateY(-1px); }
.xfr-btn:not(:disabled):active { transform: translateY(0); }
.xfr-btn:disabled { cursor: not-allowed; }

/* =========================================
   TRANSFER SUMMARY
   ========================================= */
.xfr-summary {
    background: var(--c-surface);
    border: 1px solid var(--c-border);
    border-radius: var(--radius-xl);
    padding: 1.5rem;
    box-shadow: var(--shadow-sm);
}

.xfr-summary__head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--c-border);
    gap: 1rem;
    flex-wrap: wrap;
}

.xfr-summary__head h3 {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1rem;
    font-weight: 700;
    margin: 0;
    color: var(--c-text);
}

.xfr-summary__head h3 svg { width: 16px; height: 16px; color: var(--c-blue); }

.xfr-summary__actions {
    display: flex;
    gap: 0.5rem;
}

/* Transfer Items */
.xfr-transfers-list {
    min-height: 90px;
    margin-bottom: 1.25rem;
}

.xfr-transfer-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: var(--c-bg);
    border: 1px solid var(--c-border);
    border-radius: var(--radius-md);
    padding: 0.875rem 1rem;
    margin-bottom: 0.625rem;
    transition: background var(--transition);
    flex-wrap: wrap;
}

.xfr-transfer-item:hover { background: #eff6ff; border-color: var(--c-blue-mid); }

.xfr-transfer-half {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex: 1;
    min-width: 160px;
}

.xfr-transfer-half__badge {
    font-size: 0.6rem;
    font-weight: 700;
    color: #fff;
    padding: 3px 7px;
    border-radius: 5px;
    text-transform: uppercase;
    letter-spacing: .03em;
    flex-shrink: 0;
}

.xfr-transfer-half__info {}

.xfr-transfer-half__name {
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--c-text);
}

.xfr-transfer-half__detail {
    font-size: 0.72rem;
    color: var(--c-muted);
    font-family: var(--font-mono);
}

.xfr-transfer-arrow {
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--c-blue);
    flex-shrink: 0;
}

.xfr-transfer-arrow svg { width: 18px; height: 18px; }

.xfr-transfer-remove {
    background: none;
    border: none;
    color: var(--c-faint);
    cursor: pointer;
    padding: 4px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: color var(--transition), background var(--transition);
    flex-shrink: 0;
    margin-left: auto;
}

.xfr-transfer-remove:hover { color: var(--c-red); background: var(--c-red-lt); }
.xfr-transfer-remove svg { width: 14px; height: 14px; }

/* Summary Footer */
.xfr-summary__footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.5rem;
    padding-top: 1.25rem;
    border-top: 1px solid var(--c-border);
    flex-wrap: wrap;
}

.xfr-budget-row {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

.xfr-budget-item {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.xfr-budget-item__label {
    font-size: 0.68rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: .06em;
    color: var(--c-muted);
}

.xfr-budget-item__val {
    font-size: 1rem;
    font-weight: 700;
    font-family: var(--font-mono);
    color: var(--c-text);
}

.xfr-budget-item__val--primary { color: var(--c-blue); }
.xfr-budget-item__val--positive { color: var(--c-green); }
.xfr-budget-item__val--negative { color: var(--c-red); }

/* =========================================
   EMPTY + LOADING
   ========================================= */
.xfr-empty {
    text-align: center;
    padding: 2.5rem 1rem;
    color: var(--c-muted);
}

.xfr-empty svg {
    width: 40px;
    height: 40px;
    color: var(--c-border-md);
    margin-bottom: 0.75rem;
}

.xfr-empty p { margin: 0; font-size: 0.875rem; }
.xfr-empty__hint { font-size: 0.77rem; color: var(--c-faint); margin-top: 4px !important; }

.xfr-empty--inline { padding: 1.5rem 1rem; }

.xfr-loading {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    padding: 3rem 1rem;
    color: var(--c-muted);
    font-size: 0.85rem;
    grid-column: 1 / -1;
}

.xfr-spinner {
    width: 28px;
    height: 28px;
    border: 3px solid var(--c-border);
    border-top-color: var(--c-blue);
    border-radius: 50%;
    animation: spin .7s linear infinite;
}

@keyframes spin { to { transform: rotate(360deg); } }

/* =========================================
   RESPONSIVE
   ========================================= */
@media (max-width: 1024px) {
    .xfr-grid { grid-template-columns: 1fr; }
    .xfr-players-scroll { max-height: 420px; }
}

@media (max-width: 640px) {
    .xfr-wrap { padding: 1rem 0.875rem 2rem; }
    .xfr-header { flex-direction: column; align-items: flex-start; }
    .xfr-header__stats { width: 100%; justify-content: center; }
    .xfr-summary__footer { flex-direction: column; align-items: flex-start; }
    .xfr-btn--confirm { width: 100%; justify-content: center; }
    .xfr-budget-row { gap: 1rem; }
    .xfr-players-grid { grid-template-columns: repeat(auto-fill, minmax(110px, 1fr)); }
}
</style>

<script>
// ============================================
// CONFIGURATION
// ============================================
const INITIAL_BUDGET = {{ (float)($fantasyTeam->remaining_budget ?? 0) }};
const FREE_TRANSFERS = {{ (int)($freeTransfers ?? 1) }};

const TEAM_COLORS = {
    'ARS':'#EF0107','CHE':'#034694','LIV':'#C8102E','MUN':'#DA291C',
    'MCI':'#6CABDD','TOT':'#132257','NEW':'#241F20','BHA':'#0057B8',
    'WHU':'#7A263A','CRY':'#1B458F','EVE':'#003399','LEI':'#003090',
    'WOL':'#FDB913','AVL':'#670E36','LEE':'#FFCD00','SOU':'#D71920',
    'FUL':'#000000','NFO':'#DD0000','BOU':'#DA291C','BRE':'#E30613',
    'Unknown':'#94a3b8'
};

// ============================================
// STATE
// ============================================
let selectedPlayer  = null;
let transfers       = [];
let availablePlayers = [];
let toastTimer      = null;

// ============================================
// UTILS
// ============================================
function teamColor(t) { return TEAM_COLORS[t] || '#94a3b8'; }
function fmtPrice(p)  { return '£' + parseFloat(p).toFixed(1) + 'M'; }
function initials(n)  { return n.split(/\s+/).map(w => w[0]).join('').toUpperCase().slice(0, 2); }

function toast(msg, type = 'info', duration = 3000) {
    const el = document.getElementById('xfrToast');
    el.textContent = msg;
    el.className = 'xfr-toast show ' + type;
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => { el.classList.remove('show'); }, duration);
}

// ============================================
// TEAM BADGE COLORS — applied on load
// ============================================
function applyBadgeColors() {
    document.querySelectorAll('.xfr-card__badge').forEach(el => {
        const team = el.getAttribute('data-team') || el.textContent.trim();
        el.style.backgroundColor = teamColor(team);
    });
}

// ============================================
// LOAD AVAILABLE PLAYERS
// ============================================
async function loadAvailablePlayers() {
    const container = document.getElementById('availablePlayers');
    container.innerHTML = '<div class="xfr-loading"><div class="xfr-spinner"></div><p>Loading Premier League players…</p></div>';

    try {
        // Use a CORS-friendly proxy for the FPL API
        const url = '/api/fpl/bootstrap-static';  // Proxy through your Laravel backend
        let data;

        try {
            const r = await fetch(url);
            if (!r.ok) throw new Error('proxy_fail');
            data = await r.json();
        } catch (e) {
            // Fallback: direct FPL call (works in some environments)
            const r2 = await fetch('https://fantasy.premierleague.com/api/bootstrap-static/');
            if (!r2.ok) throw new Error('fpl_fail');
            data = await r2.json();
        }

        const posMap = { 1: 'GK', 2: 'DEF', 3: 'MID', 4: 'FWD' };

        availablePlayers = data.elements.map(p => {
            const team = data.teams.find(t => t.id === p.team);
            return {
                id:          p.id,
                name:        p.web_name,
                full_name:   (p.first_name + ' ' + p.second_name).trim(),
                position:    posMap[p.element_type] || '-',
                team:        team ? team.short_name : 'UNK',
                price:       parseFloat((p.now_cost / 10).toFixed(1)),
                points:      p.total_points,
                form:        parseFloat(p.form) || 0,
                selected_by: parseFloat(p.selected_by_percent) || 0,
                minutes:     p.minutes || 0
            };
        });

        availablePlayers.sort((a, b) => b.points - a.points);
        updateAvailableCount(availablePlayers.length);
        renderAvailablePlayers(availablePlayers);

    } catch (err) {
        console.error('FPL load error:', err);
        container.innerHTML = `
            <div class="xfr-empty" style="grid-column:1/-1">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <p>Could not load players.</p>
                <p class="xfr-empty__hint">Add a proxy route at <code>/api/fpl/bootstrap-static</code> or ensure CORS allows direct access.</p>
                <button onclick="loadAvailablePlayers()" class="xfr-btn xfr-btn--primary" style="margin-top:1rem">Retry</button>
            </div>
        `;
    }
}

function updateAvailableCount(n) {
    document.getElementById('availableCount').textContent = n;
}

// ============================================
// RENDER AVAILABLE PLAYERS
// ============================================
function renderAvailablePlayers(players) {
    const container = document.getElementById('availablePlayers');

    if (!players.length) {
        container.innerHTML = `
            <div class="xfr-empty" style="grid-column:1/-1">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <p>No players match your filters.</p>
            </div>
        `;
        return;
    }

    container.innerHTML = players.map(p => {
        const tc   = teamColor(p.team);
        const init = initials(p.name);
        const fc   = p.form >= 7 ? 'form-good' : p.form >= 4 ? 'form-avg' : 'form-poor';
        const posClass = 'pos-' + p.position.toLowerCase();

        return `
            <div class="xfr-avail-card" role="listitem" onclick='handleReplacement(${JSON.stringify(p).replace(/'/g,"&#39;")})' title="${p.full_name}">
                <div class="xfr-avail-card__top">
                    <span class="xfr-card__badge" style="background:${tc}">${p.team}</span>
                    <span class="xfr-card__pos ${posClass}">${p.position}</span>
                </div>
                <div class="xfr-avail-card__avatar" style="background:linear-gradient(135deg,${tc}cc,${tc})">
                    ${init}
                </div>
                <div class="xfr-avail-card__name">${p.name}</div>
                <div class="xfr-avail-card__meta">
                    <span class="xfr-avail-card__price">${fmtPrice(p.price)}</span>
                    <span class="xfr-avail-card__pts">${p.points}pts</span>
                    <span class="form-pill ${fc}">${p.form}</span>
                </div>
            </div>
        `;
    }).join('');

    updateAvailableCount(players.length);
}

// ============================================
// FILTER & SORT
// ============================================
function filterPlayers() {
    const q    = document.getElementById('playerSearch').value.toLowerCase().trim();
    const pos  = document.getElementById('positionFilter').value;
    const sort = document.getElementById('sortBy').value;

    let list = availablePlayers.filter(p =>
        (!q   || p.name.toLowerCase().includes(q) || p.full_name.toLowerCase().includes(q) || p.team.toLowerCase().includes(q)) &&
        (!pos || p.position === pos)
    );

    if      (sort === 'price_asc')  list.sort((a, b) => a.price - b.price);
    else if (sort === 'price_desc') list.sort((a, b) => b.price - a.price);
    else if (sort === 'form')       list.sort((a, b) => b.form - a.form);
    else                            list.sort((a, b) => b.points - a.points);

    renderAvailablePlayers(list);
}

// ============================================
// SELECT MY TEAM PLAYER
// ============================================
function selectPlayer(el) {
    // Deselect all
    document.querySelectorAll('#myTeamPlayers .xfr-card').forEach(c => c.classList.remove('selected'));

    // If clicking already-selected → deselect
    const pid = el.getAttribute('data-player-id');
    if (selectedPlayer && selectedPlayer.id == pid) {
        selectedPlayer = null;
        resetHint();
        return;
    }

    el.classList.add('selected');

    selectedPlayer = {
        id:       pid,
        position: el.getAttribute('data-position'),
        price:    parseFloat(el.getAttribute('data-price')),
        name:     el.getAttribute('data-name'),
        team:     el.getAttribute('data-team'),
        points:   parseInt(el.getAttribute('data-points')) || 0
    };

    const hint = document.getElementById('selectionHint');
    hint.className = 'xfr-instructions highlight';
    hint.innerHTML = `
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 16V4m0 0L3 8m4-4l4 4"/><path d="M17 8v12m0 0l4-4m-4 4l-4-4"/></svg>
        Replacing <strong>${selectedPlayer.name}</strong> — now pick a ${selectedPlayer.position} replacement →
    `;

    // Auto-set position filter
    document.getElementById('positionFilter').value = selectedPlayer.position;
    filterPlayers();
}

function resetHint() {
    const hint = document.getElementById('selectionHint');
    hint.className = 'xfr-instructions';
    hint.innerHTML = `
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        Click a player to select them for transfer
    `;
    document.getElementById('positionFilter').value = '';
    filterPlayers();
}

// ============================================
// HANDLE REPLACEMENT SELECTION
// ============================================
function handleReplacement(player) {
    if (!selectedPlayer) {
        toast('Select a player from your team first!', 'error');
        return;
    }

    if (selectedPlayer.position !== player.position) {
        toast(`Position mismatch: need ${selectedPlayer.position}, selected ${player.position}`, 'error');
        return;
    }

    // Prevent replacing with same player
    if (selectedPlayer.id && selectedPlayer.id == player.id) {
        toast('Cannot replace a player with themselves', 'error');
        return;
    }

    // Check duplicate transfer-in
    if (transfers.some(t => t.in.id === player.id)) {
        toast(`${player.name} is already in your transfer list`, 'error');
        return;
    }

    // Check budget
    const totalCostSoFar = transfers.reduce((s, t) => s + (t.in.price - t.out.price), 0);
    const thisCost = player.price - selectedPlayer.price;
    if (INITIAL_BUDGET + totalCostSoFar + thisCost < 0) {
        toast('Insufficient budget for this transfer', 'error');
        return;
    }

    // Mark outgoing card
    document.querySelectorAll('#myTeamPlayers .xfr-card').forEach(c => {
        if (c.getAttribute('data-player-id') == selectedPlayer.id) {
            c.classList.remove('selected');
            c.classList.add('in-transfer');
        }
    });

    transfers.push({ out: { ...selectedPlayer }, in: { ...player } });

    selectedPlayer = null;
    resetHint();
    renderSummary();
    toast(`${player.name} added to transfers`, 'success');
}

// ============================================
// REMOVE SINGLE TRANSFER
// ============================================
function removeTransfer(index) {
    const removed = transfers.splice(index, 1)[0];

    // Un-mark card
    document.querySelectorAll('#myTeamPlayers .xfr-card').forEach(c => {
        if (c.getAttribute('data-player-id') == removed.out.id) {
            c.classList.remove('in-transfer');
        }
    });

    renderSummary();
    toast(`Transfer for ${removed.out.name} removed`, 'info');
}

// ============================================
// RENDER TRANSFER SUMMARY
// ============================================
function renderSummary() {
    const list       = document.getElementById('transfersList');
    const chEl       = document.getElementById('budgetChange');
    const nbEl       = document.getElementById('newBudget');
    const penEl      = document.getElementById('penaltyInfo');
    const confirmBtn = document.getElementById('confirmBtn');
    const clearBtn   = document.getElementById('clearBtn');
    const saveBtn    = document.getElementById('saveDraftBtn');
    const countBadge = document.getElementById('transferCount');

    countBadge.textContent = transfers.length;

    if (!transfers.length) {
        list.innerHTML = `
            <div class="xfr-empty xfr-empty--inline">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M7 16V4m0 0L3 8m4-4l4 4"/><path d="M17 8v12m0 0l4-4m-4 4l-4-4"/></svg>
                <p>No transfers selected</p>
                <p class="xfr-empty__hint">Select a player from your team, then choose their replacement</p>
            </div>
        `;
        confirmBtn.disabled = true;
        confirmBtn.setAttribute('aria-disabled', 'true');
        clearBtn.disabled = true;
        saveBtn.disabled  = true;
        chEl.textContent  = '£0.0M';
        chEl.className    = 'xfr-budget-item__val';
        nbEl.textContent  = fmtPrice(INITIAL_BUDGET);
        penEl.textContent = '-0 pts';
        return;
    }

    const totalChange = transfers.reduce((s, t) => s + (t.in.price - t.out.price), 0);
    const newBudget   = INITIAL_BUDGET + totalChange;
    const extraHits   = Math.max(0, transfers.length - FREE_TRANSFERS);
    const penalty     = extraHits * 4;

    list.innerHTML = transfers.map((t, i) => {
        const oc = teamColor(t.out.team);
        const ic = teamColor(t.in.team);
        const diff = t.in.price - t.out.price;
        const diffStr = (diff >= 0 ? '+' : '') + fmtPrice(diff);
        const diffClass = diff >= 0 ? 'xfr-budget-item__val--positive' : 'xfr-budget-item__val--negative';

        return `
            <div class="xfr-transfer-item" role="listitem">
                <div class="xfr-transfer-half">
                    <span class="xfr-transfer-half__badge" style="background:${oc}">${t.out.team.slice(0,3)}</span>
                    <div class="xfr-transfer-half__info">
                        <div class="xfr-transfer-half__name">${t.out.name}</div>
                        <div class="xfr-transfer-half__detail">${t.out.position} · ${fmtPrice(t.out.price)}</div>
                    </div>
                </div>
                <div class="xfr-transfer-arrow">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </div>
                <div class="xfr-transfer-half">
                    <span class="xfr-transfer-half__badge" style="background:${ic}">${t.in.team}</span>
                    <div class="xfr-transfer-half__info">
                        <div class="xfr-transfer-half__name">${t.in.name}</div>
                        <div class="xfr-transfer-half__detail">${t.in.position} · ${fmtPrice(t.in.price)} <span class="${diffClass}" style="font-size:.68rem">${diffStr}</span></div>
                    </div>
                </div>
                <button class="xfr-transfer-remove" onclick="removeTransfer(${i})" title="Remove this transfer" aria-label="Remove ${t.out.name} transfer">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
        `;
    }).join('');

    // Budget change
    chEl.textContent = (totalChange >= 0 ? '+' : '') + fmtPrice(totalChange);
    chEl.className   = 'xfr-budget-item__val ' + (totalChange >= 0 ? 'xfr-budget-item__val--positive' : 'xfr-budget-item__val--negative');

    nbEl.textContent  = fmtPrice(newBudget);
    nbEl.className    = 'xfr-budget-item__val xfr-budget-item__val--primary' + (newBudget < 0 ? ' xfr-budget-item__val--negative' : '');
    penEl.textContent = penalty > 0 ? `-${penalty} pts (${extraHits} hit${extraHits > 1 ? 's' : ''})` : '-0 pts';

    const canConfirm = newBudget >= 0;
    confirmBtn.disabled = !canConfirm;
    confirmBtn.setAttribute('aria-disabled', String(!canConfirm));
    clearBtn.disabled = false;
    saveBtn.disabled  = false;
}

// ============================================
// CLEAR ALL TRANSFERS
// ============================================
function clearTransfers() {
    if (!transfers.length) return;
    if (!confirm('Clear all pending transfers?')) return;

    transfers = [];
    selectedPlayer = null;

    document.querySelectorAll('#myTeamPlayers .xfr-card').forEach(c => {
        c.classList.remove('selected', 'in-transfer');
    });

    resetHint();
    renderSummary();
    toast('All transfers cleared', 'info');
}

// ============================================
// CONFIRM TRANSFERS
// ============================================
async function confirmTransfers() {
    if (!transfers.length) return;

    const totalChange = transfers.reduce((s, t) => s + (t.in.price - t.out.price), 0);
    const newBudget   = INITIAL_BUDGET + totalChange;

    if (newBudget < 0) {
        toast('Cannot confirm — insufficient budget!', 'error');
        return;
    }

    const btn = document.getElementById('confirmBtn');
    const orig = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<div class="xfr-spinner" style="width:16px;height:16px;border-width:2px;border-color:rgba(255,255,255,.3);border-top-color:#fff"></div> Processing…';

    try {
        const payload = {
            transfers: transfers.map(t => ({
                element_in:  t.in.id,
                element_out: t.out.id,
                purchase_price: Math.round(t.in.price * 10),
                selling_price:  Math.round(t.out.price * 10)
            })),
            _token: document.querySelector('meta[name="csrf-token"]')?.content ?? ''
        };

        const res = await fetch('{{ route("transfers.confirm") }}', {
            method:  'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': payload._token },
            body:    JSON.stringify(payload)
        });

        if (!res.ok) {
            const err = await res.json().catch(() => ({}));
            throw new Error(err.message || 'Server error');
        }

        toast('Transfers confirmed successfully!', 'success', 4000);

        // Clear state
        transfers = [];
        selectedPlayer = null;
        document.querySelectorAll('#myTeamPlayers .xfr-card').forEach(c => c.classList.remove('selected', 'in-transfer'));
        resetHint();
        renderSummary();
        localStorage.removeItem('transferDraft');

        // Reload after brief delay so toast is visible
        setTimeout(() => window.location.reload(), 1800);

    } catch (err) {
        toast(err.message || 'Transfer failed. Please try again.', 'error');
        btn.disabled = false;
        btn.innerHTML = orig;
    }
}

// ============================================
// AUTO SELECT (placeholder)
// ============================================
function autoSelectTeam() {
    toast('Auto-select is coming soon — it will optimise your team by form & fixtures', 'info', 4000);
}

// ============================================
// DRAFT PERSISTENCE
// ============================================
function saveDraft() {
    if (!transfers.length) return;
    localStorage.setItem('transferDraft', JSON.stringify(transfers));
    toast('Draft saved locally', 'success');
}

function loadDraft() {
    try {
        const raw = localStorage.getItem('transferDraft');
        if (!raw) return;
        const draft = JSON.parse(raw);
        if (!Array.isArray(draft) || !draft.length) return;
        if (confirm(`You have ${draft.length} saved transfer(s). Load draft?`)) {
            transfers = draft;
            renderSummary();
            toast('Draft loaded', 'info');
        }
    } catch (e) {
        localStorage.removeItem('transferDraft');
    }
}

// ============================================
// INIT
// ============================================
document.addEventListener('DOMContentLoaded', () => {
    applyBadgeColors();
    loadAvailablePlayers();
    loadDraft();
});
</script>
@endsection