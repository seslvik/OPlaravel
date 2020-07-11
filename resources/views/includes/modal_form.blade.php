<!-- Bootstrap Modals -->
<div class="row">
    <div class="col-12">
        <!-- sample modal content -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Удаление объекта</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        {{--<h6>Удаление объекта</h6>--}}
                        <p>Вы действительно хотите удалить объект:</p>

                        <hr>
                        <input type="text" name="user_id" id="user_id" value="" hidden/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <form method="post" action="">{{--{{route('operplan.'.$zavod.'.destroy', }}--}}
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Удалить</button>
                        </form>
                        {{--<button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>--}}
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</div>
