package ba.fsre.azur.controller;

import ba.fsre.azur.model.Department;
import ba.fsre.azur.repository.DepartmentsRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import javax.validation.Valid;
import java.util.List;
import java.util.Optional;

@RestController
public class DepartmentsController {

    @Autowired
    DepartmentsRepository departmentsRepo;

    @GetMapping("/departments")
    public List<Department> getAllDepartments() {
        return departmentsRepo.findAll();
    }

    @GetMapping("/departments/{id}")
    public Department getNoteById(@PathVariable(value = "id") Integer departmentId) throws IllegalStateException {
        return departmentsRepo.findById(departmentId).orElseThrow(() ->
                new IllegalStateException(String.format("No department found with ID %s.", departmentId)));
    }

    @PostMapping(path = "/departments", consumes = "application/json")
    public ResponseEntity<Department> createDepartment(@Valid @RequestBody Department department) {
        departmentsRepo.save(department);
        return ResponseEntity
                .status(HttpStatus.CREATED)
                .body(department);
    }

    @PutMapping(path = "/departments", consumes = "application/json")
    public ResponseEntity<Department> updateDepartment(@Valid @RequestBody Department updatedDepartment) {
        Optional<Department> department = departmentsRepo.findById(updatedDepartment.getDepartment_id());
        department.get().setDepartment_name(updatedDepartment.getDepartment_name());
        departmentsRepo.save(department.get());
        return ResponseEntity
                .status(HttpStatus.OK)
                .body(department.get());
    }

    @DeleteMapping("/departments/{id}")
    public ResponseEntity<Object> deleteDepartment(@PathVariable(value = "id") Integer departmentId) {
        departmentsRepo.deleteById(departmentId);
        return ResponseEntity
                .status(HttpStatus.NO_CONTENT)
                .build();

    }
}
