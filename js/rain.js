
$(document).ready(function () {

        var curdiv = "";
        var old_curdiv = "";
        var hash = "";

        var url = window.location.hash, idx = url.indexOf("#"), idq = url.indexOf("?");
        if (idq > 0 && idq > idx){
            hash = idx != -1 ? url.substring((idx+1), idq) : "";
        } else{
            hash = idx != -1 ? url.substring(idx+1) : "";
        }
        if (hash != ""){
            $("html, body").animate({scrollTop: $('#'+hash).offset().top }, 400);
        }

        $(".homepage-to-top").click(function(e){
            e.preventDefault();
            $("html, body").animate({scrollTop: 0 }, 400);
        });

         $("#services-overview-advice").click(function(e){
             e.preventDefault();
             $("html, body").animate({scrollTop: $('#advice').offset().top }, 400);
         });

         $("#services-overview-intelligence").click(function(e){
             e.preventDefault();
             $("html, body").animate({scrollTop: $('#intelligence').offset().top }, 400);
         });
         
        $("#services-overview-implementation").click(function(e){
             e.preventDefault();
             $("html, body").animate({scrollTop: $('#implementation').offset().top }, 400);
         });

        $(".home-slider-1 .slider-service-link").click(function(e){
             e.preventDefault();
             var anchor = $(this).attr('href');
             $("html, body").animate({scrollTop: $(anchor).offset().top }, 400);
         });

         $("#news-mailchimp-form-link").click(function(e){
             e.preventDefault();
             var anchor = $(this).attr('href');
             $("html, body").animate({scrollTop: $(anchor).offset().top }, 400);
         });

         $(".projects-subnav a").click(function(e){
             e.preventDefault();
             var url = $(this).attr("href");
             var anchor = url.split("#")[1];
             $("html, body").animate({scrollTop: $('#'+anchor).offset().top }, 400);
         });

         $(".about-subnav a").click(function(e){
             e.preventDefault();
             var url = $(this).attr("href");
             var anchor = url.split("#")[1];
             $("html, body").animate({scrollTop: $('#'+anchor).offset().top }, 400);
         });

        function set_url(curdiv){
            if (history.pushState){
                var link = window.location.href;
                link = link.replace(window.location.hash, "");
                link = link + "#" + curdiv;
                history.pushState(null, null, link);    
            }
        }

        if($('.subnav-wrapper').length){

            $(window).scroll(function() { //on scroll,

                var scrollt = $(window).scrollTop();

                $('#main-content-wrapper > a').each(function(i) {
                    if (($(this).position().top - 100) <= scrollt) {
                        curdiv = $(this).attr('id');
                    }
                });
                
                if (!(old_curdiv == curdiv)){
                    $('.subnav-wrapper a').removeClass('active');
                    $('.subnav-wrapper #subnav-' + curdiv).addClass('active');
                    if (history.pushState){
                        set_url(curdiv);
                        old_curdiv = curdiv;

                    }
                }

            });
        }

         // Reload projects on pagination container click
        $('#news .pagination a').click(function(e){ 

            e.preventDefault();
              var url = $(this).attr("href");

              $('#news-archive-ajax-wrapper').fadeOut(100, function(){
                  $('#news-archive-loading').show();
              }).load(url + ' #news-archive-ajax-wrapper', function(){
                  $('#news-archive-loading').hide();
                  $('#news-archive-ajax-wrapper').fadeIn(200, function(){
                      reload_listeners();
                  });
              });

              $("html, body").animate({scrollTop: $('#news-search-anchor').offset().top }, 400);
        });


        $('.sub-menu>li>a').click(function(e){
            $('.navbar-toggle').click();
        });



        jQuery(".export-download-button").click(function(e){
            e.preventDefault();
            var format = jQuery(this).data("format");
            var project = new OipaProject();
            project.id = jQuery(this).data("id");
            project.export(format);
        });

        $("#load-more-rsr-updates").click(function(e){
            e.preventDefault();

            $("#hidden-rsr-updates").show(500);
            $(this).hide(500);
        });


    
});

