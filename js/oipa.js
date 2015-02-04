
function OipaUrl(selection){
	this.selection = selection;

	this.get_selection_from_url = function(){
		var query = window.location.search.substring(1);
			if(query !== ''){
				var vars = query.split("&");
				for (var i=0;i<vars.length;i++) {
					var pair = vars[i].split("=");
				var vals = pair[1].split(",");
				this.selection[pair[0]] = [];

				for(var y=0;y<vals.length;y++){
					this.selection[pair[0]].push({"id":vals[y], "name":vals[y]});
				}
			}
		}
	};

	this.set_current_url = function(){
		var link = document.URL.toString().split("?")[0] + this.build_parameters();
		if (history.pushState) {
			history.pushState(null, null, link);
		}
	};

	this.build_parameters = function (){

		this.cities = [];
		this.countries = [];
		this.regions = [];
		this.sectors = [];
		this.budgets = [];
		this.indicators = [];
		this.reporting_organisations = [];
		this.start_actual_years = [];
		this.start_planned_years = [];
		this.donors = [];
		this.query = "";
		this.country = ""; // for country search
		this.region = ""; // for region search
		this.group_by = "";
		this.url = null;
		var url = '?p=';

		if (Oipa.pageType != "compare"){
		// build current url based on selection made
		
			if (typeof this.selection.cities !== "undefined") { url += this.build_current_url_add_par("cities", this.selection.cities); }
			if (typeof this.selection.countries !== "undefined") { url += this.build_current_url_add_par("countries", this.selection.countries); }
			if (typeof this.selection.regions !== "undefined") { url += this.build_current_url_add_par("regions", this.selection.regions); }
			if (typeof this.selection.sectors !== "undefined") { url += this.build_current_url_add_par("sectors", this.selection.sectors); }
			if (typeof this.selection.budgets !== "undefined") { url += this.build_current_url_add_par("budgets", this.selection.budgets); }
			if (typeof this.selection.indicators !== "undefined") { url += this.build_current_url_add_par("indicators", this.selection.indicators); }
			if (typeof this.selection.reporting_organisations !== "undefined") { url += this.build_current_url_add_par("reporting_organisations", this.selection.reporting_organisations); }
			if (typeof this.selection.donors !== "undefined") { url += this.build_current_url_add_par("donors", this.selection.donors); }
			if (typeof this.selection.query !== "undefined") { url += this.build_current_url_add_par("query", this.selection.query); }
		} else {

			if (typeof this.selection.left.cities !== "undefined") { url += this.build_current_url_add_par("left_cities", this.selection.left.cities); }
			if (typeof this.selection.left.countries !== "undefined") { url += this.build_current_url_add_par("left_countries", this.selection.left.countries); }
			if (typeof this.selection.right.cities !== "undefined") { url += this.build_current_url_add_par("right_cities", this.selection.right.cities); }
			if (typeof this.selection.right.countries !== "undefined") { url += this.build_current_url_add_par("right_countries", this.selection.right.countries); }
			if (typeof this.selection.indicators !== "undefined") { url += this.build_current_url_add_par("indicators", this.selection.indicators); }
		}

		if (url === '?p='){return '';}
		url = url.replace("?p=&", "?");

		return url;
	};

	this.build_current_url_add_par = function(name, arr, dlmtr){

		if(dlmtr === undefined){
			dlmtr = ",";
		}

		if(arr.length === 0){return '';}
		var par = '&' + name + '=';
		for(var i = 0; i < arr.length;i++){
			par += arr[i].id.toString() + dlmtr;
		}
		par = par.substr(0, par.length - 1);

		return par;
	};
}


function OipaSelection(main, has_default_reporter){
	this.services = [];
	this.project_types = [];
	this.themes = [];
	this.sustainability_types = [];

	this.cities = [];
	this.countries = [];
	this.regions = [];
	this.sectors = [];
	this.budgets = [];
	this.indicators = [];
	this.reporting_organisations = [];
	this.start_actual_years = [];
	this.start_planned_years = [];
	this.donors = [];
	this.query = "";
	this.country = ""; // for country search
	this.region = ""; // for region search
	this.group_by = "";
	this.url = new OipaUrl(this);

	if (has_default_reporter === 1){
		if (Oipa.default_organisation_id){
			this.reporting_organisations.push({"id": Oipa.default_organisation_id, "name": Oipa.default_organisation_name});
		}
	}
	
}

var Oipa = {
	framework: "drupal", // currently supported: wordpress / drupal
	default_organisation_id: null,
	default_organisation_name: null,
	pageType: null,
	mainSelection: new OipaSelection(1),
	maps : [],
	refresh_maps : function(){
		for (var i = 0; i < this.maps.length; i++){
			this.maps[i].refresh();
		}
	},
	visualisations : [],
	refresh_visualisations : function(){

		// remove old visualisation blocks
		this.visualisations = [];
		jQuery("#visualisation-block-wrapper").empty();

		// add new visualisation blocks
		Oipa.create_visualisations();

	},
	create_visualisations : function(){
		var thisoipa = this;
		data = this.mainSelection.indicators;

		if (this.pageType == "indicators"){
			// for each indicator
			jQuery.each(data, function(key, value){

				// create line chart
				var linechart = new OipaLineChart();
				linechart.selection = new OipaIndicatorSelection();
				linechart.selection.cities = thisoipa.mainSelection.cities;
				linechart.selection.countries = thisoipa.mainSelection.countries;
				linechart.selection.regions = thisoipa.mainSelection.regions;
				linechart.selection.indicators.push({"id": value.id, "name": value.name, "type": value.type});

				linechart.indicator = value.id;
			 	linechart.name = value.name;
				linechart.y_name = value.name;
				linechart.y_format = d3.format(',r');
				linechart.x_name = 'Time (Years)';
				linechart.x_format = d3.format('r');

				linechart.init();

				thisoipa.visualisations.push(linechart);
				
			});
		}

		if (this.pageType == "compare"){
			OipaCompare.create_visualisations();
		}

	},
	lists: [],
	refresh_lists : function(){
		for (var i = 0; i < this.lists.length; i++){
			this.lists[i].refresh();
		}
	}
};

function OipaIndicatorSelection(main){
	this.cities = [];
	this.countries = [];
	this.regions = [];
	this.indicators = [];
	this.url = null;

	if (main){
		this.url = new OipaUrl(this);
	}
}



