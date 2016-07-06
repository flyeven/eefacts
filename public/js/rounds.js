$(function () {
	$('#rounds-table').hide();
	$('#rounds-table-toggle').on('click', function(event){
		event.preventDefault();
		$('#rounds-table').slideToggle('slow',function(){
			if($('#rounds-table').is(":hidden")) {
				$('#rounds-table-toggle').html('See full list');
				$('#rounds-table-toggle').removeClass('fa-angle-up').addClass('fa-angle-down');
			}else{
				$('#rounds-table-toggle').html('Hide list');
				$('#rounds-table-toggle').removeClass('fa-angle-down').addClass('fa-angle-up');
			}
		});
	});

    var scores = [];
    var invitations = [];

    var scoresCurrent = [];
    var invitationsCurrent = [];

    var currentYr = new Date().getFullYear();


    $.ajax({
      dataType: "json",
      url: $('#rounds-url').val(),
      success: function(response){
        $.each(response, function(k, v){
            dmy = v.drawn_at.split('-');

            scores.push([Date.UTC(dmy[0],  dmy[1]-1, dmy[2]), parseFloat(v.score)]);
            invitations.push([Date.UTC(dmy[0],  dmy[1]-1, dmy[2]), parseInt(v.invitations)]);

            if(dmy[0] == currentYr){
                scoresCurrent.push([Date.UTC(dmy[0],  dmy[1]-1, dmy[2]), parseFloat(v.score)]);
                invitationsCurrent.push([Date.UTC(dmy[0],  dmy[1]-1, dmy[2]), parseInt(v.invitations)]);
            }
        })
        $('#rounds-graph-current').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Express Entry '+currentYr+' - Rounds of invitations - '+currentYr+' draws'
            },
            subtitle: {
                text: 'Number of invitations issued & CRS score of lowest-ranked candidate invited'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                },
                title: {
                    text: 'Date'
                },
            },
            yAxis: {
                title: {
                    text: 'Score / Invitations'
                },
                min: 0
            },

            colors: ['#7cb5ec', '#c42525'],
            tooltip: {
                headerFormat: '<b>{series.name}</b><br>',
                pointFormat: '{point.x:%e %b}: {point.y:.0f}'
            },

            plotOptions: {
                spline: {
                    marker: {
                        enabled: true
                    }
                }
            },

            series: [{
                name: 'CRS score',
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
                data: scoresCurrent
            }, {
                name: 'Invitations issued',
                data: invitationsCurrent
            }]
        });

                $('#rounds-graph').highcharts('StockChart',{
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Express Entry - Rounds of invitations - All draws to date'
            },
            subtitle: {
                text: 'Number of invitations issued & CRS score of lowest-ranked candidate invited'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                },
                title: {
                    text: 'Date'
                }
            },
            yAxis: {
                title: {
                    text: 'Score / Invitations'
                },
                min: 0
            },
            colors: ['#7cb5ec', '#c42525'],
            scrollbar: {
                enabled: true,
                height: 30,
                minWidth: 20
            },
            legend:{
                enabled: true
            },
            rangeSelector:{
                selected: 2
            },
            tooltip: {
                shared: false,
                headerFormat: '<b>{series.name}</b><br>',
                pointFormat: '{point.x:%e %b}: {point.y:.0f}'
            },

            plotOptions: {
                spline: {
                    marker: {
                        enabled: true
                    }
                }
            },

            series: [{
                name: 'CRS score',
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
                data: scores
            }, {
                name: 'Invitations issued',
                data: invitations
            }]
        });

      }
    });
});