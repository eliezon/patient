<?php
include 'includes/db_connection.php';
try {
    $conn = connectDB();

    if ($conn && isset($_POST['id'])) {
        $userId = $_POST['id'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $status = $_POST['status'];

        $sql = "UPDATE schedule SET s_date = :date, s_time = :time, s_status = :status WHERE s_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $userId);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':status', $status);

        $stmt->execute();

        // Redirect back to the user data page after successful update
        header("Location: appointment.php");
        exit();
    } else {
        echo "Invalid data or user ID not provided.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    if ($conn) {
        $conn = null;
    }
}
?>