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

    <hr>

    <h4 class="m-t-0 header-title"><b>Trocar senha</b></h4>
    <div class="row">
        <div class="col-12">
            <div class="p-20">
                <div class="form-group row">
                    <label class="col-2 col-form-label">Senha atual <span class="text-danger">*</span></label>
                    <div class="col-10">
                        <input type="password" class="form-control" v-model="passwordData.oldPassword">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label">Nova senha <span class="text-danger">*</span></label>
                    <div class="col-10">
                        <input type="password" class="form-control" v-model="passwordData.password">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label">Confirmar nova senha <span class="text-danger">*</span></label>
                    <div class="col-10">
                        <input type="password" class="form-control" v-model="passwordData.password_confirmation">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <!-- end row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="text-sm-center">
                <button type="submit" class="btn btn-success waves-effect waves-light" @click="submitPassword()">
                   <span class="btn-label"><i class="fa fa-check"></i>
                   </span>Salvar
                </button>
            </div>
        </div>
    </div>
</div>