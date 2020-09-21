/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ba.fsre.azur;

import java.util.Objects;

/**
 *
 * @author azur
 */
public class Employment {

    private Integer employee_id;
    private String first_name;
    private String last_name;
    private String department_name;
    private String job_title;
    private Double min_salary;
    private Double max_salary;

    public Integer getEmployee_id() {
        return employee_id;
    }

    public void setEmployee_id(Integer employee_id) {
        this.employee_id = employee_id;
    }

    public String getFirst_name() {
        return first_name;
    }

    public void setFirst_name(String first_name) {
        this.first_name = first_name;
    }

    public String getLast_name() {
        return last_name;
    }

    public void setLast_name(String last_name) {
        this.last_name = last_name;
    }

    public String getDepartment_name() {
        return department_name;
    }

    public void setDepartment_name(String department_name) {
        this.department_name = department_name;
    }

    public String getJob_title() {
        return job_title;
    }

    public void setJob_title(String job_title) {
        this.job_title = job_title;
    }

    public Double getMin_salary() {
        return min_salary;
    }

    public void setMin_salary(Double min_salary) {
        this.min_salary = min_salary;
    }

    public Double getMax_salary() {
        return max_salary;
    }

    public void setMax_salary(Double max_salary) {
        this.max_salary = max_salary;
    }

    @Override
    public int hashCode() {
        int hash = 7;
        hash = 79 * hash + Objects.hashCode(this.employee_id);
        return hash;
    }

    @Override
    public boolean equals(Object obj) {
        if (this == obj) {
            return true;
        }
        if (obj == null) {
            return false;
        }
        if (getClass() != obj.getClass()) {
            return false;
        }
        final Employment other = (Employment) obj;
        if (!Objects.equals(this.employee_id, other.employee_id)) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        StringBuilder sb = new StringBuilder();
        sb.append("Employment{employee_id=").append(employee_id);
        sb.append(", first_name=").append(first_name);
        sb.append(", last_name=").append(last_name);
        sb.append(", department_name=").append(department_name);
        sb.append(", job_title=").append(job_title);
        sb.append(", min_salary=").append(min_salary);
        sb.append(", max_salary=").append(max_salary);
        sb.append('}');
        return sb.toString();
    }

}
