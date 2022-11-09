<?php
    //here server is connected and database is created.

    //connecting server
    //$conn=mysqli_connect($server_name,$username,$password,$database_name);
    $connection=mysqli_connect("localhost","root","");
    if(!$connection){
        echo "<br>Database not connected.";
    }

	//Create database if doesnt exist.
	// $query="CREATE DATABASE quizData";
	// mysqli_query($connection,$query);

	//Connecting database if database created.
	$db = mysqli_select_db($connection,'quizdata');
	if(! $db)
		die(mysqli_error($connection));
	// else
	// 	echo "connected";

?>