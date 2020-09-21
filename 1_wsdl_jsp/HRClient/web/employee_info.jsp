<%-- 
    Document   : aa
    Created on : 28-Jun-2020, 16:46:14
    Author     : azurh
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Employee Info</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
    </head>
    <body class="container">

        <%
            try{
                ba.fsre.azur.EmployeeService_Service service = new ba.fsre.azur.EmployeeService_Service();
                ba.fsre.azur.EmployeeService port = service.getEmployeeServicePort();
             
                int employeeId = Integer.parseInt(request.getParameter("employee_id"));
            
                ba.fsre.azur.Employee info = port.getEmployeeInfoById(employeeId);
                java.util.List<ba.fsre.azur.Employment> jobHistoryList = port.getJobHistoryByEmployeeId(employeeId);
                ba.fsre.azur.Employment currentJob = port.getCurrentJobByEmployeeId(employeeId);
                
                request.setAttribute("info", info);
                request.setAttribute("jobHistoryList", jobHistoryList);
                request.setAttribute("currentJob", currentJob);
            } catch (Exception e) {
                request.setAttribute("invalid_id", true);
            }
        %>

        <br/>

        <div class="row">
            <c:choose>
                <c:when test="${invalid_id == true}">
                    <h2 style="color:red">Invalid employee ID.</h2>
                </c:when>
                <c:when test="${info != null}">
                    <h2 style="color:blue">
                        Information for employee <strong>${info.getFirstName()} ${info.getLastName()}</strong>
                        (ID: ${info.getEmployeeId() })
                    </h2>
                </c:when>
            </c:choose>
        </div>

        <br/>

        <div class="row">
            <c:choose>
                <c:when test="${jobHistoryList.size() > 0}">
                    <h4>Job history:</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Department</th>
                                <th>Job Title</th>
                                <th>Salary min.</th>
                                <th>Salary max.</th>
                            </tr>
                        </thead>
                        <c:forEach var="department" items="${jobHistoryList}">
                            <tr>
                                <td>${department.getEmployeeId()}</td>
                                <td>${department.getFirstName()}</td>
                                <td>${department.getLastName()}</td>
                                <td>${department.getDepartmentName()}</td>
                                <td>${department.getJobTitle()}</td>
                                <td>${department.getMinSalary()}</td>
                                <td>${department.getMaxSalary()}</td>
                            </tr>
                        </c:forEach>
                    </table>
                </c:when>
                <c:otherwise>
                    <h3 style="color:red">No job history found.</h3>
                </c:otherwise>
            </c:choose>
        </div>

        <br/>

        <div class="row">
            <c:choose>
                <c:when test="${currentJob != null}">
                    <h4>Current job:</h4>
                    <table class="table">
                        <tr>
                            <th>Employee ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Department</th>
                            <th>Job Title</th>
                            <th>Salary min.</th>
                            <th>Salary max.</th>
                        </tr>
                        <tr>
                            <td>${currentJob.getEmployeeId()}</td>
                            <td>${currentJob.getFirstName()}</td>
                            <td>${currentJob.getLastName()}</td>
                            <td>${currentJob.getDepartmentName()}</td>
                            <td>${currentJob.getJobTitle()}</td>
                            <td>${currentJob.getMinSalary()}</td>
                            <td>${currentJob.getMaxSalary()}</td>
                        </tr>
                    </table>
                </c:when>
                <c:otherwise>
                    <h3 style="color:red">No current job found.</h3>
                </c:otherwise>
            </c:choose>
        </div>

    </body>
</html>
