<?php
   require "./partials/_nav.php";

   session_start();

   if($_SERVER['REQUEST_METHOD'] == 'POST') 
   {
      require "./partials/_dbconnect.php";

      $username = $_POST['username'];
      $password = $_POST['password'];

      $entry=false;

      $query="SELECT * FROM users";
      $table=mysqli_query($conn,$query);

      while($row=mysqli_fetch_assoc($table))
      {
         if($username==$row['username'] and password_verify($password,$row['password']))
         {
            $entry=true;
         }
      }

      if($entry)
      {
         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>Login successful</strong>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
         
         session_start();
         $_SESSION['loggedin']=true;
         $_SESSION['username']=$username;
         header('Location: welcome.php');
         die('redirect');
      }
      else
      {
         echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
         <strong>Login failed!</strong>Username and password donot match
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
      }
   }
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <title>EntryExit Login</title>

</head>

<style>
   .container 
   {
      align-items: center;
      width: 40%;
      min-width: 400px;
   }
</style>

<body>
   <div class="container">
      <h1 class="text-center">Login to the website</h1>

      <form action="/EntryExit/login.php" method="post">
         <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username">
         </div>
         <div class="mb-3">
            <label for="password" class="form-label"> Password</label>
            <input type="password" class="form-control" id="password" name="password">
         </div>
         <button type="submit" class="btn btn-primary">Login</button>
         <button type="reset" class="btn btn-secondary">Reset</button>
      </form>



   </div>
</body>

</html>