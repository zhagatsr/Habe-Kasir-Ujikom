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
      background: linear-gradient(120deg, #f5f5f5, #3b5a9e, #f5f5f5);
      background-size: 300% 300%;
      animation: bgMove 10s ease-in-out infinite alternate;
    }

    @keyframes bgMove {
      0% { background-position: left top; }
      100% { background-position: right bottom; }
    }

 
 .login-card {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.15);
  width: 380px;
  padding: 30px 25px 40px;
  text-align: center;
  opacity: 1;
  transform: translateY(0);
}


.login-card.animate {
  opacity: 0;
  transform: translateY(40px);
  animation: slideUp 0.8s ease-out forwards;
}

    @keyframes slideUp {
      0% { transform: translateY(40px); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
    }

    .login-card img {
      width: 140px;
      height: auto;
      margin-bottom: 15px;
      transition: transform 0.6s ease;
    }

    .login-card:hover img {
      transform: scale(1.05) rotate(1deg);
    }

    .login-card input {
      width: 100%;
      padding: 11px 14px;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      outline: none;
      margin-bottom: 12px;
      font-size: 14px;
      transition: all 0.25s ease;
    }

    .login-card input:focus {
      border-color: #003366;
      box-shadow: 0 0 10px rgba(0, 62, 128, 0.25);
      transform: scale(1.02);
    }

 
    .login-btn {
      position: relative;
      width: 100%;
      padding: 11px;
      background: #003e80;
      border: none;
      border-radius: 8px;
      color: #fff;
      font-weight: 600;
      font-size: 15px;
      cursor: pointer;
      overflow: hidden;
      transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .login-btn:hover {
      background: #0a4fa5;
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(10,79,165,0.3);
    }

    .login-btn:active {
      transform: scale(0.97);
    }

 
    .login-btn::after {
      content: "";
      position: absolute;
      top: var(--y);
      left: var(--x);
      width: 0;
      height: 0;
      background: rgba(255,255,255,0.4);
      border-radius: 50%;
      transform: translate(-50%, -50%);
      animation: ripple 0.6s linear;
    }

    @keyframes ripple {
      to {
        width: 250px;
        height: 250px;
        opacity: 0;
      }
    }

 
    .shake {
      animation: shakeAnim 0.4s ease;
    }

    @keyframes shakeAnim {
      0%,100% { transform: translateX(0); }
      20%,60% { transform: translateX(-6px); }
      40%,80% { transform: translateX(6px); }
    }

    .error {
      color: #c0392b;
      font-size: 13px;
      margin-top: 8px;
      animation: fadeError 0.5s ease-in-out;
    }

    @keyframes fadeError {
      from { opacity: 0; transform: translateY(-4px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>

<body>
  <div class="login-card {{ session('error') ? '' : 'animate' }}" id="loginCard">
    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Habe Kasir">
    <form action="{{ url('/login') }}" method="POST" id="loginForm">
      @csrf
      <input type="text" name="username" placeholder="Enter username" required>
      <input type="password" name="password" placeholder="Enter password" required>
      <button type="submit" class="login-btn" id="loginBtn">Login</button>
      @if(session('error'))
        <div class="error" id="errorMsg">{{ session('error') }}</div>
      @endif
    </form>
  </div>

  <script>
    const btn = document.getElementById('loginBtn');
    btn.addEventListener('click', function(e) {
      const rect = this.getBoundingClientRect();
      this.style.setProperty('--x', e.clientX - rect.left + 'px');
      this.style.setProperty('--y', e.clientY - rect.top + 'px');
    });

    const card = document.getElementById('loginCard');
    const errorMsg = document.getElementById('errorMsg');
    if (errorMsg) {
      setTimeout(() => card.classList.add('shake'), 300);
    }
  </script>
</body>

</html>
