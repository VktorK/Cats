<?php include_once 'templates/layouts/header.php'; ?>

<main>
<div class="container mt-5">
        <h1 class="text-center mb-4">Кошачий приют</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Имя</th>
                    <th>Пол</th>
                    <th>Возвраст</th>
                    <th>Имя матери</th>
                    <th>Возможные отцы</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($cats as $cat): ?>
                    <tr>
                        <td>
                            <a href="?act=show&id=<?php echo $cat['ID']; ?>" style="color: black; text-decoration: none;">
                                <?php echo htmlspecialchars($cat['NAME']); ?>
                            </a>
                        </td>
                        <td>
                            <a href="?act=show&id=<?php echo $cat['ID']; ?>" style="color: black; text-decoration: none;">
                                <?php echo htmlspecialchars($cat['GENDER'] == 'male' ? "Мужской" : "Женский"); ?>
                            </a>
                        </td>
                        <td>
                            <a href="?act=show&id=<?php echo $cat['ID']; ?>" style="color: black; text-decoration: none;">
                                <?php echo htmlspecialchars($cat['AGE']); ?>
                            </a>
                        </td>
                        <td>
                            <a href="?act=showChild&id=<?php echo $cat['MOTHER_ID'] ? : 'error'; ?>" style="color: black; text-decoration: none;">
                                <?php echo htmlspecialchars($cat['MOTHER_NAME'] ?? 'Подобрали на улице'); ?>
                            </a>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($cat['FATHER_NAMES'] ?? "Необходим тест на отцовство"); ?>
                        </td>
                        <td>
                            <a href="edit.php?id=<?= $cat['ID']; ?>" class="btn btn-warning btn-sm">Редактировать</a>
                            <a href="?act=delete&id=<?php echo $cat['ID']; ?>" class="btn btn-danger btn-sm">Удалить</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include_once 'templates/layouts/footer.php'; ?>