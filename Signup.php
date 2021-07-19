<?php
$alert = false;
$error = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'Requirements/_dbconnect.php';
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $existsql = "SELECT * from users where Email ='$email'";
    $existresult = mysqli_query($conn, $existsql);
    $numrows = mysqli_num_rows($existresult);
    if($numrows > 0){
      $error = " Email already exists";
    }
    else{
      if(($password == $cpassword)){
        $hash = password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`Email`, `Password`, `Datetime`) VALUES ('$email', '$hash', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if($result){
            $alert = true;
        }
    }
    else{
        $error = " Passwords do not match or email already exists. Please try again!";
    }
}
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Security First!</title>
    <style>
      *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
      }
      body{
        background-color: rgb(183, 200, 209);
      }
      .row{
        background-color: white;
        border-radius: 30px;
        box-shadow: 12px 12px 12px grey;
        
      }
      img{
        border-top-left-radius: 30px;
        border-bottom-left-radius: 30px;
      }
      .img-fluid {
        max-width: 100%;
        height: 570px;
        margin-left: 0;
}
.btn{
  border: none;
  outline: none;
  height: 50px;
  width: 100%;
  background-color: black;
  color: white;
  border-radius: 5px;
  font-weight: bold;
}
.btn:hover{
  border: 1px solid ;
}
    </style>
  </head>
  <body>
    <?php
    include 'Requirements/nav.php';
    if($alert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You have successfully signed up. Now you can login from <a href="Login.php">here</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if($error){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry!</strong>'.$error.
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <section class="Form my-4 mx-5 mt-5">
      <div class="container">
        <div class="row g-0 mt-5">
          <div class="col-lg-5">
            <img src="abc.jpg" class="img-fluid" alt="" height="500px">
          </div>
          <div class="col-lg-7 px-5">
            <h1 class="my-4">Signup for free!</h1>
            <form name= "form" onsubmit="return validatefields()" action="/Login/Signup.php" method="post">
              <div class="mb-3 form-row">
                <div class="col-lg-7">
                  <label for="email" class="form-label">Email address</label>
                  <input type="email" class="form-control my-3" placeholder="Email address" id="email" name="email" aria-describedby="emailHelp">
                </div>
              </div>
              <div class="mb-3 form-row">
                <div class="col-lg-7">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" placeholder="*******" id="password" name="password">
                </div>
              </div>
              <div class="mb-3 form-row">
                <div class="col-lg-7">
                  <label for="cpassword" class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" placeholder="*******" id="cpassword" name="cpassword">
                </div>
                <div class="mb-3 form-check mt-3">
                  <input type="checkbox" class="form-check-input" id="check">
                  <label class="form-check-label" for="check"><strong>I agree to the <a href="#">privacy policy</a> and <a href="#">terms of service</a></strong></label>
                </div>
              </div>
              <div class="mb-3 form-row">
                <div class="col-lg-7">
                  <button type="submit" class="btn btn-primary mb-3">Signup with email</button><br>
                  <a href="Login.php">Already have an account?</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <script>
      function validatefields(){
        var email = document.form.email.value;
        var pass =  document.form.password.value;
        if(email.length =="" && pass.length == "" ){
          alert("Email and password fields are empty");
          return false;
        }
        else
        if(email.length ==""){
          alert("Email field is empty");
          return false;
        }
        else
        if(pass.length ==""){
          alert("Password field is empty");
          return false;
        }
        else{
          return true;
        }
      }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  </body>
</html>