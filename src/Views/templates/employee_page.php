<main>
  <!-- Верхній блок -->
  <div class="profile-section">
    <div class="photo-upload">
      <form action="/avatar/upload" method="post" enctype="multipart/form-data">
        <img src=<?= '/'.$data['for_profil']['photo'] ?? "/assets/images/avatar.jpg"?> alt="Фото працівника">
        <input type="file" name="image">
        <input type="hidden" name="id_employee" value="<?= $data['for_profil']['id_employee'] ?>">
        <button type="submit" name="submit_employee">Змінити фото</button>
      </form>
      <p style="color:red"><?= $data['errorPhoto'] ?? null ?></p>
    </div>

    <div class="employee-info">
      <h2><?=$data['for_profil']['fullname'] ?? $theNewEmployee['fullname']?></h2>
      <p><b>Посада:</b><?=$data['for_profil']['position_name'] ?? $theNewEmployee['position_name']?></p>
      <p><b>Загальний стаж:</b><?=$data['for_profil']['work_experience'] ?? 0?> рік</p>
      <p><b>Табельний №:</b><?=$data['for_profil']['table_number'] ?? $theNewEmployee['table_number']?></p>
      <p><b>Цех:</b><?=$data['for_profil']['workshop'] ?? $theNewEmployee['workshop']?></p>
      <p><b>Оклад:</b><?=$data['for_profil']['base_salary'] ?? $theNewEmployee['base_salary']?> грн</p>
    </div>
  </div>

  <!-- Форма внесення зарплати -->
  <form class="salary-form" action="/employee/accrual/" method="POST">
    <h3>Додати/оновити зарплату</h3>

