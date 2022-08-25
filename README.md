# property_portal

1. First need to set api_key get parameter in base URL 
2. All Credentials are save in config/constant.php file(api key and db creds)
3. Database sql file is saved into root folder
4. Insert API link is : 
		Link : base_URL/insert_api.php
		Type : POST
		Parameter : country,town,description,address,image(file),thumbnail(file),latitude,longitude,number_of_bedrooms,number_of_bathrooms,price,type(sale,rent),property_type,property_description(All Parameter are required)
		Header : set api_key and their value into header
5. List all property listing data from root url
6. Filter are given by(Town, Number Of Bedrooms)
7. Pagination are given with limit is 4