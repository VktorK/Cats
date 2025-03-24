<?php
require_once 'templates/layouts/header.php';
?>

<form method="GET" action="#">
    <input type="number" name="age" placeholder="Возраст" value="<?= htmlspecialchars($age); ?>">

    <select name="gender">
        <option value="">Выберите пол</option>
        <option value="Мужской" <?= ($gender === 'Мужской') ? 'selected' : ''; ?>>Мужской</option>
        <option value="Женский" <?= ($gender === 'Женский') ? 'selected' : ''; ?>>Женский</option>
    </select>

    <button type="submit">Фильтровать</button>
</form>

<?php
require_once 'templates/layouts/footer.php';
?>