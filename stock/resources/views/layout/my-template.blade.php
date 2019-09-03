<!DOCTYPE html>
<html>
<head>
	<title>Estoque</title>
	<link rel="stylesheet" href="/css/app.css">
	<link rel="stylesheet" href="/css/custom.css">
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="/produtos">Estoque</a>
			</div>

			<ul class="nav navbar-nav navbar-right">
				<li><a href="{{ action("ProductController@list") }}">Produtos</a></li>
				<li><a href="produto">Novo Produto</a></li>
			</ul>
		</div>
	</nav>

	<div class="container">
		@yield("content")
	</div>

	<footer class="footer">
		Ivan Filho - Todos os Direitos Reservados
	</footer>
</body>
</html>