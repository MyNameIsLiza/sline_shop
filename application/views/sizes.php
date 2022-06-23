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
                <h2 class="sub-header">Розміри</h2>
            </div>
            <div class="col-md-3">
                <button id="edit_button" class="btn btn-success" type="submit">Додати нові розміри</button>
            </div>
            <div class="col-md-2">
                <input id="name" type="text" class="form-control" placeholder="Назва" name="name" required>
            </div>

            <div class="col-md-1">
                <button id="cancel_button" class="btn btn-danger invisible" <!--onclick="cansel(this)"-->
                >Відміна</button>
            </div>
        </div>
    </form>

    <div id="accordion">
        <?php $l_size_id = null; ?>
        <?php foreach ($sizes as $size): ?>
            <?php if ($l_size_id != $size['size_id']): ?>
                <?php if ($l_size_id != null): ?>
                    </div>
                    </div>
                    </div>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header" id="heading<?= $size['size_id'] ?>">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?= $size['size_id'] ?>"
                                    aria-expanded="true"
                                    aria-controls="collapseOne">
                                Група розмірів: <?= $size['size_id'] ?>
                            </button>
                        </h5>
                    </div>
                    <div id="collapse<?= $size['size_id'] ?>" class="collapse" aria-labelledby="heading<?= $size['size_id'] ?>"
                         data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-1 size_id">
                                    <?= $size['size'] ?>
                                </div>
                <?php $l_size_id = $size['size_id'] ?>
            <?php else: ?>
                <div class="col-md-1 size_id">
                    <?= $size['size'] ?>
                </div>
            <?php endif; ?>

        <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
</div>


</div>
<script>


    /* $('#add_form').submit(function (event) {
         var edit_button = $('#edit_button');
         var edit_id = edit_button.data('edit_id');
         var data = $('#add_form').serialize();
         if(edit_button.data('edit_id')  == 0){
             $.post( "sizes/add", data, function( result ) {
                 if(result.id){
                     $('#my_table').find('tr:last-child').clone().appendTo( "#my_table" );
                     var last_child = $('#my_table').find('tr:last-child');
                     last_child.attr("id","size_id_"+result.id);
                     last_child.find('.size_id').html(result.id);
                     last_child.find('.size_name').html(result.name);
                     last_child.find('button').data("id",result.id);
                 }
             }, "json");
         }else{
             data += "&id="+edit_id;
             $.post("sizes/edit", data, function (result) {
                 //console.log(result.id);
                 //if(result.id){
                 var name = $('#name');
                 var r_id = $('#r_id');
                 var rt_id = $('#rt_id');
                 var parent = $('#size_id_' + edit_id);

                 parent.find('.size_name').html(name.val());
                 parent.find('.size_r_id').html(parseInt(r_id.val()));
                 parent.find('.size_r_id').html(parseInt(rt_id.val()));

                 cansel();
                 //}
             }, "json");
             event.preventDefault();


         }
     });

     function delete_size(object) {
         var id = $(object).data('id');
         var name = $('#size_id_' + id).find('.size_name').html();
         var answer = window.confirm("Ви впевнені, що бажаєте видалити тип " + name + "?");
         if (answer) {
             $.post("sizes/delete", {id: id}, function (result) {
                 console.log(result);
                 if (result) {
                     $('#size_id_' + id).remove();
                 }
             });
         }
     }

     function edit_size(object) {
         var edit_id = $(object).data('id');
         var name = $('#size_id_' + edit_id).find('.size_name').html();
         var r_id = $('#size_id_' + edit_id).find('.size_r_id').html();
         var rt_id = $('#size_id_' + edit_id).find('.size_rt_id').html();
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
     }*/
</script>
