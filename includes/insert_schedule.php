<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $scheduleDate = $_POST['scheduleDate'];
    $scheduleTime = $_POST['scheduleTime'];
    $status = $_POST['status'];

    try {
        // Use the function to get a PDO connection
        $conn = connectDB();

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO schedule (s_date, s_time, s_status) VALUES (:scheduleDate, :scheduleTime, :status)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':scheduleDate', $scheduleDate);
        $stmt->bindParam(':scheduleTime', $scheduleTime);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        
        header("Location: ../form.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Always close the connection
        if ($conn) {
            $conn = null;
        }
    }
}
?>
