<div class="main-menu">
  <div class="menu-inner">
    <nav>
      <ul class="metismenu" id="menu">
        <li class="<?php if ($CURRENT_PAGE == "Dashboard") { ?>active<?php } ?>">
          <a href="/" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
        </li>
        <li>
          <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Purchase</span></a>
          <ul class="collapse">
            <li class="<?php if ($CURRENT_PAGE == "Exchange Order") { ?>active<?php } ?>"><a href="exchange-order">Exchange Order</a></li>
            <li class="<?php if ($CURRENT_PAGE == "Search Ex-Order") { ?>active<?php } ?>"><a href="search-ex-order">Search</a></li>
            <!-- <li><a href="#">Logs</a></li> -->
            <li class="<?php if ($CURRENT_PAGE == "Invoice") { ?>active<?php } ?>"><a href="invoice">Invoice</a></li>
            <li class="<?php if ($CURRENT_PAGE == "Receipt") { ?>active<?php } ?>"><a href="receipt">Receipt</a></li>
            <li class="<?php if ($CURRENT_PAGE == "Payment Voucher") { ?>active<?php } ?>"><a href="payment-voucher">Payment Voucher</a></li>
          </ul>
        </li>
        <?php
        if ($_SESSION['user_role_id'] == 1) {
          ?>
          <li>
            <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-certificate"></i><span>Supplier</span></a>
            <ul class="collapse">
              <li class="<?php if ($CURRENT_PAGE == "Add Supplier") { ?>active<?php } ?>"><a href="add-supplier">Add Supplier</a></li>
              <li class="<?php if ($CURRENT_PAGE == "Search Supplier") { ?>active<?php } ?>"><a href="search-supplier">Search</a></li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-users"></i><span>Customer</span></a>
            <ul class="collapse">
              <li class="<?php if ($CURRENT_PAGE == "Add Customer") { ?>active<?php } ?>"><a href="add-customer">Add Customer</a></li>
              <li class="<?php if ($CURRENT_PAGE == "Search Customer") { ?>active<?php } ?>"><a href="search-customer">Search</a></li>
            </ul>
          </li>
          <div style="margin:1rem;"></div>
          <div style="border:.5px dashed #aaa; opacity:.3; margin:0 1rem;"></div>
          <div style="margin:1rem;"></div>
          <li>
            <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>User Account</span></a>
            <ul class="collapse">
              <li class="<?php if ($CURRENT_PAGE == "Users Control") { ?>active<?php } ?>"><a href="users-control">Users Control</a></li>
            </ul>
          </li>
        <?php
        }
        ?>
      </ul>
    </nav>
  </div>
</div>