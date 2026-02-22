<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Lumina Beauty</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .login-header {
            background: #fff;
            padding: 2rem 1rem 1rem;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .login-header h3 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: #2d2d2d;
        }
    </style>
</head>
<body>

    <div class="card login-card">
        <div class="login-header">
            <h3>Lumina Admin</h3>
            <p class="text-muted">Sign in to your account</p>
        </div>
        <div class="card-body p-4">
            <form action="#" method="POST" onsubmit="event.preventDefault(); window.location.href='/admin/dashboard'">
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" placeholder="admin@lumina.com" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="••••••••" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-dark">Login</button>
                </div>
                <div class="text-center mt-3">
                    <a href="#" class="text-decoration-none text-muted small">Forgot password?</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
