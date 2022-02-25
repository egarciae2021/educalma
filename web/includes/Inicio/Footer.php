<footer class="footer--light">
    <div class="footer-big">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
            <div class="footer-widget">
              <div class="widget-about">
                <img src="assets/images/Logo.svg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
            <div class="footer-widget">
              <div class="footer-menu">
                <h4 class="footer-widget-title">Nosotros</h4>
                <ul>
                  <li>
                    <a href="https://fundacioncalma.org/%C2%BFqui%C3%A9nes-somos%3F">Qui&eacute;nes Somos</a>
                  </li>
                  <li>
                    <a href="https://fundacioncalma.org/contacto">Cont&aacute;ctanos</a>
                  </li>
                  <li>
                    <a href="https://fundacioncalma.org/%C2%BFc%C3%B3mo-ayudo%3F">Ay&uacute;danos</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
            <div class="footer-widget">
              <div class="footer-menu">
                <!-- <h4 class="footer-widget-title">Blog</h4> -->
                <b><a href="https://fundacioncalma.org/" >Blog</a></b> 
                <ul>
                  <li>
                    <a href="certi.php">Validaci&oacute;n de Certificado</a>
                  </li>
                  <li>
                    <!-- <a href="recursos1.php">Presentaci&oacute;n</a> -->
                    <a href="recursos1.php">Comparte tu curso</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="site-footer">
      <div class="container">
        <hr class="small">
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-12">
            <p class="copyright-text">Copyright © 2021 All Rights Reserved by
              <a href="#">EduCalma</a>
            </p>
          </div>

          <div class="col-md-4 col-sm-6 col-12">
            <ul class="social-icons">
              <li><a class="facebook" href="https://www.facebook.com/fundacioncalma.org/"><i class="fab fa-facebook-f"></i></a></li>
              <li><a class="twitter" href="https://www.youtube.com/channel/UCsEmW0is_Q-d_IMfux0pfEw"><i class="fab fa-twitter"></i></a></li>
              <li><a class="instagram" href="https://www.instagram.com/fundacioncalma/?hl=es"><i class="fab fa-instagram"></i></a></li>
              <li><a class="whatsapp" href="https://api.whatsapp.com/send?phone=51910571087&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20los%20cursos%20."><i class="fab fa-whatsapp"></i></a></li>
              <li><a class="envelope" href="mailto:contacto@fundacioncalma.org"><i class="far fa-envelope"></i></i></a></li>
            </ul>
          </div>
        </div>
      </div>
  </footer>



<!-- <a href="#" id="scroll-to-top" class="hvr-radial-out"><i class="fa fa-angle-up"></i></a> -->

<!-- ALL JS FILES -->
<script src="assets/js/plugins/jquery.min.js"></script>
<script src="assets/js/plugins/popper.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<!-- ALL PLUGINS -->
<script src="assets/js/plugins/jquery.magnific-popup.min.js"></script>
<script src="assets/js/plugins/jquery.pogo-slider.min.js"></script>
<script src="assets/js/plugins/slider-index.js"></script>
<script src="assets/js/plugins/smoothscroll.js"></script>
<script src="assets/js/plugins/form-validator.min.js"></script>
<script src="assets/js/plugins/contact-form-script.js"></script>
<script src="assets/js/plugins/isotope.min.js"></script>
<script src="assets/js/plugins/images-loded.min.js"></script>
<script src="assets/js/plugins/custom.js"></script>
<script src="https://kit.fontawesome.com/f9e5248491.js" crossorigin="anonymous"></script>


<!-- ALL PLUGINS ADMIN LTE3-->
<!-- jQuery -->

<!-- Bootstrap 4 -->
<script src="includes/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->

<script src="includes/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="includes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="includes/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="includes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="includes/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="includes/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="includes/plugins/jszip/jszip.min.js"></script>
<script src="includes/plugins/pdfmake/pdfmake.min.js"></script>
<script src="includes/plugins/pdfmake/vfs_fonts.js"></script>
<script src="includes/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="includes/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="includes/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<!-- <script type="text/javascript" src="../../dataTable/datatables.min.js"></script> -->


















<script>
/* counter js */

(function($) {
    $.fn.countTo = function(options) {
        options = options || {};

        return $(this).each(function() {
            // set options for current element
            var settings = $.extend({}, $.fn.countTo.defaults, {
                from: $(this).data('from'),
                to: $(this).data('to'),
                speed: $(this).data('speed'),
                refreshInterval: $(this).data('refresh-interval'),
                decimals: $(this).data('decimals')
            }, options);

            // how many times to update the value, and how much to increment the value on each update
            var loops = Math.ceil(settings.speed / settings.refreshInterval),
                increment = (settings.to - settings.from) / loops;

            // references & variables that will change with each update
            var self = this,
                $self = $(this),
                loopCount = 0,
                value = settings.from,
                data = $self.data('countTo') || {};

            $self.data('countTo', data);

            // if an existing interval can be found, clear it first
            if (data.interval) {
                clearInterval(data.interval);
            }
            data.interval = setInterval(updateTimer, settings.refreshInterval);

            // initialize the element with the starting value
            render(value);

            function updateTimer() {
                value += increment;
                loopCount++;

                render(value);

                if (typeof(settings.onUpdate) == 'function') {
                    settings.onUpdate.call(self, value);
                }

                if (loopCount >= loops) {
                    // remove the interval
                    $self.removeData('countTo');
                    clearInterval(data.interval);
                    value = settings.to;

                    if (typeof(settings.onComplete) == 'function') {
                        settings.onComplete.call(self, value);
                    }
                }
            }

            function render(value) {
                var formattedValue = settings.formatter.call(self, value, settings);
                $self.html(formattedValue);
            }
        });
    };

    $.fn.countTo.defaults = {
        from: 0, // the number the element should start at
        to: 0, // the number the element should end at
        speed: 1000, // how long it should take to count between the target numbers
        refreshInterval: 100, // how often the element should be updated
        decimals: 0, // the number of decimal places to show
        formatter: formatter, // handler for formatting the value before rendering
        onUpdate: null, // callback method for every time the element is updated
        onComplete: null // callback method for when the element finishes updating
    };

    function formatter(value, settings) {
        return value.toFixed(settings.decimals);
    }
}(jQuery));

jQuery(function($) {
    // custom formatting example
    $('.count-number').data('countToOptions', {
        formatter: function(value, options) {
            return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
        }
    });

    // start all the timers
    $('.timer').each(count);

    function count(options) {
        var $this = $(this);
        options = $.extend({}, options || {}, $this.data('countToOptions') || {});
        $this.countTo(options);
    }
});
</script>
</body>

</html>
