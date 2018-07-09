$(function() {
    var $onLine = navigator.onLine ? "online" : "offline";

    function limpa_endereco() {
        // Limpa valores do formulário de cep.
        $("#logradouro").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#estado").val("");
    }

    //Quando o campo cep perde o foco.
    $("#cep").on('blur', function() {
        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se o campo cep possui valor informado.
        if (cep != "") {
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {
                //Verifica se existe conexão com a internet
                if ($onLine === "online") {
                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#logradouro").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#estado").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#logradouro").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#estado").val(dados.uf);
                        } else {
                            //CEP pesquisado não foi encontrado.
                            limpa_endereco();
                            loadModal("CEP não encontrado.");
                        }
                    });
                } else {
                    //Sem Internet
                    loadModal("Não foi possível fazer a Consulta.<br><small>Verifique sua conexão com a Internet.</small>");
                }
            } else {
                //cep é inválido.
                limpa_endereco();
                loadModal("Formato de CEP inválido.");
            }
        } else {
            //cep sem valor, limpa formulário.
            limpa_endereco();
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