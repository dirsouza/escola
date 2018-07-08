$(function() {
    var $onLine = navigator.onLine ? "online" : "offline";

    function limpa_endereco() {
        // Limpa valores do formulário de cep.
        $("#desStreet").val("");
        $("#desNeighborhood").val("");
        $("#desCity").val("");
        $("#desState").val("");
    }

    //Quando o campo cep perde o foco.
    $("#desZip").on('blur', function() {
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
                    $("#desStreet").val("...");
                    $("#desNeighborhood").val("...");
                    $("#desCity").val("...");
                    $("#desState").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#desStreet").val(dados.logradouro);
                            $("#desNeighborhood").val(dados.bairro);
                            $("#desCity").val(dados.localidade);
                            $("#desState").val(dados.uf);
                        } else {
                            //CEP pesquisado não foi encontrado.
                            limpa_endereco();
                            loadModal("CEP não encontrado.");
                        }
                    });
                } else {
                    //consulta no banco de dados
                    getCep($('#desZip').val());
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

    /**
     * Verifica se o CEP passado existe no Banco de Dados.
     * @param {cep}  
     */
    function getCep($cep) {
        $.ajax({
            type: 'GET',
            url: '/registration/commerce/getcep/' + $cep,
            dataType: "json",
            success: function($result) {
                if ($result != null) {
                    $('#desRua').val($result.desrua);
                    $("#desStreet").val($result.desStreet);
                    $("#desNeighborhood").val($result.desNeighborhood);
                    $("#desCity").val($result.desCity);
                    $("#desState").val($result.desState);
                    return true;
                } else {
                    limpa_endereco();
                    loadModal("Sem Conexão com a Internet e o CEP não foi encontrado no Banco.");
                }
            },
            error: function($error) {
                console.log($error);
            }
        });
    }

    function loadModal($msg) {
        var dialog = bootbox.dialog({
            size: 'small',
            title: '<i class="glyphicon glyphicon-shopping-cart"> </i> CADCli',
            message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>'
        });

        dialog.init(function() {
            setTimeout(function() {
                dialog.find('.bootbox-body').html($msg);
            }, 900);
        });
    }
});