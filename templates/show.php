

<?php if (!empty($cat)): ?>
<div class="cat-info">
    <h1>по имени : <?= htmlspecialchars($cat[0]['NAME']) ?></h1>
<div class="cat-detail"><strong>Возраст:</strong> <?= htmlspecialchars($cat[0]['AGE']) ?> <?= $year ?> </div>
<div class="cat-detail"><strong>Пол:</strong> <?= htmlspecialchars($cat[0]['GENDER'] = 'male' ? 'мужчина' : 'женщина') ?></div>
<div class="cat-detail"><strong>Имя матери:</strong> <?= htmlspecialchars($cat[0]['MOTHER_NAME'] ?? 'Подобрали на улице') ?></div>
<div class="cat-detail"><strong>Имя отца:</strong> <?= htmlspecialchars($cat[0]['FATHER_NAMES'] ?? 'Необходим тест на отцовство') ?></div>
</div>
<?php else: ?>
    <p>Кот не найден.</p>
<?php endif; ?>


