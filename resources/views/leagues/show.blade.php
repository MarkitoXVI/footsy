@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Team Header -->
    <div class="team-header" style="background: linear-gradient(135deg, #3a5ee5, #2a48c5); color: white; padding: 2rem; border-radius: 12px; margin-bottom: 2rem;">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-2" style="font-family: 'Montserrat', sans-serif; font-weight: 700;">{{ $team->name }}</h1>
                <div class="d-flex gap-4">
                    <div>
                        <small style="opacity: 0.8;">Formation</small>
                        <div style="font-size: 1.2rem; font-weight: 600;">{{ $team->formation }}</div>
                    </div>
                    <div>
                        <small style="opacity: 0.8;">Total Budget</small>
                        <div style="font-size: 1.2rem; font-weight: 600;">£{{ number_format($team->total_budget, 1) }}M</div>
                    </div>
                    <div>
                        <small style="opacity: 0.8;">Budget Used</small>
                        <div style="font-size: 1.2rem; font-weight: 600;">£{{ number_format($team->spent_budget, 1) }}M</div>
                    </div>
                    <div>
                        <small style="opacity: 0.8;">Budget Remaining</small>
                        <div style="font-size: 1.2rem; font-weight: 600; color: {{ $team->remaining_budget >= 0 ? '#34c759' : '#e53e3e' }}">
                            £{{ number_format($team->remaining_budget, 1) }}M
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('fantasy-team.edit', $team) }}" class="btn btn-light me-2">
                    <i class="fas fa-edit"></i> Edit Team
                </a>
                <a href="{{ route('fantasy-team.index') }}" class="btn btn-outline-light">
                    <i class="fas fa-arrow-left"></i> Back to Teams
                </a>
            </div>
        </div>
    </div>

    <!-- Football Pitch with Formation -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header" style="background: #2e7d32; color: white;">
                    <h4 class="mb-0"><i class="fas fa-futbol me-2"></i>Starting XI - {{ $team->formation }} Formation</h4>
                </div>
                <div class="card-body p-0">
                    <div class="pitch-container" style="background: linear-gradient(#2e7d32, #1b5e20); padding: 2rem; position: relative; min-height: 500px;">
                        <!-- Football Pitch Background -->
                        <div class="football-pitch" style="border: 2px solid rgba(255, 255, 255, 0.3); border-radius: 8px; height: 400px; position: relative; background: url('data:image/svg+xml,%3Csvg width=\"100\" height=\"100\" viewBox=\"0 0 100 100\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cpath d=\"M0 50 L100 50 M50 0 L50 100 M0 0 L100 100 M100 0 L0 100\" stroke=\"%23ffffff\" stroke-width=\"0.5\" stroke-opacity=\"0.1\" fill=\"none\"/%3E%3Ccircle cx=\"50\" cy=\"50\" r=\"10\" stroke=\"%23ffffff\" stroke-width=\"0.5\" stroke-opacity=\"0.1\" fill=\"none\"/%3E%3C/svg%3E'); background-size: 100px 100px;">
                            
                            @php
                                // Group players by position and substitute status
                                $startingPlayers = $team->players->where('pivot.is_substitute', false)->sortBy('pivot.position_order');
                                $substitutePlayers = $team->players->where('pivot.is_substitute', true)->sortBy('pivot.position_order');
                                
                                $goalkeepers = $startingPlayers->where('position', 'Goalkeeper');
                                $defenders = $startingPlayers->where('position', 'Defender');
                                $midfielders = $startingPlayers->where('position', 'Midfielder');
                                $forwards = $startingPlayers->where('position', 'Forward');
                            @endphp

                            <!-- Goalkeeper Row -->
                            <div class="position-row" style="position: absolute; top: 5%; left: 0; right: 0; display: flex; justify-content: center;">
                                @foreach($goalkeepers as $player)
                                <div class="player-card" style="text-align: center; margin: 0 1rem;">
                                    <div class="player-avatar" style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #3a5ee5, #2a48c5); display: flex; align-items: center; justify-content: center; margin: 0 auto 0.5rem; border: 2px solid white; color: white; font-weight: 600; font-size: 0.8rem;">
                                        {{ $player->team }}
                                    </div>
                                    <div class="player-info" style="color: white; text-shadow: 0 1px 2px rgba(0,0,0,0.5);">
                                        <div style="font-size: 0.7rem; font-weight: 600;">{{ $player->name }}</div>
                                        <div style="font-size: 0.6rem; opacity: 0.9;">£{{ $player->price }}M</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Defenders Row -->
                            <div class="position-row" style="position: absolute; top: 25%; left: 0; right: 0; display: flex; justify-content: space-around;">
                                @foreach($defenders as $player)
                                <div class="player-card" style="text-align: center;">
                                    <div class="player-avatar" style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #3a5ee5, #2a48c5); display: flex; align-items: center; justify-content: center; margin: 0 auto 0.5rem; border: 2px solid white; color: white; font-weight: 600; font-size: 0.7rem;">
                                        {{ $player->team }}
                                    </div>
                                    <div class="player-info" style="color: white; text-shadow: 0 1px 2px rgba(0,0,0,0.5);">
                                        <div style="font-size: 0.6rem; font-weight: 600;">{{ \Illuminate\Support\Str::limit($player->name, 12) }}</div>
                                        <div style="font-size: 0.5rem; opacity: 0.9;">£{{ $player->price }}M</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Midfielders Row -->
                            <div class="position-row" style="position: absolute; top: 50%; left: 0; right: 0; display: flex; justify-content: space-around;">
                                @foreach($midfielders as $player)
                                <div class="player-card" style="text-align: center;">
                                    <div class="player-avatar" style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #3a5ee5, #2a48c5); display: flex; align-items: center; justify-content: center; margin: 0 auto 0.5rem; border: 2px solid white; color: white; font-weight: 600; font-size: 0.7rem;">
                                        {{ $player->team }}
                                    </div>
                                    <div class="player-info" style="color: white; text-shadow: 0 1px 2px rgba(0,0,0,0.5);">
                                        <div style="font-size: 0.6rem; font-weight: 600;">{{ \Illuminate\Support\Str::limit($player->name, 12) }}</div>
                                        <div style="font-size: 0.5rem; opacity: 0.9;">£{{ $player->price }}M</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Forwards Row -->
                            <div class="position-row" style="position: absolute; top: 75%; left: 0; right: 0; display: flex; justify-content: space-around;">
                                @foreach($forwards as $player)
                                <div class="player-card" style="text-align: center;">
                                    <div class="player-avatar" style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #3a5ee5, #2a48c5); display: flex; align-items: center; justify-content: center; margin: 0 auto 0.5rem; border: 2px solid white; color: white; font-weight: 600; font-size: 0.7rem;">
                                        {{ $player->team }}
                                    </div>
                                    <div class="player-info" style="color: white; text-shadow: 0 1px 2px rgba(0,0,0,0.5);">
                                        <div style="font-size: 0.6rem; font-weight: 600;">{{ \Illuminate\Support\Str::limit($player->name, 12) }}</div>
                                        <div style="font-size: 0.5rem; opacity: 0.9;">£{{ $player->price }}M</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Statistics and Substitutes -->
        <div class="col-lg-4">
            <!-- Budget Summary -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-coins me-2"></i>Budget Summary</h5>
                </div>
                <div class="card-body">
                    <div class="budget-progress mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small>Budget Used</small>
                            <small><strong>£{{ number_format($team->spent_budget, 1) }}M</strong> / £{{ number_format($team->total_budget, 1) }}M</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            @php
                                $budgetPercentage = ($team->spent_budget / $team->total_budget) * 100;
                                $progressColor = $budgetPercentage <= 80 ? 'bg-success' : ($budgetPercentage <= 95 ? 'bg-warning' : 'bg-danger');
                            @endphp
                            <div class="progress-bar {{ $progressColor }}" role="progressbar" style="width: {{ $budgetPercentage }}%"></div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="border-end">
                                <div style="font-size: 1.5rem; font-weight: 700; color: #3a5ee5;">£{{ number_format($team->total_budget, 1) }}M</div>
                                <small class="text-muted">Total</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border-end">
                                <div style="font-size: 1.5rem; font-weight: 700; color: #e53e3e;">£{{ number_format($team->spent_budget, 1) }}M</div>
                                <small class="text-muted">Spent</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div style="font-size: 1.5rem; font-weight: 700; color: #34c759;">£{{ number_format($team->remaining_budget, 1) }}M</div>
                            <small class="text-muted">Remaining</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Substitute Bench -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-users me-2"></i>Substitute Bench</h5>
                </div>
                <div class="card-body">
                    @if($substitutePlayers->count() > 0)
                        <div class="substitutes-list">
                            @foreach($substitutePlayers as $player)
                            <div class="substitute-player d-flex align-items-center mb-3 p-2 border rounded">
                                <div class="player-avatar me-3" style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #6c757d, #495057); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 0.7rem;">
                                    {{ $player->team }}
                                </div>
                                <div class="player-info flex-grow-1">
                                    <div style="font-weight: 600; font-size: 0.9rem;">{{ $player->name }}</div>
                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted">{{ $player->position }}</small>
                                        <small class="text-warning fw-bold">£{{ $player->price }}M</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center text-muted py-3">
                            <i class="fas fa-users fa-2x mb-2"></i>
                            <p>No substitutes selected</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Player List -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-list me-2"></i>Full Squad Details</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Player</th>
                                    <th>Position</th>
                                    <th>Team</th>
                                    <th>Price</th>
                                    <th>Points</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($team->players->sortBy('pivot.position_order') as $player)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-3" style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #3a5ee5, #2a48c5); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 0.7rem;">
                                                {{ $player->team }}
                                            </div>
                                            <div>
                                                <div style="font-weight: 600;">{{ $player->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge 
                                            @if($player->position == 'Goalkeeper') bg-primary
                                            @elseif($player->position == 'Defender') bg-success
                                            @elseif($player->position == 'Midfielder') bg-warning
                                            @else bg-danger
                                            @endif">
                                            {{ $player->position }}
                                        </span>
                                    </td>
                                    <td>{{ $player->team }}</td>
                                    <td class="fw-bold text-warning">£{{ $player->price }}M</td>
                                    <td class="fw-bold text-primary">{{ $player->points }}</td>
                                    <td>
                                        @if($player->pivot->is_substitute)
                                            <span class="badge bg-secondary">Substitute</span>
                                        @else
                                            <span class="badge bg-success">Starting XI</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-dark">
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td class="fw-bold text-warning">£{{ number_format($team->spent_budget, 1) }}M</td>
                                    <td class="fw-bold text-primary">{{ $team->players->sum('points') }}</td>
                                    <td>{{ $team->players->count() }} players</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex gap-2 justify-content-end">
                <a href="{{ route('fantasy-team.edit', $team) }}" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Edit Team
                </a>
                <a href="{{ route('transfers.index') }}" class="btn btn-success">
                    <i class="fas fa-exchange-alt me-2"></i>Make Transfers
                </a>
                <a href="{{ route('fantasy-team.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Teams
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.position-row {
    animation: fadeInUp 0.6s ease-out;
}

.player-card {
    animation: popIn 0.5s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes popIn {
    0% {
        opacity: 0;
        transform: scale(0.8);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

.budget-progress .progress {
    background-color: #e9ecef;
    border-radius: 4px;
}

.substitute-player {
    transition: all 0.3s ease;
    border: 1px solid #dee2e6 !important;
}

.substitute-player:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

.table tbody tr {
    transition: background-color 0.2s ease;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}
</style>
@endsection