<?php
@session_start();
include_once "../../config/connection.php";

class product extends connection {

    public function viewProduct(){
        include_once "../../views/product/view.CreateProduct.php";
    }

    public function viewWatchProduct(){
        extract($_POST);
        $sqlProduct = $this->execute("SELECT * FROM product WHERE Code_Product = $code_Product");
    $product = mysqli_fetch_assoc($sqlProduct);

        // echo "SELECT * FROM product WHERE Code_Product = $code_Product";
        include_once "../../views/product/view.WatchProduct.php";
    }

public function viewEditProduct(){
    extract($_POST);

    $sqlProduct = $this->execute("SELECT * FROM product WHERE Code_Product = $code_Product");

    // Obtener un solo registro
    $product = mysqli_fetch_assoc($sqlProduct);

    // Para debug
    // var_dump($product);

    include_once "../../views/product/view.EditProduct.php";
}


    public function modalSearchProduct(){
        include_once "../../views/product/view.modalSearchProduct.php";
    }

    public function listProduct(){
        extract($_POST);
        $datos = array(); 
        $condition = "";

        if($codes != ""){
            $condition .="AND Code_Product LIKE '$codes%'";
        }
        if($products != ""){
            $condition .="AND Product LIKE '$products%'";
        }
        if($status != ""){
            if($status == 'T'){
                $status = null;
            }
        }

        $listProduct =  $this->consult("SELECT Code_Product, Product, product_status, Amount, Description
                          FROM product WHERE product_status LIKE '%$status%' $condition");
        // var_dump($listProduct);
        foreach ($listProduct as $list) {
            array_push($datos,
            array(
                "code_Product" => $list["Code_Product"],
                "product" => $list["Product"],
                "status" => $list["product_status"],
                "amount" => $list["Amount"],
                "description" => $list["Description"],
                "btnVer" => '<button type="button" class="text-white btn btn-info" id="viewWatchProduct"><i class="fa fa-eye"></i></button>',
                "btnEditar" => '<button type="button" class="text-white btn btn-warning" id="viewEditProduct"><i class="fa fa-edit"></i></button>'

            ));
        }
            $table = array("data" => $datos);
            echo json_encode($table);
    }

    public function createProduct() {
        extract($_POST);
        // var_dump($_POST);
        $answer = array();
        $code_Product = $_POST["code"];
        $product = $_POST["product"];
        $amount =  $_POST["amount"];

       $InsertProduct = $this->execute("INSERT INTO product (Code_Product, Product, product_status, Price,  Amount, Description) VALUES ('$code_Product', '$product', 'Existente', '$price', '$amount', '$description')");	
       
       if ($InsertProduct) {  $answer["typeAnswer"] = true; } 
        echo json_encode($answer);  
    }
    public function EditProduct() {
        extract($_POST);
        $answer = array();

       $UpdateProduct = $this->execute("UPDATE product SET Product ='$product', Price = '$price', Amount = '$amount', Description = '$description' WHERE Code_Product='$code_Product'");	
    //    echo "UPDATE product SET Product ='$product', Amount = '$amount', Description = '$description' WHERE Code_Product='$code_Product'";
        if ($UpdateProduct) {  $answer["typeAnswer"] = true; }
        echo json_encode($answer);  
    }
    

    public function deleteProduct() {
        extract($_POST);
        $answer = array();
        // echo "DELETE product WHERE Code_Product='$code_Product'";
        $deleteProducto = $this->execute("DELETE FROM product WHERE Code_Product='$code_Product'");

        if ($deleteProducto) { $answer["typeAnswer"] = true;  }
        
        
        echo json_encode($answer); 
    }
}