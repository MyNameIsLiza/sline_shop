<?php foreach ($types as $type): ?>
    <tr id="type_id_<?= $type['id'] ?>">
        <td class="type_id"><?= $type['id'] ?></td>
        <td class="type_name"><?= $type['name'] ?></td>
        <td>
            <button data-id="<?=$type['id']?>" class="btn btn-warning btn-sm" onclick="delete_type(this)">Х</button>
        </td>
        <td>
            <button data-id="<?= $type['id'] ?>" class="btn btn-info btn-sm" onclick="edit_type(this)">Редагувати</button>
        </td>
    </tr>
<?php endforeach; ?>
