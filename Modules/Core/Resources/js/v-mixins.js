window.Vue = require('vue');

import {Ziggy} from './ziggy'
import route from '../../../../vendor/tightenco/ziggy/src/js/route'

window.Ziggy = Ziggy;

var moment = require('moment')
import 'moment/locale/id'
moment.locale('id')

Vue.mixin({
    methods: {
        ziggy: function ( name, params, absolute ) { 
            var namedRoute = route(name, params, true, Ziggy)
            return namedRoute;
        },
        base_url: function() {
            return window.location.origin;
        },
        route_params: function( num ) {
            var pathname = window.location.pathname.split('/');
            return pathname[num];
        },
        number_format: function (number, decimals, dec_point, thousands_sep) {
            decimals = typeof decimals !== 'undefined' ? decimals : 0;
            dec_point = typeof dec_point !== 'undefined' ? dec_point : ',';
            thousands_sep = typeof thousands_sep !== 'undefined' ? thousands_sep : '.';

            var n = !isFinite(+number) ? 0 : +number, 
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                toFixedFix = function (n, prec) {
                    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                    var k = Math.pow(10, prec);
                    return Math.round(n * k) / k;
                },
                s = (prec ? toFixedFix(n, prec) : Math.round(n)).toString().split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        },
        goto: function(url) {
            window.location.href = url
        },
        reformatDateTime: (dt, from, to) => {
            return dt ? moment(dt, from).format(to) : dt;
        }
    }
});