<?php
class database{
    public $mysqli;                                                                                                                                                                                                                      
    public $connected;
    public $retrieve;
    public $insert;
    public $delete;
    public $update;




public function __construct() {                                                                                                                                                                                                      
    $this->connected = false;
//     $this->retrieve = new Retrieve;
//     $this->insert = new Insert;
//     $this->delete = new Delete;
//     $this->update = new Update;
 
    $this->mysqli = @new mysqli('localhost', 'root', 'micCheck1212', 'VMS');
    //$this->mysqli = @new mysqli('localhost', 'root', '', 'mezzo3');
    //
    if($this->mysqli->connect_error)
        die('Connect Error '.$this->mysqli->connect_errno.' '.$this->mysqli->connect_error); else
        $this->connected = true;


}//end constructor

    public function hashFunction($pw) {                                                                                                                                                                                                 
        $pw = '94cl' . $pw . 'p7bl';
        $pwHash = hash('sha512', $pw);
        return $pwHash;
    }//end hashFunction()

}//end class


?>