function OipaList(){

	this.offset = 0;
	this.limit = 10;
	this.amount = 0;
	this.order_by = null;
	this.order_asc_desc = null;
	this.selection = null;

	this.list_div = "#oipa-list";
	this.pagination_div = "#oipa-list-pagination";
	this.activity_count_div = "#project-list-amount";

	this.init = function(){

		var thislist = this;
		// init pagination
		jQuery(this.pagination_div).bootpag({
		   total: 5,
		   page: 1,
		   maxVisible: 6
		}).on('page', function(event, num){
			thislist.go_to_page(num);
		});


		this.update_pagination();
		this.load_listeners();
		this.extra_init();
	}

	this.extra_init = function(){
		// override
	}

	this.refresh = function(data){
		
		if (!data){
			// get URL
			var url = this.get_url();
			// get data
			this.get_data(url);

		} else {
			// set amount of results
			this.update_list(data);
			this.update_pagination(data);
			this.load_listeners();
			
		}
	}

	this.reset_pars = function(){
		this.selection.query = null;
		this.offset = 0;
		this.limit = 10;
		this.amount = 0;
		this.order_by = null;
		this.order_asc_desc = null;
		this.refresh();
	}

	this.get_url = function(){
		// overriden in children, unused if called correctly
		return search_url + 'activity-list/?format=json&limit=10';
	};

	this.get_data = function(url){

		jQuery.support.cors = true;

		var curlist = this;
		jQuery.ajax({
			type: 'GET',
			url: url,
			dataType: 'html',
			success: function(data){
				curlist.refresh(data);
			}
		});

	};

	this.update_list = function(data){
		// generate list html and add to this.list_div
		jQuery(this.list_div).html(data);
	};

	this.load_listeners = function(){
		// override
	}

	this.update_pagination = function(data){
		var total = jQuery(this.list_div + " .list-amount-input").val();
		this.amount = total;
		$(".current-selection-amount").html(total);

		var total_pages = Math.ceil(this.amount / this.limit);
		var current_page = Math.ceil(this.offset / this.limit) + 1;
		jQuery(this.pagination_div).bootpag({total: total_pages});
	};

	this.go_to_page = function(page_id){
		this.offset = (page_id * this.limit) - this.limit;
		this.refresh();
	};

	this.export = function(format){

		var url = this.get_url();
		url = url.replace("format=json", "format=" + format);
		url_splitted = url.split("?");
		url = site_url + ajax_path + "/" + this.api_resource + "/?" + url_splitted[1];
		
		jQuery("#ExportListHiddenWrapper").remove();

		iframe = document.createElement('a');
        iframe.id = "ExportListHiddenWrapper";
        iframe.style.display = 'none';
        document.body.appendChild(iframe);

        var export_func_url = base_url + "/" + theme_path + "/export.php?path=" + encodeURIComponent(url);

        jQuery("#ExportListHiddenWrapper").attr("href", export_func_url);
        jQuery("#ExportListHiddenWrapper").attr("target", "_blank");
        jQuery("#ExportListHiddenWrapper").bind('click', function() {
			window.location.href = this.href;
			return false;
		});
        jQuery("#ExportListHiddenWrapper").click();
		jQuery("#download-dialog").toggle();
	}
}

function OipaMainStats(){
	this.reporting_organisation = null;

	this.get_total_projects = function(reporting_organisation, data){

		

		if(data){
			jQuery("#homepage-total-projects").text(data[reporting_organisation]);
		} else {

			var url = search_url + 'activity-aggregate-any/?format=json&group_by=reporting-org';
			var stats = this;
			jQuery.support.cors = true;

			if(window.XDomainRequest){
			var xdr = new XDomainRequest();
			xdr.open("get", url);
			xdr.onprogress = function () { };
			xdr.ontimeout = function () { };
			xdr.onerror = function () { };
			xdr.onload = function() {
				var jsondata = jQuery.parseJSON(xdr.responseText);
				if (jsondata === null || typeof (jsondata) === 'undefined')
				{
					jsondata = jQuery.parseJSON(jsondata.firstChild.textContent);
				}
				stats.get_total_projects(reporting_organisation, jsondata); 
			};
			setTimeout(function () {xdr.send();}, 0);
			} else {
				jQuery.ajax({
					type: 'GET',
					url: url,
					contentType: "application/json",
					dataType: 'json',
					success: function(data){
						stats.get_total_projects(reporting_organisation, data);
					}
				});
			}
		}
	};

	this.get_total_budget = function(reporting_organisation, data){

		if(data){
			jQuery("#homepage-total-budget").text("US$" + comma_formatted(data[reporting_organisation]));
		} else {

			var url = search_url + 'activity-aggregate-any/?format=json&group_by=reporting-org&aggregation_key=total-budget';
			var stats = this;
			jQuery.support.cors = true;

			if(window.XDomainRequest){
			var xdr = new XDomainRequest();
			xdr.open("get", url);
			xdr.onprogress = function () { };
			xdr.ontimeout = function () { };
			xdr.onerror = function () { };
			xdr.onload = function() {
				var jsondata = jQuery.parseJSON(xdr.responseText);
				if (jsondata === null || typeof (jsondata) === 'undefined')
				{
					jsondata = jQuery.parseJSON(jsondata.firstChild.textContent);
				}
				stats.get_total_budget(reporting_organisation, jsondata); 
			};
			setTimeout(function () {xdr.send();}, 0);
			} else {
				jQuery.ajax({
					type: 'GET',
					url: url,
					contentType: "application/json",
					dataType: 'json',
					success: function(data){
						stats.get_total_budget(reporting_organisation, data);
					}
				});
			}
		}
	};
}

function OipaProject(){
	this.id = "";

	this.get_url = function(){

		var url =  search_url + "activities/"+ this.id +"/?format=json";
		return url;
	}

	this.export = function(format){

		var url = this.get_url();
		url = url.replace("format=json", "format=" + format);
		jQuery("#ExportListHiddenWrapper").remove();

		iframe = document.createElement('a');
        iframe.id = "ExportListHiddenWrapper";
        iframe.style.display = 'none';
        document.body.appendChild(iframe);

        var export_func_url = template_directory + "/export.php?path=" + encodeURIComponent(url);

        jQuery("#ExportListHiddenWrapper").attr("href", export_func_url);
        jQuery("#ExportListHiddenWrapper").attr("target", "_blank");
        jQuery("#ExportListHiddenWrapper").bind('click', function() {
			window.location.href = this.href;
			return false;
		});
        jQuery("#ExportListHiddenWrapper").click();
		jQuery("#download-dialog").toggle();
	}

}

function OipaProjectList(){
	this.only_regional = false;
	this.only_country = false;
	this.order_by_asc_desc = "desc";
	this.order_by = "end_planned";

	this.get_url = function(){
		var parameters = get_activity_based_parameters_from_selection(this.selection);

		
		if(Oipa.pageType == "activities"){
			project_path = "/projects";
		} else {
			project_path = "/projects-on-detail";
		}

		var extra_par = "";
		var desc = "";
		if (this.only_country == true){ extra_par = "&countries__code__gte=0"; }
		else if (this.only_regional == true){ extra_par = "&regions__code__gte=0"; }
		else if(this.only_global == true){ extra_par = "&activity_scope=1"; }
		else if(this.only_other == true){ extra_par = "&regions=None&countries=None&activity_scope=None"; }
		if(this.order_by_asc_desc == "desc"){ desc = "-"; }
		if(this.order_by){ extra_par += "&order_by=" + desc + this.order_by; }
		if (Oipa.framework == "drupal"){
			var url = site_url + ajax_path + project_path + "/?format=json&limit=" + this.limit + "&offset=" + this.offset + parameters + extra_par;
		} else if (Oipa.framework == "wordpress"){
			project_path = project_path.substr(1);
			var url = ajax_path + "?format=json&action=" + project_path + "&limit=" + this.limit + "&offset=" + this.offset + parameters + extra_par;	
		}
		url = replaceAll(url, " ", "%20");
		return url;
	};

	
}
OipaProjectList.prototype = new OipaList();

function OipaCountryList(){
	this.get_url = function(){
		var parameters = get_activity_based_parameters_from_selection(this.selection);
		var extra_par = "";
		if(this.order_by){ extra_par += "&order_by=" + this.order_by; }
		if(this.order_asc_desc){ extra_par += "&order_asc_desc=" + this.order_asc_desc; }
		return site_url + ajax_path + "/countries/?format=json&limit=" + this.limit + "&offset=" + this.offset + parameters + extra_par;
	};
}
OipaCountryList.prototype = new OipaList();

