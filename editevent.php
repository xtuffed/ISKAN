<?php
require_once 'conn.php';

$id = $_GET['id'];
$querymember = "SELECT * FROM events where eventID = '$id'";
$resultquery = $conn->query($querymember);
$data = $resultquery->fetch_assoc();

?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Event</h4>
              </div>
              <form action="updateEvent.php?id=<?php echo $id;?>" method="post">
              <div class="modal-body">
                
                    <div class="form-group has-feedback">
                     <label>Event Name:</label>
                <input type="text" class="form-control" name="eventname" required autofocus value="<?php echo $data['eventname']; ?>">
                     <span class="fa fa-credit-card form-control-feedback"></span>
                </div> 
                 <div class="form-group has-feedback">
                    <label>Event Date:</label>
               <input type="date" class="form-control" name="eventdate" required autofocus value="<?php echo $data['eventdate']; ?>">
               <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
              <div class="form-group has-feedback">
                    <label>Description:</label>
               <input type="text" class="form-control" name="description" required autofocus value="<?php echo $data['description']; ?>">
               <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                 <div class="form-group has-feedback">
                    <label>Organization:</label>
                  <select class="form-control" name="organization" required>
                      <?php if($data['orgID'] == "1") {?>
                          <option value="1" selected>OMANSS</option>
                          <option value="2">JITS</option>
                          <option value="3">SMS</option>
                          <option value="4">NaSSA</option>
                          <?php }?>
                      <?php if($data['orgID'] == "2") {?>
                          <option value="1">OMANSS</option>
                          <option value="2" selected>JITS</option>
                          <option value="3">SMS</option>
                          <option value="4">NaSSA</option>
                          <?php }?>
                      <?php if($data['orgID'] == "3") {?>
                          <option value="1">OMANSS</option>
                          <option value="2">JITS</option>
                          <option value="3" selected>SMS</option>
                          <option value="4">NaSSA</option>
                          <?php }?>
                      <?php if($data['orgID'] == "4") {?>
                          <option value="1">OMANSS</option>
                          <option value="2">JITS</option>
                          <option value="3">SMS</option>
                          <option value="4" selected>NaSSA</option>
                          <?php }?>
                  </select>
                 </div>
                
               
                  
              </div>
               <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
                <button class="btn btn-outline" type="submit" name="dones">Save</button>
              </div>
          </form>
            <!-- /.modal-content -->
   
         
      