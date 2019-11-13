<?php
switch ($_SERVER["SCRIPT_NAME"]) {
    case "/403.php":
        $CURRENT_PAGE = "403 Forbidden";
        $PAGE_TITLE = "403 Forbidden";
        break;
    case "/404.php":
        $CURRENT_PAGE = "404 Forbidden";
        $PAGE_TITLE = "404 Forbidden";
        break;
    case "/503.php":
        $CURRENT_PAGE = "503 Forbidden";
        $PAGE_TITLE = "503 Forbidden";
        break;
    case "/add-customer.php":
        $CURRENT_PAGE = "Add Customer";
        $PAGE_TITLE = "Add Customer";
        break;
    case "/add-supplier.php":
        $CURRENT_PAGE = "Add Supplier";
        $PAGE_TITLE = "Add Supplier";
        break;
    case "/exchange-order.php":
        $CURRENT_PAGE = "Exchange Order";
        $PAGE_TITLE = "Exchange Order";
        break;
    case "/invoice.php":
        $CURRENT_PAGE = "Invoice";
        $PAGE_TITLE = "Invoice";
        break;
    case "/login.php":
        $CURRENT_PAGE = "Login";
        $PAGE_TITLE = "Login";
        break;
    case "/pdf_accounts_copy.php":
        $CURRENT_PAGE = "Accounts Copy";
        $PAGE_TITLE = "Accounts Copy";
        break;
    case "/pdf_invoice.php":
        $CURRENT_PAGE = "Invoice";
        $PAGE_TITLE = "Invoice";
        break;
    case "/pdf_receipt.php":
        $CURRENT_PAGE = "Receipt";
        $PAGE_TITLE = "Receipt";
        break;
    case "/pdf_supplier_copy.php":
        $CURRENT_PAGE = "Supplier Copy";
        $PAGE_TITLE = "Supplier Copy";
        break;
    case "/receipt.php":
        $CURRENT_PAGE = "Receipt";
        $PAGE_TITLE = "Receipt";
        break;
    case "/search-customer.php":
        $CURRENT_PAGE = "Search Customer";
        $PAGE_TITLE = "Search Customer";
        break;
    case "/search-ex-order.php":
        $CURRENT_PAGE = "Search Ex-Order";
        $PAGE_TITLE = "Search Ex-Order";
        break;
    case "/search-supplier.php":
        $CURRENT_PAGE = "Search Supplier";
        $PAGE_TITLE = "Search Supplier";
        break;
    case "/users-control.php":
        $CURRENT_PAGE = "Users Control";
        $PAGE_TITLE = "Users Control";
        break;
    case "/payment-voucher.php":
        $CURRENT_PAGE = "Payment Voucher";
        $PAGE_TITLE = "Payment Voucher";
        break;
    default:
        $CURRENT_PAGE = "Dashboard";
        $PAGE_TITLE = "Dashboard";
}
