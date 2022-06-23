<div class="jumbotron">
    <h2 class="sub-header">Статистика</h2>
    <div class="table-responsive">
        <h3 class="sub-header">Видача</h3>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Локація</th>
                <th>Група</th>
                <th>Тип</th>
                <th>Розмір</th>
                <th>Ріст</th>
                <th>Кількість</th>
                <th>Користувач</th>
                <th>Час створення</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            <?php foreach ($storage[1] as $item): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $item['place']['name'] ?></td>
                    <td><?= $item['group']['name'] ?></td>
                    <td><?= $item['type']['name'] ?></td>
                    <td><?= $item['size'] ?></td>
                    <td><?= $item['height'] ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= $item['user']['first_name'] ?> <?= $item['user']['last_name'] ?></td>
                    <td><?= $item['creation_time'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="table-responsive">
        <h3 class="sub-header">Продаж</h3>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Локація</th>
                <th>Група</th>
                <th>Тип</th>
                <th>Розмір</th>
                <th>Ріст</th>
                <th>Кількість</th>
                <th>Користувач</th>
                <th>Час створення</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            <?php foreach ($storage[2] as $item): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $item['place']['name'] ?></td>
                    <td><?= $item['group']['name'] ?></td>
                    <td><?= $item['type']['name'] ?></td>
                    <td><?= $item['size'] ?></td>
                    <td><?= $item['height'] ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= $item['user']['first_name'] ?> <?= $item['user']['last_name'] ?></td>
                    <td><?= $item['creation_time'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="table-responsive">
        <h3 class="sub-header">Переміщення</h3>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Локація</th>
                <th>Група</th>
                <th>Тип</th>
                <th>Розмір</th>
                <th>Ріст</th>
                <th>Кількість</th>
                <th>Користувач</th>
                <th>Час створення</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            <?php foreach ($storage[3] as $item): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $item['place']['name'] ?></td>
                    <td><?= $item['group']['name'] ?></td>
                    <td><?= $item['type']['name'] ?></td>
                    <td><?= $item['size'] ?></td>
                    <td><?= $item['height'] ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= $item['user']['first_name'] ?> <?= $item['user']['last_name'] ?></td>
                    <td><?= $item['creation_time'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>

</script>
