function Ajax(){


	this.loadAjax = function()
	{
		try 
		{
			// Chrome / Firefox
			request = new XMLHttpRequest();
	
		}catch(tryMs) {
			try {
				// Opera
				request = new ActiveXObject("Msxml2.XMLHTTP");
			}catch(otherMs)
			{
				try{
					// IE
					request = new ActiveXObject("Microsoft.XMLHTTP");
				}catch(failed)
				{
					request = null;
				}
			}
		}
	return request;
	}
/**
	Metodo = POST / GET
	URL = PAGINA QUE RETORNARÁ OS DADOS
	REQUISICAO = TRUE PARA ASSINCRONA E FALSE PARA SINCRONA
**/
	this.retornaDadosAjax = function(url,parametros,tag)
	{
		request = this.loadAjax();
		if(request == null)
		{
			alert("Erro ao enviar os dados");
		}else{
			// Envia a requisição
			this.carregando(document.getElementById('msg_success'));
			if(parametros != null){
				url = url + "?" + parametros;
			}
		
			// Retorna a requisição assim que houver um retorno.
			request.onreadystatechange = function(){
			// 4 e 200 indicam que a resposta está ok!
			if (request.readyState == 4 && request.status == 200) {
				// Recebe o retorno do servidor
				retorno = request.responseText;
				// Pra funcionar tem que ser ID.
				document.getElementById(tag).innerHTML = retorno;
				$('#'+tag+'').fadeOut(6000);
				}	
				limpar();
	
			}
			request.open("POST",url,true);
			request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=iso-8859-1");
			request.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate");
			request.setRequestHeader("Cache-Control", "post-check=0, pre-check=0");
			request.setRequestHeader("Pragma", "no-cache");
		}
		// Para enviar dados como POST é necessário sempre colocar os parametros que
		// serão enviado em .send()
		request.send(parametros);
	
	}
	

// Funcao que retorna qualquer coisa que esteja entre <script> no retorno da requisição
/*this.findJs = function(tagRetorno)
	{
		objRetorno = document.getElementById(tagRetorno);
		var scripts = objRetorno.getElementsByTagName('script');
		for (var i=0; i<scripts.length; i++){
			if (scripts[i].innerHTML != ""){
				eval(scripts[i].innerHTML);
			}
		}
	}*/
this.carregando = function(container)
	{
		/*while(container.hasChildNodes()){
                    container.removeChild(container.lastChild);
		}*/
		var imagem = document.createElement("img");
		imagem.setAttribute("src","/intranettm/public/images/carregando.gif");
		imagem.setAttribute("alt","carregando...");
		imagem.setAttribute("id","carregando");
		imagem.style.cssText = 'display:block; width:220px; height:19px; margin:30px auto;';
		container.appendChild(imagem);
	}
	this.tempoEsgotado = function()
	{
		$('#divRetornoDados').fadeOut();
	}
	this.sleep = function(milliseconds){
	  	var start = new Date().getTime();
	  	for (var i = 0; i < 1e7; i++) {
    		if ((new Date().getTime() - start) > milliseconds){
      		break;
    		}
  		}
	}
        this.miniLoading = function(container){
            var imagem = document.createElement("img");
		imagem.setAttribute("src","/intranettm/public/images/circle-loading.gif");
		imagem.setAttribute("alt","carregando...");
		imagem.setAttribute("id","carregando");
		imagem.style.cssText = 'display:block; text-align:center; margin:0 auto;';
		container.appendChild(imagem);
        }
        this.request = function(URL){
            var http = false;
            http = new XMLHttpRequest();
            http.abort();
           
            http.open("GET", URL, true)
            http.send(null);

        }
}
