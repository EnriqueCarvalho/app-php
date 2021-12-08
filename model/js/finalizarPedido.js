function finalizar(){
     document.getElementById('opcoes').style.display="none";
     document.getElementById('finalizar-pedido').style.visibility="visible";
     var rem=document.getElementsByClassName('remover');

     for (var i=0; rem[i]; i++) {
        rem[i].style.visibility = 'hidden';
      }
}

function formaDePagamento(){
    var forma = document.getElementById('formaPagamento');


    if(forma.value=='parcelado'){
        document.getElementById('lbl-NumParcela').style.display='block';
        document.getElementById('lbl-valorParcela').style.display='block';
    }else{
        document.getElementById('lbl-NumParcela').style.display='none';
        document.getElementById('lbl-valorParcela').style.display='none';
    }
}

function calcularParcela(){
    var numParcelas=document.getElementById('numParc');
    var valorTotal=document.getElementById('valorTotal');
    var valorParcela=document.getElementById('valorParcela');
    if(numParcelas!=0){
        var x = (valorTotal.value/numParcelas.value);
        var arredondado = parseFloat(x.toFixed(2));
        valorParcela.value=arredondado;
    }else{
        valorParcela.value=0;
    }

    
}