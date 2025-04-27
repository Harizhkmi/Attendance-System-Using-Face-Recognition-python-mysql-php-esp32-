<?php
# Starting the session
session_start();

# Checking if the post data from staff-login-form.php is provided
if(!empty($_POST['staffId']) and !empty($_POST['staffPass']))
{
     # Including the connection.php file
     include ('connection.php');

   # SQL query to check if the entered data exists in the database
    $query_login = "select * from staff
    where
           staffId         =    '".$_POST['staffId']."'
    and    staffPass     =    '".$_POST['staffPass']."' ";

   # Executing the query to compare the data
    $sql_query = mysqli_query($condb,$query_login);

   # If exactly 1 matching record is found, login is successful
    if(mysqli_num_rows($sql_query)==1)
   {
       # Fetching the matching data
      $m  =   mysqli_fetch_array($sql_query);

      # Storing the data into session variables
         $_SESSION['staffId']  =   $m['staffId'];
         $_SESSION['level']  =   "staff";
         
       # Redirecting to the front-page.php
       echo "<script>window.location.href='front-page.php';</script>";
     }
     else
     {
       # Login failed. Returning to the index.php
         die("<script>alert('Login Failed');
         window.location.href='index.php';</script>");
    }
}
else
{
    # Data sent from index.php is empty
    die("<script>alert('Please Enter Identification Number and Password');
     window.location.href='index.php';</script>");
}
?>
