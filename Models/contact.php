<?php

    class contact{
        protected $db;
        private $fname;
        private $lname;
        private $email;
        private $phone;
        private $message;
        public function setfname($n){
            $this->fname=$n;
        }
        public function setlname($n){
            $this->lname=$n;
        }
        public function setemail($n){
            $this->email=$n;
        }
        public function setphone($n){
            $this->phone=$n;
        }
         public function setmessage($n){
            $this->message=$n;
        }
        public function getfname(){
           return $this->fname;
        }
        public function getlname(){
            return $this->lname;
        }
        public function getemail(){
            return $this->email;
        }
        public function getphone(){
            return $this->phone;
        }
         public function getmessage(){
            return $this->message;
        }
    }



?>