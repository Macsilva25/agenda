<?php
	$this->assign('title','Agenda Telefonica | Administrar_Agenda');
	$this->assign('nav','administrar_agenda');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/administrar_agenda.js").wait(function(){
		$(document).ready(function(){
			page.init();
		});
		
		// hack for IE9 which may respond inconsistently with document.ready
		setTimeout(function(){
			if (!page.isInitialized) page.init();
		},1000);
	});
</script>

<div class="container">

<h1>
	<i class="icon-th-list"></i> Administrar_Agenda
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="agenda_TelefonicaCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Id">Id<% if (page.orderBy == 'Id') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Nome">Nome<% if (page.orderBy == 'Nome') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Telefone">Telefone<% if (page.orderBy == 'Telefone') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Email">Email<% if (page.orderBy == 'Email') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DataNascimento">Data Nascimento<% if (page.orderBy == 'DataNascimento') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_Endereco">Endereco<% if (page.orderBy == 'Endereco') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('id')) %>">
				<td><%= _.escape(item.get('id') || '') %></td>
				<td><%= _.escape(item.get('nome') || '') %></td>
				<td><%= _.escape(item.get('telefone') || '') %></td>
				<td><%= _.escape(item.get('email') || '') %></td>
				<td><%if (item.get('dataNascimento')) { %><%= _date(app.parseDate(item.get('dataNascimento'))).format('MMM D, YYYY h:mm A') %><% } else { %>NULL<% } %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('endereco') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="agenda_TelefonicaModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idInputContainer" class="control-group">
					<label class="control-label" for="id">Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="id"><%= _.escape(item.get('id') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nomeInputContainer" class="control-group">
					<label class="control-label" for="nome">Nome</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="nome" placeholder="Nome" value="<%= _.escape(item.get('nome') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="telefoneInputContainer" class="control-group">
					<label class="control-label" for="telefone">Telefone</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="telefone" placeholder="Telefone" value="<%= _.escape(item.get('telefone') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="emailInputContainer" class="control-group">
					<label class="control-label" for="email">Email</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="email" placeholder="Email" value="<%= _.escape(item.get('email') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dataNascimentoInputContainer" class="control-group">
					<label class="control-label" for="dataNascimento">Data Nascimento</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
							<input id="dataNascimento" type="text" value="<%= _date(app.parseDate(item.get('dataNascimento'))).format('YYYY-MM-DD') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<div class="input-append bootstrap-timepicker-component">
							<input id="dataNascimento-time" type="text" class="timepicker-default input-small" value="<%= _date(app.parseDate(item.get('dataNascimento'))).format('h:mm A') %>" />
							<span class="add-on"><i class="icon-time"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="enderecoInputContainer" class="control-group">
					<label class="control-label" for="endereco">Endereco</label>
					<div class="controls inline-inputs">
						<textarea class="input-xlarge" id="endereco" rows="3"><%= _.escape(item.get('endereco') || '') %></textarea>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteAgenda_TelefonicaButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteAgenda_TelefonicaButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Agenda_Telefonica</button>
						<span id="confirmDeleteAgenda_TelefonicaContainer" class="hide">
							<button id="cancelDeleteAgenda_TelefonicaButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteAgenda_TelefonicaButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="agenda_TelefonicaDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Agenda_Telefonica
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="agenda_TelefonicaModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveAgenda_TelefonicaButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="agenda_TelefonicaCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newAgenda_TelefonicaButton" class="btn btn-primary">Add Agenda_Telefonica</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
