<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $league->name }} - Footsy Fantasy League</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: #f5f7ff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            padding: 2rem;
        }

        h1 {
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 0.5rem;
        }

        .league-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            background: #eef2ff;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        .info-block {
            margin: 0.5rem 0;
        }

        .info-block strong {
            color: #3a5ee5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
            text-align: left;
        }

        th {
            background: #3a5ee5;
            color: #fff;
        }

        .btn {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(135deg, #3a5ee5, #2a48c5);
            transition: all 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }

        .back-link {
            display: inline-block;
            margin-bottom: 1rem;
            color: #3a5ee5;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .empty {
            text-align: center;
            color: #666;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="{{ route('leagues.index') }}" class="back-link"><i class="fas fa-arrow-left"></i> Back to Leagues</a>

    <h1>{{ $league->name }}</h1>
    <p>{{ $league->description ?? 'No description provided.' }}</p>

    <div class="league-info">
        <strong>Admin:</strong> {{ optional($league->admin)->name ?? 'Unknown' }}
        <div class="info-block"><strong>Privacy:</strong> {{ ucfirst($league->privacy) }}</div>
        <div class="info-block"><strong>Max Teams:</strong> {{ $league->max_participants ?? '20' }}</div>
        <div class="info-block"><strong>Join Code:</strong> {{ $league->code }}</div>
    </div>

    <h2>Participants</h2>
    @if($participants->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Manager</th>
                    <th>Team</th>
                    <th>Points</th>
                </tr>
            </thead>
            <tbody>
                @foreach($participants as $p)
                    <tr>
                        <td>{{ $p->pivot->rank ?? '-' }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->fantasyTeam->name ?? '—' }}</td>
                        <td>{{ $p->fantasyTeam->total_points ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty">
            <i class="fas fa-user-slash fa-2x"></i>
            <p>No participants yet.</p>
        </div>
    @endif
</div>

</body>
</html>
