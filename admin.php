<?php
  session_start();
  include 'connect.php';

  // $_SESSION['user_array']['name'];
 if(!isset($_SESSION['user_array'])){
   header('location: login.php');
 } else{
    if($_SESSION['user_array']['role'] != 'admin'){
      header('location: user.php');
 }}
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
          <a class="nav-link" href="admin.php">Admin</a>
        </li>

           <div>

          
  </div>
  </div>
          <form action="logout.php" method="GET">
          <button type="submit" name="logoutButton" class="btn btn-danger btn-sm float-right ml-auto" onclick="return confirm('R U sure to logout')">log Out</button>
          </form>
    </div>
</nav>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="card ">
        <div class="card-body">
            <h4>Admin Info</h4>
            <div>
            Role:
              <span class=" bg-success text-white badge badge "> <?php echo $_SESSION['user_array']['role']?></span>   
            </div>
            <div>
               Name: <?php echo $_SESSION['user_array']['name']?>
            </div>
            <div>
               email: <?php echo $_SESSION['user_array']['email']?>
            </div>
            <div>
               address: <?php echo $_SESSION['user_array']['address']?>
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
    <table class="table ">
  <thead class="bg-info">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Address</th>
      <th scope="col">Password</th>
      <th scope="col">Role</th>
      <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $query ="SELECT * FROM user";
      $result =mysqli_query($dbconnection,$query);
      foreach($result as $user){
          ?>
          <tr>
      <th scope="row"><?php echo $user['id']?></th>
      <th scope="row"><?php echo $user['name']?></th>
      <th scope="row"><?php echo $user['email']?></th>
      <th scope="row"><?php echo $user['address']?></th>
      <th scope="row"><?php echo $user['password']?></th>
      <th scope="row"><?php echo $user['role']?></th>
      <th scope="row"> 
        <div class="d-flex justify-content-start">
            <a href="" class="btn btn-info btn-sm">Edit</a>
            <button class="btn btn-danger btn-sm">Delete </button></th>
             </tr>
            </div>
    <?php
     }
    ?>
  </tbody>
</table>
    </div>
  </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>