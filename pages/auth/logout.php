<div id="logout" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal tambah user content-->
        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header bg-danger text-white">
                <span class="modal-title"><i class="fa fa-sign-out-alt fa-xs"></i> Keluar</span>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <span class="mb-2">Anda yakin akan keluar?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" name="keluar" class="btn btn-danger btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-sign-out-alt"></i>
                        </span>
                        <span class="text"> Logout</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
if (isset($_POST['keluar'])) {
    session_start();
    session_destroy();
    echo "
            <script type='text/javascript'>
                alert('Akun berhasil keluar');
                window.location.href='index.php';
            </script>
    ";
}
?>