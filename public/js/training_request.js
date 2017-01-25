;(($) =>  {
  $.fn.LabEquipment = () => {
    return $(this).each(() => {
      let req = new TrainingRequest;
      req.getLabEquipment();
    });
  }

  class TrainingRequest {
    getLabEquipment() {
      let lab = new Lab;
      let selectEquipment = $(document)
        .find('form#approve-request')
        .find('select#equipment');
      let tableBody = $(document)
        .find('form#approve-request')
        .find('table#display-training-request tbody');

      selectEquipment.on('change', function() {
        let _this = $(this);
        let labId = _this.val();
        const route = '/equipments/'+labId;
        lab.makeAjaxCall(route, '', 'GET')
        .done(function(data) {
            return toastr.success('Lab Equipments has been added');
          }
          return toastr.error('Lab Equipments not available');
        })
        .fail(function(error) {
          console.log(error);
        })
        return false;
      });
    }

    displayTrainingRequest() {

    }

    makeAjaxCall(url, params, method) {
      return $.ajax({
        headers:{
        'X-CSRF-Token': $('input[name="_token"]').val()
      },
        url: url,
        type: method,
        dataType: 'json',
        data: params,
      });
    }
  }
  })(jQuery);

  $('form#approve-request').LabEquipment();