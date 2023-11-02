<?php
   ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mexp3 Library</title>
    <link rel="stylesheet" type="text/css" href="Library2.css">
    <link rel="stylesheet" href="mobile.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<header>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-primary">
                <a class="navbar-brand" href="Library2.php">
                  <i class="fas fa-book-reader fa-2x mx-3"></i>MExp3 Library</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <i class="fas fa-align-right text-light"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                  <div class="mr-auto"></div>
                  <ul class="navbar-nav">
                    <li class="nav-item active">
                      <a class="nav-link active" href="Library2.php">HOME
                        <span class="sr-only">(current)</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="Log in.php">LOG IN</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="Sign in.php">SIGN UP</a>
                    </li>
                  </ul>
                </div>
              </nav>
        </div>
    <div class="container"> 
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="signup-form">
            <form action="Sign in.php" method="POST" class="mt-5 border p-4 bg-light shadow">
                    <h4 class="mb-5 text-secondary text-center">Create Your Account</h4>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label>First Name<span class="text-danger">*</span></label>
                            <input type="text" name="firstname" class="form-control" placeholder="Enter First Name">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label>Last Name<span class="text-danger">*</span></label>
                            <input type="text" name="lastname" class="form-control" placeholder="Enter Last Name">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Password">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Password<span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Confirm Password<span class="text-danger">*</span></label>
                            <input type="password" name="passwordconfirmation" class="form-control" placeholder="Confirm Password">
                        </div>
                        <div class="col-md-12">
                           <button name="register" type="submit" class="btn btn-primary">Signup Now</button>
                        </div>
                    </div>
                </form>
                <p class="text-center mt-3 text-secondary">If you have account, Please <a class="text-primary" style="font-size:16px;" href="Log in.php">Login Now</a></p>
            </div>
        </div>
    </div>
    </div>
</header>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
<script src="./main.js"></script>
</body>
</html> 
<?php
   include 'connect.php';

   if(isset($_POST['register'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatpass = $_POST['passwordconfirmation'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "SELECT * FROM user WHERE (email ='$email')";
    $result = mysqli_query($con, $query);
        if($result){
            if($result && mysqli_num_rows($result) > 0){
                echo '<script> alert("Email is Already Taken!")</script>';
        }else{
            if($password == $repeatpass){
                $query = "insert into user (firstname, lastname, email, password) values ('$firstname', '$lastname', '$email', '$hashed_password')";

                mysqli_query($con, $query);

                echo '<script> alert("Successfully Added!")</script>';
                header("LOCATION: search.php");
            }else{
                echo '<script> alert("Password Do Not Match!")</script>';
            }
        }
    }
}
?>
