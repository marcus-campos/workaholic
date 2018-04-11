<div id="city-partial">
    <select class="form-control select2 select2-hidden-accessible" id="city_id" name="city_id">
        <option></option>
    </select>
</div>

@section('component-css')
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('component-js')
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/select2/js/i18n/pt-BR.js') }}" type="text/javascript"></script>

    <script>
        $(function() {
            new Vue({
                el: '#city-partial',
                data: {

                },
                mounted() {
                    let vm = this;
                    vm.getCity();
                },
                methods: {
                    getCity() {
                        let vm = this;
                        let pageUrl = window.location.origin + '/json/city/name/';

                        $('#city_id').select2({
                            "language": "pt-BR",
                            placeholder: "Selecione uma cidade",
                            minimumInputLength: 2,
                            ajax: {
                                url: function (params) {
                                    console.log(pageUrl + params.term);
                                    return pageUrl + params.term;
                                },
                                dataType: 'json',
                                type: "GET",
                                delay: 250,
                                quietMillis: 50,
                                cache: true,
                                processResults: function (data, params) {

                                    let dataResult = [];

                                    data.forEach(function (state) {
                                        let cities = [];

                                        state.cities.forEach(function (currentCity) {
                                            cities.push({
                                                id: currentCity.id,
                                                text: currentCity.name
                                            })
                                        });

                                        dataResult.push({
                                            text: state.name,
                                            children: cities
                                        });
                                    });

                                   return {
                                       results: dataResult
                                   }
                                },
                            }
                        });
                    }
                },
                watch: {

                }
            });
        });
    </script>
@endsection