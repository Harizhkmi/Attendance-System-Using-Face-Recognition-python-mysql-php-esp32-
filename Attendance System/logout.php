<?php
# memulakan fungsi session
session_start();

# memulakan nilai pembolehubah session
session_unset();

# menghentikan fungsi session
session_destroy();

echo"<script>window.location.href='index.php';</script>";
?>