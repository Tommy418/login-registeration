<?php
  session_start();
  include 'connect.php';

  // $_SESSION['user_array']['name'];
 if(!isset($_SESSION['user_array'])){
   header('location: login.php');
 } else{
 if($_SESSION['user_array']['role'] != 'user'){
  header('location: admin.php');
}}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</head>
<body>
<?php
        //aunthenticated user data
        $auth_user_id = $_SESSION['user_array'] ['id'];
        $auth_user_result = mysqli_query($dbconnection,"SELECT * FROM user WHERE id =$auth_user_id");
        if($auth_user_result) {
          $auth_user_array = mysqli_fetch_array($auth_user_result);
        } else {
          die ('Error:' .mysqli_error($dbconnection));
        }
        //user edit
      $card_edition_form_status=false;

      if(isset($_REQUEST['user_id_to_update'])){
        $card_edition_form_status=true;
        $user_id_to_update = $_REQUEST['user_id_to_update'];

        $result = mysqli_query($dbconnection,"SELECT * From user WHERE id=$user_id_to_update");
        IF($result){
          $user = mysqli_fetch_assoc($result);

        }else{
          die ('Error:'. mysqli_error($dbconnection));
        }

      }
      //user update
      if(isset($_POST['user_update_button'])){
        $user_id = $_POST['user_id'];
         $name = $_POST['name'];
         $email = $_POST['email'];
         $address = $_POST['address'];

  
         $user_result = mysqli_query($dbconnection,"SELECT * FROM user WHERE id=$user_id");
         $user_array = mysqli_fetch_assoc($user_result);
         $old_password = $user_array['password'];
  
         $input_password = $_POST['password'];
  
         $new_password = $old_password != $input_password ? md5($input_password) : $input_password;
  
         $query ="UPDATE user SET name='$name', email='$email',address='$address',password='$new_password' WHERE id=$user_id";
  
         $result = mysqli_query($dbconnection,$query);
  
         if($result){
            $_SESSION['expire_time']= time() + (0.1 * 60);
            $_SESSION['success_msg']="<script>swal('Good job!', 'You clicked the button!', 'success');</script>";
            header('location: user-dashboard.php');
         }  else{
                die('Error:'.mysqli_error($dbconnection));
         }
        
      }
      if(time() < $_SESSION['expire_time']){
        echo $_SESSION['success_msg'];
      }else{
        unset($_SESSION['success_msg']);
        unset($_SESSION['expire_time']);
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
    <div class="col-md-6">
      <div class="card text-white bg-secondary">
        <div class="card-body">
            <h4>user Info</h4>
            <div>
            Role:
              <span class=" bg-success text-white badge badge "> <?php echo $auth_user_array['role']?></span>   
            </div>
            <div>
            <div>
               Name: <?php echo $auth_user_array['name']?>
            </div>
            <div>
               email: <?php echo $auth_user_array['email']?>
            </div>
            <div>
               address: <?php echo $auth_user_array['address']?>
            </div>
            <div>
              <a href="user-dashboard.php?user_id_to_update=<?php echo $auth_user_array['id']?>" class="btn btn-info btn-sm mt-3">Edit</a>
            </div>
        </div>
      </div>
    </div>  
    <div class="col-md-6">
    <?php if($card_edition_form_status == true): ?>
    <div class="card mt-3">
        <div class="card-header bg-info">User Edition Form</div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" >
            <div class="card-body">
              <input type ="hidden" name="user_id" value="<?php echo $user['id'] ;?>">
              <div class="form-group">
                <label for=""> Name:</label>
                <input type="text" name="name" class="form-control" value="<?php echo $user['name']?>">
              </div>
              <div class="form-group">
                <label for=""> Email</label>
                <input type="text" name="email" class="form-control" value ="<?php echo $user['email']?>">
              </div>
              <div class="form-group">
                <label for=""> Address</label>
                <textarea name="address" id="" class="form-control"><?php echo $user['address']?></textarea>
              </div>
              <div class="form-group">
                <label for=""> Password</label>
                <input type="text" name="password" class="form-control" value ="<?php echo $user['password']?>">
              </div>
          
            </div>
            <div class="card-footer">
                <button name= "user_update_button" class="btn btn-info text-white submit">Update</button>
            </div>
        </form>  
      </div>
      <?php endif ?>
    </div> <!--endcard -->
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

</body>
</html>