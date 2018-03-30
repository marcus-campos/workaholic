<div class="row" v-show="showProposal">
    <div class="col-sm-12">
        <div class="card-box">
            <h5 class="text-muted text-uppercase m-t-0 m-b-20"><b>Fazer uma proposta</b></h5>

            <div class="form-group m-b-20">
                <label>Detalhes da proposta<span class="text-danger">*</span></label>
                <textarea class="form-control" v-model="proposal.description" rows="5" placeholder="Ex: Irei instalar 4 antenas mais amplificadores de sinais com saidas para todos os apartamentos"></textarea>
            </div>

            <div class="form-group m-b-20">
                <div class="row col-sm-12 p-0 m-0">
                    <div class="col-sm-4 p-0">
                        <label>Valor líquido a cobrar<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="proposal.net_value" />
                    </div>
                    <div class="col-sm-8 p-r-0">
                        <label>De quanto tempo você precisa para finalizar o trabalho?<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="proposal.time_to_finish_the_job" placeholder="Ex: 2 dias ou 4 horas" />
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-group m-b-0 col-md-12 text-center">
                <input type="submit" class="btn btn-primary" value="Enviar proposta" @click="submitData()">
            </div>
        </div>
    </div>
</div>