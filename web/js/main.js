$(function(){
  //Obtener el evento al hacer clic en un botón
  $('#modalButton').click(function (){
    $('#modal').modal('show')
      .find('#modalContent')
      .load($(this).attr('value'));
  });
});

//$.pjax.reload({container:'#$dataIn'});
