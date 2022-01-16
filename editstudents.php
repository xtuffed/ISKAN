<?php
require_once 'conn.php';

$id = $_GET['id'];
$querymember = "SELECT id, username, first_name, last_name, email, type, organization.orgCode as org FROM users, organization WHERE id = '$id' and users.orgID = organization.orgID";
$resultquery = $conn->query($querymember);
$data = $resultquery->fetch_assoc();

?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit User</h4>
              </div>
              <form action="updateUser.php?id=<?php echo $id;?>" method="post">
              <div class="modal-body">
                
                    <div class="form-group has-feedback">
                     <label>User Name:</label>
                <input type="text" class="form-control" name="username" required autofocus value="<?php echo $data['username']; ?>">
                     <span class="fa fa-credit-card form-control-feedback"></span>
                </div> 
                 <div class="form-group has-feedback">
                    <label>First Name:</label>
               <input type="text" class="form-control" name="firstname" required autofocus value="<?php echo $data['first_name']; ?>">
               <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
              <div class="form-group has-feedback">
                    <label>Last Name:</label>
               <input type="text" class="form-control" name="lastname" required autofocus value="<?php echo $data['last_name']; ?>">
               <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
              <div class="form-group has-feedback">
                    <label>E-Mail</label>
               <input type="text" class="form-control" name="email" required autofocus value="<?php echo $data['email']; ?>">
               <span class="fa fa-institution form-control-feedback"></span>
                 </div>
                 <div class="form-group has-feedback">
                    <label>Type:</label>
               		<select class="form-control" name="type" required>
                     <?php if($data['type'] == "Admin") {?>
                          <option value="Admin" selected>Admin</option>
                          <option value="Secretary">Secretary</option>
                          <?php }?>
                    <?php if($data['type'] == "Secretary") {?>
                          <option value="Admin">Admin</option>
                          <option value="Secretary" selected>Secretary</option>
                          <?php }?>
               		</select>
                 </div>
                 <div class="form-group has-feedback">
                    <label>Organization:</label>
                  <select class="form-control" name="organization" required>
                     <?php if($data['org'] == "ADMIN") {?>
                          <option value="0" selected>ADMIN</option>
                          <option value="1">OMANSS</option>
                          <option value="2">JITS</option>
                          <option value="3">SMS</option>
                          <option value="4">NaSSA</option>
                          <?php }?>
                      <?php if($data['org'] == "OMANSS") {?>
                          <option value="0">ADMIN</option>
                          <option value="1" selected>OMANSS</option>
                          <option value="2">JITS</option>
                          <option value="3">SMS</option>
                          <option value="4">NaSSA</option>
                          <?php }?>
                      <?php if($data['org'] == "JITS") {?>
                          <option value="0">ADMIN</option>
                          <option value="1">OMANSS</option>
                          <option value="2" selected>JITS</option>
                          <option value="3">SMS</option>
                          <option value="4">NaSSA</option>
                          <?php }?>
                      <?php if($data['org'] == "SMS") {?>
                          <option value="0">ADMIN</option>
                          <option value="1">OMANSS</option>
                          <option value="2">JITS</option>
                          <option value="3" selected>SMS</option>
                          <option value="4">NaSSA</option>
                          <?php }?>
                      <?php if($data['org'] == "NaSSA") {?>
                          <option value="0">ADMIN</option>
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
   
         
      