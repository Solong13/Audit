# My payroll software

It`s simple soft for payroll employees and admin

## Tech Stack
- php 8+
- MySQL

## Getting Started

### Prerequisites
- PHP >= 8.0
- MySQL >= 8.0

### Installation
```bash
1. git clone https://github.com/Solong13/Audit.git
cd Audit

2. Create database
CREATE DATABASE Audit;

3. Import schema

CREATE TABLE `employees` (
	`id_employee` INT(10) NOT NULL AUTO_INCREMENT,
	`id_position` INT(10) NULL DEFAULT NULL,
	`fullname` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`password` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`table_number` VARCHAR(300) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`workshop` TINYTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`work_experience` FLOAT NULL DEFAULT NULL,
	`photo` VARCHAR(500) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`employee_role` INT(10) NULL DEFAULT NULL,
	PRIMARY KEY (`id_employee`) USING BTREE,
	UNIQUE INDEX `fullname` (`fullname`) USING BTREE,
	UNIQUE INDEX `table_number` (`password`) USING BTREE,
	UNIQUE INDEX `Столбец 4` (`table_number`) USING BTREE,
	INDEX `id_position` (`id_position`) USING BTREE,
	CONSTRAINT `FK_employees_positions` FOREIGN KEY (`id_position`) REFERENCES `positions` (`id_position`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
AUTO_INCREMENT=34
;

CREATE TABLE `positions` (
	`id_position` INT(10) NOT NULL AUTO_INCREMENT,
	`position_name` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`base_salary` DECIMAL(10,2) NOT NULL,
	`workshop` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	PRIMARY KEY (`id_position`) USING BTREE
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
AUTO_INCREMENT=11
;

CREATE TABLE `salaries` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`id_employee` INT(10) NULL DEFAULT NULL,
	`All_hours_c6` INT(10) NULL DEFAULT NULL,
	`Night_shift_hours_c11` INT(10) NULL DEFAULT NULL,
	`Overtime_hours_c29` INT(10) NULL DEFAULT NULL,
	`money_for_night_shift` FLOAT NULL DEFAULT NULL,
	`money_for_overtime` FLOAT NULL DEFAULT NULL,
	`Code295` FLOAT NULL DEFAULT NULL,
	`Sick_pay` FLOAT NULL DEFAULT NULL,
	`Health_allowance` FLOAT NULL DEFAULT NULL,
	`Vacation_pay` FLOAT NULL DEFAULT NULL,
	`Salary_indexation_c150` FLOAT NULL DEFAULT NULL,
	`premium_c116` FLOAT NULL DEFAULT NULL,
	`PDFO_tax_c532` FLOAT NULL DEFAULT NULL,
	`Military_Service_tax_c590` FLOAT NULL DEFAULT NULL,
	`Trade_union_tax_c555` FLOAT NULL DEFAULT NULL,
	`gross_salary` FLOAT NULL DEFAULT NULL,
	`net_salary` FLOAT NULL DEFAULT NULL,
	`Accural_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `id_employee` (`id_employee`) USING BTREE,
	CONSTRAINT `fk_salaries_employees` FOREIGN KEY (`id_employee`) REFERENCES `employees` (`id_employee`) ON UPDATE CASCADE ON DELETE CASCADE
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
AUTO_INCREMENT=43
;

4. Configure database
Rename .env.example to .env and update credentials.

5. Run project
php -S localhost:8000 -t public

Or 

docker compose up -d --build
# потім зайти на http://localhost:8000