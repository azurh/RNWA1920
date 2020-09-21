package ba.fsre.azur;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

/**
 *
 * @author azur
 */
public class HrDbConnection {

    private static HrDbConnection sInstance;
    private Connection connection;

    private HrDbConnection() {
        initConnection();
    }

    public static HrDbConnection get() {
        if (sInstance == null) {
            sInstance = new HrDbConnection();
        }
        return sInstance;
    }

    private void initConnection() {

        try {
            // The newInstance() call is a work around for some
            // broken Java implementations

            Class.forName("com.mysql.jdbc.Driver").newInstance();
        } catch (Exception ex) {

        }

        try {
            connection = DriverManager.getConnection("jdbc:mysql://localhost:8889/hr?useSSL=false&serverTimezone=UTC", "azur", "azur");
        } catch (SQLException e) {

        }
    }

    public Employee getEmployeeInfoById(int id) {
        try {
            String sql = "SELECT * FROM hr.v_employee_info where employee_id = " + id + ";";
            PreparedStatement ps = connection.prepareStatement(sql);
            ResultSet rs = ps.executeQuery();
            Employee e = new Employee();
            while (rs.next()) {
                e.setEmployee_id(rs.getInt("employee_id"));
                e.setFirst_name(rs.getString("first_name"));
                e.setLast_name(rs.getString("last_name"));
            }
            return e;
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }

    public List<Employment> getJobHistoryByEmployeeId(int id) {
        try {
            String sql = "SELECT * FROM hr.v_job_history where employee_id = " + id + ";";
            PreparedStatement ps = connection.prepareStatement(sql);
            ResultSet rs = ps.executeQuery();
            List<Employment> list = new ArrayList();
            while (rs.next()) {
                Employment employment = new Employment();
                employment.setEmployee_id(rs.getInt("employee_id"));
                employment.setFirst_name(rs.getString("first_name"));
                employment.setLast_name(rs.getString("last_name"));
                employment.setDepartment_name(rs.getString("department_name"));
                employment.setJob_title(rs.getString("job_title"));
                employment.setMin_salary(rs.getDouble("min_salary"));
                employment.setMax_salary(rs.getDouble("max_salary"));
                list.add(employment);
            }
            return list;
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }

    public Employment getCurrentJobByEmployeeId(int id) {
        try {
            String sql = "SELECT * FROM hr.v_current_job where employee_id = " + id + ";";
            PreparedStatement ps = connection.prepareStatement(sql);
            ResultSet rs = ps.executeQuery();
            Employment employment = new Employment();
            while (rs.next()) {
                employment.setEmployee_id(rs.getInt("employee_id"));
                employment.setFirst_name(rs.getString("first_name"));
                employment.setLast_name(rs.getString("last_name"));
                employment.setDepartment_name(rs.getString("department_name"));
                employment.setJob_title(rs.getString("job_title"));
                employment.setMin_salary(rs.getDouble("min_salary"));
                employment.setMax_salary(rs.getDouble("max_salary"));
            }
            return employment;
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }

}
