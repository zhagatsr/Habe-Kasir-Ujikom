<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Habe Kasir</title>

  <style>
    * {
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    body {
      margin: 0;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(to bottom, #f5f5f5 0%, #3b5a9e 100%);
    }

    .login-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      width: 380px;
      padding: 30px 25px 40px;
      text-align: center;
    }

    .login-card img {
      width: 140px;
      height: auto;
      margin-bottom: 15px;
    }

    .login-card input {
      width: 100%;
      padding: 11px 14px;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      outline: none;
      margin-bottom: 12px;
      font-size: 14px;
    }

    .login-card input:focus {
      border-color: #003366;
    }

    .login-btn {
      width: 100%;
      padding: 11px;
      background: #003e80;
      border: none;
      border-radius: 8px;
      color: #fff;
      font-weight: 600;
      font-size: 15px;
      cursor: pointer;
      transition: 0.2s;
    }
    .login-btn:hover {
      background: #0a4fa5;
    }

    .error {
      color: #c0392b;
      font-size: 13px;
      margin-top: 8px;
    }
  </style>
</head>

<body>
  <div class="login-card">
    <img src="{{ asset('assets/img/logo.jpeg') }}" alt="Logo Habe Kasir">
    <form action="{{ url('/login') }}" method="POST">
      @csrf
      <input type="text" name="username" placeholder="Enter username" required>
      <input type="password" name="password" placeholder="Enter password" required>
      <button class="login-btn">Login</button>
      @if(session('error'))
        <div class="error">{{ session('error') }}</div>
      @endif
    </form>
  </div>
</body>
</html>
