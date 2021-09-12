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

    <?php $classname = isset($errors) ? "form--invalid" : ""; ?>
    <form class="form container <?= $classname; ?>" action="sign-up.php" method="post" autocomplete="off"> <!-- form
    --invalid -->
      <h2>Регистрация нового аккаунта</h2>
      <?php $classname = isset($errors["email"]) ? "form__item--invalid" : ""; ?>
      <div class="form__item <?= $classname; ?>"> <!-- form__item--invalid -->
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=$user['email'] ?? ''; ?>">
        <span class="form__error"><?= $errors["email"]; ?></span>
      </div>
      <?php $classname = isset($errors["user_password"]) ? "form__item--invalid" : ""; ?>
      <div class="form__item <?= $classname; ?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="user_password" placeholder="Введите пароль" value="<?=$user['user_password'] ?? ''; ?>">
        <span class="form__error"><?= $errors["user_password"]; ?></span>
      </div>
      <?php $classname = isset($errors["user_name"]) ? "form__item--invalid" : ""; ?>
      <div class="form__item <?= $classname; ?>">
        <label for="name">Имя <sup>*</sup></label>
        <input id="name" type="text" name="user_name" placeholder="Введите имя" value="<?=$user['user_name'] ?? ''; ?>">
        <span class="form__error"><?= $errors["user_name"]; ?></span>
      </div>
      <?php $classname = isset($errors["contacts"]) ? "form__item--invalid" : ""; ?>
      <div class="form__item <?= $classname; ?>">
        <label for="message">Контактные данные <sup>*</sup></label>
        <textarea id="message" name="contacts" placeholder="Напишите как с вами связаться"><?=$user['contacts'] ?? ''; ?></textarea>
        <span class="form__error"><?= $errors["contacts"]; ?></span>
      </div>
      <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
      <button type="submit" class="button">Зарегистрироваться</button>
      <a class="text-link" href="login.php">Уже есть аккаунт</a>
    </form>
  </main>
  