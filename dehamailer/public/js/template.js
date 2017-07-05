function deleteTemplate(template_id) {
    $('.loader').attr('style', 'block')
    var cfm =  confirm('Are you sure?');
    var _token = $('input[name="_token"]').val();
    if (cfm) {
        $.ajax({
            method: "DELETE",
            url: "/template/" + template_id,
            data: { _token : _token },
            success: function () {
                window.location = "/template";
            },
            error: function (data) {
                $('.loader').attr('style', 'none')
                console.log(data);
            }
        });
    }
};

function openModalEditTemplate(template_id) {
    $('.loader').attr('style', 'display: block')
    var _token = $('input[name="_token"]').val();
    $.ajax({
        method: "GET",
        url: "/template/" + template_id,
        data: { _token : _token },
        success: function (response) {
            var data = JSON.parse(response);
            $('#modalEditTemplateId').val(data.template_id);
            $('#modalEditTemplateSubject').val(data.template_subject);
            $('#modalEditTemplateContent').val(data.template_content);
            $('#modalEditTemplateAttachmentOld').val(data.template_attachment);
            $('#modalEditTemplateMailCC').val(data.template_mail_cc);
            if (data.template_status == 'active') {
                $('#modalEditTemplateStatus1').attr('checked', true);
            } else {
                $('#modalEditTemplateStatus2').attr('checked', true);
            }
            $('.loader').attr('style', 'display: none')
            $('#editTemplateModal').modal('show');
        },
        error: function (data) {
            console.log(data);
        }
    });
}