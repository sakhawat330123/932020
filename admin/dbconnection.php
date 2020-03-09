
<?php
  require "includes/header.php";
 ?>
<!-- show your meal section strat -->
<section id="show_meal_bg">
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-12 col-md-auto">
        <br><br>
        <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-inline">
          <div class="form-group">
            <label for="saveDailyDate">date : </label>
            <input type="date" class="form-control" name="saveDailyDate" id="saveDailyDate" required>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" name="saveDailyMealSubmit" value="Check Meal">
          </div>
        </form>
      </div>
    </div>
<?php
  include "includes/connection.php";   
  if (isset($_REQUEST['saveDailyMealSubmit'])) {
    $saveDailyDate = $_REQUEST['saveDailyDate'];

    $fatch_query= "SELECT * FROM `addmember`";
    $result= $con->query($fatch_query);
    if ($result-> num_rows > 0) {
 ?>
    <div class="row table_bg">
      <div class="col-md-12">
        <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <div class="table-responsive">
              <table class="table table-sm table-hover table-bordered">
                <thead>
                  <tr class="bg-info text-white text-center">
                    <th>Date</th>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Sl No</th>
                    <th>Taken meal</th>
                  </tr>
                </thead>
                <?php
                  while ($row=$result->fetch_assoc()) {
                    $sId = $row['id'];
                    $sName = $row['name'];
                    $sSirial = $row['addMemberSl'];
                    $data[] = $row;              
                ?>
                <tbody>
                  <tr>
                    <td><?php echo $saveDailyDate; ?></td>
                    <td><?php echo $sId; ?></td>
                    <td><?php echo $sName; ?></td>
                    <td><?php echo $sSirial; ?></td>
                    <td>&nbsp;&nbsp; Present &nbsp;<input type="checkbox" name="adsent[]" id="" checked></td>
                  </tr>
                  <?php
                      }
                  ?>
                  <?php $_SESSION['data'] = $data?>                     
                  <?php print_r($_SESSION['data'])?>                     
                  <tr>
                    <td colspan="5" class="text-center"><input type="submit" class="btn btn-info" name="saveMealbtn" value="SAVE"></td>
                  </tr>
                </tbody>
              </table>
            </div>
        </form>    
      </div>
    </div>
<?php 
  }
}  
 ?>
  </div>
</section>
<!-- show your meal section end -->
<br><br><br>



<?php 
  require "includes/footer.php"

 ?>