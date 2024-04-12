<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../css/login.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <div class="wrapper">
    <form method="post" action="../action/login_action.php" onsubmit="return validateForm()">
      <h1>Login</h1>
      <div class="input-box">
        <input type="email" name="email" id="email" placeholder="Email" required>
        <i class='bx bx-envelope'></i>
      </div>
      <div class="input-box">
        <input type="password" name="password" id="password" placeholder="Password" required>
        <i class='bx bxs-lock-alt'></i>
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

      if (email.trim() === "" || password.trim() === "") {
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Please enter both email and password.'
        });
        return false;
      }

      return true;
    }
  </script>

  <?php
  session_start();

  if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    echo "<script>
            Swal.fire({
              icon: '{$message['type']}',
              title: '{$message['title']}',
              html: '{$message['text']}',
              confirmButtonText: 'OK',
            });
          </script>";
    unset($_SESSION['message']); 
  }
  ?>
</body>
</html>
