<?php
require_once 'conn.php';

$id = $_GET['id'];
$queryorg = "SELECT * FROM organization WHERE orgID = '$id'";
$resultquery = $conn->query($queryorg);
$data = $resultquery->fetch_assoc();

?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Organization</h4>
              </div>
              <form action="updateOrg.php?id=<?php echo $id;?>" method="post">
              <div class="modal-body">
                
                    <div class="form-group has-feedback">
                     <label>Organization Code:</label>
                <input type="text" class="form-control" name="orgcode" required autofocus value="<?php echo $data['orgCode']; ?>">
                     <span class="fa fa-credit-card form-control-feedback"></span>
                </div> 
                 <div class="form-group has-feedback">
                    <label>Organization Name:</label>
               <input type="text" class="form-control" name="orgname" required autofocus value="<?php echo $data['orgName']; ?>">
               <span class="fa fa-institution form-control-feedback"></span>
                </div> 
              </div>
               <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
                <button class="btn btn-outline" type="submit" name="dones">Save</button>
              </div>
          </form>
            <!-- /.modal-content -->
   
         
      