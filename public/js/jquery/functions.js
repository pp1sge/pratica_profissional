jQuery.fn.editFields = function(URL){

  
    $('.warning').each(function(){
            $(this).find('input').css({'color':'#FFF','font-weight':'bold'});
            $(this).find('select').css({'color':'#FFF','font-weight':'bold'});
      });
    	$('.selected').hide();
    	input = $(this).find('input.input_data');
        select = $(this).find('select');
    	input.each(function(){
        	caracteres = $(this).val();
        	if(caracteres.length <= 5){
        		$(this).attr('size','6');
            }else{
            	$(this).attr('size','18');
            }
        });
        select.css({'width':'170px'});
        $(this).find('select.short_data').css({'width':'50px'});
        input.attr('readonly','readonly');
        input.attr('title','Clique duas vezes para editar...');
        input.dblclick(function(){
           $(this).removeAttr('readonly'); 
           $(this).css('border','1px solid black');
           $(this).css('background','#FFF');
           if(input.closest('tr.warning')){
               $(this).css('color','#000');
           }
        });
        select.on('click',function(){
        	$(this).css({'background':'#FFF','color':'#000'});
        });
        select.change(function(){
           elemento = $(this);
           valor = $(this).val();
           campo = $(this).attr('name');
           id = $(this).closest('tr').attr('id');
           td =  $(this).closest('td').attr('id');
           foo = $(this).closest('td');
            parametros = 'valor='+Base64.encode(valor)+'&codigo='+Base64.encode(id)+'&coluna='+Base64.encode(campo);
            var ajax = new Ajax();
            $.ajax({
               url:URL,
               type:'POST',
               dataType:'html',
               data:parametros,
               beforeSend: function(){
                   elemento.hide();
                   ajax.miniLoading(document.getElementById(td));
               },
               success : function(){
                   $('#carregando').remove();
                   elemento.fadeIn();
                   alert('Editado com sucesso!');
               }
            });
           
        })
        
       
       $(this).find('input').keydown(function(e){   
       elemento = $(this);
       if(e.which == 13){
          
            valor = $(this).val();
            id = $(this).closest('tr').attr('id');
            td =  $(this).closest('td').attr('id');
            campo = $(this).attr('name');
            parametros = 'valor='+Base64.encode(valor)+'&codigo='+Base64.encode(id)+'&coluna='+Base64.encode(campo);
            $.ajax({
               url:URL,
               type:'POST',
               dataType:'html',
               data:parametros,
                              beforeSend: function(){
                   elemento.hide();
                   ajax.miniLoading(document.getElementById(td));
               },
               success : function(){
                   $('#carregando').remove();
                   elemento.fadeIn();
                   alert('Editado com sucesso!');
               }

            });
            $(this).attr('readonly','readonly');
            $(this).css({'border':'none','background':'transparent'});
        
        }
       
     })
       
       
   
}