package Connection;

import java.sql.SQLException;

import java.sql.ResultSet;


public class DBorder extends DataBaseConn{
	
	public void changeStatusOfOrder(String ID, int Status) throws SQLException {
		// used to change status of the order 
		//requires id of order and
		//new status as an int (statusMaker)=> String
		
		String StatusSQL= statusMaker(Status);
		
		String sql= "UPDATE orderb "
				+ "SET Order_Status = '"+StatusSQL+"' "
				+ "WHERE Order_ID="+ID+";";
		
		getStmt().executeUpdate(sql);
		
		System.out.println("Change of status for order was successful..");
		
	}
	
	public String statusMaker(int Status) {
		
		//Used to set a status
		// 1 - Processing
		// 2 - Shipped
		// 3 - Delivered
		// 4 - Canceled
		
		String StatusSQL;
		
		switch(Status) {
		case 1:
			StatusSQL="Processing";
			break;
		case 2:
			StatusSQL="Shipped";
			break;
		case 3:
			StatusSQL="Delivered";
			break;
		case 4:
			StatusSQL="Canceled";
			break;
		default:
			throw new IllegalStateException("Unknown parameter for Status (1 for Processing or "
					+ "2 for Shipped or 3 for Delivered or 4 Canceled)");
		}
		
		return StatusSQL;
		
	}
	
	public ResultSet getAllOrders() throws SQLException {
		String sql = "SELECT * FROM orderb WHERE Order_Status <> 'Basket'";
	    ResultSet rs = getStmt().executeQuery(sql);
	    return rs;
	}
	
	public ResultSet getOrderById(String ID) throws SQLException {
	  String sql = "SELECT * FROM linked_product_order WHERE Order_ID='"+ID+"'";
	  ResultSet rs = getStmt().executeQuery(sql);
      return rs;
	}
	

}
