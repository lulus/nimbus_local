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
                <button style="width:150px" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#modal-addgroup">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                Add Group
                </button>
              </div>              
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
				  	      <th style="width:15px">No</th>
                    <th>Group Name</th>
                    <th>Limit Device</th>
                    <th style="width:180px">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $no = 1;
                    foreach ($data_groups as $data_groups){
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $data_groups['groupname']; ?></td>
                      <td><?php echo $data_groups['value']; ?></td>
                      <td>
                      <form action="groups" method="post">
                        <div class="row">
                        <button style="width:60px; height:35px" class="btn btn-block btn-secondary btn-sm mr-md-3 ml-md-3 mt-md-2" name="edit_group" value="<?php echo $this->secure->encrypt_url($data_groups['id']); ?>"><i class="fas fa-edit"></i></button>
                        <button style="width:60px; height:35px" class="btn btn-block btn-secondary btn-sm mr-md-3" name="delete_group" value="<?php echo $this->secure->encrypt_url($data_groups['id']); ?>"><i class="fas fa-trash-alt"></i></button>
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
  <div class="modal fade" id="modal-addgroup">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Admin</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="groups/add" method="post">
            <div class="modal-body">
                  <div class="form-group">
                    <label >Group Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Group Name" require>
                  </div>
                  <div class="form-group">
                    <label >Limit Device</label>
                    <input type="number" class="form-control" name="limit-device" placeholder="Enter Limit Device" require>
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
      foreach ($edit_groups as $edit_groups);
      if(count($edit_groups) > 0){ ?>
      <div class="modal fade" id="modal-editgroup">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Admin</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="groups/edit" method="post">

                    <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $edit_groups['id']; ?>">
                    <input type="hidden" name="name" value="<?php echo $edit_groups['groupname']; ?>">
                  <div class="form-group">
                    <label >Group Name</label>
                    <input type="text" class="form-control" value="<?php echo $edit_groups['groupname']; ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label >Limit Device</label>
                    <input autocomplete="off" type="number" class="form-control" name="limit-device" placeholder="Enter Limit Device" value='<?php echo $edit_groups['value']; ?>' require>
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
		var mobileModal = new bootstrap.Modal(document.getElementById('modal-editgroup'));
		mobileModal.show();
	}
});
</script> 
<?php } ?>     
<script>
  var element = document.getElementById("nav_system_manager");
  element.classList.add("menu-open");

  var element = document.getElementById("nav_groups");
  element.classList.add("active");
</script>