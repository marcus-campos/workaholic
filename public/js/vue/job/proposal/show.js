(function () {
    new Vue({
        el: '#proposal',
        data: {
            jobId: _jobId,
            job: {},
            proposals: {},
            comments: {},
            commentData: {
                description: '',
                proposal_id: null
            }
        },
        mounted() {
            let vm = this;
            vm.getJob();
        },
        methods: {
            getJob() {
                let vm = this;

                pageUrl = window.location.origin + '/json/proposal/job/'+ vm.jobId;

                vm.$http.get(pageUrl).then(function (data) {
                    vm.job = data.data;
                });
            },
            submitComment(proposalId) {
                let vm = this;

                pageUrl = window.location.origin + '/json/proposal/comment';

                if (vm.proposal !== {}) {
                    vm.commentData.proposal_id = proposalId;
                    vm.$http.post(pageUrl, JSON.stringify(vm.commentData), { headers: { 'X-CSRF-TOKEN': _csrf_token}}).then(function (data) {
                        vm.commentData.description = '';
                        vm.getJob();
                    });
                }
            },
        },
        watch: {

        }
    });
})();