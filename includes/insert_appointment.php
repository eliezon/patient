<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $schedule_id = $_POST['schedule_id'];

    try {
        // Use the function to get a PDO connection
        $conn = connectDB();

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO appointment (p_id, s_id) VALUES (:patient_id, :schedule_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':patient_id', $patient_id);
        $stmt->bindParam(':schedule_id', $schedule_id);
        $stmt->execute();
        
        header("Location: ../appointment.php");
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
