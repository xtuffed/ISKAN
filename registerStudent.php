<?php 
require_once 'conn.php';

$id = $_GET['id'];
$querymember = "SELECT * FROM students WHERE studentID = '$id'";
$resultquery = $conn->query($querymember);
$data = $resultquery->fetch_assoc();

?>

			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Register Student</h4>
         </div>
            <form action="regStudents.php?id=<?php echo $id; ?>" method="post">
              <div class="modal-body">
                <p style="font-size: 120%">Register <?php echo $data['first_name'];?> to </p>
                 
                <select name="org" class="form-control select2" style="width: 20%;">
                  <option value="0" selected="selected">ADMIN</option>
                  <option value="1">COA</option>
                  <option value="2">BA&A</option>
                  <option value="3">COED</option>
                  <option value="4">COE</option>
                  <option value="5">COF</option>
                  <option value="6">CNSM</option>
                  <option value="7">CSSH</option>
                  <option value="8">GRAD SCHOOL</option>
                  <option value="9">SHS</option>
                  <option value="10">LAW</option>
                </select>
                
               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="submit" name="done" class="btn btn-outline">Register</button>
              </div>
               </form>