<?php
@session_start();
include_once "../../config/connection.php";

class Sale extends connection {

    public function viewCreateSale(){
        include_once "../../views/Sale/view.CreateSale.php";
    }

    public function viewWatchSale(){
        extract($_POST);
        $sqlSale = $this->execute("SELECT * FROM sale WHERE Nit_Sale = $nit_sale");
        include_once "../../views/Sale/view.WatchSale.php";
    }

    public function viewEditSale(){
        extract($_POST);
        $sqlSale = $this->execute("SELECT * FROM provider WHERE Nit_Sale = $nit_provider");

        include_once "../../views/Sale/view.EditSale.php";
    }

    public function modalSearchSale(){
        include_once "../../views/Sale/view.modalSearchSale.php";
    }
    public function createSale() {
        extract($_POST);
        $answer = array();
        $creation_date=date("Y-m-d");
        $insertSale = $this->execute("INSERT INTO sales_invoice (Invoice_Number, Date_Invoice, nit_costumer, Subtotal, Total) VALUES ( NULL, '$creation_date', '$nit_costumer', '$saleSubTotal', '$saleTotal')");	
        // echo "INSERT INTO sales_invoice (Invoice_Number, Date_Invoice, nit_costumer, Subtotal, Total) VALUES ( NULL, '$creation_date', '$nit_costumer', '$subtotalSale', '$totalSale')";
       
        $getInvoice_Number = $this->consult("SELECT @@identity AS id");
       
        $numInvoice = trim($getInvoice_Number[0][0]);
        // echo $numInvoice;
        // echo "<br>";
        // var_dump($code);
        
        
        if (isset($code)) {
            for ($i = 0; $i < count($code); $i++) {
                // echo "INSERT INTO sales_invoice_detail (invoice_number, code_product, Amount, product_value)  VALUES ( '$numInvoice[$i]', '$code[$i]', '$amount[$i]', '$price[$i]')";
                $insertDetailSale = $this->execute("INSERT INTO sales_invoice_detail (invoice_number, code_product, Amount, product_value)  VALUES ( '$numInvoice', '$code[$i]', '$amount[$i]', '$price[$i]')");
               //=========================/ Inventario /----------------------//
                $operation =  $this->execute("SELECT amount FROM product WHERE code_product = '$code[$i]'");
                $row = $operation->fetch_assoc();
                $result = $row['amount'] ;
                $result = $result - $amount[$i];
                // if($result!=0){
                    $update = $this->execute("UPDATE product SET amount ='$result' WHERE code_product = '$code[$i]'");
                //     $answer["typeAnswer"] = true;
                // } else { $answer["typeAnswer"] = "erase";}
                //-----------------------------------------------------------//
            }
        }
        if ($insertSale) {  $answer["typeAnswer"] = true; }
         echo json_encode($answer);  
    }

    public function selectProduct(){
        // $data = array();
        $query = $this->execute("SELECT Code_Product, Product, Price FROM product");
        $select = "";
        $select .= "<option value=''>Seleccione ...</option>";
        while ($res = mysqli_fetch_row($query)) {
                $select .= "<option value=" . $res[0] ." data =". $res[2] .">" . $res[1] . "</option>";
        }
        echo $select;
    }
    public function searchCustomer(){
        extract($_POST);
        $data = array();

        $sqlcustomer = $this->consult("SELECT * FROM costumer WHERE nit_costumer = '$idCustomer'");

        foreach ($sqlcustomer as $list) {
            $data = array(
                "nit_costumer" => $list["nit_costumer"],
                // "name_customer" => trim(str_replace("*", "", $list[1])),
                "name_customer" => $list["Name_Customer"],
                "lastName_customer" => $list["LastName_Customer"],
                "phone_customer" => $list["Phone_Customer"],
                "address" => $list["Address"],
                "email" => $list["Email"],
            );
        }
        echo json_encode($data); 
    }
    // public function editSale() {
    //     extract($_POST);
    //     $answer = array();

    //    $UpdateSale = $this->execute("UPDATE provider SET Sale ='$name_provider', Address_Sale = '$address_provider', Phone_Sale = '$phone_provider', 
    //                                     Email_Sale = '$email_provider' WHERE Nit_Sale='$idCard'");	
      
    //     if ($UpdateSale) {  $answer["typeAnswer"] = true; } echo json_encode($answer);  
    // }
    // public function deleteSale() {
    //     extract($_POST);
    //     $answer = array();
    //     $deleteCustomer = $this->execute("DELETE FROM provider WHERE Nit_Sale = '$idCard'");

    //     if ($deleteCustomer) { $answer["typeAnswer"] = true; } echo json_encode($answer); 
    // }
}