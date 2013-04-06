/**
 *  Funções Gerais do Sistema - Javascript
 */
function somenteLetras(e){
	var tecla = (window.event) ? event.keyCode : e.which;
	 if((tecla > 65 && tecla < 90)||(tecla > 97 && tecla < 122)) return true;
	    else{
	    if (tecla != 8) return false;
	    else return true;
	  }
}
function getEndereco() {
	// Se o campo CEP nÃ£o estiver vazio
	if($.trim($("#cep").val()) != ""){
		/* 
			Para conectar no serviÃ§o e executar o json, precisamos usar a funÃ§Ã£o
			getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros
			dataTypes nÃ£o possibilitam esta interaÃ§Ã£o entre domÃ­nios diferentes
			Estou chamando a url do serviÃ§o passando o parÃ¢metro "formato=javascript" e o CEP digitado no formulÃ¡rio
			http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val()
		*/
		$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val(), function(){
			// o getScript dÃ¡ um eval no script, entÃ£o Ã© sÃ³ ler!
			//Se o resultado for igual a 1
	  		if(resultadoCEP["resultado"]){
				// troca o valor dos elementos
				$("#rua").val(unescape(resultadoCEP["logradouro"]));
				$("#bairro").val(unescape(resultadoCEP["bairro"]));
				$("#cidade").val(unescape(resultadoCEP["cidade"]));
				$("#estado").val(unescape(resultadoCEP["uf"]));
			}else{
				alert("Endere&ccedil;o n&atilde;o encontrado");
			}
		});				
	}			
}
function validarCNPJ(cnpj) {

	cnpj = cnpj.replace(/[^\d]+/g,'');

	if(cnpj == '') return false;

	if (cnpj.length != 14)
		return false;

	// Elimina CNPJs invalidos conhecidos
	if (cnpj == "00000000000000" ||
		cnpj == "11111111111111" ||
		cnpj == "22222222222222" ||
		cnpj == "33333333333333" ||
		cnpj == "44444444444444" ||
		cnpj == "55555555555555" ||
		cnpj == "66666666666666" ||
		cnpj == "77777777777777" ||
		cnpj == "88888888888888" ||
		cnpj == "99999999999999")
		$('#cnpj-error').html("Cnpj inválido!");
			return false;
		// Valida DVs
		tamanho = cnpj.length - 2
		numeros = cnpj.substring(0,tamanho);
		digitos = cnpj.substring(tamanho);
		soma = 0;	
		pos = tamanho - 7;
		for (i = tamanho; i >= 1; i--) {
			soma += numeros.charAt(tamanho - i) * pos--;
		if (pos < 2)
			pos = 9;
		}
		resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
		if (resultado != digitos.charAt(0))
			$('#cnpj-error').html("Cnpj inválido!");
			tamanho = tamanho + 1;
			numeros = cnpj.substring(0,tamanho);
			soma = 0;
			pos = tamanho - 7;
			for (i = tamanho; i >= 1; i--) {
				soma += numeros.charAt(tamanho - i) * pos--;
				if (pos < 2)
					pos = 9;
			}	
			resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
			if (resultado != digitos.charAt(1))
				$('#cnpj-error').html("Cnpj inv&aacute;lido!");
			    $('#cnpj-error').html("<i class='icon-ok-sign'></i>");

			}