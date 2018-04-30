$(function() {
    new Vue({
        el: '#user-data',
        data: {
            passwordData: {
                oldPassword: '',
                password: '',
                password_confirmation: '',
            },
            userData: {
                id: '',
                name: '',
                email: '',
                biography: ''
            },
            profilePhoto: null
        },
        mounted() {
            let vm = this;
            vm.getUser();
        },
        methods: {
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

                vm.$http.post(pageUrl, vm.userData, { headers: { 'X-CSRF-TOKEN': _csrf_token}}).then(function (data) {
                    vm.getUser();
                    swal(
                        'Atualizado!',
                        'Seu usuário foi atualizado com sucesso!',
                        'success'
                    );
                }, function (error) {
                    let errMsg = '';
                    for (let err in error.body.errors) {
                        let err = error.body.errors[err];

                        if (err === Array) {
                            for (let errC in err) {
                                errMsg += '<br/>' + error.body.errors[errC];
                            }
                        }

                        errMsg += '<br/>' + err;
                    }
                    swal(
                        'Oops, algo deu errado...',
                        errMsg,
                        'error'
                    )
                });
            },
            submitPassword: function () {
                let vm = this;

                pageUrl = window.location.origin + '/user/' + vm.userData.id + '/password';
                vm.passwordData['_method'] = 'PUT';

                vm.$http.post(pageUrl, vm.passwordData, { headers: { 'X-CSRF-TOKEN': _csrf_token}}).then(function (data) {
                    vm.getUser();
                    swal(
                        'Atualizado!',
                        'Sua senha foi atualizada com sucesso!',
                        'success'
                    ).then(function () {
                        window.location.reload();
                    });
                }, function (error) {
                    let errMsg = '';
                    for (let err in error.body.errors) {
                        let err = error.body.errors[err];

                        if (err === Array) {
                            for (let errC in err) {
                                errMsg += '<br/>' + error.body.errors[errC];
                            }
                        }

                        errMsg += '<br/>' + err;
                    }
                    swal(
                        'Oops, algo deu errado...',
                        errMsg,
                        'error'
                    )
                });
            },
            onPhotoChange: function (event) {
                let vm = this;
                vm.profilePhoto = event.target.files[0];
            },
            submitProfilePhoto: function () {
                let vm = this;

                pageUrl = window.location.origin + '/user/' + vm.userData.id + '/photo';

                let formData = new FormData();
                formData.append('image', vm.profilePhoto, vm.profilePhoto.name);
                formData.append('_method', 'PUT');

                for (var p of formData) {
                    console.log(p);
                }

                vm.$http.post(pageUrl, formData, { headers: { 'X-CSRF-TOKEN': _csrf_token}}).then(function (data) {
                    vm.getUser();
                    swal(
                        'Atualizado!',
                        'Sua foto foi atualizada com sucesso!',
                        'success'
                    ).then(function () {
                        window.location.reload();
                    });
                }, function (error) {
                    let errMsg = '';
                    for (let err in error.body.errors) {
                        let err = error.body.errors[err];

                        if (err === Array) {
                            for (let errC in err) {
                                errMsg += '<br/>' + error.body.errors[errC];
                            }
                        }

                        errMsg += '<br/>' + err;
                    }
                    swal(
                        'Oops, algo deu errado...',
                        errMsg,
                        'error'
                    )
                });
            }
        }
    });
});