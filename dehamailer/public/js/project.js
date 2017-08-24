$(document).ready(function() {
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
        $('#project_customer_name_new').val(isNextChildElement('#combobox_add_project_customer_name').val());
        $('#project_member_name_new').val(isNextChildElement('#combobox_add_project_member_name').val());
    });

    $('#addProjectModal').click(function() {
        eventKeyup(isNextChildElement('#combobox_add_project_customer_name'), '#combobox_add_project_customer_name');
        eventKeyup(isNextChildElement('#combobox_add_project_member_name'), '#combobox_add_project_member_name');
    });

    // Set value customer_name, member_name into editModal
    $('#editSubmit').click(function() {
        $('#edit_project_customer_name_new').val(isNextChildElement('#modalEditProjectCustomerId').val());
        $('#edit_project_member_name_new').val(isNextChildElement('#modalEditProjectMemberId').val());
    });

    $('#editProjectModal').click(function() {
        eventKeyup(isNextChildElement('#modalEditProjectCustomerId'), '#modalEditProjectCustomerId');
        eventKeyup(isNextChildElement('#modalEditProjectMemberId'), '#modalEditProjectMemberId');
    });
});

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

            $("#modalEditProjectMemberId option[selected]").removeAttr("selected");
            $("#modalEditProjectMemberId option[value="+data.project_member_id+"]").attr('selected', true);
            isNextChildElement('#modalEditProjectMemberId').val($('#modalEditProjectMemberId option:selected').text());

            $("#modalEditProjectCustomerId option[selected]").removeAttr("selected");
            $("#modalEditProjectCustomerId option[value="+data.project_customer_id+"]").attr('selected', true);
            isNextChildElement('#modalEditProjectCustomerId').val($('#modalEditProjectCustomerId option:selected').text());

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
function eventKeyup(element, elementSetValue) {
    element.keyup(function(e) {
        var code = e.keyCode || e.which;
        if ((code >= 65 && code <= 90) || (code >= 48 && code <= 57) || (code >= 96 && code <= 105) || code == 222 || code == 8 || (code >= 186 && code <= 192)) {
            $(elementSetValue).val(null);
        }
    });
}

function isNextChildElement(element) {
    return $(element).next().children();
}

