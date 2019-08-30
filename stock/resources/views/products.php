<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="/css/app.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Products</h1>

		<table class="table table-striped table-bordered table-hover">
		<?php foreach ($products as $p): ?>
			<tr>
				<td><?= $p->nome ?></td>
				<td><?= $p->valor ?></td>
				<td><?= $p->descricao ?></td>
				<td><?= $p->quantidade ?></td>
			</tr>
		<?php endforeach ?>
		</table>
	</div>
</body>
</html>