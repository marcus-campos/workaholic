<!DOCTYPE html>
<html>
<head>

	@yield('meta')

	@yield('title-fav')

	@yield('css')

</head>
<body>

<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">

	@yield('content')

</div>

@yield('js')

</body>
</html>