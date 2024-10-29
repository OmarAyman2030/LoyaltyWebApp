<?php

class user{
private $id;
private $fname;
private $lname;
private $email;
private $phone;
private $password;
private $role_id;
public function setfname($n){
$this->fname=$n;
}
public function setlname($n){
    $this->lname=$n;
    }
    public function setphone($n){
        $this->phone=$n;
        }
        
public function setemail($n){
    $this->email=$n;
    }
    public function setpassword($n){
        $this->password=$n;
        }
        public function getfname(){
            return $this->fname;
        }
        public function getemail(){
            return $this->email;
        }

        public function getpassword(){
            return $this->password;
        }
        public function getphone(){
            return $this->phone;
        }
        public function getlname(){
            return $this->lname;
        }



}

?>