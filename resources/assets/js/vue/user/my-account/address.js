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
                city_id: null,
            }
        },
        mounted() {
            let vm = this;
            vm.getAddresses();
        },
        methods: {
            clickAdd: function () {
                let vm = this;

                if (vm.isCreatingOrEditing) {
                    vm.isCreatingOrEditing = false;
                    return;
                }

                vm.isCreatingOrEditing = true;
            },
            submitAddress() {
                let vm = this;

                let pageUrl = window.location.origin + '/user/address';

                vm.addressData.city_id = $('#city_id').val();

                vm.$http.post(pageUrl, JSON.stringify(vm.addressData), { headers: { 'X-CSRF-TOKEN': _csrf_token}}).then(function (data) {
                    vm.isCreatingOrEditing = false;
                    vm.getAddresses();
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
            makePagination: function (data) {
                let vm = this;
                let pagination = {
                    current_page: data.current_page,
                    last_page: data.last_page,
                    next_page_url: data.next_page_url,
                    prev_page_url: data.prev_page_url
                };

                vm.pagination = pagination;
            }
        }
    });
});