<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = $_POST["name"];
  $address = $_POST["address"];
  $age = $_POST["age"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmPassword = $_POST["confirm_password"];
  $phoneNumber = $_POST["phone_number"];

  // Validation
  $errors = array();

  // Name
  if (empty($name)) {
    $errors["name"] = "Name is required";
  } else if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
    $errors["name"] = "Name must contain only letters and spaces";
  }

  // Address
  if (empty($address)) {
    $errors["address"] = "Address is required";
  }

  // Age
  if (empty($age)) {
    $errors["age"] = "Age is required";
  } else if (!is_numeric($age) || $age <= 0) {
    $errors["age"] = "Invalid age";
  }

  // Email
  if (empty($email)) {
    $errors["email"] = "Email is required";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors["email"] = "Invalid email format";
  }

  // Password
  if (empty($password)) {
    $errors["password"] = "Password is required";
  } else if (strlen($password) < 8) {
    $errors["password"] = "Password must be at least 8 characters long";
  }

  // Confirm Password
  if (empty($confirmPassword)) {
    $errors["confirm_password"] = "Confirm password is required";
  } else if ($password !== $confirmPassword) {
    $errors["confirm_password"] = "Passwords do not match";
  }

  // Phone Number
  if (empty($phoneNumber)) {
    $errors["phone_number"] = "Phone number is required";
  } else if (!preg_match("/^[0-9]+$/", $phoneNumber)) {
    $errors["phone_number"] = "Phone number must contain only digits";
  }

  if (empty($errors)) {
    echo "Registration successful!";
  } else {
    echo "Please correct the following errors:<br>";
    foreach ($errors as $field => $error) {
      echo "$field: $error<br>";
    }
  }

} else {
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>Simple Form Validation</title>
  </head>
  <body>
    <h2>Registration Form</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ""; ?>"><br><br>

      <label for="address">Address:</label>
      <input type="text" id="address" name="address" value="<?php echo isset($_POST["address"]) ? $_POST["address"] : ""; ?>"><br><br>

      <label for="age">Age:     </label>
      <input type="text" id="age" name="age" value="<?php echo isset($_POST["age"]) ? $_POST["age"] : ""; ?>"><br><br>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ""; ?>"><br><br>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password"><br><br>

      <label for="confirm_password">Confirm Password:</label>
      <input type="password" id="confirm_password" name="confirm_password"><br><br>

      <label for="phone_number">Phone Number:</label>
      <input type="text" id="phone_number" name="phone_number" value="<?php echo isset($_POST["phone_number"]) ? $_POST["phone_number"] : ""; ?>"><br><br>

      <input type="submit" value="Submit">
    </form>
  </body>
  </html>
  <?php
}

?>