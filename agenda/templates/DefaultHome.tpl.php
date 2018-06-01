<?php
	$this->assign('title','Agenda Telefonica | Home');
	$this->assign('nav','home');
	$this->display('_Header.tpl.php');
?>
	<div class="container">
		<!-- Main hero unit for a primary marketing message or call to action -->
		<div class="hero-unit">
			<h1>Gestor de agenda telefônica online <i class="icon-thumbs-up"></i></h1>
			<br>
			<p>
				<strong><?=strtoupper($_SESSION['Nome']);?></strong>, Bem-vindo ao seu novo gestor de agenda online. 
			<br>
				Todas as atualizações realizadas nesta página, terão caráter imediato nas págindas de acesso do cliente.
			</p>
			<p>
				Este gestor de agenda telefônica é formado por praticamente três telas acessadas através do meu principal, onde podemos gerênciar todos os recursos da agenda, o cliente irá ter acesso a ferramenta atravéz de seu navegador web.
			</p>
		</div>
		<div class="row"></div>
	</div> <!-- /container -->
<?php
	$this->display('_Footer.tpl.php');
?>