<?php 
require_once 'conn.php';

$id = $_GET['id'];
$querymember = "SELECT * FROM events WHERE eventID = '$id'";
$resultquery = $conn->query($querymember);
$data = $resultquery->fetch_assoc();

?>

			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Remove Event</h4>
         </div>
            <form action="delEvent.php?id=<?php echo $id;?>" method="post">
              <div class="modal-body">
                <p style="font-size: 120%">Are you sure to remove <?php echo $data['eventname'];?> ? </p>
                 
               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" name="done" class="btn btn-outline">Remove</button>
              </div>
               </form>