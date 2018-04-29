$(function() {
    new Vue({
        el: '#user-data',
        data: {
            user: {},
            userData: {
                id: '',
                name: '',
                email: '',
                biography: ''
            }
        },
        mounted() {
            let vm = this;
            vm.getUser();
        },
        methods: {
            updateUser: function () {

            },
            getUser() {
                let vm = this;

                pageUrl = window.location.origin + '/user/auth';

                vm.$http.get(pageUrl).then(function (data) {
                    let result = data.data;
                    vm.userData = result;
                });
            },
            submitUser: function () {
                let vm = this;

                pageUrl = window.location.origin + '/user/'+ vm.userData.id;
                vm.userData['_method'] = 'PUT';
                console.log(vm.userData);

                vm.$http.post(pageUrl, vm.userData, { headers: { 'X-CSRF-TOKEN': _csrf_token}}).then(function (data) {
                    vm.getUser();
                    swal(
                        'Atualizado!',
                        'Seu usuário foi atualizado com sucesso!',
                        'success'
                    );
                }, function (error) {
                    swal(
                        'Oops, algo deu errado...',
                        error.body.error,
                        'error'
                    )
                });
            }
        }
    });
});