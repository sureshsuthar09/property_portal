<?php
include("db/database.php");
include("config/constant.php");

$api_key = htmlspecialchars($_GET['api_key']);

$totalPage = 2000;

for($i=1; $i<=$totalPage; $i++){

	$url = "https://trial.craig.mtcserver15.com/api/properties?api_key=$api_key&page[number]=$i&page[size]=100"; 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($ch);
	curl_close($ch);

	$result = json_decode($response);

	if(isset($result->status) && $result->status=='error' && isset($result->error)){
		echo json_encode(['success'=>false,'error'=>true,'msg'=>$result->error]);
		break;
	}

	// When found data zero
	if(count($result->data)==0 && $i!=1){
		echo json_encode(['success'=>true,'msg'=>'Data inserted successfully']);
		break;
	}

	// Initialize database connection
	$data = new DatabaseClass();

	// PDO Automatically added sql real escape string when insert data
	if(isset($result->data) && count($result->data)>0){
		foreach ($result->data as $key => $value) {
			$resultData['property'] = [
				'property_type_id'=>$value->property_type_id,
				'county'=>$value->county,
				'country'=>$value->country,
				'town'=>$value->town,
				'description'=>$value->description,
				'address'=>$value->address,
				'image'=>$value->image_full,
				'thumbnail'=>$value->image_thumbnail,
				'latitude'=>$value->latitude,
				'longitude'=>$value->longitude,
				'number_of_bedrooms'=>$value->num_bedrooms,
				'number_of_bathrooms'=>$value->num_bathrooms,
				'price'=>$value->price,
				'type'=>$value->type
			];

			$resultData['property_type'] = [
				'id'=>$value->property_type->id,
				'property_title'=>$value->property_type->title,
				'property_description'=>$value->property_type->description
			];
			$data->insert_data($resultData);
		}
	}else{
		echo json_encode(['success'=>false,'msg'=>'Data not found']);
	}
}
?>