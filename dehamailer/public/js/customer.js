function deleteTemplate(customer_id) {
    $('.loader').attr('style', 'block');
    var cfm =  confirm('Are you sure?');
    var _token = $('input[name="_token"]').val();
    if (cfm) {
        $.ajax({
            method: "DELETE",
            url: "/customer/" + customer_id,
            data: { _token : _token },
            success: function () {
                window.location = "/customer";
            },
            error: function (data) {
                $('.loader').attr('style', 'none')
                console.log(data);
            }
        });
    }
};

function loading() {
    $('.loader').attr('style', 'block');
}

function openModalEditTemplate(customer_id) {
    $('.loader').attr('style', 'display: block');
    var _token = $('input[name="_token"]').val();
    $.ajax({
        method: "GET",
        url: "/customer/" + customer_id,
        data: { _token : _token },
        success: function (response) {
            var data = JSON.parse(response);
            $('#modalEditCustomerId').val(data.customer_id);
            $('#modalEditCustomerName').val(data.customer_name);
            $('#modalEditCustomerFullName').val(data.customer_full_name);
            $('#modalEditCustomerMail').val(data.customer_mail);
            $('.loader').attr('style', 'display: none')
            $('#editCustomerModal').modal('show');
        },
        error: function (data) {
            console.log(data);
        }
    });
}

function resetSearch() {
    $('.loader').attr('style', 'display: block');
    $.ajax({
        method: "GET",
        url: "/customer/reset",
        data: {},
        success: function () {
            $('.loader').attr('style', 'display: none');
            window.location = "/customer";
        }
    })
}