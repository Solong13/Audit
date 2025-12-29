<!-- Portfolio -->
<section id="portfolio" class="two">
	<div class="container">
		<header>
			<h1>Employee financial information</h1>
		</header>
<ol class="employee-list">

    <?php 
    // Подумати як витягувати дані з сесії але не тут
    if ((int)(isset($data["employee_role"]) || $data[0]["employee_role"]) === 1) : 

    ?>
        <h3>Список працівників цеху</h3>
    <?php
        // Вивести всіх працівників
        //$allEmployee = getAllEmployeeAndTheirPositions($dbh);
        foreach ($data as $employee) :     
    ?>
    
  <li>
    <a href="/employee/salary/<?=$employee['id_employee'];?>"><?= $employee['fullname'];?></a>
    <span class="position"><?= ' - ' . $employee['position_name'];?></span>
  </li>

  <?php 
    endforeach; 
    endif;
  ?>

</ol>
</section>