/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ba.fsre.azur;

import java.util.List;
import javax.jws.WebService;
import javax.jws.WebMethod;
import javax.jws.WebParam;

/**
 *
 * @author azur
 */
@WebService(serviceName = "EmployeeService")
public class EmployeeService {

    /**
     *
     * @param employeeId
     * @return
     */
    @WebMethod(operationName = "getEmployeeInfoById")
    public Employee getEmployeeInfo(@WebParam(name = "employeeId") int employeeId) {
        return HrDbConnection.get().getEmployeeInfoById(employeeId);
    }

    /**
     * Web service operation
     *
     * @param employeId
     * @return
     */
    @WebMethod(operationName = "getJobHistoryByEmployeeId")
    public List<Employment> getEmploymentsByEmployeId(@WebParam(name = "employeId") int employeId) {
        return HrDbConnection.get().getJobHistoryByEmployeeId(employeId);
    }

    /**
     * Web service operation
     *
     * @param employeeId
     * @return
     */
    @WebMethod(operationName = "getCurrentJobByEmployeeId")
    public Employment getCurrentJobByEmployeeId(@WebParam(name = "employeId") int employeeId) {
        return HrDbConnection.get().getCurrentJobByEmployeeId(employeeId);
    }
}
