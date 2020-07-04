<?php

     error_reporting(0);

     $Cmyfile1 = fopen("All_Done.txt", "w") or die("Unable to open file!");
     fwrite($Cmyfile1, "NotDOne");
     
     $Aconn = mysqli_connect("localhost", "root", "", "demo");
	$Asql_fetch_sale = "SELECT * FROM temp_sales_tbl";
     $Afire_Sale = mysqli_query($Aconn, $Asql_fetch_sale);

     $year = date("yy");
     $month = date("m");

     $AnumRows = mysqli_num_rows($Afire_Sale);
     if($AnumRows > 0){ 
          //starting if------------------------------------

          $Amyfile = fopen("Check_Sale_Empty.txt", "w") or die("Unable to open file!");
          $txt = "no";
          fwrite($Amyfile, $txt);





		// inserting data to sales table
		function moveToSales(){	// moveToSales() start
			$_2_conn = mysqli_connect("localhost", "root", "", "demo");
			$_2_sql = "SELECT * FROM temp_sales_tbl";
			$_2_fire = mysqli_query($_2_conn,$_2_sql);

			while ($_2_row = mysqli_fetch_assoc($_2_fire)) {
				//echo $_2_row['Invoice']."<br>";
				$a = $_2_row['Invoice'];
				//echo $_2_row['Name']."<br>";
				$b = $_2_row['Name'];
				//echo $_2_row['Catagory']."<br>";
				$c = $_2_row['Catagory'];
				//echo $_2_row['UnitWeight']."<br>";
				$d = $_2_row['UnitWeight'];
				//echo $_2_row['Saleprice']."<br>";
				$e = $_2_row['Saleprice'];
				//echo $_2_row['BoughtUnit']."<br>";
				$f = $_2_row['BoughtUnit'];
				//echo $_2_row['Total']."<br>";
				$g = $_2_row['Total'];
				//echo $_2_row['Saledate']."<br>";
				$h = $_2_row['Saledate'];
				//echo $_2_row['year']."<br>";
				$i = $_2_row['year'];
				//echo $_2_row['month']."<br>";
				$j = $_2_row['month'];
				//echo "<br>-----<br>";
				
				$_2_insert_sale_sql = "INSERT INTO sale (Invoice,Name,Catagory,UnitWeight,Saleprice,BoughtUnit,Total,Saledate,year,month) VALUES ('$a','$b','$c','$d','$e','$f','$g','$h','$i','$j')";

				$_2_fire_sale = mysqli_query($_2_conn, $_2_insert_sale_sql);

				//echo "<br>INSERTED<br>";
			
			}

			mysqli_close($_2_conn);	// closing connection

		}// moveToSales() end


		function findProfit(){

			$_2_conn = mysqli_connect("localhost", "root", "", "demo");
			$_2_sql = "SELECT * FROM temp_sales_tbl";
			$_2_fire = mysqli_query($_2_conn,$_2_sql);

			$invoice = "";
			$sum = 0;
			$dat = "";
			$mon = "";
			$yea = "";


			while ($_2_row = mysqli_fetch_assoc($_2_fire)) {
			//	echo $_2_row['Invoice']."<br>";
				$a = $_2_row['Invoice'];
				$invoice = $a;
			//	echo $_2_row['Name']."<br>";
				$b = $_2_row['Name'];
			//	echo $_2_row['Catagory']."<br>";
				$c = $_2_row['Catagory'];
			//	echo $_2_row['UnitWeight']."<br>";
				$d = $_2_row['UnitWeight'];
			//	echo $_2_row['Saleprice']."<br>";
				$e = $_2_row['Saleprice'];
			//	echo $_2_row['BoughtUnit']."<br>";
				$f = $_2_row['BoughtUnit'];
			//	echo $_2_row['Total']."<br>";
				$g = $_2_row['Total'];
			//	echo $_2_row['Saledate']."<br>";
				$h = $_2_row['Saledate'];
				$dat = $h;

			//	echo $_2_row['year']."<br>";
				$i = $_2_row['year'];
				$yea = $i;


			//	echo $_2_row['month']."<br>";
				$j = $_2_row['month'];
				$mon = $j;
				
				
				$_2_fetch_product_detail = "SELECT * FROM product WHERE name = '$b'";

				$_2_fire_product_detail = mysqli_query($_2_conn, $_2_fetch_product_detail);

				$_2_row_data_product = mysqli_fetch_assoc($_2_fire_product_detail);




			//	echo "<br>Name ".$_2_row_data_product['name']."<br>";
			//	echo "<br>Purchase ".$_2_row_data_product['purchase_per_unit']."<br>";
			//	echo "<br>Sale ".$_2_row_data_product['sale_per_unit']."<br>";

				$TotalSalePriceWithBoughtUnits = $f*$_2_row_data_product['sale_per_unit'];
			//	echo "<br>Sale Price : ".$TotalSalePriceWithBoughtUnits;

				$TotalPurchasePriceWithBoughtUnits = $f*$_2_row_data_product['purchase_per_unit'];
			//	echo "<br>Purchase Price : ".$TotalPurchasePriceWithBoughtUnits;

				$profit =  $TotalSalePriceWithBoughtUnits-$TotalPurchasePriceWithBoughtUnits;
			//	echo "<br>Profit : ".$profit;
			//	echo "<br>-----<br>";
				$sum = $sum + $profit;
			
			}//END OF WHILE
			//echo "<br>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx<br>";
			//	echo "<br>invoice : ".$invoice;
			//	echo "<br>profit : ".$sum;
			//	echo "<br>date : ".$dat;
			//	echo "<br>month : ".$mon;
			//	echo "<br>year : ".$yea;
				$_2_sql_insert_profit = "INSERT INTO sales_profit (Invoice,Profit,Datee,year,month) VALUES('$invoice','$sum','$dat','$yea','$mon')";

				$FINAL = mysqli_query($_2_conn, $_2_sql_insert_profit);
			//echo "<br>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";


			mysqli_close($_2_conn);	
		}



		function UpdateProduct(){
			$_2_conn = mysqli_connect("localhost", "root", "", "demo");
			$_2_sql = "SELECT * FROM temp_sales_tbl";
			$_2_fire = mysqli_query($_2_conn,$_2_sql);

			while ($_2_row = mysqli_fetch_assoc($_2_fire)) {

			//echo $_2_row['Name']."<br>";
			$b = $_2_row['Name'];

			echo $_2_row['BoughtUnit']."<br>";
			$f = $_2_row['BoughtUnit'];





			$sql_select_product = "SELECT * FROM product WHERE name = '$b'";
			$fire_select_product = mysqli_query($_2_conn, $sql_select_product);

			$rowdata = mysqli_fetch_assoc($fire_select_product);

			$pname = $rowdata['name'];
			$quantity = $rowdata['Purchased_unit'];

			//echo "<br>Name : ".$pname;
			//echo "<br>Quantity : ".$quantity;

			$finalQuantity = (int)$quantity - (int)$f;

			//echo "<br>Remaining : "+$finalQuantity."<br>";


			$sql_update_product = "UPDATE product SET Purchased_unit = '$finalQuantity' WHERE name = '$pname'";
			$FINAL = mysqli_query($_2_conn, $sql_update_product);




			//echo "<br>oooooooooooooooooooooooooooooooooooooooooooooooooooooooooo<br>";






			}	// end of while
		}	//end of update product



          moveToSales();
         // echo "<br>fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff<br>";
          findProfit();
         // echo "<br>fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff<br>";
          UpdateProduct();
          
          
          
          
          
          
          











          $invoice_number_file = file_get_contents("Invoice.txt");
          $toInt = (int)$invoice_number_file;
          $toInt++;
          $Cmyfile = fopen("Invoice.txt", "w") or die("Unable to open file!");
          fwrite($Cmyfile, $toInt);




          $Cmyfile1 = fopen("All_Done.txt", "w") or die("Unable to open file!");
          fwrite($Cmyfile1, "Done");








     } //closing if------------------------------------
          
     else {
          $Amyfile = fopen("Check_Sale_Empty.txt", "w") or die("Unable to open file!");
          $txt = "yes";
          fwrite($Amyfile, $txt);

     }
?>

