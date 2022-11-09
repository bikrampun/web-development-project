<?php
    // Initialize the session
    //session is global variable stored on the server.
    //this function first checks if session is already started and if none is started then it starts one.
    session_start();

    //connecting server
    //include("connect.php");
    require_once('connect.php');

    //check if session already started for student
    if(isset($_SESSION['id'])){
        //check if data available in database or not
        if ($_SESSION['id'] != 0) {
            $host=$_SERVER['HTTP_HOST'];
            $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http://$host$uri/welcome.php");
            //header('location:welcome.php');
        }
    }
    //check if session already started for lecturer
    if(isset($_SESSION['idLec'])){
        if ($_SESSION['idLec'] != 0) {
            $host=$_SERVER['HTTP_HOST'];
            $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http://$host$uri/welcomeStaff.php");
            //header('location:welcomeStaff.php');
        }
    }
    //check if session already started for admin
    if(isset($_SESSION['idAdmin'])){
        if ($_SESSION['idAdmin'] != 0) {
            $host=$_SERVER['HTTP_HOST'];
            $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http://$host$uri/admin.php");
            //header('location:admin.php');
        }
    }
     // Code for lecturer login
     if(isset($_POST['loginLec']))
     {
         $password=$_POST['upassword'];
         $enc_password=md5($password);
         $useremail=$_POST['uemail'];
         $ret= mysqli_query($connection,"SELECT * FROM lecturers WHERE email='$useremail' and password='$enc_password'");
         
         if(!$ret){
         //check if database is empty.
             echo "<script>alert('Please, Register first!');</script>";
         } else {
         $num=mysqli_fetch_array($ret);
         //fetches a result row as an associative array, a numeric array, or both
         if($num>0)
         {
             $_SESSION['loginLec']=$_POST['uemail'];
             $_SESSION['idLec']=$num['id'];
             $_SESSION['name']=$num['fname'];
             $host=$_SERVER['HTTP_HOST'];
             $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
             header("location:http://$host$uri/welcomeStaff.php");
             //header("location: welcomeStaff.php");
         }
         else
         {
             echo "<script>alert('Invalid username or password');</script>";
             //header("location: index.php");
             
         }
         }
     }
    // Code for student login 
    if(isset($_POST['login']))
    {
        $password=$_POST['upassword'];
        $enc_password=md5($password);
        $useremail=$_POST['uemail'];
        $ret= mysqli_query($connection,"SELECT * FROM students WHERE email='$useremail' and password='$enc_password'");
        
        if(!$ret){
        //check if database is empty.
            echo "<script>alert('Please, Register first!');</script>";
        } else {
        $num=mysqli_fetch_array($ret);
        //fetches a result row as an associative array, a numeric array, or both
        if($num>0)
        {
            $_SESSION['login']=$_POST['uemail'];
            $_SESSION['id']=$num['id'];
            $_SESSION['name']=$num['fname'];
            $host=$_SERVER['HTTP_HOST'];
            $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http://$host$uri/welcome.php");
            //header("location: welcome.php");
        }
        else
        {
            echo "<script>alert('Invalid username or password');</script>";
            //header("location: index.php");
            
        }
        }
    }
    // Code for admin login
    if(isset($_POST['admin']))
    {
        $password=$_POST['pw'];
        $username=$_POST['aname'];
        $ret= mysqli_query($connection,"SELECT * FROM admin WHERE username='$username' and password='$password'");
        
        if(!$ret){
        //check if database is empty.
            echo "<script>alert('Please, Register first!');</script>";
        } else {
        $num=mysqli_fetch_array($ret);
        //fetches a result row as an associative array, a numeric array, or both
        if($num>0)
        {
            $_SESSION['idAdmin']=$num['admin_id'];
            $_SESSION['name']=$num['username'];
            $host=$_SERVER['HTTP_HOST'];
            $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http://$host$uri/admin.php");
            //header("location: admin.php");
        }
        else
        {
            echo "<script>alert('Invalid username or password');</script>";
            //header("location: index.php");
            
        }
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Online Quiz System</title>
	<!-- icon in tab -->
    <link rel="icon" href="assets/img/nepal.png">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body onload="display1()">
    <div class="intro">
        <h2>Online Quiz System</h2>
    </div>
    <br><br>
	<div class="wrapAll">
		<div class="contentHead">
			<div class="optionlist">
				<div onclick="display2()" style="cursor: pointer;" id="register-button">
                    <img src="assets/img/log.png" alt="reg" width="40px" height="40px">
                    <span class="login">Login<br>for Lecturer</span>
				</div>
				<div onclick="display3()" style="cursor: pointer;" id="login-button">
                    <img src="assets/img/log.png" alt="log" width="40px" height="40px">
                    <span class="login">Login<br>for Student</span>
				</div>
                <div onclick="display4()" style="cursor: pointer;" id="admin-button">
                    <img src="assets/img/log.png" alt="log" width="40px" height="40px">
                    <span class="login">Admin</span>
				</div>

			</div>
		</div>
		<div id="loginLec-wrap">
			<p class="bottomline">Lecturer, Login</p>
			<form class="login" action="" method="POST">
				<input type="email" class="text" name="uemail" value="" placeholder="Enter your registered email" required><br>
				<input type="password" value="" name="upassword" placeholder="Enter valid password" required>
				<div class="sign-in">
					<input type="submit" name="loginLec" value="Log In" class="pressButton">
				</div>
			</form>
		</div>
		<div id="login-wrap">
			<p class="bottomline">Student, Login</p>
			<form class="login" action="" method="POST">
				<input type="email" class="text" name="uemail" value="" placeholder="Enter your registered email" required><br>
				<input type="password" value="" name="upassword" placeholder="Enter valid password" required>
				<div class="sign-in">
					<input type="submit" name="login" value="Log In" class="pressButton">
				</div>
			</form>
		</div>
        <div id="admin-wrap">
			<p class="bottomline">ADMIN, Login</p>
			<form class="login" action="" method="POST">
				<input type="text" class="text" name="aname" value="" placeholder="Enter your admin username" style="width: 59%;" required><br>
				<input type="password" value="" name="pw" placeholder="Enter password" required>
				<div class="sign-in">
					<input type="submit" name="admin" value="Log In" class="pressButton">
				</div>
			</form>
		</div>
	</div>
    <footer class="footer" style= "top: 358px;">
        <div class="copyright">
            <p>&copy; Copyright <span id="year"></span>. All rights reserved</p>
        </div>
    </footer>
	<script type="text/javascript" src="assets/js/changeContent1.js"></script>

    <script type="text/javascript" src="assets/js/year.js"></script>
</body>
</html>