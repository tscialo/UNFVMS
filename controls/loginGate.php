<?php

class loginGate {

    public function __construct($ctrl){

        if(isset($_POST['loginEmail'])){
            if($this->studentLogin($ctrl)){
                
            }//end if
            else if($this->orgLogin($ctrl)){

            }//end else

        }//end if
        else if(isset($_POST['signup'])){
            $this->studentSignup($ctrl);
        }//end else
        else if(isset($_POST['oSignup'])){
            $this->orgSignup($ctrl);
        }//end else

    }//end construct

    public function studentLogin($ctrl){
        $email = $ctrl->clean($_POST['loginEmail']);
        $pw = $ctrl->db->hashFunction($ctrl->clean($_POST['password']));
        $result = $ctrl->db->mysqli->query("SELECT sID,sEmail,nNumber,firstName,lastName,created,totalHours,admin FROM student WHERE sEmail='$email' AND password='$pw'");
        $row=$result->fetch_assoc();     
        if(!empty($row)){
            if($row['admin']==1){
                $_SESSION['admin'] = $row['sID'];
                echo 'admin';
            }
            else {

                $_SESSION['studentUser'] = $row['sID'];
                echo 'student';
            }//end else
           return true;
        }//end if
        else{
            $ctrl->error='<h1>Email/Password Combination not recoginzed</h1>';
            return false;
        }
    }//end studentLogin

    public function studentSignup($ctrl){
        $email = $ctrl->clean($_POST['email']);
        $nNumber = $ctrl->clean($_POST['nNumber']);
        $fName = $ctrl->clean($_POST['firstName']);
        $lName = $ctrl->clean($_POST['lastName']);
        $pw = $ctrl->clean($_POST['password']);
        $pw2 = $ctrl->clean($_POST['passwordMatch']);
        if(strcasecmp(substr($email,-7),'unf.edu')==0){
            if($pw==$pw2){
               $pwHash = $ctrl->db->hashFunction($pw); 
                if(!$ctrl->db->mysqli->query("INSERT INTO student VALUES('null','$email','$nNumber','$fName','$lName',NOW(),'$pwHash',0,0)")){
                    echo $ctrl->db->mysqli->error;
                }//end if
                else {
                    $ctrl->message="Thanks for signing up ".$fName.' '.$lName.', sign in to get started';
                }//end else
            }//end if
            else{
            $ctrl->message='YOUR PASSWORDS DID NOT MATCH';
            }
        }//end if
        else{
        $ctrl->message='MUST BE A VALID UNF EMAIL ADDRESS';
        }

    }//end studentSignup


    public function orgLogin($ctrl){
        $email = $ctrl->clean($_POST['loginEmail']);
        $pw = $ctrl->db->hashFunction($ctrl->clean($_POST['password']));
        
        $result = $ctrl->db->mysqli->query("SELECT o_cID,oID FROM o_contact WHERE o_cEmail='$email' AND password='$pw'");
        $row=$result->fetch_assoc();     
        if(!empty($row)){
           $_SESSION['orgUser'] = $row['o_cID'];
            echo 'org';
           return true;
        }
        else{
            $ctrl->error='<h1>Email/Password Combination not recoginzed</h1>';
            echo '0';
            return false;
        }
    }//end studentLogin


    public function orgSignup($ctrl){
        $oName = $ctrl->clean($_POST['oName']);
        $oDescr = $ctrl->clean($_POST['oDescr']);
        $email = $ctrl->clean($_POST['oEmail']);
        $fName = $ctrl->clean($_POST['oFName']);
        $lName = $ctrl->clean($_POST['oLName']);
        $pw = $ctrl->clean($_POST['password']);
        $pw2 = $ctrl->clean($_POST['passwordMatch']);
        $photo;
        $cPhoto;


        if($_FILES['oPhoto']['type']=='image/jpeg'){
            if($_FILES['oPhoto']['error'] == 0){
                $photo = 1;
            }//end if
            else $photo=0;
        }//end if
        else $photo=0;

        if($_FILES['oContactPhoto']['type']=='image/jpeg'){
            if($_FILES['oContactPhoto']['error'] == 0){
                $cPhoto = 1;
            }//end if
            else $cPhoto=0;
        }//end if
        else $cPhoto=0;



        if($pw==$pw2){
            $pwHash = $ctrl->db->hashFunction($pw); 

            $ctrl->db->mysqli->query("INSERT INTO organization VALUES('null','$oName',NOW(),'$photo','$oDescr','null')");
            $id = $ctrl->db->mysqli->insert_id;
            $ctrl->db->mysqli->query("INSERT INTO o_contact VALUES('null','$email','$id','$fName','$lName','$cPhoto',NOW(),'$pwHash')");
            $cID = $ctrl->db->mysqli->insert_id;
            $ctrl->db->mysqli->query("UPDATE organization SET mainContactID = '$cID' WHERE oID = '$id' "); 
            if($photo){
                move_uploaded_file($_FILES['oPhoto']['tmp_name'],"photos/logos/".$id);
                chmod("photos/logos/".$id,0644);
            }//end if
        }//end if
        else{
            echo 'YOUR PASSWORDS DID NOT MATCH';
        }


    }//end orgSignup 




}//end loginGate

?>
