Migrate-mysql-to-noSQL database style using MySQL and PHP

Restructuring the MySQL database to NoSQL style 

/*
 * Program developed by "Rushdi Mohamed (PHP Dev.)"
 * 
 * Create Year : 2021, June
 *  
 * Program 
 * 
 * Update mysql database into noSQL database style with php
 */


Features

Reducing the columns 

Use of JSON Objects 

PHP scripts 



Program 

Update mysql database into noSQL database style with php

1. Steps to follow on database end 

Example database and table

database_name	- test_db

table_name		- test_table(id,name, col_1, col_2, col_3, col_4, col_5, status, created_at, updated_at);

//col_* can be null so we are going to replace it all with one JSON column

* add a new colum to the database with JSON datatype and set it default as NULL

  //ALTER TABLE table_name ADD all_data JSON NULL DEFAULT NULL AFTER updated_at;

    //test_table(id,name, col_1, col_2, col_3, col_4, col_5, status, created_at, updated_at, all_data);


* If there is a update_at column(timestamp autoupdate on data change) the remove the on change  
	
  //ALTER TABLE table_name CHANGE updated_at updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

    //test_table(id,name, col_1, col_2, col_3, col_4, col_5, status, created_at, updated_at, all_data);
 

2. Development process on PHP

Files structure 

/connection.php

/functions.php

/test.php

-> Connection.php has the database connection

-> functions.php includes the main functions

-> test.php run the file to update the changes

Check the files


3. Steps to follow on database end at the end

* Drop the unwanted columns now from the table (remove the col_*)

  //ALTER TABLE table_name DROP col_1, DROP col_2, DROP col_3, DROP col_4, DROP col_5;
    
    //test_table(id, name, status, created_at, updated_at, all_data);

* Atlast again if there is any update_at column, then set it back to update the time on change 
	
  //ALTER TABLE table_name CHANGE updated_at updated_at TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

    //test_table(id,name, status, created_at, updated_at, all_data);

The End!!!
