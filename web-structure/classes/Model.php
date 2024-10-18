<?php
class Model{

    
    protected $con;
    protected $id;
    protected $columnSet;
    protected $valueSet;
    protected $record;
    protected $tableName;
    protected $userId;

    public $message = array();
    public $errMessage = array();

    protected function setConnection($con){
        $this->con = $con;
    }


public function getId(){
    return $this->id;
}

        /////// Set User Id Property Value ////////
    public function setUserId(){
        if(isset($_SESSION['loginid'])){
            $this->userId = $_SESSION['loginid'];
            return true;
        }
    }
    /////// Set User Id Property Value ////////


    //Check Record Exist IN table or NOT
    public function count($tablename,$condition=NULL){
        $condition = ($condition!=NULL) ? $condition." and" : '';
    
        $query = "SELECT id FROM ".$tablename." WHERE ".$condition." status='Active'";
        // return   $query;
    
        $mysqliQuery = mysqli_query($this->con,$query)or die(mysqli_error());
        $num = mysqli_num_rows($mysqliQuery);
        if($num>0){
        $this->id = $this->getDataArray($query)[0]['id'];
        return $num;
        }else{
            $this->id = "";
        return  0;
        }
    
        }
    

public function lastInsertedId($tableName){

    $query = "SELECT MAX(id) as id FROM ".$tableName." WHERE status='Active' order by id";
    return $this->getDataArray($query)[0]['id'];
}


            //Count By Query
    public function countByQuery($query){
    
         $query = $query;
        // return   $query;
        $num= 0;
        $mysqliQuery = mysqli_query($this->con,$query)or die(mysqli_error());
        $num = mysqli_num_rows($mysqliQuery);
        if($num>0){
        return $num;
        }else{
        return  0;
        }
    
        }
            //Count By Query
    
        ////// Insert Record Function START //////
        public function insert(){ // function START
        
        $query = "INSERT INTO $this->tableName ($this->columnSet) VALUES ($this->valueSet)";

        // echo $query; die();
        
        if (mysqli_query($this->con,$query)) {
            return true;
          }else{
            return false;
          }
    
        } // function END
    
        ////// Update Record Function START //////
    
        public function update(){ // function START
            
        foreach ($this->record as $key => $value) {
            $record[] = "{$key}='{$value}'";
        }
    
        $query = "UPDATE  " .$this->tableName . "  SET ";
        $query .= implode(", ", $record);
         $query .= " WHERE id= " . $this->id;
    
        if (mysqli_query($this->con,$query)) {
            return true;
          }else{
              return false;
          }
        
        } // function END
    ////// Update Record Function END //////
    
        /////// Forced Insert Data To Table ///////
        public function forcedInsert($tableName,array $record){
            $this->id="";
            return $this->save($tableName,$record);
        } 
        /////// Forced Insert Data To Table /////// 

    ///////// Save Record Function For Insert or Update Record ///////
    public function save($tableName,array $record){
    
        // $this->id="";
        // $record=$this->filter_string($record);
        $this->record = $record;
        $this->tableName = $tableName;
        
        $this->columnSet = implode(",",array_keys($record));
        
        $this->valueSet = "'".implode("','",array_values($record))."'";
    
        if(isset($record['id'])){
            $this->count($this->tableName,'id="'.$record['id'].'"');
        }
        $re = ($this->id != "") ? $this->update() : $this->insert();
        // if($this->id != ""){
        //     $this->insert();
        //     return $re;
        // }else{
        //     $this->update();
        //     return $re;
        // }
        return $re;
        }
        ///////// Save Record Function For Insert or Update Record ///////
    
    public function dealsave($tableName,array $record){
    
        // $this->id="";
        // $record=$this->filter_string($record);
        $this->record = $record;
        $this->tableName = $tableName;
        
        $this->columnSet = implode(",",array_keys($record));
        
        $this->valueSet = "'".implode("','",array_values($record))."'";

        $query = "UPDATE  " .$this->tableName . "  SET stock='".$record['stock']."'";
        $query .= " WHERE pid= " . $record['pid'];
    
        $re = mysqli_query($this->con,$query);
    
        return $re;
        }
        ///////// Save Record Function For Insert or Update Record ///////
    
    
        protected function filter_string($record) {
    
        $result= array();
        
        foreach ($record as $key => $value) {
            
            $result[$key] = mysqli_real_escape_string($this->con,$value);
    
        }
        return $result;
        }


        // Fetch Data in array by Query
        public function getDataArray($query){
        $result= array();
        $query = mysqli_query($this->con,$query);
        // If the query returns >= 1 assign the number of rows to numResults
        
        
        
        $numResults = mysqli_num_rows($query);
        
    
        for($i = 0; $i < $numResults; $i++){
            $r = mysqli_fetch_array($query);
                $key = array_keys($r);
                        if(!$query || mysqli_num_rows($query) >= 1){
                            $result[$i] = $r;
                                
                    }else{
                        $result = null;
                    }
    
        }
        return $result; // Query was successful
        }



        ///////// Get data by ColumnSet, TableName, $condition /////////
        function getData($tableName,$columnSet,$condition=NULL){

            $result = array();
            $columnCount = count(explode(",",$columnSet));

            $condition = ($condition!=NULL) ? $condition." and" : '';
    
            $query = "SELECT ".$columnSet." FROM ".$tableName." WHERE ".$condition." status='Active'";
            // return $this->getDataArray($query);

            if($columnCount == 1){
                $query = mysqli_query($this->con,$query);
                while($r = mysqli_fetch_array($query)){
                    $result[] = $r[$columnSet];
                }
            }else{
                $result = $this->getDataArray($query);
            }

            return $result;
        }
        ///////// Get data by ColumnSet, TableName, $condition /////////

        ///////// Generate Token /////////
        public function generateToken($length){
            $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
            $token = substr(str_shuffle($str), 0, $length);
            return $token;
            }
        ///////// Generate Token /////////


        ////////// Full Address //////////
protected function fullAddress($r){
    if(!empty($r)){
        $address = ($r['flat'] != "")? $r['flat'].", ":"";
        $address .= ($r['street'] != "")? $r['street'].", ":"";
        $address .=  ($r['locality'] != "")? $r['locality'].", ":"" ;
        $address .= ($r['city'] != "")? $r['city'].", ":"" ;
        $address .= ($r['state'] != "")? $r['state'].", ":"" ;
        $address .= ($r['country_name'] != "")? $r['country_name']:"" ;
        $address .= ($r['zip_code'] != "")? " - ".$r['zip_code']:"";
    
        return $address;
    }else{
        return false;
    }
    }
    ////////// Full Address //////////




    public function encrypt_decrypt($string, $action = 'encrypt'){
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'KJY878776hjassffsdfpopewodsf4545345'; // user define private key
    $secret_iv = 'dfhbsr5u467hfth435645'; // user define secret key
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}



}
?>