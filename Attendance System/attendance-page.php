<?php
include('header.php');
include('connection.php');
include('guard-staff.php');

$class = $_GET['class'] ?? '';
$name = $_GET['name'] ?? '';
$date = $_GET['date'] ?? '';
$status = $_GET['status'] ?? '';

$where = [];
$params = [];
$types = "";

if (!empty($class)) {
    $where[] = "student.Class = ?";
    $params[] = $class;
    $types .= "s";
}
if (!empty($name)) {
    $where[] = "student.studentName LIKE ?";
    $params[] = "%" . $name . "%";
    $types .= "s";
}
if (!empty($date)) {
    $where[] = "attendance.date = ?";
    $params[] = $date;
    $types .= "s";
}
if (!empty($status)) {
    $where[] = "attendance.status = ?";
    $params[] = $status;
    $types .= "s";
}

$whereSql = $where ? "WHERE " . implode(" AND ", $where) : "";

$sql = "SELECT student.Student_ID, student.studentName, student.Class, attendance.date, attendance.status, attendance.timeIn    
        FROM attendance
        JOIN student ON attendance.Student_ID = student.Student_ID
        $whereSql
        ORDER BY 
            FIELD(attendance.status, 'Present', 'Absent'), 
            student.Class ASC, 
            attendance.date DESC";

$stmt = $condb->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance Records</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff8f2;
            font-family: 'Poppins', sans-serif;
        }

        .container-box {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            margin-top: 40px;
        }

        h2 {
            color: #e67e22;
            font-weight: 600;
        }

        label {
            font-weight: 500;
            color: #e67e22;
        }

        select, input[type="text"], input[type="date"] {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 8px 12px;
            transition: border-color 0.3s ease;
        }

        select:hover, input[type="text"]:hover, input[type="date"]:hover {
            border-color: #e67e22;
        }

        .btn-orange {
            background-color: #e67e22;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 8px 16px;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-orange:hover {
            background-color: #cf711c;
            transform: scale(1.03);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f9f1e7;
            color: #e67e22;
            font-weight: 600;
        }

        @media print {
            body {
                background: white !important;
                color: black;
                font-size: 12px;
            }


        }
    </style>
</head>
<body>

<div class="container">
    <div class="container-box">
        <h2 class="text-center mb-4">Attendance Records</h2>

        <!-- Filter Form -->
        <form method="get" class="row g-3 justify-content-center mb-4">
            <div class="col-md-2">
                <label for="class" class="form-label">Class:</label>
                <select name="class" id="class" class="form-select">
                    <option value="">-- All --</option>
                    <?php
                    $groups = ['B' => 5, 'E' => 15, 'M' => 8, 'S' => 4];
                    foreach ($groups as $prefix => $max) {
                        for ($i = 1; $i <= $max; $i++) {
                            $c = $prefix . str_pad($i, 2, '0', STR_PAD_LEFT);
                            $selected = ($c == $class) ? "selected" : "";
                            echo "<option value='$c' $selected>$c</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($name); ?>">
            </div>

            <div class="col-md-2">
                <label for="date" class="form-label">Date:</label>
                <input type="date" name="date" id="date" class="form-control" value="<?= htmlspecialchars($date); ?>">
            </div>

            <div class="col-md-2">
                <label for="status" class="form-label">Status:</label>
                <select name="status" id="status" class="form-select">
                    <option value="">-- All --</option>
                    <option value="Present" <?= $status == 'Present' ? 'selected' : '' ?>>Present</option>
                    <option value="Absent" <?= $status == 'Absent' ? 'selected' : '' ?>>Absent</option>
                </select>
            </div>

            <div class="col-md-auto d-flex align-items-end">
                <button type="submit" class="btn btn-orange me-2">Search</button>
                <button type="button" class="btn btn-success" onclick="window.print();">Print</button>
            </div>
        </form>

        <!-- Attendance Table -->
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$no}</td>
                        <td>" . htmlspecialchars($row['Student_ID']) . "</td>
                        <td>" . htmlspecialchars($row['studentName']) . "</td>
                        <td>" . htmlspecialchars($row['Class']) . "</td>
                        <td>" . htmlspecialchars($row['date']) . "</td>
                        <td>" . htmlspecialchars($row['status']) . "</td>
                        <td>" . htmlspecialchars($row['timeIn']) . "</td>
                    </tr>";
                    $no++;
                }

                if ($no === 1) {
                    echo "<tr><td colspan='7' class='text-center py-3'>No records found.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

</body>
</html>

<?php
include('footer.php');
?>  

