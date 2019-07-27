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
		'write_settings_to_obj': function (id, obj) {
			if (plex.data.settings == undefined) {
				plex.data.settings = {};
			}

			plex.data.settings[id] = {}
			plex.data.settings[id]['id'] = obj.id.toString();
			plex.data.settings[id]['name'] = obj.name;
			plex.data.settings[id]['value'] = obj.value;
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



			
		},
		'update_obj': function (obj, value) {
			obj = value;
			return obj;
		}
	},
	'data': {}
}



$(function () {

	plex.fn.init();

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
})