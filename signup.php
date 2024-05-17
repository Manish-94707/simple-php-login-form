<?php
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: welcome.php");
    }
?>
<?php
    include("connection.php");
    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($conn, $_POST['user']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['pass']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpass']);
        $contact = mysqli_real_escape_string($conn, $_POST['contact']);
        $purpose = mysqli_real_escape_string($conn, $_POST['purpose']);
        $govt_id = mysqli_real_escape_string($conn, $_POST['govt_id']);
        $devicename = mysqli_real_escape_string($conn, $_POST['devicename']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $datetime = mysqli_real_escape_string($conn, $_POST['datetime']);

        
        $sql="select * from signup where username='$username'";
        $result = mysqli_query($conn, $sql);
        $count_user = mysqli_num_rows($result);

        $sql="select * from signup where email='$email'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);

        $sql="select * from signup where address='$address'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);

        $sql="select * from signup where contact='$contact'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);

        $sql="select * from signup where purpose='$purpose'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);

        $sql="select * from signup where govt_id='$govt_id'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);

        $sql="select * from signup where devicename='$devicename'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);

        $sql="select * from signup where datetime='$datetime'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);

        if($count_user == 0 & $count_email==0){
            if($password==$cpassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO signup(username, email, password) VALUES('$username', '$email', '$hash')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    header("Location: login.php");
                }
            }
            else{
                echo '<script>
                    alert("Passwords do not match");
                    window.location.href = "signup.php";
                </script>';
            }
        }
        else{
            if($count_user>0){
                echo '<script>
                    window.location.href="index.php";
                    alert("Username already exists!!");
                </script>';
            }
            if($count_email>0){
                echo '<script>
                    window.location.href="index.php";
                    alert("Email already exists!!");
                </script>';
            }
        }
        
    }
?>
<?php
    include("navbar.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Netforchoice Datacenter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
  <body>
    <div id="form">
        <h1 id="heading">SignUp Form</h1><br>
        <form name="form" action="signup.php" method="POST">
            <label>Enter Username: </label>
            <input type="text" id="user" name="user" required><br><br>
            <label>Enter Email: </label>
            <input type="email" id="email" name="email" required><br><br>
            <label>Create Password: </label>
            <input type="password" id="pass" name="pass" required><br><br>
            <label>Retype Password: </label>
            <input type="password" id="cpass" name="cpass" required><br><br>
            <label>Address: </label>
            <input type="text" id="address" name="address" required><br><br>
            <label>Contact: </label>
            <input type="tel" id="contact" name="contact" required><br><br>
            <label>Purpose: </label>
            <input type="text" id="purpose" name="purpose" required><br><br>
            <label>Government ID: </label>
            <input type="text" id="govt_id" name="govt_id" required><br><br>
            <label>Device Name: </label>
            <input type="text" id="device" name="device" required><br><br>
            <label>Date/Time: </label>
            <input type="datetime-local" id="datetime" name="datetime" required><br><br>
            <input type="submit" id="btn" value="SignUp" name = "submit"/>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>