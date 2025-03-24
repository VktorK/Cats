<?php include_once 'templates/layouts/header.php'; ?>

<main>
<div class="container mt-5">
    <h1 class="text-center mb-4">Кошачий приют</h1>
    <form method="GET" action="#">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>
                        Имя
                    </th>
                    <th>
                        Пол
                        <select name="gender" class="form-select mt-1">
                            <option value="">Все</option>
                            <option value="Мужской" <?= (($_GET['gender'] ?? '') === 'Мужской') ? 'selected' : ''; ?>>Мужской</option>
                            <option value="Женский" <?= (($_GET['gender'] ?? '') === 'Женский') ? 'selected' : ''; ?>>Женский</option>
                        </select>
                    </th>
                    <th>
                        Возраст
                        <input type="number" name="age" class="form-control mt-1" placeholder="Поиск по возрасту" value="<?= htmlspecialchars($_GET['age'] ?? '') ?>">
                    </th>
                    <th>
                        Имя матери
                    </th>
                    <th>
                        Возможные отцы
                    </th>
                    <th>
                        Действия
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cats as $cat): ?>
                    <tr class="cat-row" data-id="<?= $cat['ID']; ?>">
                        <td><?= htmlspecialchars($cat['NAME']); ?></td>
                        <td><?= htmlspecialchars($cat['GENDER'] === 'male' ? "Мужской" : "Женский"); ?></td>
                        <td><?= htmlspecialchars($cat['AGE']); ?></td>
                        <td><?= htmlspecialchars($cat['MOTHER_NAME'] ?? 'Подобрали на улице'); ?></td>
                        <td><?= htmlspecialchars($cat['FATHER_NAMES'] ?? "Необходим тест на отцовство"); ?></td>
                        <td>
                            <a href="?act=edit&id=<?= $cat['ID']; ?>" class="btn btn-warning btn-sm">Редактировать</a>
                            <a href="?act=delete&id=<?= $cat['ID']; ?>" class="btn btn-danger btn-sm">Удалить</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Фильтровать</button>
        </div>
    </form>
</div>
</main>



<?php include_once 'templates/layouts/footer.php'; ?>