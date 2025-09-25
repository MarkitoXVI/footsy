@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $team->name }}</h1>
    <p><strong>Formation:</strong> {{ $team->formation }}</p>
    <p><strong>Budget Used:</strong> £{{ number_format($team->spent_budget, 1) }}M</p>
    <h3>Players</h3>
    <pre>{{ print_r(json_decode($team->players, true), true) }}</pre>
    <a href="{{ route('fantasy-team.index') }}" class="btn btn-secondary">Back to Teams</a>
</div>
@endsection