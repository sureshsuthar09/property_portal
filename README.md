# property_test

1. Database credentials and api key are stored in config/constant.php
2. Database connection and query are written in db/database.php
2. Insert data API stored in root directory 

			API Name : insert_data.php?api_key=<API KEY VALUE>
			Method : GET

			When Execute from browser : BASE_URL/insert_data.php?api_key=<API KEY VALUE>
			When Execute from cli in root directory : insert_data.php?api_key=<API KEY VALUE>	

3. All Data Listing from root directory's file index.php
4. Filter are given on listing page by(Town, Number Of Bedrooms, Price, Type)
5. Pagination are given on listing page with limit is 10
