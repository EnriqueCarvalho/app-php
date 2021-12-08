var desconto = document.getElementById('add-desconto');
var quantidade = document.getElementById('add-quantidade');
var btnConfirmar =document.getElementById('add-item-btn-confirmar');

desconto.addEventListener ('keyup',function (){
    btnConfirmar.style.visibility="hidden";   
    document.getElementById('valor-sum').value=null;
    document.getElementById('valorSumario').innerHTML=null;
});
quantidade.addEventListener ('keyup',function (){
    document.getElementById('valor-sum').value=null;
    document.getElementById('valorSumario').innerHTML=null;
    btnConfirmar.style.visibility="hidden";  
});


function calcular(valor){
    var desc = document.getElementById('add-desconto');
    var qtd = document.getElementById('add-quantidade');
    var valorFloat=parseFloat(valor);   
    var total  = (valorFloat-((desc.value/100)*valorFloat)) * qtd.value;
    var resultado = parseFloat(total.toFixed(2));
  
    document.getElementById('valor-sum').value=resultado;
    document.getElementById('valorSumario').innerHTML=resultado;


    btnConfirmar.style.visibility="visible";  
}

