<?php
require_once("classes/database.php");
$con = new database();

$error_message = "";

if (isset($_POST['signup'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $sex = $_POST['sex'];   
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password == $confirm_password) {
        if ($con->signup($firstname, $lastname, $birthday, $sex, $username, $password)) {
            header('location:login.php');
            exit;
        } else {
            $error_message = "Username already exists. Please choose a different username.";
        }
    } else {
        $error_message = "Password did not match";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container-fluid login-container rounded shadow">
  <h2 class="text-center mb-4">Sign Up</h2>
  <?php if (!empty($error_message)) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $error_message; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
  <form method="post">
    <div class="form-group">
      <label for="firstname">First Name:</label>
      <input required type="text" class="form-control" name="firstname" placeholder="First Name">
    </div>
    <div class="form-group">
      <label for="lastname">Last Name:</label>
      <input required type="text" class="form-control" name="lastname" placeholder="Last Name">
    </div>
    <div class="mb-3">
      <label for="birthday" class="form-label">Birthday:</label>
      <input required type="date" class="form-control" name="birthday">
    </div>
    <div class="mb-3">
      <label for="sex" class="form-label">Sex:</label>
      <select required class="form-select" name="sex" id="sex">
        <option selected disabled>Select Sex</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
      
      </select>
    </div>
    <div class="form-group">
      <label for="username">Username:</label>
      <input required type="text" class="form-control" name="username" placeholder="Enter username">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input required type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" 
         title="Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, one number, and one special character." 
         class="form-control" name="password" placeholder="Enter password">
    </div>
    <div class="form-group">
      <label for="confirm_password">Confirm Password:</label>
      <input required type="password" class="form-control" name="confirm_password" placeholder="Confirm password">
    </div>
    <input type="submit" class="btn btn-danger btn-block" value="Sign Up" name="signup">
  </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>