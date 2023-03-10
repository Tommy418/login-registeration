<?php 
  session_start();
  include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>
<?php 
    $error = "";
  if(isset($_POST['loginBotton'])){
      $email = trim($_POST['email']);
      $password = md5(trim($_POST['password']));

      $user_result = mysqli_query($dbconnection, "SELECT * FROM user
       WHERE email='$email' && password ='$password'");    
        $user_count = mysqli_num_rows($user_result);

       if($user_count === 1){
        $user_array = mysqli_fetch_assoc($user_result); 
        $_SESSION['user_array']= $user_array;
        if($user_array['role']=='admin'){  
          header('location: admin.php');
        }else{
          header('location: user-dashboard.php');
        }
        
       }else {
         $error = "Invalid email or password";
       }
  }
?>
<div class="container">
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin.php">Admin</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</div>
<dov class="container d-flex justify-content-center">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center text-info">login</h3>
        <form action="login.php" method="POST">
       <?php if($error !=""): ?> 
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong> <?php  echo $error; ?></strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif ?>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" >
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
  </div>
  <div>
    <h3>if you dont have an account, <a href= "register.php"> registerhere</a> </h3>
  </div>
  <button type="submit" class="btn btn-primary" name="loginBotton">Submit</button>
</form>
        </div>
    </div>
</dov>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>