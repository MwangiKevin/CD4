var __FCRatings = {};

var __FCRateSet = [
			{"grey":[1,1,1,1,1],"yellow":[0,0,0,0],"red":[0,0,0,0,0]},
			{"grey":[0,1,1,1,1],"yellow":[1,0,0,0],"red":[0,0,0,0,0]},
			{"grey":[0,0,1,1,1],"yellow":[1,1,0,0],"red":[0,0,0,0,0]},
			{"grey":[0,0,0,1,1],"yellow":[1,1,1,0],"red":[0,0,0,0,0]},
			{"grey":[0,0,0,0,1],"yellow":[1,1,1,1],"red":[0,0,0,0,0]},
			{"grey":[0,0,0,0,0],"yellow":[0,0,0,0],"red":[1,1,1,1,1]}
		];

var __FCRateStars = 
			{	
				"grey": {URL:"grey.png", w:40, h:40, xscale:1, yscale:1},
				"yellow": {URL:"yellow.png", w:40, h:40, xscale:1, yscale:1},
				"red": {URL:"red.png", w:40, h:40, xscale:1, yscale:1}
			};

var FCRater = function( id, div,callback, startRate )
{
	if(!startRate || startRate>__FCRateSet.length-1 ) startRate = 0;
	
	var starHighestWidth=0, starHighestHeight=0,highestNumberOfStars=0, totalw, totalh;
	
	var strXML  = "<chart bgAlpha='0,0' BorderAlpha='0'><annotations>";
	
	for(var ratestar in __FCRateSet[startRate])
	{
		highestNumberOfStars = (__FCRateSet[startRate][ratestar].length>highestNumberOfStars?__FCRateSet[startRate][ratestar].length:highestNumberOfStars);
		starHighestWidth = (__FCRateStars[ratestar].w > starHighestWidth? __FCRateStars[ratestar].w : starHighestWidth);
		starHighestHeight = (__FCRateStars[ratestar].h > starHighestHeight? __FCRateStars[ratestar].h : starHighestHeight);
	}

	for(var ratestar in __FCRateSet[startRate])
	{
		for(var starstat in __FCRateSet[startRate][ratestar])
		{
				strXML += "<annotationGroup id='" + ( ratestar + (parseInt(starstat)+1) ) +
				"'  visible='" + ( __FCRateSet[startRate][ratestar][starstat] ? 1:0 ) + 
				"' link='JavaScript:__FCRatings[&apos;"+id+"&apos;].rate(" + (parseInt(starstat)+1) +
				");'><annotation type='image' x='"+ (starHighestWidth*starstat+1)+
				"' y='1' URL='"+(__FCRateStars[ratestar]["URL"])+"' xscale='"+(__FCRateStars[ratestar]["xscale"]*100)+"' yscale='"+(__FCRateStars[ratestar]["yscale"]*100)+"'/></annotationGroup>";
	
		}
	}
	
	
	strXML += "</annotations></chart>";
	
	var myChart = new FusionCharts("../../../Charts/DrawingPad.swf",id, highestNumberOfStars*starHighestWidth+2, starHighestHeight+2, "0", "1");
	myChart.setXMLData(strXML);
	myChart.setTransparent(true);
	myChart.render(div);
	
   
	
	__FCRatings[id] = {
		now:startRate, 
		rate:function(rating) 
		{  
		
		
			if(!rating || (__FCRatings[id].now==1 && rating==1)) rating = 0;
			__FCRatings[id].now = rating;
		
	
			var __FCRaterobj = getChartFromId(id);
	
			if(__FCRaterobj && __FCRaterobj.hideAnnotation)
			{
				for(var ratestar in __FCRateSet[rating])
				{
					for(var starstat in __FCRateSet[rating][ratestar])
					{
						if ( __FCRateSet[rating][ratestar][starstat] ) { 
							__FCRaterobj.showAnnotation(ratestar+(parseInt(starstat)+1));
						}
						else { 
							__FCRaterobj.hideAnnotation(ratestar+(parseInt(starstat)+1)); 
						}
					}
				}
			
				callback(id,__FCRatings[id].now);
			}
		}
	};
	
	this.getId = function() {return id };
	this.toString = function() { return __FCRatings[id].now };
};

