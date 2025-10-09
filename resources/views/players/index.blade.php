@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h1 class="mb-4">Players by Team</h1>

    {{-- Team Selection --}}
    <form action="{{ route('players.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <select name="team_id" class="form-select" onchange="this.form.submit()">
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ $teamId == $team->id ? 'selected' : '' }}>
                        {{ $team->name }} ({{ $team->players_count }})
                    </option>
                @endforeach
            </select>
            <button class="btn btn-primary" type="submit">View</button>
        </div>
    </form>

    {{-- Team Info --}}
    @if($selectedTeam)
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    @if($selectedTeam->crest)
                        <img src="{{ $selectedTeam->crest }}" alt="{{ $selectedTeam->name }}" width="60" class="me-3">
                    @endif
                    <div>
                        <h3 class="mb-1">{{ $selectedTeam->name }}</h3>
                        <p class="text-muted mb-0">{{ $selectedTeam->venue }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Players Table --}}
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Nationality</th>
                            <th>Goals</th>
                            <th>Assists</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($selectedTeam->players as $player)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $player->name ?? $player->first_name . ' ' . $player->last_name }}</td>
                                <td>{{ $player->position ?? '—' }}</td>
                                <td>{{ $player->nationality ?? '—' }}</td>
                                <td>{{ $player->goals_scored }}</td>
                                <td>{{ $player->assists }}</td>
                                <td>{{ $player->total_points }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No players found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <p class="text-muted">No team selected.</p>
    @endif

</div>
@endsection
