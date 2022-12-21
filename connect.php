<?php
        // mysqli_connect(server,name,password, databasename);
       $dbconnection = mysqli_connect('localhost','root','','login-registration');

        if(!$dbconnection){
            die("Error:".mysqli_connect_error);
        }
?>