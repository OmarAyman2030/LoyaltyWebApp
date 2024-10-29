<?php
class sub
{
  protected $db;

  public function cc($num, $cvv, $name, $date, $id, $total)
  {
    $this->db = new Dbcontroller;
    if ($this->db->openconnection()) {
      $name = $_POST['cardname'];
      $date = $_POST['date'];
      $num = $_POST['cardnum'];
      $cvv = $_POST['cvv'];
      $query = "select * from card where id ='$num' and cvv='$cvv' and date = '$date' and name = '$name' ";
      $result = $this->db->select($query);
      if (empty($result)) {
        echo "Error in Query";
      } else {
        if (count($result) == 0) {
          session_start();
          $_SESSION['errmsg'] = "Wrong email or password";
        } else {

          ////////////////////////////////////////////////////////
          $query = "SELECT * FROM cart_item WHERE user_id = $id";
          // Execute the query
          $result = $this->db->select($query);
          if (!empty($result)) {
            foreach ($result as $r) {
              $pro_id = $r["product_id"];
              $pro_q = $r["quantity"];
              $q = "SELECT price,Merchant_N,quantity,donation_p,donation_id FROM products WHERE id = $pro_id";
              $single_p = $this->db->select($q);
              $insert_pay = "INSERT INTO payment VALUES ($id, $pro_id,$pro_q,'{$single_p[0]["Merchant_N"]}', {$single_p[0]["price"]}, 'CARD_NUMBER')";
              $this->db->insert($insert_pay);
              $q_upd_in_pro_q = "UPDATE products SET quantity = {$single_p[0]["quantity"]} - $pro_q WHERE id = $pro_id";
              $this->db->executeQuery($q_upd_in_pro_q);
              $new_quantity = $pro_q * ($single_p[0]["price"] / $single_p[0]["donation_p"]);
              $q_upd_in_don = "UPDATE donation SET don = {$new_quantity} WHERE id = {$single_p[0]["donation_id"]}";
              $this->db->executeQuery($q_upd_in_don);
            }

            $q_upd_in_don = "UPDATE customer SET sub  = 1";
            $this->db->executeQuery($q_upd_in_don);
            header("location:../Views/cart.php");
            $_SESSION["sub"]=1;
          }
        }
      }
    } else {
      return false;
    }
  }
  public function ap($id, $total)
  {
    $this->db = new Dbcontroller;
    if ($this->db->openconnection()) {
      $query = "SELECT * FROM cart_item WHERE user_id = $id";
      // Execute the query
      $result = $this->db->select($query);
      if (!empty($result)) {
        foreach ($result as $r) {
          $pro_id = $r["product_id"];
          $pro_q = $r["quantity"];
          $q = "SELECT price,Merchant_N,quantity,donation_p,donation_id FROM products WHERE id = $pro_id";
          $single_p = $this->db->select($q);
          $insert_pay = "INSERT INTO payment VALUES ($id, $pro_id,$pro_q,'{$single_p[0]["Merchant_N"]}', {$single_p[0]["price"]}, 'apple pay')";
          $this->db->insert($insert_pay);
          $q_upd_in_pro_q = "UPDATE products SET quantity = {$single_p[0]["quantity"]} - $pro_q WHERE id = $pro_id";
          $this->db->executeQuery($q_upd_in_pro_q);
          $new_quantity = $pro_q * ($single_p[0]["price"] / $single_p[0]["donation_p"]);
          $q_upd_in_don = "UPDATE donation SET don = {$new_quantity} WHERE id = {$single_p[0]["donation_id"]}";
          $this->db->executeQuery($q_upd_in_don);
        }

        $q_upd_in_don = "UPDATE customer SET sub  = 1";
        $this->db->executeQuery($q_upd_in_don);
        header("location:../Views/cart.php");
      }
    }
  }
  public function pp($id, $total)
  {
    $this->db = new Dbcontroller;
    if ($this->db->openconnection()) {
      $query = "SELECT * FROM cart_item WHERE user_id = $id";
      // Execute the query
      $result = $this->db->select($query);
      if (!empty($result)) {
        foreach ($result as $r) {
          $pro_id = $r["product_id"];
          $pro_q = $r["quantity"];
          $q = "SELECT price,Merchant_N,quantity,donation_p,donation_id FROM products WHERE id = $pro_id";
          $single_p = $this->db->select($q);
          $insert_pay = "INSERT INTO payment VALUES ($id, $pro_id,$pro_q,'{$single_p[0]["Merchant_N"]}', {$single_p[0]["price"]}, 'paypal')";
          $this->db->insert($insert_pay);
          $q_upd_in_pro_q = "UPDATE products SET quantity = {$single_p[0]["quantity"]} - $pro_q WHERE id = $pro_id";
          $this->db->executeQuery($q_upd_in_pro_q);
          $new_quantity = $pro_q * ($single_p[0]["price"] / $single_p[0]["donation_p"]);
          $q_upd_in_don = "UPDATE donation SET don = {$new_quantity} WHERE id = {$single_p[0]["donation_id"]}";
          $this->db->executeQuery($q_upd_in_don);
        }

        $q_upd_in_don = "UPDATE customer SET sub  = 1";
        $this->db->executeQuery($q_upd_in_don);
        header("location:../Views/cart.php");
      }
    }
  }
  public function gp($id, $total)
  {
    $this->db = new Dbcontroller;
    if ($this->db->openconnection()) {

      ////////////////////////////////////////////////////////
      $query = "SELECT * FROM cart_item WHERE user_id = $id";
      // Execute the query
      $result = $this->db->select($query);
      if (!empty($result)) {
        foreach ($result as $r) {
          $pro_id = $r["product_id"];
          $pro_q = $r["quantity"];
          $q = "SELECT price,Merchant_N,quantity,donation_p,donation_id FROM products WHERE id = $pro_id";
          $single_p = $this->db->select($q);
          $insert_pay = "INSERT INTO payment VALUES ($id, $pro_id,$pro_q,'{$single_p[0]["Merchant_N"]}', {$single_p[0]["price"]}, 'google pay')";
          $this->db->insert($insert_pay);
          $q_upd_in_pro_q = "UPDATE products SET quantity = {$single_p[0]["quantity"]} - $pro_q WHERE id = $pro_id";
          $this->db->executeQuery($q_upd_in_pro_q);
          $new_quantity = $pro_q * ($single_p[0]["price"] / $single_p[0]["donation_p"]);
          $q_upd_in_don = "UPDATE donation SET don = {$new_quantity} WHERE id = {$single_p[0]["donation_id"]}";
          $this->db->executeQuery($q_upd_in_don);
        }

        $q_upd_in_don = "UPDATE customer SET sub  = 1";
        $this->db->executeQuery($q_upd_in_don);
        header("location:../Views/cart.php");
      }
    }
  }
}