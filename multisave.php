<!-- To be added in the multisave.php -->

<?php

require_once('classes/database.php');

$con = new database();
if (isset($_POST['multisave'])) {
    $username = $_POST['user_username'];
    $password = $_POST['user_pass'];
    $firstname = $_POST['user_firstname'];
    $lastname = $_POST['user_lastname'];
    $confirm = $_POST['c_pass'];
    $birthday = $_POST['user_birthday'];
    $sex = $_POST['user_sex'];
    $city = $_POST['user_add_city'];
    $province = $_POST['user_add_province'];
    $street = $_POST['user_add_street'];
    $barangay = $_POST['user_add_barangay'];
    
    if ($password == $confirm) {
        // Passwords match, proceed with signup
        $user_id = $con->signupUser($username, $password, $firstname, $lastname, $birthday, $sex); // Insert into users table and get user_id
        if ($user_id) {
            // Signup successful, insert address into users_address table
            if ($con->insertAddress($user_id, $city, $province, $street, $barangay)) {
                // Address insertion successful, redirect to login page
                header('location:login.php');
                exit();
            } else {
                // Address insertion failed, display error message
                $error = "Error occurred while signing up. Please try again.";
            }
        } else {
            // User insertion failed, display error message
            $error = "Error occurred while signing up. Please try again.";
        }
    } else {
        // Passwords don't match, display error message
        $error = "Passwords did not match. Please try again.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MultiSave Page</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    .custom-container{
        width: 800px;
    }
    body{
    font-family: 'Roboto', sans-serif;
    }
  </style>

</head>
<body>

<div class="container custom-container rounded-3 shadow my-5 p-3 px-5">
  <h3 class="text-center mt-4"> Registration Form</h3>
  <form method="post">
    <!-- Personal Information -->
    <div class="card mt-4">
      <div class="card-header bg-info text-white">Personal Information</div>
      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-6 col-sm-12">
            <label for="firstName">First Name:</label>
            <input type="text" name="user_firstname"class="form-control" id="firstName" placeholder="Enter first name">
          </div>
          <div class="form-group col-md-6 col-sm-12">
            <label for="lastName">Last Name:</label>
            <input type="text" name="user_lastname"class="form-control" id="lastName" placeholder="Enter last name">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="birthday">Birthday:</label>
            <input type="date" name="user_birthday"class="form-control" id="birthday">
          </div>
          <div class="form-group col-md-6">
            <label for="sex">Sex:</label>
            <select class="form-control" id="sex" name="user_sex">
              <option selected>Select Sex</option>
              <option>Male</option>
              <option>Female</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" name="user_username"class="form-control" id="username" placeholder="Enter username">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" name="user_pass"class="form-control" id="password" placeholder="Enter password">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" name="c_pass"class="form-control" id="password" placeholder="Confirm password">
        </div>
      </div>
    </div>
    
    <!-- Address Information -->
    <div class="card mt-4">
      <div class="card-header bg-info text-white">Address Information</div>
      <div class="card-body">
        <div class="form-group">
          <label for="street">Street:</label>
          <input type="text" name="user_add_street"class="form-control" id="street" placeholder="Enter street">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="barangay">Barangay:</label>
            <input type="text" name="user_add_barangay"class="form-control" id="barangay" placeholder="Enter barangay">
          </div>
          <div class="form-group col-md-6">
            <label for="city">City:</label>
            <input type="text" name="user_add_city"class="form-control" id="city" placeholder="Enter city">
          </div>
        </div>
        <div class="form-group">
          <label for="province">Province:</label>
          <input type="text" name="user_add_province"class="form-control" id="province" placeholder="Enter province">
        </div>
      </div>
    </div>
    
    <!-- Submit Button -->
    
    <div class="container">
    <div class="row justify-content-center gx-0">
        <div class="col-lg-3 col-md-4"> 
            <input type="submit" name="multisave" class="btn btn-outline-primary btn-block mt-4" value="Sign Up">
        </div>
        <div class="col-lg-3 col-md-4"> 
            <a class="btn btn-outline-danger btn-block mt-4" href="login.php">Go Back</a>
        </div>
    </div>
</div>


  </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<!-- Bootsrap JS na nagpapagana ng danger alert natin -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
