var plex = {
	'fn': {
		'save_settings': function () {
			var data = plex.data.settings;
			if (data != undefined) {
				$.ajax({
					'url': '/api/kevin',
					'type': 'POST',
					'data' : {'data': JSON.stringify(data)}
				})
			}
		}, 
		'init': function () {
			$('#settings-wrap #savesettings .pure-g').each(function () {
				plex.data['settings'] ={}
				var id = $(this).attr('data-id');
				plex.data.settings[id] = {}

				plex.data.settings[id]['id'] = $(this).attr('data-id');
				plex.data.settings[id]['name'] = $(this).attr('data-name');
				plex.data.settings[id]['value'] = $(this).attr('data-value'); 
			})

			
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
				//plex.data.settings[id]['value'] = $(this).val();
			}
		})
		
	}
})