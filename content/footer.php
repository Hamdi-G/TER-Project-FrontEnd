<footer class="footer">
  <div class="container-fluid">
    <nav class="pull-left">
      <ul>
        <li>
          <a href="http://unice.fr/iut/presentation/accueil">
            <img src="../hello_files/logo_iut.gif" width="30" height="30">
          </a>
        </li>
      </ul>
    </nav>
    <p class="copyright pull-right">
      ©<script>
      document.write(new Date().getFullYear())
      </script>
      <a href="#">Creative Tim</a>, made with love for a better web
    </p>
  </div>
</footer>
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 662px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 511px;"></div></div></div>
</div>


<!--   Core JS Files   -->
<script src="../hello_files/jquery-ui.min.js" type="text/javascript"></script>
<script src="../hello_files/bootstrap.min.js" type="text/javascript"></script>
<script src="../hello_files/material.min.js" type="text/javascript"></script>
<script src="../hello_files/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="../hello_files/jquery.validate.min.js"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="../hello_files/moment.min.js"></script>
<!--  Charts Plugin -->
<script src="../hello_files/chartist.min.js"></script>
<!--  Plugin for the Wizard -->
<script src="../hello_files/jquery.bootstrap-wizard.js"></script>
<!--  Notifications Plugin    -->
<script src="../hello_files/bootstrap-notify.js"></script>
<!--   Sharrre Library    -->
<script src="../hello_files/jquery.sharrre.js"></script>
<!-- DateTimePicker Plugin -->
<script src="../hello_files/bootstrap-datetimepicker.js"></script>
<!-- Vector Map plugin -->
<script src="../hello_files/jquery-jvectormap.js"></script>
<!-- Sliders Plugin -->
<script src="../hello_files/nouislider.min.js"></script>
<!-- Select Plugin -->
<script src="../hello_files/jquery.select-bootstrap.js"></script>
<!--  DataTables.net Plugin    -->
<script src="../hello_files/jquery.datatables.js"></script>
<!-- Sweet Alert 2 plugin -->
<script src="../hello_files/sweetalert2.js"></script>
<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="../hello_files/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin    -->
<script src="../hello_files/fullcalendar.min.js"></script>
<!-- TagsInput Plugin -->
<script src="../hello_files/jquery.tagsinput.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="../hello_files/material-dashboard.js"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="../hello_files/demo.js"></script>



<script src="../js/functions.js"></script>

<script>



(function() {
  $(document).ready(function() {
    var $loader = $("#loader");
    $loader.gSpinner();





      $.ajax({
        url: 'http://localhost/TER-Project-BackEnd/web/app_dev.php/api/teachers/'+ '<?php echo $user_id; ?>',
        type: 'GET',
        dataType: "json",
        success: function(response){
          $loader.gSpinner("hide");
        //  console.log(response);
          $('#pseudo').html(response.username +' <b class="caret"></b>');
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
})();
</script>
