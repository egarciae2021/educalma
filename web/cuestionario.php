<?php   
    ob_start();
    @session_start();
?>
<?php include_once 'includes/Inicio/Head.php' ?>

<head>
    <link rel="shortcut icon" href="assets/images/logo_edu.png">
</head>

<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">
    
    <?php //include_once 'includes/inicio/loader.php' ?> 
    
    <?php include_once 'includes/Inicio/Header.php' ?>

    <?php include_once 'includes/curso/CuestionarioContent.php' ?>
 
    
    <script src="assets/js/home.js"></script>
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