<input type="hidden" name="id_employee" value="<?= $data['for_profil']['id_employee']?>">
<input type="hidden" name="id_position" value="<?= $data['for_profil']['id_position'] ?>">

    <label>Відпрацьовано годин</label>
    <input type="number" name="All_hours_c6" placeholder="180" value="">

    <label>Нічні годин</label>
    <input type="number" name="Night_shift_hours_c11" placeholder="180" value="">

    <label>Понаднормові годин</label>
    <input type="number" name="Overtime_hours_c29" placeholder="180" value="">

    <label>Заводська премія</label>
    <input type="number" name="premium_c116" step="0.01" placeholder="180" value="">
    
    <label>Індексація</label>
    <input type="number" name="Salary_indexation_c150" step="0.01" placeholder="180" value="">

    <label>Цехова премія</label>
    <input type="number" name="Code295" step="0.01" placeholder="180" value="">

    <label>Відпускні</label>
    <input type="number" name="Vacation_pay" placeholder="0" value="">

    <label>Оздоровчі</label>
    <input type="number" name="Health_allowance" placeholder="0" value="">
    
    <label>Лікарняні</label>
    <input type="number" name="Sick_pay" placeholder="0" value="">

    <button type="text">Додати</button>

    <?php if (isset($_SESSION['errorSalary'] )) :?>
      <p style="color:red">Fill the empty fields!</p>
    <?php
    unset($_SESSION['errorSalary']);
    endif; ?>
  </form>

  <?php if (isset($data['salary'])) : ?>
    <?php foreach ($data['salary'] as  $employee) : ?> 
    <!-- Таблиця зарплат -->
    <h1>Зарплата за <?= substr($employee['Accural_time'], 0, 10); ?></h1>
    <table>
      <thead>
        <tr>
          <th>Місяць</th>
          <th>Відпрацьовано годин</th>
          <th>Сума</th>
          <th>Дата нарахування</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td><?=substr($employee['Accural_time'], 0, 7)?></td>
          <td><?=$employee['All_hours_c6']?></td>
          <td><?=$employee['base_salary']?></td>
          <td><?=substr($employee['Accural_time'], 0, 10)?></td>
        </tr>
      </tbody>

          <thead>
        <tr>
          <th>Місяць</th>
          <th>Відпрацьовано годин за ніч</th>
          <th>Сума</th>
          <th>Дата нарахування</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?=substr($employee['Accural_time'], 0, 7)?></td>
          <td><?=$employee['Night_shift_hours_c11']?></td>
          <td><?=$employee['money_for_night_shift']?></td>
          <td><?=substr($employee['Accural_time'], 0, 10)?></td>
        </tr>
      </tbody>

      <thead>
        <tr>
          <th>Місяць</th>
          <th>Наднормовий час</th>
          <th>Сума</th>
          <th>Дата нарахування</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?=substr($employee['Accural_time'], 0, 7)?></td>
          <td><?=$employee['Overtime_hours_c29']?></td>
          <td><?=$employee['money_for_overtime']?></td>
          <td><?=substr($employee['Accural_time'], 0, 10)?></td>
        </tr>
      </tbody>

      <thead>
        <tr>
          <th>Місяць</th>
          <th>Заводська премія</th>
          <th>Сума</th>
          <th>Дата нарахування</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?=substr($employee['Accural_time'], 0, 7)?></td>
          <td></td>
          <td><?=$employee['premium_c116']?></td>
          <td><?=substr($employee['Accural_time'], 0, 10)?></td>
        </tr>
      </tbody>

      <?php if (isset($employee['Code295'])) :?>
          <thead>
            <tr>
              <th>Місяць</th>
              <th>Цехова премія</th>
              <th>Сума</th>
              <th>Дата нарахування</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?=substr($employee['Accural_time'], 0, 7)?></td>
              <td></td>
              <td><?=$employee['Code295']?></td>
              <td><?=substr($employee['Accural_time'], 0, 10)?></td>
            </tr>
          </tbody>
      <?php endif; ?>

        <thead>
        <tr>
          <th>Місяць</th>
          <th>Індексація</th>
          <th>Сума</th>
          <th>Дата нарахування</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?=substr($employee['Accural_time'], 0, 7)?></td>
          <td></td>
          <td><?=$employee['Salary_indexation_c150']?></td>
          <td><?=substr($employee['Accural_time'], 0, 10)?></td>
        </tr>
      </tbody>

      <thead>
        <tr>
          <th>Місяць</th>
          <th>До сплати податків</th>
          <th>Сума</th>
          <th>Дата нарахування</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?=substr($employee['Accural_time'], 0, 7)?></td>
          <td></td>
          <td><?=$employee['gross_salary']?></td>
          <td><?=substr($employee['Accural_time'], 0, 10)?></td>
        </tr>
      </tbody>

          <thead>
        <tr>
          <th>Місяць</th>
          <th>ПДФО</th>
          <th>Сума</th>
          <th>Дата оподаткування</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?=substr($employee['Accural_time'], 0, 7)?></td>
          <td></td>
          <td><?=$employee['PDFO_tax_c532']?></td>
          <td><?=substr($employee['Accural_time'], 0, 10)?></td>
        </tr>
      </tbody>

        <thead>
        <tr>
          <th>Місяць</th>
          <th>Профспілковий внесок 1%</th>
          <th>Сума</th>
          <th>Дата оподаткування</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?=substr($employee['Accural_time'], 0, 7)?></td>
          <td></td>
          <td><?=$employee['Trade_union_tax_c555']?></td>
          <td><?=substr($employee['Accural_time'], 0, 10)?></td>
        </tr>
      </tbody>
      

        <thead>
        <tr>
          <th>Місяць</th>
          <th>Військовий збір 5%</th>
          <th>Сума</th>
          <th>Дата оподаткування</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?=substr($employee['Accural_time'], 0, 7)?></td>
          <td></td>
          <td><?=$employee['Military_Service_tax_c590']?></td>
          <td><?=substr($employee['Accural_time'], 0, 10)?></td>
        </tr>
      </tbody>

        <thead>
        <tr>
          <th>Місяць</th>
          <th>Сума після сплати податків</th>
          <th>Сума</th>
          <th>Дата нарахування</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?=substr($employee['Accural_time'], 0, 7)?></td>
          <td></td>
          <td><?=$employee['net_salary']?></td>
          <td><?=substr($employee['Accural_time'], 0, 10)?></td>
        </tr>
      </tbody>

      <thead>
        <tr>
          <th></th>
          <th></th>
          <th></th>
          <th>Дії</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td class="actions">
            <a href="/employee/edit/<?=$employee['id']?>"><button class="edit-btn">Edit</button></a>
            <a href="/employee/delete/<?=$employee['id']?>/<?=$employee['id_employee']?>"><button class="delete-btn">Delete</button></a>
          </td>
        </tr>
      </tbody>
    </table>
    <?php endforeach; ?>
  <?php endif; ?>
  
</main>

