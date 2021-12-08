
    cpf = document.querySelectorAll('span.cpfcnpj');

    

    for (i = 0; i < cpf.length; i++) {
       
        rep = cpf[i].innerText;
        if (cpf[i].innerText.length==14){

            rep=cpf[i].innerText.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");
        }else {
            rep=cpf[i].innerText.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
        }
        cpf[i].innerText=rep       
      } 
    


function habilitarEdicao(){
    document.getElementById('habilitarEdicao').style.display='none';
    document.getElementById('confirmarAlteracao').style.display='block';
    document.getElementById('cancelarAlteracao').style.display='block';
    editar = document.querySelectorAll('.edicao input');
    obs = document.querySelectorAll('textarea.editar');
    
    for (i = 0; i < editar.length; i++) {       
        editar[i].removeAttribute("readonly");
        editar[i].style.border=" 1px solid #ccc";
        editar[i].style.backgroundColor=" #fff";          
    } 
    
      obs[0].removeAttribute("readonly");
      obs[0].style.border=" 1px solid #ccc";
      obs[0].style.backgroundColor=" #fff";

} 

function desabilitarEdicao(){
    document.getElementById('habilitarEdicao').style.display='block';
    document.getElementById('confirmarAlteracao').style.display='none';
    document.getElementById('cancelarAlteracao').style.display='none';
    editar = document.querySelectorAll('.edicao input');
    obs = document.querySelectorAll('textarea.editar');
    
    for (i = 0; i < editar.length; i++) {       
        editar[i].setAttribute("readonly","true");
        editar[i].style.border=" none";
        editar[i].style.backgroundColor=" #f6f6f6";          
    } 
    
      obs[0].setAttribute("readonly","true");
      obs[0].style.border=" none";
      obs[0].style.backgroundColor=" #f6f6f6";


}
       

