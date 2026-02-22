<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Login - Lumina Beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { width: 100%; max-width: 400px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-radius: 10px; }
        .login-header { background: #fff; padding: 2rem 1rem 1rem; text-align: center; border-radius: 10px 10px 0 0; }
    </style>
</head>
<body>

    <div class="card login-card">
        <div class="login-header">
            <h3>Two-Factor Authentication</h3>
            <p class="text-muted">Enter the 6-digit code sent to your phone</p>
        </div>
        <div class="card-body p-4">
            
            @if(session('success'))
                <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
                    <div class="toast show align-items-center text-white bg-success border-0" role="alert">
                        <div class="d-flex">
                            <div class="toast-body">
                                {{ session('success') }}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    </div>
                </div>
            @endif

             @if($errors->any())
                <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
                    <div class="toast show align-items-center text-white bg-danger border-0" role="alert">
                        <div class="d-flex">
                            <div class="toast-body">
                                {{ $errors->first() }}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ url('/admin/verify') }}" method="POST">
                @csrf
                <div class="mb-4 text-center">
                    <input type="text" name="two_factor_code" class="form-control text-center fs-3" maxlength="6" placeholder="000000" required autofocus style="letter-spacing: 5px;">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-dark">Verify Code</button>
                </div>
            </form>
            
            <form action="{{ route('admin.resend') }}" method="POST" class="text-center mt-3">
                @csrf
                <button type="submit" class="btn btn-link text-decoration-none text-muted small">Resend Code</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
