'use strict';



$(document).ready(function () {
	apex_chart_six();

	function apex_chart_six() {
		var options = {
			chart: {
				height: 500,
				type: 'bar'
			},
			plotOptions: {
				bar: {
					barHeight: '100%',
					distributed: true,
					horizontal: true,
					dataLabels: {
						position: 'bottom'
					}
				}
			},
			colors: ['#33b2df', '#546E7A', '#d4526e', '#13d8aa', '#A5978B', '#2b908f', '#f9a3a4', '#90ee7e', '#f48024', '#69d2e7'],
			dataLabels: {
				enabled: true,
				textAnchor: 'start',
				style: {
					colors: ['#fff']
				},
				formatter: function(val, opt) {
					return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val;
				},
				offsetX: 0,
                offsetY: -4,
				dropShadow: {
					enabled: true
				}
			},
			series: [{
				data: [400, 430, 448, 470, 540, 580, 690,540, 580, 690, 1100, 1200, 1380]
			}],
			stroke: {
				width: 1,
				colors: ['#fff']
			},
			xaxis: {
				categories: ['کالا1', 'کالا1', 'کالا1', 'کالا1', 'کالا1', 'کالا1', 'کالا1', 'کالا1', 'کالا1', 'کالا1', 'کالا1', 'کالا1 ', 'کالا1', 'کالا1']
			},
			yaxis: {
				labels: {
					show: false
				}
			},
			title: {
				text: 'تعداد فروش کالا',
				align: 'center',
				floating: true
			},
			subtitle: {
				text: 'گزارش ماهانه',
				align: 'center'
			},
			tooltip: {
				theme: 'dark',
				x: {
					show: false
				},
				y: {
					title: {
						formatter: function() {
							return '';
						}
					}
				}
			}
		}

		var chart = new ApexCharts(
			document.querySelector("#apex_chart_six"),
			options
		);

		chart.render();
	}

});