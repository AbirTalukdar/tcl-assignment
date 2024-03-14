<!DOCTYPE html>
<html>
<head>
    <title>Investment Details</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <a href="{{ route('home') }}" class="btn btn-primary mt-3">
        Home
        </a>
        <h2>Investment Details for Project: {{ $project->name }}</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Investor Name</th>
                        <th>Investment Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($investors as $investment)
                        <tr>
                            <td>{{ $investment->user->name }}</td>
                            <td>{{ number_format($investment->amount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
