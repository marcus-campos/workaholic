<div id="user-data">
    <h4 class="m-t-0 header-title"><b>Dados pessoais</b></h4>
    <div class="row">
        <div class="col-12">
            <div class="p-20">
                <div class="form-group row">
                    <label class="col-2 col-form-label">Nome <span class="text-danger">*</span></label>
                    <div class="col-10">
                        <input name="name" type="text" class="form-control" placeholder="Ex: Marcus Vinicius Campos"
                               v-model="userData.name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Sobre</label>
                    <div class="col-10">
                        <textarea name="biography" type="text" class="form-control"
                                  placeholder="Ex: Trabalho como instalador de antenas a 30 anos..."
                                  v-model="userData.biography">

                        </textarea>
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
                <button type="submit" class="btn btn-success waves-effect waves-light" @click="submitUser()">
                   <span class="btn-label"><i class="fa fa-check"></i>
                   </span>Salvar
                </button>
            </div>
        </div>
    </div>
</div>