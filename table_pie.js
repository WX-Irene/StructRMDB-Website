function pie_chart(chartInstance,chart_title,chart_data){
  pie_option = {
    title:{
      text: chart_title,
      left: 'center',
      top: '-5',
      textStyle: {
        fontSize: 16
      }
    },
    color: ['#5ec9db', '#fdc765', '#f27d51', '#6462cc', '#869f82', '#ff5384', '#e377c2', '#7f7f7f', '#bcbd22', '#17becf'],
    tooltip: {
      trigger: 'item',
      formatter: "<b>{b}</b> : {c} ({d}%)"
    },
    series: [{
      type: 'pie',
      // minAngle: 10,
      radius: '75%',
      height: "90%",
      center: ['50%', '60%'],
      label: {
        show: false
      },
      labelLine: {
        show: false
      },
      data: chart_data
    }]
  };

  chartInstance.setOption(pie_option);
  window.addEventListener('resize', chartInstance.resize);	
}

