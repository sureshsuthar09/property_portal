<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
class DatabaseClass  
{
	private $dbHost=host;  
	private $dbName=db;  
	private $dbUser=username;
	private $dbPassword=password;

   // Define database connection    
   public function __construct(){  
		try {
			$this->dbConn= new PDO("mysql:host=$this->dbHost;dbname=$this->dbName",$this->dbUser,$this->dbPassword);
		}catch(PDOException $e){
			echo "Connection failed: " . $e->getMessage(); exit;
		}
   }

   public function insert_data($data){

    	$insertQry1 = 'insert into property_type (id, property_title, property_description) values(:id,:property_title,:property_description)';
		$insertStatement1 = $this->dbConn->prepare($insertQry1);
		$insertStatement1->execute($data['property_type']);
		 

    	$insertQry2 = 'insert into property (property_type_id,county,country, town, description, address,image,thumbnail,latitude,longitude,number_of_bedrooms,number_of_bathrooms,price,type) values(:property_type_id,:county,:country,:town,:description,:address,:image,:thumbnail,:latitude,:longitude,:number_of_bedrooms,:number_of_bathrooms,:price,:type)';
		$insertStatement2 = $this->dbConn->prepare($insertQry2);

		if($insertStatement2->execute($data['property'])){
		   return true;
		}else{
		   return false;
		}
   }

   public function get_properties($page=null, $filtersData){
   	$query = "select count(id) as count from property";
   	$getStatement1 = $this->dbConn->prepare($query);
		$getStatement1->execute();
		$getResult1 = $getStatement1->fetchAll(\PDO::FETCH_ASSOC);

		$rec_limit = 10;

		if(isset($page ) ) {
			$page_data = $page + 1;
			$offset = ($page - 1)  * $rec_limit;
		}else {
			$page_data = 0;
			$offset = 0;
		}

		$rec_count =  isset($getResult1[0]['count']) ? $getResult1[0]['count'] : 0;

		$left_rec = $rec_count - ($page * $rec_limit);
   	$whereCondition = [];

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

		if(empty($whereCondition)){
		   $whereCondition = '';
		}else{
		   $whereCondition = 'WHERE '.implode(' AND ',$whereCondition);
		}

		
	 	$insertQry = "select property_type.property_title as property_title, property_type.property_description as property_description ,property.id, property.property_type_id, property.country, property.town, property.description, property.address, property.image, property.thumbnail, property.latitude, property.longitude, property.number_of_bedrooms, property.number_of_bathrooms, property.price, property.type FROM property LEFT JOIN property_type ON property.property_type_id =property_type.id $whereCondition LIMIT $offset, $rec_limit";

   		$getStatement = $this->dbConn->prepare($insertQry);
		$getStatement->execute();
		$getResult = $getStatement->fetchAll(\PDO::FETCH_ASSOC);

		return ['data'=>$getResult,'left_rec'=>$left_rec,'total_rec'=>$rec_count];
   }
}