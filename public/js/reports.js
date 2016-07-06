$(function () {
    $('#profiles').highcharts({
        colorAxis: {
            minColor: '#ffffff',
            // maxColor: Highcharts.getOptions().colors[7]
            maxColor: '#FF0000'
        },
        series: [{
            type: 'treemap',
            layoutAlgorithm: 'sliceAndDice',
            data: [{
                name: 'Not Eligible (43.23%)',
                value: 48723,
                colorValue: 48723
            }, {
                name: 'Number Pending (3.82%)',
                value: 4302,
                colorValue: 4302
            }, {
                name: 'Withdrawn (5.71%)',
                value: 6441,
                colorValue: 6441
            }, {
                name: 'Invited (10.67%)',
                value: 12017,
                colorValue: 12017
            }, {
                name: 'in the Pool (36.57%)',
                value: 41218,
                colorValue: 41218
            }]
        }],
        title: {
            text: 'Express Entry Profiles submitted to the Express Entry Pool'
        },
        subtitle: {
            text: 'As of July 6, 2015, a total of 112,701 foreign nationals had submitted an Express Entry profile.'
        }
    });

  $('#pool').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Comprehensive Ranking System Score Distribution'
        },
        subtitle: {
            text: 'Distribution of Candidates in the Express Entry Pool as of July 06, 2015'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Number of candidates'
            }
        },
        legend: {
            enabled: false
        },
        colors: ['#FF0000'],
        tooltip: {
            pointFormat: 'Number of candidates: <b>{point.y:.0f}</b>'
        },
        series: [{
            name: 'Population',
            data: [
                ['0-100', 21],
                ['100-149', 75],
                ['150-199', 225],
                ['200-249', 585],
                ['250-299', 2247],
                ['300-349', 12517],
                ['350-399', 14597],
                ['400-449', 8770],
                ['450-499', 1786],
                ['500-549', 38],
                ['550-599', 2],
                ['600-649', 1],
                ['650-699', 7],
                ['700-749', 27],
                ['750-799', 64],
                ['800-849', 62],
                ['850-899', 65],
                ['900-949', 40],
                ['950-999', 38],
                ['1000-1200', 51]
            ],
            dataLabels: {
                enabled: true,
                rotation: 0,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.0f}', // one decimal
                y: -0, // 10 pixels down from the top
                x: 15,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });

 $('#programs').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Invitations issued by economic immigration program as of July 6, 2015'
        },
        xAxis: {
            categories: ['Jan. 31', 'Feb. 7', 'Feb. 20', 'Feb. 27', 'Mar. 20', 'Mar. 27', 'Apr. 10', 'Apr. 17', 'May 22', 'June 12', 'June 26']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Invitations issued'
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal'
            }
        },
        series: [{
            name: 'Provincial nominees',
            data: [13, 17, 0, 24, 43, 3, 24, 35, 278, 150, 111]
        }, {
            name: 'Federal Skill Workers',
            data: [432, 167, 0, 114, 500, 1187, 329, 389, 240, 526, 925]
        }, {
            name: 'Federal Skill Trades',
            data: [163, 221, 0, 409, 336, 103, 159, 87, 253, 104, 52]
        }, {
            name: 'Canadian Experience Class',
            data: [171, 374, 849, 640, 741, 344, 413, 204, 590, 721, 487]
        }]
    });

});