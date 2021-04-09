const $ = require('jquery');
global.$ = $;
require('select2')
require('select2/dist/css/select2.css')

 // $(function () {
 //    $('.select2-enable').select2({ width: '100%', placeholder: "Select an Option", allowClear: true })
 // });
$(document).ready(function() {
    $('.select2-enable').select2()
});
console.log('select2-enable')