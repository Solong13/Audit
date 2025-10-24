<?php

function salaryRecord(array $records, PDO $dbh) : void
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

    $stmt = $dbh->prepare($query);
    $stmt->execute($records);
}

function createEmployee(array $data, PDO $dbh) : void
{
    $query = "INSERT INTO employees 
    (id_position, fullname, password, table_number, workshop, work_experience, photo)
    VALUES
    (:id_position, :fullname, :password, :table_number, :workshop, :work_experience, :photo)";

    $stmt = $dbh->prepare($query);
    $stmt->execute($data);
}

function getCurrentEmployee(string|int $id_employee, PDO $dbh): array|bool
{
    $query = "SELECT * FROM employees AS e
    JOIN salaries AS s ON e.id_employee = s.id_employee
    JOIN positions AS p ON e.id_position = p.id_position
    WHERE e.id_employee = :id_employee";

    $stmt = $dbh->prepare($query);
    $stmt->execute(
        [
            ':id_employee' => (int)$id_employee
        ]
    );

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) === 1) {
        $result = $result[0];
    }

    return $result;
}


function getSelectedEmployeeSalary(string|int $id, PDO $dbh): array|bool
{
    $query = "SELECT * FROM salaries 
    WHERE id = :id";

    $stmt = $dbh->prepare($query);
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

function logInEmployee(array $data, PDO $dbh): array|bool
{
    $query = "SELECT * FROM employees WHERE fullname = :fullname";
    $stmt = $dbh->prepare($query);
    $stmt->execute(
        [
            ':fullname' => $data['fullname']
        ]
    );

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//SELECT * FROM users LIMIT 3;
function getSalaryCurrentEmployee(int $idEmployee, PDO $dbh) : array|bool
{
    $query = "SELECT * FROM salaries AS s 
    INNER JOIN employees as e ON s.id_employee = e.id_employee 
    WHERE e.id_employee = :id_employee";
    
    $stmt = $dbh->prepare($query);
    $stmt->execute([
        ':id_employee' => $idEmployee
    ]);
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result) === 1) {
        $result = $result[0];
    }

    return $result;
}

function addPhotoEmployee(string $photoPath, int|string $id_employee, PDO $dbh) : void
{
    $query = "UPDATE employees SET photo = :photo WHERE id_employee = :id_employee;";

    $stmt = $dbh->prepare($query);
    $stmt->execute([
        ':id_employee' => (int)$id_employee,
        ':photo' => $photoPath
    ]);
}

function getEmployee(int|string $id_employee, PDO $dbh)
{
    $query = "SELECT * FROM employees AS e 
    INNER JOIN positions as p ON e.id_position = p.id_position
    WHERE e.id_employee = :id_employee";
    
    $stmt = $dbh->prepare($query);
    $stmt->execute([
        ':id_employee' => $id_employee
    ]);
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result) === 1) {
        $result = $result[0];
    }
    return $result;
}

function getPosition(PDO $dbh): array
{
    $query = "SELECT * FROM positions";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getCurrentPosition(int|string $id_position, PDO $dbh): array
{
    $query = "SELECT base_salary FROM positions
    WHERE id_position = :id_position";
    $stmt = $dbh->prepare($query);
    $stmt->execute([
        ':id_position' => (int)$id_position
    ]);
    $result = $stmt->fetch();
    return $result;
}

function getAllEmployeeAndTheirPositions(PDO $dbh): array
{
    $query = "SELECT *
FROM positions p
INNER JOIN employees e ON p.id_position = e.id_position";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// Оновлення запису в бд
function updataSalary(int $id, $data, PDO $dbh) : void
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

    $stmt = $dbh->prepare($query);
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

// Видалення рядку з таблиці
function deleteOneSalary(int $id_salary, PDO $dbh) : void
{
    $query = "DELETE FROM salaries WHERE id = :id";
    $stmt = $dbh->prepare($query);
    $stmt->execute([
        ':id' => (int)$id_salary
    ]);
}

// INNER JOIN	лише ті рядки, де є відповідність в обох таблицях
// LEFT JOIN	усі рядки з лівої таблиці + відповідні з правої (якщо немає — NULL)
// RIGHT JOIN	навпаки: усі рядки з правої + відповідні з лівої
// FULL JOIN	усі рядки з обох таблиць (де підтримується)

// SELECT e.name, p.position_name, p.base_salary, s.amount, s.date
// FROM salaries s
// JOIN employees e ON s.id_employee = e.id_employee
// JOIN positions p ON e.id_position = p.id_position
// WHERE e.id_employee = :id_employee;