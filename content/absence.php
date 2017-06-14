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
                    <th>Nom de famille</th>
                    <th>Prénom</th>
                    <th>Groupe TP</th>
                    <th>de</th>
                    <th>à</th>
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
</script>
</body></html>
