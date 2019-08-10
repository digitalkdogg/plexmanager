<script type = "text/javascript" src="{{ asset('js/jQuery-3.4.1.js') }}"></script>
<script type = "text/javascript" src = "{{ asset('js/plex.js') }}" ></script>

<script>
	var env = {
		'homepage' : "{{env('HOMEPAGE') }}",
		'devhomepage' : "{{env('DEVHOMEPAGE')}}"
	}
</script>