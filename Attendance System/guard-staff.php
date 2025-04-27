<?php
# Menyemak nilai pembolehubah session['tahap']
if($_SESSION['level'] != "staff")
{

    # jika nilainya tidak sama dengan staff. aturcara akan dihentikan
    die("<script>alert('Please Login');
    window.location.href='logout.php';</script>");
}
?>