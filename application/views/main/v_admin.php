  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
            <div class="card-header">
                <button style="width:150px" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#modal-adduser">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                Add Admin
                </button>
              </div>              
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
				  	    <th style="width:15px">No</th>
                    <th>Username</th>
                    <th>Description</th>
                    <th style="width:180px">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($data_admin as $data_admin){
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $data_admin['username']; ?></td>
                      <td><?php echo $data_admin['description']; ?></td>
                      <td>
                      <form action="admin" method="post">
                        <div class="row">
                        <button style="width:60px; height:35px" class="btn btn-block btn-secondary btn-sm mr-md-3 ml-md-3 mt-md-2" name="edit_user" value="<?php echo $this->secure->encrypt_url($data_admin['id']); ?>"><i class="fas fa-edit"></i></button>
                        <?php 
                            if($data_admin['priority'] != '9'){
                        ?>
                        <button style="width:60px; height:35px" class="btn btn-block btn-secondary btn-sm mr-md-3" name="delete_user" value="<?php echo $this->secure->encrypt_url($data_admin['id']); ?>"><i class="fas fa-trash-alt"></i></button>
                        <?php
                            }
                        ?>
                        </div>
                      </form>
                      </td>
                    </tr>
                      <?php 
                        $no = $no + 1;
                        } 
                      ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-adduser">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Admin</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="admin/add" method="post">
            <div class="modal-body">
                  <div class="form-group">
                    <label >User Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Username" require>
                  </div>
                  <div class="form-group">
                    <label >Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter Password" require>
                  </div>
                  <div class="form-group">
                    <label for="textarea">Description</label>
                    <textarea class="form-control" rows="2" name="description"></textarea>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="Submit" class="btn btn-secondary">Add</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <?php 
      foreach ($edit_admin as $edit_admin);
      if(count($edit_admin) > 0){ ?>
      <div class="modal fade" id="modal-edituser">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Admin</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="admin/edit" method="post">

                    <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $edit_admin['id']; ?>">
                    <input type="hidden" name="name" value="<?php echo $edit_admin['username']; ?>">
                  <div class="form-group">
                    <label >User Name</label>
                    <input type="text" class="form-control" value="<?php echo $edit_admin['username']; ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label >Password</label>
                    <input autocomplete="off" type="password" class="form-control" name="password" placeholder="Enter Password" value='<?php echo $edit_admin['password']; ?>' require>
                  </div>
                  <div class="form-group">
                    <label for="textarea">Description</label>
                    <textarea class="form-control" rows="2" name="description"><?php echo $edit_admin['description']; ?></textarea>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="Submit" class="btn btn-secondary">Update</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<script>
'use strict';
document.addEventListener("DOMContentLoaded", function() {
	if (window.location.href.indexOf("#fail") > -1) {
		toastr.error('Invalid username or password');
	}
});

document.addEventListener("DOMContentLoaded", function() {
	if (window.location.href.indexOf("#edit") > -1) {
		var mobileModal = new bootstrap.Modal(document.getElementById('modal-edituser'));
		mobileModal.show();
	}
});
</script> 
<?php } ?>     
<script>
  var element = document.getElementById("nav_system_manager");
  element.classList.add("menu-open");

  var element = document.getElementById("nav_administrator");
  element.classList.add("active");
</script>