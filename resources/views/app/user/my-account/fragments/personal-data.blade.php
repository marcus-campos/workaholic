<form class="form-horizontal" role="form" method="post" action="#">
    <h4 class="m-t-0 header-title"><b>Dados pessoais</b></h4>
    <div class="row">
        <div class="col-12">
            <div class="p-20">
                <div class="form-group row">
                    <label class="col-2 col-form-label">Nome</label>
                    <div class="col-10">
                        <input name="name" type="text" class="form-control" placeholder="Ex: Marcus Vinicius Campos"
                               value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Email</label>
                    <div class="col-10">
                        <input type="text" class="form-control" value="dsadsad@dsadsa.com" disabled="true">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Sobre</label>
                    <div class="col-10">
                        <textarea name="biography" type="text" class="form-control"
                                  placeholder="Ex: Trabalho como instalador de antenas a 30 anos..."></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

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