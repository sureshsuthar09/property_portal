<?php
// print_r($_POST);
include("db/database.php");
// echo $_SERVER['REQUEST_METHOD'];
// print_r(getallheaders()); exit;

$filename = '';
$error = [];
// $data_property = '';
if(isset($_FILES['image'])){
  $data['image'] =  fileUpload($_FILES['image']);
}else{
   $error['image'] = 'image is country';
}

if(isset($_FILES['thumbnail'])){
    $data['thumbnail'] =fileUpload($_FILES['thumbnail']);
}else{
   $error['thumbnail'] = 'thumbnail is country';
}

if(isset($_POST['country']) && $_POST['country']!=''){
   $data['country'] = $_POST['country'];
}else{
   $error['country'] = 'country is country';
}

if(isset($_POST['town'])){
   $data['town'] = $_POST['town'];
}else{
   $error['town'] = 'Town is required';
}

if(isset($_POST['description'])){
   $data['description'] = $_POST['description'];
}else{
   $error['description'] = 'description is required';
}


if(isset($_POST['address'])){
   $data['address'] = $_POST['address'];
}else{
   $error['address'] = 'address is required';
}


if(isset($_POST['latitude'])){
   $data['latitude'] = $_POST['latitude'];
}else{
   $error['latitude'] = 'latitude is required';
}


if(isset($_POST['longitude'])){
   $data['longitude'] = $_POST['longitude'];
}else{
   $error['longitude'] = 'longitude is required';
}


if(isset($_POST['number_of_bedrooms']) && is_numeric($_POST['number_of_bedrooms'])){
   $data['number_of_bedrooms'] = $_POST['number_of_bedrooms'];
}else{
   $error['number_of_bedrooms'] = 'number_of_bedrooms is required';
}


if(isset($_POST['number_of_bathrooms']) && is_numeric($_POST['number_of_bathrooms'])){
   $data['number_of_bathrooms'] = $_POST['number_of_bathrooms'];
}else{
   $error['number_of_bathrooms'] = 'Number of bathrooms is required';
}


if(isset($_POST['price']) && is_numeric($_POST['price'])){
   $data['price'] = $_POST['price'];
}else{
   $error['price'] = 'Price is required';
}


if(isset($_POST['property_type'])){
   $data_property['property_type'] = $_POST['property_type'];
}else{
   $error['property_type'] = 'Property type is required';
}


if(isset($_POST['property_description'])){
   $data_property['property_description'] = $_POST['property_description'];
}else{
   $error['property_description'] = 'Property description is required';
}


if(isset($_POST['type']) && in_array($_POST['type'],['rent','sale']) ){
   $data['type'] = $_POST['type'];
}else if(isset($_POST['type']) && !in_array($_POST['type'],['rent','sale']) ){
   $error['type'] = 'Type must be rent or sale only';
}else{
   $error['type'] = 'Type is required';
}

if(count($error)==0){
   // echo "<pre>"; 
   // print_r($data_property);
   // echo "</pre>";
   // exit;

   // For Database connction
   $object = new DatabaseClass;
   $last_id = $object->insert('property_type',$data_property);
   $data['property_type_id '] = $last_id;
   $result = $object->insert('property',$data);
   if($result){
      echo 'Data insered successfully';
   }else{
      echo 'Data not insered property';
   }

}else{
   echo "<pre>"; 
   print_r($error);
   echo "</pre>";
   exit;
}

function fileUpload($filedata){
   $errors= array();
   $file_name = $filedata['name'];
   $file_size = $filedata['size'];
   $file_tmp = $filedata['tmp_name'];
   $file_type = $filedata['type'];
   $file_ext = explode('.',$file_name);
   $file_ext = strtolower(end($file_ext));

   $extensions= array("jpeg","jpg","png");

   if(in_array($file_ext,$extensions)=== false){
      $errors['erros'] = true;
      $errors['image_error']="extension not allowed, please choose a JPEG or PNG file.";
   }

   if(empty($errors)==true){
      $filename = "assets/images/".date('YmdHis').'.'.$file_ext;
      move_uploaded_file($file_tmp,$filename);
      return $filename;
   }else{
      return $errors;
   }
}
