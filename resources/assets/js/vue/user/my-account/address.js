$(function() {
    new Vue({
        el: '#user-address',
        data: {
            userId: _userId,
            isCreatingOrEditing: false,
            addresses: {},
            pagination: {},
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
            vm.loadTooltips();
        },
        methods: {
            clickAdd: function () {
                let vm = this;

                vm.clearAddressData();

                if (vm.isCreatingOrEditing) {
                    vm.isCreatingOrEditing = false;
                    return;
                }

                vm.isCreatingOrEditing = true;
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
            clickEdit: function (address) {
                let vm = this;
                vm.isCreatingOrEditing = true;

                setTimeout(function () {
                    $('#city_id').select2('trigger', 'select', {
                        data: {
                            id: address.city.id,
                            text: address.city.name
                        }
                    });
                }, 100);

                vm.addressData = address;
            },
            submitAddress() {
                let vm = this;
                let id = null;
                let isEditing = false;
                let pageUrl = window.location.origin + '/user/address';

                if (vm.addressData.hasOwnProperty('id')) {
                    pageUrl = window.location.origin + '/user/address/' + vm.addressData.id;
                    id = vm.addressData.id;
                    vm.addressData['_method'] = 'PUT';
                    delete vm.addressData.id;
                    isEditing = true;
                }

                vm.addressData.city_id = $('#city_id').val();

                vm.$http.post(pageUrl, JSON.stringify(vm.addressData), { headers: { 'X-CSRF-TOKEN': _csrf_token}}).then(function (data) {
                    vm.isCreatingOrEditing = false;

                    if (id !== null) {
                        swal(
                            'Atualizado!',
                            'O endereço foi atualizado com sucesso!',
                            'success'
                        );
                        vm.clearAddressData();
                        vm.getAddresses();
                        return;
                    }

                    swal(
                        'Adicionado!',
                        'O novo endereço adicionado com sucesso!',
                        'success'
                    );

                    vm.getAddresses();
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
                    if (isEditing) {
                        vm.addressData['id'] = id;
                    }
                });
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

                    vm.makePagination(result)
                });
            },
            submitDelete: function (userAddress) {
                let vm = this;

                pageUrl = window.location.origin + '/user/address/'+ userAddress.id;

                swal({
                    address: 'Você está certo disto?',
                    text: "Você realmente deseja apagar o endereço \"" + userAddress.address + "\"?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Cancelar'
                }).then(function () {
                    vm.$http.post(pageUrl, {'_method': 'DELETE'}, { headers: { 'X-CSRF-TOKEN': _csrf_token}}).then(function (data) {
                        vm.getAddresses();

                        swal(
                            'Deletado!',
                            'O endereço "'+ userAddress.address + '" foi deletado com sucesso!',
                            'success'
                        );
                    }, function (error) {
                        swal(
                            'Oops, algo deu errado...',
                            error.body.error,
                            'error'
                        )
                    });
                });
            },
            submitPrimary: function (userAddress) {
                let vm = this;

                pageUrl = window.location.origin + '/user/address/'+ userAddress.id + '/primary';

                swal({
                    address: 'Você está certo disto?',
                    text: "Você realmente deseja tornar o endereço \"" + userAddress.address + "\" o principal?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Cancelar'
                }).then(function () {
                    vm.$http.post(pageUrl, {'_method': 'PUT', 'primary': 1}, { headers: { 'X-CSRF-TOKEN': _csrf_token}}).then(function (data) {
                        vm.getAddresses();

                        swal(
                            'Atualizado!',
                            'O endereço "'+ userAddress.address + '" foi indicado como o principal.',
                            'success'
                        );
                    }, function (error) {
                        swal(
                            'Oops, algo deu errado...',
                            error.body.error,
                            'error'
                        )
                    });
                });
            },
            makePagination: function (data) {
                let vm = this;
                let pagination = {
                    current_page: data.current_page,
                    last_page: data.last_page,
                    next_page_url: data.next_page_url,
                    prev_page_url: data.prev_page_url
                };

                vm.pagination = pagination;
            },
            loadTooltips: function () {
                setInterval(() => {
                    if (document.readyState === 'complete') {
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                }, 100);
            }
        }
    });
});