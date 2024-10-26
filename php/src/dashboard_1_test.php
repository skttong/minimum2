<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ระบบทรัพยากรสุขภาพจิตและจิตเวช</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/fonts-googleapis.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	
 <script type="text/javascript"  src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
 <script  type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.gammel.js"></script>
 <script type="text/javascript">
 	FusionCharts.ready(function(){
		var chartObj = new FusionCharts({
		type: 'column2d',
		renderAt: 'chart-T1',
		width: '700',
		height: '300',
		dataFormat: 'json',
		dataSource: {
				chart: {
					caption: "ข้อมูลแพทย์เฉพาะทาง",
					subCaption: "",
					xAxisName: "วิชาชีพเฉพาะ",
					yAxisName: "จำนวน (คน)",
					numberPrefix: "",
					showvalues: "1",
					theme: "gammel"
				},
				data: [ 
					<?php 
					$sql = "SELECT T1.r1,
								(SELECT count( personnelID ) AS CDOC FROM personnel WHERE personnel.r1 = T1.r1 ) AS TR1
							FROM
								personnel AS T1
							WHERE
								T1.positiontypeID = 1
							GROUP BY
								T1.r1";
					$obj = mysqli_query($con, $sql);

					while($row = mysqli_fetch_array($obj)){?>
					{
						label: "<?php echo $row['r1']; ?>",
						value: "<?php echo $row['TR1']; ?>"
					},
					<?php } ?>  
				],
				trendlines: [{
					line: [{
						startvalue: "0",
						valueOnRight: "1"
					}]
				}]
			}
		});
		chartObj.render();
	});
	 
	FusionCharts.ready(function(){
		var chartObj = new FusionCharts({
		type: 'column2d',
		renderAt: 'chart-T2',
		width: '700',
		height: '300',
		dataFormat: 'json',
		dataSource: {
				chart: {
					caption: "ข้อมูลพยาบาลเฉพาะทาง",
					subCaption: "",
					xAxisName: "วุฒิการศึกษา",
					yAxisName: "จำนวน (คน)",
					numberPrefix: "",
					showvalues: "1",
					theme: "gammel"
				},
				data: [ 
					<?php 
					$sql = "SELECT T1.congrat,
								(SELECT count( personnelID ) AS CDOC FROM personnel WHERE personnel.congrat = T1.congrat) AS TCONG
							FROM
								personnel AS T1
							WHERE
								T1.positiontypeID = 2
							GROUP BY
								T1.congrat";
					$obj = mysqli_query($con, $sql);

					while($row = mysqli_fetch_array($obj)){?>
					{
						label: "<?php echo $row['congrat']; ?>",
						value: "<?php echo $row['TCONG']; ?>"
					},
					<?php } ?>  
				],
				trendlines: [{
					line: [{
						startvalue: "0",
						valueOnRight: "1"
					}]
				}]
			}
		});
		chartObj.render();
	});
	 
	 
	 
	 
	 
	 
      FusionCharts.ready(function() {
       
		  
		var salesRevChart = new FusionCharts({
          type: "stackedcolumn2d",
          renderAt: "sales-chart-container2",
          width: "500",
          height: "300",
		  
          dataFormat: "json",
          dataSource: {
            chart: {
              caption: "Daily Revenue",
              subcaption: "Last 3 weeks",
              xaxisname: "Date",
              yaxisname: "Revenue (In USD)",
              numberprefix: "$",
              showvalues: "0",
              theme: "gammel"
            },
			 categories: [
			{
			  category: [
				{
				  label: "Canada"
				},
				{
				  label: "China"
				},
				{
				  label: "Russia"
				},
				{
				  label: "Australia"
				},
				{
				  label: "United States"
				},
				{
				  label: "France"
				}
			  ]
			}
		  ],  
			dataset: [
    {
      seriesname: "Coal",
      data: [
        {
          value: "400"
        },
        {
          value: "830"
        },
        {
          value: "500"
        },
        {
          value: "420"
        },
        {
          value: "790"
        },
        {
          value: "380"
        }
      ]
    },
    {
      seriesname: "Hydro",
      data: [
        {
          value: "350"
        },
        {
          value: "620"
        },
        {
          value: "410"
        },
        {
          value: "370"
        },
        {
          value: "720"
        },
        {
          value: "310"
        }
      ]
    },
    {
      seriesname: "Nuclear",
      data: [
        {
          value: "210"
        },
        {
          value: "400"
        },
        {
          value: "450"
        },
        {
          value: "180"
        },
        {
          value: "570"
        },
        {
          value: "270"
        }
      ]
    },
    {
      seriesname: "Gas",
      data: [
        {
          value: "180"
        },
        {
          value: "330"
        },
        {
          value: "230"
        },
        {
          value: "160"
        },
        {
          value: "440"
        },
        {
          value: "350"
        }
      ]
    },
    {
      seriesname: "Oil",
      data: [
        {
          value: "60"
        },
        {
          value: "200"
        },
        {
          value: "200"
        },
        {
          value: "50"
        },
        {
          value: "230"
        },
        {
          value: "150"
        }
      ]
    }
  ]
}	  
		  
		}).render();  
		  
	
		  
var revenueChart = new FusionCharts({
    type: 'doughnut2d',
    renderAt: 'doughnut-chart-container1',
    width: '450',
    height: '350',
    dataFormat: 'json',
    dataSource: {
      "chart": {
        "caption": "เภสัชกร",
        //"subCaption": "Last year",
        //"numberPrefix": "$",
        "bgColor": "#ffffff",
        //"startingAngle": "310",
        //"showLegend": "1",
        //"defaultCenterLabel": "Total revenue: $64.08K",
        //"centerLabel": "Revenue from $label: $value",
        //"centerLabelBold": "1",
        "showTooltip": "0",
        "decimals": "0",
        "pieRadius": "90",
        "theme": "gammel"
      },
		
		
      "data": [
		  
		  <?php 
					$sql2 = "SELECT
								personnel.training,
								count(personnel.positiontypeID) as 'total'
							FROM
								personnel
							WHERE
								personnel.positiontypeID = 3
							GROUP BY
								personnel.training";
					$obj2 = mysqli_query($con, $sql2);

					while($row2 = mysqli_fetch_array($obj2)){?>
					{
						label: "<?php echo $row2['training']; ?>",
						value: "<?php echo $row2['total']; ?>"
					},
					<?php } ?>  
      ]
    }
  }).render();  
		  		var revenueChart = new FusionCharts({
    type: 'doughnut2d',
    renderAt: 'doughnut-chart-container2',
    width: '450',
    height: '350',
    dataFormat: 'json',
    dataSource: {
      "chart": {
        "caption": " นักจิตวิทยาคลินิก/นักจิตวิทยา",
       // "subCaption": "Last year",
       // "numberPrefix": "$",
       //  "bgColor": "#ffffff",
        "startingAngle": "310",
        "showLegend": "1",
        //"defaultCenterLabel": "Total revenue: $64.08K",
        //"centerLabel": "Revenue from $label: $value",
        "centerLabelBold": "1",
        "showTooltip": "0",
        "decimals": "0",
        "pieRadius": "90",
        "theme": "gammel"
      },
      "data": [  <?php 
					$sql3 = "SELECT
								personnel.positionrole,
								count(personnel.positiontypeID) as 'total'
							FROM
								personnel
							WHERE
								personnel.positiontypeID = 4
							GROUP BY
								personnel.positionrole";
					$obj3 = mysqli_query($con, $sql3);

					while($row3 = mysqli_fetch_array($obj3)){?>
					{
						label: "<?php echo $row3['positionrole']; ?>",
						value: "<?php echo $row3['total']; ?>"
					},
					<?php } ?>  
      ]
    }
  }).render();
		  
var revenueChart = new FusionCharts({
    type: 'doughnut2d',
    renderAt: 'doughnut-chart-container3',
    width: '450',
    height: '350',
    dataFormat: 'json',
    dataSource: {
      "chart": {
        "caption": " นักสังคมสงเคราะห์จิตเวช/นักสังคมสงเคราะห์ที่ปฏิบัติงานสุขภาพจิต",
       // "subCaption": "Last year",
       // "numberPrefix": "$",
       //  "bgColor": "#ffffff",
        "startingAngle": "310",
        "showLegend": "1",
        //"defaultCenterLabel": "Total revenue: $64.08K",
        //"centerLabel": "Revenue from $label: $value",
        "centerLabelBold": "1",
        "showTooltip": "0",
        "decimals": "0",
        "pieRadius": "90",
        "theme": "gammel"
      },
      "data": [
		   <?php 
					$sql4 = "SELECT
								personnel.training,
								count(personnel.positiontypeID) as 'total'
							FROM
								personnel
							WHERE
								personnel.positiontypeID = 5
							GROUP BY
								personnel.training";
					$obj4 = mysqli_query($con, $sql4);

					while($row4 = mysqli_fetch_array($obj4)){?>
					{
						label: "<?php echo $row4['training']; ?>",
						value: "<?php echo $row4['total']; ?>"
					},
					<?php } ?>
      ]
    }
  }).render();
		  
		var revenueChart = new FusionCharts({
    type: 'doughnut2d',
    renderAt: 'doughnut-chart-container4',
    width: '450',
    height: '350',
    dataFormat: 'json',
    dataSource: {
      "chart": {
        //"caption": "Split of Revenue by Product Categories",
        //"subCaption": "Last year",
        //"numberPrefix": "$",
        "bgColor": "#ffffff",
        "startingAngle": "310",
        "showLegend": "1",
        //"defaultCenterLabel": "Total revenue: $64.08K",
        //"centerLabel": "Revenue from $label: $value",
        "centerLabelBold": "1",
        "showTooltip": "0",
        "decimals": "0",
        "pieRadius": "90",
        "theme": "gammel"
      },
      "data": [
		   <?php 
					$sql5 = "SELECT
							  personnel.positiontypeID,
								count(personnel.positiontypeID) as 'total'
							FROM
								personnel
							WHERE
								personnel.positiontypeID in('6','7','8')
							GROUP BY
								personnel.positiontypeID";
					$obj5 = mysqli_query($con, $sql5);

					while($row5 = mysqli_fetch_array($obj5)){?>
					{
						label: "<?php echo $row5['positiontypeID']; ?>",
						value: "<?php echo $row5['total']; ?>"
					},
					<?php } ?>
      ]
    }
  }).render();	
		  
		  
		var revenueChart = new FusionCharts({
    type: 'doughnut2d',
    renderAt: 'doughnut-chart-container5',
    width: '350',
    height: '250',
    dataFormat: 'json',
    dataSource: {
      "chart": {
        "caption": "Split of Revenue by Product Categories",
        "subCaption": "Last year",
        "numberPrefix": "$",
        "bgColor": "#ffffff",
        "startingAngle": "310",
        "showLegend": "1",
        "defaultCenterLabel": "Total revenue: $64.08K",
        "centerLabel": "Revenue from $label: $value",
        "centerLabelBold": "1",
        "showTooltip": "0",
        "decimals": "0",
        "pieRadius": "90",
        "theme": "gammel"
      },
      "data": [{
          "label": "Food",
          "value": "28504"
        },
        /*{
          "label": "Apparels",
          "value": "14633"
        },
        {
          "label": "Electronics",
          "value": "10507"
        },*/
        {
          "label": "Household",
          "value": "4910"
        }
      ]
    }
  }).render();		
		  
		var revenueChart = new FusionCharts({
    type: 'doughnut2d',
    renderAt: 'doughnut-chart-container6',
    width: '350',
    height: '250',
    dataFormat: 'json',
    dataSource: {
      "chart": {
        "caption": "Split of Revenue by Product Categories",
        "subCaption": "Last year",
        "numberPrefix": "$",
        "bgColor": "#ffffff",
        "startingAngle": "310",
        "showLegend": "1",
        "defaultCenterLabel": "Total revenue: $64.08K",
        "centerLabel": "Revenue from $label: $value",
        "centerLabelBold": "1",
        "showTooltip": "0",
        "decimals": "0",
        "pieRadius": "90",
        "theme": "gammel"
      },
      "data": [{
          "label": "Food",
          "value": "28504"
        },
        /*{
          "label": "Apparels",
          "value": "14633"
        },
        {
          "label": "Electronics",
          "value": "10507"
        },*/
        {
          "label": "Household",
          "value": "4910"
        }
      ]
    }
  }).render();	
		  
var salesMap = new FusionCharts({
    type: 'maps/thailand',
    renderAt: 'map-chart-container',
    width: '600',
    height: '400',
    dataFormat: 'json',
    dataSource: {
      "chart": {
        "caption": "Annual Sales by State",
        "subcaption": "Last year",
        "entityFillHoverColor": "#cccccc",
        "numberPrefix": "$",
        "showLabels": "1",
        "theme": "gammel"
      },
      "colorrange": {
        "minvalue": "920000",
        "startlabel": "Low",
        "endlabel": "High",
        "code": "#e44a00",
        "gradient": "1",
        "color": [{
          "maxvalue": "56580000",
          "displayvalue": "Average",
          "code": "#f8bd19"
        }, {
          "maxvalue": "97400000",
          "code": "#6baa01"
        }]
      }
    }
   
    
  }).render();	
		  
		  		  
var salesMap = new FusionCharts({
    type: 'maps/thailand',
    renderAt: 'map-chart-container1',
    width: '600',
    height: '400',
    dataFormat: 'json',
    dataSource: {
      "chart": {
        "caption": "Annual Sales by State",
        "subcaption": "Last year",
        "entityFillHoverColor": "#cccccc",
        "numberPrefix": "$",
        "showLabels": "1",
        "theme": "gammel"
      },
      "colorrange": {
        "minvalue": "920000",
        "startlabel": "Low",
        "endlabel": "High",
        "code": "#e44a00",
        "gradient": "1",
        "color": [{
          "maxvalue": "56580000",
          "displayvalue": "Average",
          "code": "#f8bd19"
        }, {
          "maxvalue": "97400000",
          "code": "#6baa01"
        }]
      }
    }
   
    
  }).render();	
 
      });
    </script>		
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php include "nav_bar.php" ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "menu.php" ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blank Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">ข้อมูลแพทย์</h3>
				</div>

				<div class="card-body">
					<canvas id="myChart3"></canvas>
					<script>
					  const ctx3 = document.getElementById('myChart3');

					  new Chart(ctx3, {
						type: 'bar',
						data: {
						  labels: ['จิตแพทย์ผู้ใหญ่', 'จิตแพทย์เด็กและวัยรุ่น'],
						  datasets: [{
							label: '# of Votes',
							data: [(12,3), (19,4)],
							backgroundColor: [
							  '#ff7043',
							  '#26a69a'
							],
							borderColor: [
							  '#ff7043',
							  '#26a69a'
							],  
							borderWidth: 2
						  }]
						},
						options: {
						  scales: {
							y: {
							  beginAtZero: true
							}
						  }
						}
					  });
					</script>
					
				</div>

			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">ข้อมูลแพทย์กำลังศึกษา</h3>
				</div>

				<div class="card-body">
					<canvas id="myChart4"></canvas>
					<script>
					  const ctx4 = document.getElementById('myChart4');

					  new Chart(ctx4, {
						type: 'bar',
						data: {
						  labels: ['จิตเวชศาสตร์/จิตแพทย์ผู้ใหญ่', 'จิตแพทย์เด็กและวัยรุ่น'],
						  datasets: [{
							label: '# of Votes',
							data: [(12,3), (19,4)],
							backgroundColor: [
							  '#A8D1E7',
							  '#FCEE9E'
							],
							borderColor: [
							  '#A8D1E7',
							  '#FCEE9E'
							],  
							borderWidth: 2
						  }]
						},
						options: {
						  scales: {
							y: {
							  beginAtZero: true
							}
						  }
						}
					  });
					</script>
				</div>

			</div>
		</div>
	  </div>
      <!-- /.card -->
	  
	  <!-- Default box -->
      <div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">ข้อมูลพยาบาลและการอบรมเฉพาะทาง</h3>
				</div>

				<div class="card-body">
					<canvas id="myChart5"></canvas>
					<script>
					  const ctx5 = document.getElementById('myChart5');

					  new Chart(ctx5, {
						type: 'bar',
						data: {
						  labels: ['ปริญาโทจิตเวช', 'จิตเวชผู้ใหญ่', 'เด็กและวัยรุ่น', 'ผู้ใช้ยาและสารเสพติด'],
						  datasets: [{
							label: '# of Votes',
							data: [12, 9, 5, 6],
							backgroundColor: [
							  'rgba(255, 99, 132, 0.2)',
							  'rgba(255, 159, 64, 0.2)',
							  'rgba(255, 205, 86, 0.2)',
							  'rgba(75, 192, 192, 0.2)',
							  'rgba(54, 162, 235, 0.2)',
							  'rgba(153, 102, 255, 0.2)',
							  'rgba(201, 203, 207, 0.2)'
							],
							borderColor: [
							  'rgb(255, 99, 132)',
							  'rgb(255, 159, 64)',
							  'rgb(255, 205, 86)',
							  'rgb(75, 192, 192)',
							  'rgb(54, 162, 235)',
							  'rgb(153, 102, 255)',
							  'rgb(201, 203, 207)'
							],  
							borderWidth: 2
						  }]
						},
						options: {
						  scales: {
							y: {
							  beginAtZero: true
							}
						  }
						}
					  });
					</script>
					
				</div>

			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">พยาบาลกำลังศึกษา</h3>
				</div>

				<div class="card-body">
					<canvas id="myChart6"></canvas>
					<script>
					  const ctx6 = document.getElementById('myChart6');

					  new Chart(ctx6, {
						type: 'bar',
						data: {
						  labels: ['ปริญาโทจิตเวช', 'จิตเวชผู้ใหญ่', 'เด็กและวัยรุ่น', 'ผู้ใช้ยาและสารเสพติด'],
						  datasets: [{
							label: '# of Votes',
							data: [12, 9, 5, 6],
							backgroundColor: [
							  'rgba(255, 99, 132, 0.2)',
							  'rgba(255, 159, 64, 0.2)',
							  'rgba(255, 205, 86, 0.2)',
							  'rgba(75, 192, 192, 0.2)',
							  'rgba(54, 162, 235, 0.2)',
							  'rgba(153, 102, 255, 0.2)',
							  'rgba(201, 203, 207, 0.2)'
							],
							borderColor: [
							  'rgb(255, 99, 132)',
							  'rgb(255, 159, 64)',
							  'rgb(255, 205, 86)',
							  'rgb(75, 192, 192)',
							  'rgb(54, 162, 235)',
							  'rgb(153, 102, 255)',
							  'rgb(201, 203, 207)'
							],  
							borderWidth: 2
						  }]
						},
						options: {
						  scales: {
							y: {
							  beginAtZero: true
							}
						  }
						}
					  });
					</script>
				</div>

			</div>
		</div>
	  </div>
      <!-- /.card -->
		
	  <!-- Default box -->
      <div class="row">
		<div class="col-md-3">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"> เภสัชกร</h3>
				</div>

				<div class="card-body">
					<canvas id="myChart"></canvas>
					<script>
					  const ctx = document.getElementById('myChart');

					  new Chart(ctx, {
						type: 'doughnut',
						data: {
						  labels: ['การบริบาลเภสัชกรรมเฉพาะทางด้านจิตเวช', 'หลักสูตรระยะสั้นการใช้ยาจิตเวช', 'ยังไม่ได้ผ่านการอบรมเกี่ยวกับการใช้ยาจิตเวช'],
						  datasets: [{
							label: '# of Votes',
							data: [<?php echo "12, 9, 2" ;?>],
							borderWidth: 1
						  }]
						},
						options: {
						  scales: {
							y: {
							  beginAtZero: true
							}
						  }
						}
					  });
					</script>
				</div>

			</div>
			
		</div>
		<div class="col-md-3">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">นักกิจกรรมบำบัด</h3>
				</div>

				<div class="card-body">
					<canvas id="myChart9" ></canvas>
					<script>
					  const ctx9 = document.getElementById('myChart9');

					  new Chart(ctx9, {
						type: 'doughnut',
						data: {
						  labels: ['ปฏิบัติงานสุขภาพจิต', 'ไม่ได้ปฏิบัติงานสุขภาพจิต'],
						  datasets: [{
							label: '# of Votes',
							data: [<?php echo "18, 9" ;?>],
							borderWidth: 1
						  }]
						},
						options: {
						  scales: {
							y: {
							  beginAtZero: true
							}
						  }
						}
					  });
					</script>
				</div>

			</div>
		</div>
		<div class="col-md-3">  
			<div class="col-md-12">
				<div class="info-box bg-warning">
				  <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

				  <div class="info-box-content">
					<span class="info-box-text">Bookmarks</span>
					<span class="info-box-number">41,410</span>

					<div class="progress">
					  <div class="progress-bar" style="width: 70%"></div>
					</div>
					<span class="progress-description">
					  70% Increase in 30 Days
					</span>
				  </div>
				  <!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
          	 </div>
			<div class="col-md-12">
				<div class="info-box bg-info">
				  <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

				  <div class="info-box-content">
					<span class="info-box-text">Bookmarks</span>
					<span class="info-box-number">41,410</span>

					<div class="progress">
					  <div class="progress-bar" style="width: 70%"></div>
					</div>
					<span class="progress-description">
					  70% Increase in 30 Days
					</span>
				  </div>
				  <!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
          	 </div>
		  </div>	
		  <div class="col-md-3">  
			  <!-- /.col -->
          <div class="col-md-12">
            <div class="info-box bg-danger">
              <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <span class="info-box-number">41,410</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  70% Increase in 30 Days
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col --> 
          <div class="col-md-12">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <span class="info-box-number">41,410</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  70% Increase in 30 Days
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col --> 
		  </div>	
         
		  
	  </div>
	 <!-- /.card -->
	 <div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">นักกิจกรรมบำบัด</h3>
				</div>

				<div class="card-body">
					<div class="chart">
					   <div class="chartCont border-right" id="map-chart-container">
						FusionCharts will load here.
					  </div>
					</div>
		
				</div>

			</div>
		</div>
	  </div>
      <!-- /.card -->		
      <!-- /.card -->
	 <div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">นักกิจกรรมบำบัด</h3>
				</div>

				<div class="card-body">
					 <div class="chartCont border-right" id="map-chart-container1">
						FusionCharts will load here.
					  </div>
		
				</div>

			</div>
		</div>
	  </div>
      <!-- /.card -->	

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php include "footer.php" ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
