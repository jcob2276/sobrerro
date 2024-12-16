<?php

    $con = mysqli_connect("localhost","serwer314716","Wielorybhipis32!","serwer314716_sobrerro");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Nie udało połączyć się z MySQL: " . mysqli_connect_error();
    }
?>