function OipaRegionList(){
	this.get_url = function(){
		var parameters = get_activity_based_parameters_from_selection(this.selection);
		var extra_par = "";
		if(this.order_by){ extra_par += "&order_by=" + this.order_by; }
		if(this.order_asc_desc){ extra_par += "&order_asc_desc=" + this.order_asc_desc; }
		return site_url + ajax_path + "/regions/?format=json&limit=" + this.limit + "&offset=" + this.offset + parameters + extra_par;
	};
}
OipaRegionList.prototype = new OipaList();

function OipaSectorList(){
	this.get_url = function(){
		var parameters = get_activity_based_parameters_from_selection(this.selection);
		var extra_par = "";
		if(this.order_by){ extra_par += "&order_by=" + this.order_by; }
		if(this.order_asc_desc){ extra_par += "&order_asc_desc=" + this.order_asc_desc; }
		return site_url + ajax_path + "/sectors/?format=json&limit=" + this.limit + "&offset=" + this.offset + parameters + extra_par;
	};
}
OipaSectorList.prototype = new OipaList();

function OipaDonorList(){
	this.get_url = function(){
		var parameters = get_activity_based_parameters_from_selection(this.selection);
		var extra_par = "";
		if(this.order_by){ extra_par += "&order_by=" + this.order_by; }
		if(this.order_asc_desc){ extra_par += "&order_asc_desc=" + this.order_asc_desc; }
		if(this.query) {extra_par += "&query=" + this.query; }
		return site_url + ajax_path + "/donors/?format=json&limit=" + this.limit + "&offset=" + this.offset + parameters + extra_par;
	};
}
OipaDonorList.prototype = new OipaList();


function OipaMap(){

	this.map = null;
	this.selection = null;
	this.slider = null;
	this.basemap = "zimmerman2014.hmpkg505";
	this.tl = null;
	this.compare_left_right = null;
	this.circles = {};
	this.markers = [];
	this.vistype = "circles";
	this.selected_year = null;
	this.detail = false;

	if (typeof standard_basemap !== 'undefined') {
		this.basemap = standard_basemap;
	}

	this.set_map = function(div_id, zoomposition){

		var mapoptions = {
			attributionControl: false,
			scrollWheelZoom: false,
			zoom: 3,
			minZoom: 2,
			maxZoom:12,
			continuousWorld: 'false'
		}

		if(zoomposition){
			mapoptions.zoomControl = false;
		}

		jQuery("#"+div_id).css("min-height", "200px");
		this.map = L.map(div_id, mapoptions).setView([20.505, 34.09], 3);

		if (zoomposition){
			new L.Control.Zoom({ position: zoomposition }).addTo(this.map);
		}

		this.tl = L.tileLayer('https://{s}.tiles.mapbox.com/v3/'+this.basemap+'/{z}/{x}/{y}.png', {
			maxZoom: 12
		}).addTo(this.map);
	};

	this.refresh = function(data){
		
		if (!data){
			if (this.selection.group_by == "exact_location"){
				this.show_data_on_map(data);
			} else {
				
				// get url
				var url = this.get_url();

				// get data
				this.get_data(url);

			}
		} else {
			// show data
			this.show_data_on_map(data);

		}

	};

	this.get_markers_bounds = function(){

		var minlat = 0;
		var maxlat = 0;
		var minlng = 0;
		var maxlng = 0;
		var first = true;
		jQuery.each(this.markers, function( index, value ) {

		  curlat = value._latlng.lat;
		  curlng = value._latlng.lng;

		  if (first){
				minlat = curlat;
				maxlat = curlat;
				minlng = curlng;
				maxlng = curlng;
			}

			if (curlat < minlat){
				minlat = curlat;
			}
			if (curlat > maxlat){
				maxlat = curlat;
			}
			if (curlng < minlng){
				minlng = curlng;
			}
			if (curlng > maxlng){
				maxlng = curlng;
			}

			first = false;
		});

		return [[minlat, minlng],[maxlat, maxlng]];
	}


	this.get_url = function(){

		var parameters = get_activity_based_parameters_from_selection(this.selection);
		var api_call = "activities";

		if (this.selection.group_by == "activity"){
			api_call = "activities";
		} else if(this.selection.group_by == "country"){
			api_call = "country-activities";
		} else if(this.selection.group_by == "region"){
			api_call = "region-activities";
		} else if(this.selection.group_by == "global"){
			api_call = "global-activities";
		} else if (this.selection.group_by == "exact_location"){
			api_call = "activities";
		}

		return search_url + api_call + '/?format=json' + parameters;
	};

	this.get_data = function(url){

		if (url === null){
			this.refresh(1);
		}

		perform_cors_ajax_call_with_refresh_callback(url, this);
	};
	
	
	this.delete_markers = function(){
		for (var i = 0; i < this.markers.length; i++) {
			this.map.removeLayer(this.markers[i]);
		}
	};

	this.show_data_on_map = function(data){

		this.delete_markers();

		if (this.selection.group_by == "activity"){

		 } else if(this.selection.group_by == "country" || this.selection.group_by == null || this.selection.group_by == ""){
			
			// For 0 -> 9, create markers in a circle
			for (var i = 0; i < data.objects.length; i++) {
				if (data.objects[i].id === null){ continue; }
				// Use a little math to position markers.
				// Replace this with your own code.
				if (data.objects[i].latitude !== null || data.objects[i].longitude !== null){
					curmarker = L.marker([
						data.objects[i].latitude,
						data.objects[i].longitude
					], {
						icon: L.divIcon({
							// Specify a class name we can refer to in CSS.
							className: 'country-marker-icon',
							// Define what HTML goes in each marker.
							html: data.objects[i].total_projects,
							// Set a markers width and height.
							iconSize: [41, 52],
							iconAnchor: [18, 44],
						})
					}).bindPopup('<div class="country-marker-popup-header"><a href="/country/'+data.objects[i].id+'/">'+data.objects[i].name+'</a></div><table><tr><td>PROJECTS:</td><td>' + data.objects[i].total_projects + '</td></tr><tr><td>BUDGET:</td><td>US$' + comma_formatted(data.objects[i].total_budget) + '</td></tr></table><a class="country-marker-popup-zoom" href="/country/'+data.objects[i].id+'/">SHOW PROJECTS IN LIST</a>', { minWidth: 300, maxWidth: 300, offset: L.point(173, 53), closeButton: false, className: "country-popup"})
					.addTo(this.map);

					this.markers.push(curmarker);
				}
			}


		} else if(this.selection.group_by == "region"){

			this.map.setView([10.505, 25.09], 2);
			
			for (var i = 0; i < data.objects.length; i++) {
			  	curmarker = L.marker([
					data.objects[i].latitude,
					data.objects[i].longitude
				], {
					icon: L.divIcon({
					  // Specify a class name we can refer to in CSS.
					  className: 'global-marker-icon',
					  // Define what HTML goes in each marker.
					  html: '<div class="region-map-item-wrapper"><div class="region-map-activity-count">'+data.objects[i].total_projects+'</div><div class="region-map-name">'+data.objects[i].name+'</div></div>',
					  // Set a markers width and height.
					  iconSize: [150, 44],
					  iconAnchor: [18, 34],
				  })
				}).bindPopup('<table><tr><td>YEAR:</td><td>ALL</td></tr><tr><td>PROJECTS:</td><td><a href="'+site_url+'/region/?region_id='+data.objects[i].id+'">'+data.objects[i].total_projects+'</a></td></tr><tr><td>BUDGET:</td><td>US$'+comma_formatted(data.objects[i].total_budget)+'</td></tr></table>', { minWidth: 300, maxWidth: 300, offset: L.point(215, 134), closeButton: false, className: "region-popup"})
				.addTo(this.map);

				this.markers.push(curmarker);
			}
		} else if(this.selection.group_by == "global"){
			this.map.setView([10.505, 25.09], 2);
			curmarker = L.marker([
				25, -90
			], {
				icon: L.divIcon({
					// Specify a class name we can refer to in CSS.
					className: 'region-marker-icon',
					// Define what HTML goes in each marker.
					html: '<div class="global-map-item-wrapper"><div class="global-map-activity-count">'+data.objects[0].total_projects+'</div><div class="global-map-name">Global projects</div></div>',
					// Set a markers width and height.
					iconSize: [150, 44],
					iconAnchor: [18, 34],
				})
			})
			.addTo(this.map);

			this.markers.push(curmarker);
		
		} else if(this.selection.group_by == "other"){
			this.map.setView([10.505, 25.09], 2);
			curmarker = L.marker([
				60, -41.31
			], {
				icon: L.divIcon({
					// Specify a class name we can refer to in CSS.
					className: 'other-projects-marker-icon',
					// Define what HTML goes in each marker.
					html: '<div class="other-projects-map-inner">OTHER PROJECTS<br>US$ </div>',
					// Set a markers width and height.
					iconSize: [150, 44],
					iconAnchor: [18, 34],
				})
			})
			.addTo(this.map);

			this.markers.push(curmarker);
		} else if(this.selection.group_by == "exact_location"){
			
			// For 0 -> 9, create markers in a circle
			var exact_locations = this.selection.exact_locations;
			var leaflet_polygon = null;
			if (this.country_id){
				// get country polygon
				var url = search_url + "/country-geojson/?reporting_organisation__in=NL-KVK-34200988&countries__in=" + this.country_id;
				var polygon = null;
				jQuery.ajax({
					type: 'GET',
					async: false,
					url: url,
					contentType: "application/json",
					dataType: 'json',
					success: function(data){
						polygon = data.features[0].geometry.coordinates;
						// var test = L.geoJson(polygon);
						
						for (var y = 0;y < polygon.length;y++){
							for(var i = 0;i < polygon[y].length;i++){
								polygon[y][i] = [polygon[y][i][1], polygon[y][i][0]];
							}
						}
					}
				});

				leaflet_polygon = L.polygon(polygon);

			}

			for (var i = 0; i < exact_locations.length; i++) {

				var latlng = L.latLng([
					exact_locations[i].latitude,
					exact_locations[i].longitude
				]);

				if(leaflet_polygon && !(leaflet_polygon.getBounds().contains(latlng))){
					continue;
				}

				curmarker = L.marker(latlng, {
					icon: L.divIcon({
						// Specify a class name we can refer to in CSS.
						className: 'country-marker-icon',
						// Define what HTML goes in each marker.
						html: "",
						// Set a markers width and height.
						iconSize: [41, 52],
						iconAnchor: [18, 44],
					})
				});

				if(exact_locations[i].name){
					curmarker.bindPopup('<div class="country-marker-popup-header">'+exact_locations[i].name+'<br><span class="exact_location_go_to"><a href="'+site_url+'/project/'+exact_locations[i].id+'/">Read more</a></span></div>', { offset: L.point(0, -30), closeButton: false, className: "exact-location-popup"});
				}

				curmarker.addTo(this.map);
				this.markers.push(curmarker);
			}

			var bounds = this.get_markers_bounds();
			this.map.fitBounds(bounds);

		}

		if(this.detail == true){
			var bounds = this.get_markers_bounds();
			this.map.setView(bounds[0], 5);
		}
		
		this.load_map_listeners();
	};

	this.load_map_listeners = function(){
		// no default listeners, this function should be overriden.
	};

	this.update_indicator_timeline = function(){
		
		jQuery('.slider-year').removeClass('slider-active');
		
		for (var i=1950;i<2051;i++){
			var curyear = "y" + i;
			// TO DO
			jQuery.each(indicator_data, function(key, value){
				if (value.years){
					if (curyear in value.years){
						jQuery("#year-" + i).addClass("slider-active");
						return false;
					}
				}   
			});
		}
	};

	this.change_basemap = function(basemap_id){
		this.tl._url = "https://{s}.tiles.mapbox.com/v3/"+basemap_id+"/{z}/{x}/{y}.png";
		this.tl.redraw();
	};

	this.set_city = function(city_id) {
		var city = new OipaCity();
		city.id = city_id;
		var thismap = this;
		url = search_url + "cities/?format=json&id=" + city_id;

		jQuery.support.cors = true;
	
		jQuery.ajax({
			type: 'GET',
			url: url,
			contentType: "application/json",
			dataType: 'json',
			success: function(data){
				city.set_compare_data(data, thismap.compare_left_right);
			}
		});
		
		return city;
	};

	this.zoom_on_dom = function(curelem){


		var country_id = curelem.getAttribute("name");

		if (this.detail == false){
			jQuery("#countries-filters input[type='checkbox']").prop('checked', false);
			jQuery("#countries-filters input[value='"+country_id+"']").prop('checked', true);
			filter.save();

			$(".btn-list-view").click();
		} else {
			window.location = site_url + '/projects/?view=list&countries=' + country_id;
		}
	};
}





