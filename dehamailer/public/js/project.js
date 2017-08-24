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
                $('.loader').attr('style', 'none');
                console.log(data);
            }
        });
    }
}

$(document).ready(function() {
    $("#select2search ,.project-member-select2, #company_name_selec2,#member_name_selec2").select2();

    // Edit last memo
    $('.editProjectLastMemo').blur(function() {
        $('.loader').attr('style', 'display: block');
        var project_last_memo = $(this).text();
        var project_id = $(this).data('id');
        $.get('project/updateLastMemo', {project_last_memo: project_last_memo, project_id: project_id}, function() {
            $('.loader').attr('style', 'display: none');
        });
    });

    // Set value customer_name, member_name into addModal
    $('#addSubmit').click(function() {
        var customer_name = $('#combobox_add_project_customer_name').next().children();
        var member_name = $('#combobox_add_project_member_name').next().children();
        $('#project_customer_name_new').val(customer_name.val());
        $('#project_member_name_new').val(member_name.val());
    });

    $('#addProjectModal').click(function() {
        var customer_name = $('#combobox_add_project_customer_name').next().children();
        var member_name = $('#combobox_add_project_member_name').next().children();

        customer_name.keyup(function(e) {
            var code = e.keyCode || e.which;
            if ((code >= 65 && code <= 90) || (code >= 48 && code <= 57) || (code >= 96 && code <= 105) || code == 222 || code == 8 || (code >= 186 && code <= 192) ) {
                $('#combobox_add_project_customer_name').val(null);
            }
        });
        member_name.keyup(function(e) {
            var code = e.keyCode || e.which;
            if ((code >= 65 && code <= 90) || (code >= 48 && code <= 57) || (code >= 96 && code <= 105) || code == 222 || code == 8 || (code >= 186 && code <= 192)) {
                $('#combobox_add_project_member_name').val(null);
            }
        });
    });
});

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

    $(document).ready(function() {
        $('.form-group').sortable();

    } );
}