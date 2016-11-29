<!-- Necessario para upload de arquivos -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Upload de Apostilas</h4>
            </div>
            <div class="modal-body">
                <div width="100%" align="center">
                <div id="notificacao_sucesso" style="display: none;" class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <center>Sucesso!!! Obrigado por compartilhar uma apostila com o Yeeba, você acaba de ganhar postos por isso.</center>
                </div>
                <div class="panel-body">
                    <form action="include/ProcessUpload.php" onSubmit="return false" method="POST" enctype="multipart/form-data" id="MyUploadForm">
                        <input class="email-form" type="text" name="nome_arquivo" placeholder=" T&iacute;tulo do arquivo [ex: Apostila de PHP]" maxlength="80" required nome=nome /><br />
                        <input name="ImageFile" id="imageInput" type="file" required file=file/>
                        <img src="../images/ajax-loader.gif" width="40" id="loading-img" style="display:none;" alt="Aguarde..."/>
                </div>   
                    <div id="progressbox" style="display:none;"><div id="progressbar"></div ><div id="statustxt">0%</div></div>
                    <div id="output"></div>
                </div>
                <img src="../images/uploadbanner.png" width="100%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input style="cursor: pointer;" type="submit" class="btn btn-primary"  id="submit-btn" value="Upload" />
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

