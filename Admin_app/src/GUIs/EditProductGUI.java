package GUIs;

import java.awt.BorderLayout;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.IOException;
import java.sql.ResultSet;
import java.sql.SQLException;

import javax.swing.BorderFactory;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JTextField;

import Connection.DBproductAndCategory;
import java.awt.Color;
import java.awt.Component;
import javax.swing.Box;
import java.awt.Dimension;


public class EditProductGUI implements ActionListener {
	private JFrame frame;
	private JPanel panel;
	private JButton EditPr_B,Edit_Image_B;
	private JLabel Product_Name_L,Product_Price_L,Amount_L,Description_L,ID_L;
	private JTextField Product_Name_T,Product_Price_T,Amount_T,Description_T,ID_T;
	DBproductAndCategory DBPC;
	String ID;
	private Component verticalStrut;
	private JLabel lblNewLabel;
	
	EditProductGUI(String ID) throws SQLException{
		this.ID=ID;
		
	frame=new JFrame();
	frame.setIconImage(ImageIconMaker.createImageIcon());
	panel = new JPanel();
	panel.setBackground(new Color(255, 228, 181));
	panel.setBorder(BorderFactory.createEmptyBorder(30,30,10,30));
	panel.setLayout(new GridLayout(0,1));
    DBPC= new DBproductAndCategory();
	ResultSet rs = DBPC.findProduct(ID);
	//rs.next();
	
	ID_L = new JLabel("ID: "+ID);
	panel.add(ID_L);
	
	Product_Name_L = new JLabel("Name: "+rs.getString("Product_Name"));
	panel.add(Product_Name_L);
	
	Product_Name_T = new JTextField(30);
	panel.add(Product_Name_T);
	
	Product_Price_L = new JLabel("Price: "+rs.getString("Product_Price"));
	panel.add(Product_Price_L);
	
	Product_Price_T = new JTextField(30);
	panel.add(Product_Price_T);
	
	Amount_L = new JLabel("Amount: "+rs.getString("Amount"));
	panel.add(Amount_L);
	
	Amount_T = new JTextField(30);
	panel.add(Amount_T);
	
	Description_L = new JLabel("Description: "+rs.getString("Description"));
	panel.add(Description_L);
	
	Description_T = new JTextField(30);
	panel.add(Description_T);
	
	lblNewLabel = new JLabel("Add Image");
	panel.add(lblNewLabel);
	
	Edit_Image_B = new JButton("Edit image");
	Edit_Image_B.setPreferredSize(new Dimension(0,25));
	panel.add(Edit_Image_B);
	Edit_Image_B.addActionListener(this);
	
	verticalStrut = Box.createVerticalStrut(10);
	panel.add(verticalStrut);
	
	EditPr_B=new JButton("Edit product");
	panel.add(EditPr_B);
	EditPr_B.addActionListener(this);
	
	
	frame.getContentPane().add(panel,BorderLayout.CENTER);
	frame.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
	frame.setTitle("Edit a Product");
	frame.pack();
	frame.setVisible(true);
	frame.setResizable(false);
}
	
	
	public static String removeLastChar(String s) {
	    return (s == null || s.length() == 0)
	      ? null 
	      : (s.substring(0, s.length() - 1));
	}
	@Override
	public void actionPerformed(ActionEvent e) {
	if(e.getSource()==Edit_Image_B) {
		
		try {
			DBPC.editImageOfProduct( ID);
			
			
			
		} catch (IOException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
			JOptionPane.showMessageDialog(null,
	                e1,
	                "Sys",
	                JOptionPane.INFORMATION_MESSAGE);
			
		}
	}
		 if(e.getSource()==EditPr_B) {
			 String sql1="";
			
			 //check negative
			 
			 
			 //
			 try {
			if(!Product_Name_T.getText().equals("")) {
				sql1=sql1+"Product_Name="+"'"+Product_Name_T.getText()+"'"+",";
				}
			
			if(!Product_Price_T.getText().equals("")) {
				sql1=sql1+"Product_Price="+"'"+Product_Price_T.getText()+"'"+",";
				
				if(Integer.parseInt(Product_Price_T.getText())<0  ) {throw new IllegalStateException("Negative numbers cannot be accepted!");}
			}
			
			if(!Amount_T.getText().equals("")) {
				sql1=sql1+"Amount="+"'"+Amount_T.getText()+"'"+",";	
				if(Integer.parseInt(Amount_T.getText())<0 ) {throw new IllegalStateException("Negative numbers cannot be accepted!");}
			}
			
			if(!Description_T.getText().equals("")) {
				sql1=sql1+"Description="+"'"+Description_T.getText()+"'"+",";
			}
		
			if(sql1!="")
				try {
					DBPC.editProduct(removeLastChar(sql1),ID);
					
					JOptionPane.showMessageDialog(null,
			                "Has been updated!",
			                "Sys",
			                JOptionPane.INFORMATION_MESSAGE);
					
				} catch (SQLException e1) {
					// TODO Auto-generated catch block
					e1.printStackTrace();
					JOptionPane.showMessageDialog(null,
			                e1,
			                "Sys",
			                JOptionPane.INFORMATION_MESSAGE);
				}
			frame.dispose();
	 }catch(Exception et){
				 
				 JOptionPane.showMessageDialog(null,
			                "Error: "+et,
			                "Sys",
			                JOptionPane.INFORMATION_MESSAGE);
			 }
		}
	}
	public JFrame getFrame () {
		return frame;
	}
}