function reload_listeners(){
    $('#news .pagination a').click(function(e){ 
        e.preventDefault();
          var url = $(this).attr("href");

          $('#news-archive-ajax-wrapper').fadeOut(100, function(){
              $('#news-archive-loading').show();
          }).load(url + ' #news-archive-ajax-wrapper', function(){
              $('#news-archive-loading').hide();
              $('#news-archive-ajax-wrapper').fadeIn(200, function(){
                  reload_listeners();
              });
          });
          $("html, body").animate({scrollTop: $('#news-search-anchor').offset().top }, 400);
          reload_listeners();
    });
}


$("#archive-search-form").submit(function(e)
{
    var postData = $(this).serializeArray();

    var url = window.location.origin + window.location.pathname + "?search="+postData[0]["value"];
    $('#news-archive-ajax-wrapper').fadeOut(100, function(){
          $('#news-archive-loading').show();
      }).load(url + ' #news-archive-ajax-wrapper', function(){
          $('#news-archive-loading').hide();
          $('#news-archive-ajax-wrapper').fadeIn(200, function(){
              reload_listeners();
          });
      });


    e.preventDefault(); 
});
 
if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
  var msViewportStyle = document.createElement("style")
  msViewportStyle.appendChild(
    document.createTextNode(
      "@-ms-viewport{width:auto!important}"
    )
  )
  document.getElementsByTagName("head")[0].appendChild(msViewportStyle)
}




$(".btn-open-filter").click(function(e){
    e.preventDefault();
    var filtername = $(this).data("name");

    if ($(this).hasClass("active")){
        $(".btn-open-filter").removeClass("active");
        $(".slide").slideUp(500);
        
    } else {

        $(".btn-open-filter").removeClass("active");
        $(".slide").slideUp(500);
        $(this).addClass("active");
        $(".slide-"+filtername).slideDown(500);
    }
});

$(".btn-map-view").click(function(e){
    e.preventDefault();
    $("#map").slideDown(500);
    $(".btn-list-view").removeClass("active");
    $(this).addClass("active");
});

$(".btn-list-view").click(function(e){
    e.preventDefault();
    $("#map").slideUp(500);
    $(".btn-map-view").removeClass("active");
    $(this).addClass("active");
});

jQuery(".filter-cancel-button").click(function(e){
    e.preventDefault();
    $(".btn-open-filter").removeClass("active");
    $(".slide").slideUp(500);
});

jQuery(".filter-save-button").click(function(e){
    e.preventDefault();
    Oipa.mainFilter.save();
    $(".btn-open-filter").removeClass("active");
    $(".slide").slideUp(500);
});

jQuery("#map-lightbox-close").click(function(e){
    e.preventDefault();
    $("#lightbox-wrapper").hide();
});


jQuery(".project-sort").click(function(e){
    e.preventDefault();
    var order_name = jQuery(this).data("name");
    
    jQuery(".asc-desc-slide-out").slideUp();
    jQuery("#"+order_name+"-asc-desc").slideDown();
});

jQuery(".asc-desc-slide-out a").click(function(e){
    e.preventDefault();
    e.stopPropagation();
    jQuery(".asc-desc-slide-out").slideUp();

    projectlist.order_by = jQuery(this).data("filter"); 
    projectlist.order_asc_desc = jQuery(this).data("asc-desc"); 
    
    projectlist.offset = 0;
    projectlist.refresh();
});


jQuery(".btn-filter-reset").click(function(e){
    e.preventDefault();
    filter.reset_filters();
});





function rsr_custom_excerpt(textstring, rsr_id){
    
    var textToHide = textstring.substring(100);
    var visibleText = textstring.substring(1, 100);

    if(textToHide.length > 0){
        return visibleText + '<a target="_blank" href="http://rsr.akvo.org/project/' + rsr_id + '/">... Read more</a>';
    }
}



