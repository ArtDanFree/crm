const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.babel([
        // 'node_modules/gentelella/vendors/echarts/dist/echarts.js',
        // 'node_modules/gentelella/vendors/echarts/map/js/world.js',
        // 'node_modules/gentelella/build/js/custom.js',

        'resources/js/ajax.js',
        'resources/js/script.js',
        'resources/js/notification.js',
        'resources/js/underwriter_online.js',
        'resources/js/timepicker.js'
    ],
    'public/js/my.js').version();

mix.js('resources/js/app.js', 'public/js/app.js').version();

mix.scripts([
        'node_modules/gentelella/vendors/jquery/dist/jquery.js',
        'node_modules/gentelella/vendors/bootstrap/dist/js/bootstrap.js',
        'node_modules/gentelella/vendors/fastclick/lib/fastclick.js',
        'node_modules/gentelella/vendors/nprogress/nprogress.js',
        'node_modules/gentelella/vendors/iCheck/icheck.js',
        //    inputmask
        'node_modules/gentelella/vendors/jquery.inputmask/dist/jquery.inputmask.bundle.js',

        //    datatables
        'node_modules/gentelella/vendors/datatables.net/js/jquery.dataTables.js',
        'node_modules/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.js',
        'node_modules/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.js',
        'node_modules/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.js',
        'node_modules/gentelella/vendors/datatables.net-buttons/js/buttons.flash.js',
        'node_modules/gentelella/vendors/datatables.net-buttons/js/buttons.html5.js',
        'node_modules/gentelella/vendors/datatables.net-buttons/js/buttons.print.js',
        'node_modules/gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.js',
        'node_modules/gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.js',
        'node_modules/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.js',
        'node_modules/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js',
        'node_modules/gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.js',
        //    bootstrap-daterangepicker
        'node_modules/gentelella/vendors/moment/min/moment.min.js',
        'node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js',
        'node_modules/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js',
        'node_modules/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
        'node_modules/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js',
        'node_modules/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js',

        'node_modules/gentelella/vendors/pnotify/dist/pnotify.js',
        'node_modules/gentelella/vendors/pnotify/dist/pnotify.buttons.js',
        'node_modules/gentelella/vendors/pnotify/dist/pnotify.nonblock.js',
        //    bootstrap-daterangepicker
        'node_modules/gentelella/vendors/moment/min/moment.min.js',
        'node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js',


    ],
    'public/js/gentelella.js')

    .sass('resources/sass/app.scss', 'public/css')
    .browserSync('http://vaviloan.test')
    .version()
;
