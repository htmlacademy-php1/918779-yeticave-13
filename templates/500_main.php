<main>
    <nav class="nav">
      <ul class="nav__list container">
      <?php foreach ($categories as $category_list): ?>
        <li class="nav__item">
          <a href="all-lots.html"><?= $category_list['category_name']; ?></a>
        </li>
      <?php endforeach; ?>
      </ul>
    </nav>
    <section class="lot-item container">
        <h2>500 Внутренняя ошибка сервера</h2>
        <p>Уважаемый пользователь! По какой-то причине произошла внутренняя ошибка сервера.</p>
    </section>
</main>