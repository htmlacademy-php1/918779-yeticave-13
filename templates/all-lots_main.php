<main>
  <nav class="nav">
    <ul class="nav__list container">
    <?php foreach ($categories as $category_list): ?>
      <li class="nav__item">
        <a href="all-lots.php?category_id=<?= $category_list['id']; ?>"><?= $category_list['category_name']; ?></a>
      </li>
    <?php endforeach; ?>
    </ul>
  </nav>

<div class="container">
    <section class="lots">
        <ul class="lots__list">
            <?php foreach ($lots as $lot): ?>
            <li class="lots__item lot">
            <div class="lot__image">
                <img src="<?= $lot["photo"]; ?>" width="350" height="260" alt="<?= $lot["lot_name"]; ?>">
            </div>
            <div class="lot__info">
                <span class="lot__category"><?= $lot["category_name"]; ?></span>
                <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?= $lot["id"]; ?>"><?= htmlspecialchars($lot["lot_name"]); ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?=decorate_price(htmlspecialchars($lot['price']));?></span>
                        </div>
                        <?php $date_remaining = date_range(htmlspecialchars($lot['date_expiration']));?>
                        <div class="lot__timer timer <?=date_warning($date_remaining[0]);?>">
                        <?=decorate_time($date_remaining);?>
                        </div>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <?php if ($pages_count > 1): ?>
<ul class="pagination-list">
    <?php $prev = $current_page - 1; ?>
    <?php $next = $current_page + 1; ?>
    <li class="pagination-item pagination-item-prev">
        <a <?php if ($current_page >= 2): ?> href="all-lots.php?category_id=<?= $cat; ?>&page=<?= $prev; ?>"<?php endif; ?>>Назад</a>
    </li>
    <?php foreach($pages as $page): ?>
        <li class="pagination-item <?php if ($page == $current_page): ?>pagination-item-active<?php endif; ?>">
            <a href="all-lots.php?category_id=<?= $cat; ?>&page=<?= $page; ?>"><?= $page; ?></a>
        </li>
        <?php endforeach; ?>
        <li class="pagination-item pagination-item-next">
            <a <?php if ($current_page < $pages_count): ?> href="all-lots.php?category_id=<?= $cat; ?>&page=<?= $next; ?>"<?php endif; ?>>Вперед</a>
        </li>
    </ul>
<?php endif; ?>
    </div>


</div>
</main>