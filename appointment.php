<?php include_once 'templates/header.php' ?>
   
<style>
    table {
            border-collapse: collapse;
            width: 90%;
            margin-top: 20px;
            border: 1px solid rgb(255, 255, 255, 0.2);
            transform:translateX(25px);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 5px 10px;
            text-align: left;
            border: 1px solid rgb(0,0,0,0.5);
            color:black;
        }
        th {
            background-color: #4caf50;
        }
        tr {
          border: 1px solid rgb(0,0,0,0.5);
        }
        .button-container {
            text-align: right;
            margin: -10px 30px -15px 0;
        }
        .button-container1 {
            text-align: right;
            margin: -10px 55px -15px 0;
        }
        .button-container1 a {
        margin-left:15px;
        }
        .row {
            display:flex;
            background-image: url(images/bg.png);
            height: 100vh;
            width: 100%;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            overflow:hidden ;
        }
        .row a {
            text-decoration:none;
        }
        .left {
            width:40%;
        }
        .right {
            width:60%;
        }
        .left h2,.right h2 {
            margin-top: 80px;
            color:white;
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
            background-image: url('images/delete.png');
            background-repeat:no-repeat;
            height:3vh;
            margin: -4px 0 -11px 0;
        } .edit-button {
            color: white;
            border: none;
            padding: 6px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            cursor: pointer;
            border-radius: 4px;
            background-image: url('images/edit.png');
            background-repeat:no-repeat;
            height:3vh;
            margin: -4px 0 -11px 0;
        }
        .scheduleTable,.addAppointment,.edit-status {
            margin-top:80px;
            display: none;
            text-align:center;
        }
        .btnFk {
            text-align: right;
        }   
        .btnFk button {
            padding: 10px 20px;
            border-radius:20px;
            border:none;
        }
        .btnFk button:hover {
            background-color: rgb(255, 255,255);
        }
        #add_appointment {
            background-color: #4caf50;
            border-radius: 5px;
            box-shadow:none;
            padding: 0 50px 30px 50px;
            text-align:left;

        }
        .addApp_btn {
            text-align:center;
            margin-bottom:-70px;
        }
        .appointment,.manageAppointment,.scheduleTable {
            margin-left:10px;
        }
        .addAppointment select,.edit-status select {
            width: 100%;
            padding:5px;
        }
        .addAppointment,.edit-status {
            position:absolute;
            z-index: 1;
            text-align:center;
            margin-top:100px;
            box-shadow: 5px 5px 10px 1px black;
            border-radius:5px;
            width:30%;
        }
        #closeManageApp,#closeAddApp {
            margin-bottom: 100px;
        }
        .appointment,.manageAppointment,.scheduleTable{
            background-color: rgb(255,255,255,0.7);
            width:97%;
            padding-bottom: 20px
        }
        .appointment h2,.manageAppointment h2,.scheduleTable h2, #add_appointment h2,.edit h2{
            color:black;
            padding-top: 20px;
        }
        .scheduleTable table {
            margin-top: -1px;
        }
        .scheduleTable h2 {
            margin-bottom:30px;
        }
        .back_button {
            text-align:left;
            margin: 0 0 -100px 20px;
        }
        .back_button a {
            font-size:20px;
        }
        .scheduleTable {
            transform:translateX(110%);
        }
        .close-button {
            text-align:right;
        }
        .close-button a {
            margin:  2px 0 0 27px;
            position:absolute;
        }
        #add-schedule {
            position:absolute;
            transform:translate(185px,-40px);  
        }
        .edit {
            background-color: #4caf50;
            padding: 5px 20px 20px 20px;
            width:30%;
            border-radius: 5px;
            display:none;
            position:absolute;
            z-index: 1;
            transform:translate(190px, 100px );
            box-shadow: 5px 5px 10px 1px black;
        }
        .edit select,.edit-status select {
            margin-right:20px;
            width:100%;
            padding: 5px 10px 10px 5px;
        }
        .closeAddAppointment {
            position:absolute;
        }
        .btn-back {
            text-align: right;
            margin: -3px -10px -100px 0;
        }
        @media screen (max-width:700px) {
            .row {
                display:block;
            }
            .left,.right {
                width:100%;
            }
            .appointment,.manageAppointment {
                width:100%;
            }
        }
        
       
</style>
 
  
    <div class="row">
        <div class="left">