function OipaCity(){
	this.id = null;
	this.name = null;
	this.latlng = null;

	this.set_compare_data = function(data, map_left_right){

		this.name = data.objects[0].name;
		this.latlng = geo_point_to_latlng(data.objects[0].location);

		if(map_left_right == "left"){
			OipaCompare.item1 = this;
			get_wiki_city_data(this.name, "left");
		} else if (map_left_right == "right"){
			OipaCompare.item2 = this;
			get_wiki_city_data(this.name, "right");
		}

		OipaCompare.refresh_state++;
		
		if (OipaCompare.refresh_state > 1){
			
			OipaCompare.refresh_state = 0;
			// refresh map
			OipaCompare.refresh_comparison();
		}
		
	}
}


function OipaFilters(){

	this.data = null;
	this.selection = null;
	this.firstLoad = true;
	this.perspective = null;
	this.filter_wrapper_div = "my-tab-content";

	this.init = function(){

		// check url parameters -> selection
		this.update_selection_object();

		// get url
		var url = this.get_url();

		// get data, this will trigger process filters etc.
		this.get_data(url);
	};

	this.save = function(dont_update_selection){
		
		if(!dont_update_selection){
			// update OipaSelection object
			this.update_selection_object();
			this.update_selection_selected();
			var validated = this.validate_selection();
			if (!validated){
				return false;
			}
		}
		
		// reload maps
		Oipa.refresh_maps();

		// reload lists
		Oipa.refresh_lists();

		// reload visualisations
		Oipa.refresh_visualisations();

		Oipa.mainSelection.url.set_current_url();
		return true;
	};

	this.update_selection_selected = function(){
		var thisfilter = this;
		var html = "";
		var has_selection = 0;
		for (var key in this.selection.countries){
			has_selection = 1;
			html += this.create_selected_button("countries", this.selection.countries[key]);
		}

		for (var key in this.selection.services){
			has_selection = 1;
			html += this.create_selected_button("services", this.selection.services[key]);
		}

		for (var key in this.selection.project_types){
			has_selection = 1;
			html += this.create_selected_button("project_types", this.selection.project_types[key]);
		}

		for (var key in this.selection.themes){
			has_selection = 1;
			html += this.create_selected_button("themes", this.selection.themes[key]);
		}

		for (var key in this.selection.sustainability_types){
			has_selection = 1;
			html += this.create_selected_button("sustainability_types", this.selection.sustainability_types[key]);
		}

		jQuery(".filter-selection-wrapper").html(html);
		jQuery(".btn-filter-selected").click(function(e){

			var object_id = jQuery(this).data("object-id");
			var filter_name = jQuery(this).data("filter-name");

			for (var i = 0; i < thisfilter.selection[filter_name].length;i++){

				if(thisfilter.selection[filter_name][i].id == object_id){
					// thisfilter.selection[filter_name].splice(i, 1);
					jQuery('input[name="' + thisfilter.selection[filter_name][i].name + '"]').attr('checked', false);
					thisfilter.save();
				}
			}
		});
		
		if(has_selection){
			$("#selection-wrapper").slideDown();
		} else {
			$("#selection-wrapper").slideUp();
		}
	}

	this.create_selected_button = function(filter_name, filter_object){ 
		return '<button type="button" class="btn btn-default btn-filter-selected" data-object-id="'+filter_object.id+'" data-filter-name="'+filter_name+'">'+filter_object.name+' <span>&nbsp;X</span></button>';
	}

	this.validate_selection = function (){
		// override
		return true;
	};

	this.update_selection_object = function(){

		// set selection as filter and load results
		this.selection.sectors = this.get_checked_by_filter("sectors");
		this.selection.countries = this.get_checked_by_filter("countries");
		this.selection.services = this.get_checked_by_filter("services");
		this.selection.project_types = this.get_checked_by_filter("project-types");
		this.selection.themes = this.get_checked_by_filter("themes");
		this.selection.sustainability_types = this.get_checked_by_filter("sustainability-types");
		this.selection.budgets = this.get_checked_by_filter("budgets");
		this.selection.regions = this.get_checked_by_filter("regions");
		this.selection.indicators = this.get_checked_by_filter("indicators");
		this.selection.cities = this.get_checked_by_filter("cities");
		this.selection.start_planned_years = this.get_checked_by_filter("start_planned_years");
		this.selection.donors = this.get_checked_by_filter("donors");
		
		if (!Oipa.default_organisation_id){
			this.selection.reporting_organisations = this.get_checked_by_filter("reporting_organisations");
		}
		
	};

	this.get_selection_object = function(){
		// set selection as filter and load results
		var current_selection = new OipaSelection();

		current_selection.sectors = this.get_checked_by_filter("sectors");
		current_selection.countries = this.get_checked_by_filter("countries");
		current_selection.budgets = this.get_checked_by_filter("budgets");
		current_selection.regions = this.get_checked_by_filter("regions");
		current_selection.indicators = this.get_checked_by_filter("indicators");
		current_selection.cities = this.get_checked_by_filter("cities");
		current_selection.start_planned_years = this.get_checked_by_filter("start_planned_years");
		current_selection.donors = this.get_checked_by_filter("donors");
		
		if (!Oipa.default_organisation_id){
			current_selection.reporting_organisations = this.get_checked_by_filter("reporting_organisations");
		}
		return current_selection;
	};

	this.get_checked_by_filter = function(filtername){

		var arr = [];
		// on indicators save selection type (city core, sub urban area etc.)
		if (filtername === "indicators"){
			jQuery('#' + filtername + '-filters input:checked').each(function(index, value){
				var selection_type = jQuery(this).attr("selection_type");

				if (selection_type === undefined){
					selection_type = null;
				}
				
				arr.push({"id":value.value, "name":value.name, 'type':selection_type});
			});
			return arr;
		}

		// else
		jQuery('#' + filtername + '-filters input:checked').each(function(index, value){
			arr.push({"id":value.value, "name":value.name});
		});
		return arr;
	};

	this.get_url = function(selection, parameters_set){
		// override
	};

	this.get_data = function(url){
		// filters
		var filters = this;
		
		jQuery.support.cors = true;

		if(window.XDomainRequest){
		var xdr = new XDomainRequest();
		xdr.open("get", url);
		xdr.onprogress = function () { };
		xdr.ontimeout = function () { };
		xdr.onerror = function () { };
		xdr.onload = function() {
			var jsondata = jQuery.parseJSON(xdr.responseText);
			if (jsondata === null || typeof (jsondata) === 'undefined')
			{
				jsondata = jQuery.parseJSON(jsondata.firstChild.textContent);
			}
			filters.process_filter_options(jsondata);
			filters.data = jsondata;
		};
		setTimeout(function () {xdr.send();}, 0);
		} else {
			jQuery.ajax({
				type: 'GET',
				url: url,
				contentType: "application/json",
				dataType: 'json',
				success: function(data){
					filters.process_filter_options(data);
					filters.data = data;
				}
			});
		}
	};

	this.process_filter_options = function(data){

		var columns = 4;
		var filter = this;

		// load filter html and implement it in the page
		var services = new Object();
		var project_types = new Object();
		var themes = new Object();
		var sustainability = new Object();


		for (var key in data.sectors){

			if (key > 199 && key < 210){
				services[key] = data.sectors[key];
			} else if (key > 209 && key < 220){
				project_types[key] = data.sectors[key];
			} else if (key > 219 && key < 230){
				themes[key] = data.sectors[key];
			} else if (key > 229 && key < 240){
				sustainability[key] = data.sectors[key];
			}
		}

		filter.create_filter_attributes(data.countries, columns, "countries");
		filter.create_filter_attributes(services, columns, "services");
		filter.create_filter_attributes(project_types, columns, "project-types");
		filter.create_filter_attributes(themes, columns, "themes");
		filter.create_filter_attributes(sustainability, columns, "sustainability-types");

		var budgetfilters = this.get_budget_filter_options();

		// reload checked boxes
		this.initialize_filters();

		if (typeof(preloadcountries) !== 'undefined' && preloadcountries != null){
			
			var checked_countries = preloadcountries.split(",");
			for(var i = 0; i < checked_countries.length;i++){
				jQuery(':checkbox[value=' + checked_countries[i] + ']').prop('checked', true);

			}

			this.save();
		}
	};

	this.get_budget_filter_options = function(){

		var budgetfilters = [];
		budgetfilters.push(["0-20000", { "name": "&lt;US$20K" }]);
		budgetfilters.push(["20000-100000", { "name": "US$20K-US$100K" }]);
		budgetfilters.push(["100000-1000000", { "name": "US$100K-US$1M" }]);
		budgetfilters.push(["1000000-5000000", { "name": "US$1M-US$5M" }]);
		budgetfilters.push(["5000000", { "name": ">US$5M" }]);

		return budgetfilters;
	}

	this.initialize_filters = function(selection){

		if (!selection){
			var selection = this.selection;
		}

		jQuery('#map-filter-overlay input:checked').prop('checked', false);
		if (typeof selection.sectors !== "undefined") { this.init_filters_loop(selection.sectors) };
		if (typeof selection.countries !== "undefined") { this.init_filters_loop(selection.countries) };
		if (typeof selection.budgets !== "undefined") { this.init_filters_loop(selection.budgets) };
		if (typeof selection.regions !== "undefined") { this.init_filters_loop(selection.regions) };
		if (typeof selection.indicators !== "undefined") { this.init_filters_loop(selection.indicators) };
		if (typeof selection.cities !== "undefined") { this.init_filters_loop(selection.cities) };
		if (typeof selection.reporting_organisations !== "undefined") { this.init_filters_loop(selection.reporting_organisations) };
	
		//fill_selection_box();
	};

	this.init_filters_loop = function(arr){
		for(var i = 0; i < arr.length;i++){
			jQuery(':checkbox[value=' + arr[i].id + ']').prop('checked', true);
		}
	};

	
	this.create_filter_attributes = function(objects, columns, attribute_type, no_sort){

		var html = '';
		var per_col = 6;
		var sortable = [];
		
		if (no_sort){
			// if not sorted, the objects are already in the right order in an array
			sortable = objects;
		} else {

			for (var key in objects){
				sortable.push([key, objects[key]]);
			}

			sortable.sort(function(a, b){
				var nameA=a[1].name.toString().toLowerCase(), nameB=b[1].name.toString().toLowerCase();
				if (nameA < nameB) { //sort string ascending
					return -1;
				}
				if (nameA > nameB) {
					return 1;
				}
				return 0; //default return value (no sorting)
			});
		}

		var page_counter = 1;
		html += '<div class="row '+attribute_type+'-filter-page filter-page filter-page-1">';
	
		for (var i = 0;i < sortable.length;i++){

			if (i%per_col == 0){
				if (columns == 2){
					html += '<div class="col-md-6 col-sm-6 col-xs-12">';
				} else {
					html += '<div class="col-md-3 col-sm-3 col-xs-6">';
				}
			}

			var sortablename = sortable[i][1].name;
			if (columns == 4 && sortablename.length > 32){
				sortablename = sortablename.substr(0,28) + "...";
			} else if (columns == 3 && sortablename.length > 40){
				sortablename = sortablename.substr(0,36) + "...";
			}
			
			html += '<div class="checkbox"><label>';
	        html += '<input type="checkbox" value="'+ sortable[i][0] +'" id="'+sortable[i][1].name.toString().replace(/ /g,'').replace(',', '').replace('&', '').replace('%', 'perc')+'" name="'+sortable[i][1].name+'" />'+sortablename;
	        html += '</label></div>';

			if (i%per_col == (per_col - 1)){
				html += '</div>';
			}
			if ((i + 1) > ((page_counter * (per_col * columns))) - 1) { 
		
				html += '</div>';
				page_counter = page_counter + 1;
				html += '<div class="row '+attribute_type+'-filter-page filter-page filter-page-' + page_counter + '">';
			}
		}

		/// if paginated, close the pagination.
		if (page_counter > 1){
			html += '</div>';
		}

		// get pagination attributes and add both pagination + filter options to div
		this.paginate(1, page_counter, "#"+attribute_type+"-pagination", attribute_type);
		jQuery("#"+attribute_type+"-filters").html(html);
		jQuery("."+attribute_type+"-filter-page.filter-page-1").show();
		this.update_selection_after_filter_load();
	};



	this.update_selection_after_filter_load = function(){
		// TO DO
		// we know the selection
		// we know the filters
		// set checked if selection option still exists
		// remove from filters if not
	};

	this.paginate = function(cur_page, total_pages){

		// range of num links to show
		var range = 2;
		var paging_block = "";

		if (cur_page == 1){ paging_block += '<a href="#" class="pagination-btn-previous btn-prev"></a>'; } 
		else { paging_block += '<a href="#" class="pagination-btn-previous btn-prev">&lt; previous</a>'; }
		paging_block += "<ul>";

		if (cur_page > (1 + range)){ paging_block += "<li><a href='#'>1</a></li>"; }
		if (cur_page > (2 + range)){ paging_block += "<li>...</li>"; }

		// loop to show links to range of pages around current page
		for (var x = (cur_page - range); x < ((cur_page + range) + 1); x++) { 
		   // if it's a valid page number...
		   if ((x > 0) && (x <= total_pages)) {
			  if (x == cur_page) { paging_block += "<li class='active'><a>"+x+"</a></li>"; } 
			  else { paging_block += "<li><a href='#'>"+x+"</a></li>"; } // end else
		   } // end if 
		} // end for

		if(cur_page < (total_pages - (1 + range))){ paging_block += "<li>...</li>"; }
		if(cur_page < (total_pages - range)){ paging_block += "<li><a href='#' class='page'><span>"+total_pages+"</span></a></li>"; }	   
		paging_block += "</ul>";

		// if not on last page, show forward and last page links		
		if (cur_page != total_pages) { paging_block += '<a href="#" class="pagination-btn-next btn-next">next &gt;</a>'; } 
		else { paging_block += '<a href="#" class="pagination-btn-next btn-next"></a>'; } // end if
		/****** end build pagination links ******/
		
		return paging_block;
	};

	this.load_paginate_listeners = function(attribute_type, total_pages){

		// load pagination filters
		jQuery("#"+attribute_type+"-pagination ul a").click(function(e){
			e.preventDefault();
			var page_number = jQuery(this).text();
			jQuery("#"+attribute_type+"-pagination").html(filter.paginate(page_number, total_pages));
			filter.load_paginate_page(attribute_type, page_number);
			filter.load_paginate_listeners(attribute_type, total_pages);
		});

		jQuery("#"+attribute_type+"-pagination .pagination-btn-next").click(function(e){
			e.preventDefault();
			var page_number = jQuery("#"+attribute_type+"-pagination .active a").text();
			page_number = parseInt(page_number) + 1;
			jQuery("#"+attribute_type+"-pagination").html(filter.paginate(page_number, total_pages));
			filter.load_paginate_page(attribute_type, page_number);
			filter.load_paginate_listeners(attribute_type, total_pages);
		});

		jQuery("#"+attribute_type+"-pagination .pagination-btn-previous").click(function(e){
			e.preventDefault();
			var page_number = jQuery("#"+attribute_type+"-pagination .active a").text();
			page_number = parseInt(page_number) - 1;
			jQuery("#"+attribute_type+"-pagination").html(filter.paginate(page_number, total_pages));
			filter.load_paginate_page(attribute_type, page_number);
			filter.load_paginate_listeners(attribute_type, total_pages);
		});
		
	};

	this.load_paginate_page = function(attribute_type, page_number){
		// hide all pages
		jQuery("#"+attribute_type+"-filters .filter-page").hide();
		jQuery("#"+attribute_type+"-filters .filter-page-"+page_number).show();
	};

	this.reload_specific_filter = function(filter_name, data){

		if (!data){
			filters = this;

			// get selection
			selection = this.get_selection_object();

			// get data
			if (filter_name === "left-cities") { var url = this.get_url(null, "&indicators__in=" + get_parameters_from_selection(selection.indicators) + "&countries__in=" + get_parameters_from_selection(selection.left.countries) ); }
			if (filter_name === "right-cities") { var url = this.get_url(null, "&indicators__in=" + get_parameters_from_selection(selection.indicators) + "&countries__in=" + get_parameters_from_selection(selection.right.countries) ); }
			if (filter_name === "indicators") { var url = this.get_url(null, "&regions__in=" + get_parameters_from_selection(selection.regions) + "&countries__in=" + get_parameters_from_selection(selection.countries) + "&cities__in=" + get_parameters_from_selection(selection.cities) ); }
			if (filter_name === "regions") { var url = this.get_url(null, "&indicators__in=" + get_parameters_from_selection(selection.indicators) ); }
			if (filter_name === "countries") { var url = this.get_url(null, "&indicators__in=" + get_parameters_from_selection(selection.indicators) + "&regions__in=" + get_parameters_from_selection(selection.regions) ); }
			if (filter_name === "cities") { var url = this.get_url(null, "&indicators__in=" + get_parameters_from_selection(selection.indicators) + "&regions__in=" + get_parameters_from_selection(selection.regions) + "&countries__in=" + get_parameters_from_selection(selection.countries) ); }

			jQuery.support.cors = true;

			if(window.XDomainRequest){
				var xdr = new XDomainRequest();
				xdr.open("get", url);
				xdr.onprogress = function () { };
				xdr.ontimeout = function () { };
				xdr.onerror = function () { };
				xdr.onload = function() {
					var jsondata = jQuery.parseJSON(xdr.responseText);
					if (jsondata === null || typeof (jsondata) === 'undefined')
					{
						jsondata = jQuery.parseJSON(jsondata.firstChild.textContent);
					}
					filters.reload_specific_filter(filter_name, jsondata);
				};
				setTimeout(function () {xdr.send();}, 0);
			} else {
				jQuery.ajax({
					type: 'GET',
					url: url,
					contentType: "application/json",
					dataType: 'json',
					success: function(data){
						filters.reload_specific_filter(filter_name, data);
					}
				});
			}

		} else {
			// reload filters
			columns = 4;
			if (filter_name === "left-cities") { this.create_filter_attributes(data.cities, columns, 'left-cities'); }
			if (filter_name === "right-cities") { this.create_filter_attributes(data.cities, columns, 'right-cities'); }
			if (filter_name === "indicators" && Oipa.pageType == "compare") { 
				this.create_filter_attributes(data.countries, columns, 'left-countries');
				this.create_filter_attributes(data.countries, columns, 'right-countries');
				this.create_filter_attributes(data.cities, columns, 'left-cities');
				this.create_filter_attributes(data.cities, columns, 'left-cities');
			}
			if (filter_name === "regions") { this.create_filter_attributes(data.regions, 2, 'regions'); }
			if (filter_name === "countries") { this.create_filter_attributes(data.countries, columns, 'countries'); }
			if (filter_name === "cities") { this.create_filter_attributes(data.cities, columns, 'cities'); }
			if (filter_name === "indicators" && Oipa.pageType == "indicators") { this.create_filter_attributes(data.indicators, 2, 'indicators'); }

			this.initialize_filters(selection);
		}
	};


	this.reset_filters = function(){
		jQuery("#"+this.filter_wrapper_div+" input[type=checkbox]").attr('checked', false);
		filter.selection.search = "";
		filter.selection.query = "";
		filter.selection.country = "";
		filter.selection.region = "";
		filter.selection.services = "";
		filter.selection.project_types = "";
		filter.selection.themes = "";
		filter.selection.sustainability_types = "";
		
		filter.save();
	}

}

