

function cepCheck(){

    var checkbox = document.getElementById('semCep');
    var rua = document.getElementById('rua');
    var bairro = document.getElementById('bairro');
    var cidade = document.getElementById('cidade');
    var uf = document.getElementById('uf');

    if(checkbox.checked){
        rua.placeholder = "Digite aqui a rua";
        rua.style.visibility="visible";
        rua.readOnly=false;

        bairro.placeholder = "Digite aqui o bairro";
        bairro.style.visibility="visible";
        bairro.readOnly=false;

        cidade.placeholder = "Digite aqui a cidade";
        cidade.style.visibility="visible";
        cidade.readOnly=false;

        uf.placeholder = "Digite aqui a UF";
        uf.style.visibility="visible";
        uf.readOnly=false;

        
    }else{
        rua.placeholder = "";
        rua.style.visibility="hidden";
        bairro.placeholder = "";
        bairro.style.visibility="hidden";
        cidade.placeholder = "";
        cidade.style.visibility="hidden";
        uf.placeholder = "";
        uf.style.visibility="hidden";
    }


}






var key = document.getElementById('cepCliente');
key.addEventListener ('keyup',function cep(){
     document.getElementById('lsemCep').style.display="none";   
});



function cepWeb(){
    var rua = document.getElementById('rua');
    var bairro = document.getElementById('bairro');
    var cidade = document.getElementById('cidade');
    var uf = document.getElementById('uf');

    rua.style.visibility="visible";
    bairro.style.visibility="visible";
    cidade.style.visibility="visible";
    uf.style.visibility="visible";
}


