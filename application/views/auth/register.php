<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Inventaris Laboratorium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .btn-success { background-color: #28a745; border: none; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card p-4">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Join Us</h3>
                        <p class="text-muted">Create your account</p>
                    </div>

                    <?php if(validation_errors()): ?>
                        <div class="alert alert-warning py-2 small" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('index.php/auth/register'); ?>" method="post">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Choose a username" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Min. 5 characters" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100 py-2">Create Account</button>
                    </form>

                    <div class="text-center mt-3">
                        <small>Already have an account? <a href="<?= base_url('index.php/auth/login'); ?>" class="text-decoration-none">Login</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>