function OipaProjectFilters(){

	this.get_url = function(selection, parameters_set){
		// get url from filter selection object
		var parameters = get_activity_based_parameters_from_selection(this.selection);
		var extra_par = "";

		if (this.perspective !== null){
			extra_par = "&perspective=" + this.perspective;
		}
		var cururl = search_url + "activity-filter-options/?format=json" + extra_par + parameters;	

		return cururl;
	};

	// create filter options of one particular filter type, objects = the options, columns = amount of columns per filter page
	function create_project_filter_attributes(objects, columns){
		var html = '';
		var per_col = 20;


		var sortable = [];
		for (var key in objects){
			if (objects[key].name === null){
				objects[key].name = "Unknown";
			}
			sortable.push([key, objects[key]]);
		}
	
		sortable.sort(function(a, b){
			var nameA=a[1].name.toString().toLowerCase(), nameB=b[1].name.toString().toLowerCase();
			if (nameA < nameB) { //sort string ascending
				return -1; 
			}
			if (nameA > nameB) {
				return 1;
			}
			return 0; //default return value (no sorting)
		});

		var page_counter = 1;
		html += '<div class="filter-page filter-page-1">';
		
		for (var i = 0;i < sortable.length;i++){

			if (i%per_col == 0){
				html += '<div class="span' + (12 / columns) + '">';
			}
			var sortablename = sortable[i][1].name;
			if (columns === 4 && sortablename.length > 32){
				sortablename = sortablename.substr(0,28) + "...";
			} else if (columns === 3 && sortablename.length > 46){
				sortablename = sortablename.substr(0,42) + "...";
			}
			var sortableamount = sortable[i][1].total.toString();

			html += '<div class="squaredThree"><div>';
			html += '<input type="checkbox" value="'+ sortable[i][0] +'" id="'+sortable[i][0]+sortable[i][1].name.toString().replace(/ /g,'').replace(',', '').replace('&', '').replace('%', 'perc')+'" name="'+sortable[i][1].name+'" />';
			html += '<label class="map-filter-cb-value" for="'+sortable[i][0]+sortable[i][1].name.toString().replace(/ /g,'').replace(',', '').replace('&', '').replace('%', 'perc')+'"></label>';
			html += '</div><div class="squaredThree-fname"><span>'+sortablename+' (' + sortableamount + ')</span></div></div>';
			if (i%per_col === (per_col - 1)){
				html += '</div>';
			}
			if ((i + 1) > ((page_counter * (per_col * columns))) - 1) {
			
			
				html += '</div>';
				page_counter = page_counter + 1;
				html += '<div class="filter-page filter-page-' + page_counter + '">';
			}

		}

		html += '<div class="filter-total-pages" name="' + page_counter + '"></div>';

		/// if paginated, close the pagination.
		if (page_counter > 1){
			html += '</div>';
		}
		
		return html;
	}
}
OipaProjectFilters.prototype = new OipaFilters();



