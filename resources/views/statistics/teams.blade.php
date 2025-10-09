@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Team Statistics</h1>
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>Team</th>
                    <th>Short Name</th>
                    <th>Total Goals</th>
                    <th>Total Points</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teams as $team)
                    <tr>
                        <td>{{ $team->name }}</td>
                        <td>{{ $team->short_name }}</td>
                        <td>{{ $team->total_goals ?? 0 }}</td>
                        <td>{{ $team->total_points ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
