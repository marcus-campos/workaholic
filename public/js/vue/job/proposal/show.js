(function () {
    new Vue({
        el: '#proposal',
        data: {
            jobId: _jobId,
            proposal: {},
            comments: {},
            commentData: {
                description: '',
                proposal_id: null
            }
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
                    vm.proposal = data.data;
                    console.log(vm.proposal);
                });
            },
            submitComment() {
                let vm = this;

                pageUrl = window.location.origin + '/json/proposal/comment';

                if (vm.proposal !== {}) {
                    vm.commentData.proposal_id = vm.proposal.id;
                    vm.$http.post(pageUrl, JSON.stringify(vm.commentData), { headers: { 'X-CSRF-TOKEN': _csrf_token}}).then(function (data) {
                        vm.commentData.description = '';
                        vm.getProposal();
                    });
                }
            },
        },
        watch: {

        }
    });
})();