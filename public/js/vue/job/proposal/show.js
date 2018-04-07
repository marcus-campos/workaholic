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
            enableSendButton () {
                let vm = this;

                if (vm.commentData.description.length > 0) {
                    vm.commentData.disableSendButton = false;
                    return;
                }

                vm.commentData.disableSendButton = true;
            },
            isMeOnComment (id) {
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
            }
        }
    });
})();