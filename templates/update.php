<?php include_once '../templates/layouts/header.php'; ?>

<main class="container my-5">
    <h2 class="mb-4">Проапгрейдить кошку</h2>
    <form action="add_cat.php" method="POST" class="bg-light p-4 rounded shadow">
        <div class="mb-3">
            <label for="name" class="form-label">Имя:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Пол:</label>
            <select name="gender" class="form-select" required>
                <option value="male">Мужской</option>
                <option value="female">Женский</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Возраст:</label>
            <input type="number" name="age" class="form-control" min="0" required>
        </div>
        <div class="mb-3">
            <label for="mother_id" class="form-label">ID матери (если есть):</label>
            <input type="number" name="mother_id" class="form-control">
        </div>
        <div class="mb-3">
            <label for="father_ids" class="form-label">ID отцов (через запятую):</label>
            <input type="text" name="father_ids" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Создать кошку</button>
    </form>
</main>

<?php include_once '../templates/layouts/footer.php'; ?>