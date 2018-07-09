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

    $('.select2').select2({
        theme: "bootstrap",
        placeholder: "Selecione...",
        allowClear: true,
        language: "pt-BR",
        width: "100%"
    });

    $('#cep').mask(
        '00000-000', {
            placeholder: "_____-___",
            clearIfNotMatch: true,
            reverse: true
        }
    );

    var msgToastr = document.getElementById('toastr').innerHTML;

    msg(msgToastr);
    function msg($msg) {
        if ($msg != "") {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            toastr.success($msg);
        }
    };

    $('#gerarRelatorio').on('click', function() {
        var modulo = $('#modulo').val();
        var tipo = $('#tipo').val();

        if (modulo != "" && tipo != "") {
            $.post('/relatorio/visualizar',{
                modulo: modulo,
                tipo: tipo
            }, function(result){
                console.log(result);
                window.open('/relatorio/visualizar', '_blank');
                //window.location.reload();
            });
        } else {
            loadModal("Módulo e Tipo são requiridos.");
        }
    });

    function loadModal($msg) {
        var dialog = bootbox.dialog({
            size: 'small',
            title: 'Escola',
            message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>'
        });

        dialog.init(function() {
            setTimeout(function() {
                dialog.find('.bootbox-body').html($msg);
            }, 900);
        });
    }
});