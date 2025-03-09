<div class="bg_image">
  

<div class="container mt-5">
  <h2>Admin Registration</h2>

  <!-- Registration Form -->
  <form id="registrationForm">
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" required>
      <div class="invalid-feedback" id="emailError"></div>
    </div>

    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" placeholder="Choose a username" required>
      <div class="invalid-feedback" id="usernameError"></div>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" placeholder="Create a password" required>
      <div class="invalid-feedback" id="passwordError"></div>
    </div>

    <div class="mb-3">
      <label for="profilePicture" class="form-label">Profile Picture</label>
      <input type="file" class="form-control" id="profilePicture">
    </div>

    <button type="submit" class="btn btn-primary">Register</button>
  </form>
</div>

</div>
<!-- Bootstrap JS and dependencies -->


<script>
  // Dummy function to simulate server-side checks for email and username
  function isEmailTaken(email) {
    const takenEmails = ['test@example.com']; // Example taken email
    return takenEmails.includes(email);
  }

  function isUsernameTaken(username) {
    const takenUsernames = ['user123']; // Example taken username
    return takenUsernames.includes(username);
  }

  // Form validation and submission
  document.getElementById('registrationForm').addEventListener('submit', function (e) {
    e.preventDefault();

    // Clear previous error messages
    document.getElementById('emailError').textContent = '';
    document.getElementById('usernameError').textContent = '';
    document.getElementById('passwordError').textContent = '';

    let isValid = true;

    const email = document.getElementById('email').value;
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Email validation
    if (isEmailTaken(email)) {
      document.getElementById('emailError').textContent = 'This email is already registered.';
      isValid = false;
    }

    // Username validation
    if (isUsernameTaken(username)) {
      document.getElementById('usernameError').textContent = 'This username is already taken.';
      isValid = false;
    }

    // Password validation (basic length check)
    if (password.length < 8) {
      document.getElementById('passwordError').textContent = 'Password must be at least 8 characters long.';
      isValid = false;
    }

    if (isValid) {
      Swal.fire({
        icon: 'success',
        title: 'Registration complete!',
        text: 'Welcome aboard.',
        confirmButtonText: 'Okay'
      });
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Please fix the errors in the form.',
        confirmButtonText: 'Try Again'
      });
    }
  });
</script>
