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