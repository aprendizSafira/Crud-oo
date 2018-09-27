<?php
include 'contato.class.php';

$contato = new Contato();

$contato->adiconar("gerente@gmail.com", "");

$excluir = $contato->excluir("adrianaa@gmail.com");

if($excluir == true) {
	echo "Foi excluido!";
} else {
	echo "Não foi excluido!";
}