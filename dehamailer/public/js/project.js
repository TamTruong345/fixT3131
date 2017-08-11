function deleteItem(project_id) {
    $('.loader').attr('style', 'block');
    var cfm =  confirm('Are you sure?');
    var _token = $('input[name="_token"]').val();
    if (cfm) {
        $.ajax({
            method: "DELETE",
            url: "/project/" + project_id,
            data: { _token : _token },
            success: function () {
                window.location = "/project";
            },
            error: function (data) {
                $('.loader').attr('style', 'none')
                console.log(data);
            }
        });
    }
}

function loading() {
    $('.loader').attr('style', 'block');
}

function resetSearch() {
    $('.loader').attr('style', 'display: block');
    $.ajax({
        method: "GET",
        url: "/project/reset",
        data: {},
        success: function () {
            $('.loader').attr('style', 'display: none');
            window.location = "/project";
        }
    })
}

$(document).ready(function() {
    $(".select2search").select2();

    $("#modalEditProjectCustomerId").select2();

    $('#modalEditProjectMemberId').select2();
});


function openModalEditProject(project_id) {
    $('.loader').attr('style', 'display: block');
    var _token = $('input[name="_token"]').val();
    $.ajax({
        method: 'GET',
        url: "/project/" + project_id,
        data: { _token : _token },
        success: function(response) {
            var data = JSON.parse(response);
            console.log(data);
            $('#modalEditProjectId').val(data.project_id);
            $('#modalEditProjectName').val(data.project_name);
            $('#modalEditProjectCustomerId').select2("trigger", "select", {
                data: {id: data.project_customer_id}
            });
            $('#modalEditProjectMemberId').select2("trigger", "select", {
                data: {id: data.project_member_id}
            });
            $('#modalEditProjectMemberId').val(data.project_member_id);
            $('#modalEditProjectStatus').val(data.project_status);

            $('#modalEditProjectMoney').val(data.project_money);
            $('#modalEditLastMemo').val(data.project_last_memo);

            $('#editProjectModal').modal('show');
            $('.loader').attr('style', 'display: none');
        },
        error: function(data) {
            console.log(data);
        }
    });
}

