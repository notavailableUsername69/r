<!DOCTYPE html>
<html>
<head>
  <title>Registration Page</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <style>
    body {
      background-color: #f5f5f5;
      font-family: "Arial", sans-serif;
    }

    .container {
      width: 400px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
      background-color: #ffffff;
    }

    h1 {
      text-align: center;
      font-size: 30px;
      color: #333333;
      margin-bottom: 30px;
    }

    label {
      display: block;
      font-size: 16px;
      color: #333333;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #cccccc;
      border-radius: 5px;
      margin-bottom: 15px;
    }

    input[type="radio"] {
      margin-right: 5px;
    }

    input[type="submit"] {
      padding: 10px 20px;
      font-size: 18px;
      background-color: #ff6f61;
      color: #ffffff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #ff5349;
    }

    .toast {
      position: fixed;
      top: 20px;
      right: 20px;
      background-color: #333333;
      color: #ffffff;
      padding: 10px 20px;
      border-radius: 5px;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.3s ease;
    }

    .toast.show {
      opacity: 1;
      visibility: visible;
    }

    .toast-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .toast-header img {
      width: 20px;
      height: 20px;
      margin-right: 10px;
    }

    .toast-body {
      font-size: 16px;
    }

    .thank-you-message {
      text-align: center;
      font-size: 18px;
      color: #333333;
      margin-top: 30px;
    }
  </style>
</head>
<body>
  <?php
  $firstname = $lastname = $gender = $email = $password = $phone = "";
  $registration_successful = false;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'tests');
    if ($conn->connect_error) {
      echo "$conn->connect_error";
      die("Connection Failed: " . $conn->connect_error);
    } else {
      $stmt = $conn->prepare("insert into registration(firstname, lastname, gender, email, password, phone) values(?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("sssssi", $firstname, $lastname, $gender, $email, $password, $phone);
      $execval = $stmt->execute();
      if ($execval) {
        $registration_successful = true;
      }
      $stmt->close();
      $conn->close();
    }
  }
  ?>

  <div class="container">
    <h1>Registration Form</h1>
    <?php if ($registration_successful): ?>
      <div class="thank-you-message">
        Thank you for registering! We look forward to serving you.
      </div>
    <?php else: ?>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
          <label for="firstname">First Name</label>
          <input type="text" class="form-control" id="firstname" name="firstname" />
        </div>
        <div class="form-group">
          <label for="lastname">Last Name</label>
          <input type="text" class="form-control" id="lastname" name="lastname" />
        </div>
        <div class="form-group">
          <label for="gender">Gender</label>
          <div>
            <label for="male" class="radio-inline">
              <input type="radio" name="gender" value="m" id="male" />Male
            </label>
            <label for="female" class="radio-inline">
              <input type="radio" name="gender" value="f" id="female" />Female
            </label>
            <label for="others" class="radio-inline">
              <input type="radio" name="gender" value="o" id="others" />Others
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" class="form-control" id="email" name="email" />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" />
        </div>
        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="text" class="form-control" id="phone" name="phone" />
        </div>
        <input type="submit" class="btn btn-primary" value="Register" />
      </form>
    <?php endif; ?>
  </div>

  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <!-- Toast notification content -->

    <!-- ... -->
    
  </div>

  <script src="js/bootstrap.js"></script>
  <script>
    // JavaScript code

    /* ... */
    
  </script>
</body>
</html>
