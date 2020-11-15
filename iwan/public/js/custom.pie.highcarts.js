$(function() {
    $('.ques-pie').each(function(i, obj) {
        var site_url = $('span.site_url').text();
        var id = $(obj).attr('id');
        var split_id = id.split('-');
        var title = $(obj).prev().text();
        console.log(obj);
        $.getJSON(site_url+'grafik/pie_pertanyaan/'+split_id[1], function(data) {

            render_pie(id,title,'responder',data);
            
            console.log(split_id[1]);
        });
    });
    //grafik/pie_pertanyaan
    //setInterval(function(){
        /**/
    //} , 5000);    
});


function render_pie(selector,title,label,values) {
        Highcharts.chart(selector, {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: title
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: label,
        colorByPoint: true,
        data: values
    }]
});   
}