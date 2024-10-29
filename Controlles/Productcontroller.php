<?php
require_once("../Models/product.php");
require_once("../Controlles/Dbcontroller.php");
class Productcontroller{
protected $db;
public function get($n){
    $this->db=new Dbcontroller;
    if($this->db->openconnection()){
    $query="select * from ".$n;
    return $this->db->select($query);
    }
    else{
        echo"Falid in connection";
        return false;
    }
}
public function getbyid($n,$n2){
    $this->db=new Dbcontroller;
    if($this->db->openconnection()){
$query="select * from ".$n." where id='$n2'";
return $this->db->select($query);
    }
    else{
        echo"Falid in connection";
        return false;
    }
}
public function getallcategory($ID)
    {
        $this->db = new Dbcontroller;
        if ($this->db->openconnection()) {
            $query = "SELECT products.image,products.id, products.name, products.price, products.quantity, category.name AS categoryy, merchants.name AS merchanty FROM products INNER JOIN category ON products.category_id = category.id INNER JOIN merchants ON products.Merchant_N  = merchants.name WHERE products.category_id= $ID;;
";
            return $this->db->select($query);
        } else {
            echo "Error IN Database commenction";
            return false;
        }
    }
    public function getallcategorys()
    {
        $this->db = new Dbcontroller;
        if ($this->db->openconnection()) {
            $query = "SELECT * FROM category;
;
";
            return $this->db->select($query);
        } else {
            echo "Error IN Database commenction";
            return false;
        }
    }

public function getallproducts()
    {
        $this->db = new Dbcontroller;
        if ($this->db->openconnection()) {
            $query = "SELECT products.image, products.id, products.name, products.price, products.quantity, category.name AS categoryy, merchants.name AS merchanty FROM products INNER JOIN category ON products.category_id = category.id INNER JOIN merchants ON products.Merchant_N  = merchants.name;
";
            return $this->db->select($query);
        } else {
            echo "Error IN Database commenction";
            return false;
        }
    }
public function suggestproduct(product $product){
    $this->db=new Dbcontroller;
    if($this->db->openconnection()){
        $n=$product->getname();
        $n2=$product->getprice();
        $n3=$product->getdescription();
        $n4=$product->getdonation_p();
        $n5=$product->getdonationid();
        $n6=$product->getcategoryid();
        $n7=$product->getmarchantid();
        $n8=$product->getimage();
        $n9=$product->getquantity();
       
        
$query="insert into suggest_products values ('','$n',$n2,'$n3',$n9,$n4,'$n8',$n6,$n5,'$n7')";
return $this->db->insert($query);
    }
    else{
        session_start();
        $_SESSION['errmsg']="Falid in connection";
        return false;
    }

}
public function addproduct(product $product){
    $this->db=new Dbcontroller;
    if($this->db->openconnection()){
        $n=$product->getname();
        $n2=$product->getprice();
        $n3=$product->getdescription();
        $n4=$product->getdonation_p();
        $n5=$product->getdonationid();
        $n6=$product->getcategoryid();
        $n7=$product->getmarchantid();
        $n8=$product->getimage();
        $n9=$product->getquantity();
       
        
$query="insert into products values ('','$n',$n2,'$n3',$n9,$n4,'$n8',$n6,$n5,'$n7')";
return $this->db->insert($query);
    }
    else{
        session_start();
        $_SESSION['errmsg']="Falid in connection";
        return false;
    }

}
public function deleteproduct($n){
    $this->db=new Dbcontroller;
    if($this->db->openconnection()){
$query="delete from products where id=".$n;
return $this->db->delete($query);
    }
    else{
        session_start();
        $_SESSION['errmsg']="Falid in connection";
        return false;
    }
}

public function deleteSSproduct($n){
    $this->db=new Dbcontroller;
    if($this->db->openconnection()){
$query="delete from suggest_products where id=".$n;
return $this->db->delete($query);
    }
    else{
        session_start();
        $_SESSION['errmsg']="Falid in connection";
        return false;
    }
}


}

?>