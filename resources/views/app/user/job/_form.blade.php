<div class="col-sm-12">
    <div class="card-box">
        <h5 class="text-muted text-uppercase m-t-0 m-b-20"><b>Cadastrar um novo job</b></h5>

        <div class="form-group m-b-20">
            <label>Titulo <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" placeholder="Ex: Instalador de antena">
        </div>

        <div class="form-group m-b-20">
            <label>Categoria <span class="text-danger">*</span></label>
            <select class="form-control">
                @foreach($jobCategories as $jobCategory)
                    <option value="{{ $jobCategory->id }}">{{ $jobCategory->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group m-b-20">
            <label>Descrição<span class="text-danger">*</span></label>
            <textarea class="form-control" rows="5" placeholder="Ex: Preciso de uma pessoa para instalar várias antenas preparadas para o sinal digital no meu condominio."></textarea>
        </div>

        <div class="form-group m-b-20">
            <label></label>
            <textarea class="form-control" rows="3" placeholder="Please enter summary"></textarea>
        </div>

        <div class="form-group m-b-20">
            <label>Categories <span class="text-danger">*</span></label>
            <select class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                <option>Select</option>
                <optgroup label="Shopping">
                    <option value="SH1">Shopping 1</option>
                    <option value="SH2">Shopping 2</option>
                    <option value="SH3">Shopping 3</option>
                    <option value="SH4">Shopping 4</option>
                </optgroup>
                <optgroup label="CRM">
                    <option value="CRM1">Crm 1</option>
                    <option value="CRM2">Crm 2</option>
                    <option value="CRM3">Crm 3</option>
                    <option value="CRM4">Crm 4</option>
                </optgroup>
                <optgroup label="eCommerce">
                    <option value="E1">eCommerce 1</option>
                    <option value="E2">eCommerce 2</option>
                    <option value="E3">eCommerce 3</option>
                    <option value="E4">eCommerce 4</option>
                </optgroup>

            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 475.5px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-xu04-container"><span class="select2-selection__rendered" id="select2-xu04-container" title="Select">Select</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>

        </div>

        <div class="form-group m-b-20">
            <label>Price <span class="text-danger">*</span></label>
            <input type="text" class="form-control" value="$ 562.56">
        </div>

        <div class="form-group m-b-20">
            <label class="m-b-15">Status <span class="text-danger">*</span></label>
            <br>
            <div class="radio radio-inline">
                <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked="">
                <label for="inlineRadio1"> Online </label>
            </div>
            <div class="radio radio-inline">
                <input type="radio" id="inlineRadio2" value="option2" name="radioInline">
                <label for="inlineRadio2"> Offline </label>
            </div>
            <div class="radio radio-inline">
                <input type="radio" id="inlineRadio3" value="option3" name="radioInline">
                <label for="inlineRadio3"> Draft </label>
            </div>
        </div>

        <div class="form-group m-b-10">
            <label>Comment</label>
            <textarea class="form-control" rows="3" placeholder="Please enter summary"></textarea>
        </div>


    </div>
</div>