
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
<?php
    include'connect.php';
    $nameError = "";
    $emailError = "";
    $addressError = "";
    $passwordError = "";
    $confirm_passwordError = "";

    if(isset($_POST['register_button'])){
       
        $name = $_POST['name'];
        $email =  $_POST['email'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if(empty($name)){
            $nameError = "name need to fill";
        }
        if(empty($email)){
            $emailError = "email need to fill";
        }
        if(empty($address)){
            $addressError = "address need to fill";
        }
        if(empty($password)){
            $passwordError = "password need to fill";
        }
        if($confirm_password!=$password){
            $confirm_passwordError = "confirm passowrd need to fill";
        }
        
        if (!empty($name) && !empty($email) && !empty($address)&& !empty($password)){
            $query ="INSERT INTO user(name,email,address,password) VALUES('$name','$email',
            '$address','$password')";

            $result = mysqli_query($dbconnection,$query);
            if($result == true){
                echo"<script> alert('registration successfully')</script>";
            }else{
                die('Error:'. mysqli_error($query));
            }
        }
      
    }
?>
<body>
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
          <a class="nav-link" href="admin/admin.php">Admin</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</div>
<dov class="container d-flex justify-content-center">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center text-info">Registeration</h3>
        <form action="register.php" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="text" name="name" class="form-control" id="exampleInputEmail1" >
    <i class="text-danger">
        <?php echo $nameError?>
    </i>
<div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" id="exampleInputPassword1">
    <i class="text-danger">
        <?php echo $emailError?>
    </i>
  </div>
  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Address</label>
  <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3"></textarea>
  <i class="text-danger">
        <?php echo $addressError?>
    </i>
</div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
    <i class="text-danger">
        <?php echo $passwordError?>
    </i>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label"> Confirm password</label>
    <i class="text-danger">
        <?php echo $confirm_passwordError?>
    </i>
    <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" name="register_button" class="btn btn-primary">Submit</button>
</form>
        </div>
    </div>
</dov>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>