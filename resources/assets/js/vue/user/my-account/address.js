$(function() {
    new Vue({
        el: '#user-address',
        data: {
            userId: _userId,
            isCreatingOrEditing: false,
            addressData: {
                address: '',
                number: '',
                complement: '',
                neighborhood: '',
                cep: '',
                city_id: null,
                user_id: this.userId
            }
        },
        mounted() {
            let vm = this;
        },
        methods: {
            clickAdd: function () {
                let vm = this;

                if (vm.isCreatingOrEditing) {
                    vm.isCreatingOrEditing = false;
                    return;
                }

                vm.isCreatingOrEditing = true;
            }
        }
    });
});