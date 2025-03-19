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
                        <td><?php echo htmlspecialchars($cat['NAME']); ?></td>
                        <td><?php echo htmlspecialchars($cat['GENDER']); ?></td>
                        <td><?php echo htmlspecialchars($cat['AGE']); ?></td>
                        <td><?php echo htmlspecialchars($cat['MOTHER_NAME']); ?></td>
                        <td><?php echo htmlspecialchars($cat['FATHER_ID'] ?? "Необходим тест на отцовство"); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $cat['ID']; ?>" class="btn btn-warning btn-sm">Редактировать</a>
                            <a href="delete.php?id=<?php echo $cat['ID']; ?>" class="btn btn-danger btn-sm">Удалить</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include_once 'templates/layouts/footer.php'; ?>