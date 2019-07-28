var plex = {
	'fn': {
		'save_settings': function () {
			var data = plex.data.settings;
			if (data != undefined) {
				$.ajax({
					'url': '/api/save_settings',
					'type': 'POST',
					'data' : {'data': JSON.stringify(data)}
				})
			}
		},
		'save_scan' : function () {
			$.each(plex.data.scan, function () {
				if(this.processed == undefined || this.processed == false) {
					$('#'+this.key + ' .status').text('Processing');
					plex.fn.save_scan_to_api(this);
					this.processed = true;
					return false;
				}
			})
		},
		'save_scan_to_api': function (obj) {
			$.ajax({
				'url': '/api/save_scan',
				'type' : 'Post',
				'data': obj,
				'success': function (data) {
					data = JSON.parse(data);
					
					$('#'+ obj.key + ' .status').text(data.status)
					setTimeout(function () {	
						plex.fn.save_scan()
					},1000);
				}
			})
		},
		'write_settings_to_obj': function (id, obj) {
			if (plex.data.settings == undefined) {
				plex.data.settings = {};
			}

			plex.data.settings[id] = {}
			plex.data.settings[id]['id'] = obj.id.toString();
			plex.data.settings[id]['name'] = obj.name;
			plex.data.settings[id]['value'] = obj.value;

			if (obj.name == 'Plex Server') {
				if (plex.data.settings.plex == undefined) {
					plex.data.settings.plex = {}
				}
				plex.data.settings.plex['server'] = obj.value;
			}

			if (obj.name == 'Plex Token') {
				if (plex.data.settings.plex == undefined) {
					plex.data.settings.plex = {}
				}
				plex.data.settings.plex['token'] = obj.value;
				//plex.data.settings['plex'] = {'token': obj.value}
			}			

			$(document).trigger('settingsloaded');
			
		},
		'write_scan_to_obj': function (id, obj) {
			if (plex.data.scan == undefined) {
				plex.data.scan = {};
			}

			plex.data.scan[id] = {}
			plex.data.scan[id]['key'] = obj.id.toString();
			plex.data.scan[id]['name'] = obj.name;
			plex.data.scan[id]['format'] = obj.format;
			plex.data.scan[id]['thumbnail'] = obj.thumbnail;
		},
		'get_settings_from_api': function () {
			$.ajax({
				'url': '/api/get_settings',
				'type': 'get',
				'success': function (data) {
					$.each(data, function () {
						plex.fn.write_settings_to_obj(this.id, this);
					})
				}
			})
		},
		'init': function () {
			if ($('#settings-wrap #savesettings .pure-g').length > 0) {
				$('#settings-wrap #savesettings .pure-g').each(function () {
					var id = $(this).attr('data-id');
					var obj = {
						'id': $(this).attr('data-id'), 
						'name': $(this).attr('data-name'), 
						'value': $(this).attr('data-value')
					}

					if(id != undefined) {
						plex.fn.write_settings_to_obj(id, obj);
					}
				})
			} else {
				plex.fn.get_settings_from_api();
			}

			//init scan items
			if ($('#scan-wrap').length>0) {
				$('div.movie-row-container').each(function () {
					
					var id = $(this).attr('id');
					var obj = {
						'id': id,
						'name': $(this).find('.name').text(),
						'format': $(this).find('.format').text(),
						'thumbnail': $(this).find('.thumbnail').text(),
					}

					if (id != undefined) {
						plex.fn.write_scan_to_obj(id, obj);
					}
				})
			}



			
		},
		'update_obj': function (obj, value) {
			obj = value;
			return obj;
		}
	},
	'data': {}
}



$(function () {

	//$(document).on('settingsloaded', {
//		foo: 'bar'
//	}, function (event) {
//		console.log(event.data.foo)
//	})

	plex.fn.init();

	$(document).on('settingsloaded', {}, function (event) {
		if ($('#settings-wrap').length>0) {
			$('#settings-wrap button#save-settings').click(function (e) {
				e.preventDefault();
				plex.fn.save_settings();	
			})

			$('#settings-wrap #savesettings input').change(function () {
				var id = $(this).attr('id');
				var type = $(this).attr('name');
				if (type == 'value') {
					plex.data.settings[id]['value'] = plex.fn.update_obj(plex.data.settings[id]['value'], $(this).val());
				}
			})
			
		}

		if ($('#scan-wrap').length>0) {
			$('#scan-wrap button').click(function (e){
				e.preventDefault();
				$('.movie-row-container .status').text('queued');
				plex.fn.save_scan();
			})
		}

		if ($('.movie-container').length>0) {
			$('.movie-container .movie').each(function () {
				var bg = $(this).attr('data-bg');
			
				if (bg != undefined) {
					$(this).css({'background': 'url(' + plex.data.settings.plex.server+bg+'?X-Plex-Token='+plex.data.settings.plex.token+')'})
				}
			})
		}
	}) //end settings loaded
})