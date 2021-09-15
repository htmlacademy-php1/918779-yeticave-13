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
    
    <section class="lot-item container">
      <h2><?= $lot['lot_name']; ?></h2>
      <div class="lot-item__content">
        <div class="lot-item__left">
          <div class="lot-item__image">
            <img src="<?= $lot['photo']; ?>" width="730" height="548" alt="<?= $lot['lot_name']; ?>">
          </div>
          <p class="lot-item__category">Категория: <span><?= $lot['category_name']; ?></span></p>
          <p class="lot-item__description"><?= $lot['user_description']; ?></p>
        </div>
        <div class="lot-item__right">
          <?php if ($is_auth): ?>
          <div class="lot-item__state">
            <?php $date_remaining = date_range(htmlspecialchars($lot['date_expiration']));?>
            <div class="lot-item__timer timer <?=date_warning($date_remaining[0]);?>">
            <?=decorate_time($date_remaining);?>
            </div>
            <div class="lot-item__cost-state">
              <div class="lot-item__rate">
                <span class="lot-item__amount">Текущая цена</span>
                <span class="lot-item__cost"><?=decorate_price(htmlspecialchars($lot['price']));?></span>
              </div>
              <div class="lot-item__min-cost">
                Мин. ставка <span><?=decorate_price(htmlspecialchars($min_bet));?></span>
              </div>
            </div>
            <form class="lot-item__form" action="lot.php?id=<?= $id_num;?>" method="post" autocomplete="off">
              <p class="lot-item__form-item form__item <?php if ($error): ?>form__item--invalid<?php endif; ?>">
                <label for="cost">Ваша ставка</label>
                <input id="cost" type="text" name="sum" placeholder="<?=decorate_price(htmlspecialchars($min_bet));?>">
                <span class="form__error"><?= $error; ?></span>
              </p>
              <button type="submit" class="button">Сделать ставку</button>
            </form>
          </div>
          <?php endif; ?>
          <?php if (!empty($history)): ?>
          <div class="history">
            <h3>История ставок (<span><?= $bet_counter;?></span>)</h3>
            <table class="history__list">
              <?php foreach($history as $bet): ?>
              <tr class="history__item">
                <td class="history__name"><?= $bet["user_name"]; ?></td>
                <td class="history__price"><?=decorate_price(htmlspecialchars($bet['sum']));?></td>
                <td class="history__time"><?= $bet["date_bet"]; ?></td>
              </tr>
              <?php endforeach; ?>            
            </table>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
  </main>