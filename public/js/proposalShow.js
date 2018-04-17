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
        mounted: function mounted() {
            var vm = this;
            vm.getJob();
            vm.loadNiceScroll();
        },

        methods: {
            getJob: function getJob() {
                var vm = this;

                var pageUrl = window.location.origin + '/json/proposal/job/' + vm.jobId;

                vm.$http.get(pageUrl).then(function (data) {
                    vm.job = data.data;
                }, function (error) {
                    swal('Ooops...', 'Ainda não existe(m) proposta(s) para este trabalho', 'warning').then(function () {
                        window.location.href = window.location.origin + '/user/job/client';
                    });
                });
            },
            submitComment: function submitComment(proposalId) {
                var vm = this;

                var pageUrl = window.location.origin + '/json/proposal/comment';

                if (vm.proposal !== {}) {
                    vm.commentData.proposal_id = proposalId;
                    vm.$http.post(pageUrl, JSON.stringify(vm.commentData), { headers: { 'X-CSRF-TOKEN': _csrf_token } }).then(function (data) {
                        vm.commentData.description = '';
                        vm.getJob();
                    });
                }
            },
            enableSendButton: function enableSendButton() {
                var vm = this;

                if (vm.commentData.description.length > 0) {
                    vm.commentData.disableSendButton = false;
                    return;
                }

                vm.commentData.disableSendButton = true;
            },
            isMe: function isMe(id) {
                var vm = this;
                if (id == vm.userId) {
                    return true;
                }

                return false;
            },
            loadNiceScroll: function loadNiceScroll() {
                setInterval(function () {
                    if (document.readyState === 'complete') {
                        // run after page has finished loading
                        $.fn.niceScroll && $(".nicescroll").niceScroll({ cursorcolor: '#98a6ad', cursorwidth: '6px', cursorborderradius: '5px' });
                    }
                }, 500);
            },
            acceptProposal: function acceptProposal(proposal) {
                var vm = this;

                var pageUrl = window.location.origin + '/user/proposal/accept';

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

                    vm.$http.post(pageUrl, { '_method': 'PUT', 'id': proposal.id }, { headers: { 'X-CSRF-TOKEN': _csrf_token } }).then(function (data) {
                        vm.commentData.description = '';
                        vm.getJob();
                        swal('Proposta aceita!', 'Proposta aceita com sucesso.', 'success');
                    }, function (error) {
                        swal('Oops, algo deu errado...', error.body.error, 'error');
                    });
                });
            }
        }
    });
})();