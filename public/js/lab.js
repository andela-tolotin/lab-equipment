(function($) {
  $.fn.UpdateEquipmentLab = () => {
    return $(this).each(() => {
      let lab = new Lab;
      lab.createLab();
      lab.assignUserToLab();
      lab.getLabEquipment();
      lab.contactAdmin();
    });
  }

  class Lab {

    contactAdmin() {
      let link = $(document).find('a.open-modal');
      link.on('click', function() {
        let modalDialog = $(document)
        .find('div.contact-admin');
        modalDialog.modal('show')
        return false;
      });
    }
    getLabEquipment() {
      let lab = new Lab;
      let selectLab = $(document)
        .find('form#training_request')
        .find('select#lab');
      let equipments = $(document)
        .find('form#training_request')
        .find('select#equipment');

      selectLab.on('change', function() {
        let _this = $(this);
        let labId = _this.val();

        const route = '/labs/'+labId+'/equipments';

        let modalDialog = $(document)
        .find('div.contact-admin');

        if (_this.val() != '')
        lab.makeAjaxCall(route, '', 'GET')
        .done(function(data) {
          let labEquipments = data[1];

          if (labEquipments.length > 0 && labEquipments[0].availability != undefined) {
            let options = '';
            // Get the lab professor details and add it to the modal form
            let modal = modalDialog.find('div.modal-body');//.html(lab.adminInfo(data[0]));
            let content = lab.adminInfo(data[0]);
            modal.html(content);

            for (let equipment in labEquipments) {
              options += '<option value='+labEquipments[equipment].id+'>'+labEquipments[equipment].model_no+'</option>'
            }
            equipments.html(options);

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

    adminInfo(profDetails) {
      let content = '<span class="text-center"><strong>Please contact the admin via email</strong></span> <br><br>' +
        '<address> '+
          '<strong>Name:</strong> ' + decodeURI(profDetails.name)+' <br> '+
          '<strong>Email:</strong> ' + decodeURI(profDetails.email) +
        '</address> ';

        return content;
    }


    assignUserToLab() {
      let lab = new Lab;
      let saveBtn = $('#save-lab-user');
      saveBtn.on('click', function() {
        var $btn = $(this).button('loading')
        let user = $('form#assign_user_to_lab').find('#user').val();
        let labId = $('form#assign_user_to_lab').find('#lab').val();

        if (user == '') {
          toastr.error('Choose a user to assign to lab!');
          return false;
        }

        if (labId == '') {
          toastr.error('Choose lab!');
          return false;
        }
        // make a put request to the server side
        let params = {'user': user};

        lab.makeAjaxCall('/labs/'+labId+'/add', params, 'PUT')
          .done(function(data) {
            // business logic...
            $btn.button('reset')
            if (data.message == 200) {
              toastr.success('User was assigned to Lab successfully');
              return false
            }
            toastr.error(data.message);
            return false
          })
          .fail(function(error) {
            // business logic...
            $btn.button('reset')
            toastr.error(error.toString());
          });
        return false;
      });
    }

    createLab() {
      let lab = new Lab;
      let saveBtn = $('#save-lab');
      saveBtn.on('click', function() {
        let title = $('form#manage_lab').find('#title').val();
        let modelNo = $('form#manage_lab').find('#model_no').val();

        if (lab.checkforEmptyFields().length > 0) {
          toastr.error('Filled the fields in red!');
          return false;
        }
        // make a put request to the server side
        let params = {
          'title': title,
          'model_no': modelNo,
        }

        lab.makeAjaxCall('/labs/add', params, 'POST')
          .done(function(data) {
            toastr.success(data.message);
            lab.checkforEmptyFields();
            return false
          })
          .fail(function(error) {
            toastr.error(error.toString());
          });
        return false;
      });
    }

    checkforEmptyFields() {
      let error = [];
      $('form#manage_lab')
        .find('input')
        .each(function(index, el) {
          let _this = $(this);
          if (_this.val() == '') {
            error.push(_this.attr('id'));
            _this.css('border', '1px solid red');
          } else {
            _this.css('border', '1px solid #ccc');
          }
        });
      return error;
    }

    clearFormFields() {
      $('form#manage_lab')
        .find('input[type="text"]')
        .each(function(index, el) {
          $(this).val('');
      });
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

  $('form#manage_lab').UpdateEquipmentLab();