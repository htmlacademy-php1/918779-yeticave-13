  <main>
    <nav class="nav">
      <ul class="nav__list container">
      <?php foreach ($categories as $category_list): ?>
        <li class="nav__item">
          <a href="<?= $category_list['id']; ?>"><?= $category_list['category_name']; ?></a>
        </li>
      <?php endforeach; ?>
      </ul>
    </nav>

    <?php $classname = isset($errors) ? "form--invalid" : ""; ?>
    <form class="form form--add-lot container <?= $classname; ?>" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
      <h2>Добавление лота</h2>
      <div class="form__container-two">
        <?php $classname = isset($errors["lot_name"]) ? "form__item--invalid" : ""; ?>
        <div class="form__item <?= $classname; ?>"> <!-- form__item--invalid -->
          <label for="lot-name">Наименование <sup>*</sup></label>
          <input id="lot-name" type="text" name="lot_name" placeholder="Введите наименование лота" value="<?= htmlspecialchars($lot['lot_name'] ?? ''); ?>">
          <span class="form__error"><?= $errors["lot_name"]; ?></span>
        </div>
        <?php $classname = isset($errors["category_id"]) ? "form__item--invalid" : ""; ?>
        <div class="form__item <?= $classname; ?>">
          <label for="category">Категория <sup>*</sup></label>
          <select id="category" name="category_id">
            <option>Выберите категорию</option>
            <?php foreach ($categories as $category_list): ?>
            <option value="<?= $category_list["id"]; ?>"><?= $category_list['category_name']; ?></option>
            <?php endforeach; ?>
          </select>
          <span class="form__error"><?= $errors["category_id"]; ?></span>
        </div>
      </div>
      <?php $classname = isset($errors["user_description"]) ? "form__item--invalid" : ""; ?>
      <div class="form__item form__item--wide <?= $classname; ?>">
        <label for="message">Описание <sup>*</sup></label>
        <textarea id="message" name="user_description" placeholder="Напишите описание лота"><?= htmlspecialchars($lot['user_description'] ?? ''); ?></textarea>
        <span class="form__error"><?= $errors["user_description"]; ?></span>
      </div>
      <?php $classname = isset($errors["photo"]) ? "form__item--invalid" : ""; ?>
      <div class="form__item form__item--file <?= $classname; ?>">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file">
          <input class="visually-hidden" type="file" name="photo" id="lot-img" value="value="<?= htmlspecialchars($lot['photo'] ?? ''); ?>"">
          <label for="lot-img">
            Добавить
          </label>
        <span class="form__error"><?= $errors["photo"]; ?></span> 
        </div>
      </div>
      <div class="form__container-three">
      <?php $classname = isset($errors["price"]) ? "form__item--invalid" : ""; ?>  
        <div class="form__item form__item--small <?= $classname; ?>">
          <label for="lot-rate">Начальная цена <sup>*</sup></label>
          <input id="lot-rate" type="text" name="price" placeholder="0" value="<?= htmlspecialchars($lot['price'] ?? ''); ?>">
          <span class="form__error"><?= $errors["price"]; ?></span>
        </div>
        <?php $classname = isset($errors["step"]) ? "form__item--invalid" : ""; ?>
        <div class="form__item form__item--small <?= $classname; ?>">
          <label for="lot-step">Шаг ставки <sup>*</sup></label>
          <input id="lot-step" type="text" name="step" placeholder="0" value="<?= htmlspecialchars($lot['step'] ?? ''); ?>">
          <span class="form__error"><?= $errors["step"]; ?></span>
        </div>
        <?php $classname = isset($errors["date_expiration"]) ? "form__item--invalid" : ""; ?>
        <div class="form__item <?= $classname; ?>">
          <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
          <input class="form__input-date" id="lot-date" type="text" name="date_expiration" placeholder="Введите дату в формате ГГГГ-ММ-ДД" value="<?= htmlspecialchars($lot['date_expiration'] ?? ''); ?>">
          <span class="form__error"><?= $errors["date_expiration"]; ?></span>
        </div>
      </div>
      <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
      <button type="submit" class="button">Добавить лот</button>
    </form>
  </main>
