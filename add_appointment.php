<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

 <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .edit {
            background-color: #4caf50;
            padding: 20px 40px;
            border-radius:10px;
        }
        form {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction:column;
        }
        select, input {
            padding: 12px 200px 12px 10px;
        }
        label, select {
            margin-bottom: 8px;
        }
        label {
            transform: translateX(-120px);
        }

        input {
            padding: 10px;
            margin-bottom: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        .button-container {
            text-align: center;
        }

        .update-button {
            background-color: #2196f3;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
<body>
    <div class="container">
            <!-- EDIT SCHEDULE -->
            <div class="edit">
            <div>
            <?php
include 'includes/db_connection.php';
try {
    $conn = connectDB();
    $patientSql = "SELECT p_id, p_name FROM patient";
    $patientStmt = $conn->prepare($patientSql);
    $patientStmt->execute();
    $patients = $patientStmt->fetchAll(PDO::FETCH_ASSOC);

    $dateSql = "SELECT DISTINCT s_date FROM schedule";
    $dateStmt = $conn->prepare($dateSql);
    $dateStmt->execute();
    $dates = $dateStmt->fetchAll(PDO::FETCH_COLUMN);


    // Check if any patients were found
    if ($patients) {
        // Render the select tag
        echo '<select name="patient_id" id="patient_id">';
        foreach ($patients as $patient) {
            echo '<option value="' . $patient['p_id'] . '">' . $patient['p_name'] . '</option>';
        }
        echo '</select>';
    } else {
        echo "<p>No patients found.</p>";
    } if ($dates) {
        // Render the select tag
        echo '<select name="schedule_date" id="schedule_date">';
        foreach ($dates as $date) {
            echo '<option value="' . $date . '">' . $date . '</option>';
        }
        echo '</select>';
    } else {
        echo "<p>No schedule dates found.</p>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    if ($conn) {
        $conn = null;
    }
}
?>

</div>
</div>
<!-- END OF EDIT SCHEDULE -->


    </div>
</body>
</html>