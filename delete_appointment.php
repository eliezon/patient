<?php
include 'includes/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['a_id'])) {
    $userIdToDelete = $_GET['a_id'];

    try {
        // Use the function to get a PDO connection
        $conn = connectDB();

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement for deletion
        $sql = "DELETE FROM appointment WHERE a_id = :a_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':a_id', $userIdToDelete);
        $stmt->execute();

        // Redirect back to the user data page after successful deletion
        header("Location: appointment.php");
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
