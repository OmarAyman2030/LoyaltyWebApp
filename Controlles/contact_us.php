<?php 
    require_once("../Controlles/Dbcontroller.php");
    require_once("../Models/contact.php");
    class contactus{
        protected $db;
        public function addcontact(contact $cont){
            $this->db=new Dbcontroller;
            if($this->db->openconnection()){
                $n=$cont->getfname();
                $n2=$cont->getlname();
                $n3=$cont->getphone();
                $n4=$cont->getemail();
                $n5=$cont->getmessage();
                
        $query="insert into contact_us values ('$n','$n2','$n4','$n3','$n5')";
        return $this->db->insert($query);
            }
            else{
                session_start();
                $_SESSION['errmsg']="Falid in connection";
                return false;
            }
        
        }

    }


?>