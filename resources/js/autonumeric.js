import jQuery, { fn } from 'jquery';
window.$ = jQuery;

import AutoNumeric from 'autonumeric';

// Separator Thousand
window.myinput = AutoNumeric.multiple(['#stock', '#price'], '', {
    decimalPlaces: 0,
    outputFormat: "number",
    unformatOnSubmit: true
});
