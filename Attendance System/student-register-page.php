<?php
include('header.php');
include('guard-staff.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    
    <!-- Include your main stylesheet (if any) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Resetting default margin and padding */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        body {
            background-color: #fff8f2;
            font-family: 'Poppins', sans-serif;
            padding: 0; /* Ensures no space at the top */
        }

        h2 {
            text-align: center;
            color: #e67e22; /* Orange color for the header */
            margin-bottom: 30px;
            font-size: 28px;
            text-transform: uppercase;
            font-weight: 600;
        }

        /* Form Container */
        .form-container {
            background-color: white;
            max-width: 600px;
            margin: auto;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        /* Label styling */
        label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        /* Input Field Styling */
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        /* Focus on inputs */
        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="file"]:focus {
            border-color: #e67e22; /* Focus on orange border */
            outline: none;
        }

        /* Submit Button Styling */
        input[type="submit"] {
            padding: 12px 20px;
            background-color: #e67e22; /* Orange background */
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        /* Submit button hover effect */
        input[type="submit"]:hover {
            background-color: #cf711c; /* Darker orange on hover */
            transform: scale(1.05);
        }

        /* Responsive Design for smaller screens */
        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
                width: 90%;
            }
            h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <br>
    <h2>Student Registration</h2>

    <div class="form-container">
        <form action="student-register-process.php" method="POST" enctype="multipart/form-data">
            
            <label for="names">Name:</label>
            <input type="text" id="names" name="names" required>

            <label for="id">Student ID:</label>
            <input type="text" id="id" name="id" required>

            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" required>

            <label for="program">Program:</label>
            <input type="text" id="program" name="program" required>

            <label for="class">Class:</label>
            <input type="text" id="class" name="class" required>

            <label for="picture">Picture:</label>
            <input type="file" id="picture" name="picture" required>

            <input type="submit" value="Register">
        </form>
    </div>

</body>
</html>

<?php
include('footer.php');
?>  
