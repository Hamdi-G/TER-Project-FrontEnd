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
              <h4 class="card-title">Résultats</h4>
              <div class="toolbar">

                <div class="btn-group">
                  <select id="semester-select" class="selectpicker" data-style="btn btn-info btn-round" title="Choisir Semester" data-live-search="true"></select>
                </div>

                <div class="btn-group">
                  <select id="labgroup-select" class="selectpicker" data-style="btn btn-warning btn-round" title="Choisir Groupe TP" data-live-search="true"></select>
                </div>

              </div>
              <div class="material-datatables">
                <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                  <thead>
                    <tr>
                      <th>ID étudiant</th>
                      <th>Nom étudiant</th>
                      <th>Prénom étudiant</th>
                      <th>Resultat</th>
                      <th>Resultat</th>
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
    var semesters,labgroups;
    var selected_semester, selected_labgroup;
    var students,notes,modules;

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
      $('#labgroup-select').find('option').remove().end();
      //console.log(selected_semester);
      $.ajax({
        url: 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/semesters/'+selected_semester+'/labgroups',
        type: 'GET',
        dataType: "json",
        success: function(response){
          //console.log(response);
          //-------------loadTable();
          $.each(response, function(key, value) {
            $('#labgroup-select')
            .append($("<option></option>")
            .attr("value",value.id)
            .text(value.name));
            //console.log(value.name);
          });
          $('#labgroup-select').selectpicker('refresh');
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


    $('#labgroup-select').on('change', function(){
      selected_labgroup = $(this).find("option:selected").val();
      students= null;
      notes= null;
      modules = null;
      //console.log(selected_module);
      $.ajax({
        url: 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/labgroups/'+selected_labgroup+'/students',
        type: 'GET',
        dataType: "json",
        success: function(response){
          students = response;
          $.ajax({
            url: 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/semesters/'+selected_semester+'/modules',
            type: 'GET',
            dataType: "json",
            success: function(response){
              modules = response;
              //console.log(modules);
              $.ajax({
                url: 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/labgroups/'+selected_labgroup+'/notes',
                type: 'GET',
                dataType: "json",
                success: function(response){
                  notes = response;
                  for (var i = 0; i < students.length; i++) {
                    students[i]["modules"] = [];
                    students[i]["result"] = 0;
                    for (var j = 0; j < modules.length; j++) {
                      var module = {id: modules[j].id, name: modules[j].name, coeff: modules[j].coeff, note: 0  };
                      students[i].modules.push(module);
                    }
                  }
                  if (notes) {
                    for (var i = 0; i < students.length; i++) {
                      for (var k = 0; k < students[i].modules.length; k++) {
                        for (var j = 0; j < notes.length; j++) {
                          if (notes[j].student.id == students[i].id) {
                            if (notes[j].module.id == students[i].modules[k].id) {
                              students[i].modules[k].note = notes[j].note;
                            }
                          }
                        }
                      }
                    }
                  }
                  for (var i = 0; i < students.length; i++) {
                    var result = 0;
                    var total_coeff = 0;
                    for (var j = 0; j < students[i].modules.length; j++) {
                      result += students[i].modules[j].note * students[i].modules[j].coeff;
                      total_coeff += students[i].modules[j].coeff;
                    }
                    var final = result/(total_coeff);
                    students[i].result = (final).toFixed(2)
                  }
                  console.log(students);
                  loadTable(students);

                  var table = $('#datatables').DataTable();
                  table.on('click', '.view', function() {
                    var student = table.row( $(this).parents('tr') ).data();
                    swal({
                      title: 'Résultat détaillé',
                      width: 700,
                      text: "You won't be able to revert this!",
                      html:
                      '<img src="../assets/img/placeholder.jpg" class="img-circle" width="80" height="80">'+
                      '<p><h6><label class="col-sm-3 label-on-left">Nom de famille:</label></h6>' + student.lastname +
                      '<h6><label class="col-sm-3 label-on-left">Prénom:</label></h6>' + student.firstname +
                      '<h6><label class="col-sm-3 label-on-left">Semestre:</label></h6>' + student.labgroup.semester.name +
                      '<h6><label class="col-sm-3 label-on-left">Groupe TP:</label></h6>' + student.labgroup.name +
                      '<h6><label class="col-sm-3 " style="color:red">Moyenne:</label></h6></p>' + student.result +
                      '<div id="modules"></div>',
                      onOpen: function() {
                        var mydiv = document.getElementById("modules");
                        for (var i = 0; i < student.modules.length; i++) {
                          var div = document.createElement('div');
                          var h6Tag = document.createElement('h6');
                          var labelTag = document.createElement('label');
                          labelTag.setAttribute('class',"col-sm-3 label-on-left");
                          labelTag.setAttribute('style',"color:blue");
                          labelTag.innerHTML = student.modules[i].name +':';
                          div.innerHTML = student.modules[i].note;
                          mydiv.appendChild(div);
                          div.appendChild(h6Tag);
                          h6Tag.appendChild(labelTag);
                        }



                      }

                    });
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
            { mData: "result",
            "render": function(mData){
              if (mData < 5) {
                return '<span class="label label-danger">'+mData+'</span>'
              }else if (mData < 10) {
                return '<span class="label label-warning">'+mData+'</span>'
              }else if (mData < 15) {
                return '<span class="label label-info">'+mData+'</span>'
              }else {
                return '<span class="label label-success">'+mData+'</span>'
              }
            }
          },
          { mData: "result",
          "render": function(mData){
            if (mData < 8) {
              return '<span class="label label-danger">redoublé</span>'
            }else if (mData < 10) {
              return '<span class="label label-warning">controle</span>'
            }else
            return '<span class="label label-success">validé</span>'
          }
        },
        {"defaultContent": "<a class='btn btn-simple btn-rose btn-icon view'><i class='material-icons'>visibility</i></a>"}
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
