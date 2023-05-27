<?php
    require "./partials/_nav.php";
    
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        require "./partials/_dbconnect.php";

        $username=$_POST['username'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];

        if($password!=$cpassword)
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Signup failed!</strong> Password and confirm password donot match
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        else
        {
            $duplicate=false;

            $table_connect="SELECT * FROM users";
            $table_fetch=mysqli_query($conn,$table_connect);

            while($row=mysqli_fetch_assoc($table_fetch))
            {
                if($row['username']==$username)
                {
                    $duplicate=true;
                }
            }

            if($duplicate)
            {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Signup failed!</strong> Username '.$username.'
                 Already exists. Try another username.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            else if(strlen($password)<4)
            {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Signup failed!</strong> Password is too weak. It must be atleast 4 character long.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            else
            {
                $hash=password_hash($password,PASSWORD_DEFAULT);
                $query="INSERT INTO users (`username`,`password`, `dt` ) VALUES  ('$username','$hash',current_timestamp())";
                $result=mysqli_query($conn,$query);

                if($result)
                {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your account is now created and you can login
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
                else
                {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Signup failed!</strong> Please try again later.
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>EntryExit Signup</title>

</head>

<style>
    .container {
        align-items: center;
        width: 40%;
        min-width: 400px;
    }
</style>

<body>
    <div class="container">
        <h1 class="text-center">Signup to the website</h1>

        <form action="/EntryExit/signup.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Set Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
            </div>
            <button type="submit" class="btn btn-primary">Signup</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </form>



    </div>
</body>

</html>