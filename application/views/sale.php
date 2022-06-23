<style>
    .jumbotron {
        padding-right: 60px;
        padding-left: 60px;
    }

    @media only screen and (max-width: 1000px) {
        .input-group {
            font-size: 60px;
            height: 100px;
            width: 90%;
        }

        select.form-control {
            font-size: 60px;
        }

        input.form-control {
            font-size: 60px;
            height: 100px;
            width: 90%;
        }

        .form-check {
            font-size: 40px;
            height: 60px;
        }

    }
</style>
<div class="jumbotron">
    <form id="add_form" class="needs-validation">
        <h2 class="sub-header">Продаж</h2>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Група</span>
            </div>
            <select id="groups" name="group_id" class="form-control" onchange="group_change()" size="1">
                <?php foreach ($groups as $group): ?>
                    <option value="<?= $group['id'] ?>" data-rt_id="<?= $group['rt_id'] ?>"
                            data-r_id="<?= $group['r_id'] ?>"><?= $group['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Тип</span>
            </div>
            <select id="types" name="type_id" class="form-control" onchange="type_change()" onload="hide_extra()"
                    size="1">
                <?php foreach ($types as $type): ?>
                    <option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="input-group mb-3 sizes">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Розмір</span>
            </div>
            <select id="sizes" name="size" class="form-control" onchange="size_change()" onload="hide_extra()" size="1">
                <?php foreach ($sizes as $size): ?>
                    <option value="<?= $size['size'] ?>"><?= $size['size'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="input-group mb-3 heights">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Ріст</span>
            </div>
            <select id="heights" name="height" class="form-control" onchange="get_price()" size="1">
                <?php foreach ($heights as $height): ?>
                    <?php
                    if ($height['height'] != 0){
                        echo "<option value={$height['height']}>{$height['height']}</option>";
                    }
                    ?>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Ціна</span>
            </div>
            <input min="0" type="number" id="prices" name="price" class="form-control" placeholder="Ціна" required=""
                   autofocus="" value="<?= $price['price'] ?>">
        </div>
        <div class="input-group mb-3">
            <?php foreach ($currency as $currency): ?>
                <div class="form-check  form-check-inline">
                    <input class="form-check-input" type="radio" name="currency_id" id="currency_<?= $currency['id'] ?>"
                           value="<?= $currency['id'] ?>"
                    <?php echo ($currency['id'] == $price['currency_id']) ? "checked" : ""; ?>
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
            <input min="1" max="<?= $price['quantity'] ?>" type="number" id="quantity" name="quantity"
                   class="form-control" placeholder="Кількість" required="" autofocus="" value="1">
        </div>
        <button type="submit" class="btn btn-success" <!--onclick="edit_type(this)-->">Продати</button>
    </form>
</div>
<script>
    let rt_id = $('#groups').find("option:selected").data('rt_id');
    let r_id = $('#groups').find("option:selected").data('r_id');

    $(document).ready(function () {
        if ($('#sizes').find("option").length == 0) $('.sizes').hide();
        if ($('#heights').find("option").length == 0) $('.heights').hide();
    });


    function group_change() {
        let group_id = $('#groups').val();
        rt_id = $('#groups').find("option:selected").data('rt_id');
        r_id = $('#groups').find("option:selected").data('r_id');
        $.post(
            "storage/get_types",
            {group_id: group_id},
            function (response) {
                var types = $('#types');
                types.empty();
                $.each(response, function (index, value) {
                    types.append('<option value="' + value.id + '">' + value.name + '</option>');
                });

                hide_extra();
                if (r_id != 0) {
                    type_change();

                } else get_price();
            }, 'json');
    }


    function get_price() {
        let group_id = $('#groups').val();
        let type_id = $('#types').val();
        let size = $('#sizes').val();
        let height = $('#heights').val();
        let data = {group_id: group_id, type_id: type_id};
        if (r_id === 0 && rt_id === 0) {
            data = {group_id: group_id, type_id: type_id};
        } else if (rt_id === 0 && size) {
            data = {group_id: group_id, type_id: type_id, size: size}
        } else if (height) {
            data = {group_id: group_id, type_id: type_id, size: size, height: height}
        }
        if (height) data.height = height;
        if (size) data.size = size;
        if (data) {
            $.post(
                "storage/get_price",
                data,
                function (response) {
                    console.log(response);

                    $('#prices').val(response.price);
                    $('#currency_' + response.currency_id).prop('checked', true);
                    ;
                    $('#quantity').attr({
                        "max": response.quantity,        // substitute your own
                        "min": 1          // values (or variables) here
                    });

                }, 'json');
        }

    }

    function type_change() {

        let group_id = $('#groups').val();
        let type_id = $('#types').val();
        hide_extra();
        $('#sizes').find("option").remove();
        if (r_id != 0) {
            $.post(
                "storage/get_sizes",
                {group_id: group_id, type_id: type_id},
                function (response) {
                    var sizes = $('#sizes');
                    sizes.empty();
                    $.each(response, function (index, value) {
                        sizes.append('<option value="' + value.size + '">' + value.size + '</option>');
                    });
                    size_change();
                }, 'json');
        } else {
            get_price();
        }

    }

    function size_change() {
        let group_id = $('#groups').val();
        let type_id = $('#types').val();
        let size = $('#sizes').val();

        $('#heights').empty();
        if (rt_id != 0) {
            $.post(
                "storage/get_heights",
                {group_id: group_id, type_id: type_id, size: size},
                function (response) {
                    $.each(response, function (index, value) {
                        $('#heights').append('<option value="' + value.height + '">' + value.height + '</option>');
                    });

                    $('#heights').val($("#heights option:first").val());
                    get_price();

                    hide_extra();
                }, 'json');

        } else {
            get_price();
        }
    }

    function hide_extra() {
        console.log("FFFFFFFF");
        if (rt_id != 0) {
            $('.heights').show();
        } else {
            $('#heights').val('null');
            $('.heights').hide();
        }
        if (r_id != 0) {
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
        $.post( "storage/sale_good", data, function( result ) {
            console.log(result);
            if(result){
                console.log("Victory");
                alert("Ви успішно продали товар");
            }
        }, "json");

        var max = $('#quantity').attr('max');
        var quantity = $('#quantity').val();
        console.log(max + " " + quantity);
        if (quantity < max) {
            max = max - quantity;
            console.log(max);
            $('#quantity').attr({'max': max});
            document.location.reload();
            console.log("Victory");
        } else {
            $('#heights').find("option:selected").remove();
            if ($('#heights').find("option").length == 0) {
                $('#sizes').find("option:selected").remove();

                if ($('#sizes').find("option").length == 0) {
                    $('#types').find("option:selected").remove();
                    if ($('#types').find("option").length == 0) {
                        $('#groups').find("option:selected").remove();
                        if ($('#groups').find("option").length == 0) {
                            console.log("А фсьо уже");
                        }
                        group_change();
                    }
                    type_change();
                }
                size_change();

            }
            $('#quantity').val(1);
        }


    });
</script>