function get_rsr_updates(rsr_id, data){

    
    if (!data){
        // get rsr update data
    
        var url = "http://rsr.akvo.org/api/v1/project_update/?format=json&project=" . rsr_id;
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
            get_rsr_updates(rsr_id, jsondata); 
        };
        setTimeout(function () {xdr.send();}, 0);
        } else {
            jQuery.ajax({
                type: 'GET',
                url: url,
                contentType: "application/json",
                dataType: 'json',
                success: function(data){
                    get_rsr_updates(rsr_id, data); 
                }
            });
        }
    } else {
        // show rsr update data

        for(var i=0;i<data.length;i++){

            var html = "";

            html += '<div class="row rsr-header"><div class="col-sm-3"></div><div class="col-sm-9">';
            html += data[i]['time'];
            html += '</div></div><div class="row rsr-body">';
            html += '<div class="col-sm-3 rsr-image-wrapper">';

            if(data[i]['photo'] != ""){

                html += '<img src="http://rsr.akvo.org/' + data[i]['photo'] + '" />';
            } else {

                html += template_directory + '/images/no-project-image-rsr.png" alt="" />';
            }

            html += '</div><div class="col-sm-9"><div class="row"><div class="col-sm-12 rsr-title">';
            html += '<a target="_blank" href="' + 'http://rsr.akvo.org/project/' + rsr_id + '/">';
            html += data[i]['title'];
            html += '</a></div></div><div class="row"><div class="col-sm-12 rsr-description">';
            html += rsr_custom_excerpt(data[i]['text'], rsr_id);
            html += '</div></div></div></div>';


        }
    }
}












var mce_preload_checks = 0;

function mce_preload_check(){
    if (mce_preload_checks>40) return;
    mce_preload_checks++;
    try {
        var jqueryLoaded=jQuery;
    } catch(err) {
        setTimeout('mce_preload_check();', 250);
        return;
    }
    var head= document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'http://downloads.mailchimp.com/js/jquery.form-n-validate.js';
    head.appendChild(script);
    try {
        var validatorLoaded=jQuery("#fake-form").validate({});
    } catch(err) {
        setTimeout('mce_preload_check();', 250);
        return;
    }
    mce_init_form();
}

function mce_init_form(){
    jQuery(document).ready( function($) {
      var options = { errorClass: 'mce_inline_error', errorElement: 'div', onkeyup: function(){}, onfocusout:function(){}, onblur:function(){}  };
      var mce_validator = $("#mc-embedded-subscribe-form").validate(options);
      $("#mc-embedded-subscribe-form").unbind('submit');//remove the validator so we can get into beforeSubmit on the ajaxform, which then calls the validator
      options = { url: 'http://rainfoundation.us6.list-manage2.com/subscribe/post-json?u=76443dd8c4881218d77e1bda5&id=515ae0cd82&c=?', type: 'GET', dataType: 'json', contentType: "application/json; charset=utf-8",
                    beforeSubmit: function(){
                        $('#mce_tmp_error_msg').remove();
                        $('.datefield','#mc_embed_signup').each(
                            function(){
                                var txt = 'filled';
                                var fields = new Array();
                                var i = 0;
                                $(':text', this).each(
                                    function(){
                                        fields[i] = this;
                                        i++;
                                    });
                                $(':hidden', this).each(
                                    function(){
                                        var bday = false;
                                        if (fields.length == 2){
                                            bday = true;
                                            fields[2] = {'value':1970};//trick birthdays into having years
                                        }
                                        if ( fields[0].value=='MM' && fields[1].value=='DD' && (fields[2].value=='YYYY' || (bday && fields[2].value==1970) ) ){
                                            this.value = '';
                                        } else if ( fields[0].value=='' && fields[1].value=='' && (fields[2].value=='' || (bday && fields[2].value==1970) ) ){
                                            this.value = '';
                                        } else {
                                            if (/\[day\]/.test(fields[0].name)){
                                                this.value = fields[1].value+'/'+fields[0].value+'/'+fields[2].value;                                            
                                            } else {
                                                this.value = fields[0].value+'/'+fields[1].value+'/'+fields[2].value;
                                            }
                                        }
                                    });
                            });
                        $('.phonefield-us','#mc_embed_signup').each(
                            function(){
                                var fields = new Array();
                                var i = 0;
                                $(':text', this).each(
                                    function(){
                                        fields[i] = this;
                                        i++;
                                    });
                                $(':hidden', this).each(
                                    function(){
                                        if ( fields[0].value.length != 3 || fields[1].value.length!=3 || fields[2].value.length!=4 ){
                                            this.value = '';
                                        } else {
                                            this.value = 'filled';
                                        }
                                    });
                            });
                        return mce_validator.form();
                    }, 
                    success: mce_success_cb
                };
      $('#mc-embedded-subscribe-form').ajaxForm(options);
      
    });
}

