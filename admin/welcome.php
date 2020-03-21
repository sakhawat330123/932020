<?php 
session_start();
if (!isset($_SESSION['username'])) {
  header("location:index.php");
}


include 'include/fun.php';
include 'dbconnection.php';

if(isset($_GET['did']))
{
  $did = intval($_GET['did']);

  $dSql = "DELETE FROM `register` WHERE regid = $did";

  if($conn->query($dSql) ==  TRUE){
    echo "<script>alert('Data deleted');</script>";
  }
}



?>

<?php 
require "include/header.php";
?>


<?php require "include/navbar.php"; ?>


<div class="main">
  <div class="idShow">
    
  </div>

  <div class="container">
    <h2>Striped Rows</h2>
    <p class="text-center">
          <?php echo $_SESSION['username']; ?>
          <?php echo $_SESSION['username'] = ""; ?>
        </p>            
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Sl</th>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Email</th>
          <th>Contract</th>
          <th>Register Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $sql = "SELECT * FROM `register`";
        $result = $conn->query($sql);
        $i = 1;
        while ($row = $result->fetch_assoc()) {

        ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $row['fname']; ?></td>
          <td><?php echo $row['lname']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['contract']; ?></td>
          <td><?php echo $row['register_date']; ?></td>
          <td>
             <a href="edit.php?eid=<?php echo $row['regid']; ?>"><button class="btn btn-primary btn-xs">edit</button></a>
             &nbsp;&nbsp;
             <a href="welcome.php?did=<?php echo $row['regid']; ?>"><button class="btn btn-primary btn-xs" onClick="return confirm('Do you really want to delete');">delete</button></a>
          </td>
        </tr>
      <?php
        $i = $i + 1;
       }

        ;

       ?>
      </tbody>
    </table>
  </div>








</div>

















<?php 
require "include/footer.php";
?>