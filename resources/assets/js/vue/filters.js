(function () {
    Vue.filter('c-dmy', function (value) {
        if (!value) return 'A combinar';
        return moment(value).format('DD/MM/YYYY');
    });

    Vue.filter('dmyHHmm', function (value) {
        if (!value) return '';
        return moment(value).format('DD/MM/YYYY HH:mm');
    });

    Vue.filter('c-HHmm', function (value) {
        console.log(value);
        if (!value) return 'A combinar';
        return moment(value, 'hhmmss').format('HH:mm');
    });

    Vue.filter('HHmm', function (value) {
        if (!value) return '';
        return moment(value, 'hhmmss').format('HH:mm');
    });

})();