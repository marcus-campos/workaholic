(function () {
    new Vue({
        el: '#proposal',
        data: {
            showProposal: false,
            proposal: {
                job_id: _jobId,
                description: '',
                net_value: '0.00',
                time_to_finish_the_job: ''
            },
            proposalData: {

            }
        },
        mounted() {

        },
        methods: {
            getProposal: {

            },
            submitData() {
                let vm = this;

                pageUrl = window.location.origin + '/json/proposal/store';

                vm.$http.post(pageUrl, JSON.stringify(vm.proposal), { headers: { 'X-CSRF-TOKEN': _csrf_token}}).then(function (data) {
                    let result = data.data;
                    vm.proposalData = result.data;
                    console.log(result)
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