<?php
# nama host. localhost merupakan default
$host = "localhost";

# username bagi SQL. root merupakan default
$user = "root";

# password bagi SQL. masukkan password anda
$passwd = "";

# nama pangkalan data yang telah anda bangunkan sebelum ini.
$database = "Attendance_System";

# membuka hubungan antara pangkalan data dan sistem
$condb = mysqli_connect($host, $user, $passwd, $database);

# menguji adakah hubungan berjaya dibuka
if (!$condb)
{
  die("Sambungan ke pangkalan data gagal");

}
else
{
  #echo"Sambungan ke pangkalan data berjaya";
}

?>