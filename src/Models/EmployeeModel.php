<?php

namespace Src\Models;

use Core\Model;
use \PDO;

class EmployeeModel extends Model 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCurrentEmployee( $id_employee): array
    {
        $query = "SELECT * FROM employees AS e
        JOIN salaries AS s ON e.id_employee = s.id_employee
        JOIN positions AS p ON e.id_position = p.id_position
        WHERE e.id_employee = :id_employee";

        $stmt = $this->db->prepare($query);
        $stmt->execute(
            [
                ':id_employee' => $id_employee
            ]
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOneSalary(int|string $id_salary) 
    {
        $query = "SELECT * FROM employees AS e
        JOIN salaries AS s ON e.id_employee = s.id_employee
        JOIN positions AS p ON e.id_position = p.id_position
        WHERE s.id = :id_salary";

        $stmt = $this->db->prepare($query);
        $stmt->execute(
            [
                ':id_salary' => $id_salary
            ]
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEmployee($id_employee)
    {
        $query = "SELECT * FROM employees AS e 
        INNER JOIN positions as p ON e.id_position = p.id_position 
        WHERE e.id_employee = :id_employee";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':id_employee' => $id_employee
        ]);
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) < 5) {
            return $result[0];
        }
        return $result;
    }

    public function countRow($id_employee) 
    {
        $query = "SELECT COUNT(*) FROM salaries WHERE id_employee = :id_employee";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':id_employee' => $id_employee
        ]);
        
        return (int)$stmt->fetchColumn();
    }

    // для обрахунку ЗП
    function getCurrentPosition(int|string $id_position): array
    {
        $query = "SELECT base_salary FROM positions
        WHERE id_position = :id_position";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':id_position' => (int)$id_position
        ]);
        $result = $stmt->fetch();
        return $result;
    }


    function normalize($value, $type = 'string') {
        if (empty($value) || $value === null) return null;
        return match($type) {
            'int' => (int)$value,
            'float' => (float)$value,
            default => trim($value),
        };
    }

    // Запис зарплати
    function salaryRecord(array $records) : void
    {
        $query = ("INSERT INTO salaries (id_employee, All_hours_c6, Night_shift_hours_c11,
        Overtime_hours_c29, money_for_night_shift,
        money_for_overtime, Code295, Sick_pay, Health_allowance, 
        Vacation_pay, Salary_indexation_c150, premium_c116, PDFO_tax_c532,
        Military_Service_tax_c590, Trade_union_tax_c555, gross_salary, net_salary)

        VALUES (:id_employee,  :All_hours_c6, :Night_shift_hours_c11, :Overtime_hours_c29, 
        :money_for_night_shift, :money_for_overtime, :Code295, :Sick_pay, :Health_allowance, 
        :Vacation_pay, :Salary_indexation_c150, :premium_c116, :PDFO_tax_c532,
        :Military_Service_tax_c590, :Trade_union_tax_c555, :gross_salary, :net_salary)"
        );

        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':id_employee' => $this->normalize($records['id_employee'], 'int'),
            ':All_hours_c6' => $this->normalize($records['All_hours_c6'], 'int'),
            ':Night_shift_hours_c11' => $this->normalize($records['Night_shift_hours_c11'], 'int'),
            ':Overtime_hours_c29' => $this->normalize($records['Overtime_hours_c29'], 'int'),
            ':money_for_night_shift' => $this->normalize($records['money_for_night_shift'], 'float'),
            ':money_for_overtime' => $this->normalize($records['money_for_overtime'], 'float'),
            ':Code295' => $this->normalize($records['Code295'], 'float'),
            ':Sick_pay' => $this->normalize($records['Sick_pay'], 'float'),
            ':Health_allowance' => $this->normalize($records['Health_allowance'], 'float'),
            ':Vacation_pay' => $this->normalize($records['Vacation_pay'], 'float'),
            ':Salary_indexation_c150' => $this->normalize($records['Salary_indexation_c150'], 'float'),
            ':premium_c116' => $this->normalize($records['premium_c116'], 'float'),
            ':PDFO_tax_c532' => $this->normalize($records['PDFO_tax_c532'], 'float'),
            ':Military_Service_tax_c590' => $this->normalize($records['Military_Service_tax_c590'], 'float'),
            ':Trade_union_tax_c555' => $this->normalize($records['Trade_union_tax_c555'], 'float'),
            ':gross_salary' => $this->normalize($records['gross_salary'], 'float'),
            ':net_salary' => $this->normalize($records['net_salary'], 'float'),
        ]);
    }

    // Оновлення запису в бд
    function getSelectedEmployeeSalary(int $id): array|bool
    {
        $query = "SELECT * FROM salaries AS s
        INNER JOIN positions as p ON s.id_position = p.id_position
        WHERE id_employee = :id";

        $stmt = $this->db->prepare($query);
        $stmt->execute(
            [
                ':id' => (int)$id
            ]
        );

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) === 1) {
            $result = $result[0];
        }

        return $result;
    }

    function updataSalary(int $id, $data) : void
    {
        $query = "UPDATE salaries SET 
            All_hours_c6 = :All_hours_c6,
            Night_shift_hours_c11 = :Night_shift_hours_c11,
            Overtime_hours_c29 = :Overtime_hours_c29,
            premium_c116 = :premium_c116,
            Salary_indexation_c150 = :Salary_indexation_c150,
            Code295 = :Code295,
            Vacation_pay = :Vacation_pay,
            Health_allowance = :Health_allowance,
            Sick_pay = :Sick_pay,
            gross_salary = :gross_salary,
            PDFO_tax_c532 = :PDFO_tax_c532,
            Trade_union_tax_c555 = :Trade_union_tax_c555,
            Military_Service_tax_c590 = :Military_Service_tax_c590,
            net_salary = :net_salary,
            Accural_time = :Accural_time
        WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':All_hours_c6' => $data['All_hours_c6'],
            ':Night_shift_hours_c11' => $data['Night_shift_hours_c11'],
            ':Overtime_hours_c29' => $data['Overtime_hours_c29'],
            ':premium_c116' => $data['premium_c116'],
            ':Salary_indexation_c150' => $data['Salary_indexation_c150'],
            ':Code295' => (float)$data['Code295'],
            ':Vacation_pay' => $data['Vacation_pay'],
            ':Health_allowance' => $data['Health_allowance'],
            ':Sick_pay' => (float)$data['Sick_pay'],
            ':gross_salary' => $data['gross_salary'],
            ':PDFO_tax_c532' => $data['PDFO_tax_c532'],
            ':Trade_union_tax_c555' => $data['Trade_union_tax_c555'],
            ':Military_Service_tax_c590' => $data['Military_Service_tax_c590'],
            ':net_salary' => $data['net_salary'],
            ':Accural_time' => $data['Accural_time'],
            ':id' => (int)$id
        ]);
    }

    // Видалення ЗП
    function deleteOneSalary(int $id_salary) : void
    {
        $query = "DELETE FROM salaries WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':id' => (int)$id_salary
        ]);
    }
}