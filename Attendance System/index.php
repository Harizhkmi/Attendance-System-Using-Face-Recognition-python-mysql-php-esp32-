<?php

session_start();

?>

<form action = 'staff-login-process.php' method = 'POST'>

Identification No   :   <br><input type ='text' name ='staffId' required> <br>
Password            :   <br><input type ='password' name ='staffPass' required> <br>
                        <br><input type ='submit'  value='Login'>
</form>