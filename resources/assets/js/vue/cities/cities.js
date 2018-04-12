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
        }
    });
});