(function () {
    new Vue({
        el: '#job',
        data: {
            jobId: _jobId,
            showProposal: false,
            proposal: {
                job_id: _jobId,
                description: '',
                net_value: '0.00',
                time_to_finish_the_job: ''
            },
            showProposalButton: false,
            showProposalFollowingButton: false
        },
        mounted() {
            let vm = this;
            vm.getProposal();
        },
        methods: {
            getProposal() {
                let vm = this;

                let pageUrl = window.location.origin + '/json/proposal/job/?name='+ vm.jobId;

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
            }
        },
        watch: {

        }
    });
})();