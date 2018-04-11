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
    <script src="{{ asset('js/vue/cities/cities.js') }}" type="text/javascript"></script>
@endsection