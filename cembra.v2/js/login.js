$("[name=submit]").on('click', function(e){
  form = $("form[name=loginForm]")
  isvalidate = $(form)[0].checkValidity()
  if (isvalidate) {
    e.preventDefault()
    oop={file:'login.class.php',classe:'Login',func:'login'}
    dati={}
    dati.email=$("[name=email]").val();
    dati.pwd=$("[name=password]").val();
    $.ajax({
      type: "POST",
      url: "class/connector.php",
      data: {oop:oop, dati:dati},
      dataType: 'json',
      success: function(data){
        if(data.indexOf('Errore!') != -1){
          classe='alert-danger';
          p = 'login.php';
        } else {
          classe='alert-success';
          p = 'index.php';
          localStorage.setItem('logged',true);
        }
        $(".outMsg").html(data);
        $(".output").addClass(classe).toggleClass('d-none d-block').fadeIn('fast');
        $("#countdowntimer").text('3');
        countdown(3,p);
      }
    });
  }
});
