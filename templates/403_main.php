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
        <h2>403 Доступ запрещен</h2>
        <p>Данная страница запрещена к просмотру.</p>
    </section>
</main>