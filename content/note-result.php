<?php
session_start();
if (isset($_SESSION['access_token']))
{$access_token=$_SESSION['access_token'];}
if (isset($_SESSION['user_id']))
{$user_id=$_SESSION['user_id'];}
if (isset($_SESSION['admin']))
{$admin=$_SESSION['admin'];}
if (isset($_SESSION['connect']))
{$connect=$_SESSION['connect'];}
else
{$connect=0;}
if ($connect == "1")
{
  ?>
  <?php include("header-menu.php"); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-icon" data-background-color="black">
              <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
              <h4 class="card-title">DataTables.net</h4>
              <div class="toolbar">

                <div class="btn-group">
                  <select id="semester-select" class="selectpicker" data-style="btn btn-info btn-round" title="Choisir Semester" data-live-search="true"></select>
                </div>

                <div class="btn-group">
                  <select id="unit-select" class="selectpicker" data-style="btn btn-warning btn-round" title="Choisir UE" data-live-search="true"></select>
                </div>

                <div class="btn-group">
                  <select id="module-select" class="selectpicker" data-style="btn btn-success btn-round" title="Choisir Module" data-live-search="true"></select>
                </div>

                <button id="refresh" class="btn btn-primary btn-round btn-fab btn-fab-mini" style="float: right;"><i class="material-icons">save</i></button>

              </div>
              <div class="material-datatables">
                <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                  <thead>
                    <tr>
                      <th>ID étudiant</th>
                      <th>Nom étudiant</th>
                      <th>Prénom étudiant</th>
                      <th>Groupe TP</th>
                      <th>note</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- end content-->
      </div>
      <!--  end card  -->
    </div>
  </div>
  <?php include("footer.php"); ?>

  <script>


  $(document).ready(function() {
    var $loader = $("#loader");
    $loader.gSpinner();
    var table = $('#datatables').DataTable();
    var semesters,unites,modules,labgroups;
    var selected_semester, selected_unit, selected_module;
    var students,notes ;

    $.ajax({
      url: 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/semesters',
      type: 'GET',
      dataType: "json",
      success: function(response){
        $loader.gSpinner("hide");
        semesters = response;
        //console.log(semesters);
        $.each(semesters, function(key, value) {
          $('#semester-select')
          .append($("<option></option>")
          .attr("value",value.id)
          .text(value.name));
        });
        $('#semester-select').selectpicker('refresh');
      },
      beforeSend: function(xhr, settings) { xhr.setRequestHeader('Authorization','Bearer ' + '<?php echo $access_token; ?>'); }
    }).fail(function(data) {
      console.log(data.status);
      if (data.status == 500) {
        location.reload();
      } else if (data.status == 401) {
        window.location = './';
      }
    });

    $('#semester-select').on('change', function(){
      selected_semester = $(this).find("option:selected").val();
      $('#module-select').find('option').remove().end();
      $('#unit-select').find('option').remove().end();
      //console.log(selected_semester);
      $.ajax({
        url: 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/semesters/'+selected_semester+'/units',
        type: 'GET',
        dataType: "json",
        success: function(response){
          //console.log(response);
          loadTable();
          $.each(response, function(key, value) {
            $('#unit-select')
            .append($("<option></option>")
            .attr("value",value.id)
            .text(value.name));
            //console.log(value.name);
          });
          $('#unit-select').selectpicker('refresh');
        },
        beforeSend: function(xhr, settings) { xhr.setRequestHeader('Authorization','Bearer ' + '<?php echo $access_token; ?>'); }
      }).fail(function(data) {
        console.log(data.status);
        if (data.status == 500) {
          location.reload();
        } else if (data.status == 401) {
          window.location = './';
        }
      });

    });


    $('#unit-select').on('change', function(){
      selected_unit = $(this).find("option:selected").val();
      $('#module-select').find('option').remove().end();
      //console.log(selected_unit);

      $.ajax({
        url: 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/units/'+selected_unit+'/modules',
        type: 'GET',
        dataType: "json",
        success: function(response){
          //console.log(response);
          loadTable();
          $.each(response, function(key, value) {
            $('#module-select')
            .append($("<option></option>")
            .attr("value",value.id)
            .text(value.name));
            //console.log(value.name);
          });
          $('#module-select').selectpicker('refresh');
        },
        beforeSend: function(xhr, settings) { xhr.setRequestHeader('Authorization','Bearer ' + '<?php echo $access_token; ?>'); }
      }).fail(function(data) {
        console.log(data.status);
        if (data.status == 500) {
          location.reload();
        } else if (data.status == 401) {
          window.location = './';
        }
      });

    });




    $('#module-select').on('change', function(){
      selected_module = $(this).find("option:selected").val();
      students= null;
      notes= null;
      //console.log(selected_module);
      $.ajax({
        url: 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/semesters/'+selected_semester+'/students',
        type: 'GET',
        dataType: "json",
        success: function(response){
          console.log('response',response);
          students = response;
          $.ajax({
            url: 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/modules/'+selected_module+'/notes',
            type: 'GET',
            dataType: "json",
            success: function(response){
             notes = response;
             //console.log(notes);

              if (notes) {
                for (var i = 0; i < students.length; i++) {
                  for (var j = 0; j < notes.length; j++) {
                    if (notes[j].student.id == students[i].id) {
                      students[i]["note_id"] = notes[j].id;
                      students[i]["note"] = notes[j].note;
                    }
                  }
                }
                for (var i = 0; i < students.length; i++) {
                  if (!students[i].hasOwnProperty('note')) {
                    students[i]["note"] = '--';
                  }
                }
              }else {
                for (var i = 0; i < students.length; i++) {
                  students[i]["note"] = '--';
                }
              }
              //console.log(students);
              loadTable(students);

              var table = $('#datatables').DataTable();
              table.on('click', '.save', function() {
                var data = table.row( $(this).parents('tr') ).data();
                var student = data;
                var note_ = $('#note-input-'+student.id).val();
                if (student.note !== '--') {
                  $.ajax({
                    url: 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/notes/'+student.note_id,
                    type : 'PATCH',
                    contentType : 'application/json',
                    processData: false,
                    dataType: 'json',
                    data : JSON.stringify({"note": note_}),
                    success: function(response){
                      for (var i = 0; i < students.length; i++) {
                        if (students[i].id == student.id) {
                            students[i].note = note_;
                        }
                      }




                      swal({
                        type : "success",
                        title : "Enregistré avec succes",
                        timer: 1000,
                        onClose: function() {
                          loadTable(students);

                        }
                      });

                    },
                    beforeSend: function(xhr, settings) { xhr.setRequestHeader('Authorization','Bearer ' + '<?php echo $access_token; ?>'); }
                  }).fail(function(data, status) {
                    swal({
                      title: 'erreur',
                      type: 'info',
                      showCloseButton: true
                    })
                  });
                } else {
                  console.log('plan b');
                  var datapost = JSON.stringify({"note" : note_ ,"student": student.id, "module": selected_module});
                  //console.log(datapost);

                  $.ajax({
                    url: 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/notes',
                    type : 'POST',
                    processData: false,
                    contentType: 'application/json',
                    data : datapost,
                    success: function(response){

                      for (var i = 0; i < students.length; i++) {
                        if (students[i].id == student.id) {
                            students[i].note = note_;
                            students[i]["note_id"] = response.id;
                        }
                      }
                      swal({
                        type : "success",
                        title : "Enregistré avec succes",
                        timer: 1000,
                        onClose: function() {
                          loadTable(students);

                        }
                      });

                    },
                    beforeSend: function(xhr, settings) { xhr.setRequestHeader('Authorization','Bearer ' + '<?php echo $access_token; ?>'); }
                  }).fail(function(data, status) {
                    swal({
                      title: 'erreur',
                      type: 'info',
                      showCloseButton: true
                    })
                  });





                }
              });

            },
            beforeSend: function(xhr, settings) { xhr.setRequestHeader('Authorization','Bearer ' + '<?php echo $access_token; ?>'); }
          }).fail(function(data) {
            console.log(data.status);
            if (data.status == 500) {
              location.reload();
            } else if (data.status == 401) {
              window.location = './';
            }
          });

        },
        beforeSend: function(xhr, settings) { xhr.setRequestHeader('Authorization','Bearer ' + '<?php echo $access_token; ?>'); }
      }).fail(function(data) {
        console.log(data.status);
        if (data.status == 500) {
          location.reload();
        } else if (data.status == 401) {
          window.location = './';
        }
      });

    });



    function loadTable(data){
      var selected_student_id;
      var table = $('#datatables');

      if ( ! $.fn.DataTable.fnIsDataTable( table[0] ) ) {

        $('#datatables').DataTable( {
          "pagingType": "full_numbers",
          "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
          ],
          responsive: true,
          language: {
            search: "_INPUT_",
            searchPlaceholder: "Chercher...",
          },

          "bProcessing": true,
          "aaData": data,// <-- your array of objects
          "aoColumns": [
            { "mData": "id"},
            { "mData": "firstname" },
            { "mData": "lastname" },
            { "mData": "labgroup.name" },
            /*{ mData: "note",
            "render": function(mData){
            console.log(mData);
            return '<input id="note-input-" type="text" class="form-control" value="'+mData+'">';

          }
        },*/

        { "mRender": function(data, type, row){

          if ( type === 'display' ) {
            //console.log(row);
            return '<input id="note-input-'+row.id+'" type="text" class="form-control" value="'+row.note+'">'
          }
          return 1

        }
      },
      {"defaultContent": "<a class='btn btn-simple btn-rose btn-icon save'><i class='material-icons'>save</i></a>"}
    ]
  });
} else {
  table.dataTable().fnDestroy();
  $('#datatables tbody').empty();
  loadTable(data);
}

}





});

</script>
</body></html>
<?php
}
else
{
  header('Location: ../');
  exit();
}
?>
