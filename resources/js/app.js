//require('./bootstrap');
require('lightbox2');


try {

    window.$ = window.jQuery = require('jquery');

    require('select2');

} catch (error) {
    console.log(error);
}