<style>
    .jumbotron {
        padding-right: 60px;
        padding-left: 60px;
    }

</style>
<div class="jumbotron">
    <form id="add_form" class="needs-validation">
        <div class="row">
            <div class="col-md-3">
                <h2 class="sub-header">Групи товарів</h2>
            </div>
            <div class="col-md-2">
                <button id="edit_button" class="btn btn-success" type="submit">Додати нову групу</button>
            </div>
            <div class="col-md-2">
                <input id="name" type="text" class="form-control" placeholder="Назва" name="name" required>
            </div>
            <div class="col-md-2">
                <input id="r_id" type="text" class="form-control" placeholder="RID" name="r_id"
                       data-inputmask="'mask': '99'" required>
            </div>
            <div class="col-md-2">
                <input id="rt_id" type="text" class="form-control" placeholder="RtID" name="rt_id"
                       data-inputmask="'mask': '99'" required>
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
                <th>RID</th>
                <th>RtID</th>
            </tr>
            </thead>
            <tbody id="my_table">
            <?php foreach ($groups as $group): ?>
                <tr id="group_id_<?= $group['id'] ?>">
                    <td class="group_id"><?= $group['id'] ?></td>
                    <td class="group_name"><?= $group['name'] ?></td>
                    <td class="group_r_id"><?= $group['r_id'] ?></td>
                    <td class="group_rt_id"><?= $group['rt_id'] ?></td>
                    <td>
                        <button data-id="<?= $group['id'] ?>" class="btn btn-warning btn-sm"
                                onclick="delete_group(this)">Х
                        </button>
                    </td>
                    <td>
                        <button data-id="<?= $group['id'] ?>" class="btn btn-info btn-sm" onclick="edit_group(this)">
                            Редагувати
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('#r_id').inputmask();
    $('#rt_id').inputmask();


    $('#add_form').submit(function (event) {
        const edit_button = $('#edit_button');
        const edit_id = edit_button.data('edit_id');
        let data = $('#add_form').serialize();
        console.log('edit_id', edit_id);
        if(!edit_id){
            $.post( "groups/add", data, function( result ) {
                if(result.id){
                    $('#my_table').find('tr:last-child').clone().appendTo( "#my_table" );
                    var last_child = $('#my_table').find('tr:last-child');
                    last_child.attr("id","group_id_"+result.id);
                    last_child.find('.group_id').html(result.id);
                    last_child.find('.group_name').html(result.name);
                    last_child.find('.group_r_id').html(result.r_id);
                    last_child.find('.group_rt_id').html(result.rt_id);
                    last_child.find('button').data("id",result.id);
                }
            }, "json");
        }else{
            data += "&id="+edit_id;
            $.post("groups/edit", data, function (result) {
                //console.log(result.id);
                //if(result.id){
                var name = $('#name');
                var r_id = $('#r_id');
                var rt_id = $('#rt_id');
                var parent = $('#group_id_' + edit_id);

                parent.find('.group_name').html(name.val());
                parent.find('.group_r_id').html(parseInt(r_id.val()));
                parent.find('.group_rt_id').html(parseInt(rt_id.val()));

                cansel();
                //}
            }, "json");
            event.preventDefault();
        }
    });

    function delete_group(object) {
        var id = $(object).data('id');
        var name = $('#group_id_' + id).find('.group_name').html();
        var answer = window.confirm("Ви впевнені, що бажаєте видалити тип " + name + "?");
        if (answer) {
            $.post("groups/delete", {id: id}, function (result) {
                console.log(result);
                if (result) {
                    $('#group_id_' + id).remove();
                }
            });
        }
    }

    function edit_group(object) {
        var edit_id = $(object).data('id');
        var name = $('#group_id_' + edit_id).find('.group_name').html();
        var r_id = $('#group_id_' + edit_id).find('.group_r_id').html();
        var rt_id = $('#group_id_' + edit_id).find('.group_rt_id').html();
        $('#name').val(name).focus();
        $('#r_id').val(r_id);
        $('#rt_id').val(rt_id);
        $('#edit_button').text('Зберегти').removeClass('btn-success').addClass('btn-info')
            .data('edit_id', edit_id);
        $('#cancel_button').removeClass('invisible');
    }
    function cansel(object) {
        $('#name').val("");
        $('#r_id').val("");
        $('#rt_id').val("");
        $('#edit_button').text('Додати нову групу').removeClass('btn-info').addClass('btn-success').data('edit_id', "0");
        $('#cancel_button').addClass('invisible');
    }
</script>
