<div class="jumbotron">
    <h2 class="sub-header">Склад</h2>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Локація
                    <input class="inputs" data-key="place" type="text"/>
                </th>
                <th>Група
                    <input class="inputs" data-key="group" type="text"/>
                </th>
                <th>Тип
                    <input class="inputs" data-key="type" type="text"/>
                </th>
                <th>Розмір
                    <input class="inputs" data-key="size" type="text"/>
                </th>
                <th>Ріст
                    <input class="inputs" data-key="height" type="number"/>
                </th>
                <th>Кількість
                    <input class="inputs" data-key="quantity" type="number"/>
                </th>
            </tr>
            </thead>
            <tbody id="searchContent">
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
<script>
    function getSearchObject() {
        const obj = {};
        const data = $('.inputs');
        console.log(data)
        for (const input of data) {
            console.log(input.value)
            console.log('obj', obj)
            if (input.value) {
                obj[input.dataset.key] = input.value;
            } /* */
        }
        return obj;
    }

    function search(searchObject) {
        if(Object.keys(searchObject).length){
            $.post("storage/search_goods", {searchObject}, function (result) {
                console.log(result);
                if (result) {
                    handleSearch(result)
                }
            }, "json");
        }else{
            $.post("storage/get_all", function (result) {
                console.log(result);
                if (result) {
                    handleSearch(result['storage'])
                }
            }, "json");
        }
    }

    function handleSearch(data) {
        $('#searchContent').html('');
        const trs = [];
        let index = 1;
        for (const i in data) {
            const tr = document.createElement('tr');
            const tds = [
                createTd(index++),
                createTd(data[i]['place']['name']),
                createTd(data[i]['group']['name']),
                createTd(data[i]['type']['name']),
                createTd(data[i]['size']),
                createTd(data[i]['height']),
                createTd(data[i]['quantity']),
            ];

            tr.append(...tds)
            trs.push(tr);
        }
        console.log(trs)
        document.getElementById('searchContent').append(...trs);
    }

    function createTd(innerText) {
        const td = document.createElement('td');
        td.innerText = innerText;
        return td;
    }

    $('.inputs').on('input', () => search(getSearchObject()));
</script>
