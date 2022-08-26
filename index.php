<?php
include("db/database.php");
include("config/constant.php");

//Current base url
$url = $_SERVER['REQUEST_URI'];

//Condition serch filters
$town = isset($_GET['town']) ? htmlspecialchars($_GET['town']) : '';
$bedrooms = isset($_GET['number_of_bedrooms']) ? htmlspecialchars($_GET['number_of_bedrooms']) : '';
$price = isset($_GET['price']) ? htmlspecialchars($_GET['price']) : '';
$type = isset($_GET['type']) ? htmlspecialchars($_GET['type']) : '';
$filtersData = ['town'=>$town,'number_of_bedrooms'=>$bedrooms,'price'=>$price,'type'=>$type];

// Condition for pagination
if(isset($_GET['page'])) {
	$page = htmlspecialchars($_GET['page']) + 1;
}else {
	$page = 1;
}

// For Database connction & get properties listing
$data = new DatabaseClass;
$result = $data->get_properties($page,$filtersData);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Property Portal</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1"><a href="/" style="text-decoration: none;">Property search Portal</a></span>
  </div>
</nav>
	<div class="container mt-3">
		<h3>Filters:</h3>
			<form action="<?php ?>" method="get">
				<input type="hidden" name="search_filter" value="true">
				<div class="row">
					<div class="col-md-2">
						<label>Town</label>
						<input type="text" name="town" class="form-control">
					</div>
					<div class="col-md-3">
						<label>Number of Bedrooms</label>
						<select class="form-control" name="number_of_bedrooms">
							<option value=""></option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
						</select>
					</div>
					<div class="col-md-2">
						<label>Price</label>
						<select class="form-control" name="price">
							<option value=""></option>
							<option value="1000">1000</option>
							<option value="3000">3000</option>
							<option value="7000">7000</option>
							<option value="10000">10000</option>
							<option value="15000">15000</option>
							<option value="20000">20000</option>
							<option value="25000">25000</option>
						</select>
					</div>
					<div class="col-md-2">
						<label>Property Type</label>
						<select class="form-control" name="type">
							<option value=""></option>
							<option value="sale">Sale</option>
							<option value="rent">Rent</option>					
						</select>
					</div>
					<div class="col-md-2">
						<input type="submit" value="Filter" class="btn btn-primary mt-4">
					</div>
				</div>
			</form>
		<?php if(!empty($result['data'])){ ?>	
		<div class="row mt-5" >
			<?php foreach ($result['data'] as $key=>$value) { ?>
				<div class="col-md-6 col-sm-6 col-lg-6 mt-3 col-xs-12">
						<div class="card">
						<div class="row">
							<div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
					 			<img src="<?php echo $value['image'] ?>" style="object-fit: cover; width: 100%;" class="card-img-top" alt="...">
					 			<ul class="list-group mt-2">
							    <li class="list-group-item"><label>Number of Bedrooms : </label><b><?php echo $value['number_of_bedrooms']?></b></li>
							    	<li class="list-group-item"><label>Number of Bathrooms : </label><b><?php echo $value['number_of_bathrooms']?></b></li>
							    </ul>
							</div>
							<div class="col-md-6 col-sm-6 col-lg-6 pt-3 col-xs-6">
							  	<span class="badge bg-secondary" style="float: right;"><?php echo ucfirst($value['type']); ?></span>
							   <h5 class="card-title"><?php echo substr($value['property_title'], 0, 30); ?></h5>
							   <p class="card-text"><?php echo substr($value['property_description'], 0, 170) . '...'; ?></p>			    
							  	<div class="mt-4">
							  		<label>Price : <b><?php echo $value['price']; ?></b></label>
							  </div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="row mt-4" style="margin-bottom: 25px;">
			<div class="col-md-5">
				<?php

					if(isset($_GET['page'])){
						$url = substr($url, 0, strpos($url, "page") - 1);
					}

					if(isset($_GET['search_filter'])){
						$url = $url.'&page=';
					}else{
						if(isset($_GET['page']) && !isset($_GET['search_filter'])){
							$url = $url."?page=";
						}else{
							$url = $url."?page=";
						}
					}

					if( $page > 1 && ($result['left_rec'] > 0) ) {
						$last = $page - 2;
						$page_previous = $page-2;
						$page_next = $page;
						echo "<a href = \"$url$last\" class='btn btn-sm btn-primary'>Previous Page $page_previous</a> | ";
						echo "<a href = \"$url$page\" class='btn btn-sm btn-primary'>Next Page $page_next</a>";
				  	}else if( $page == 1 ) {
						echo "<a href = \"$url$page\" class='btn btn-sm btn-primary'>Next Page $page</a>";
					}else if( $result['left_rec'] <= 0 ) {
						$last = $page - 2;
						$page_pre = $page-2;
						echo "<a href = \"$url$last\" class='btn btn-sm btn-primary'>Previous Page $page_pre</a>";
					}
					echo " Total Records: ".$result['total_rec'];
				?>
			</div>
		</div>
	<?php }else{?>
		<div class="row d-flex justify-content-center">
			<div class="col-md-6 mt-5 text-center">
				<div class="alert alert-danger" role="alert">
				 	Records not found. Try with other filters
				</div>
			</div>
		</div>
	<?php } ?>
	</div>
	<script type="text/javascript">
		$('[name="town"]').val("<?php echo $town ?>");
		$('[name="number_of_bedrooms"]').val("<?php echo $bedrooms ?>");
		$('[name="price"]').val("<?php echo $price ?>");
		$('[name="type"]').val("<?php echo $type ?>");
	</script>
</body>

</html>