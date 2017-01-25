;(($) =>  {
  $.fn.LabEquipment = () => {
    return $(this).each(() => {
      let req = new TrainingRequest;
      req.getLabEquipment();
    });
  }

  class TrainingRequest {
    getLabEquipment() {
      let req = new TrainingRequest;

      let selectEquipment = $(document)
        .find('form#approve-request')
        .find('select#equipment');

      let tableBody = $(document)
        .find('form#approve-request')
        .find('table#display-training-request tbody');

      selectEquipment.on('change', function() {
        let _this = $(this);
        let equipmentId = _this.val();
        const route = '/equipments/'+equipmentId+'/students';
        req.makeAjaxCall(route, '', 'GET')
        .done(function(data) {
          if (data.length > 0) {

          }
          return toastr.success('Lab Equipments users loaded');
        })
        .fail(function(error) {
          console.log(error);
        })
        return false;
      });
    }

    displayTrainingRequest(data) {
      // let tableRow = '';
      // for (let user in data) {
      //   tableRow += '<tr>' +
      //     '<td>'+data[user].student_id+'</td>' +
      //     '<td>'+data[user].name+'</td>' +
      //     '<td>'+data[user].email+'</td>' +
      //     '<td>'+data[user].phone+'</td>'+
      //     tableRow += '</td>' + 
      //     '<td><a href="#"  class="student-edit" id='+data[user].id+'>Edit</a></td>';
      //    tableRow += '</tr>';
      //   counter++;
      // }
      // return tableRow;
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