<?php
@session_start();
include_once "../../config/connection.php";

class Provider extends connection {

    public function viewCreateProvider(){
        include_once "../../views/Provider/view.CreateProvider.php";
    }

    public function viewWatchProvider(){
        extract($_POST);
        $sqlProvider = $this->execute("SELECT * FROM provider WHERE Nit_Provider = $nit_provider");
        include_once "../../views/Provider/view.WatchProvider.php";
    }

    public function viewEditProvider(){
        extract($_POST);
        $sqlProvider = $this->execute("SELECT * FROM provider WHERE Nit_Provider = $nit_provider");

        include_once "../../views/Provider/view.EditProvider.php";
    }

    public function modalSearchProvider(){
        include_once "../../views/Provider/view.modalSearchProvider.php";
    }
    public function createProvider() {
        extract($_POST);
        $answer = array();
        $creation_date=date("Y-m-d");
        $InsertCustomer = $this->execute("INSERT INTO provider (Nit_Provider, Provider, Address_Provider, Phone_Provider, Email_Provider, Create_Date_Provider) VALUES ('$idCard', '$name_provider',  '$address_provider','$phone_provider', '$email_provider', '$creation_date')");	
    	
        if ($InsertCustomer) {  $answer["typeAnswer"] = true; } echo json_encode($answer);  
    }
    public function ListProvider(){
        extract($_POST); $datos = array(); $condition = "";
        
        if($nit != ""){
            $condition .="AND Nit_Provider LIKE '$nit%'";
        }
        if($name != "" ){  $condition .="AND Provider LIKE '$name%'"; }
        
       
        $listCostumer =  $this->consult("SELECT Nit_Provider, Provider, Address_Provider, Phone_Provider, Email_Provider, Create_Date_Provider
                          FROM provider WHERE Email_Provider LIKE '%' $condition");
        

        foreach ($listCostumer as $list) {
            array_push($datos,
            array(
                "nit_provider" => $list["Nit_Provider"],
                "name_provider" => $list['Provider'],
                "address" => $list["Address_Provider"],
                "phone" => $list["Phone_Provider"],
                "email" => $list["Email_Provider"],
                "creation_date" => $list["Create_Date_Provider"],
                "btnVer" => '<button type="button" class="text-white btn btn-info" id="viewWatchProvider"><i class="fa fa-eye"></i></button>',
                "btnEditar" => '<button type="button" class="text-white btn btn-warning" id="viewEditProvider"><i class="fa fa-edit"></i></button>'

            ));
        }
            $table = array("data" => $datos); 
            echo json_encode($table);
    }
    public function editProvider() {
        extract($_POST);
        $answer = array();

       $UpdateProvider = $this->execute("UPDATE provider SET Provider ='$name_provider', Address_Provider = '$address_provider', Phone_Provider = '$phone_provider', 
                                        Email_Provider = '$email_provider' WHERE Nit_Provider='$idCard'");	
      
        if ($UpdateProvider) {  $answer["typeAnswer"] = true; } echo json_encode($answer);  
    }
    public function deleteProvider() {
        extract($_POST);
        $answer = array();
        $deleteCustomer = $this->execute("DELETE FROM provider WHERE Nit_Provider = '$idCard'");

        if ($deleteCustomer) { $answer["typeAnswer"] = true; } echo json_encode($answer); 
    }
}