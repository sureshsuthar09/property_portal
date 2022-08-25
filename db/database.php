<?php
// include("config/constant.php");


class DatabaseClass  
{
    private $host = "localhost";
    private $username = "root";
    private $password = ""; 
    private $db = "mtc";
    
    // Define mysql database connection    
    public function __construct()  
    {  
        $this->con = mysqli_connect($this->host, $this->username, $this->password, $this->db) or die(mysql_error("database"));  
        if(!$this->con)  
        {  
            echo 'Database Connection Error ' . mysqli_connect_error($this->con);
        }
        $this->middleware();
    }

    protected function middleware(){
        $header = getallheaders();
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(!isset($header['api_key'])){
                echo 'api_key is missing in header'; exit;
            }else if(isset($header['api_key']) && $header['api_key']!=api_key){
                echo 'Please provide a  valid api_key'; exit;
            }
        }
    }

    // This method used to execute mysql query 
    protected  function query_executed($sql)  
    {  
        return mysqli_query($this->con, $sql);
    }

     public function get_total_properties()
    {
        $sql = "SELECT count(id) as count_property FROM property";  
        $results = $this->query_executed($sql);
        $rows = $this->get_fetch_data($results);  
        return $rows;
    }

    // This method fetch rows execute query
    public function get_properties($page,$filtersData=null)
    {
        // print_r($filtersData); exit;
        $rec_count = $this->get_total_properties();
        // print_r($rec_count[0]['count_property']); exit;
        
        $rec_limit = 4;

        if(isset($page ) ) {
            $page_data = $page + 1;
            //$offset = $rec_limit * $page;

            $offset = ($page - 1)  * $rec_limit;
        }else {

            $page_data = 0;
            $offset = 0;
        }
        // print_r($offset); exit;
        // $rec_count = $rows; exit;
        $rec_count =  isset($rec_count[0]['count_property']) ? $rec_count[0]['count_property'] : 0;

        $left_rec = $rec_count - ($page * $rec_limit);

        $whereCondition = [];
        // Filter Data
        if(isset($filtersData['town']) && !empty($filtersData['town'])){
           $whereCondition[] = 'property.town='."'".$filtersData['town']."'";
        }
        if(isset($filtersData['number_of_bedrooms']) && !empty($filtersData['number_of_bedrooms'])){
            $whereCondition[] = 'property.number_of_bedrooms='."'".$filtersData['number_of_bedrooms']."'";
        }
        if(isset($filtersData['price']) && !empty($filtersData['price'])){
           $whereCondition[] = 'property.price<='."'".$filtersData['price']."'";
        }
        if(isset($filtersData['type']) && !empty($filtersData['type'])){
            $whereCondition[] = 'property.type='."'".$filtersData['type']."'";
        }

        // print_r(implode(' AND ',$whereCondition)); exit;
        if(empty($whereCondition)){
            $whereCondition = '';
        }else{
            $whereCondition = 'WHERE '.implode(' AND ',$whereCondition);
        }

        // print_r($offset); exit;
        $sql = "SELECT property_type.property_type as property_type, property_type.property_description as property_description ,property.id, property.property_type_id, property.country, property.town, property.description, property.address, property.image, property.thumbnail, property.latitude, property.longitude, property.number_of_bedrooms, property.number_of_bathrooms, property.price, property.type FROM property LEFT JOIN property_type ON property.property_type_id =property_type.id $whereCondition LIMIT $offset, $rec_limit";

        // exit;
        $results = $this->query_executed($sql);
        $rowsData = $this->get_fetch_data($results);
        $rows = ['data'=>$rowsData,'left_rec'=>$left_rec];
        return $rows;
    }

    protected function get_fetch_data($r)  
    {
        $array = array();  
        while ($rows = mysqli_fetch_assoc($r))  
        {  
            $array[] = $rows;  
        }  
        return $array;  
    }

    // Insert data into database
    public function insert($table_name, $data)
    {
        

        $string = "INSERT INTO ".$table_name." (";            
        $string .= implode(",", array_keys($data)) . ') VALUES (';            
        $string .= "'" . implode("','", array_values($data)) . "')";  
        if(mysqli_query($this->con,$string))
        {  
            return mysqli_insert_id($this->con);
            // return true;  
        }
        else
        {  
            return false;
        }  
    }  
}  

?>