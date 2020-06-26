/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import '../css/app.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
});

$(document).ready(function () {
    $('.bamboo-btn').on('click', function (e) {
        e.preventDefault();

        var $link = $(e.currentTarget);
        $.ajax({
            method: 'POST',
            url: "/pet/1/feed"
        }).done(function (data) {
            $('.bamboo-nb').html(data.bamboo);

            // Check if value = 0, if so, class with background grey
            if (data.bamboo === 0) {
                $('#button-pet-eat').addClass('background-grey');
            }
            if (data.happiness >= 10) {
                $('#happy-gauge').addClass('happiness10');
            }

            if (data.happiness >= 20) {
                $('#happy-gauge').addClass('happiness20');
            }
            if (data.happiness >= 30) {
                $('#happy-gauge').addClass('happiness30');
            }
            if (data.happiness >= 40) {
                $('#happy-gauge').addClass('happiness40');
            }
            if (data.happiness >= 50) {
                $('#happy-gauge').addClass('happiness50');
            }
            if (data.happiness >= 60) {
                $('#happy-gauge').addClass('happiness60');
            }
            if (data.happiness >= 70) {
                $('#happy-gauge').addClass('happiness70');
            }
            if (data.happiness >= 80) {
                $('#happy-gauge').addClass('happiness80');
            }
            if (data.happiness >= 90) {
                $('#happy-gauge').addClass('happiness90');
            }
            if (data.happiness >= 100) {
                $('#happy-gauge').addClass('happiness100');
            }


        });
    });
});

$(document).ready(function () {
    $('.button-pill').on('click', function (f) {
        f.preventDefault();

        var $link = $(f.currentTarget);
        $.ajax({
            method: 'POST',
            url: "/pet/1/takePill"
        }).done(function (data) {
            $('.pills-nb').html(data.pills);
console.log(data.pills)
            // Check if value = 0, if so, class with background grey
            if (data.pills === 0) {
                $('#button-pill-link').addClass('background-grey');
            }
console.log(data.health);
            if (data.health >= 10) {
                $('#health-gauge').addClass('health20');
            }

            if (data.health >= 30) {
                $('#health-gauge').addClass('health40');
            }
            if (data.health >= 50) {
                $('#health-gauge').addClass('health60');
            }
            if (data.health >= 80) {
                $('#health-gauge').addClass('health80');
            }
            if (data.health >= 100) {
                $('#health-gauge').addClass('health100');
            }

        })
    });
});
