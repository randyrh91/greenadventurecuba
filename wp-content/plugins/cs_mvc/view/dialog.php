<div class="modal in" id="showModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <a href="#" id="btn_reserva_modal"  class="btn btn-danger" ><em class="fa fa-book"></em><?=__(CS_L_BOOKNOW)?></a>
                <a href="#" class="btn btn-default" data-dismiss="modal">&times; <?=__(CS_L_BUSCAROTRA)?></a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    function showModal(id,post_url) {
        var $ = jQuery;
        if(window.innerWidth>768) {
            event.preventDefault();

            var modal_body = $('#showModal .modal-body');
            $('#showModal').modal('show');
            modal_body.html(
                '<div class="progress progress-striped active"><div class="progress-bar progress-bar-info"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%"> <span class="sr-only">Loading ... </span> </div> </div>'
            )
            var url = "<?=View::genPathCA('home','Excursion','details')?>" + '&id=' + id;
            modal_body.load(url);
            $('#btn_reserva_modal').attr('href', post_url);
        }
    }
</script>