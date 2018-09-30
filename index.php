<?php
include 'contato.class.php';
$contato = new Contato();

$id = 0;
$excluir = $contato->excluirPeloId($id);

if($excluir == true) {
	echo "Foi excluido!";
} else {
	echo "Não foi excluido!";
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD oo</title>
	<!--Link responsivo-->
	<meta name="viewport" content="width=device-width, initial-scale=1" >
	<!--Link Bootstrap CSS-->
	<link rel="stylesheet"  href="bootstrap.min.css">
	<!--Link JQuery-->
	<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
	<!--Link Bootstrap JS-->
	<script type="text/javascript" src="bootstrap.min.js"></script>
	<!--Link JS-->
	<script type="text/javascript" src="script.js"></script>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">
		<div class="box">
			<!--NAV-->
			<ul class="nav nav-tabs">
				  <li class="nav-item">
				    <a class="nav-link active" href="adiconar.php">Adicionar</a>
				  </li>
			</ul>
			<!--Table-->
			<table class="table table-sm table-dark">
				  <thead>
				    <tr>
				      <th scope="col">Id</th>
				      <th scope="col">Nome</th>
				      <th scope="col">E-mail</th>
				      <th scope="col">Ações</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				  	$lista = $contato->getAll();
				  	foreach($lista as $item):
				  	?>
				    <tr>
				      <th scope="row"><?php echo $item['id']; ?></th>
				      <td><?php echo $item['nome']; ?></td>
				      <td><?php echo $item['email']; ?></td>
				      <td>
				      	<a href="editar.php?id=<?php echo $item['id']; ?>">Editar</a>
				      	<a href="excluir.php?id=<?php echo $item['id']; ?>">Remover</a>
				      </td>
				    </tr>
				<?php endforeach; ?>
				  </tbody>
			</table>
		</div>
	</div>
</body>
</html>