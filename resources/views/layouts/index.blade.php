@yield('top')

@include('layouts.header')
<div class="content">
	@yield('center')
</div>
@include('layouts.footer')

@yield('bottom')