<style>
    .jumbotron{
        padding-right: 60px;
        padding-left: 60px;
    }

</style>
<div class="jumbotron">
    <form id = "add_form" class="needs-validation">
        <div class="row">
            <div class="col-md-3">
                <h2 class="sub-header">Типи товарів</h2>
            </div>
            <div class="col-md-2">
                <select class="form-control" name="group_id" onchange="type_change(this)">
                    <?php foreach ($groups as $group):?>
                        <option value="<?=$group['id']?>"><?=$group['name']?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-md-2">
                <button id="edit_button" class="btn btn-success" type="submit">Додати новий тип</button>
            </div>
            <div class="col-md-2">
                <input id="name" type="text" class="form-control" placeholder="Назва" name="name" required>
            </div>
            <div class="col-md-1">
                <button id="cancel_button" class="btn btn-danger invisible" onclick="cansel(this)">Відміна</button>
            </div>

        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Назва</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="my_table">
            <?php foreach ($types as $type):?>
                <tr id="type_id_<?=$type['id']?>">
                    <td class="type_id"><?=$type['id']?></td>
                    <td class="type_name"><?=$type['name']?></td>
                    <td><button data-id="<?=$type['id']?>" class="btn btn-warning btn-sm" onclick="delete_type(this)">Х</button></td>
                    <td><button data-id="<?=$type['id']?>" class="btn btn-info btn-sm" onclick="edit_type(this)">Редагувати</button></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('#r_id').inputmask();
    $('#rt_id').inputmask();


    $('#add_form').submit(function (event) {
        var edit_button = $('#edit_button');
        var edit_id = edit_button.data('edit_id');
        var data = $('#add_form').serialize();
        if(edit_button.data('edit_id')  == 0){
            $.post( "types/add", data, function( result ) {
                if(result.id){
                    console.log(result.id)
                    $('#my_table').find('tr:last-child').clone().appendTo( "#my_table" );
                    var last_child = $('#my_table').find('tr:last-child');
                    last_child.attr("id","type_id_"+result.id);
                    last_child.find('.type_id').html(result.id);
                    last_child.find('.type_name').html(result.name);
                    last_child.find('button').data("id",result.id);
                }
            }, "json");
        }else{
            data += "&id="+edit_id;
            $.post( "types/edit", data, function( result ) {
                /*console.log(result.id);
                if(result.id){*/
                    console.log(edit_id);
                    var name = $('#name');

                    var parent = $('#type_id_' + edit_id);

                    parent.find('.type_name').html(name.val());
                    cansel();
                //}
            }, "json");
        }
        event.preventDefault();
    });

    function delete_type(object) {
        var id = $(object).data('id');
        var name = $('#type_id_' + id).find('.type_name').html();
        var answer = window.confirm("Ви впевнені, що бажаєте видалити тип "+name+"?");

        if (answer) {
            $.post("types/delete", {id: id}, function (result) {
                if (result) {
                    $('#type_id_' + id).remove();
                }
            });
        }
    }

    function edit_type(object) {
        var edit_id = $(object).data('id');
        var name = $('#type_id_' + edit_id).find('.type_name').html();

        $('#name').val(name).focus();
        $('#edit_button').text('Зберегти')
            .removeClass('btn-success').addClass('btn-info')
            .data('edit_id', edit_id);
        $('#cancel_button').removeClass('invisible');
    }

    function type_change(selectObject){
        $.post(
            "types/get",
            {group_id: selectObject.value},
            function (response) {
                $('#my_table').html(response);

/*                var types = $('#types');
                types.empty();
                $.each(response, function( index, value ) {
                    types.append('<option value="'+value.id+'">'+value.name+'</option>');
                });*/
            });
    }
    function cansel(object) {
        $('#name').val("");
        $('#edit_button').text('Додати нову групу').removeClass('btn-info').addClass('btn-success')
            .data('edit_id', "0");
        $('#cancel_button').addClass('invisible');
    }
</script>
