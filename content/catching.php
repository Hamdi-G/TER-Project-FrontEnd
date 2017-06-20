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
          <div class="card-header card-header-icon" data-background-color="purple">
            <i class="material-icons">assignment</i>
          </div>
          <div class="card-content">
            <h4 class="card-title">Demandes de rattrapages</h4>
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Nom de famille</th>
                    <th>Prénom</th>
                    <th>Groupe TP</th>
                    <th>Date</th>
                    <th>Absence au</th>
                    <th>avis d'enseignant</th>
                    <th>Décision final</th>
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
  var url = "http://localhost/TER-Project-BackEnd/web/app_dev.php/api/teachers/"+"<?php echo $user_id; ?>"+"/catchingrequests";
  <?php
  if ($admin == "1") { ?>
    url = 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/catchingrequests'
    <?php } ?>

  $.ajax({
    url: url,
    type: 'GET',
    dataType: "json",
    success: function(response){
      console.log(response);
      var catchingrequests = response;
      $loader.gSpinner("hide");

      $('#datatables').DataTable( {
        "order": [[ 0, "desc" ]],
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
        "aaData": response,// <-- your array of objects
        "aoColumns": [
          { "mData": "id" },
          { "mData": "absence.student.firstname" },
          { "mData": "absence.student.lastname" },
          { "mData": "absence.student.labgroup.name" },
          { "mData": "hour" },
          { mData: "type",
          "render": function(mData){
            if (mData == 0) {
              return '<span class="label label-rose">TP</span>'
            }else if (mData == 1) {
              return '<span class="label label-danger">Semestre</span>'
            }else if (mData == 2) {
              return '<span class="label label-warning">DS</span>'
            }
          }
        },
        { mData: "teacherdecision",
        "render": function(mData){
          if (mData == 0) {
            return '<span class="label label-default">non verifié</span>'
          }else if (mData == 1) {
            return '<span class="label label-info">inutile</span>'
          }else if (mData == 2) {
            return '<span class="label label-danger">conseillé</span>'
          }
        }
      },
      { mData: "admindecision",
      "render": function(mData){
        if (mData == 0) {
          return '<span class="label label-default">non verifié</span>'
        }else if (mData == 1) {
          return '<span class="label label-warning">non autorisé</span>'
        }else if (mData == 2) {
          return '<span class="label label-success">autorisé</span>'
        }
      }
    },
    {"defaultContent": "<a class='btn btn-simple btn-rose btn-icon view'><i class='material-icons'>visibility</i></a>"}
  ]
});



var table = $('#datatables').DataTable();
table.on('click', '.view', function() {
  var data = table.row( $(this).parents('tr') ).data();
  var catchingrequest = findById(catchingrequests, data.id);
  var teacherdecision = catchingrequest.teacherdecision;
  var admindecision = catchingrequest.admindecision;

  swal({
    title: 'absence',
    width: 700,
    text: "You won't be able to revert this!",
    html:
    '<img src="../assets/img/hamdi.jpg" class="img-circle" width="80" height="80">'+
    '<p><h6><label class="col-sm-3 label-on-left">Nom de famille:</label></h6>' + catchingrequest.absence.student.lastname +
    '<h6><label class="col-sm-3 label-on-left">Prénom:</label></h6>' + catchingrequest.absence.student.firstname +
    '<h6><label class="col-sm-3 label-on-left">Semestre:</label></h6>' + catchingrequest.absence.student.labgroup.semester.name +
    '<h6><label class="col-sm-3 label-on-left">Groupe TP:</label></h6>' + catchingrequest.absence.student.labgroup.name +
    '<h6><label class="col-sm-3 label-on-left">Module :</label></h6>' + catchingrequest.module.name +
    '<h6><label class="col-sm-3 label-on-left">Date debut:</label></h6>' + catchingrequest.absence.startd +
    '<h6><label class="col-sm-3 label-on-left">Date fin:</label></h6></p>' + catchingrequest.absence.startd +
    '<h6><label class="col-sm-3 label-on-left">Motif:</label></h6>' + catchingrequest.absence.reason +

    '<h6><label class="col-sm-3 label-on-left">avis enseignant:</label></h6></p>' +
    '<div class="btn-group" id="teacherdecision">' +
    '<button id="2" type="button" class="btn btn-info btn-sm">consiellé</button>' +
    '<button id="1" type="button" class="btn btn-info btn-sm">unitile</button></div>'
    <?php
    if ($admin == "1") { ?>
    + '<h6><label class="col-sm-3 label-on-left">décision final:</label></h6></p>' +
    '<div class="btn-group" id="admindecision">' +
    '<button id="2" type="button" class="btn btn-warning btn-sm">autorisé</button>' +
    '<button id="1" type="button" class="btn btn-warning btn-sm">non autorisé</button></div>',
  <?php }else {
    echo ",";
  } ?>
    showCancelButton: true,
    confirmButtonColor: '#4caf50',
    cancelButtonColor: '#d33',
    confirmButtonText: 'enregistrer',
    cancelButtonText: 'Annuler',
    onOpen: function() {
      $("#teacherdecision > button.btn").on("click", function(){
        teacherdecision = $(this).attr('id');
      });

      $("#admindecision > button.btn").on("click", function(){
        admindecision = $(this).attr('id');
      });
    }

  }).then(function () {

    $.ajax({
      url: 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/catchingrequests/'+ catchingrequest.id,
      type : 'PATCH',
      contentType : 'application/json',
      data : JSON.stringify({"teacherdecision": teacherdecision}),
      success: function(response){
        $.ajax({
          url: 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/catchingrequests/'+ catchingrequest.id,
          type : 'PATCH',
          contentType : 'application/json',
          data : JSON.stringify({"admindecision": admindecision}),
          beforeSend: function(xhr, settings) { xhr.setRequestHeader('Authorization','Bearer ' + '<?php echo $access_token; ?>'); }
        }).fail(function(data, status) {
          swal({
            title: 'erreur',
            type: 'info',
            showCloseButton: true
          })
        });
        swal({
          type : "success",
          title : "Enregistré avec succes",
          timer: 1000,
          onClose: function() {
            location.reload();
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
  })
});

},
beforeSend: function(xhr, settings) { xhr.setRequestHeader('Authorization','Bearer ' + '<?php echo $access_token; ?>'); }
}).fail(function(data) {
  console.log(data.status);
  if (data.status == 500 && data.status == 101) {
    location.reload();
  } else if (data.status == 401) {
    window.location = './';
  }
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
