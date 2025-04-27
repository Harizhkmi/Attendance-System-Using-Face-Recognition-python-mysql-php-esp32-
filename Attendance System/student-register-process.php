<?php

if(!empty($_POST))
{
    # memanggil fail connection
    include ('connection.php');
  
    $studentid        =   $_POST['id'];
    $file_name        =   basename($_FILES["picture"]["name"]);
    $format           =   pathinfo($nama_fail,PATHINFO_EXTENSION);
    $location         =   $_FILES['picture']['tmp_name'];
    $new_name         =   $studentid.".".$format;

    # arahan query untuk menyimpan data barang baru
    $sql_save = "insert into student
    (studentName, Student_ID, Contact, Program, Class, Picture) values
    ( '".$_POST['names']."', '".$_POST['id']."', '".$_POST['contact']."','".$_POST['program']."',
      '".$_POST['class']."', '$new_name') ";

    # melaksanakan arahan SQL menyimpan barang baru 
    $sql = mysqli_query($condb,$sql_save);
    
    # menyemak prses dilaksanakan barjaya atau tidak
    if($sql)
    {
        # muatnaik gambar
        move_uploaded_file($location,'Images/'.$new_name);
        
        # jika berjaya kembali ke fail senarai-barang.php
        die("<script>alert('Registration Successful');
        window.history.back(); </script>");
    }
    else
    {
        # if registeration failed
        die("<script>alert('Registration Failed');
        window.location.href='student-register-process.php';</script>");
    } 
  }
  else
  {
    # if the informations haven't been fully filled 
    die("<script>alert('Please Complete All Your Informations');
    window.location.href='student-register-process.php';</script>");
  }

?>  