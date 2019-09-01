function notification(title,mensagem,text_buttom = 'Ok',tipo = 'success',reload = false) {
    swal({
        title: title,
        text: mensagem,
        icon: tipo,
        button: text_buttom,
      }).then((value) => {
          if(reload == true) location.reload();
          else return true;
      });
}