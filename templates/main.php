<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <!--заполните этот список из массива категорий-->
            <?php foreach ($categories as $category_list):?>
            <li class="promo__item promo__item--<?= $category_list['category_code']; ?>">
                <a class="promo__link" href="all-lots.php?category_id=<?= $category_list['id']; ?>"><?= $category_list['category_name']; ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <?php foreach ($advertise as $adv):?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?=htmlspecialchars($adv['photo']);?>" width="350" height="260" alt="<?=htmlspecialchars($adv['lot_name']);?>">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=$adv['category_name']; ?></span>
                    <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?= $adv['id']; ?>"><?=htmlspecialchars($adv['lot_name']);?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?=decorate_price(htmlspecialchars($adv['price']));?></span>
                        </div>
                        <?php $date_remaining = date_range(htmlspecialchars($adv['date_expiration']));?>
                        <div class="lot__timer timer <?=date_warning($date_remaining[0]);?>">
                            <?=decorate_time($date_remaining);?>

                        </div>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>
