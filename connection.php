<?php
$con  = mysqli_connect('localhost','root','','food_delivery');
if(mysqli_connect_errno())
{
    echo 'Database Connection Error';
}
