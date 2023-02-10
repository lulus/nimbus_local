  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            </div>
              </div>
          <!--  -->
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dashboard" class="table table-bordered table-striped">
                  <thead>
                  <tr>
				  	        <th style="width:10px">No</th>
                    <th style="width:150px">Username</th>
                    <th style="width:150px">Auth Status</th>
                    <th style="width:150px">Date</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      foreach ($data as $row) {
			              ?>
                  <tr>
					          <td><?php echo $no; ?></td>
                    <td><?php echo $row["username"]; ?></td>
                    <td><?php echo $row["reply"]; ?></td>
                    <td><?php echo $row["authdate"]; ?></td>
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
<script>
  document.getElementById("nav_users").style.color = "#343a40"; 
  document.getElementById("nav_users").style.backgroundColor = "rgba(255, 255, 255, 0.9)";
</script>
