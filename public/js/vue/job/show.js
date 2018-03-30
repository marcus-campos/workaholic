(function () {
    new Vue({
        el: '#proposal',
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

                pageUrl = window.location.origin + '/json/proposal/job/'+ vm.jobId;

                vm.$http.get(pageUrl).then(function (data) {

                }, function (error) {
                    if (error.status === 404) {
                        vm.showProposalButton = true;
                        vm.showProposalFollowingButton = false;
                    }

                });
            },
            submitData() {
                let vm = this;

                pageUrl = window.location.origin + '/json/proposal/store';

                vm.$http.post(pageUrl, JSON.stringify(vm.proposal), { headers: { 'X-CSRF-TOKEN': _csrf_token}}).then(function (data) {
                    let result = data.data;
                    vm.proposalData = result.data;
                    vm.showProposalButton = false;
                    vm.showProposalFollowingButton = true;
                });
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