<div id="user-address">
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-default btn-md waves-effect waves-light m-b-30 pull-right" data-animation="fadein" data-plugin="custommodal"
               data-overlaySpeed="200" data-overlayColor="#36404a" v-show="!isCreatingOrEditing" @click="clickAdd()"><i class="md md-add"></i> Cadastrar</a>

            <a class="btn btn-danger btn-md waves-effect waves-light m-b-30 pull-right" data-animation="fadein" data-plugin="custommodal"
               data-overlaySpeed="200" data-overlayColor="#36404a"  v-show="isCreatingOrEditing" @click="clickAdd()"><i class="md md-delete"></i> Cancelar</a>
        </div>
    </div>
    <div v-show="!isCreatingOrEditing">
        <div class="row" v-for="address in addresses">
            <div class="col-sm-12">
                <div class="card-box m-b-10">
                    <div class="table-box opport-box">
                        <div class="row">
                            <div class="col-sm-10">
                                <p class="text-dark m-b-0"><b>Logradouro: </b> <span class="text-muted">  @{{ address.address }}  </span></p>
                                <p class="text-dark m-b-0"><b>Numero: </b> <span class="text-muted">  @{{ address.number }}  </span></p>
                                <p class="text-dark m-b-0"><b>Complemento: </b> <span class="text-muted"> @{{ address.complement }} </span></p>
                                <p class="text-dark m-b-0"><b>Bairro:</b> <span class="text-muted">  @{{ address.neighborhood }}  </span></p>
                                <p class="text-dark m-b-0"><b>Cep:</b> <span class="text-muted">  @{{ address.zip_code }}d  </span></p>
                                <p class="text-dark m-b-0"><b>Cidade:</b> <span class="text-muted">  @{{ address.city.name  }}  </span></p>
                            </div>
                            <div class="col-sm-2">
                                <a class="job-action-btn" ><i class="md md-edit"></i></a>
                                <a href="#" @click="submitDelete(address)" class="job-action-btn" ><i class="md md-close"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-if="pagination.last_page > 1">
            <div class="col-sm-12">
                <div class="text-center m-b-10">
                    <button class="btn btn-default m-r-15" @click="getAddresses(pagination.prev_page_url)"
                            :disabled="!pagination.prev_page_url">
                        Voltar
                    </button>
                    <span>Pagina @{{pagination.current_page}} de @{{pagination.last_page}}</span>
                    <button class="btn btn-default m-l-15" @click="getAddresses(pagination.next_page_url)"
                            :disabled="!pagination.next_page_url">Próximo
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div v-show="isCreatingOrEditing">
        <h4 class="m-t-0 header-title"><b>Novo endereço</b></h4>
        <div class="row">
            <div class="col-12">
                <div class="p-20">
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Logradouro</label>
                        <div class="col-10">
                            <input type="text" class="form-control" placeholder="Ex: Rua ABC"
                                   v-model="addressData.address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Número</label>
                        <div class="col-10">
                            <input type="text" class="form-control" placeholder="Ex: Rua ABC"
                                   v-model="addressData.number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Complemento</label>
                        <div class="col-10">
                            <input name="name" type="text" class="form-control" placeholder="Ex: Rua ABC"
                                   v-model="addressData.complement">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Bairro</label>
                        <div class="col-10">
                            <input name="name" type="text" class="form-control" placeholder="Ex: Rua ABC"
                                   v-model="addressData.neighborhood">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Cep</label>
                        <div class="col-10">
                            <input name="name" type="text" class="form-control" placeholder="Ex: Rua ABC"
                                   v-model="addressData.zip_code">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Cidade</label>
                        <div class="col-10">
                            @include('components.cities')
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
                    <button type="submit" class="btn btn-success waves-effect waves-light" @click="submitAddress()">
                       <span class="btn-label"><i class="fa fa-check"></i>
                       </span>Salvar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>