<!-- APPOINMENT where s_id p_id >FK -->

    <div class="appointment" id="appointment">
      <h2 style="text-align: center;">Manage Appoinment</h2>
       <div class="button-container">
          <a href="#" onclick="viewSchedule()">View schedules</a>
      </div>
      <?php
      include 'includes/db_connection.php';
      try {
          $conn = connectDB();
      
          if ($conn) {
              $sql = "SELECT appointment.a_id, schedule.s_date, patient.p_name
              FROM appointment
              JOIN schedule ON appointment.s_id = schedule.s_id
              JOIN patient ON appointment.p_id = patient.p_id;";
              $stmt = $conn->prepare($sql);
              $stmt->execute();
              $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
              echo "<table>
                      <tr>
                          <th>ID</th>
                          <th>DATE</th>
                          <th>PATIENT</th>
                          <th>ACTION</th>
                      </tr>";
              foreach ($result as $row) {
                  echo "<tr>
                          <td>{$row['a_id']}</td>
                          <td>{$row['s_date']}</td>
                          <td>{$row['p_name']}</td>
                          <td> 
                          <a href='delete_appointment.php?a_id={$row['a_id']}' class='delete-button'></a></td>
                          </td>
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
     
</div>        

      <!-- VIEW SCHEDULE TABLE -->
            <div class="scheduleTable" id="scheduleTable">
                 <div class="back_button">
            <a href="#" id="closeSchedule" onclick="closeSchedule()">←</a>
            </div>
                <h2>Schedules</h2>
             <a href="form.php" id="add-schedule"> <img src="images/add.png" alt=""> </a>
            <?php
      try {
          $conn = connectDB();
      
          if ($conn) {
              $sql = "SELECT s_id, s_date,  s_time, s_status FROM schedule";
              $stmt = $conn->prepare($sql);
              $stmt->execute();
              $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
              echo "<table>
                      <tr>
                          <th>ID</th>
                          <th>DATE</th>
                          <th>TIME</th>
                          <th>STATUS</th>
                          <th>ACTION</th>
                          
                      </tr>";
              foreach ($result as $row) {
                  echo "<tr>
                          <td>{$row['s_id']}</td>
                          <td>{$row['s_date']}</td>
                          <td>{$row['s_time']}</td>   
                          <td>{$row['s_status']}</td>
                          <td>
                          <a href='edit_schedule.php?s_id={$row['s_id']}' class='edit-button' onclick='editSchedule({$row['s_id']})'></a>
                          <a href='delete_schedule.php?s_id={$row['s_id']}' class='delete-button'></a>
                          </td>
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
      </div>  
      <!-- END OF VIEW SCHEDULE TABLE -->
</div>


    <div class="right">
     <!-- ADD APPOINTMENT -->
    <div class="edit" id="edit">
    <div class="btn-back">
        <a href="#" id="closeAddAppointment" onclick="closeAddAppointment()">✖</a>
        </div>
    <div>
        <h2>Add Appointment</h2>
        <?php
try {
    $conn = connectDB();

    $patientSql = "SELECT p_id, p_name FROM patient";
    $patientStmt = $conn->prepare($patientSql);
    $patientStmt->execute();
    $patients = $patientStmt->fetchAll(PDO::FETCH_ASSOC);

    $scheduleSql = "SELECT s_id, s_date FROM schedule";
    $scheduleStmt = $conn->prepare($scheduleSql);
    $scheduleStmt->execute();
    $schedules = $scheduleStmt->fetchAll(PDO::FETCH_ASSOC);

    if ($patients && $schedules) {
        echo '<form method="post" action="includes/insert_appointment.php">';
        echo '<label for="patient_id">Patient:</label>';
        echo '<select name="patient_id" id="patient_id">';
        foreach ($patients as $patient) {
            echo '<option value="' . $patient['p_id'] . '">' . $patient['p_name'] . '</option>';
        }
        echo '</select>';

        echo '<br><label for="schedule_id">Schedule:</label>';
        echo '<select name="schedule_id" id="schedule_id">';
        foreach ($schedules as $schedule) {
            echo '<option value="' . $schedule['s_id'] . '">' . $schedule['s_date'] . '</option>';
        }
        echo '</select>';

        echo '<div class="btnFk"> <br>
                 <button type="submit" name="submit">Go</button>
              </div>';
        echo '</form>'; 
    } else {
        echo "<p>No patient or schedule data found.</p>";
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
<!-- END OF ADD APPOINTMENT -->

    
  <!-- JOINED TABLE -->
    <div class="manageAppointment" id="manageAppointment">
      <h2 style="text-align: center;">Appointments</h2>
      <div class="button-container1">
                <a href="#" onclick="showInsertAppointment()">Add Appointment</a>
                <a href="#" onclick="viewSchedule()">Edit Status</a>
            </div>
      <?php
      try {
          $conn = connectDB();
          if ($conn) {
              $sql = "SELECT appointment.a_id, schedule.s_date, schedule.s_time, patient.p_name , schedule.s_status  
              FROM appointment
              JOIN schedule ON appointment.s_id = schedule.s_id
              JOIN patient ON appointment.p_id = patient.p_id;";
              $stmt = $conn->prepare($sql);
              $stmt->execute();
              $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
              echo "<table>
                      <tr>
                          <th>ID</th>
                          <th>PATIENT</th>
                          <th>DATE</th>
                          <th>TIME</th>
                          <th>STATUS</th>
                      </tr>";
              foreach ($result as $row) {
                  echo "<tr>
                          <td>{$row['a_id']}</td>
                          <td>{$row['p_name']}</td>
                          <td>{$row['s_date']}</td>
                          <td>{$row['s_time']}</td>
                          <td>{$row['s_status']}</td>
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
            
</div>


</div>    
</div>
<?php include_once 'templates/footer.php' ?>


<script>
function viewSchedule() {
  document.getElementById('scheduleTable').style.display="block";
  document.getElementById('scheduleTable').style.transform="translateX(0)";
  document.getElementById('scheduleTable').style.transition="0.5s";  
  document.getElementById('appointment').style.display="none";
}
function closeSchedule() {
  document.getElementById('scheduleTable').style.display="none";
  document.getElementById('appointment').style.display="block";
}
function closeAddApp() {
  document.getElementById('addAppointment').style.display="none";
  document.getElementById('manageAppointment').style.display="block";
}
function closeAddAppointment() {
  document.getElementById('edit').style.display="none";
}
function showManageAppointment() {
  document.getElementById('addAppointment').style.display="block";
}
function showInsertAppointment() {
  document.getElementById('edit').style.display="block";
}

</script>
