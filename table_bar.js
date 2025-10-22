function bar_chart(chartInstance,chart_title,chart_data){
	option = {
    title:{
      text: chart_title,
      // left: 'center',
      textStyle: {
        fontSize: 16
      }
    },
    color: ['#5ec9db', '#fdc765', '#f27d51', '#6462cc', '#869f82', '#ff5384', '#e377c2', '#7f7f7f', '#bcbd22', '#17becf'],	
    legend: {},
    tooltip: {},
    grid: {
      // containLabel:true,
      // top: 45, //相当于外边距
      bottom: 45,
      // right: 170,
      // tooltip: {
      //   trigger: 'axis',
      //   axisPointer: {
      //       type: 'shadow'
      //   },
      //   backgroundColor : 'rgba(40,40,40,0.5)',
      //   borderColor : 'rgba(40,40,40,0.5)',
      //   textStyle: {
      //     color: "rgba(255, 255, 255, 1)"
      //   }
      // },
      left:50
    },	  
	  xAxis: {
	    type: 'category',
	    data: ['10%','50%','other','No_alteration'],
      axisLabel: { 
        interval: 0,
        fontSize: 10,
      },      
	    axisLine: {
	      lineStyle: {
	        color: "rgba(0, 0, 0, 1)"
	      }
	    },
	    nameTextStyle: {
	      color: "rgba(0, 0, 0, 1)"
	    },
	    nameRotate: 30	
	  },
	  yAxis: {
	    type: 'value',
      nameTextStyle: {
        color: "rgba(0, 0, 0, 1)" //坐标轴名称颜色
      }, 
      axisLine: { 
      	show: true,
        lineStyle: { 
          color: "rgba(0, 0, 0, 1)" //坐标轴线颜色
        }
      }	  
	  },
	  series: [
	    {
	      data: chart_data,
	      type: 'bar',
	      barWidth: "70%"
	    }
	  ]
	};	
  chartInstance.setOption(option);
  window.addEventListener('resize', chartInstance.resize);
}