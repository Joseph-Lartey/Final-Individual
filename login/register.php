<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="../css/register.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  <div class="wrapper">
    <form method="post" action="" onsubmit="return validateForm()">
      <h1>Register</h1>
      <div class="input-box">
        <input type="text" placeholder="First Name" id="firstName" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="text" placeholder="Last Name" id="lastName" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="email" placeholder="Email" id="email" required>
        <i class='bx bx-envelope'></i>
      </div>
      <div class="input-box">
        <input type="text" placeholder="Phone Number" id="phoneNumber" required>
        <i class='bx bxs-phone'></i>
      </div>
      <div class="gender-checkbox">
            <label>Gender</label>
            <div>
                <input type="radio" name="gender" value="male" id="male" required>
                <label for="male">Male</label>
            </div>
            <div>
                <input type="radio" name="gender" value="female" id="female" required>
                <label for="female">Female</label>
            </div>
      </div>
      <div class="input-box">
        <input type="date" placeholder="Date of Birth" id="dateOfBirth" required>
        <i class='bx bxs-calendar'></i>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Password" id="password" required>
        <i class='bx bxs-lock-alt'></i>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Confirm Password" id="confirmPassword" required>
        <i class='bx bxs-lock-alt'></i>
      </div>
      <button type="submit" class="btn">Register</button>
      <div class="register-link">
        <p>Already have an account? <a href="../login/login.php">Login</a></p>
      </div>
    </form>
  </div>

  <script>
    function validateForm() {
      let firstName = document.getElementById("firstName").value.trim();
      let lastName = document.getElementById("lastName").value.trim();
      let email = document.getElementById("email").value.trim();
      let phoneNumber = document.getElementById("phoneNumber").value.trim();
      let dateOfBirth = document.getElementById("dateOfBirth").value.trim();
      let password = document.getElementById("password").value.trim();
      let confirmPassword = document.getElementById("confirmPassword").value.trim();
      let gender = document.querySelector('input[name="gender"]:checked');

      // Check for empty fields
      if (firstName === "" || lastName === "" || email === "" || phoneNumber === "" || dateOfBirth === "" || password === "" || confirmPassword === "" || !gender) {
        alert("Please fill in all the required fields.");
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

      // Check if passwords match
      if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return false;
      }

      let ghanaPhoneRegex = /^(?:(?:\+?233|233|0)(\d{9})|(?:233)(\d{9}))$/
      if (!ghanaPhoneRegex.test(phoneNumber)) {
        alert("Please enter a valid Ghanaian phone number.");
        return false;
      }

      return true; 
    }
  </script>
</body>
</html>