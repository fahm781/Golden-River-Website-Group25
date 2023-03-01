package Connection;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.HashMap;
import java.util.Map;

public class DBproductAndCategory extends DataBaseConn{
	
	public void createProduct(String Category_ID,String Product_Name,int Product_Discount,
			int Product_Price,int Amount,String Description) throws SQLException  {
		
		//Used to create product
		
		String sql="INSERT INTO product (Category_ID,Product_Name,Product_Discount,Product_Price,Amount,Description	) "
				+ "VALUES ('"+Category_ID+"','"+Product_Name+"','"+Product_Discount+"','"+Product_Price+"','"+Amount+"','"+Description+"');";
		
		getStmt().executeUpdate(sql);	
		
		System.out.println("Creation of product was successful..");
		
		//Image is missing!!!!!
		
	}
	
	
	public void createCategory( String Category_Name) throws SQLException  {
		
		//Used to create category
		
		String sql="INSERT INTO category (Category_Name) "
				+ "VALUES ('"+Category_Name+"');";
		
		getStmt().executeUpdate(sql);	
		
		System.out.println("Creation of product was successful..");
		
		//Image is missing!!!!!
		
	}
	

	public HashMap<String,Integer> listOfEndingProducts() throws SQLException{
		
		//Used to make a Hashmap with low stock (stock is low if < 3)
		
		HashMap<String,Integer> records=new HashMap<>();
		String sql="SELECT * FROM product WHERE Amount<4";
		
		
		ResultSet rs = getStmt().executeQuery(sql);
		 while (rs.next()) {
			String IDofProduct=rs.getString("Product_ID");
			Integer amountOfProduct=rs.getInt("Amount");;
			
			 records.put(IDofProduct, amountOfProduct);	 
		 }
		return records;
		
	}
	public HashMap<String,String> listOfProcessingOrders() throws SQLException{
		
		//Used to make a Hashmap of Processing (status of order) orders
		
		HashMap<String,String> records=new HashMap<>();
		String sql="SELECT * FROM orderb WHERE Order_Status='Processing'";
		
		
		ResultSet rs = getStmt().executeQuery(sql);
		 while (rs.next()) {
			String IDofOrder=rs.getString("Order_ID");
			String IDofUser=rs.getString("Account_ID");;
			
			 records.put(IDofOrder, IDofUser);	 
		 }
		return records;
		
	}
}
