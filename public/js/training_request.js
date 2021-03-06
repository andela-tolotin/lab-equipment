'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

(function ($) {
  jQuery.fn.LabEquipment = function () {
    return $(this).each(function () {
      var req = new TrainingRequest();
      req.getLabEquipment();
      req.selectTrainingRequest();
      req.completeTraining();
      req.getTrainingStudents();
    });
  };

  var TrainingRequest = function () {
    function TrainingRequest() {
      _classCallCheck(this, TrainingRequest);
    }

    _createClass(TrainingRequest, [{
      key: 'completeTraining',
      value: function completeTraining() {
        var req = new TrainingRequest();
        var selectedStudents = [];
        var studentIds = [];
        var modal = $('div#list-complete-training');
        var smtBtn = $(document).find('form#complete-training button.btn-default');
        smtBtn.on('click', function () {
          var equipmentId = $(document).find('form#complete-training select#equipment').val();
          var equipmentName = $(document).find('form#complete-training select#equipment option:selected').text();
          var checkBox = $(document).find('table#display-complete-training').find('input[type="checkbox"]:checked');

          if (checkBox.size() <= 0) {
            toastr.error('Pls select student to add');
            return false;
          }

          checkBox.each(function (index, el) {
            var _this = $(this);
            selectedStudents.push(_this.attr('data-name'));
            studentIds.push(_this.val());
          });

          var modalContent = req.prepareModalForTraniningCompleted(equipmentName, selectedStudents);
          modal.find('div.modal-body').html(modalContent);
          selectedStudents = [];
          modal.modal('show');

          var okBtn = modal.find('button.ok');
          var route = '/equipments/training/completed';
          var params = {
            'equipment': equipmentId,
            'students': studentIds,
            'equipment_name': equipmentName
          };

          okBtn.on('click', function () {
            req.makeAjaxCall(route, params, 'POST').done(function (data) {
              if (data.id != undefined) {
                modal.modal('hide');
                req.clearFields();
                okBtn.unbind('click');
                /** 
                 * Mark the selected students rows as grey
                 */
                checkBox.each(function (index, el) {
                  var _this = $(this);
                  _this.parents('tr').css('color', '#cccccc');
                  _this.parent().next().html('true');
                });
                //End 
                selectedStudents = [];
                studentIds = [];
                return toastr.success('Your confirmation has been sent');
              }
            }).fail(function (error) {
              console.log(error);
            });
            return false;
          });
          return false;
        });
      }
    }, {
      key: 'selectTrainingRequest',
      value: function selectTrainingRequest() {
        var selectedStudents = [];
        var studentIds = [];
        var req = new TrainingRequest();
        var smtBtn = $(document).find('form#approve-request button.btn-default');

        smtBtn.on('click', function () {
          var equipmentId = $(document).find('form#approve-request select#equipment').val();

          var modal = $('div#list-accepted-request');
          var checkBox = $(document).find('table#display-training-request').find('input[type="checkbox"]:checked');

          var location = $(document).find('form#approve-request input#location').val();
          var month = $(document).find('form#approve-request select#month').val();
          var day = $(document).find('form#approve-request select#day').val();
          var year = $(document).find('form#approve-request select#year').val();
          var time = $(document).find('form#approve-request select#time').val();

          if (year == '') {
            toastr.error('Pls select year');
            return false;
          }

          if (month == '') {
            toastr.error('Pls select month');
            return false;
          }

          if (day == '') {
            toastr.error('Pls select day');
            return false;
          }

          if (time == '') {
            toastr.error('Pls select time');
            return false;
          }

          if (location == '') {
            toastr.error('Pls select training location');
            return false;
          }

          if (checkBox.size() <= 0) {
            toastr.error('Pls select student to add');
            return false;
          }

          checkBox.each(function (index, el) {
            var _this = $(this);
            selectedStudents.push(_this.attr('data-name'));
            studentIds.push(_this.val());
          });

          var bookingDate = year + '/' + month + '/' + day;
          var bookingTime = time;

          var modalContent = req.prepareModal(bookingDate, bookingTime, selectedStudents, location);
          modal.find('div.modal-body').html(modalContent);
          selectedStudents = [];
  
          modal.modal('show');
          var okBtn = modal.find('button.ok');
          var route = '/equipments/training/confirmation';

          var params = {
            'equipment': equipmentId,
            'students': studentIds,
            'booking_date': bookingDate,
            'location': location,
            'time': time
          };

          okBtn.on('click', function () {
            $.ajax({
              headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
              },
              url: route,
              type: 'POST',
              dataType: 'json',
              data: params
            }).done(function (data) {
              if (data.message == 'successful') {
                modal.modal('hide');
                req.clearFields();
                okBtn.unbind('click');
                /** 
                 * Mark the selected students rows as grey
                */
                checkBox.each(function (index, el) {
                  var _this = $(this);
                  _this.parents('tr').css('color', '#cccccc');
                  _this.parent().next().html('true');
                });
              //End 
                selectedStudents = [];
                studentIds = [];
                return toastr.success('Your confirmation has been sent');
              }
              return toastr.success(data.message);
            }).fail(function (error) {
              console.log(error);
            }).always(function () {
              console.log('Complete');
            });
            return false;
          });
          return false;
        });
      }
    }, {
      key: 'clearFields',
      value: function clearFields() {
        var location = $(document).find('form#approve-request input#location').val('');
        var month = $(document).find('form#approve-request select#month').val('');
        var day = $(document).find('form#approve-request select#day').val('');
        var year = $(document).find('form#approve-request select#year').val('');

        var checkBox = $(document).find('table#display-training-request, table#display-complete-training').find('input[type="checkbox"]');

        checkBox.each(function (index, el) {
          $(this).attr('checked', false);
        });
      }
    }, {
      key: 'prepareModal',
      value: function prepareModal(bookingDate, bookingTime, selectedStudents, location) {
        var students = '';
        var stuff = '<h5 class="text-center">Are you sure to confirm this request and send a confirmation email?</h5>';
        var dateSelected = '<h5 class="text-center">' + bookingDate + '</h5>';
        var trainingLocation = '<h5 class="text-center">' + location + '</h5>';
        var info = '<h5 class="text-center">If it\'s correct press ok</h5>';
        students = '<ul style="list-style:none;">';
        for (var i = 0; i < selectedStudents.length; i++) {
          students += '<li><strong>' + decodeURI(selectedStudents[i]).replace('+', ' ') + '</strong></li>';
        }
        students += '</ul>';

        stuff += students;
        stuff += dateSelected;
        stuff += trainingLocation;
        stuff += bookingTime;
        stuff += info;

        return stuff;
      }
    }, {
      key: 'prepareModalForTraniningCompleted',
      value: function prepareModalForTraniningCompleted(equipment, selectedStudents) {
        var students = void 0,
            stuff = '';
        var info = '<h5 class="text-center">If it\'s correct press ok</h5>';
        students = '<ul style="list-style:none;">';
        for (var i = 0; i < selectedStudents.length; i++) {
          students += '<li><strong>' + decodeURI(selectedStudents[i]).replace('+', ' ') + '</strong></li>';
        }
        students += '</ul>';
        var trainingInfo = '<h5 class="text-center">' + decodeURI(equipment) + ' Training is completed </h5>';

        stuff += students;
        stuff += trainingInfo;
        stuff += info;

        return stuff;
      }
    }, {
      key: 'getTrainingStudents',
      value: function getTrainingStudents() {
        var req = new TrainingRequest();
        var selectEquipment = $(document).find('form#complete-training').find('select#equipment');

        var tableBody = $(document).find('form#complete-training').find('table#display-complete-training tbody');

        selectEquipment.on('change', function () {
          var _this = $(this);
          var equipmentId = _this.val();
          var route = '/equipments/' + equipmentId + '/trainings';
          if (_this.val() != '') {
            req.makeAjaxCall(route, '', 'GET').done(function (data) {
              if (data.draw != undefined) {
                var students = [];
                var trainingStudents = data.data;

                for(var student in trainingStudents) {
                  students.push(trainingStudents[student]);
                }
                // Get all objects only
                var table = $('#display-complete-training');

                var options = {
                  retrieve: true,
                  paging: false,
                  "order": [[ 6, "asc" ]],
                  "createdRow": function ( row, data, index ) {
                      if (data.accepted) {
                        $(row).css('color', '#cccccc');
                      }
                  },
                  data: students,
                  "columns": [
                    { "data": "student_id" },
                    { "data": "name" },
                    { "data": "email" },
                    { "data": "phone" },
                    { "data": "lab_prof" },
                    { "data": "action" },
                    { "data": "accepted" }
                  ]
                };

                table.DataTable().destroy();

                table.DataTable(options);

                return toastr.success('Student loaded');
              }

              return toastr.error('No requests available for this equipment');
            }).fail(function (error) {
              console.log(error);
            }).always(function () {
              console.log('Complete');
            });
          }
          return false;
        });
      }
    }, {
      key: 'getLabEquipment',
      value: function getLabEquipment() {
        var req = new TrainingRequest();

        var selectEquipment = $(document).find('form#approve-request').find('select#equipment');

        var tableBody = $(document).find('form#approve-request').find('table#display-training-request tbody');

        selectEquipment.on('change', function () {
          var _this = $(this);
          var equipmentId = _this.val();
          var route = '/equipments/' + equipmentId + '/students';
          if (_this.val() != '') {
            req.makeAjaxCall(route, '', 'GET').done(function (data) {
              if (data.draw != undefined) {
                // Get all objects only
                var table = $('#display-training-request');

                var options = {
                  retrieve: true,
                  //paging: false,
                  "order": [[ 6, "asc" ]],
                  "createdRow": function ( row, data, index ) {
                      if (data.accepted) {
                        $(row).css('color', '#cccccc');
                      }
                  },
                  data: data.data,
                  "columns": [
                    { "data": "student_id" },
                    { "data": "name" },
                    { "data": "email" },
                    { "data": "phone" },
                    { "data": "lab_prof" },
                    { "data": "action" },
                    { "data": "accepted" }
                  ]
                };

                table.DataTable().destroy();

                table.DataTable(options);

                return toastr.success('Student loaded');
              }

              return toastr.error('No requests available for this equipment');
            }).fail(function (error) {
              console.log(error);
            }).always(function () {
              console.log('Complete');
            });
          }
          return false;
        });
      }
    }, {
      key: 'displayTrainingRequest',
      value: function displayTrainingRequest(data) {
        var tableRow = '';
        var students = data[1];
        for (var student in students) {
          if (students[student].accepted) {
            tableRow += '<tr style="color:#cccccc;">' + '<td>' + students[student].student_id + '</td>' + '<td>' + 
            students[student].name + '</td>' + '<td>' + students[student].email + '</td>' + '<td>' + 
            students[student].phone + '</td>' + '<td>' + students[student].lab_prof + '</td>' + 
            '<td><input type="checkbox" class="form-control training-requester" data-name=' + 
            encodeURI(students[student].name) + ' id="training-requester" value=' + students[student].id + '></td>';
            tableRow += '</tr>';
          } else {
            tableRow += '<tr>' + '<td>' + students[student].student_id + '</td>' + '<td>' + 
            students[student].name + '</td>' + '<td>' + students[student].email + '</td>' + '<td>' + 
            students[student].phone + '</td>' + '<td>' + students[student].lab_prof + '</td>' + 
            '<td><input type="checkbox" class="form-control training-requester" data-name=' + 
            encodeURI(students[student].name) + ' id="training-requester" value=' + students[student].id + '></td>';
            tableRow += '</tr>';
          }
        }
        return tableRow;
      }
    }, {
      key: 'makeAjaxCall',
      value: function makeAjaxCall(url, params, method) {
        return $.ajax({
          headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
          },
          url: url,
          type: method,
          dataType: 'json',
          data: params
        });
      }
    }]);

    return TrainingRequest;
  }();
})(jQuery);

$('body').LabEquipment();