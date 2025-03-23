<?php include_once 'templates/layouts/header.php'; ?>

<main>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Кошачий приют</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
            <tr>
                <th>Имя</th>
                <th>Пол</th>
                <th>Возраст</th>
                <th>Имя матери</th>
                <th>Возможные отцы</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($cats as $cat): ?>
                <tr class="cat-row" data-id="<?= $cat['ID']; ?>">
                    <td><?php echo htmlspecialchars($cat['NAME']); ?></td>
                    <td><?php echo htmlspecialchars($cat['GENDER'] == 'male' ? "Мужской" : "Женский"); ?></td>
                    <td><?php echo htmlspecialchars($cat['AGE']); ?></td>
                    <td><?php echo htmlspecialchars($cat['MOTHER_NAME'] ?? 'Подобрали на улице'); ?></td>
                    <td><?php echo htmlspecialchars($cat['FATHER_NAMES'] ?? "Необходим тест на отцовство"); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $cat['ID']; ?>" class="btn btn-warning btn-sm">Редактировать</a>
                        <a href="?act=delete&id=<?php echo $cat['ID']; ?>" class="btn btn-danger btn-sm">Удалить</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <div class="modal fade" id="catModal" tabindex="-1" role="dialog" aria-labelledby="catModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="catModalLabel">Информация о коте</h5>
                </div>
                <div class="modal-body" id="catModalBody">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close-modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</main>



<?php include_once 'templates/layouts/footer.php'; ?>