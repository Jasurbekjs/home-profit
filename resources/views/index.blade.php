<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profit</title>
	<link rel="stylesheet" href="{{asset('public/assets/css/uikit.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/assets/css/uikit-rtl.min.css')}}">
</head>
<body>
	<div id="app">
		
		<v-header></v-header>
		
		<main style="margin-top: 20px;">
			<div class="uk-container">
				<router-view></router-view>
			</div>
		</main>
		<br/>
		<v-footer></v-footer>
		
	</div>
	<script src="{{asset('public/assets/js/uikit.min.js')}}"></script>
	<script src="{{asset('public/assets/js/uikit-icons.min.js')}}"></script>
	<script src="./public/js/app.js"></script>
</body>
</html>