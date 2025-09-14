<?php
@session_start();
include_once "../../config/connection.php";

class Customer extends connection {

    public function viewCreateCustomer(){

        $waytoPay = $this->consult("SELECT * FROM waytopay ORDER BY Description");
        include_once "../../views/Customer/view.CreateCustomer.php";
    }

    public function viewWatchCustomer(){
        extract($_POST);
        $sqlCustomer = $this->execute("SELECT * FROM costumer WHERE nit_costumer = $nit_costumer");
        $sqlwaytoPay =  $this->consult("SELECT * FROM waytopay WHERE Code_Way_Pay = '$waytopay'");

        include_once "../../views/Customer/view.WatchCustomer.php";
    }

    public function viewEditCustomer(){
        extract($_POST);
        $sqlCustomer = $this->execute("SELECT * FROM costumer WHERE nit_costumer = $nit_costumer");
        $sqlwaytoPay =  $this->consult("SELECT * FROM waytopay WHERE Code_Way_Pay = '$waytopay'");
        
        $waytoPay = $this->consult("SELECT * FROM waytopay ORDER BY Description");

        include_once "../../views/Customer/view.EditCustomer.php";
    }

    public function modalSearchCustomer(){
        include_once "../../views/Customer/view.modalSearchCustomer.php";
    }
    public function createCustomer() {
        extract($_POST);
        $answer = array();
        $creation_date=date("Y-m-d");
        $InsertCustomer = $this->execute("INSERT INTO costumer (nit_costumer, Name_Customer, LastName_Customer, Phone_Customer, Address, Email, Creation_Date, Code_Way_Pay)
                                        VALUES ('$idCard', '$name_customer', '$lastName_customer', '$phone_customer' , '$address_customer', '$email_customer', '$creation_date', '$WaytoPay')");	
        
        if ($InsertCustomer) {  $answer["typeAnswer"] = true; } 
        echo json_encode($answer);  
    }

    public function listCustomer(){
        extract($_POST);
        $datos = array(); 
        $condition = "";
        
        if($nit != ""){
            $condition .="AND nit_costumer LIKE '$nit%'";
        }
        if($name != "" ){
            $condition .="AND Name_Customer LIKE '$name%'";
        } 
        if($lastname != ""){
            $condition .="AND LastName_Customer LIKE '$lastname%'";
        } 
       
        $listCostumer =  $this->consult("SELECT nit_costumer, Name_Customer, LastName_Customer, Address, Email, Creation_Date, Code_Way_Pay
                          FROM costumer WHERE Email LIKE '%' $condition");
        // echo "SELECT * FROM costumer WHERE Code_Way_Pay = '$WaytoPay'";

        foreach ($listCostumer as $list) {
            array_push($datos,
            array(
                "nit_costumer" => $list["nit_costumer"],
                "name_customer" => $list['Name_Customer'],
                "lastName_customer" => $list['LastName_Customer'],
                "address" => $list["Address"],
                "email" => $list["Email"],
                "creation_date" => $list["Creation_Date"],
                "waytopay" => $list["Code_Way_Pay"],
                "btnVer" => '<button type="button" class="text-white btn btn-info" id="viewWatchCustomer"><i class="fa fa-eye"></i></button>',
                "btnEditar" => '<button type="button" class="text-white btn btn-warning" id="viewEditCustomer"><i class="fa fa-edit"></i></button>'

            ));
        }
            $table = array("data" => $datos);
            echo json_encode($table);
    }
    public function EditCustomer() {
        extract($_POST);
        $answer = array();

       $UpdateCustomer = $this->execute("UPDATE costumer SET Name_Customer ='$name_customer', LastName_Customer = '$lastName_customer', Phone_Customer = '$phone_customer',
                                        Address = '$address_customer', Email = '$email_customer', Code_Way_Pay = '$waytoPay' WHERE nit_costumer='$idCard'");	
      
        if ($UpdateCustomer) {  $answer["typeAnswer"] = true; } echo json_encode($answer);  
    }
    

    public function deleteCustomer() {
        extract($_POST);
        $answer = array();
        $deleteCustomer = $this->execute("DELETE FROM costumer WHERE nit_costumer='$idCard'");

        if ($deleteCustomer) { $answer["typeAnswer"] = true; } echo json_encode($answer); 
    }
}