<?php
	session_start();
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	include_once ('config/connectionToDB.php');
	include_once ('helpers_for_DB.php'); 
  ?>

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
</header>

<?php
// Вивід всіх даних користувача uploads/_img68de553bbf087.png
$theEmployee = getCurrentEmployee(trim(htmlspecialchars($_REQUEST['id_employee'])), $dbh);

var_dump($_REQUEST);
?> 
<main>
  <!-- Верхній блок -->
  <div class="profile-section">
    <div class="photo-upload">
        <img src="<?=$theEmployee['photo']?>" alt="Фото працівника">
      <form method="post" enctype="multipart/form-data">
        <input type="file" name="photo">
        <button type="submit">Змінити фото</button>
      </form>
    </div>

    <div class="employee-info">
      <h2><?=$theEmployee['fullname']?></h2>
      <p><b>Посада:</b><?=$theEmployee['fullname']?></p>
      <p><b>Табельний №:</b><?=$theEmployee['table_number']?></p>
      <p><b>Цех:</b><?=$theEmployee['workshop']?></p>
      <p><b>Оклад:</b><?=$theEmployee['base_salary']?> грн</p>
    </div>
  </div>

  <!-- Форма внесення зарплати -->

  <form class="salary-form" action="../handler_for_portfolio.php" method="POST">
    <h3>Додати/оновити зарплату</h3>

    <input type="hidden" name="id_employee" value="<?= $_GET['id_employee'] ?>">

    <label>Відпрацьовано годин</label>
    <input type="number" name="All_hours_c6" placeholder="180" value="<?=$theEmployee['workshop']?> ?? '' ">

    <label>Нічні годин</label>
    <input type="number" name="Night_shift_hours_c11" placeholder="180" value="">

    <label>Понаднормові годин</label>
    <input type="number" name="Overtime_hours_c29" placeholder="180" value="">

    <label>Заводська премія</label>
    <input type="number" name="premium_c116" placeholder="180" value="">
    
    <label>Індексація</label>
    <input type="number" name="Salary_indexation_c150" placeholder="180" value="">

    <label>Цехова премія</label>
    <input type="number" name="Code295" placeholder="180" value="">

    <label>Відпускні</label>
    <input type="number" name="Vacation_pay" placeholder="0" value="">

    <label>Оздоровчі</label>
    <input type="number" name="Health_allowance" placeholder="0" value="">
    
    <label>Лікарняні</label>
    <input type="number" name="Sick_pay" placeholder="0" value="">

    <button type="submit">Додати</button>
  </form>

  <!-- Таблиця зарплат -->
  <table>
    <thead>
      <tr>
        <th>Місяць</th>
        <th>Відпрацьовано годин</th>
        <th>Сума</th>
        <th>Дата нарахування</th>
        <th>Дії</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?=substr($theEmployee['Accural_time'], 0, 7)?></td>
        <td><?=$theEmployee['All_hours_c6']?></td>
        <td><?=$theEmployee['base_salary']?></td>
        <td><?=substr($theEmployee['Accural_time'], 0, 10)?></td>
        <td class="actions">
          <a href="?act=edit&id_employee=<?= $_GET['id_employee'] ?>"><button class="edit-btn">Edit</button></a>
          <button class="delete-btn">Delete</button>
        </td>
      </tr>
    </tbody>

        <thead>
      <tr>
        <th>Місяць</th>
        <th>Відпрацьовано годин за ніч</th>
        <th>Сума</th>
        <th>Дата нарахування</th>
        <th>Дії</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?=substr($theEmployee['Accural_time'], 0, 7)?></td>
        <td><?=$theEmployee['Night_shift_hours_c11']?></td>
        <td><?=$theEmployee['money_for_night_shift']?></td>
        <td><?=substr($theEmployee['Accural_time'], 0, 10)?></td>
        <td class="actions">
          <button class="edit-btn">Edit</button>
          <button class="delete-btn">Delete</button>
        </td>
      </tr>
    </tbody>

    <thead>
      <tr>
        <th>Місяць</th>
        <th>Наднормовий час</th>
        <th>Сума</th>
        <th>Дата нарахування</th>
        <th>Дії</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?=substr($theEmployee['Accural_time'], 0, 7)?></td>
        <td><?=$theEmployee['Overtime_hours_c29']?></td>
        <td><?=$theEmployee['money_for_overtime']?></td>
        <td><?=substr($theEmployee['Accural_time'], 0, 10)?></td>
        <td class="actions">
          <button class="edit-btn">Edit</button>
          <button class="delete-btn">Delete</button>
        </td>
      </tr>
    </tbody>

    <thead>
      <tr>
        <th>Місяць</th>
        <th>заводська премія</th>
        <th>Сума</th>
        <th>Дата нарахування</th>
        <th>Дії</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?=substr($theEmployee['Accural_time'], 0, 7)?></td>
        <td></td>
        <td><?=$theEmployee['premium_c116']?></td>
        <td><?=substr($theEmployee['Accural_time'], 0, 10)?></td>
        <td class="actions">
          <button class="edit-btn">Edit</button>
          <button class="delete-btn">Delete</button>
        </td>
      </tr>
    </tbody>


      <thead>
      <tr>
        <th>Місяць</th>
        <th>Індексація</th>
        <th>Сума</th>
        <th>Дата нарахування</th>
        <th>Дії</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?=substr($theEmployee['Accural_time'], 0, 7)?></td>
        <td></td>
        <td><?=$theEmployee['Salary_indexation_c150']?></td>
        <td><?=substr($theEmployee['Accural_time'], 0, 10)?></td>
        <td class="actions">
          <button class="edit-btn">Edit</button>
          <button class="delete-btn">Delete</button>
        </td>
      </tr>
    </tbody>

    <thead>
      <tr>
        <th>Місяць</th>
        <th>До сплати податків</th>
        <th>Сума</th>
        <th>Дата нарахування</th>
        <th>Дії</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?=substr($theEmployee['Accural_time'], 0, 7)?></td>
        <td></td>
        <td><?=$theEmployee['gross_salary']?></td>
        <td><?=substr($theEmployee['Accural_time'], 0, 10)?></td>
        <td class="actions">
          <button class="edit-btn">Edit</button>
          <button class="delete-btn">Delete</button>
        </td>
      </tr>
    </tbody>

        <thead>
      <tr>
        <th>Місяць</th>
        <th>ПДФО</th>
        <th>Сума</th>
        <th>Дата оподаткування</th>
        <th>Дії</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?=substr($theEmployee['Accural_time'], 0, 7)?></td>
        <td></td>
        <td><?=$theEmployee['PDFO_tax_c532']?></td>
        <td><?=substr($theEmployee['Accural_time'], 0, 10)?></td>
        <td class="actions">
          <button class="edit-btn">Edit</button>
          <button class="delete-btn">Delete</button>
        </td>
      </tr>
    </tbody>

      <thead>
      <tr>
        <th>Місяць</th>
        <th>Профспілковий внесок 1%</th>
        <th>Сума</th>
        <th>Дата оподаткування</th>
        <th>Дії</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?=substr($theEmployee['Accural_time'], 0, 7)?></td>
        <td></td>
        <td><?=$theEmployee['Trade_union_tax_c555']?></td>
        <td><?=substr($theEmployee['Accural_time'], 0, 10)?></td>
        <td class="actions">
          <button class="edit-btn">Edit</button>
          <button class="delete-btn">Delete</button>
        </td>
      </tr>
    </tbody>
    

      <thead>
      <tr>
        <th>Місяць</th>
        <th>Військовий збір 5%</th>
        <th>Сума</th>
        <th>Дата оподаткування</th>
        <th>Дії</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?=substr($theEmployee['Accural_time'], 0, 7)?></td>
        <td></td>
        <td><?=$theEmployee['Military_Service_tax_c590']?></td>
        <td><?=substr($theEmployee['Accural_time'], 0, 10)?></td>
        <td class="actions">
          <button class="edit-btn">Edit</button>
          <button class="delete-btn">Delete</button>
        </td>
      </tr>
    </tbody>

      <thead>
      <tr>
        <th>Місяць</th>
        <th>Сума після сплати податків</th>
        <th>Сума</th>
        <th>Дата нарахування</th>
        <th>Дії</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?=substr($theEmployee['Accural_time'], 0, 7)?></td>
        <td></td>
        <td><?=$theEmployee['net_salary']?></td>
        <td><?=substr($theEmployee['Accural_time'], 0, 10)?></td>
        <td class="actions">
          <button class="edit-btn">Edit</button>
          <button class="delete-btn">Delete</button>
        </td>
      </tr>
    </tbody>

  </table>

  <button class="save-btn">Save</button>
</main>

<footer>
  &copy; 2025 Audit System. Усі права захищено.
</footer>

</body>
</html>