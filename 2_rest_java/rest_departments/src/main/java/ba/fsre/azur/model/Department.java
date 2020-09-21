package ba.fsre.azur.model;

import lombok.Data;
import lombok.NoArgsConstructor;

import javax.persistence.*;

@Data
@NoArgsConstructor
@Entity
@Table(name = "departments")
public class Department {

    @Id
    @GeneratedValue
    private Integer department_id;

    private String department_name;

    private Integer manager_id;

    private Integer location_id;

}
