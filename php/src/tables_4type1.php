<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr align="center">
        <th rowspan="2">#</th>  
        <th rowspan="2">เขตสุขภาพ</th>
        <th rowspan="2">จังหวัด</th>
        <th colspan="2">จิตแพทย์</th>
        <th colspan="2">จิตแพทย์เด็กและวัยรุ่น</th>
        <th colspan="2">แพทย์เวชสตร์ป้องกันแขนงสุขภาพจิตชุมชน(อว. กับ วว.)</th>
        <th rowspan="2" style="vertical-align: middle">แพทย์สาขาอื่นๆ</th>
    </tr>
        <tr align="center">
        <th>ที่มีอยู่ปัจจุบัน</th>
        <th>กำลังศึกษา</th>
        <th>ที่มีอยู่ปัจจุบัน</th>
        <th>กำลังศึกษา</th>
        <th>ที่มีอยู่ปัจจุบัน</th>
        <th>กำลังศึกษา</th>
    </tr>   
    </thead>
    <?PHP
        /*$sql1 = "SELECT DISTINCT 
                hosn.CODE_HMOO,hosn.CODE_PROVINCE,
                FLOOR(RAND()*(100-1+1)+1) AS 'จิตแพทย์ทั่วไป',
                FLOOR(RAND()*(100-1+1)+1) AS 'จิตแพทย์เด็กและวัยรุ่น',
                FLOOR(RAND()*(100-1+1)+1) AS 'แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. กับ วว.)',
                FLOOR(RAND()*(100-1+1)+1) AS 'แพทย์สาขาอื่น'
                FROM
                    hospitalnew hosn 
                WHERE 1 ";*/
        $sql1 = "SELECT DISTINCT
                        hosn.CODE_HMOO,
                        hosn.CODE_PROVINCE,
                        (SELECT
                                count( personnel.positiontypeID )
                            FROM
                                personnel
                                INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
                            WHERE
                                personnel.r1 = 'จิตแพทย์ทั่วไป' 
                                AND CODE_PROVINCE = hosn.CODE_PROVINCE
                            ) AS 'จิตแพทย์ทั่วไป',
                        (SELECT
                                COUNT(personnel.training)
                            FROM
                                personnel
                                INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
                            WHERE
                                personnel.training = 'จิตเวชศาสตร์/จิตแพทย์ทั่วไป'
                                AND CODE_PROVINCE = hosn.CODE_PROVINCE
                            ) AS 'training1',
                        (SELECT
                                count( personnel.positiontypeID )
                            FROM
                                personnel
                                INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
                            WHERE
                                personnel.r1 = 'จิตแพทย์เด็กและวัยรุ่น' 
                                AND CODE_PROVINCE = hosn.CODE_PROVINCE
                            ) AS 'จิตแพทย์เด็กและวัยรุ่น',
                        (SELECT
                                COUNT(personnel.training)
                            FROM
                                personnel
                                INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
                            WHERE
                                personnel.training = 'จิตแพทย์เด็กและวัยรุ่น'
                                AND CODE_PROVINCE = hosn.CODE_PROVINCE
                            ) AS 'training2',
                        ( SELECT
                                count( personnel.positiontypeID )
                            FROM
                                personnel
                                INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
                            WHERE
                                personnel.r1 = 'แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)' 
                                AND CODE_PROVINCE = hosn.CODE_PROVINCE
                            ) AS 'แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. กับ วว.)',
                        (SELECT
                                COUNT(personnel.training)
                            FROM
                                personnel
                                INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
                            WHERE
                                personnel.training = 'แพทย์เวชศาสตร์ป้องกันแขนงสุขภาพจิตชุมชน (อว. หรือ วว.)'
                                AND CODE_PROVINCE = hosn.CODE_PROVINCE
                            ) AS 'training3',
                        (SELECT
                                count( personnel.positiontypeID )
                            FROM
                                personnel
                                INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
                            WHERE
                                personnel.r1 = 'แพทย์สาขาอื่น ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น' 
                                AND CODE_PROVINCE = hosn.CODE_PROVINCE
                            ) AS 'แพทย์สาขาอื่น' 
                    FROM
                        hospitalnew hosn 
                    WHERE
                        1";
        if(isset($SQL_H)){
            $sql1 =	$sql1.$SQL_H;
        }
        $sql1 =	$sql1." GROUP BY 
                    hosn.CODE_HMOO, hosn.CODE_PROVINCE;"; 

        //echo $sql1 ;
    ?>	
    <tbody align="center">
    <?PHP
        $obj1 = mysqli_query($con, $sql1);
        $i = 1;
        while($row1 = mysqli_fetch_array($obj1))

        {   
    ?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $row1['CODE_HMOO'];?></td>	
        <td align="left"><?php echo $row1['CODE_PROVINCE'];?></td>
        <td><?php echo $row1['จิตแพทย์ทั่วไป'];?></td>
        <td><?php echo $row1['training1'];?></td>
        <td><?php echo $row1['จิตแพทย์เด็กและวัยรุ่น'];?></td>	
        <td><?php echo $row1['training2'];?></td>
        <td><?php echo $row1['แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. กับ วว.)'];?></td>
        <td><?php echo $row1['training3'];?></td>
        <td><?php echo $row1['แพทย์สาขาอื่น'];?></td>	

    </tr>
    <?php } ?> 
    </tbody>	
    <tfoot align="center">
        <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
    </tfoot>	
</table>
<script>
    $(function () {
    $("#example1").DataTable({
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
	  
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>
