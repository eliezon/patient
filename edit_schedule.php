<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

 <style>
        .container {
            background-image: url(images/bg.png);
            height: 100vh;
            width: 100%;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            overflow:hidden ;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;  
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
        .edit {
            box-shadow: 5px 5px 10px 1px rgb(0, 0, 0, 0.7);
        }
        .back_button a {
            text-decoration:none;
            color:black;
            font-weight:bold;
        }
        
        
    </style>
<body>
    <div class="container">
            <!-- EDIT SCHEDULE -->
            <div class="edit">
            <div class="back_button">
            <a href="appointment.php">←</a>
            </div>
            <div>

        <?php include 'includes/db_connection.php';

try {
    $conn = connectDB();
    if ($conn && isset($_GET['s_id'])) {
        $userId = $_GET['s_id'];
        $sql = "SELECT s_id, s_date, s_time, s_status FROM schedule WHERE s_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            $statusSql = "SELECT DISTINCT s_status FROM schedule";
            $statusStmt = $conn->prepare($statusSql);
            $statusStmt->execute();
            $statuses = $statusStmt->fetchAll(PDO::FETCH_COLUMN);

            ?>
            <form action="update_schedule.php" method="post">
                <h2>Edit Schedule</h2>
                <input type="hidden" name="id" value="<?php echo $userData['s_id']; ?>">

                <label for="date">Date:</label>
                <input type="date" name="date" id="date" value="<?php echo $userData['s_date']; ?>">

                <label for="time">Time:</label>
                <input type="time" name="time" id="time" value="<?php echo $userData['s_time']; ?>">

                <label for="status">Status:</label>
                <select name="status" id="status">
                    <?php
                    
                    foreach ($statuses as $status) {
                        $selected = ($status == $userData['s_status']) ? 'selected' : '';
                        echo "<option value='$status' $selected>$status</option>";
                        echo "<option value='Approved'>Approved</option>";
                    }
                    ?>
                </select>

                <div class="button-container">
                    <button type="submit" class="update-button">Update</button>
                </div>
            </form>
            <?php
        } else {
            echo "<p>User not found.</p>";
        }
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