function OipaExport(vis, filetype){
	this.visualisation = vis;
	this.filetype = filetype;
	
	function render(){

	}

}

function OipaEmbed(vis){
	this.visualisation = vis;

}

var OipaSelectionBox = {
	fill_selection_box: function(){

		var html = '';
		var indicatorhtml = '';
		if ((typeof current_selection.sectors !== "undefined") && (current_selection.sectors.length > 0)) { html += fill_selection_box_single_filter("SECTORS", current_selection.sectors); }
		if ((typeof current_selection.countries !== "undefined") && (current_selection.countries.length > 0)) { html += fill_selection_box_single_filter("COUNTRIES", current_selection.countries); }
		if ((typeof current_selection.budgets !== "undefined") && (current_selection.budgets.length > 0)) { html += fill_selection_box_single_filter("BUDGETS", current_selection.budgets); }
		if ((typeof current_selection.regions !== "undefined") && (current_selection.regions.length > 0)) { html += fill_selection_box_single_filter("REGIONS", current_selection.regions); }
		if ((typeof current_selection.cities !== "undefined") && (current_selection.cities.length > 0)) { html += fill_selection_box_single_filter("CITIES", current_selection.cities); }
		if ((typeof current_selection.indicators !== "undefined") && (current_selection.indicators.length > 0)) { indicatorhtml = fill_selection_box_single_filter("INDICATORS", current_selection.indicators); }
		if ((typeof current_selection.reporting_organisations !== "undefined") && (current_selection.reporting_organisations.length > 0)) { indicatorhtml = fill_selection_box_single_filter("REPORTING_ORGANISATIONS", current_selection.reporting_organisations); }
		if ((typeof current_selection.query !== "undefined") && (current_selection.query.length > 0)) { html += fill_selection_box_single_filter("QUERY", current_selection.query); }
		jQuery("#selection-box").html(html);
		jQuery("#selection-box-indicators").html(indicatorhtml);
		this.init_remove_filters_from_selection_box();
	},
	fill_selection_box_single_filter: function(header, arr){

		var html = '<div class="select-box" id="selected-' + header.toLowerCase() + '">';
		html += '<div class="select-box-header">';
		if (header === "INDICATORS" && selected_type === "cpi"){ header = "DIMENSIONS"; }
		if (header === "QUERY"){header = "SEARCH"; }
		if (header === "REPORTING_ORGANISATIONS"){header = "REPORTING ORGANISATIONS"; }
		html += header;
		html += '</div>';

		for(var i = 0; i < arr.length; i++){
			html += '<div class="select-box-selected">';
			html += '<div id="selected-' + arr[i].id.toString().replace(/ /g,'').replace(',', '').replace('&', '').replace('%', 'perc') + '" class="selected-remove-button"></div>';

			if (arr[i].name.toString() == 'unknown'){
				arr[i].name = jQuery(':checkbox[value=' + arr[i].id + ']').attr("name");
			}

			html += '<div>' + arr[i].name + '</div>';
			if (header == "INDICATORS" || header == "DIMENSIONS"){
				html += '<div class="selected-indicator-color-filler"></div><div class="selected-indicator' + (i + 1).toString() + '-color"></div>';
			}
			html += '</div>';
		}

		html += '</div>';
		return html;
	},
	init_remove_filters_from_selection_box: function (){

		jQuery(".selected-remove-button").click(function(){
			var id = jQuery(this).attr('id');
			id = id.replace("selected-", "");
			var filtername = jQuery(this).parent().parent().attr('id');
			filtername = filtername.replace("selected-", "");
			var arr = current_selection[filtername];
			for (var i = 0; i < arr.length;i++){
				if(arr[i].id === id){
					// arr.splice(i, 1);
					jQuery('input[name="' + arr[i].name + '"]').attr('checked', false);
					break;
				}
			}
			this.save_selection();
		});
	}
};


