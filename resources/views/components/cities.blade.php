<select class="form-control" id="city" name="city"></select>

@section('component-css')
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('component-js')
    <script src="{{ asset('plugins/underscore/underscore-min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/select2/js/i18n/pt-BR.js') }}" type="text/javascript"></script>

    <script>
        $(function() {

            loadCities();
            function loadCities() {
                $.getJSON('{{ asset('storage/cities/estados-cidades.json') }}', function (json) {
                    var dataResult = [];
                    json.estados.forEach(function (currentValue, index, arr) {

                        var cities = [];
                        currentValue.cidades.forEach(function (currentCity, index, arr) {
                            cities.push({
                                id: currentCity,
                                text: currentCity
                            })
                        });

                        dataResult.push({
                            text: currentValue.nome,
                            children: cities
                        });
                    });

                    $('#city').select2({
                        "language": "pt-BR",
                        placeholder: "Selecione uma cidade",
                        data: dataResult
                    });

                    setTimeout(function () {
                        $('#city').val(null).trigger('change');
                    }, 0)
                });
            }
        });
    </script>
@endsection