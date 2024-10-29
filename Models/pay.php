<?php
class pay
{
  protected $db;

  public function cc( $id, $total)
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
              $prev_don = "SELECT don FROM donation WHERE id = {$single_p[0]["donation_id"]}";
              $prev_q_don = $this->db->select($prev_don);
              $new_quantity = $prev_q_don[0]["don"] + $pro_q* $single_p[0]["price"]* ($single_p[0]["donation_p"] / 100);
              $q_upd_in_don = "UPDATE donation SET don = {$new_quantity} WHERE id = {$single_p[0]["donation_id"]}";
              $this->db->executeQuery($q_upd_in_don);
            }
            $q = "SELECT points FROM customer WHERE id = $id";
            $cus = $this->db->select($q);
            $po = $cus[0]["points"] + ($total / 2);
            $this->updateLoyalty($id, $total);
            $q_upd_in_don = "UPDATE customer SET points  = {$po} WHERE id = {$id}";
            $this->db->executeQuery($q_upd_in_don);
            $del_q = "DELETE FROM cart_item WHERE user_id = $id";
            $this->db->executeQuery($del_q);
            header("location:../Views/cus_home.php");
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
          $prev_don = "SELECT don FROM donation WHERE id = {$single_p[0]["donation_id"]}";
          $prev_q_don = $this->db->select($prev_don);
          $new_quantity = $prev_q_don[0]["don"] + $pro_q* $single_p[0]["price"]* ($single_p[0]["donation_p"] / 100);
          $q_upd_in_don = "UPDATE donation SET don = {$new_quantity} WHERE id = {$single_p[0]["donation_id"]}";
          $this->db->executeQuery($q_upd_in_don);
        }
        $q = "SELECT points FROM customer WHERE id = $id";
        $cus = $this->db->select($q);
        $point = $cus[0]["points"]  -  $_SESSION['usepoint'] + ($total + $_SESSION['usepoint'] * 0.5) * 0.5;
        //  1507  =          1632 -             300                   +            (198 + 150) * 0.5
        $q_upd_in_don = "UPDATE customer SET points  = {$point} WHERE id = {$id}";
        $this->db->executeQuery($q_upd_in_don);
        $_SESSION['usepoint'] = 0;
        $del_q = "DELETE FROM cart_item WHERE user_id = $id";
        $this->updateLoyalty($id, $total);
        $this->db->executeQuery($del_q);
        header("location:../Views/cus_home.php");
        $_SESSION['points'] = $point;
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
          $prev_don = "SELECT don FROM donation WHERE id = {$single_p[0]["donation_id"]}";
          $prev_q_don = $this->db->select($prev_don);
          $new_quantity = $prev_q_don[0]["don"] + $pro_q* $single_p[0]["price"]* ($single_p[0]["donation_p"] / 100);
          $q_upd_in_don = "UPDATE donation SET don = {$new_quantity} WHERE id = {$single_p[0]["donation_id"]}";
          $this->db->executeQuery($q_upd_in_don);
        }
        $q = "SELECT points FROM customer WHERE id = $id";
        $cus = $this->db->select($q);
        $point = $cus[0]["points"]  -  $_SESSION['usepoint'] + ($total + $_SESSION['usepoint'] * 0.5) * 0.5;
        //  1507  =          1632 -             300                   +            (198 + 150) * 0.5
        $q_upd_in_don = "UPDATE customer SET points  = {$point} WHERE id = {$id}";
        $this->db->executeQuery($q_upd_in_don);
        $_SESSION['usepoint'] = 0;
        $del_q = "DELETE FROM cart_item WHERE user_id = $id";
        $this->updateLoyalty($id, $total);
        $this->db->executeQuery($del_q);
        header("location:../Views/cus_home.php");
        $_SESSION['points'] = $point;

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
        $q = "SELECT points FROM customer WHERE id = $id";
        $cus = $this->db->select($q);
        $point = $cus[0]["points"]  -  $_SESSION['usepoint'] + ($total + $_SESSION['usepoint'] * 0.5) * 0.5;
        //  1507  =          1632 -             300                   +            (198 + 150) * 0.5
        $q_upd_in_don = "UPDATE customer SET points  = {$point} WHERE id = {$id}";
        $this->db->executeQuery($q_upd_in_don);
        $_SESSION['usepoint'] = 0;
        $del_q = "DELETE FROM cart_item WHERE user_id = $id";
        $this->updateLoyalty($id, $total);
        $this->db->executeQuery($del_q);
        header("location:../Views/cus_home.php");
        $_SESSION['points'] = $point;

      }
    }
  }
  function updateLoyalty($id, $total)
  {
    // Retrieve customer points
    $q = "SELECT points FROM customer WHERE id = $id";
    $cus = $this->db->select($q);

    if (!empty($cus)) {
      $points = $cus[0]["points"] + ($total / 2);

      // Determine loyalty based on points
      $loyalty = 'Regular';
      if ($points >= 2000) {
        $loyalty = 3;
      } elseif ($points >= 1000) {
        $loyalty = 2;
      } elseif ($points >= 500) {
        $loyalty = 1;
      }

      // Update loyalty column in the database
      $q_upd_loyalty = "UPDATE customer SET loyality = $loyalty WHERE id = {$id}";
      $this->db->executeQuery($q_upd_loyalty);
    } else {
      // Handle error: Customer not found
      echo "Customer not found!";
    }
  }
}