function geo_point_to_latlng(point_string){
	point_string = point_string.replace("POINT (", "");
	point_string = point_string.substring(0, point_string.length - 1);
	lnglat = point_string.split(" ");
	latlng = [lnglat[1], lnglat[0]];
	return latlng;
}

function get_parameters_from_selection(arr){

	dlmtr = ",";
	var str = '';

	if(arr.length > 0){
		for(var i = 0; i < arr.length; i++){
			str += arr[i].id + dlmtr;
		}
		str = str.substring(0, str.length-1);
	}

	return str;
}


function make_parameter_string_from_budget_selection(arr){

	var gte = '';
	var lte = '';
	var str = '';

	if(arr.length > 0){
	  gte = '99999999999';
	  lte = '0';
	  for(var i = 0; i < arr.length; i++){
		curid = arr[i].id;
		lower_higher = curid.split('-');

		if(lower_higher[0] < gte){
		  gte = lower_higher[0];
		}

		if(lower_higher.length > 1){
		  if(lower_higher[1] > lte){
			lte = lower_higher[1];
		  }
		}
	  }
	}
  
	if (gte != '' && gte != '99999999999'){
		str += '&total_budget__gt=' + gte;
	}
	if (lte != '' && lte != '0'){
		str += '&total_budget__lt=' + lte;
	}

	return str;
}

