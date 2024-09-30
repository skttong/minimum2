<!DOCTYPE html>
<html>
<head>
  <title>Multiple Dropdown</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
  <select name="province" id="province">
    <option value="">เลือกจังหวัด</option>
    </select>
  <select name="amphure" id="amphure">
    <option value="">เลือกอำเภอ</option>
  </select>
  <select name="tambon" id="tambon">
    <option value="">เลือกตำบล</option>
  </select>
  <input type="text" name="zipcode" id="zipcode" readonly>

  <script>
    $(document).ready(function() {
      // เมื่อมีการเปลี่ยนแปลงจังหวัด
      $('#province').change(function() {
        var provinceId = $(this).val();
        $.ajax({
          url: 'get_amphures.php', // ไฟล์ PHP ที่จะประมวลผล
          data: { province_id: provinceId },
          success: function(data) {
            $('#amphure').html(data);
          }
        });
      });

      // เมื่อมีการเปลี่ยนแปลงอำเภอ
      // ... คล้ายกับการเปลี่ยนแปลงจังหวัด ...

      // เมื่อมีการเปลี่ยนแปลงตำบล
      // ... คล้ายกับการเปลี่ยนแปลงจังหวัด ...
    });
  </script>
</body>
</html>