function mce_success_cb(resp){
    $('#mce-success-response').hide();
    $('#mce-error-response').hide();
    if (resp.result=="success"){
        $('#mce-'+resp.result+'-response').show();
        $('#mce-'+resp.result+'-response').html(resp.msg);
        $('#mc-embedded-subscribe-form').each(function(){
            this.reset();
        });
    } else {
        var index = -1;
        var msg;
        try {
            var parts = resp.msg.split(' - ',2);
            if (parts[1]==undefined){
                msg = resp.msg;
            } else {
                i = parseInt(parts[0]);
                if (i.toString() == parts[0]){
                    index = parts[0];
                    msg = parts[1];
                } else {
                    index = -1;
                    msg = resp.msg;
                }
            }
        } catch(e){
            index = -1;
            msg = resp.msg;
        }
        try{
            if (index== -1){
                $('#mce-'+resp.result+'-response').show();
                $('#mce-'+resp.result+'-response').html(msg);            
            } else {
                err_id = 'mce_tmp_error_msg';
                html = '<div id="'+err_id+'" style="'+err_style+'"> '+msg+'</div>';
                
                var input_id = '#mc_embed_signup';
                var f = $(input_id);
                if (ftypes[index]=='address'){
                    input_id = '#mce-'+fnames[index]+'-addr1';
                    f = $(input_id).parent().parent().get(0);
                } else if (ftypes[index]=='date'){
                    input_id = '#mce-'+fnames[index]+'-month';
                    f = $(input_id).parent().parent().get(0);
                } else {
                    input_id = '#mce-'+fnames[index];
                    f = $().parent(input_id).get(0);
                }
                if (f){
                    $(f).append(html);
                    $(input_id).focus();
                } else {
                    $('#mce-'+resp.result+'-response').show();
                    $('#mce-'+resp.result+'-response').html(msg);
                }
            }
        } catch(e){
            $('#mce-'+resp.result+'-response').show();
            $('#mce-'+resp.result+'-response').html(msg);
        }
    }
}

$(document).ready(function(jQuery) {

    var fnames = new Array();var ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';

    var err_style = '';
    try{
        err_style = mc_custom_error_style;
    } catch(e){
        err_style = '#mc_embed_signup input.mce_inline_error{border-color:#6B0505;} #mc_embed_signup div.mce_inline_error{margin: 0 0 1em 0; padding: 5px 10px; background-color:#6B0505; font-weight: bold; z-index: 1; color:#fff;}';
    }
    var head= document.getElementsByTagName('head')[0];
    var style= document.createElement('style');
    style.type= 'text/css';
    if (style.styleSheet) {
      style.styleSheet.cssText = err_style;
    } else {
      style.appendChild(document.createTextNode(err_style));
    }
    head.appendChild(style);



    setTimeout('mce_preload_check();', 250);
});




function ProjectFocusSlider(){
    this.id = null;
    this.html = "";
    this.bxslider = null;
}

ProjectFocusSlider.prototype.set_slider = function(){

        this.bxslider = $('.project-focus-slider').bxSlider({
            infiniteLoop: true,
            hideControlOnEnd: true,
            moveSlides: 1,
            pager: false,
            controls: false,
            adaptiveHeight: true,
            auto: false,
            pause: 10000,
            autoDelay: 500,
            autoHover: true,
            mode: 'vertical',
            startSlide: 3,
            slideMargin: 0,
            slideWidth: 360,
            minSlides: 15,
        });

        var that = this;

        $(".project-focus-item").click(function(e){

            e.preventDefault();
            var id = $(this).data("slide-id");
            that.bxslider.goToSlide(id);
            var current = that.bxslider.getCurrentSlide();

            $(".project-focus-item").removeClass("active");

            var old_content = $(".project-focus-slide-content.active");
            var new_content = $(".project-focus-slide-content[data-slide-id='" + current + "']");
            that.show_new_content(old_content, new_content);
            $(".project-focus-item[data-slide-id='" + current + "']").addClass("active");
        });


        this.bxslider.goToSlide(0);
        $(".menu-item").removeClass("active");
        $(".slide-" + this.id + " .menu-item").addClass("active");
}

