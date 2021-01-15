const mix = require('laravel-mix');


mix.copyDirectory('node_modules/admin-lte/plugins', 'public/admin/js/plugins')
  .copyDirectory('node_modules/admin-lte/build/scss', 'resources/sass/admin')

mix.js('resources/js/app.js', 'public/admin/js')
  .sass('resources/sass/admin/app.scss', 'public/admin/css/app.css')
  .scripts([
    "public/admin/js/plugins/datatables/jquery.dataTables.min.js",
    "public/admin/js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js",
    "public/admin/js/plugins/datatables-responsive/js/dataTables.responsive.min.js",
  ], 'public/admin/js/datatables.js')
  .styles([
    "public/admin/js/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css",
    "public/admin/js/plugins/datatables-responsive/css/responsive.bootstrap4.css",
    'public/admin/js/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
    'public/admin/js/plugins/sweetalert2/sweetalert2.min.css',
    'public/admin/js/plugins/select2/css/select2.min.css',
  ], 'public/admin/css/backend-plugins.css')
  .scripts([
    "public/admin/js/plugins/sweetalert2/sweetalert2.all.js",
    "public/admin/js/plugins/jquery-validation/jquery.validate.min.js",
    "public/admin/js/plugins/jquery-validation/additional-methods.js",
    "public/admin/js/plugins/select2/js/select2.min.js",
  ], 'public/admin/js/backend-plugins.js')
  .sourceMaps();

