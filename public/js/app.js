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
(function () {
    new Vue({
        el: '#proposal',
        data: {
            jobId: _jobId,
            userId: _userId,
            job: {},
            proposals: {},
            comments: {},
            commentData: {
                description: '',
                proposal_id: null,
                disableSendButton: true
            }
        },
        mounted() {
            let vm = this;
            vm.getJob();
            vm.loadNiceScroll();
        },
        methods: {
            getJob() {
                let vm = this;

                let pageUrl = window.location.origin + '/json/proposal/job/'+ vm.jobId;

                vm.$http.get(pageUrl).then(function (data) {
                    vm.job = data.data;
                }, function (error) {
                    swal(
                        'Ooops...',
                        'Ainda não existe(m) proposta(s) para este trabalho',
                        'warning'
                    ).then(function () {
                        window.location.href = window.location.origin + '/user/job/client';
                    })
                });
            },
            submitComment(proposalId) {
                let vm = this;

                let pageUrl = window.location.origin + '/json/proposal/comment';

                if (vm.proposal !== {}) {
                    vm.commentData.proposal_id = proposalId;
                    vm.$http.post(pageUrl, JSON.stringify(vm.commentData), { headers: { 'X-CSRF-TOKEN': _csrf_token}}).then(function (data) {
                        vm.commentData.description = '';
                        vm.getJob();
                    });
                }
            },
            enableSendButton () {
                let vm = this;

                if (vm.commentData.description.length > 0) {
                    vm.commentData.disableSendButton = false;
                    return;
                }

                vm.commentData.disableSendButton = true;
            },
            isMe (id) {
                let vm = this;
                if (id == vm.userId) {
                    return true;
                }

                return false;
            },
            loadNiceScroll() {
                setInterval(() => {
                    if (document.readyState === 'complete') {
                        // run after page has finished loading
                        $.fn.niceScroll &&  $(".nicescroll").niceScroll({ cursorcolor: '#98a6ad',cursorwidth:'6px', cursorborderradius: '5px'});
                    }
                }, 500);
            },
            acceptProposal(proposal) {
                let vm = this;

                let pageUrl = window.location.origin + '/user/proposal/accept';

                swal({
                    title: 'Você está certo disto?',
                    text: "Deseja aceitar a proposta de " + proposal.user.name + "?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Cancelar'
                }).then(function () {

                    vm.$http.post(pageUrl, {'_method': 'PUT', 'id': proposal.id}, { headers: { 'X-CSRF-TOKEN': _csrf_token}}).then(function (data) {
                        vm.commentData.description = '';
                        vm.getJob();
                        swal(
                            'Proposta aceita!',
                            'Proposta aceita com sucesso.',
                            'success'
                        )
                    }, function (error) {
                        swal(
                            'Oops, algo deu errado...',
                            error.body.error,
                            'error'
                        )
                    });
                });
            }
        }
    });
})();
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
                    text: "Você realmente deseja apagar o trabalho \"" + job.title + "\"?",
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
                            'Deletado!',
                            'O trabalho "'+ job.title + '" foi deletado com sucesso!',
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
(function () {
    new Vue({
        el: '#job',
        data: {
            jobId: _jobId,
            userId: _userId,
            ownerId: _ownerId,
            showProposal: false,
            proposal: {
                job_id: _jobId,
                description: '',
                net_value: 0.00,
                time_to_finish_the_job: ''
            },
            showProposalButton: false,
            showProposalFollowingButton: false
        },
        mounted() {
            let vm = this;
            vm.getProposal();
            vm.loadAutoNumeric();
        },
        methods: {
            getProposal() {
                let vm = this;

                let pageUrl = window.location.origin + '/json/proposal/job/'+ vm.jobId;

                if (vm.isMe(vm.ownerId)) {
                    vm.showProposalButton = false;
                    vm.showProposalFollowingButton = true;
                    return;
                }

                vm.$http.get(pageUrl).then(function (data) {
                    vm.showProposalButton = false;
                    vm.showProposalFollowingButton = true;

                }, function (error) {
                    if (error.status === 404) {
                        vm.showProposalButton = true;
                        vm.showProposalFollowingButton = false;
                    }
                });
            },
            submitData() {
                let vm = this;

                let pageUrl = window.location.origin + '/json/proposal';
                vm.proposal.net_value = $('.netvalue').autoNumeric('get');

                vm.$http.post(pageUrl, JSON.stringify(vm.proposal), { headers: { 'X-CSRF-TOKEN': _csrf_token}}).then(function (data) {
                    vm.redirectToProposal();
                });
            },
            redirectToProposal() {
                let vm = this;
                window.location.href = window.location.origin + '/user/proposal/job/' + vm.jobId;
            },
            showHideProposal() {
                let vm = this;

                if (vm.showProposal) {
                    vm.showProposal = false;
                    return;
                }

                vm.showProposal = true;
            },
            isMe (id) {
                let vm = this;
                if (id === vm.userId) {
                    return true;
                }

                return false;
            },
            loadAutoNumeric () {
                $('.netvalue').autoNumeric('init', {
                    vMin:'0.00',
                    vMax: '99999999.99',
                    aSep: '.',
                    aDec: ','
                });
            }
        },
        watch: {

        }
    });
})();
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