ProjectFocusSlider.prototype.show_new_content = function(old_content, new_content){
    TweenLite.to(old_content, .5, {alpha:0, onComplete: function(){
        old_content.hide();
        old_content.removeClass("active");
        new_content.css("opacity", 0);
        new_content.addClass("active");
        new_content.show();
        TweenLite.to(new_content, .5, {alpha:1});
    }});
}

ProjectFocusSlider.prototype.next_slide = function(){
   this.bxslider.goToNextSlide();

   var current = this.bxslider.getCurrentSlide();
   $(".project-focus-item").removeClass("active");
   $(".project-focus-item[data-slide-id='"+current + "']").addClass("active");
   var old_content = $(".project-focus-slide-content.active");
   var new_content = $(".project-focus-slide-content[data-slide-id='"+current + "']");
   this.show_new_content(old_content, new_content);
}
          
ProjectFocusSlider.prototype.set_counter = function(_s, that){

    (function($) {
        $.fn.ccountdown = function(_s, that) {
            var $this = this;
            var _secondsleft = _s;
            var _zerocount = 0;
            // calling function first time so that it wll setup remaining time
            var _changeTime = function() {

                if (_secondsleft > 0){
                    _secondsleft = _secondsleft - 1;
                }

                if (_secondsleft == 0){

                    _zerocount++; 
                    if(_zerocount == 2){
                        that.next_slide();
                        _zerocount = 0;
                        _secondsleft = _s - 1;
                    }
                }

                var el = $($this);
                var $ss = el.find(".second");
                $ss.val(_secondsleft).trigger("change");
            };
            
            _changeTime();
            setInterval(_changeTime, 1000);
        };
    })(jQuery);

    $(".pf-next-project-counter").ccountdown(10, this);
}





function HomepageSlider(){
    this.slider = null;
}

HomepageSlider.prototype.set_slider = function(div_identifier){

        this.slider = $(div_identifier).skippr({
            autoPlay: false,
        });
        $('.home-slider-background-wrapper img').css('visibility', 'visible');
        this.transition(2, 1);
}

HomepageSlider.prototype.next_slide = function(){

    var current_id = $(".skippr-nav-element-active").attr("data-slider");
    var button = $(".skippr-next");
    var new_id = button.attr("data-slider");
    button.click();
    this.transition(current_id, new_id);
    return true;
}

HomepageSlider.prototype.transition = function(old_id, new_id){

    var home_slide_title = $(".home-slider-title-id-" + new_id);
    var home_slide_subtitle = $(".home-slider-subtitle-id-" + new_id);
    var home_slide_subtitle2 = $(".home-slider-subtitle2-id-" + new_id);
    
    // 1 sec after slider animation starts, drop in the boxes
    setTimeout(function(){

        home_slide_title.css("display", "block");
        home_slide_subtitle.css("display", "block");
        home_slide_subtitle2.css("display", "block");

        TweenLite.to(home_slide_title, 1.5, {left: "20px"});
        TweenLite.to(home_slide_subtitle, 1.5, {left: "20px"});
        TweenLite.to(home_slide_subtitle2, 1.5, {left: "20px", onComplete: function(){

        	// reset boxes of previous slide
            $(".home-slider-title-id-" + old_id).css("display", "none").css("left", "-2000px");
            $(".home-slider-subtitle-id-" + old_id).css("display", "none").css("left", "4000px");
            $(".home-slider-subtitle2-id-" + old_id).css("display", "none").css("left", "-2000px");
        }});

    }, 1000);
}

HomepageSlider.prototype.set_counter = function(_s){
    var that = this;
    (function($) {

        var $this = this;
        var _secondsleft =_s;
        var _changeTime = function() {

            if (_secondsleft > 0){
                _secondsleft = _secondsleft - 1;
            }

            if (_secondsleft == 0){
                that.next_slide();
                _secondsleft = _s - 1;
            }
        };
        
        _changeTime();
        setInterval(_changeTime, 1000);
        
    })(jQuery);
}
