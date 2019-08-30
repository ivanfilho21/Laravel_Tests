<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="/css/app.css" rel="stylesheet">
</head>
<body>
	<nav>
		<ul>
			<li><a href="#">List</a></li>
			<li><a href="#">New Product</a></li>
		</ul>
	</nav>
	<div class="container">
		<h1>Produtos</h1>

		<table class="table table-striped table-bordered table-hover">
		<?php foreach ($products as $p): ?>
			<tr>
				<td><?= $p->nome ?></td>
				<td>R$ <?= $p->valor ?></td>
				<td><?= $p->descricao ?></td>
				<td><?= $p->quantidade ?></td>

				<td>
					<a href="produto?id=<?= $p->id ?>" class="btn btn-default">
						<span class="glyphicon glyphicon-search"></span>
					</a>
					<a href="produto/editar?id=<?= $p->id ?>" class="btn btn-default">
						<span class="glyphicon glyphicon-pencil"></span>
					</a>
					<a href="produto/apagar?id=<?= $p->id ?>" class="btn btn-default">
						<span class="glyphicon glyphicon-trash"></span>
					</a>
				</td>
			</tr>
		<?php endforeach ?>
		</table>
	</div>
</body>
</html>