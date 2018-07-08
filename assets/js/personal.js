$(function() {
    var fieldRequired = [];

    $('[required]').each(function() {
        fieldRequired.push($(this).attr('name'));
    });

    $.each(fieldRequired, function(name, index) {
        $('form').validate({
            rules: {
                index: "required"
            },
            errorElement: "small",
            highlight: function(element, errorClass, validClass) {
                for (var i = 1; i <= 12; i++) {
                    $(element).parents(".col-lg-"+i).addClass("has-error").removeClass("has-success");
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                for (var i = 1; i <= 12; i++) {
                    $(element).parents(".col-lg-"+i).addClass("has-success").removeClass("has-error");
                }
            }
        });
    });

    /**
     * Evita multiplos click
     */
    $('form').submit(function() {
        $(this).submit(function() {
            return false;
        });
        return true;
    });

    $('[data-toggle="tooltip"]').tooltip();

    $('#table').DataTable({
        responsive: true,
        autoWidth: false,
        language: {
            url: "/lib/datatables/language/pt-BR.json"
        }
    });
});