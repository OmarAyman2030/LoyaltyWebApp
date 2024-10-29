<?php

class cart
{
  private $cart_id;
  private $user_id;
  private $item_id;
  protected $db;

  // Getter and setter methods 
  public function getUserId()
  {
    return $this->user_id;
  }
  public function setUserId($user_id)
  {
    $this->user_id = $user_id;
  }
  public function getCartId()
  {
    return $this->cart_id;
  }
  public function setCartId($cart_id)
  {
    $this->cart_id = $cart_id;
  }
  public function setItems($items)
  {
    $this->item_id = $items;
  }
  public function getitem_id()
  {
    return $this->item_id;
  }

  public function userHaspro($UserId, $product_id)
  {
    $this->db = new Dbcontroller;
    if ($this->db->openconnection()) {
      $cartid = $UserId;
      $proid = $product_id;
      $query = "SELECT * FROM cart_item WHERE user_id = ? AND product_id = ?";
      $params = array($cartid, $proid);
      $result = $this->db->selectWithParams($query, $params);

      if ($result === false) {
        // Error in query
        return false;
      } else {
        if ($result->num_rows == 0) {
          // No cart found for the user
          return false;
        } else {
          // Cart found for the user
          return true;
        }
      }
    } else {
      // Failed to open connection
      return false;
    }
  }

  public function addtocart($UserId, $product_id)
  {
    $this->db = new Dbcontroller;
    if ($this->db->openconnection()) {
      $x = $UserId;
      $y = $product_id;
      $z = 1;
      $query = "INSERT INTO cart_item (user_id, product_id, quantity) VALUES ('$x', '$y', '$z')";
      return $this->db->insert($query);
    } else {
      session_start();
      $_SESSION['errmsg'] = "Failed to establish database connection";
      return false;
    }
  }
  public function ubdatetocart($UserId, $product_id,$w)
  {
    $this->db = new Dbcontroller;
    if ($this->db->openconnection()) {
      $x = $UserId;
      $y = $product_id;
      // Or any other value you want to update the quantity to
      $query = "UPDATE cart_item SET quantity = quantity+$w WHERE user_id = $x AND product_id = $y";
      return $this->db->update($query); // Assuming you have an update function in your Dbcontroller
    } else {
      session_start();
      $_SESSION['errmsg'] = "Failed to establish database connection";
      return false;
    }
  }

  public function getcart($n2)
  {
    $this->db = new Dbcontroller;
    if ($this->db->openconnection()) {
      $query = "select * from cart_item where user_id='$n2'";
      return $this->db->select($query);
    } else {
      echo "Falid in connection";
      return false;
    }
  }

  public function removefromcart($n, $d)
  {
    $this->db = new Dbcontroller;
    if ($this->db->openconnection()) {
      $query = "delete from cart_item where user_id=" . $n . " And product_id=" . $d;
      return $this->db->delete($query);
    } else {
      session_start();
      $_SESSION['errmsg'] = "Falid in connection";
      return false;
    }
  }
}
?>