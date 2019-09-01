function notification(title,mensagem,text_buttom = 'Ok',tipo = 'success') {
    swal({
        title: title,
        text: mensagem,
        icon: tipo,
        button: text_buttom,
      }).then((value) => {
          return true;
      });
}