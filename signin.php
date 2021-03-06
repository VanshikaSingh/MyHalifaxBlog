<?php
    // Initialize the session
    session_start();
    // Check if the user is already logged in, yes redirect to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]===true)
    { header("location: index.php");
       exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width= device-width , initial-scale=1">
<title>Sign In</title>
<!-- The css link for the bootstrap. -->
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- css file needed for padding the top of the page -->
<link href="css/blog-home.css" rel="stylesheet">

</head>
<body>

  <!-- Navigation bar containing all the tabs (home, about ,contact , sign in) -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
    <!-- navbar-brand name has been changed according to the specification of the assignment "Daily Journal" -->
      <a class="navbar-brand" href="#">Daily Journal</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
       <!--This div consist of the tabs in the collapsible navbar -->
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="About.php">About</a>
          </li>
          <!-- The current page is Contact so it is made to be active -->
          <li class="nav-item">
            <a class="nav-link" href="addPost.php">Add Post</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Sign In
            <span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content has been divided into columns
  This template is the post.php template.
  The changes that have been made are for the container page is mainly removing the comment part,
  leave a comment part, nested comments.-->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4">Sign in</h1>
       <!--The post contents have been changed to a line of introduction for the contact us page.
       -->
        <!-- Post Content -->
        <p class="lead">If you have an account, sign in to your account.</p>
        <!--This is the form that will be used by the user to enter his name and email id to 
        contact the owner of the post. 
        This template was taken from:
        https://getbootstrap.com/docs/4.0/components/forms/
        On: 30th September 2019
        link form the assignment1.
        -->
        <form method="POST">
            <div class="form-group" >
                <label for="exampleInputEmail1">Username</label>
                <input  class="form-control" id="exampleInputEmail1" name="username" aria-describedby="emailHelp" placeholder="Username Input">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input type="password" class="form-control" id="exampleInputEmail1" name="pass" aria-describedby="emailHelp" placeholder="Password Input">
            </div>
            
            <button type="submit" class="btn btn-primary" name="formSubmit" value="Submit">Submit</button>
        </form>
            <br><br>
         <?php
          require_once 'login.php';
          $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
          if ($conn->connect_error)
          { 
            echo"<p>Connection failed!" . mysqli_connect_error()."</p>"; 
          }
          if(isset($_POST['formSubmit']))
          {
            if($_POST['formSubmit'] === "Submit")
              {
                $myquery="SELECT * 
                      FROM Login 
                      WHERE username='".$_POST['username']."'";

                  $myquery2="SELECT * 
                      FROM Login 
                      WHERE password='".$_POST['pass']."'";
                      if ($result =  mysqli_query($conn,$myquery) ) 
                      {
                       // $temp1=$result1->fetch_assoc();
                        if($result1 =  mysqli_query($conn,$myquery2)) 
                          {
                            //set up session variables
                            $_SESSION["loggedin"]=true;
                            $row = $result1->fetch_assoc();
                            $_SESSION["userid"]=$row["UserID"];
                            header("location: index.php");
                            echo "<p>Your password is incorrect.</p>";   
                        }
                      else
                      {
                        echo "<p>Your password is incorrect.</p>";
                       }
                    }
                  else
                  {
                    echo "<p>Your username is incorrect.</p>";
                  }
                }
              }
            $conn->close();
                  
            ?>
            <h3> If you don't have an account. Create an account.</h3>
            <a href="account.php"><button type="submit" class="btn btn-primary" >Create Account</button></a>
            <br><br>
            <br><br>
        </div>
      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
  </div>
  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>


<!--JS link for the bootstrap-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>