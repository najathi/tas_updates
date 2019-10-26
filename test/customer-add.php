<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add Customer</title>
  <!-- jquery latest version -->
  <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
</head>

<body>
  <form action="process-customer.inc.php" method="post">
    <div id="container">
      <input type="text" name="c_name[]" id="c_name" required>
      <input type="text" name="c_tele_no[]" id="c_tele_no">
      <input type="text" name="c_email[]" id="c_email">
      <input type="text" name="c_address_one[]" id="c_address_one">
      <input type="text" name="c_address_two[]" id="c_address_two">
      <input type="button" id="add" value="+">
    </div><br />
    <input type="submit" name="submit" value="Insert">
  </form>
</body>
<script>
  $(document).ready(function(e) {

    var i = 1;

    $('#add').click(function(e) {
      i++;
      var html = `<p/><div id="secDiv">
      <input type="text" name="c_name[]" id="c_name" required>
      <input type="text" name="c_tele_no[]" id="c_tele_no">
      <input type="text" name="c_email[]" id="c_email">
      <input type="text" name="c_address_one[]" id="c_address_one">
      <input type="text" name="c_address_two[]" id="c_address_two">
      <input type="button" id="remove" value="-">
      </div>`;
      $('#container').append(html);
    });

    $(document).on('click', '#remove', function(e) {
      var removeBtnId = $(this).attr('id');
      $('#secDiv').remove();
      i--;
    });


  });
</script>


</html>