package GUIs;

import javax.swing.*;
import javax.swing.table.DefaultTableModel;

import Connection.DBaccount;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.FlowLayout;
import java.awt.Font;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.FocusAdapter;
import java.awt.event.FocusEvent;


public class UserTableGUI extends JFrame implements ActionListener{

    private JTable table;
    private DefaultTableModel model;
    private JButton infoUF;
    private JTextField userFinder;
    private JLabel userFinderLbl;

    public UserTableGUI() throws SQLException{
        setTitle("All Users");
        setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
        setSize(1400, 600);
        setLocationRelativeTo(null);

        // Create table model
        model = new DefaultTableModel();
        table = new JTable(model);
     // Increase font size for table
        Font tableFont = new Font(table.getFont().getName(), Font.PLAIN,15);
        table.setFont(tableFont);

        // Add columns to the table model
        model.addColumn("ID");
        model.addColumn("Name");
        model.addColumn("Email");
        model.addColumn("Phone Number");
        model.addColumn("User Status");
        model.addColumn("Created At");
        model.addColumn("Updated At");

        // Add data to the table model
        try {
        	DBaccount dba = new DBaccount();
            ResultSet rs = dba.getUsers();
            while (rs.next()) {
                Object[] row = new Object[]{
                        rs.getInt("id"),
                        rs.getString("name"),
                        rs.getString("email"),
                        rs.getString("Phone_Number"),
                        rs.getString("User_Status"),
                        rs.getString("created_at"),
                        rs.getString("updated_at")
                };
                model.addRow(row);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
      
       
        
        JPanel searchPanel = new JPanel(new FlowLayout(FlowLayout.LEFT));
        userFinderLbl = new JLabel("Enter User ID To Edit User");
        infoUF=new JButton("Edit User");
        userFinder = new JTextField(" Edit User Using User ID ");
        userFinder.setCaretPosition(0);
        userFinder.setForeground(Color.GRAY);

        // Add a focus listener to clear the placeholder text when the field is clicked
        userFinder.addFocusListener(new FocusAdapter() {
                @Override
                public void focusGained(FocusEvent e) {
                    if (userFinder.getText().equals(" Edit User Using User ID ")) {
                    	userFinder.setText("");
                    	userFinder.setForeground(Color.BLACK);
                    }
                }

                @Override
                public void focusLost(FocusEvent e) {
                    if (userFinder.getText().isEmpty()) {
                    	userFinder.setForeground(Color.GRAY);
                    	userFinder.setText(" Edit User Using User ID ");
                    }
                }
            });
        
        searchPanel.add(userFinderLbl);
        searchPanel.add(userFinder);
        searchPanel.add(infoUF);
        infoUF.addActionListener(this);
        
        add(searchPanel, BorderLayout.NORTH);
        add(new JScrollPane(table));

        setVisible(true);
    }
    
    @Override
    public void actionPerformed(ActionEvent e) {
    	if(e.getSource()==infoUF) {
		try {
			new EditUserGUI(userFinder.getText());
		} catch (SQLException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}
	}
    }

//Remove this main method once testing is done
    public static void main(String[] args) throws SQLException {
        new UserTableGUI();
    }
}