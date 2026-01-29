<!-- Portfolio -->
<section id="portfolio" class="two">
	<div class="container">
		<header>
			<h1>Employee financial information</h1>
		</header>
<ol class="employee-list">

        <h3>Список працівників цеху</h3>
    <?php foreach ($data['dataForView'] as $employee) :?>
    
  <li>
    <a href="/employee/salary/<?=$employee['id_employee'];?>"><?= $employee['fullname'];?></a>
    <span class="position"><?= ' - ' . $employee['position_name'];?></span>
  </li>

  <?php endforeach; ?>

<!-- Пагінація -->
<nav class="pagination-container" aria-label="Навігація по сторінках">
  <p>Сторінка <?= $data['pagination']['current'] ?> з <?= $data['pagination']['pages'] ?></p>
  <ul class="pagination">
    <?php for ($i = 1; $i <= $data['pagination']['pages']; $i++): ?>
      <li><a href="?page=<?= $i ?>" class="pagination-link"><?= $i ?></a></li>
    <?php endfor; ?>
  </ul>
</nav>

</ol>
</section>