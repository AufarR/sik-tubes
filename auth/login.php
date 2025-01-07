<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Cinta Kasih Satu Hati</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="login-container">
    <h1>Puskesmas Cinta Kasih Satu Hati</h1>
    <form class="login-form" action="dashboard" method="post">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Masukkan email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
      </div>
      <button type="submit" class="btn-login">Login</button>
    </form>
    <button class="btn-register" onclick="location.href='register'">Register</button>
  </div>
</body>
</html>
