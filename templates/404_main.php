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
        <h2>404 Страница не найдена</h2>
        <p>Данной страницы не существует на сайте.</p>
    </section>
</main>