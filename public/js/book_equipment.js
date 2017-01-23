;(($) =>  {
  $.fn.BookEquipment = () => {
    return $(this).each(() => {
      let equipment = new Equipment;
    });
  }

  class Equipment {
    makeAjaxCall(url, params, method) {
      return $.ajax({
        headers:{
          'X-CSRF-Token': $('input[name="_token"]').val()
        },
        url: url,
        type: method,
        dataType: 'json',
        data: params,
        async: false,
        cache: false,
        contentType: false,
        enctype: 'multipart/form-data',
        processData: false
      });
    }

  makeAjaxRequest(url, params, method) {
    return $.ajax({
      headers:{
        'X-CSRF-Token': $('input[name="_token"]').val()
      },
      url: url,
      type: method,
      dataType: 'html',
      data: params,
      async: false,
      cache: false,
      contentType: false,
      enctype: 'multipart/form-data',
      processData: false
    });
  }
}
})(jQuery);

$('body').BookEquipment();