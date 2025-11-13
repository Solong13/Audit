<!DOCTYPE html>
<html lang="uk">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Кабінет користувача</title>
<style>
  * {
    box-sizing: border-box;
  }

  body {
    font-family: Arial, sans-serif;
    margin: 0;
    background: #f5f6fa;
    color: #222;
  }

  /* ШАПКА */
  header {
    background: #2563eb;
    color: white;
    padding: 15px 20px;
    text-align: center;
    font-size: 20px;
    font-weight: bold;
  }

  /* ФУТЕР */
  footer {
    background: #1e3a8a;
    color: #fff;
    text-align: center;
    padding: 10px;
    font-size: 13px;
    position: fixed;
    bottom: 0;
    width: 100%;
  }

  main {
    max-width: 900px;
    margin: 20px auto 70px auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }

  /* Верхній блок */
  .profile-section {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 20px;
  }

  .photo-upload {
    flex: 1 1 200px;
    text-align: center;
  }

  .photo-upload img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #2563eb;
  }

  .photo-upload input[type="file"] {
    margin-top: 10px;
  }

  .employee-info {
    flex: 2;
  }

  .employee-info h2 {
    margin-top: 0;
  }

  .employee-info p {
    margin: 6px 0;
  }

  /* Форма для додавання зарплати */
  .salary-form {
    margin-top: 30px;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background: #f9fafb;
  }

  .salary-form label {
    display: block;
    margin: 6px 0 4px;
  }

  .salary-form input, 
  .salary-form select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
  }

  .salary-form button {
    margin-top: 10px;
    padding: 8px 14px;
    border: none;
    border-radius: 6px;
    background: #2563eb;
    color: #fff;
    cursor: pointer;
  }

  .salary-form button:hover {
    background: #1e3a8a;
  }

  /* Таблиця зарплат */
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  th, td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: center;
  }

  th {
    background: #f0f0f0;
  }

  .actions button {
    padding: 4px 8px;
    margin: 0 2px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .edit-btn {
    background: #10b981;
    color: white;
  }

  .delete-btn {
    background: #ef4444;
    color: white;
  }

  .save-btn {
    display: block;
    margin: 15px auto;
    padding: 10px 20px;
    background: #2563eb;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
  }

  .save-btn:hover {
    background: #1e3a8a;
  }
</style>
</head>
<body>

<header>
  Кабінет користувача
  <a href="/public">Home</a>
</header>

<?php
// Вивід всіх даних користувача uploads/_img68de553bbf087.png
if (isset($_REQUEST['id_employee'])) {
  $_SESSION['id_for_salary'] = $_REQUEST['id_employee'];
}

// якщо запис про ЗП існує
$theEmployee = getCurrentEmployee(trim(htmlspecialchars($_SESSION['id_for_salary'])), $dbh);
$photo = "";

// Для того щоб зробити багтомірний масив і для зручності виводу інших багатомірних масивів
if (isset($theEmployee['id_position'])) {
  $theEmployee = [$theEmployee];
}

// коли немає ще даних по ЗП
if (empty($theEmployee)) {
  $theNewEmployee = getEmployee($_SESSION['id_for_salary'],  $dbh);
  $photo = $theNewEmployee['photo'];
} else {
  $photo = $theEmployee[0]["photo"];
}


?> 
<main>
  <!-- Верхній блок -->
  <div class="profile-section">
    <div class="photo-upload">
      <form action="?page=uploadPhotos" method="post" enctype="multipart/form-data">
        <img src=<?= $photo ?? "assets/images/avatar.jpg"?> alt="Фото працівника">
        <input type="file" name="image">
        <input type="hidden" name="id_employee" value="<?= $theEmployee[0]['id_employee'] ??  $theNewEmployee['id_employee']?>">
        <button type="submit" name="submit_employee">Змінити фото</button>
      </form>
    </div>

    <div class="employee-info">
      <h2><?=$theEmployee[0]['fullname'] ?? $theNewEmployee['fullname']?></h2>
      <p><b>Посада:</b><?=$theEmployee[0]['position_name'] ?? $theNewEmployee['position_name']?></p>
      <p><b>Табельний №:</b><?=$theEmployee[0]['table_number'] ?? $theNewEmployee['table_number']?></p>
      <p><b>Цех:</b><?=$theEmployee[0]['workshop'] ?? $theNewEmployee['workshop']?></p>
      <p><b>Оклад:</b><?=$theEmployee[0]['base_salary'] ?? $theNewEmployee['base_salary']?> грн</p>
    </div>
  </div>

  <!-- Форма внесення зарплати -->

  <form class="salary-form" action="?page=handler_for_salaries" method="POST">
    <h3>Додати/оновити зарплату</h3>

    <input type="hidden" name="id_employee" value="<?= $_SESSION['id_for_salary'] ?? null?>">
    <input type="hidden" name="id_position" value="<?= $theEmployee[0]['id_position'] ?? $theNewEmployee["id_position"] ?>">

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

    <?php if (isset($_SESSION['error_salary'] )) :?>
      <p style="color:red">Fill the empty fields!</p>
    <?php
    unset($_SESSION['error_salary']);
    endif; ?>
  </form>

  <?php if (isset($theEmployee)) : ?>
    <?php foreach ($theEmployee as $employee) : ?> 
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

      <?php if ($employee['Code295']) :?>
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
            <a href="?page=edit_salary&&id_salary=<?=$employee['id']?>&&id_employee=<?=$_SESSION['id_for_salary']?>"><button class="edit-btn">Edit</button></a>
            <a href="?page=edit_salary&&id_salary_for_delete=<?=$employee['id']?>"><button class="delete-btn">Delete</button></a>
          </td>
        </tr>
      </tbody>
    </table>
    <?php endforeach; ?>
  <?php endif; ?>

  
</main>

<footer>
  &copy; 2025 Audit System. Усі права захищено.
</footer>

</body>
</html>