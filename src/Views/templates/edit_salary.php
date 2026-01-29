<main>
<!-- Форма внесення зарплати -->
  <form class="salary-form" action="/employee/accrual" method="POST">
    <h3>Oновити зарплату</h3>

    <input type="hidden" name="id_position" value="<?= $data["id_position"]?>">
    <input type="hidden" name="id_salary" value="<?= $data['id'] ?>">
    <input type="hidden" name="id_employee" value="<?= $data['id_employee'] ?>">

    <label>Відпрацьовано годин</label>
    <input type="number" name="All_hours_c6"  value="<?=$data['All_hours_c6']?>">

    <label>Нічні годин</label>
    <input type="number" name="Night_shift_hours_c11" placeholder="180" value="<?=$data['Night_shift_hours_c11'] ?? ''?>">

    <label>Понаднормові годин</label>
    <input type="number" name="Overtime_hours_c29" placeholder="180" value="<?=$data['Overtime_hours_c29'] ?? ''?>">

    <label>Заводська премія</label>
    <input type="number" name="premium_c116" placeholder="180" value="<?=$data['premium_c116'] ?? ''?>">
    
    <label>Індексація</label>
    <input type="number" name="Salary_indexation_c150" placeholder="180" value="<?=$data['Salary_indexation_c150'] ?? ''?>">

    <label>Цехова премія</label>
    <input type="number" name="Code295" placeholder="0" value="<?=$data['Code295'] ?? ''?>">

    <label>Відпускні</label>
    <input type="number" name="Vacation_pay" placeholder="0" value="<?=$data['Vacation_pay'] ?? ''?>">

    <label>Оздоровчі</label>
    <input type="number" name="Health_allowance" placeholder="0" value="<?=$data['Health_allowance'] ?? ''?>">
     
    <label>Лікарняні</label>
    <input type="number" name="Sick_pay" placeholder="0" value="<?=$data['Sick_pay'] ?? ''?>">

    <label>До сплати податків</label>
    <input type="number" name="gross_salary" placeholder="0" value="<?=$data['gross_salary'] ?? ''?>">

    <label>ПДФО</label>
    <input type="number" name="PDFO_tax_c532" placeholder="0" value="<?=$data['PDFO_tax_c532'] ?? ''?>">

    <label>Профспілковий внесок 1%</label>
    <input type="number" name="Trade_union_tax_c555" placeholder="0" value="<?=$data['Trade_union_tax_c555'] ?? ''?>">

    <label>Військовий збір 5%</label>
    <input type="number" name="Military_Service_tax_c590" placeholder="0" value="<?=$data['Military_Service_tax_c590'] ?? ''?>">

    <label>Сума після сплати податків</label>
    <input type="number" name="net_salary" placeholder="0" value="<?=$data['net_salary'] ?? ''?>">

    <label>Дата і час нарахування</label>
    <input type="text" name="Accural_time"  value="<?= $data['Accural_time'] ?>">

    <button type="submit">Оновити</button>
  </form>
</main>