function get_indicator_parameters_from_selection(arr){
	dlmtr = ",";
	var str = '';
	var selection_type_str = "&selection_type__in=";

	if(arr.length > 0){
		for(var i = 0; i < arr.length; i++){
			str += arr[i].id + dlmtr;
			if (arr[i].selection_type){
				selection_type_str += arr[i].selection_type + dlmtr;
			}
		}
		str = str.substring(0, str.length-1);
	}

	return str + selection_type_str;
}

function make_parameter_string_from_selection(arr, parameter_name){ 

	var parameters = get_parameters_from_selection(arr);
	if (parameters !== ''){
		return "&" + parameter_name + "=" + parameters;
	} else {
		return '';
	}
}

function make_parameter_string_from_query_selection(str, parameter_name){
	if (str != ""){
		var str = "&"+parameter_name+"=" + str;
	} else {
		var str = "";
	}
	return str;
}

function get_activity_based_parameters_from_selection(selection){
	var str_region = make_parameter_string_from_selection(selection.regions, "regions__in");
	var str_country = make_parameter_string_from_selection(selection.countries, "countries__in");
	var str_sector = make_parameter_string_from_selection(selection.sectors, "sectors__in");

	var services = get_parameters_from_selection(selection.services);
	var project_types = get_parameters_from_selection(selection.project_types);
	var themes = get_parameters_from_selection(selection.themes);
	var sustainability_types = get_parameters_from_selection(selection.sustainability_types);

	var str_sector = "&sectors__in=";

	if (services != ''){ str_sector += services; }
	if (project_types != ''){ if (str_sector != "&sectors__in="){ str_sector += ","; } str_sector += project_types; }
	if (themes != ''){ if (str_sector != "&sectors__in="){ str_sector += ","; } str_sector += themes; }
	if (sustainability_types != ''){ if (str_sector != "&sectors__in="){ str_sector += ","; } str_sector += sustainability_types; }
	if (str_sector == "&sectors__in="){ if (str_sector != "&sectors__in="){ str_sector += ","; } str_sector = ''; }



	var str_budget = make_parameter_string_from_budget_selection(selection.budgets);
	var str_start_year = make_parameter_string_from_selection(selection.start_planned_years, "start_planned__in");
	var str_donor = make_parameter_string_from_selection(selection.donors, "participating_organisations__in");
	var str_reporting_organisation = make_parameter_string_from_selection(selection.reporting_organisations, "reporting_organisation__in"); 
	var str_search = make_parameter_string_from_query_selection(selection.query, "query");
	var str_country_search = make_parameter_string_from_query_selection(selection.country, "country");
	var str_region_search = make_parameter_string_from_query_selection(selection.region, "region");

	return str_region + str_country + str_sector + str_budget + str_start_year + str_donor + str_reporting_organisation + str_search + str_country_search + str_region_search;
}


function comma_formatted(amount) {
	if (amount){
		return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	} else {
		return "-";
	}
}

function replaceAll(o,t,r,c){
	var cs = "";
	if(c===1){
		cs = "g";
	} else {
		cs = "gi";
	}
	var mp=new RegExp(t,cs);
	ns=o.replace(mp,r);
	return ns;
}

function perform_cors_ajax_call_with_refresh_callback(url, current_object){

	jQuery.support.cors = true;

	if(window.XDomainRequest){
		var xdr = new XDomainRequest();
		xdr.open("get", url);
		xdr.onprogress = function () { };
		xdr.ontimeout = function () { };
		xdr.onerror = function () { };
		xdr.onload = function() {
			var data = jQuery.parseJSON(xdr.responseText);
			if (data === null || typeof (data) === 'undefined')
			{
				data = jQuery.parseJSON(data.firstChild.textContent);
			}
			current_object.refresh(data);
		};
		setTimeout(function () {xdr.send();}, 0);
	} else {
		jQuery.ajax({
			type: 'GET',
			url: url,
			contentType: "application/json",
			dataType: 'json',
			success: function(data){
				current_object.refresh(data);
			}
		});
	}
}
