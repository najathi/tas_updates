<?php
if (!isset($_SESSION)) {
  session_start();
}

include_once 'includes/authenticate.inc.php';
include_once 'includes/ses_record_set.inc.php';
include_once 'includes/select-cus-id.inc.php';
include_once 'includes/select-supp-id.inc.php';
include_once 'includes/ex-id-count-inc.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Ex Order</title>
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/themify-icons.css">

  <!-- Custom CSS Style  -->
  <link rel="stylesheet" href="assets/css/custom.css">

  <!-- Tax-calc -->
  <!-- <script src="assets/js/calc/tax-calc.js"></script> -->
  <script src="assets/js/calc/acc-calc-array.js"></script>


  <!-- View the Data -->
  <script src="assets/js/view_data/view-info.js"></script>

</head>

<body>

  <form action="includes/exchange-order.inc.php" method="post">
    <label for="example-date-input" class="col-form-label">XO No.</label>
    <input class="form-control" name="ex_id" id="ex_id" type="text" readonly="readonly" value="<?php printf("%06d", $countExId); ?>">
    <br />

    <label for="example-date-input" class="col-form-label">XO Date</label>
    <input name="xo_date" id="xo_date" class="form-control" type="date" required>
    <br />

    <label class="col-form-label">Customer</label>
    <select name="customer" id="customer" class="custom-select">
      <option value="000001" selected="selected">Direct Customer selected</option>
      <?php while ($rowSelectCus = mysqli_fetch_assoc($resultSelectCus)) :; ?>
        <option value="<?php echo $rowSelectCus['cus_ac_code']; ?>"><?php echo $rowSelectCus['cus_ac_code'] . ' - ' . $rowSelectCus['c_name']; ?></option>
      <?php endwhile; ?>
    </select>
    <br />

    <label for="example-text-input" class="col-form-label">Counter Staff</label>
    <input name="counter_staff" class="form-control" value="<?php echo $row['Lastname']; ?>" type="text" id="counter_staff" readonly="readonly">
    <br />

    <label for="validationCustom04">Booking Reference</label>
    <input name="booking_ref" id="booking_ref" type="text" class="form-control" required>
    <br />

    </div <label class="col-form-label">Supplier</label>
    <select name="supplier" id="supplier" class="custom-select" required>
      <option value="">Please Select the Supplier</option>
      <?php while ($rowSelectSupp = mysqli_fetch_assoc($resultSelectSupp)) :; ?>
        <option value="<?php echo $rowSelectSupp['supp_id']; ?>"><?php echo $rowSelectSupp['supp_id'] . ' - ' . $rowSelectSupp['supp_name']; ?></option>
      <?php endwhile; ?>
    </select>
    <br />
    <br />

    <div id="main_div" class="main_sec_div">
      <button style="margin:1rem 1rem 0 0;" type="button" name="add" id="add" class="btn btn-success btn-sm add"><i class="fas fa-plus"></i></button>
      <br />
      <br />

      <label for="example-text-input" class="col-form-label">Passenger Name</label>
      <input name="p_name[]" class="form-control" type="text" id="p_name" required>
      <br />

      <label for="validationCustom03">Ticket No.</label>
      <input name="ticket_no[]" type="text" class="form-control" id="ticket_no" required>
      <br />

      <label for="example-date-input" class="col-form-label">Ticket Date</label>
      <input name="ticket_date[]" class="form-control" type="date" id="ticket_date" required>
      <br /><br />
      <!-- End Ticket Infromation -->

      <!-- Fare Section start -->
      <label for="validationCustom03">Basic (0.00)</label>
      <input name="basicc[]" type="number" step=".01" class="form-control form-control-sm" id="basicc0" onkeyup="calc()" required>
      <br />

      <label for="validationCustom04">yq (0.00)</label>
      <input name="yq[]" type="number" step=".01" class="form-control form-control-sm" id="yq0" onkeyup="calc()" required>
      <br />

      <label for="validationCustom03">yr (0.00)</label>
      <input name="yr[]" type="number" step=".01" class="form-control form-control-sm" id="yr0" onkeyup="calc()" required>
      <br />

      <label for="validationCustom04">Tax-3 (0.00)</label>
      <input name="tax_3[]" type="number" step=".01" class="form-control form-control-sm" id="tax_30" onkeyup="calc()" required>
      <br />

      <label for="validationCustom03">Tax-4 (0.00)</label>
      <input name="tax_4[]" type="number" step=".01" class="form-control form-control-sm" id="tax_40" onkeyup="calc()" required>
      <br />

      <label for="validationCustom04">Total Tax (0.00)</label>
      <input style="background:#ccc;" name="total_tax[]" type="number" step=".01" class="form-control form-control-sm" id="total_tax0" value="0.00" required>
      <br />

      <label for="validationCustom03">Supplier Charge (0.00)</label>
      <input name="supp_charge[]" type="number" step=".01" class="form-control form-control-sm" id="supp_charge0" onkeyup="calc()" required>
      <br />

      <label for="validationCustom03">Service Amount (0.00)</label>
      <input name="service_amt[]" type="number" step=".01" class="form-control form-control-sm" id="service_amt0" onkeyup="calc()" required>
      <br />

      <label for="example-text-input" class="col-form-label">Net Profit (0.00)</label>
      <input style="background:#ccc;" name="net_profit[]" class="form-control form-control-sm" type="number" step=".01" id="net_profit0" value="0.00" required>
      <br />

      <label for="validationCustom03">Net Due (0.00)</label>
      <input style="background:#ccc;" name="net_due[]" type="number" step=".01" class="form-control form-control-sm" id="net_due0" value="0.00" required>
      <br />

      <label for="validationCustom04">Net to Supplier (0.00)</label>
      <input style="background:#ccc;" name="net_to_supplier[]" type="number" step=".01" class="form-control form-control-sm" id="net_to_supplier0" value="0.00" required>
      <br /><br />

      <span class="input-group-text">From&nbsp;&nbsp; <i class="fa fa-arrow-right"></i> &nbsp;&nbsp;To</span>
      <textarea name="from_to[]" class="form-control" aria-label="With textarea" id="from_to" required></textarea>
      <br />

      <label for="validationCustom03">Class Code</label>
      <input name="class_code[]" type="text" class="form-control" id="class_code" required>
      <br />

      <label for="validationCustom04">Airline Code</label>
      <input name="airline_code[]" type="text" class="form-control" id="airline_code" required>
      <br />

      <label for="validationCustom03">Flight No.</label>
      <input name="flight_no[]" type="text" class="form-control" id="flight_no" required>
      <br />

      <label for="validationCustom04">Departure Date</label>
      <input name="depart_date[]" class="form-control" type="date" id="depart_date" required>
      <br />
      <br />
    </div>

    <button type="submit" name="submitOrder" id="submitOrder" class="btn btn-primary mt-4 pr-4 pl-4">Save</button>
    <span style="margin-right:2rem;"></span>
    <button type="reset" class="btn btn-secondary mt-4 pr-4 pl-4" onclick="resetUrl()">Reset</button>

  </form>

  <!-- jquery latest version -->
  <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
  <!-- bootstrap 4 js -->
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  <script src="assets/js/metisMenu.min.js"></script>
  <script src="assets/js/jquery.slimscroll.min.js"></script>
  <script src="assets/js/jquery.slicknav.min.js"></script>

  <!-- others plugins -->
  <script src="assets/js/plugins.js"></script>
  <script src="assets/js/scripts.js"></script>

  <script>
    $(document).ready(function() {

      var i = 0;

      // add button
      $(document).on('click', '#add', function() {
        i++;
        console.log('Add', i);
        html = `<div id="sub_div${i}" class="second-div">
        
        <button style="margin:1rem 1rem 0 0;" type="button" name="remove" id="${i}" class="btn btn-danger btn-sm remove"><i class="fa fa-close"></i></button>
          
        <br />
        <br />

        <label for="example-text-input" class="col-form-label">Passenger Name</label>
        <input name="p_name[]" class="form-control" type="text" id="p_name" required>
        <br />

        <label for="validationCustom03">Ticket No.</label>
        <input name="ticket_no[]" type="text" class="form-control" id="ticket_no" required>
        <br />

        <label for="example-date-input" class="col-form-label">Ticket Date</label>
        <input name="ticket_date[]" class="form-control" type="date" id="ticket_date" required>
        <br /><br />
        <!-- End Ticket Infromation -->

        <!-- Fare Section start -->
        <label for="validationCustom03">Basic (0.00)</label>
        <input name="basicc[]" type="number" step=".01" class="form-control form-control-sm" id="basicc${i}" onkeyup="calc()" required>
        <br />

        <label for="validationCustom04">yq (0.00)</label>
        <input name="yq[]" type="number" step=".01" class="form-control form-control-sm" id="yq${i}" onkeyup="calc()" required>
        <br />

        <label for="validationCustom03">yr (0.00)</label>
        <input name="yr[]" type="number" step=".01" class="form-control form-control-sm" id="yr${i}" onkeyup="calc()" required>
        <br />

        <label for="validationCustom04">Tax-3 (0.00)</label>
        <input name="tax_3[]" type="number" step=".01" class="form-control form-control-sm" id="tax_3${i}" onkeyup="calc()" required>
        <br />

        <label for="validationCustom03">Tax-4 (0.00)</label>
        <input name="tax_4[]" type="number" step=".01" class="form-control form-control-sm" id="tax_4${i}" onkeyup="calc()" required>
        <br />

        <label for="validationCustom04">Total Tax (0.00)</label>
        <input style="background:#ccc;" name="total_tax[]" type="number" step=".01" class="form-control form-control-sm" id="total_tax${i}" value="0.00" required>
        <br />

        <label for="validationCustom03">Supplier Charge (0.00)</label>
        <input name="supp_charge[]" type="number" step=".01" class="form-control form-control-sm" id="supp_charge${i}" onkeyup="calc()" required>
        <br />

        <label for="validationCustom03">Service Amount (0.00)</label>
        <input name="service_amt[]" type="number" step=".01" class="form-control form-control-sm" id="service_amt${i}" onkeyup="calc()" required>
        <br />

        <label for="example-text-input" class="col-form-label">Net Profit (0.00)</label>
        <input style="background:#ccc;" name="net_profit[]" class="form-control form-control-sm" type="number" step=".01" id="net_profit${i}" value="0.00" required>
        <br />

        <label for="validationCustom03">Net Due (0.00)</label>
        <input style="background:#ccc;" name="net_due[]" type="number" step=".01" class="form-control form-control-sm" id="net_due${i}" value="0.00" required>
        <br />

        <label for="validationCustom04">Net to Supplier (0.00)</label>
        <input style="background:#ccc;" name="net_to_supplier[]" type="number" step=".01" class="form-control form-control-sm" id="net_to_supplier${i}" value="0.00" required>
        <br /><br />

        <span class="input-group-text">From&nbsp;&nbsp; <i class="fa fa-arrow-right"></i> &nbsp;&nbsp;To</span>
        <textarea name="from_to[]" class="form-control" aria-label="With textarea" id="from_to" required></textarea>
        <br />

        <label for="validationCustom03">Class Code</label>
        <input name="class_code[]" type="text" class="form-control" id="class_code" required>
        <br />

        <label for="validationCustom04">Airline Code</label>
        <input name="airline_code[]" type="text" class="form-control" id="airline_code" required>
        <br />

        <label for="validationCustom03">Flight No.</label>
        <input name="flight_no[]" type="text" class="form-control" id="flight_no" required>
        <br />

        <label for="validationCustom04">Departure Date</label>
        <input name="depart_date[]" class="form-control" type="date" id="depart_date" required>
        <br />
        <br />
      </div>`;

        $('#main_div').append(html);
      });

      // remove button
      $(document).on('click', '.remove', function(e) {
        var remove_btn_id = $(this).attr('id');
        $('#sub_div' + remove_btn_id).remove();
        i--;
        console.log('Remove', i);
      });

    });
  </script>

</body>

</html>