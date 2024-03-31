<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../css/login.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  <div class="wrapper">
    <form method="post" action="" onsubmit="return validateForm()">
      <h1>Login</h1>
      <div class="input-box">
        <input type="email" placeholder="Email" id="email" required>
        <i class='bx bx-envelope'></i>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Password" id="password" required>
        <i class='bx bxs-lock-alt'></i>
      </div>
      <div class="remember-forgot">
        <label><input type="checkbox">Remember Me</label>
        <a href="#">Forgot Password</a>
      </div>
      <button type="submit" class="btn">Login</button>
      <div class="register-link">
        <p>Don't have an account? <a href="../login/register.php">Register</a></p>
      </div>
    </form>
  </div>

  <script>
    function validateForm() {
      let email = document.getElementById("email").value;
      let password = document.getElementById("password").value;

      // Check for empty fields
      if (email.trim() === "" || password.trim() === "") {
        alert("Please enter both email and password.");
        return false;
      }

      // Check email format
      let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        return false;
      }

      // Check password format
      let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
      if (!passwordRegex.test(password)) {
        alert("Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character.");
        return false;
      }

      return true; // Allow form submission if validation passes
    }
  </script>
</body>
</html>