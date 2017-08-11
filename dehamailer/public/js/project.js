

$(document).ready(function() {
    $("#select2search ,.project-member-select2, #company_name_selec2,#member_name_selec2").select2();
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