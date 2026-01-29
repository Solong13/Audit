<?php //dd($data) ?> 
<!-- Portfolio -->
<section id="portfolio" class="two">
	<div class="container">
		<header>
			<h1>Employee financial information</h1>
		</header>
            <h3>Фінансові надходження працівника</h3>

			<!-- Створити таблицю для виводу зарплати -->
            <?php if(isset($data) && !empty($data)) {
                foreach ($data['dataForView'] as $key => $valEmployee) { ?>
                <br>
            <table class="pay-slip">
                <!-- Заголовок -->
                <tr class="date-and-time">
                    <td colspan="6" class="no-border left"><?= $valEmployee['year']; ?></td>
                    <td colspan="3" class="no-border right"><?= $valEmployee['time']; ?></td>
                </tr>
                <tr>
                    <td colspan="9" class="no-border"></td>
                </tr>
                <tr class="workshop-and-table_number">   
                    <td colspan="2" class="no-border left"><?= $valEmployee["workshop"]; ?></td>
                    <td colspan="3" class="no-border center">ТАБЛN <?= $valEmployee["table_number"]; ?></td>
                    <td colspan="3" class="no-border right"><?= $valEmployee["fullname"]; ?></td>
                    <td colspan="2" class="no-border right">код н/п = <?= $valEmployee['year']; ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="no-border left">Пл.час:23 <?= $valEmployee['All_hours_c6']; ?></td>
                    <td colspan="5" class="no-border right">оклад/тариф <?= $valEmployee['base_salary'] ?></td>
                </tr>

                <!-- Шапка табличної частини -->
                <tr class="section-head">
                    <td colspan="4">НАРАХУВАННЯ</td>
                    <td colspan="2">ОПОДАТКОВ СУМА</td>
                    <td colspan="3">УТРИМАННЯ</td>
                </tr>
                <tr class="section-subhead">
                    <td>М-Ц:</td>
                    <td>ВИД:</td>
                    <td>ДНІ</td>
                    <td>ГОДИНИ</td>
                    <td>СУМА</td>
                    <td>СУМА</td>
                    <td>М-Ц:</td>
                    <td>ВИД:</td>
                    <td>СУМА</td>
                </tr>

                <!-- Приклади рядків -->
                <tr>   
                    <td><?= $valEmployee['month']; ?></td>
                    <td>6</td>
                    <td>23</td>
                    <td><?= $valEmployee["All_hours_c6"]; ?></td>
                    <td><?= $valEmployee['base_salary'] ?></td>
                    <td><?= $valEmployee['gross_salary']; ?></td>
                    <td><?= $valEmployee['month']; ?></td>
                    <td>532</td>
                    <td>-<?= $valEmployee["PDFO_tax_c532"]; ?></td>
                </tr>
                <tr>

                    <td><?= $valEmployee['month']; ?></td>
                    <td>11</td>
                    <td></td>
                    <td><?= $valEmployee["Night_shift_hours_c11"]; ?></td>
                    <td><?= $valEmployee["money_for_night_shift"]; ?></td>
                    <td></td>
                    <td><?= $valEmployee['month']; ?></td>
                    <td>555</td>
                    <td>-<?= $valEmployee["Trade_union_tax_c555"]; ?></td>
                </tr>
                <tr>
                    <td><?= $valEmployee['month']; ?></td>
                    <td>29</td>
                    <td></td>
                    <td><?= $valEmployee["Overtime_hours_c29"]; ?></td>
                    <td><?= $valEmployee["money_for_overtime"]; ?></td>
                    <td></td>
                    <td><?= $valEmployee['month']; ?></td>
                    <td>590</td>
                    <td>-<?= $valEmployee["Military_Service_tax_c590"]; ?></td>
                </tr>
                    <tr>
                    <td><?= $valEmployee['month']; ?></td>
                    <td>116</td>
                    <td></td>
                    <td></td>
                    <td><?= $valEmployee["premium_c116"]; ?></td>
                    <td></td>
                    <td><?= $valEmployee['month']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                </tr>
                    <tr>
                    <td><?= $valEmployee['month']; ?></td>
                    <td>150</td>
                    <td></td>
                    <td></td>
                    <td><?= $valEmployee["Salary_indexation_c150"]; ?></td>
                    <td></td>
                    <td><?= $valEmployee['month']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php if ($valEmployee["Code295"]) : ?>
                    </tr>
                        <tr>
                        <td><?= $valEmployee['month']; ?></td>
                        <td>295</td>
                        <td></td>
                        <td></td>
                        <td><?= $valEmployee["Code295"]; ?></td>
                        <td></td>
                        <td><?= $valEmployee['month']; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td colspan="4" class="bold left">РАЗОМ</td>
                    <td><?= $valEmployee['gross_salary']; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2">-<?= ($valEmployee['net_salary'] * 0.3); ?></td>
                </tr>

                <tr>
                    <td colspan="4" class="bold left">НА БАНКОМАТ: З/ПЛ</td>
                    <td colspan="1"><?= $valEmployee['net_salary']; ?></td>
                </tr>
            </table> 
                <?php };?>
            
            <?php  } else { echo( 'Відсутні фінансові надходження!');}?>

<!-- Пагінація -->
<nav class="pagination-container" aria-label="Навігація по сторінках">
  <p>Сторінка <?= $data['pagination']['current'] ?> з <?= $data['pagination']['pages'] ?></p>
  <ul class="pagination">
    <?php for ($i = 1; $i <= $data['pagination']['pages']; $i++): ?>
      <li><a href="?page=<?= $i ?>" class="pagination-link"><?= $i ?></a></li>
    <?php endfor; ?>
  </ul>
</nav>

    </div>
</section>