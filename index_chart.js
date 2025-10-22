function index_chart(){
  var dom = document.getElementById("indexChart");
  var myChart = echarts.init(dom);
  var option;
  var dataMap = {};	

	option = {
		baseOption:{
			timeline:{
	      axisType: 'category',
	      autoPlay: true,   
	      bottom:30, 
	      playInterval: 10000,
	      replaceMerge: 'series',
	      data: ['m6A', 'psedo & ATOI']
			},
			color: ['#5ec9db', '#fdc765', '#f27d51', '#869f82', '#e377c2', '#7f7f7f', '#bcbd22'],	
	    textStyle:{
	      fontSize: 15
	    },
	    tooltip: {},
		  legend: {
		    textStyle: {
		      overflow: "break"
		    }
		  },
	    grid: {
	      containLabel:true,
	      top: 80, //相当于外边距
	      bottom: 0,
	      left: 30,
	      tooltip: {
	        trigger: 'axis',
	        axisPointer: {
	            type: 'shadow'
	        }
	      }
	    }, 
	    xAxis: [
	      {
	        type: 'category',
	        name:"Modification",
	        axisLabel: { 
	          interval: 0,
	          width: 90,
	          lineHeight: 17,
	          overflow: "break"
	        },
	        nameTextStyle: {
	          color: "rgba(0, 0, 0, 1)" //坐标轴名称颜色
	        }, 
	        axisLine: { 
	          lineStyle: { 
	            color: "rgba(0, 0, 0, 1)" //坐标轴线颜色
	          }
	        }
	      }
	    ],
	    yAxis: [
	      {
	        type: 'value',
	        name: 'Number of sites',
	        // max: 70000, //最大值
	        nameTextStyle: {
	          color: "rgba(0, 0, 0, 1)",
	          align: "center"
	        },
	        axisLine: {
	          lineStyle: {
	            color: "rgba(0, 0, 0, 1)"
	          }
	        }
	      }
	    ],    
	    series: []
		},
		options:[
			{
				title: { text:'m6A', left:20, textStyle: {fontSize: 20}},
			  legend: {
			    textStyle: {
			      overflow: "break"
			    },	    
			    data: ['Sites', 'Pre-RNA RNAstructure', 'Pre-RNA ViennaRNA', 'Matrue-RNA RNAstructure', 'Matrue-RNA ViennaRNA']
			  },
		    grid: {
		      containLabel:true,
		      top: 80, //相当于外边距
		      bottom: 100,
		      tooltip: {
		        trigger: 'axis',
		        axisPointer: {
		            type: 'shadow'
		        }
		      }
		    },
		    xAxis: [
		      {
		        type: 'category',
		        name:"Modification",
		        axisLabel: { 
		          interval: 0,
		          overflow: "break"
		        },
		        nameTextStyle: {
		          color: "rgba(0, 0, 0, 1)" //坐标轴名称颜色
		        }, 
		        axisLine: { 
		          lineStyle: { 
		            color: "rgba(0, 0, 0, 1)" //坐标轴线颜色
		          }
		        }
		      }
		    ],
		    yAxis: [
		      {
		        type: 'value',
		        name: 'Number of sites',
		        max: 400000, //最大值
		        nameTextStyle: {
		          color: "rgba(0, 0, 0, 1)",
		          align: "center"
		        },
		        axisLine: {
		          lineStyle: {
		            color: "rgba(0, 0, 0, 1)"
		          }
		        }
		      }
		    ],
		    series: [
		      { 
		        name: 'Sites', 
		        type: 'bar', 
		        itemStyle: { 
		          color: "#dd6b66", 
		          borderWidth:1.5, 
		          borderRadius: [0, 2, 2, 0]
		        },
		        data: [
		          ['Homo sapiens\n m6A',422730],
		          ['Mus musculus\n m6A',266632],
		          ['Rattus norvegicus\n m6A',6144],
		          ['Arabidopsis thaliana\n m6A',35329],
		          ['Drosophila melanogaster\n m6A',25570],
		          ['Saccharomyces cerevisiae\n m6A',10560],
		          ['Danio rerio\n m6A',24860]
		        ]
		      },
		      { 
		        name: 'Pre-RNA RNAstructure', 
		        type: 'bar', 
		        itemStyle: { 
		          color: "#759aa0", 
		          borderWidth:1.5, 
		          borderRadius: [0, 2, 2, 0]
		        },
		        data: [
		          ['Homo sapiens\n m6A',394631],
		          ['Mus musculus\n m6A',261142],
		          ['Rattus norvegicus\n m6A',5470],
		          ['Arabidopsis thaliana\n m6A',24204],
		          ['Drosophila melanogaster\n m6A',25335],
		          ['Saccharomyces cerevisiae\n m6A',10555],
		          ['Danio rerio\n m6A',23108]
		        ]
		      },
		      { 
		        name: 'Pre-RNA ViennaRNA', 
		        type: 'bar', 
		        itemStyle: { 
		          color: "#eedd78", 
		          borderWidth:1.5, 
		          borderRadius: [0, 2, 2, 0]
		        },
		        data: [
		          ['Homo sapiens\n m6A',394594],
		          ['Mus musculus\n m6A',261142],
		          ['Rattus norvegicus\n m6A',5469],
		          ['Arabidopsis thaliana\n m6A',24203],
		          ['Drosophila melanogaster\n m6A',25333],
		          ['Saccharomyces cerevisiae\n m6A',10553],
		          ['Danio rerio\n m6A',23089]
		        ]
		      },
		      { 
		        name: 'Matrue-RNA RNAstructure', 
		        type: 'bar', 
		        itemStyle: { 
		          color: "#e69d87", 
		          borderWidth:1.5, 
		          borderRadius: [0, 2, 2, 0]
		        },
		        data: [
		          ['Homo sapiens\n m6A',363242],
		          ['Mus musculus\n m6A',252260],
		          ['Rattus norvegicus\n m6A',5378],
		          ['Arabidopsis thaliana\n m6A',23781],
		          ['Drosophila melanogaster\n m6A',24588],
		          ['Saccharomyces cerevisiae\n m6A',10520],
		          ['Danio rerio\n m6A',22524]
		        ]
		      },
		      { 
		        name: 'Matrue-RNA ViennaRNA', 
		        type: 'bar', 
		        itemStyle: { 
		          color: "#8dc1a9", 
		          borderWidth:1.5, 
		          borderRadius: [0, 2, 2, 0]
		        },
		        data: [
		          ['Homo sapiens\n m6A',363212],
		          ['Mus musculus\n m6A',252248],
		          ['Rattus norvegicus\n m6A',5377],
		          ['Arabidopsis thaliana\n m6A',23780],
		          ['Drosophila melanogaster\n m6A',24582],
		          ['Saccharomyces cerevisiae\n m6A',10518],
		          ['Danio rerio\n m6A',22467]
		        ]
		      },
		      { 
		        type: 'pie', 
		        center: ['60%', '35%'],
		        radius: '28%',
		        animation: false,
		        z:100,
		        minAngle: 10,
			      label: {
			        fontSize: 10,
			        lineHeight: 12
			      },		
				    tooltip: {
				      trigger: 'item',
				      formatter: "<b>{b}</b> : {c} ({d}%)"
				    },			      	        
		        data: [
			        {name:"Homo Sapiens",value:422730},
			        {name:"Mus Musculus",value:266632},
			        {name:"Rattus Norvegicus",value:6144},
			        {name:"Arabidopsis Thaliana",value:35329},
			        {name:"Drosophila Melanogaster",value:25570},
			        {name:"Saccharomyces Cerevisiae",value:10560},
			        {name:"Danio Rerio",value:24860}
		        ]
		      },
		      { 
		        type: 'pie', 
		        center: ['80%', '35%'],
		        radius: '28%',
		        animation: false,
		        z:100,
		        minAngle: 10,
			      label: {
			        fontSize: 10,
			        lineHeight: 12
			      },		   
				    tooltip: {
				      trigger: 'item',
				      formatter: "<b>{b}</b> : {c} ({d}%)"
				    },			           
		        data: [
			        {name:"m6A",value:422730},
			        {name:"psedo",value:266632},
			        {name:"ATOI",value:6144}
		        ]
		      }
		    ]
			},
			{
				title: { text:'psedo & ATOI', left:20, textStyle: {fontSize: 20}},
			  legend: {
			    textStyle: {
			      overflow: "break"
			    },	    
			    data: ['Sites', 'Pre-RNA ViennaRNA', 'Matrue-RNA ViennaRNA']
			  },
		    grid: {
		      containLabel:true,
		      top: 80, //相当于外边距
		      bottom: 100,
		      tooltip: {
		        trigger: 'axis',
		        axisPointer: {
		            type: 'shadow'
		        }
		      }
		    },
		    xAxis: [
		      {
		        type: 'category',
		        name:"Modification",
		        axisLabel: { 
		          interval: 0,
		          overflow: "break"
		        },
		        nameTextStyle: {
		          color: "rgba(0, 0, 0, 1)" //坐标轴名称颜色
		        }, 
		        axisLine: { 
		          lineStyle: { 
		            color: "rgba(0, 0, 0, 1)" //坐标轴线颜色
		          }
		        }
		      }
		    ],
		    yAxis: [
		      {
		        type: 'value',
		        name: 'Number of sites',
		        max: 40000, //最大值
		        nameTextStyle: {
		          color: "rgba(0, 0, 0, 1)",
		          align: "center"
		        },
		        axisLine: {
		          lineStyle: {
		            color: "rgba(0, 0, 0, 1)"
		          }
		        }
		      }
		    ],
		    series: [
		      { 
		        name: 'Sites', 
		        type: 'bar', 
		        itemStyle: { 
		          color: "#dd6b66", 
		          borderWidth:1.5, 
		          borderRadius: [0, 2, 2, 0]
		        },
		        data: [
		          ['Homo sapiens\n ATOI',142648],
		          ['Mus musculus\n ATOI',8835],
		          ['Rattus norvegicus\n ATOI',10],		        	
		          ['Homo sapiens\n psedo',4835],
		          ['Mus musculus\n psedo',4291],
		          ['Rattus norvegicus\n psedo',1317],
		          ['Bos taurus\n psedo',381],
		          ['Oryctolagus cuniculus\n psedo',225]
		        ]
		      },
		      { 
		        name: 'Pre-RNA ViennaRNA', 
		        type: 'bar', 
		        itemStyle: { 
		          color: "#eedd78", 
		          borderWidth:1.5, 
		          borderRadius: [0, 2, 2, 0]
		        },
		        data: [
		          ['Homo sapiens\n ATOI',127982],
		          ['Mus musculus\n ATOI',7401],
		          ['Rattus norvegicus\n ATOI',4],		        	
		          ['Homo sapiens\n psedo',3307],
		          ['Mus musculus\n psedo',3528],
		          ['Rattus norvegicus\n psedo',897],
		          ['Bos taurus\n psedo',68],
		          ['Oryctolagus cuniculus\n psedo',2]
		        ]
		      },
		      { 
		        name: 'Matrue-RNA ViennaRNA', 
		        type: 'bar', 
		        itemStyle: { 
		          color: "#8dc1a9", 
		          borderWidth:1.5, 
		          borderRadius: [0, 2, 2, 0]
		        },
		        data: [
		          ['Homo sapiens\n ATOI',29851],
		          ['Mus musculus\n ATOI',2486],
		          ['Rattus norvegicus\n ATOI',4],		        	
		          ['Homo sapiens\n psedo',2683],
		          ['Mus musculus\n psedo',3354],
		          ['Rattus norvegicus\n psedo',861],
		          ['Bos taurus\n psedo',5],
		          ['Oryctolagus cuniculus\n psedo',0]
		        ]
		      },
		      {  
		        type: 'pie', 
		        center: ['60%', '35%'],
		        radius: '28%',
		        animation: false,
		        z:100,
		        minAngle: 10,
			      label: {
			        fontSize: 10,
			        lineHeight: 12
			      },	
				    tooltip: {
				      trigger: 'item',
				      formatter: "<b>{b}</b> : {c} ({d}%)"
				    },			      	        
		        data: [
			        {name:"Homo Sapiens",value:422730},
			        {name:"Mus Musculus",value:266632},
			        {name:"Rattus Norvegicus",value:6144},
			        {name:"Arabidopsis Thaliana",value:35329},
			        {name:"Drosophila Melanogaster",value:25570},
			        {name:"Saccharomyces Cerevisiae",value:10560},
			        {name:"Danio Rerio",value:24860}
		        ]
		      },
		      { 
		        type: 'pie', 
		        center: ['80%', '35%'],
		        radius: '28%',
		        animation: false,
		        z:100,
		        minAngle: 10,
			      label: {
			        fontSize: 10,
			        lineHeight: 12
			      },		
				    tooltip: {
				      trigger: 'item',
				      formatter: "<b>{b}</b> : {c} ({d}%)"
				    },			              
		        data: [
			        {name:"m6A",value:422730},
			        {name:"psedo",value:266632},
			        {name:"ATOI",value:6144}
		        ]
		      }
		    ]
			}
		]
	};

	if (option && typeof option === 'object') {
	  myChart.setOption(option);
	}
	window.addEventListener('resize', myChart.resize);

}