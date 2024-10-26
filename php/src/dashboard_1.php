<?php include('connect/conn.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ระบบทรัพยากรสุขภาพจิตและจิตเวช</title>
	
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <!-- Control by jel -->
  <link rel="stylesheet" href="dist/css/fontcontrol.css">
	
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">	
	
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
<body class="hold-transition sidebar-mini layout-fixed bodychange">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <?php include "nav_bar.php" ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "menu.php" ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
		  <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6 connectedSortable">
		    <!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">แพทย์</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                    <!--<canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>-->
					<div id="chart-T1">FusionCharts XT will load here!</div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
		   </section>
			
		   <!-- right col (We are only adding the ID to make the widgets sortable)-->
           <section class="col-lg-6 connectedSortable">
			<!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">พยาบาล</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <div id="chart-T2">FusionCharts XT will load here!</div>
                </div>
              </div>
              <!-- /.card-body--> 
            </div>
            <!-- /.card -->
		   </section>
			
		</div><!-- /.row -->
		  
		  
		<!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-4 connectedSortable">
		    <!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">เภสัชกร</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  	<!--<canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>-->
					<div class="chartCont border-right" id="doughnut-chart-container1">FusionCharts will load here.</div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
		   </section>
			
		   <!-- right col (We are only adding the ID to make the widgets sortable)-->
           <section class="col-lg-4 connectedSortable">
			<!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">นักจิตวิทยา</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <div class="chartCont border-right" id="doughnut-chart-container2">FusionCharts will load here. </div>
                </div>
              </div>
              <!-- /.card-body--> 
            </div>
            <!-- /.card -->
		   </section>
			
			 <!-- Left col -->
          <section class="col-lg-4 connectedSortable">
		    <!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">นักสังคมสงเคราะห์</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  	 <!--<canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>-->
					 <div class="chartCont border-right" id="doughnut-chart-container3">FusionCharts will load here.</div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
		   </section>
			
		</div><!-- /.row -->
		  
		  
		   
		    <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-4 connectedSortable">
		    <!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">นักกิจกรรมบำบัด/นักเวชศาสตร์สื่อความหมาย/นักวิชาการศึกษาพิเศษ</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  	 <!--<canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>-->
					 <div class="chartCont border-right" id="doughnut-chart-container4">FusionCharts will load here.</div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
		   </section>
		<?php /*?>	
		   <!-- right col (We are only adding the ID to make the widgets sortable)-->
           <section class="col-lg-4 connectedSortable">
			<!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Stacked Bar Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <div class="chartCont border-right" id="doughnut-chart-container5">
            FusionCharts will load here.
          </div>
                </div>
              </div>
              <!-- /.card-body--> 
            </div>
            <!-- /.card -->
		   </section><?php */?>
			
		<?php /*?>	 <!-- Left col -->
          <section class="col-lg-4 connectedSortable">
		    <!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Stacked Bar Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <!--<canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>-->
					 <div class="chartCont border-right" id="doughnut-chart-container6">
            FusionCharts will load here.
          </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
		   </section><?php */?>
			
		</div><!-- /.row -->
		  
		  
		   <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6 connectedSortable">
		    <!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Stacked Bar Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <!--<canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>-->
					 <div class="chartCont border-right" id="map-chart-container">
            FusionCharts will load here.
          </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
		   </section>
			
		   <!-- right col (We are only adding the ID to make the widgets sortable)-->
           <section class="col-lg-6 connectedSortable">
			<!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Stacked Bar Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                 <div class="chartCont border-right" id="map-chart-container1">
            FusionCharts will load here.
          </div>
                </div>
              </div>
              <!-- /.card-body--> 
            </div>
            <!-- /.card -->
		   </section>
			
		</div><!-- /.row -->
		  
		  
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php  include "footer.php" ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
	
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>

</body>
</html>
