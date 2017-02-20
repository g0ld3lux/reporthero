const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Uncomment Plugin Compilation if you already have it to Make Webpack Faster
 |
 */

// var pluginPath =  'resources/assets/plugins/';

// mix.combine([
//     // ** Required Plugins **
//     pluginPath + 'jquery/jquery.js',
//     pluginPath + 'bootstrap/tether.js',
//     pluginPath + 'bootstrap/bootstrap.js',
//     pluginPath + 'customScrollBar/customScrollBar.js',

//     // ** Additional Plugins **
//     pluginPath + 'ladda/spin.js',
//     pluginPath + 'ladda/ladda.js',
//     pluginPath + 'toastr/toastr.js',
//     pluginPath + 'notie/notie.js',
//     pluginPath + 'jquery-validate/jquery.validate.js',
//     pluginPath + 'jquery-validate/additional-methods.js',
//     pluginPath + 'clockpicker/bootstrap-clockpicker.js',
//     pluginPath + 'switchery/switchery.js',
//     pluginPath + 'select2/select2.js',
//     pluginPath + 'datatables/dataTables.min.js',
//     pluginPath + 'datatables/dataTables.bootstrap.js',
//     pluginPath + 'multiselect/jquery.multi-select.js',
//     pluginPath + 'bootstrapSelect/bootstrap-select.js',
//     pluginPath + 'bootstrap-datepicker/bootstrap-datepicker.js',
//     pluginPath + 'timepicker/jquery.timepicker.js',
//     pluginPath + 'summernote/summernote.js',
//     pluginPath + 'simplemde/simplemde.min.js',
//     pluginPath + 'Chartjs/Chart.js',
//     pluginPath + 'alertify/alertify.js',
//     pluginPath + 'easypiecharts/jquery.easypiechart.js',
//     pluginPath + 'metisMenu/metisMenu.js',
// ],'public/assets/js/core/plugins.js')

mix.js('resources/assets/js/app.js','public/assets/js/')

// .sass('resources/assets/sass/laraspace.scss', 'public/assets/css/')

// if(mix.config.inProduction) mix.version();


