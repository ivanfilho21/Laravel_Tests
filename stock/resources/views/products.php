<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>Products</h1>

	<table>
	<?php foreach ($products as $p): ?>
		<tr>
			<td><?= $p->nome ?></td>
			<td><?= $p->valor ?></td>
			<td><?= $p->descricao ?></td>
			<td><?= $p->quantidade ?></td>
		</tr>
	<?php endforeach ?>
	</table>
</body>
</html>