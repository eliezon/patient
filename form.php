<?php include_once 'templates/header.php' ?>
<style>
       #patientList {
            border-radius: 8px;
            overflow: hidden;
            padding: 20px;
            width: 100%;
            max-width: 800px;
            margin-top: 90px;
        }
        .patientList {
           border-radius:5px;
           background-color: rgb(0, 0, 0,0.2);
        }
        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid rgb(255, 255, 255, 0.2);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 2px 5px;
            text-align: left;
            border: 1px solid rgb(255, 255, 255, 0.2);
        }
        td {
            color:white;
            font-weight:normal;
        }
        th {
            background-color: #4caf50;
            color: white;
        }
        tr {
          border: 1px solid rgb(255, 255, 255, 0.2);
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .add-button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        .delete-button {
            color: white;
            border: none;
            padding: 6px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            cursor: pointer;
            border-radius: 4px;
            background-image: url('images/deleteIcon.png');
            background-repeat:no-repeat;
            height:3vh;
        }
        #subBtn {
          background-color: rgb(25, 187, 25);
            border: none;
            padding: 10px 30px;
            border-radius: 5px;
            color: white;
            font-size: 18px;
        }
        .schedBtn {
          text-align:right;
        }
        .scheduleForm{
          width:40%
        }
        .appointmentForm {
          width:40%;
        }
        .nav {
          margin-bottom: -50px;
        }


        label {
        display: block;
        margin-bottom: 8px;
        color:white;
      }
      input,select {
        padding: 8px;
        margin-bottom: 12px;
        box-sizing: border-box;
        width: 100%;
      }
      form{
        background-color: rgb(0, 0, 0,0.2);
        border-radius: 5px;
        margin-top: 90px;
        padding: 20px 50px;
      }
      .doctorForm,.patientForm {
        width: 40%;
      }
      .nav button {
        background-color: transparent;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 20px;
        color:white;
        font-size: 16px;
      }
      .nav a {
        text-decoration: none;
        color:white;
        position:absolute;
        transform:translate(20px, 30px);
      }
      .nav button:hover,.nav a:hover {
      color: white;
      transition: 0.3s;
      text-shadow: 0 0 10px white;
      border:underline;
      }
    .con {
      display: flex;
      justify-content: center;
      align-items: center;
    }
      h2{
        color: white;
      }
      .error {
        position: absolute;
        background-color: rgb(255, 255, 255);
        padding: 30px 30px 50px 30px;
        box-shadow: 0 0 20px 5px rgb(0, 0, 0, 0.5);
        color: black;
      display: none;
      border-radius: 5px;
      }
      #close {
        position: absolute;
        display: none;
        background-color: rgb(25, 187, 25);
        border: none;
        padding: 5px 15px ;
        border-radius: 5px;
        color: white;
        margin-top: 50px;
      }
      .btn  {
        text-align: right;
      }
      .btn button,.schedBtn button {
        background-color: rgb(25, 187, 25);
        border: none;
        padding: 10px 30px;
        border-radius: 5px;
        color: white;
        font-size: 18px;
        cursor: pointer;
      }
      .btn button:hover,
      .subBtn:hover {
        background-color: rgb(25, 200, 25);
      } 
      .qwe {
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .patientForm,.otherBloodType,.scheduleForm {
        display:none;
      }
      .patientTable {
        display:flex;
        justify-content:center;
      }
      @media screen and (max-width:700px) {
        .appointmentForm,.doctorForm,.patientForm,.scheduleForm {
          width: 90%;
        }
      }
</style>

 <!-- TABS -->
<div class="asdasd">
  <div class="nav">
  <button id="patientListButton">Patient Data</button>
  <button id="patientButton">Register Patient</button>
    <button id="scheduleButton">Add Schedule</button>
    <a href="appointment.php">Appoinments</a>
  </div>

  <!-- PATIENT TABLE -->
  <div class="patientTable">
  <div class="patientList" id="patientList">
    
<h2 style="text-align: center;">Patient</h2>
<?php
include 'includes/db_connection.php';
try {
    $conn = connectDB();
    if ($conn) {
        $sql = "SELECT p_id, p_name, p_email, p_age, p_gender, p_bloodtype FROM patient";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>BloodType</th>
                    <th></th>
                </tr>";
        foreach ($result as $row) {
            echo "<tr>
                    <td>{$row['p_id']}</td>
                    <td>{$row['p_name']}</td>
                    <td>{$row['p_email']}</td>
                    <td>{$row['p_age']}</td>
                    <td>{$row['p_gender']}</td>
                    <td>{$row['p_bloodtype']}</td>
                    <td>  <a href='delete_patient.php?p_id={$row['p_id']}' class='delete-button'></a></td></td>
                </tr>";
        }
        echo "</table>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    if ($conn) {
        $conn = null;
    }
}
?>
<div class="button-container">
    <button type="button" onclick="addPatient()" class="add-button">Add Patient</button>
</div>
</div>
</div>

 <!-- END OF PATIENT TABLE -->

  <!-- PATIENT FORM -->
  <div class="con">
    <div class="patientForm" id="patientForm">
      <form id="patient" action="includes/insert_patient.php" method="post">
        <h2>Patient Registration Form</h2>
        <br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" onchange="calculateAge()" required>

        <label for="age">Age:</label>
        <input type="text" id="age" name="age" readonly>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
          <option value="">Select Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>

        <label for="bloodType">Blood Type:</label>
        <select id="bloodType" name="bloodType" onchange="checkBloodType()" required>
          <option value="">Select Blood Type</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="O">O</option>
          <option value="AB">AB</option>
          <option value="other">Others</option>
        </select>

        <div id="otherBloodTypeContainer" style="display:none">
          <label for="otherBloodType">Specify Other Blood Type:</label>
          <input type="text" id="otherBloodType" name="otherBloodType">
        </div>
        <br>
        <div class="btn">
          <button type="submit">Next</button>
        </div>
      </form>
    </div>
     <!-- END OF PATIENT FORM -->

      <!-- SCHEDULE FORM -->
    <div class="scheduleForm" id="scheduleForm">
      <form id="scheduleForm" action="includes/insert_schedule.php" method="post">
        <h2>Schedule</h2>
        <label for="scheduleDate">Date:</label>
        <input type="date" id="scheduleDate" name="scheduleDate" required>
        <label for="scheduleTime">Time:</label>
        <input type="time" id="scheduleTime" name="scheduleTime" required>
        <label for="status">Status:</label>
        <select name="status" id="status">
          <option value="Pending">Pending</option>
        </select>
       
        <div class="schedBtn">
          <button type="submit" id="subBtn" >Submit</button>
        </div>
      </form>
    </div>
      <!-- END OF SCHEDULE FORM -->
  
  
    </div>
  <div class="qwe" id="qwe">
    <div class="error" id="errorMessage"></div>
    <button type="button" id="close" >Ok</button>
  </div>
  
</div>
<script src="script.js"></script>
<?php include_once 'templates/footer.php' ?>

