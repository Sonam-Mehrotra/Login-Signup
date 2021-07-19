<?php
$error = false;
$login = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include 'Requirements/_dbconnect.php';
  $email = $_POST["email"];
  $password = $_POST["password"];

  $sql = "SELECT * from users where Email ='$email'"; 
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if($num ==1){
    while($row = mysqli_fetch_assoc($result)){
      if(password_verify($password, $row["Password"])){
    $login = true;
    session_start();
    $_SESSION['email'] = "$email";
    $_SESSION['loggedin'] = true;
    header("location: welcome.php");
  }
  else{
    $error = " Invalid Credentials";
  }
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
        background-color: rgb(206, 216, 221);
      }
      .row{
        margin-top: 20px;
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
    if($login){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> You are successfully logged in.
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
        <div class="row g-0">
          <div class="col-lg-5 g-0">
            <img src="abc.jpg" class="img-fluid" alt="" height="500px">
          </div>
          <div class="col-lg-7 px-5">
            <h1 class="my-4">Login to your account</h1>
            <h4 >Don't have an account? <a href="Signup.php">Sign up for free!</a></h4>
            <form name= "form1" onsubmit="return validatefields1()" action="/Login/Login.php" method="post">
            <div class="mb-3 form-row">
              <div class="col-lg-7 mt-5">
                <label for="email" class="form-label">Email address</label>
                <input type="email" placeholder="Email address" class="form-control" id="email" name="email" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="mb-3 form-row">
              <div class="col-lg-7 mt-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="*******" id="password" name="password">
              </div>
            </div>
            <div class="mb-3 form-row">
              <div class="mb-3 form-check mt-3">
                <input type="checkbox" class="form-check-input" id="check">
                <label class="form-check-label" for="check">Remember me</label>
              </div>
            </div>
            <div class="mb-3 form-row">
              <div class="col-lg-7">
                <button type="submit" class="btn btn-primary">Login with email</button>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <script>
      function validatefields1(){
        var email = document.form1.email.value;
        var pass =  document.form1.password.value;
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