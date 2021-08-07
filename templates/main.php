    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <!--заполните этот список из массива категорий-->
            <?php foreach ($categories as $category_list):?>
            <li class="promo__item promo__item--boards">
                <a class="promo__link" href="pages/all-lots.html"><?=$category_list;?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <?php foreach ($advertises as $advertise => $adv): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?=htmlspecialchars($adv['url']);?>" width="350" height="260" alt="<?=htmlspecialchars($adv['name']);?>">
                </div>
                <div class="lot__info">
                    <span class="lot__category">Название категории</span>
                    <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?=htmlspecialchars($adv['name']);?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?=decorate_price(htmlspecialchars($adv['price']));?></span>
                        </div>
                        <?php $date_remaining = date_range(htmlspecialchars($adv["data"])) ?>
                        <div class="lot__timer timer <?php if ($date_remaining[0] < 1): ?>timer--finishing<?php endif; ?>">
                            <?= "$date_remaining[0] : $date_remaining[1]"; ?>
                        </div>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
