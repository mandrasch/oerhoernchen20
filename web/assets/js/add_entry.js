// Disabling autoDiscover, otherwise Dropzone will try to attach twice.
Dropzone.autoDiscover = false;

$(function() {

	var form = $("#oerhoernchen20-add-form");

	// global ajax error handler (for 500 errors)
	$(document).ajaxError(function(event, jqXHR, ajaxOptions, exception) {
  		if (jqXHR.status === 0)
        {
            alert('Not connect.\n Verify Network.');
        } else if (jqXHR.status == 404)
        {
            alert('Requested page not found. [404]');
        } else if (jqXHR.status == 500)
        {
            alert('Internal Server Error [500] '+jqXHR.statusText); // this will come from CI
        } else if (exception === 'parsererror')
        {
            alert('Requested JSON parse failed.');
        } else if (exception === 'timeout')
        {
            alert('Time out error.');
        } else if (exception === 'abort')
        {
            alert('Ajax request aborted.');
        } else
        {
            alert('Uncaught Error.\n' + jqXHR.responseText);
        }
	});
	// eo global ajax error handler

	// check if main_url parameter was provided
	// https://stackoverflow.com/questions/39006574/check-if-url-param-exist-using-jquery/39006624
	$.urlParam = function(name){
		var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
		if(results !== null){
			return results[1];
		}else{
			return null;
		}
	}
	if (typeof($.urlParam('main_url')) != 'null') {
	  $("input[name=main_url]",form).val($.urlParam('main_url'));
	}

	// 2DO: use curl/php instead and hide this api key?
	var IMGUR_CLIENT_ID = '2623f6cd2796830';
	var IMGUR_DELETE_HASH = null;

	// tag editor

	$("textarea[name='tags']:first",form).tagEditor();

	// 2DO: check if form is really successful send, otherwise delete image from uploadcare
	var thumbnailUrl = '';

	var subUrlElement = '<div class="row sub-url-row">'+
							'<div class="col-md-8">'+
								'<div class="form-group" style="display: block;">'+
		                             '<label class="control-label control-label-left col-sm-3" for="URL:">URL:<span class="req"> *</span></label>' +
		                                '<div class="controls col-sm-9">' +
		                                   '<input type="text" value="https://oer.uni-leipzig.de/wp-content/files_mf/1550828416go%CC%88tterwelt_griechenland_ab_variantea.pdf" class="form-control k-textbox sub-url" data-role="text" placeholder="https://">'+
		                                   	'<span lass="error"></span>'+
		                            	'</div>'+
		                        '</div>'+
	                        '</div>'+
	                        '<div class="col-md-4">'+
	                        	'<div class="form-group" style="display: block;">'+
	                                  	'<label class="control-label control-label-left col-sm-3" for="Art:">Typ:<span class="req"> *</span></label>'+
		                                '<div class="controls col-sm-9">'+
		                                    '<select class="form-control sub-url-type" data-role="select" selected="selected" required>'+
		                                        '<option value=""></option>'+
		                                        '<option value="Video">Video</option>'+
		                                        '<option value="Interaktiver Inhalt (z.B. h5p / Moodle Quiz)">Interaktiver Inhalt (z.B. h5p / Moodle Quiz)</option>'+
		                                        '<option value="Audio">Audio</option>'+
		                                        '<option value="Präsentation">Pr?sentation</option>'+
		                                        '<option value="E-Book/Textbook">E-Book/Textbook</option>'+
		                                        '<option value="Arbeitsblatt" selected>Arbeitsblatt</option>'+
		                                        '<option value="LMS-Einheit">LMS-Einheit</option>'+
		                                        '<option value="Sonstiges">Sonstiges</option>'+
		                                    '</select><span id="errId14" class="error"></span></div>'+
		                            '</div>'+
	                            '</div>'+
	                            '<div class="form-group" style="display: block;">'+
	                                  	'<label class="control-label control-label-left col-sm-3" for="Art:">Sub-Typ</label>'+
		                                '<div class="controls col-sm-9">'+
		                                    '<select class="form-control sub-url-sub-type" data-role="select" selected="selected" data-parsley-errors-container="#errId14">'+
		                                        '<option value=""></option>'+
		                                        '<option value="> YouTube">&gt; YouTube</option>'+
		                                        '<option value="> h5p">&gt; h5p</option>'+
		                                        '<option value="> Sonstiges">&gt; Sonstiges</option>'+
		                                        '<option value="> Powerpoint">&gt; Powerpoint</option>'+
		                                        '<option value="> Google Docs Pr?sentation">&gt; Google Docs Pr?sentation</option>'+
		                                        '<option value="pdf" selected>&gt; PDF</option>'+
		                                        '<option value="> Apple Keynote">&gt; Apple Keynote</option>'+
		                                        '<option value="> Pressbooks">&gt; Pressbooks</option>'+
		                                        '<option value="> Microsoft Word">&gt; Microsoft Word</option>'+
		                                        '<option value="> Open Office">&gt; Open Office</option>'+
		                                        '<option value="> Google Docs">&gt; Google Docs</option>'+
		                                        '<option value="> Sonstiges">&gt; Sonstiges</option>'+
		                                        '<option value="> Moodle">&gt; Moodle</option>'+
		                                        '<option value="> ILIAS">&gt; ILIAS</option>'+
		                                    '</select><span id="errId14" class="error"></span></div>'+
		                            '</div>'+
	                            '</div>'+
                            '</div>'+
                    	'</div>';

    $("div.sub-urls",form).append(subUrlElement);

	$("button[name=append-sub-url]",form).click(function(e){
		console.log('click append sub url');
		e.preventDefault();
		$("div.sub-urls",form).append(subUrlElement);
	});

    $("#submit-entry").click(function(event) {
        event.preventDefault(); //prevent default action 
        var requestUrl = BASE_URL+'oerhoernchen/community_bookmarks/ajax_add_entry/'; //get form action url
        var requestMethod = "post"; //get form GET/POST method

        console.log('click submit',this);

        // get sub urls:
       /* var subUrls = [];
        $(".sub-url-row",form).each(function(){
        	var obj = {
        		"url":$(this).find("input").val(),
        		"type":$(this).find("select.sub-url-type").val(),
        		"sub_type":$(this).find("select.sub-url-sub-type").val()
        	}
        	subUrls.push(obj);
		});
		console.log('sub urls',sub_urls);*/

		var generalTypes = $("input:checkbox[name=general_types]:checked", form).map(function(){
	      return $(this).val();
	    }).get();

	    var technicalFormats = $("input:checkbox[name=technical_formats]:checked", form).map(function(){
	      return $(this).val();
	    }).get();

	    var educationalSectors = $("input:checkbox[name=educational_sectors]:checked", form).map(function(){
	      return $(this).val();
	    }).get();
		
        var newObject =
        	{
        	"title":$("input[name=title]",form).val(),
		    "main_url":$("input[name=main_url]",form).val(),
		    "general_types":generalTypes,
		    "technical_formats":technicalFormats,
		    "description":$("textarea[name=description]",form).val(),
		    "license_attribution":$("textarea[name=license_attribution]",form).val(),
		    "license_type":$("select[name=license_type]",form).val(),
		    "license_url":$("select[name=license_url]",form).val(),
		    "educational_sectors":educationalSectors, //2DO: mehrzahl or not?
		    "school_subjects":$("select[name=school_subjects]",form).val(),
		    "higher_education_subjects":$("select[name=higher_education_subjects]",form).val(),
		    "special_topics":$("select[name=special_topics]",form).val(),
		    //"sub_url_licenses_vary":$("select[name=sub_url_licenses_vary]",form).val(),
		    "raw_url":$("input[name=raw_url]",form).val(),
		    //"sub_urls":sub_urls,
		    //"thumbnail_url":thumbnailUrl
		    "thumbnail_url":$("input[name=thumbnail_url",form).val(),
		    "created_year":$("input[name=created_year]",form).val(),
		    "imgur_url":$("input[name=imgur_url",form).val(),
		    "imgur_delete_hash":$("input[name=imgur_delete_hash",form).val(),
		    "tags":$("textarea[name='tags']:first").tagEditor('getTags')[0].tags
		};

		console.log('Created new object based on form values:',newObject)

		var formData = JSON.stringify(newObject);

		console.log('Stringified form data',formData);
		console.log('Index',$("select[name=index]",form).val());

		var index = $("select[name=index]",form).val();

        $.ajax({
            url: requestUrl,
            type: requestMethod,
            data: {
            	'index':index,
            	'oerModuleJson':formData
            }
        }).done(function(response) { //
        	console.log('response',response);

        	if(response.success == true){

        		if(response.is_awaiting_approval){

        			Swal.fire({
					  //position: 'top-end',
					  type: 'success',
					  title: 'Erfolgreich abgesendet!',
					  text: 'Vielen Dank! Der Eintrag wurde erfasst, wird noch von uns geprüft und du wirst mit +10 Punkten belohnt, sobald der Eintrag online geht.',
					  showConfirmButton: true
					});


        			//$.showModal({title: "Erfolgreich abgesendet!", body: 'Vielen Dank! Der Eintrag wurde erfasst, wird noch von uns geprüft und du wirst mit +10 Punkten belohnt, sobald der Eintrag online geht.'})
        		}
        		else{
        			var resultEntryId = response.elastic_id;

        			// 2DO: ask if user wants to go to bookmark or create another one

        			Swal.fire({
					  //position: 'top-end',
					  type: 'success',
					  title: 'Erfolgreich abgesendet!',
					  text: 'Vielen Dank! Der Eintrag wurde erfasst und du wirst mit +10 Punkten belohnt!',
					  showConfirmButton: true,
					  onAfterClose: function(el){

					  	// 2DO: Show window with "go to entry" / "add another"

					  	if(index == 'official'){
					  		window.location.href = BASE_URL+'/lesezeichen/?searchFilter="'+resultEntryId+'"';
					  	}	
					  	if(index == 'playground'){
					  		window.location.href = BASE_URL+'/lesezeichen/playground/?searchFilter="'+resultEntryId+'"';
					  	}	
					  	if(index == 'github'){
					  		window.location.href = 'https://programmieraffe.github.io/oerhoernchen20-react/?searchFilter="'+resultEntryId+'"';
					  	}
					  	
					  }
					});

        			//$.showModal({title: "Erfolgreich eingetragen!", body: 'Vielen Dank! Der Eintrag wurde erfasst, du wirst mit +10 Punkten belohnt. Ansehen: <a href="'+resultEntryUrl+'">Anzeigen</a>'})
        		}

        	}
        	else{
        		// 2DO: error if not created/success state?
        		alert('Something went wrong. :(');
        	}

        	// 2DO: add complex buttons https://www.jqueryscript.net/demo/Dynamic-Bootstrap-4-Modals/

            $("#server-results").html(response);

            /*@index success: Array ( [_index] => oerhoernchen20 [_type] => module [_id] => AWvG2eCsI22c2BCr7p4B [_version] => 1 [result] => created [_shards] => Array ( [total] => 2 [successful] => 2 [failed] => 0 ) [created] => 1 )*/
        });
    });

    //disable uploadcare right now
    /*var singleWidget = uploadcare.SingleWidget('[role=uploadcare-uploader]');
    singleWidget.onUploadComplete(function(info) {
    	// sett thumbnail url
    	thumbnailUrl = info.cdnUrl;
    	$("input[name=thumbnail_url",form).val(thumbnailUrl);

  		console.log('upload complete',info);
  		// Handle uploaded file info.
  		// {uuid: "38aa47eb-e58a-499f-8833-6c1b35cfa38d", name: "20190618_143946.jpg", size: 576047, isStored: true, isImage: true, …}
	});
	singleWidget.onChange(function(file) {
		console.log('uploadcare on change',file);
	  // Handle new file.
	});*/
	// eo uploadcare


	/* Upload with dropzonejs (MIT license) and imgur (anonynmous) */

		// or disable for specific dropzone:
	// Dropzone.options.myDropzone = false;

	// Now that the DOM is fully loaded, create the dropzone, and setup the
	// event listeners
	$("#imgur-dropzone").dropzone({
		"url":"https://fakeurl/test",
		"acceptedFiles":"image/*", // comma separeted list
		"autoProcessQueue":false, // https://stackoverflow.com/questions/48790634/dropzonejs-function-instead-of-post-url/48823325
		"maxFiles":1,
		"addRemoveLinks":false,
		"dictDefaultMessage":"Bild-Datei hier ablegen, Direkt-Upload zu imgur",
		init: function() {
    		this.on("addedfile", function(file) { 
		    	console.log('dropzone - added file',file);
				var fd = new FormData();
		        fd.append('image', file);
				postImageToImgur(fd);
    		 });
  		}

	});

	var postImageToImgur = function(data){
		// thanks to https://github.com/carry0987/Imgur-Upload
			var xhttp = new XMLHttpRequest();
            xhttp.open('POST', 'https://api.imgur.com/3/image', true);
            xhttp.setRequestHeader('Authorization', 'Client-ID ' + IMGUR_CLIENT_ID);
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4) {
                    if (this.status >= 200 && this.status < 300) {
                        var response = '';
                        try {
                            response = JSON.parse(this.responseText);
                        } catch (err) {
                            response = this.responseText;
                        }
                        
                        //2DO: put in callback function
                        if (response.success === true) {
                        	console.log('response - success',response);

                        	$("input[name=thumbnail_url",form).val(response.data.link);
                        	$("input[name=imgur_url",form).val(response.data.link);

                        	// set delete hash so user can delete false uploaded image
                        	IMGUR_DELETE_HASH = response.data.deletehash;
                        	$("input[name=imgur_delete_hash",form).val(response.data.deletehash)

                        	$("#imgur-dropzone-remove").show();
                        	// 2DO: Log this in database as well?

					        //var get_link = res.data.link.replace(/^http:\/\//i, 'https://');
					        //$('.status').classList.add('bg-success');
					        //$('.status').innerHTML =
					         //   'Image : ' + '<br><input class="image-url" value=\"' + get_link + '\"/>' + '<img class="img" alt="Imgur-Upload" src=\"' + get_link + '\"/>';
					    

					         // 2DO: SEND JSON REQUEST TO CI & LOG ALL IMAGES WITH DELETE HASH!
					         $.ajax({
						            url: BASE_URL+'oerhoernchen/community_bookmarks/ajax_add_imgur_upload/',
						            type: 'POST',
						            data: {
						            	'imgur_url':response.data.link,
						            	'imgur_delete_hash':response.data.deletehash
						            }
						        }).done(function(response) { //
						        	console.log('response - submit imgur upload to codeigniter',response);
						        });

					         // EO SEND TO CODEIGNITE


					    }
					    else{
					    	alert('Das Hochladen war nicht erfolgreich, bitte erneut versuchen.');
					    }

                    } else {
                        throw new Error(this.status + " - " + this.statusText);
                    }
                }
            };
            xhttp.send(data);
            xhttp = null;
	}

	$("#imgur-dropzone-remove").on('click',function(e){
		e.preventDefault();

		$.ajax({
					type: "POST",
					beforeSend: function (xhr) {
						  xhr.setRequestHeader('Authorization', 'Client-ID ' + IMGUR_CLIENT_ID);
					},
					url: 'https://api.imgur.com/3/image/'+IMGUR_DELETE_HASH,
					success: function(response){
						console.log('response - imgur',response);
						$("#imgur-dropzone-remove").hide();

						// remove in CI
						$.ajax({
						    url: BASE_URL+'oerhoernchen/community_bookmarks/ajax_delete_imgur_upload_from_db/',
						    type: 'POST',
						    data: {
						    	'imgur_delete_hash':IMGUR_DELETE_HASH
						    }
						}).done(function(response) { 
							console.log('response - delete hash from db',response);
						});

						// remove file from dropzone
						$("#imgur-dropzone")[0].dropzone.removeAllFiles();

						// reset delete hash
						IMGUR_DELETE_HASH = null;
					},
					contentType: 'json'
				});

	})

	/* URL CHECK */
	$("#button-url-check").click(function(e){
		e.preventDefault();
		console.log('url check');

		var main_url = $("input[name=main_url]",form).val();
		if(main_url == ''){
			alert('Bitte URL eingeben');
			return;
		}

		$("#reset-form").trigger('click');
		$("input[name=main_url]",form).val(main_url);

		// quick & dirty
		// 2DO: check browser compatibility
		// https://stackoverflow.com/questions/9290162/javascript-change-url-parameter-before-putting-it-in-history
		// 2DO: overwrites other params right now, needs to be replaced properly
		var newURL = "?main_url="  +encodeURI(main_url);
 		window.history.replaceState({}, '', newURL);

		 $.ajax({
            url: BASE_URL+'oerhoernchen/community_bookmarks/ajax_url_check/',
            type: 'GET',
            data: {
            	'main_url':main_url
            }
        }).done(function(response) { //
        	console.log('response',response);

        	if(response.success){
        		form.loadJSON(response.data);
        		// 2DO: Bootstrap toast?
        		Swal.fire({
				  //position: 'top-end',
				  type: 'success',
				  title: 'Die Webseite wurde erfolgreich analyisiert, die Daten sind nun im Formular eingetragen.',
				  showConfirmButton: true,
				  timer: 5500
				});
        		//alert('Seite wurde analysiert, Daten eingetragen.');

        	}
        });
	});

	$("#reset-form").click(function(e){
		e.preventDefault();
		form.trigger("reset");
		$('textarea',form).html('');
		// 2DO: check if imgur was set, delete it (trigger)
	})

	/* SAMPLE DATA */

	// load sample data json
	$("#load-sample-data-json-0").click(function(e){
		e.preventDefault();

		$("#reset-form").trigger('click');

		console.log('click sample data button 0');
		form.loadJSON({
				"index":"playground",
				"main_url": "https://www.oerbw.de/edu-sharing/components/render/6aee93d9-aec2-49cc-b192-f620571980f2",
		});
	});
	$("#load-sample-data-json-1").click(function(e){
		e.preventDefault();
		console.log('click sample data button 1');
		$("#reset-form").trigger('click');
		// retrieved from import_dumps/
		var formDataJson = {"title":"Basiswissen Physikalische Chemie",
		"main_url":"https://av.tib.eu/series/614/basiswissen+physikalische+chemie+physchembasics",
		"license_url":"http://creativecommons.org/licenses/by/3.0/de/deed.de",
		"general_types":["video"],"technical_formats":[],"description":" Jakob Günter Lauth (SciFox) erklärt in 13 Videos grundlegende Inhalte der physikalischen Chemie.","license_attribution":"Lauth, Jakob Günter (SciFox)","license_type":"ccby","educational_sectors":["highereducation"],"raw_url":"","thumbnail_url":"https://i.imgur.com/MLRBpu5.png","created_year":"2019","imgur_url":"https://i.imgur.com/MLRBpu5.png","imgur_delete_hash":"xx2tDExsfflyghF","tags":[]};
		form.loadJSON(formDataJson);
	});
	$("#load-sample-data-json-2").click(function(e){
		e.preventDefault();
		$("#reset-form").trigger('click');
		console.log('click sample data button 2');
		form.loadJSON({
				"index":"playground",
				"title": "Götter- und Alltagswelt im antiken Griechenland – erzählt von Zeus, Athena, Poseidon, Ares und Aphrodite",
				"main_url": "https://oer.uni-leipzig.de/lerninhalt/goetter-und-alltagswelt-im-antiken-griechland-erzaehlt-von-zeus-athena-poseidon-ares-und-aphrodite/",
				"general_types": ["video", "worksheet"],
				"technical_formats": ["h5p", "microsoftoffice"],
				"description": "Das vorliegende Projekt „Die Götter- und Alltagswelt im antiken Griechenland – Erzählt von Zeus, Athena, Poseidon, Ares und Aphrodite“ erweckt die griechischen Götter für die SchülerInnen zum Leben. Dies geschieht durch Hörspiele, in denen die Götter Zeus, Athena, Poseidon, Ares und Aphrodite selbst von ihrem Leben als Gottheit, ihrem Aufgabenbereich aber auch von verschiedenen Bereichen aus dem Alltag der Menschen des antiken Griechenlands erzählen. Jede Station besteht aus einem Hörspiel und einem Aufgabenblatt, durch das die SchülerInnen den Gott und sein Themenfeld kennenlernen. Der Unterrichtsvorschlag ist geplant für eine Exkursion in das Antikenmuseum der Universität Leipzig oder mehrere Geschichtsstunden an der Schule für die 5. Klasse. Die Arbeitsmaterialien liegen differenziert in zwei Niveaustufen vor. Zudem ist ein Vorschlag für eine prozessorientierte Bewertung sowie eine schriftliche Leistungskontrolle enthalten.",
				"license_type": "ccbysa",
				"license_url":"https://creativecommons.org/licenses/by-sa/4.0/",
				"license_attribution":"Universität Leipzig (Laura Hartleb, Anne Kiss, Dennis Fröbrich, Erik Fischer)",
				"license_url": "https://creativecommons.org/licenses/by-sa/4.0/deed.de",
				"educational_sectors": ["secondaryschool2"],
				"school_subjects": ["history"],
				"raw_url": "",
				"thumbnail_url": ""
		});
	});

	$("#load-sample-data-json-3").click(function(e){
		e.preventDefault();
		console.log('click sample data button 1');

		$("#reset-form").trigger('click');


		// retrieved from import dumps
		// .serializeJSON can only handle checkboxes which are named technical_formats[] instead of technical_formats
		formDataJson = {
			"index":"playground",
			"title":"Lehr-Lernprozesse mit digitalen Medien gestalten - Universitätsverbund digiLL",
			"main_url":"https://digill-nrw.de/kurs/lehr-lernprozesse-mit-digitalen-medien-gestalten/",
			"general_types":["coursemodule","video"],
			"technical_formats":["h5p","moodle"],
			"description":"Im Lernmodul “Lehr-Lernprozesse mit digitalen Medien gestalten” erfahren Sie, wie sich verschiedene Medien voneinander unterscheiden, was das für ihre Einsatzmöglichkeiten in Lehr-Lernprozessen bedeutet, und welche Funktionen sie übernehmen können.",
			"license_attribution":"Mirja Beutel, Ruhr-Universität Bochum",
			"license_type":"ccbysa",
			"license_url":"https://creativecommons.org/licenses/by-sa/4.0/legalcode.de",
			"educational_sectors":["highereducation"],
			"higher_education_subjects":["teaching"],
			"raw_url":"","thumbnail_url":"https://digill-nrw.de/wp-content/uploads/2017/12/digiLL_Medienkompetenz2.png",
			"created_year":"2017",
			"imgur_url":"https://i.imgur.com/MLRBpu5.png",
			"imgur_delete_hash":"xx2tDExsfflyghF",
			"tags":[]};
		console.log('form data json',formDataJson);
		form.loadJSON(formDataJson);
	});

	// 2DO: sample data: NC content, h5p content, etc.
	

});