var mySwiper = new Swiper('.swiper-container', {
  loop: true,
  autoplay: true,
  pagination: {
    el: '.swiper-pagination',
  },
})
let menuToggle = $('.header-menu-toggle');
menuToggle.on('click', function (event) {
  event.preventDefault();
  $('.header-nav').slideToggle(200);

})

/*let contactsform = $('.contacts-form');

contactsform.on('submit', function (event) {
  event.preventDefault();
  let formData = new FormData(this);
  formData.append('action', 'contacts_form');

  $.ajax({
    method: "POST",
    //  url: '/wp-admin/admin-ajax.php',
    url: adminAjax.url,
    headers: {
      "Accept": "application/json; odata=verbose"
    },
    data: JSON.stringify(formData),
    //  dataType: 'json',
    //data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      console.dir(data);
    },
    error: function (jqXHR, exception) {
      if (jqXHR.status === 0) {
        alert('Not connect. Verify Network.');
      } else if (jqXHR.status == 404) {
        alert('Requested page not found (404).');
      } else if (jqXHR.status == 500) {
        alert('Internal Server Error (500).');
      } else if (exception === 'parsererror') {
        alert('Requested JSON parse failed.');
      } else if (exception === 'timeout') {
        alert('Time out error.');
      } else if (exception === 'abort') {
        alert('Ajax request aborted.');
      } else {
        alert('Uncaught Error: ' + jqXHR.responseText);
      }
    }
  });

  //  return false;
});
*/

/*dataType: 'json',
cache: false,
data: formData,
contentType: false,

success: function (response) {
  console.log('Ответ сервера: OKey!')
},
error: function (data) {
  console.log(data)
}
});

});*/
// Вариант Ворбьева
jQuery(document).ready(function ($) {

  /* let action = $('#vp_send_cont_form').val();
 
   let data = {
     action: action,     //  и далее остальные данные
   }*/

  $('#contacts_form_button').on('click', function (e) {
    e.preventDefault();

    $.ajax({
      url: adminAjax.url,
      type: "POST",
      data: $('#contacts_form').serialize(), // или data + action: action,
      success: function (request) { //alert('Письмо ушло') 
      },
      error: function (request) { }
    })
  })

});