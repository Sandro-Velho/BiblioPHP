# BiblioPHP
BiblioPHP

<br>
		<center>	
			<h3 align="center">Olá Mundo! Por <label class="biblio-font">BiblioPHP <?=BIBLIO_VERSION?></label></h3>
		</center>
		<hr>
		<h2 align="center">Funcionalidades</h2>
		<br>
		<ul class="list-group list-group-flush">
			<li class="list-group-item">Como configurar?</li>
			<ul class="list-group">
				<li class="list-group-item">Primeiro passo, você deve ir no arquivo <b>config.php</b>, que fica dentro do diretório <b>cdn</b>, na raiz do projeto;</li>
				<li class="list-group-item">Dentro desse arquivo de configurações, existe a constante <b>HOMEPAGE</b>, que é a página que será carregada em caso de usuário não autenticado no sistema. Lá, por exemplo, pode ser indicada a sua página de login. Por padrão, está sendo carregada esta página;</li>
				<li class="list-group-item">Em caso de usuário autenticado, a página a ser incluída por padrão será <b>painel.php</b>. Lá você configura seu template, e dentro da tag <b>head</b>, já estão incluídos arquivos de <b>header</b> e <b>footer</b>, que carregam automaticamente seus arquivos de <b>CSS</b> e <b>JavaScript</b>;</li>
				<li class="list-group-item">Neste painel já contém a configuração de rotas, que, preferencialmente, deve ser mantida;</li>
				<li class="list-group-item">As rotas são mantidas pela classe <b>Router</b>, contida em <b>app/Router/Router.php</b></li>
				<li class="list-group-item">Dentro de <b>app/Database/DB.php</b>, estão contidas as configurações de banco de dados. Dentro dessa classe, também estão contidos métodos estáticos para a execução de comandos DDL de forma simplificada;</li>
				<li class="list-group-item">Pronto, após estes passos, BiblioPHP está com ambiente configurado.</li>
			</ul>
			<li class="list-group-item">Classe Biblio</li>
			<ul class="list-group">
				<li class="list-group-item">Classe com métodos estáticos, todos feitos para facilitar e padronizar a programação do sistema.</li>
				<li class="list-group-item">Exemplos de chamada:</li>
				<ul class="list-group">
					<li class="list-group-item">$data = Biblio::swapDate('<?=date('Y-m-d')?>'); //O resultado será <?=date('d/m/Y')?></li>
					<li class="list-group-item">$data = Biblio::swapDate('<?=date('d/m/Y')?>'); //O resultado será <?=date('Y-m-d')?></li>
				</ul>
			</ul>
			<li class="list-group-item">Classe DB</li>
			<ul class="list-group">
				<li class="list-group-item">Classe com métodos estáticos, todos feitos para facilitar e padronizar operações com Banco de dados.</li>
				<li class="list-group-item">Exemplos de chamada:</li>
				<ul class="list-group">
					<li class="list-group-item">$resultado = DB::insert("tb_exemplo", array('campo1' => "item1", 'campo2' => "item2"));</li>
					<li class="list-group-item">$resultado = DB::select("tb_exemplo");</li>
					<li class="list-group-item">$resultado = DB::select("tb_exemplo", 'campo1', "campo1 = 'item1'");</li>
					<li class="list-group-item">$resultado = DB::select("tb_exemplo", '*', "campo1 = 'item1'");</li>
				</ul>
			</ul>
			<li class="list-group-item">Classe Router</li>
			<ul class="list-group">
				<li class="list-group-item">Classe com métodos estáticos, todos feitos para facilitar e padronizar as rotas do sistema;</li>
				<li class="list-group-item">Por padrão, ele lê o primeiro parâmetro da url como o <b>Controller</b> que vai ser executado, na pasta <b>app/Controllers</b>;</li>
				<li class="list-group-item">O Controller padrão é o <b>MainController.php</b>, que é executado quando não existe um parâmetro para o tal;</li>
				<li class="list-group-item">O Controller padrão também pode ser modificado no arquivo de configurações;</li>
				<li class="list-group-item">O método a ser executado é o segundo parâmetro, se não tiver, tenta executar o método <b>index();</b>;</li>
				<li class="list-group-item">O método padrão também pode ser alterado no arquivo de configurações;</li>
				<li class="list-group-item">Um método pode executar ações e direcionar para outras páginas. Se o método for para incluir uma página, deve ser retornado o nome da página, que irá apontar para <b>view/NOME_DO_CONTROLLER/RETORNO_DO_METODO</b>.php;</li>
				<li class="list-group-item">Não se deve colocar a extensão .php;</li>
				<li class="list-group-item">Exemplos de chamada (Vamos considerar o controller padrão):</li>
				<ul class="list-group">
					<li class="list-group-item">Controller: MainController.php:</li>
					<li class="list-group-item">Método: public function index() { return 'index'; }</li>
					<li class="list-group-item">Arquivo que será executado: view/Main/index.php</li>
				</ul>
				<li class="list-group-item">Se o método não tiver retorno, ou retornar <b>false</b>, não será incluída nenhuma página;</li>
				<li class="list-group-item">Neste caso, ao finalizar a execução do método, deve-se redirecionar para a próxima página.</li>
			</ul>
		</ul>
		<br>
		<h4 align="center">Agora, mãos na massa!</h4>
        <hr>
        <p align="center">Versão 1.00</p>
