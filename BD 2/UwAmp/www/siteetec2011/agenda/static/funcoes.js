/* 
 * Funções comuns da aplicação
 */

// Ao carregar o documento

jQuery(document).ready(function(){
    
    // Remover
    
    jQuery(".c-remover").click(function(event){
        
        // Cancela a ação padrão do link que é navegar até o endereço informado no atributo href
        
        event.preventDefault();
        
        // Armazena o href do link nesta variável
        
        var url = jQuery(this).attr("href");

        // Confirm
        
        bootbox.confirm("Deseja mesmo deletar esse contato?", function(result) {
            
            // Se o usuário concordar
            
            if (result) {
                
                // Redireciona para o método de exclusão do contato
                
                document.location.href=url;
                
                /* Aqui ao invés de redirecionarmos diretamente para o método responsável
                 * pela exclusão, podemos implementar uma camada Ajax para dinamizar o processo.
                 * Mas este não é o escopo do curso. */
                
            }
            
        });
        
    });
    
    // Busca
    
    jQuery(".btn-pesquisar").click(function(event){
        
        event.preventDefault();
        
        document.location.href= jQuery("#form-search").attr("action") + jQuery("input#busca").val();
        
    });
    
});