  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    <?php
    foreach ($total as $row)
    foreach ($today as $today)
    foreach ($week as $week)
    foreach ($months as $months)

    $graph_tanggal = array();
    $graph_jumlah = array();

    foreach ($graph as $graph){
      array_push($graph_tanggal,  $graph['tanggal']);
      array_push($graph_jumlah,  intval($graph['jumlah']));
    }
    ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Auth</span>
                <span class="info-box-number"><?php echo $row["total"]; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today</span>
                <span class="info-box-number"><?php echo $today["today"]; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Week</span>
                <span class="info-box-number"><?php echo $week["week"]; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Month</span>
                <span class="info-box-number"><?php echo $months["months"]; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
          <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
              <figure class="highcharts-figure">
                  <div id="container" style="padding-right: 20px;"></div>
              </figure>
              </div>
              <!-- /.card-body -->
          </div>
            <!-- /.card -->
            <!-- End -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Last 10 User Authentication</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
				  	        <th style="width:5px">No</th>
				  	        <th style="width:10px">Username</th>
                    <th style="width:10px">Auth Status</th>
                    <th style="width:170px">Date</th>
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
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
<script>
  document.getElementById("nav_dashboard").style.color = "#343a40"; 
  document.getElementById("nav_dashboard").style.backgroundColor = "rgba(255, 255, 255, 0.9)";
</script>
<script>
    Highcharts.chart('container', {
    chart: {
        type: 'area'
    },
    title: {
        text: 'Guest Authentication'
    },
    xAxis: {
        categories: <?=json_encode($graph_tanggal)?>,
        tickmarkPlacement: 'on',
        title: {
            enabled: false
        }
    },
    yAxis: {
        title: {
            text: ''
        },
        labels: {
            formatter: function () {
                return this.value;
            }
        }
    },
    tooltip: {
        split: false,
        valueSuffix: ' Guest'
    },
    plotOptions: {
        area: {
            stacking: 'normal',
            lineColor: '#666666',
            lineWidth: 1,
            marker: {
                lineWidth: 1,
                lineColor: '#666666'
            }
        }
    },
    series: [{
        name: 'Guest',
        data: <?=json_encode($graph_jumlah)?>
    }]
});
</script>