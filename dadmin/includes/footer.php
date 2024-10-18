 <!-- Main Footer Start -->
 <footer class="main--footer main--footer-light">
     <p style="color: #725d93;" align="center">Copyright &copy; 2023 | All Rights Reserved. Powered by <a
             href="javascript:void(0);" target="_blank" style="color: #2a3364;">MSG</a></p>
 </footer>
 <!-- Main Footer End -->
 </main>
 <!-- Main Container End -->
 </div>
 <!-- Wrapper End -->

 <!-- Scripts -->
 <script src="assets/js/jquery-ui.min.js"></script>
 <script src="assets/js/bootstrap.bundle.min.js"></script>
 <script src="assets/js/perfect-scrollbar.min.js"></script>
 <script src="assets/js/jquery.sparkline.min.js"></script>
 <script src="assets/js/raphael.min.js"></script>
 <script src="assets/js/morris.min.js"></script>
 <script src="assets/js/select2.min.js"></script>
 <script src="assets/js/jquery-jvectormap.min.js"></script>
 <script src="assets/js/jquery-jvectormap-world-mill.min.js"></script>
 <script src="assets/js/horizontal-timeline.min.js"></script>
 <script src="assets/js/jquery.validate.min.js"></script>
 <script src="assets/js/jquery.steps.min.js"></script>
 <script src="assets/js/dropzone.min.js"></script>
 <script src="assets/js/ion.rangeSlider.min.js"></script>
 <script src="assets/js/datatables.min.js"></script>
 <script src="assets/js/main.js"></script>
 <script src="record-process\js\record-process.js"></script>
 
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script> <!-- For Excel export -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

 <script>
$(function() {
    var current = location.pathname.toLocaleLowerCase();
    $('.sidebar--nav ul li a').each(function() {
        var $this = $(this);
        var href = $this.attr('href');
        var que = location.search;
        href = href.replace(/\?.*/, "").toLocaleLowerCase();
        if (href === location.pathname.split("/")[3]) {
            //                    console.log(location.pathname.split("/")[3]);
            if (que !== '') {
                if (this.href === window.location.href)
                    ($this).closest('li').addClass('active');
            } else {
                $this.parent().addClass('active');
            }
            if ($this.parent().parent().parent().attr('class') === 'is-dropdown') { //console.log(que);
                var currentli = $($this.parent().parent().parent().addClass('open'));
            }

            //                    else{
            //                        var currentli = $($('.nav-item').find('a.active')).parent().addClass('active');
            //                    }
        }
    });
});
 </script>
 <!-- Page Level Scripts -->


 </body>

 </html>