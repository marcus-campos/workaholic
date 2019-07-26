(function () {
    window.jobForm = new Vue({
        el: '#job-form',
        data: {
            isRemote: 0,
            isNewAddress: false,
            addresses: {},
            selectedAddress: null,
            addressData: {
                address: '',
                number: '',
                complement: '',
                neighborhood: '',
                zip_code: '',
                city_id: null
            }
        },
        mounted() {
            let vm = this;
            vm.getAddresses();
            vm.changeRemote();
        },
        methods: {
            changeAddress: function () {
                let vm = this;

                if (vm.selectedAddress === 'new-address') {
                    vm.isNewAddress = true;
                    return;
                }

                vm.isNewAddress = false;
            },
            changeRemote: function () {
                let vm = this;
                vm.isRemote = $('input[name=remote]:checked').val();
            },
            getAddresses(pageUrl) {
                let vm = this;

                if (!pageUrl) {
                    pageUrl = window.location.origin + '/user/address';
                }

                vm.$http.get(pageUrl).then(function (data) {
                    let result = data.data;
                    vm.addresses = result.data;

                    if (vm.addresses.length < 1) {
                        vm.isCreatingOrEditing = true;
                    }
                });
            },
            clearAddressData: function () {
                let vm = this;

                vm.addressData = {
                    address: '',
                    number: '',
                    complement: '',
                    neighborhood: '',
                    zip_code: '',
                    city_id: null
                };

                setTimeout(function () {
                    $('#city_id').val('').trigger('change');
                }, 100);
            },
            submitAddress() {
                let vm = this;
                let pageUrl = window.location.origin + '/user/address';

                vm.addressData.city_id = $('#city_id').val();

                vm.$http.post(pageUrl, JSON.stringify(vm.addressData), { headers: { 'X-CSRF-TOKEN': _csrf_token}}).then(function (data) {
                    vm.isCreatingOrEditing = false;

                    swal(
                        'Adicionado!',
                        'O novo endereço adicionado com sucesso!',
                        'success'
                    );

                    vm.getAddresses();
                    vm.isNewAddress = false;
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
                    );
                });
            },
        },
        watch: {
            selectedAddress: function () {
                let vm = this;
                vm.changeAddress();
            }
        }
    });
})();