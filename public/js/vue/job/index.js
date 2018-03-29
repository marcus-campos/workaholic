(function () {
    new Vue({
        el: '#index-jobs',
        data: {
            jobs: [],
            pagination: {},
            search: ''
        },
        mounted() {
            let vm = this;
            vm.getJobs();
        },
        methods: {
            getJobs: function (pageUrl) {
                let vm = this;
                pageUrl = pageUrl ||  window.location.origin + '/user/job/client';

                if (vm.search !== '') {
                    pageUrl += '?filters=' + encodeURIComponent('[["title","like","%' + vm.search + '%"]]');
                }

                vm.$http.get(pageUrl).then(function (data, status, request) {
                    let result = data.data;
                    vm.jobs = result.data.map(i => i);
                    vm.makePagination(result);
                });
            },
            applyFilter: debounce(function () {
                let vm = this;
                vm.getJobs();
            }),
            makePagination: function (data) {
                let vm = this;
                let pagination = {
                    current_page: data.current_page,
                    last_page: data.last_page,
                    next_page_url: data.next_page_url,
                    prev_page_url: data.prev_page_url
                };

                vm.pagination = pagination;
            }
        },
        watch: {
            search: function () {
                let vm = this;
                vm.applyFilter();
            }
        }
    });
})();

function debounce(func) {
    var wait = arguments.length <= 1 || arguments[1] === undefined ? 100 : arguments[1];

    var timeout = void 0;
    return function () {
        var vm = this;

        for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
            args[_key] = arguments[_key];
        }

        clearTimeout(timeout);
        timeout = setTimeout(function () {
            func.apply(vm, args);
        }, wait);
    };
}