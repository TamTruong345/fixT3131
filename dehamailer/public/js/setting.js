function loading() {
    $('.loader').attr('style', 'block');
}

function deleteSender(sender_id) {
    $('.loader').attr('style', 'block');
    var cfm =  confirm('Are you sure?');
    var _token = $('input[name="_token"]').val();
    if (cfm) {
        $.ajax({
            method: "DELETE",
            url: "/sender/" + sender_id,
            data: { _token : _token },
            success: function () {
                window.location = "/setting";
            },
            error: function (data) {
                $('.loader').attr('style', 'none')
                console.log(data);
            }
        });
    }
};

function openModalEditSender(sender_id) {
    $('.loader').attr('style', 'display: block');
    var _token = $('input[name="_token"]').val();
    $.ajax({
        method: "GET",
        url: "/sender/" + sender_id,
        data: { _token : _token },
        success: function (response) {
            var data = JSON.parse(response);
            $('#modalEditSenderId').val(data.sender_id);
            $('#modalEditSenderName').val(data.sender_from_name);
            $('#modalEditSenderPassword').val(data.sender_password);
            $('#modalEditSenderMail').val(data.sender_username);
            $('.loader').attr('style', 'display: none')
            $('#editSenderModal').modal('show');
        },
        error: function (data) {
            console.log(data);
        }
    });
}