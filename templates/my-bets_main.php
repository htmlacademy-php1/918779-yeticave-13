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

  <section class="rates container">
      <h2>Мои ставки</h2>
      <?php if (!empty($bets)): ?>
      <table class="rates__list">
      <?php foreach($bets as $bet): ?>
        <tr class="rates__item <?php if ($bet["winner_id"] === $_SESSION["id"]): ?>rates__item--win<?php endif; ?>">
          <td class="rates__info">
            <div class="rates__img">
              <img src="../<?= $bet["photo"]; ?>" width="54" height="40" alt="<?= $bet["lot_name"]; ?>">
            </div>
            <h3 class="rates__title"><a href="lot.php?id=<?= $bet["id"]; ?>"><?= $bet["lot_name"]; ?></a></h3>
            <p><?php if ($bet["winner_id"] === $_SESSION["id"]): ?><?= $bet["user_data"] ?><?php endif; ?></p>
          </td>
          <td class="rates__category">
          <?= $bet["category_name"]; ?>
          </td>
          <td class="rates__timer">
          <?php if ($bet["winner_id"] === $_SESSION["id"]): ?>
            <div class="timer timer--win">Ставка выиграла</div>
          <?php else: ?>
          <?php $time = is_time_left($bet["date_expiration"]) ?>
            <div class="timer <?php if ($time[0] < 1 && $time[0] != 0): ?>timer--finishing <?php elseif($time[0] == 0): ?>timer--end<?php endif; ?>">
              <?php if ($time[0] != 0): ?>
              <?= "$time[0] : $time[1]"; ?>
              <?php else: ?>
                Торги окончены
              <?php endif; ?>
            </div>
            <?php endif; ?>
          </td>
          <td class="rates__price">
          <?=decorate_price($bet["sum"]);?>
          </td>
          <td class="rates__time">
          <?= $bet["date_bet"]; ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>
      <?php endif; ?>
    </section>
</main>

