<form class="form-horizontal" role="form" method="post" action="#">
    <h4 class="m-t-0 header-title"><b>Dados pessoais</b></h4>
    <div class="row">
        <div class="col-12">
            <div class="p-20">
                <div class="form-group row">
                    <label class="col-2 col-form-label">Nome</label>
                    <div class="col-10">
                        <input name="name" type="text" class="form-control" placeholder="Ex: Marcus Vinicius Campos" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Email</label>
                    <div class="col-10">
                        <input type="text" class="form-control" value="dsadsad@dsadsa.com" disabled="true">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">verification</label>
                    <div class="col-10">
                        <input name="facebook_verification" type="text" class="form-control" placeholder="verification" value="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <hr>

    <h4 class="m-t-0 header-title"><b>Microsoft BotFramework</b></h4>
    <p class="text-muted m-b-30 font-14">
        Microsoft BotFramework: <code>app_id</code>, <code>app_key</code>, <code>bot_handle</code>.
    </p>
    <div class="row">
        <div class="col-12">
            <div class="p-20">
                <div class="form-group row">
                    <label class="col-2 col-form-label">app_id</label>
                    <div class="col-10">
                        <input name="botframework_app_id" type="text" class="form-control" placeholder="app_id" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">app_key</label>
                    <div class="col-10">
                        <input name="botframework_app_key" type="text" class="form-control" placeholder="app_key" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">bot_handle</label>
                    <div class="col-10">
                        <input name="botframework_bot_handle" type="text" class="form-control" placeholder="bot_handle" value="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <!-- end row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="text-sm-center">
                <button type="submit" class="btn btn-success waves-effect waves-light">
                   <span class="btn-label"><i class="fa fa-check"></i>
                   </span>Salvar
                </button>
            </div>
        </div>
    </div>
</form>