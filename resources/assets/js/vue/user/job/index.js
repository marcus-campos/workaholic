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
            vm.loadTooltips();
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

                if(vm.page === '/user/job/client/accepted') {
                    pageUrl = pageUrl || window.location.origin + '/json/job/client/accepted';
                }

                if(vm.page === '/user/job/worker') {
                    pageUrl = pageUrl || window.location.origin + '/json/job/worker';
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
            submitDelete: function (job) {
                let vm = this;

                pageUrl = window.location.origin + '/user/job/'+ job.id;

                swal({
                    title: 'Você está certo disto?',
                    text: "Você realmente concluir este trabalho \"" + job.title + "\"?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Cancelar'
                }).then(function () {
                    vm.$http.post(pageUrl, {'_method': 'DELETE'}, { headers: { 'X-CSRF-TOKEN': _csrf_token}}).then(function (data) {
                        vm.getJobs();

                        swal(
                            'Concluído!',
                            'O trabalho "'+ job.title + '" foi concluído!',
                            'success'
                        );
                    }, function (error) {
                        swal(
                            'Oops, algo deu errado...',
                            error.body.error,
                            'error'
                        )
                    });
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
            },
            loadTooltips: function () {
                setInterval(() => {
                    if (document.readyState === 'complete') {
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                }, 100);
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