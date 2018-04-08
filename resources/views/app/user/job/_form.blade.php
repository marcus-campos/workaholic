<div class="col-sm-12">
    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Opa!</strong> Encontramos alguns erros.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card-box">
        <h5 class="text-muted text-uppercase m-t-0 m-b-20"><b>Cadastrar um novo job</b></h5>

        <div class="form-group m-b-20">
            <label>Titulo <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" placeholder="Ex: Instalador de antena" value="{{ inputValue('title', get_defined_vars(), ['job' => 'title']) }}">
        </div>

        <div class="form-group m-b-20">
            <label>Categoria <span class="text-danger">*</span></label>
            <select class="form-control" id="job_category_id" name="job_category_id">
                @foreach($jobCategories as $jobCategory)
                    <option value="{{ $jobCategory->id }}">{{ $jobCategory->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group m-b-20">
            <label class="m-b-15">Trabalho remoto? <span class="text-danger">*</span></label>
            <br>
            <div class="radio radio-inline">
                <input type="radio" value="1" name="remote" {{ ($remote = inputValue('remote', get_defined_vars(), ['job' => 'remote'])) == 1 ? 'checked' : '' }}>
                <label for="inlineRadio1"> Sim </label>
            </div>
            <div class="radio radio-inline">
                <input type="radio" value="0" name="remote"  {{ ($remote = inputValue('remote', get_defined_vars(), ['job' => 'remote'])) == 0 OR $remote == null ? 'checked' : '' }}>
                <label for="inlineRadio2"> Não </label>
            </div>
        </div>

        <div class="form-group m-b-20">
            <label>Cidade </label>
            @include('components.cities')
        </div>

        <div class="form-group m-b-20">
            <label>Bairro </label>
            <input type="text" class="form-control" name="neighborhood" id="neighborhood" value="{{ inputValue('neighborhood', get_defined_vars(), ['job' => 'neighborhood']) }}" />
        </div>

        <div class="form-group m-b-20 col-md-12 p-0">
            <label class="m-b-15">Quando?</label>
            <div class="row">
                <div class="col-md-4">
                    Dia: <input class="form-control" type="date" name="specific_date" value="{{ inputValue('specific_date', get_defined_vars(), ['job' => 'specific_date']) }}">
                </div>
                <div class="col-md-4">
                    De: <input class="form-control" type="time" name="initial_time" value="{{ inputValue('initial_time', get_defined_vars(), ['job' => 'initial_time']) }}">
                </div>
                <div class="col-md-4">
                    Até: <input class="form-control" type="time" name="final_time" value="{{ inputValue('final_time', get_defined_vars(), ['job' => 'final_time']) }}">
                </div>
            </div>
        </div>

        <div class="form-group m-b-20">
            <label>Descrição<span class="text-danger">*</span></label>
            <textarea class="form-control" name="description" rows="5" placeholder="Ex: Preciso de uma pessoa para instalar várias antenas preparadas para o sinal digital no meu condominio.">{{ inputValue('description', get_defined_vars(), ['job' => 'description']) }}</textarea>
        </div>

        <hr>

        <div class="form-group m-b-0 col-md-12 text-center">
            <input type="submit" class="btn btn-primary" value="Publicar">
        </div>
    </div>
</div>

@section('section-js')
    <script>
        $(function() {
            $('#job_category_id').select2({
                placeholder: "Selecione uma categoria"
            });

            $('#job_category_id').val(['{{ ($jobId = inputValue('job_category_id', get_defined_vars(), ['job' => 'job_category_id'])) ? $jobId : 'null' }}']).trigger('change');

            setTimeout(function () {
                $('#city_id').val(['{{ ($cityId = inputValue('city_id', get_defined_vars(), ['job' => 'city_id'])) ? (is_string($cityId) ? (new \App\Models\City())->cityFromToId($cityId) : (new \App\Models\City())->cityFromToName($cityId)) : 'null' }}']).trigger('change');
            }, 1000);
        });
    </script>
@endsection