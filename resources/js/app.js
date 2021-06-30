require('./bootstrap');


$.menuDashIsOn = false;

$("#menuDash").on('click', function(){

    if(!$.menuDashIsOn){
        document.getElementById("mySidenav").style.width = "250px";
        $.menuDashIsOn = true;
    }
    else{
        document.getElementById("mySidenav").style.width = "0";
        $.menuDashIsOn = false;
    }
    /* console.log($(window).width()) */
});

$( window ).resize(function() {
    if($(window).width() > 750){
        document.getElementById("mySidenav").style.width = "250px";
    }
});

$('#btn-enviar').on('click', function(){
    let input_url = $('#t_url').val();
    $.post(
        '/cadastrarurl', 
        {
            _token : $('meta[name="csrf-token"]').attr('content'),
            url : input_url
        },
        function(data){
            $('#t_url').val('');
            alert("Url Cadastrado com sucesso");
            console.log(data);
            $('#lista_url').html(data);
    });
});

$('#btn-enviar-email').on('click', function(){
    
    let input_email = $('#i_email').val();
    $.post(
        '/cadastraremail', 
        {
            _token : $('meta[name="csrf-token"]').attr('content'),
            email : input_email
        },
        function(){
            $('#i_email').val('');
            $('#t_email').html(input_email);
            alert("Email cadastrado com sucesso");
    });
});

$("#t_url").keyup(function(event) {
    if (event.keyCode === 13) {
        $("#btn-enviar").click();
    }
});

$.clickDelet = (nome,href) => {
    $("#botao-delet").attr("href",href);
    $('#msg').html('Tem certeza que deseja deletar a url: '+nome+'?');
}
