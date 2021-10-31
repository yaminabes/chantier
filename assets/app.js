/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)

import * as bootstrap from 'bootstrap';
import { Tooltip, Toast, Popover } from 'bootstrap';
import './styles/app.scss';
// start the Stimulus application
import './bootstrap';

Array.from(document.querySelectorAll('.toast'))
    .forEach(toastNode => new Toast(toastNode));

Array.from(document.querySelectorAll('[data-bs-toggle="popover"]'))
    .forEach(popoverTriggerEl => new Popover(popoverTriggerEl));


  var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
  var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})

