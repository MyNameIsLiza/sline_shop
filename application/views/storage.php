
<div class="jumbotron">
<h2 class="sub-header">Склад</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th><th>Локація</th><th>Група</th><th>Тип</th><th>Розмір</th><th>Ріст</th><th>Кількість</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        <?php foreach ($storage as $item): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $item['place']['name'] ?></td>
                <td><?= $item['group']['name'] ?></td>
                <td><?= $item['type']['name'] ?></td>
                <td><?= $item['size'] ?></td>
                <td><?= $item['height'] ?></td>
                <td><?= $item['quantity'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
