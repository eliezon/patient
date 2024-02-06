<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    
    // Check if bloodType is 'other', use the value of otherBloodType
    if ($_POST['bloodType'] === 'other') {
        $bloodType = $_POST['otherBloodType'];
    } else {
        $bloodType = $_POST['bloodType'];
    }

    $dob_date = new DateTime($dob);
    $current_date = new DateTime();
    $age = $current_date->diff($dob_date)->y;

    try {
        // Use the function to get a PDO connection
        $conn = connectDB();

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO patient (p_name, p_email, p_dob, p_age, p_gender, p_bloodType) VALUES (:name, :email, :dob, :age, :gender, :bloodType)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':bloodType', $bloodType);
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

