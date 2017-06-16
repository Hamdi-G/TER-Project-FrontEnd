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
if ($connect == "1" && $admin== "1")
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
            <h4 class="card-title">DataTables.net</h4>
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
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

  var modules;
  $.ajax({
    url: 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/modules',
    type: 'GET',
    dataType: "json",
    success: function(response){
      modules = response;
    },
    beforeSend: function(xhr, settings) { xhr.setRequestHeader('Authorization','Bearer ' + '<?php echo $access_token; ?>'); }
  }).fail(function(data, status) {
    location.reload();
  });



  $.ajax({
    url: 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/teachers',
    type: 'GET',
    dataType: "json",
    success: function(response){
      $loader.gSpinner("hide");
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
        "aaData": response,// <-- your array of objects
        "aoColumns": [
          { "mData": "id" },
          { "mData": "firstname" },
          { "mData": "lastname" },
          { "mData": "mail" },
          {"defaultContent": "<a class='btn btn-simple btn-success btn-icon edit'><i class='material-icons'>create</i></a><a class='btn btn-simple btn-danger btn-icon remove'><i class='material-icons'>delete</i></a>"}
        ]
      } );

      var table = $('#datatables').DataTable();
      // Edit record
      table.on('click', '.edit', function() {
        var data = table.row( $(this).parents('tr') ).data();
        var teacher = findById(response, data.id);
        var aaa;

        swal.setDefaults({

          confirmButtonText: 'Next &rarr;',
          showCancelButton: true,
          animation: false,
          progressSteps: ['1', '2', '3'],
          onOpen: function () {
            $("#swal-input1").val(teacher.firstname);
            $("#swal-input2").val(teacher.lastname);
            $("#swal-input3").val(teacher.mail);
            $("#swal-input4").val(teacher.username);
            $("#swal-input5").val("");
            $("#swal-input6").val("");

            for (var i = 1; i < 7; i++) {
              $('#module'+i)
              .append($("<option></option>")
              .attr("value", "none")
              .text("none"));
            }

            $.each(modules, function(key, value) {
              for (var i = 1; i < 7; i++) {
                $('#module'+i)
                .append($("<option></option>")
                .attr("value",value.id)
                .text(value.name));
              }
            });
              aaa = $("#swal-input1").val();
              console.log(aaa);


          }
        })

        var steps = [
          {
            title: 'Informations',
            html:
            '<input id="swal-input1" class="swal2-input" type="text" placeholder="Nom de famille">' +
            '<input id="swal-input2" class="swal2-input" type="text" placeholder="Prénom">' +
            '<input id="swal-input3" class="swal2-input" type="email" placeholder="E-mail">'
          },
          {
            title: 'Informations de connexion',
            html:
            '<input id="swal-input4" class="swal2-input" type="text" placeholder="Identifiant">' +
            '<input id="swal-input5" class="swal2-input" type="text" placeholder="Mot de passe">' +
            '<input id="swal-input6" class="swal2-input" type="text" placeholder="Retapez le mot de passe">',
            input: 'checkbox',
            inputValue: 1,
            inputPlaceholder:
            ' Administrateur'
          },
          {

            title: 'Modules',
            html:
            '<label for="module1">Module 1: </label>' +
            '<select id="module1"></select>' +
            '<label for="module2">Module 2: </label>' +
            '<select id="module2"></select>' +
            '<label for="module3">Module 3: </label>' +
            '<select id="module3"></select>' +
            '<label for="module4">Module 4: </label>' +
            '<select id="module4"></select>' +
            '<label for="module5">Module 5: </label>' +
            '<select id="module5"></select>' +
            '<label for="module6">Module 6: </label>' +
            '<select id="module6"></select>'
          }
        ]

        swal.queue(steps).then(function () {
          swal.resetDefaults();

          console.log(aaa);

          swal({
            title: 'All done!',
            html:
            'Your answers: <pre>' +
            JSON.stringify(result) +
            '</pre>',
            confirmButtonText: 'Lovely!',
            showCancelButton: false
          })
        }, function () {
          swal.resetDefaults()
        })

      });

      // Delete
      table.on('click', '.remove', function(e) {
        var data = table.row( $(this).parents('tr') ).data();
        var teacher = findById(response, data.id);
        var this_ = $(this);
        swal({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, cancel!',
          confirmButtonClass: 'btn btn-success',
          cancelButtonClass: 'btn btn-danger',
          buttonsStyling: false
        }).then(function () {
          $.ajax({
            url: 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/teachers/'+ teacher.id,
            type: 'DELETE',
            dataType: "json",
            success: function(response){
              swal(
                'Deleted!',
                'Your file has been deleted.',
                'success',
              );
              table.row( this_.parents('tr') ).remove().draw();
            },
            beforeSend: function(xhr, settings) { xhr.setRequestHeader('Authorization','Bearer ' + '<?php echo $access_token; ?>'); }
          }).fail(function(data, status) {
            swal({
              title: 'erreur',
              type: 'info',
              showCloseButton: true
            })
          });
        }, function (dismiss) {
          if (dismiss === 'cancel') {
            swal({
              title: 'Cancelled',
              text: 'Your imaginary file is safe :)',
              type: 'error',
              timer: 2000,
            })
          }
        })
      });

      $('.card .material-datatables label').addClass('form-group');

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
