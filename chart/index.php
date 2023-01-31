    <?php
    //untuk RAM
    $connect = mysqli_connect('localhost', 'root', '', 'db_simover');
    $data_penjualan = mysqli_query($connect, "SELECT cpu_perc, ram_perc, disk_perc, TIME(date) waktu FROM t_hardware ORDER BY waktu LIMIT 30");
   // $data_penjualan = mysqli_query($connect, "SELECT tanggal, SUM(total) AS total FROM penjualan GROUP BY tanggal");
    $data_tanggal = array();
    $data_cpu = array();
    $data_ram = array();
    $data_disk = array();

    while ($data = mysqli_fetch_array($data_penjualan)) {
      $data_tanggal[] = date('H:i:s A', strtotime($data['waktu'])); // Memasukan tanggal ke dalam array
      $data_cpu[] = $data['cpu_perc']; // Memasukan total ke dalam array
      $data_ram[] = $data['ram_perc']; // Memasukan total ke dalam array
      $data_disk[] = $data['disk_perc']; // Memasukan total ke dalam array
    }
    ?>

   

    <!DOCTYPE html>
    <html>
    <head>
      <title>Membuat Grafik Di PHP dan MySQL menggunakan Chartjs</title>
      <style>
        .container {
          width: 100%;
          margin: 15px 10px;
        }
        .chart {
          width: 50%;
          float: left;
          text-align: center;
        }
      </style>
      <script type="text/javascript" src="Chart.bundle.min.js"></script>
    </head>
    <body>
      <div class="container">
        <div class="chart">
          <h2>Bar Chart</h2>
          <canvas id="bar-chart"></canvas>
        </div>
        <div class="chart">
          <h2>Line Chart</h2>
          <canvas id="line-cpu"></canvas>
        </div> 
        <div class="chart">
          <h2>Line Chart</h2>
          <canvas id="line-ram"></canvas>
        </div>
         <div class="chart">
          <h2>Line Chart</h2>
          <canvas id="line-disk"></canvas>
        </div>
      </div>
      <script>
        var barchart = document.getElementById('bar-chart');
        var chart = new Chart(barchart, {
          type: 'bar',
          data: {
            labels: <?php echo json_encode($data_tanggal) ?>, // Merubah data tanggal menjadi format JSON
            datasets: [{
              label: 'Data Penjualan',
              data: <?php echo json_encode($data_ram) ?>,
              backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)'
              ],
              borderColor: [
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)'
              ],
              borderWidth: 2
            }]
          }
        });
        var linechart = document.getElementById('line-cpu');
        var chart = new Chart(linechart, {
          type: 'line',
          data: {
            labels: <?php echo json_encode($data_tanggal) ?>, // Merubah data tanggal menjadi format JSON
            datasets: [{
              label: 'Data Penjualan',
              data: <?php echo json_encode($data_cpu) ?>,
              borderColor: 'rgba(255,99,132,1)',
              backgroundColor: 'transparent',
              borderWidth: 2
            }]
          }
        });

         var linechart = document.getElementById('line-ram');
        var chart = new Chart(linechart, {
          type: 'line',
          data: {
            labels: <?php echo json_encode($data_tanggal) ?>, // Merubah data tanggal menjadi format JSON
            datasets: [{
              label: 'Data Penjualan',
              data: <?php echo json_encode($data_ram) ?>,
              borderColor: 'rgba(255,99,132,1)',
              backgroundColor: 'transparent',
              borderWidth: 2
            }]
          }
        });

        var linechart = document.getElementById('line-disk');
        var chart = new Chart(linechart, {
          type: 'line',
          data: {
            labels: <?php echo json_encode($data_tanggal) ?>, // Merubah data tanggal menjadi format JSON
            datasets: [{
              label: 'Data Penggunaan Disk',
              data: <?php echo json_encode($data_disk) ?>,
              borderColor: 'rgba(255,99,132,1)',
              backgroundColor: 'transparent',
              borderWidth: 2
            }]
          }
        });
      </script>

       <script type="text/javascript" src="Chart.bundle.min.js"></script>
    </body>
    </html>