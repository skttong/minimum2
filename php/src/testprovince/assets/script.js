$(function(){
    var provinceObject = $('#province');
    var amphureObject  = $('#amphure');
    var districtObject = $('#district');
	
	var hospital	= $('#hospital');
	
	// on change province
    provinceObject.on('change', function(){

    //$('#province').change(function() {    

        //alert("tong");

        var provinceId = $(this).val();

        var provincecode ;

        //alert(provinceId);
		
		hospital.html('<option value="">เลือกโรงพยาบาล</option>')
        amphureObject.html('<option value="">เลือกอำเภอ</option>');
        districtObject.html('<option value="">เลือกตำบล</option>');

        $.get('get_province.php?province_id=' + provinceId, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                provincecode = item.code ;
            });

            //alert(provincecode);

            $.get('get_hospital.php?hospital_id=' + provincecode, function(data){
                var result = JSON.parse(data);
                $.each(result, function(index, item){
                    hospital.append(
                        $('<option></option>').val(item.hospi_id).html(item.hospi_name)
                    );
                });
            });

        });

        

       

        
    });
	
    // on change province
    provinceObject.on('change', function(){
        var provinceId = $(this).val();

        amphureObject.html('<option value="">เลือกอำเภอ</option>');
        districtObject.html('<option value="">เลือกตำบล</option>');

        //alert(provinceId);

        $.get('get_amphure.php?province_id=' + provinceId, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                amphureObject.append(
                    $('<option></option>').val(item.code).html(item.name_th)
                );
            });
        });

        /*
        $.get('get_hospital.php?hospital_id=' + provinceId, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                hospital.append(
                    $('<option></option>').val(item.hospi_province).html(item.hospi_name)
                );
            });
        });
        */
        
    });

    // on change amphure
    amphureObject.on('change', function(){
        var amphureId = $(this).val();

        hospital.html('<option value="">เลือกโรงพยาบาล</option>')
        districtObject.html('<option value="">เลือกตำบล</option>');

        //alert(amphureId);
        
        $.get('get_district.php?amphure_id=' + amphureId, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                districtObject.append(
                    $('<option></option>').val(item.id).html(item.name_th)
                );
            });
            
        });
        
        $.get('get_hospital_amphure.php?amphure_id=' + amphureId, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                hospital.append(
                    $('<option></option>').val(item.hospi_id).html(item.hospi_name)
                );
            });
        });
        

    });

    // on change amphure
    districtObject.on('change', function(){
        var districtid = $(this).val();

        hospital.html('<option value="">เลือกโรงพยาบาล</option>')
        alert(districtid);

        $.get('get_hospital_amphure.php?district_id=' + districtid, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                hospital.append(
                    $('<option></option>').val(item.hospi_id).html(item.hospi_name)
                );
            });
        });
        
      

    });
});
