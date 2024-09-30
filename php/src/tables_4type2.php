
  <table id="example2" class="table table-bordered table-striped">
	  <thead>
	   <tr align="center">
		  <th rowspan="3">#</th> 
		  <th rowspan="3">เขตสุขภาพ</th>
		  <th rowspan="3">จังหวัด</th>
		  <th rowspan="2" colspan="2" style="vertical-align: middle">ปริญญาโทจิตเวช</th> 
		  <th colspan="6">การอบรมเฉพาะทาง:การพยาบาลเฉพาะทาง</th>   
		</tr>
		<tr align="center"> 
		  <th colspan="2">จิตเวชผู้ใหญ่</th>
		  <th colspan="2">จิตเวชเด็กและวัยรุ่น</th>
		  <th colspan="2">ยาและสารเสพติด</th>
		</tr>
		 <tr align="center">
		  <th>ที่มีอยู่ปัจจุบัน</th>
		  <th>กำลังศึกษา</th>
		  <th>ที่มีอยู่ปัจจุบัน</th>
		  <th>กำลังศึกษา</th>
		  <th>ที่มีอยู่ปัจจุบัน</th>
		  <th>กำลังศึกษา</th>
		  <th>ที่มีอยู่ปัจจุบัน</th>
		  <th>กำลังศึกษา</th>	 

	   </tr>  
	   </thead>
		<?PHP
			$sql2 = "  
					SELECT DISTINCT
					hosn.CODE_HMOO,
					hosn.CODE_PROVINCE,
					(
					  SELECT
							count( personnel.positiontypeID )
						FROM
							personnel
							INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
						WHERE
							 personnel.positiontypeID = '2'  
							AND personnel.congrat  LIKE 'ปริญญาโท%'

						) AS 'ปริญญาโท',
						(
					  SELECT
							count( personnel.positiontypeID )
						FROM
							personnel
							INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
						WHERE
							 personnel.positiontypeID = '2'  
							AND personnel.congrat  LIKE 'ปริญญาโท%'
							and personnel.training like '%จิตเวชผู้ใหญ่%'

						) AS 'การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)',
						 (
					  SELECT
							count( personnel.positiontypeID )
						FROM
							personnel
							INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
						WHERE
							 personnel.positiontypeID = '2'  
							AND personnel.congrat  LIKE 'ปริญญาโท%'
							and personnel.training like '%จิตเวชเด็กและวัยรุ่น%'

						) AS 'จิตเวชเด็กและวัยรุ่น',
						 (
					  SELECT
							count( personnel.positiontypeID )
						FROM
							personnel
							INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
						WHERE
							 personnel.positiontypeID = '2'  
							AND personnel.congrat  LIKE 'ปริญญาโท%'
							and personnel.training like '%ยาและสารเสพติด%'

						) AS 'ยาและสารเสพติด'

				FROM
					hospitalnew hosn 
				WHERE
					1  
				";
			if($SQL_H!=''){
				$sql2 =	$sql2.$SQL_H;
			}
			$sql2 =	$sql2." GROUP BY 
					  hosn.CODE_HMOO, hosn.CODE_PROVINCE;"; 
		?>	
		<tbody align="center">
		<?PHP
			$obj2 = mysqli_query($con, $sql2);
			$i = 1;
			while($row2 = mysqli_fetch_array($obj2))

			{   
		?>
		<tr>
			<td><?php echo $i++; ?></td>
			<td><?php echo $row2['CODE_HMOO'];?></td>	
			<td><?php echo $row2['CODE_PROVINCE'];?></td>
			<td><?php echo $row2['ปริญญาโท'];?></td>
			<td>-</td>
			<td><?php echo $row2['การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)'];?></td>	
			<td>-</td>
			<td><?php echo $row2['จิตเวชเด็กและวัยรุ่น'];?></td>
			<td>-</td>
			<td><?php echo $row2['ยาและสารเสพติด'];?></td>	
			<td>-</td>

		</tr>
		<?php } ?> 
	   </tbody>	
	   <tfoot align="center">
			<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
		</tfoot>		
	</table>
<script>
    $(function () {
    $("#example2").DataTable({
      "responsive": true, 
	  "lengthChange": false, 
	  "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "print"],
	  "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
		  
		   $( api.column( 0 ).footer() ).html('Total');
		  
		  
		  for(var i=3; i<=9;i++)
		  {
			   var monTotal = 0;
			  monTotal = api
                .column( i )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			  
			  $( api.column( i ).footer() ).html(monTotal);
			  
		  }

        },	
	  
    })
</script>