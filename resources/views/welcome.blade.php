<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Expense Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container-fluid vh-100 d-flex align-items-center justify-content-center">
    <div class="text-center">
        <i class="fas fa-wallet fa-5x text-primary mb-4"></i>
        <h1 class="display-4 mb-4">Expense Tracker</h1>
        <p class="lead mb-4">Track your daily expenses and get monthly reports</p>

        @if (Route::has('login'))
            <div class="d-flex justify-content-center gap-3">
                @auth
                    <a href="{{ route('expenses.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</div>
</body>
</html>
