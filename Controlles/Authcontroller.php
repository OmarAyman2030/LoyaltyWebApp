<?php
require_once("../Models/user.php");
require_once("../Controlles/Dbcontroller.php");
class Authcontroller{
protected $db;
public function login(user $user)
    {
        $this->db = new Dbcontroller;
        if ($this->db->openconnection()) {
            $n = $user->getemail();
            $n2 = $user->getpassword();
            $query = "select * from users where email='$n' and password='$n2'";
            $result = $this->db->select($query);
            if ($result === false) {
                echo "Error in Query";
                return false;
            } else {
                if (count($result) == 0) {
                    session_start();
                    $_SESSION['errmsg'] = "Wrong email or password";
                    return false;
                } else {
                    session_start();

                    $_SESSION['userid'] = $result[0]["id"];
                    $_SESSION['username'] = $result[0]["fname"];
                    $_SESSION['lname'] = $result[0]["lname"];
                    $_SESSION['userphone'] = $result[0]["phone"];
                    $_SESSION['useremail'] = $result[0]["email"];
                    $_SESSION['password'] = $result[0]["password"];
                  //  $_SESSION['ll'] = $result[0]["lname"];

                    if ($result[0]["role_id"] == 1)
                        $_SESSION['userrole'] = "Admin";

                    else if ($result[0]["role_id"] == 2) {
                        $_SESSION['userrole'] = "Customer";
                        $id = $result[0]["id"];
                        $query2 = "select * from customer where id='$id'";
                        $result2 = $this->db->select($query2);
                        if ($result2 === false) {
                            echo "Error in Query";
                            return false;
                        } else {
                            if (count($result2) == 0) {
                                session_start();
                                $_SESSION['errmsg'] = "Wrong email or password";
                                return false;
                            } else {
                                $s = $result2[0]["loyality"];
                                $_SESSION['loyality'] = $s;
                                $_SESSION['points'] = $result2[0]["points"];
                                $_SESSION['sub'] = $result2[0]["sub"];
                            }
                        }
                    } else if ($result[0]["role_id"] == 3)
                        $_SESSION['userrole'] = "Merchant";

                    return true;
                }
                //}//
                //  }
            }
        } else {
            return false;
        }
    }

public function register(user $user,$P){
    $this->db=new Dbcontroller;
    if($this->db->openconnection()){
        $n=$user->getemail();
        $n2=$user->getpassword();
        $n3=$user->getfname();
        $n4=$user->getphone();
        $n5=$user->getlname();
        $r="select * from users where email='$n'";
        $e=$this->db->select($r);
        if(count($e)>=1){
            
            $_SESSION['errmsg']="Email is already exits ";
            return false;
            
        }


if($n2!=$P){
            
            $_SESSION['errmsg']="Password not match ";
            return false;
        }
        $query="insert into users values('','$n3','$n5','$n4','$n','$n2',2)";
        $result=$this->db->insert($query);
        
       
        
       
        if($result===false){
            session_start();
           $_SESSION['errmsg']="Something Wrong";

            return false;
        }
        
        
        else{ 
         $f=$this->db->select($r);
         $userId = $f[0]['id'];
        $o="insert into customer values($userId,1,0,0)";
        $k=$this->db->insert($o);
          
                 session_start();
                $_SESSION['userid']=$result;
                $_SESSION['points']=0;
                $_SESSION['username']=$n3;
                $_SESSION['userrole']="Customer";
                $_SESSION['usepoint']=0;
                
                return true;
            

        }

    }
    else{
        echo"Falid in connection";
        return false;
    }
        
    
}
public function logout() {
    $_SESSION = array();
    session_destroy();
    header("Location: login.php");
    exit;
}
}

?>