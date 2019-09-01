
console.log(id_user);
var container_chat = $('#container_chat');
crate_connection(id_user);
container_chat.append(create_chat());
container_chat.on('submit','#form_mensagem',function (e) {
    e.preventDefault();
    send_mensage(id_user,'2',$('#input_send_mensagem').val());
});