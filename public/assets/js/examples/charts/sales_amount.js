'use strict';
$(document).ready(function () {

    var data = [
            { y: 'فروردین', a: 50, b: 90},
            { y: 'اردیبهشت', a: 65,  b: 75},
            { y: 'خرداد', a: 50,  b: 50},
            { y: 'تیر', a: 75,  b: 60},
            { y: 'مرداد', a: 80,  b: 65},
            { y: 'شهریور', a: 90,  b: 70},
            { y: 'مهر', a: 100, b: 75},
            { y: 'آبان', a: 115, b: 75},
            { y: 'آذر', a: 120, b: 85},
            { y: 'دی', a: 145, b: 85},
            { y: 'بهمن', a: 145, b: 85},
            { y: 'اسفند', a: 160, b: 95}
        ],
        config = {
            data: data,
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['مجموع فروش', 'مجموع خرید'],
            fillOpacity: 0.6,
            hideHover: 'auto',
            behaveLikeLine: true,
            resize: true,
            pointFillColors:['#ffffff'],
            pointStrokeColors: ['black'],
            lineColors:['gray','red'],
			gridTextFamily: 'inherit'
        };

    config.element = 'stacked';
    config.stacked = true;
    Morris.Bar(config);
  
});