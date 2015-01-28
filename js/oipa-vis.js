function OipaVis(){
	this.name = null;
	this.indicator = null;
	this.chartwrapper = "#visualisation-block-wrapper";

	this.init = function(){
		// create html
		var html = '<svg id="column-chart" style="height:350px; width: 690px;"></svg>';
		$("#visualisation-block-wrapper").append(html);
	};
}




function OipaColumnChart(){
	this.type = "OipaColumnChart";

	this.format_data = function(data){

		return budgetdata;
	};

	this.visualize = function(data){

		var current_vis = this;

		var data = current_vis.format_data(data);

		if (!data){
			// empty data, remove vis
			this.remove();
			return false;
		}

		nv.addGraph(function() {
			var chart = nv.models.discreteBarChart()
			.x(function(d) { return d.label })    //Specify the data accessors.
			.y(function(d) { return d.value })
			.staggerLabels(true)    //Too many bars and not enough room? Try staggering labels.
			.tooltips(false)        //Don't show tooltips
			.showValues(true)       //...instead, show the bar value right on top of each bar.
			.transitionDuration(350)
			.color(['#aec7e8', '#7b94b5', '#486192'])
			;

			d3.select('svg#column-chart')
			    .datum(data)
			    .call(chart);

			nv.utils.windowResize(chart.update);

			return chart;
		});
	};

}
OipaColumnChart.prototype = new OipaVis();






