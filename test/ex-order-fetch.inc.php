<?php
include('DbConfig.php');

class ExRecord extends DbConfig
{
    protected $hostName;
    protected $userName;
    protected $password;
    protected $dbName;
    private $recordsTable = 'exchange_order';
    private $dbConnect = false;
    public function __construct()
    {
        if (!$this->dbConnect) {
            $database = new DbConfig();
            $this -> hostName = $database ->serverName;
            $this -> userName = $database ->userName;
            $this -> password = $database ->password;
            $this -> dbName = $database -> dbName;
            $conn = new mysqli($this->hostName, $this->userName, $this->password, $this->dbName);
            if ($conn->connect_error) {
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            } else {
                $this->dbConnect = $conn;
            }
        }
    }

    public function listRecords()
    {
        $query = '';
        $output = array();
        $query .= "SELECT * FROM exchange_order ";
        if (isset($_POST["search"]["value"])) {
            $query .= 'WHERE booking_ref LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR xo_date LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR customer LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR pass_name LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR ticket_no LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR ticket_date LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR supplier LIKE "%'.$_POST["search"]["value"].'%" ';
        }
        if (isset($_POST["order"])) {
            $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $query .= 'ORDER BY booking_ref ASC ';
        }
        if ($_POST["length"] != -1) {
            $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = mysqli_query($this->dbConnect, $query);
        $numRows = mysqli_num_rows($result);
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $sub_array = array();
            $sub_array[] = $row["booking_ref"];
            $sub_array[] = $row["xo_date"];
            $sub_array[] = $row["customer"];
            $sub_array[] = $row["pass_name"];
            $sub_array[] = $row["ticket_no"];
            $sub_array[] = $row["ticket_date"];
            $sub_array[] = $row["supplier"];
            $sub_array[] = '<a style="cursor: pointer;" class="text-secondary viewBtn" id="'.$row['booking_ref'].'" data-toggle="modal tooltip" data-target=".viewOrder" data-whatever="'.$row['booking_ref'].'" data-placement="top" title="View"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp;
            <a style="cursor: pointer;" class="text-secondary editBtn" id="'.$row['booking_ref'].'" data-toggle="modal tooltip" data-target=".editOrder" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp;
            <a class="text-danger delete" id="'.$row['booking_ref'].'" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ti-trash"></i></a>';
        
            $sub_array[] = '<a href="s_com_pdf?booking_ref='.$row['booking_ref'].'" target="_blank" class="com_pfd" style="cursor: pointer;" data-toggle="tooltip" id="'.$row['booking_ref'].'" data-placement="top" title="Company Copy"><span style="color:red;"><i class="fa fa-print"></i></span></a>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <a href="s_supp_pdf?booking_ref='.$row['booking_ref'].'" target="_blank" class="supp_pfd" style="cursor: pointer;" data-toggle="tooltip" id="'.$row['booking_ref'].'" data-placement="top" title="Supplier Copy"><i class="fa fa-print"></i></a>';
            $data[] = $sub_array;
        }

        $resultExOrder = mysqli_query($this->dbConnect, "SELECT * FROM exchange_order");
        $numRowsExOrder = mysqli_num_rows($resultExOrder);

        $output = array(
          "draw"    => intval($_POST["draw"]),
          "recordsTotal"  =>  $numRows,
          "recordsFiltered" => $numRowsExOrder,
          "data"    => $data
        );
        echo json_encode($output);
    }

    public function getRecord()
    {
        if ($_POST["booking_ref"]) {
            $sqlQuery = "SELECT * FROM ".$this->recordsTable." 
				WHERE booking_ref = '".$_POST["booking_ref"]."'";
            $result = mysqli_query($this->dbConnect, $sqlQuery);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            echo json_encode($row);
        }
    }

    public function updateRecord()
    {
        if ($_POST['booking_ref']) {
            $xo_date = mysqli_real_escape_string($this->dbConnect, $_POST['xo_date']);
            $customer = mysqli_real_escape_string($this->dbConnect, $_POST['customer']);
            $counter_staff = mysqli_real_escape_string($this->dbConnect, $_POST['counter_staff']);

            $pass_name = mysqli_real_escape_string($this->dbConnect, $_POST['pass_name']);
            $ticket_no = mysqli_real_escape_string($this->dbConnect, $_POST['ticket_no']);
            $booking_ref = mysqli_real_escape_string($this->dbConnect, $_POST['booking_ref']);
            $ticket_date = mysqli_real_escape_string($this->dbConnect, $_POST['ticket_date']);
            $supplier = mysqli_real_escape_string($this->dbConnect, $_POST['supplier']);

            $basicc = mysqli_real_escape_string($this->dbConnect, $_POST['basicc']);
            $yq = mysqli_real_escape_string($this->dbConnect, $_POST['yq']);
            $yr = mysqli_real_escape_string($this->dbConnect, $_POST['yr']);
            $tax_3 = mysqli_real_escape_string($this->dbConnect, $_POST['tax_3']);
            $tax_4 = mysqli_real_escape_string($this->dbConnect, $_POST['tax_4']);
            $total_tax = mysqli_real_escape_string($this->dbConnect, $_POST['total_tax']);
            $supp_charge = mysqli_real_escape_string($this->dbConnect, $_POST['supp_charge']);
            $service_amt = mysqli_real_escape_string($this->dbConnect, $_POST['service_amt']);
            $net_profit = mysqli_real_escape_string($this->dbConnect, $_POST['net_profit']);
            $net_due = mysqli_real_escape_string($this->dbConnect, $_POST['net_due']);
            $net_to_supplier = mysqli_real_escape_string($this->dbConnect, $_POST['net_to_supplier']);

            $from_to = mysqli_real_escape_string($this->dbConnect, $_POST['from_to']);
            $class_code = mysqli_real_escape_string($this->dbConnect, $_POST['class_code']);
            $airline_code = mysqli_real_escape_string($this->dbConnect, $_POST['airline_code']);
            $flight_no = mysqli_real_escape_string($this->dbConnect, $_POST['flight_no']);
            $depart_date = mysqli_real_escape_string($this->dbConnect, $_POST['depart_date']);

            $updateQuery = "
            UPDATE exchange_order   
            SET xo_date='$xo_date',   
            customer='$customer',   
            counter_staff='$counter_staff',   
            pass_name = '$pass_name',   
            ticket_no = '$ticket_no',  
            ticket_date = '$ticket_date',  
            supplier = '$supplier',  
            basicc = '$basicc',  
            yq = '$yq',  
            yr = '$yr',  
            tax_3 = '$tax_3',  
            tax_4 = '$tax_4',  
            total_tax = '$total_tax',  
            supp_charge = '$supp_charge',  
            service_amt = '$service_amt',  
            net_profit = '$net_profit',  
            net_due = '$net_due',  
            net_to_supplier = '$net_to_supplier',  
            from_to = '$from_to',  
            class_code = '$class_code',  
            airline_code = '$airline_code',  
            flight_no = '$flight_no',  
            depart_date = '$depart_date'
            WHERE booking_ref= '$booking_ref'";

            mysqli_query($this->dbConnect, $updateQuery);
        }
    }
}
?>
   