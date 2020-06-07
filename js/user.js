$(document).ready(function(){
  $('input[type=text]').select();
});

//show passowrd
$('#show_password').change(function(){
  if (this.checked) {
    $('.pwd').attr('type', 'text');
  }else{
    $('.pwd').attr('type', 'password');
  }
});

$('#logout').click(function(){
  $.ajax(
    {
      url : "../handler/user.php",
      type : "post",
      data : {logout : true},
      dataType : "json",
      success : function(response){
        $(location).attr('href', response);
      }
    }
  );
});

$('#delete-account').click(function(){
    // let decision = confirm("Sei sicuro di voler eliminare il tuo account? Tutti i tuoi dati verranno persi!");
    swal({
            title: "Sei sicuro di voler eliminare il tuo account?",
            text: "Tutti i tuoi dati verranno persi!",
            icon: "warning",
            buttons: ["Annulla", true],
            dangerMode: true,
          })
          .then(
            (willDelete) => {
              if (willDelete) {
                $.ajax(
                  {
                    url : "../handler/user.php",
                    type : "post",
                    data : {delete_account : true, username : username},
                    dataType : "json",
                    success : function(response){
                      $(location).attr('href', response);
                    }
                  }
                );
              }
            }
          );
  }
);
