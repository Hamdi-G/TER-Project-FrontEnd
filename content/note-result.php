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

              </div>
              <div class="material-datatables">
                <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>ID étudiant</th>
                      <th>Nom étudiant</th>
                      <th>Prénom étudiant</th>
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
    var semesters,unites,modules,labgroups;
    var selected_semester, selected_unit, selected_module;

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
      console.log(selected_semester);
      url_ = 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/semesters/'+selected_semester+'/units';
      console.log(url_);
      $.ajax({
        url: url_,
        type: 'GET',
        dataType: "json",
        success: function(response){
          console.log(response);
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
      console.log(selected_unit);
      url_ = 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/units/'+selected_unit+'/modules';
      console.log(url_);
      $.ajax({
        url: url_,
        type: 'GET',
        dataType: "json",
        success: function(response){
          console.log(response);
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
      console.log(selected_module);
      url_ = 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/units/'+selected_unit+'/modules';
      console.log(url_);
      $.ajax({
        url: url_,
        type: 'GET',
        dataType: "json",
        success: function(response){
          console.log(response);
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
