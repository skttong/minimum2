<?php
include('connect/conn.php');
$sql = "SELECT T1.r1,
			(SELECT count( personnelID ) AS CDOC FROM personnel WHERE personnel.r1 = T1.r1 ) AS TR1
		FROM
			personnel AS T1
		WHERE
			T1.positiontypeID = 1
		GROUP BY
			T1.r1";
$obj = mysqli_query($con, $sql);

?>

<html>
<head>
	<title>My first chart using FusionCharts Suite XT</title>
	<script type="text/javascript"  src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
 	<script  type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.gammel.js"></script>
	<script type="text/javascript">
	FusionCharts.ready(function(){
		var chartObj = new FusionCharts({
		type: 'column2d',
		renderAt: 'chart-container',
		width: '680',
		height: '390',
		dataFormat: 'json',
		dataSource: {
				chart: {
					caption: "Monthly revenue for last year",
					subCaption: "Harry's SuperMart",
					xAxisName: "วิชาชีพเฉพาะ",
					yAxisName: "จำนวน (คน)",
					numberPrefix: "",
					showvalues: "1",
					theme: "gammel"
				},
				data: [ 
					<?php while($row = mysqli_fetch_array($obj)){?>
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
			type: 'doughnut2d',
			renderAt: 'chart-container2',
			width: '550',
			height: '450',
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
						"theme": "gammel"
					},
					"data": [{
						"label": "Food",
						"value": "28504"
					}, {
						"label": "Apparels",
						"value": "14633"
					}, {
						"label": "Electronics",
						"value": "10507"
					}, {
						"label": "Household",
						"value": "4910"
					}]
				}
			}
			);
			chartObj.render();
		});
	</script>
	</head>
	<body>
		<div id="chart-container">FusionCharts XT will load here!</div>
		<div id="chart-container2">FusionCharts XT will load here!</div>
	</body>
</html>