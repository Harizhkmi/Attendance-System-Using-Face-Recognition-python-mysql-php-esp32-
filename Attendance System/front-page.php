<?php
include('header.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to ARIS</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #fff7f0; /* Soft background */
            font-family: 'Poppins', sans-serif;
        }
        .container-box {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            padding: 50px 40px;
        }
        h1 {
            color: #e67e22;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        h1:hover {
            color: #cf711c; /* Darker on hover */
        }
        .form-label {
            font-weight: 600;
            color: #e67e22;
        }
        .btn-orange {
            background-color: #e67e22;
            color: white;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-orange:hover {
            background-color: #cf711c;
            transform: scale(1.05);
        }

        /* Hover effect for filter fields */
        input[type="text"]:hover,
        input[type="date"]:hover,
        select:hover {
            border-color: #cf711c;
            box-shadow: 0 0 0 4px rgba(230, 126, 34, 0.1);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <div class="container-box mx-auto" style="max-width: 700px;">

        <h1 class="text-center text-uppercase mb-3">Welcome to ARIS</h1>

        <p class="text-center text-muted mb-4">
            Use the form below to view attendance records based on class, student name, date, or status.<br>
            <small class="text-secondary">(You don't have to fill in all fields.)</small>
        </p>

        <form method="get" action="attendance-page.php">
            <div class="mb-3 row">
                <label for="class" class="col-sm-4 col-form-label form-label">Class:</label>
                <div class="col-sm-8">
                    <select name="class" id="class" class="form-select">
                        <option value="">-- Choose Class --</option>
                        <?php
                        $classGroups = ['B' => 5, 'E' => 15, 'M' => 8, 'S' => 4];
                        foreach ($classGroups as $prefix => $count) {
                            for ($i = 1; $i <= $count; $i++) {
                                $code = $prefix . str_pad($i, 2, '0', STR_PAD_LEFT);
                                echo "<option value='$code'>$code</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="name" class="col-sm-4 col-form-label form-label">Student Name:</label>
                <div class="col-sm-8">
                    <input type="text" name="name" id="name" class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="date" class="col-sm-4 col-form-label form-label">Date:</label>
                <div class="col-sm-8">
                    <input type="date" name="date" id="date" class="form-control">
                </div>
            </div>

            <div class="mb-4 row">
                <label for="status" class="col-sm-4 col-form-label form-label">Status:</label>
                <div class="col-sm-8">
                    <select name="status" id="status" class="form-select">
                        <option value="">-- Choose Status --</option>
                        <option value="Present">Present</option>
                        <option value="Absent">Absent</option>
                    </select>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-orange px-4 py-2">Search Attendance</button>
            </div>
        </form>

    </div>
</div>

</body>
</html>

<?php
include('footer.php');
?>  
