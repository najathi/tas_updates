<?php

if (isset($_POST['submit'])) {
  include_once '../includes/dbh.inc.php';

  $c_name = $_POST['c_name'];
  $c_tele_no = $_POST['c_tele_no'];
  $c_email = $_POST['c_email'];
  $c_address_one = $_POST['c_address_one'];
  $c_address_two = $_POST['c_address_two'];

  var_dump($_POST['c_name']);
  echo '<br/>';
  echo '<br/>';
  echo  count($_POST['c_name']);
  echo '<br/>';

  foreach ($c_name as $key => $value) {
    echo '<br/>';
    echo $c_name[$key];
  }
}
