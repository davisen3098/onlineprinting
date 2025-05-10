<?php require_once '../classes/SupplierRegistration.php';?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Supplier Registration</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/vendor.css">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="#">Supplier Portal</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Register</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    
    <div class="container mt-5">
        <h2 class="text-center">Supplier Registration</h2>

        <?php if (!empty($message)): ?>
            <div class="alert <?php echo ($message == "success") ? 'alert-success' : 'alert-danger'; ?>">
                <?php echo ($message == "success") ? "Registration successful!" : $message; ?>
            </div>
        <?php endif; ?>

        <form action="registration.php" method="POST" class="mt-4" id="registration-form" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="company" class="form-label">Company Name:</label>
                <input type="text" class="form-control" id="company" name="company" required>
            </div>
            <div class="mb-3">
                <label for="company" class="form-label">Business Registration Number:</label>
                <input type="text" class="form-control" id="brn" name="brn" required>
            </div>
            <div class="mb-3">
              <label for="business_card" class="form-label">Upload Business Card (JPG, PNG, or PDF):</label>
              <input type="file" class="form-control" id="business_card" name="business_card" accept="image/*,.pdf" required>
              <br>
              <img id="preview" src="#" alt="Preview" style="display: none; max-height: 150px;">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <textarea class="form-control" id="address" name="address" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Register Supplier</button>
        </form>
    </div>
    
    <footer class="text-center mt-5 py-3 bg-light">
      <p>&copy; 2025 Supplier Portal. All rights reserved.</p>
    </footer>
        <!-- Client-side BRN Validation -->
    <script>
      document.getElementById('registration-form').addEventListener('submit', function(e) {
        const brn = document.getElementById('brn').value.trim();
        const brnPattern = /^\d{9}$/; // 9-digit BRN

        if (!brnPattern.test(brn)) {
          alert("Business Registration Number must be exactly 9 digits.");
          document.getElementById('brn').focus();
          e.preventDefault();
        }
      });
    </script>
    <script>
      document.getElementById('business_card').addEventListener('change', function (e) {
        const file = e.target.files[0];
        const preview = document.getElementById('preview');

        if (file && file.type.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
          };
          reader.readAsDataURL(file);
        } else {
          preview.style.display = 'none';
          preview.src = '#';
        }
      });
    </script>
  </body>
</html>
