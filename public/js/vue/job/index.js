(function () {
    new Vue({
        el: '#index-jobs',
        data: {
            jobs: [],
            page: window.location.pathname,
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

                if(vm.page === '/user/job') {
                    pageUrl = pageUrl || window.location.origin + '/json/job';
                }

                if(vm.page === '/user/job/client') {
                    pageUrl = pageUrl || window.location.origin + '/json/job/client';
                }

                if (vm.search !== '') {
                    pageUrl += '?filters=' + encodeURIComponent('[["title","like","%' + vm.search + '%"]]');
                }

                vm.$http.get(pageUrl).then(function (data) {
                    let result = data.data;
                    vm.jobs = result.data;
                    vm.makePagination(result);
                });
            },
            applyFilter: debounce(function () {
                let vm = this;
                vm.getJobs();
            }),
            submitDelete: function (id) {
                let vm = this;

                pageUrl = window.location.origin + '/user/job/'+ id;

                vm.$http.post(pageUrl, {'_method': 'DELETE'}, { headers: { 'X-CSRF-TOKEN': _csrf_token}}).then(function (data) {
                    vm.getJobs()
                });
            },
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