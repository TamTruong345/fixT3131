function deleteItem(project_id) {
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
    $("#select2search, #select2_member_search").select2();
});


