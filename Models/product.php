<?php

class product{
private $id;
private $name;
private $price;
private $quantity;
private $donation_p;
private $category_id;
private $image;
private $description;
private $Merchant_id;
private $donation_id;
public function setname($n){
$this->name=$n;
}
public function setprice($n){
    $this->price=$n;
    }
    public function setquantity($n){
        $this->quantity=$n;
        }
        public function setimage($n){
            $this->image=$n;
            }
            public function setdescription($n){
                $this->description=$n;
                }
                public function setdonation_p($n){
                    $this->donation_p=$n;
                    }
                    public function setcategoryid($n){
                        $this->category_id=$n;
                        }
                        public function setmarchantid($n){
                            $this->Merchant_id=$n;
                            }
                            public function setdonationid($n){
                                $this->donation_id=$n;
                                }

                                public function getname(){
                                    return $this->name;
                                    }
                                    public function getprice(){
                                        return $this->price;
                                        }
                                        public function getquantity(){
                                            return $this->quantity;
                                            }
                                            public function getimage(){
                                                return $this->image;
                                                }
                                                public function getdescription(){
                                                    return $this->description;
                                                    }
                                                    public function getdonation_p(){
                                                        return $this->donation_p;
                                                        }
                                                        public function getcategoryid(){
                                                            return $this->category_id;
                                                            }
                                                            public function getmarchantid(){
                                                                return $this->Merchant_id;
                                                                }
                                                                public function getdonationid(){
                                                                    return $this->donation_id;
                                                                    }









                               
                               



}

?>