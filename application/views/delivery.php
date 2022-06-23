<style>
    .jumbotron {
        padding-right: 60px;
        padding-left: 60px;
    }
</style>
<div class="jumbotron">
    <form id="add_form" class="needs-validation">
    <h2 class="sub-header">Видача</h2>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-sm">Місце</span>
        </div>
        <select id="places" name="new_place_id" class="form-control" size="1">
            <?php foreach ($places as $place): ?>
                <option value="<?= $place['place_id'] ?>"><?= $place['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-sm">Група</span>
        </div>
        <select id="groups" name="group_id" class="form-control" onchange="type_change(this)" size="1">
            <?php foreach ($groups as $group): ?>
                <option value="<?= $group['id'] ?>" data-rt_id="<?= $group['rt_id'] ?>" data-r_id="<?= $group['r_id'] ?>"><?= $group['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-sm">Тип</span>
        </div>
        <select id="types" name="type_id" class="form-control" size="1">
            <?php foreach ($types as $type): ?>
                <option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="input-group mb-3 sizes">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-sm">Розмір</span>
        </div>
        <select id="sizes" name="size" class="form-control" size="1">
            <?php foreach ($sizes as $size): ?>
                <option value="<?= $size['size'] ?>"><?= $size['size'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="input-group mb-3 heights">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-sm">Ріст</span>
        </div>
        <select id="heights" name="height" class="form-control" size="1">
            <?php foreach ($heights as $height): ?>
                <option value="<?= $height['size'] ?>"><?= $height['size'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Ціна</span>
        </div>
        <input min="0" type="number" id="prices" name="price" class="form-control" placeholder="Ціна" required="" autofocus="" value="60">
    </div>
    <div class="input-group mb-3">
    <?php foreach ($currency as $currency): ?>
    <div class="form-check  form-check-inline">
        <input class="form-check-input" type="radio" name="currency_id" id="radio_box_<?= $currency['id'] ?>" value="<?= $currency['id'] ?>" checked>
        <label class="form-check-label" for="radio_box_<?= $currency['id'] ?>">
            <?= $currency['name'] ?>
        </label>
    </div>
    <?php endforeach; ?>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Кількість</span>
        </div>
        <input min="1" type="number" id="quantity" name="quantity" class="form-control" placeholder="Кількість" required="" autofocus="" value="1">
    </div>
    <button type="submit" class="btn btn-success" <!--onclick="edit_type(this)-->">Додати</button>
    </form>
</div>
<script>
    function type_change(selectObject) {

        $.post(
            "delivery/get_types",
            {group_id: selectObject.value},
            function (response) {
                var types = $('#types');
                types.empty();
                $.each(response, function (index, value) {
                    types.append('<option value="' + value.id + '">' + value.name + '</option>');
                });
                size_change(selectObject);

            }, 'json');

    }

    function size_change(selectObject) {
        $.post(
            "delivery/get_sizes",
            {group_id: selectObject.value},
            function (response) {
                var sizes = $('#sizes');
                sizes.empty();
                $.each(response, function (index, value) {
                    sizes.append('<option value="' + value.size + '">' + value.size + '</option>');
                });
                hide_extra(selectObject);
            }, 'json');

    }

    function hide_extra(selectObject) {
        let rt_id = $(selectObject).find("option:selected").data('rt_id');
        if (rt_id != 0) {
            $('#heights').val($("#heights option:first").val());
            $('.heights').show();
        } else {
            $('#heights').val('null');
            $('.heights').hide();
        }
        let r_id = $(selectObject).find("option:selected").data('r_id');
        if (r_id != 0) {
            $('#sizes').val($("#sizes option:first").val());
            $('.sizes').show();

        } else {
            $('#sizes').find("option").remove();
            $('#sizes').val('null');
            $('.sizes').hide();
        }
    }
    $('#add_form').submit(function (event) {
        event.preventDefault();
        var data = $('#add_form').serialize();
        console.log(data);
        $.post( "storage/add", data, function( result ) {
            console.log(result);
            if(result){
                document.location.reload();
                console.log("Victory");
                alert("Ви успішно додали товар");
            }
        }, "json");
    });
</script>
