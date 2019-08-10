 <?php $menu = [
 	'home'=> [
        'title'=>'Home',
        'href' => env('HOMEPAGE'),
        'devhref' => env('DEVHOMEPAGE')
     ], 
     'settings' => [
         'title'=> 'Settings',
         'href' => '/settings'
     ],
     'manage' => [
     	'scan' => [
     		'title' => 'Scan',
     		'href' => '/scan'
     	]
     ]

 ]; ?>

<div class="pure-menu pure-menu-horizontal">
	<ul class="pure-menu-list">
		@if(strpos(url()->current(), ':8000')==false)
	 		<li class="pure-menu-item pure-menu-selected"><a href="{{$menu['home']['href']}}" class="pure-menu-link">{{ $menu['home']['title'] }}</a></li>
	 		 <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">

	            <a href="#" id="menuLink1" class="pure-menu-link">Manage</a>
	            <ul class="pure-menu-children">
	                <li class="pure-menu-item"><a href="{{$menu['home']['href'] . $menu['manage']['scan']['href']}}" class="pure-menu-link">{{$menu['manage']['scan']['title']}}</a></li>
	                <li class="pure-menu-item"><a href="#" class="pure-menu-link">Transfer</a></li>
	                <li class="pure-menu-item"><a href="#" class="pure-menu-link">Remove</a></li>
	            </ul>

	        </li>
	    <li class = "pure-menu-item pure-menu-selected">  <a href="{{$menu['home']['href'] . $menu['settings']['href']}}" id="menuLink1" class="pure-menu-link">{{$menu['settings']['title']}}</a></li>


	 	@else
	 		<li class="pure-menu-item pure-menu-selected"><a href="{{$menu['home']['devhref']}}" class="pure-menu-link">{{ $menu['home']['title'] }}</a></li>
	 		 <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">

	            <a href="#" id="menuLink1" class="pure-menu-link">Manage</a>
	            <ul class="pure-menu-children">
	                <li class="pure-menu-item"><a href="{{$menu['manage']['scan']['href']}}" class="pure-menu-link">{{$menu['manage']['scan']['title']}}</a></li>
	                <li class="pure-menu-item"><a href="#" class="pure-menu-link">Transfer</a></li>
	                <li class="pure-menu-item"><a href="#" class="pure-menu-link">Remove</a></li>
	            </ul>

	        </li>
	    <li class = "pure-menu-item pure-menu-selected">  <a href="{{$menu['settings']['href']}}" id="menuLink1" class="pure-menu-link">{{$menu['settings']['title']}}</a></li>
	 	@endif
	       
	</ul>
</div>