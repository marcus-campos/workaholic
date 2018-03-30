(function () {
    Vue.filter('c-dmy', function (value) {
        if (!value) return 'A combinar';
        return moment(value).format('DD/MM/YYYY');
    });

    Vue.filter('dmyHHss', function (value) {
        if (!value) return '';
        return moment(value).format('DD/MM/YYYY HH:ss');
    });

    Vue.filter('c-HHss', function (value) {
        if (!value) return 'A combinar';
        return moment(value).format('HH:ss');
    });

    Vue.filter('HHss', function (value) {
        if (!value) return '';
        return moment(value).format('HH:ss');
    });

})();