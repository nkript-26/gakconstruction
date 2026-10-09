<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - GAK Construction</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #1a1a2e, #c0392b); height: 100vh; display: flex; align-items: center; justify-content: center; font-family: "Poppins", sans-serif; }
        .login-box { background: #fff; padding: 40px; border-radius: 12px; width: 380px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); text-align: center; }
        .login-box h2 { color: #c0392b; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; text-align: left; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; }
        .btn-submit { width: 100%; padding: 12px; background: #c0392b; color: #fff; border: none; border-radius: 6px; font-size: 16px; font-weight: 600; cursor: pointer; }
        .btn-submit:hover { background: #a93226; }
        .error { color: red; font-size: 13px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>GAK Admin Login</h2>
        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route("admin.login.submit") }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required value="admin@gakconstruction.com">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="admin123">
            </div>
            <button type="submit" class="btn-submit">Login</button>
        </form>
    </div>
</body>
</html>