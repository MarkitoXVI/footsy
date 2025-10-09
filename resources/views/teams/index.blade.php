@foreach($teams as $team)
  <div class="team-card">
    <img src="{{ $team->crest }}" alt="{{ $team->name }}" width="50">
    <h3>{{ $team->name }}</h3>
    <p>Venue: {{ $team->venue }}</p>
    <p>Players: {{ $team->players_count }}</p>
  </div>
@endforeach
