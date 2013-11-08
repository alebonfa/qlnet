Ext.onReady(function() {

	var tipoDestinatario = Ext.create('Ext.data.Store', {
		fields: ['id', 'nome'],
		data: [
			{"id": 1, "nome": "Alunos"},
			{"id": 2, "nome": "Palestrantes"},
			{"id": 3, "nome": "Colaboradores"}
		]
	});

	var filt_destinatario = Ext.create('Ext.form.ComboBox', {
		fieldLabel: 'Destinatários',
		store: tipoDestinatario,
		queryMode: 'local',
		displayField: 'nome',
		valueField: 'id',
		allowBlank: false,
		value: 1,
		forceSelection: true,
		renderTo: qlsms_filtro01,
		listeners: {
			change: function() {
				if (this.getValue() === 1) {
					pnlFiltroPalestrantes.hide();
					pnlFiltroColaboradores.hide();
					pnlFiltroAlunos.insert(0, filt_curso);
					pnlFiltroAlunos.insert(0, filt_cidade);
					pnlFiltroAlunos.insert(0, filt_polo);
					pnlFiltroAlunos.insert(0, filt_uf);
					pnlFiltroAlunos.insert(0, filt_df);
					pnlFiltroAlunos.insert(0, filt_di);
					pnlFiltroAlunos.insert(0, filt_nome);
					pnlFiltroAlunos.show();
				} else if (this.getValue() === 2) {
					pnlFiltroAlunos.hide();
					pnlFiltroColaboradores.hide();
					pnlFiltroPalestrantes.insert(0, filt_cidade);
					pnlFiltroPalestrantes.insert(0, filt_tema);
					pnlFiltroPalestrantes.insert(0, filt_uf);
					pnlFiltroPalestrantes.insert(0, filt_area);
					pnlFiltroPalestrantes.insert(0, filt_nome);
					pnlFiltroPalestrantes.show();
				} else if (this.getValue() === 3) {
					pnlFiltroAlunos.hide();
					pnlFiltroPalestrantes.hide();
					pnlFiltroColaboradores.insert(0, filt_cidade);
					pnlFiltroColaboradores.insert(0, filt_uf);
					pnlFiltroColaboradores.insert(0, filt_polo);
					pnlFiltroColaboradores.insert(0, filt_nome);
					pnlFiltroColaboradores.show();
				}
			}
		}

	});


	var areaAtuacao = Ext.create('Ext.data.Store', {
		fields: ['id', 'nome'],
		data: [
			{"id": 1, "nome": "Pequenos Animais"},
			{"id": 2, "nome": "Grandes Animais"},
			{"id": 3, "nome": "Selvagens e Exóticos"},
			{"id": 4, "nome": "Saúde Pública"}
		]
	});

	Ext.define('UFs', {
		extend: 'Ext.data.Model',

		fields: [
			{name: 'estado_id', type: 'int'},
			{name: 'estado_sigla', type: 'string'},
			{name: 'estado_nome', type: 'string'}
		]

	});

	var ds_uf = Ext.create('Ext.data.Store', {
		storeID: 'UFsStore',
		model: 'UFs',
		autoLoad: true,
		proxy: {
			type: 'ajax',
			url: 'php/lista_ufs.php',
			reader: {
				type: 'json', //json ou xml
				root: 'ufs',
				fields: [
					{name: 'estado_id', type: 'int', mapping: 'estado_id'},
					{name: 'estado_sigla', type: 'string', mapping: 'estado_sigla'},
					{name: 'estado_nome', type: 'string', mapping: 'estado_nome'}
				]
			}
		}

	});

	Ext.define('Cidades', {
		extend: 'Ext.data.Model',

		fields: [
			{name: 'localidade_id', type: 'int'},
			{name: 'estado_id', type: 'int'},
			{name: 'estado_sigla', type: 'string'},
			{name: 'localidade_nome', type: 'string'}
		]

	});

	var ds_cidade = Ext.create('Ext.data.Store', {
		storeID: 'CidadesStore',
		model: 'Cidades',
		autoLoad: true,
		proxy: {
			type: 'ajax',
			url: 'php/lista_cidades.php',
			reader: {
				type: 'json', //json ou xml
				root: 'cidades',
				fields: [
					{name: 'localidade_id', type: 'string', mapping: 'localidade_id'},
					{name: 'estado_id', type: 'int', mapping: 'estado_id'},
					{nome: 'estado_sigla', type: 'string', mapping: 'estado_sigla'},
					{name: 'localidade_nome', type: 'string', mapping: 'localidade_nome'}
				]
			}
		}

	});

	Ext.define('Polos', {
		extend: 'Ext.data.Model',

		fields: [
			{name: 'id', type: 'int'},
			{name: 'sisquali_id', type: 'string'},
			{name: 'nome', type: 'string'}
		]

	});

	var ds_polo = Ext.create('Ext.data.Store', {
		storeID: 'PolosStore',
		model: 'Polos',
		autoLoad: true,
		fields: ['localidade_nome'],
		proxy: {
			type: 'ajax',
			url: 'php/lista_polos.php',
			reader: {
				type: 'json', //json ou xml
				root: 'polos',
				fields: [
					{name: 'id', type: 'int', mapping: 'id'},
					{name: 'sisquali_id', type: 'string', mapping: 'sisquali_id'},
					{name: 'nome', type: 'string', mapping: 'nome'}
				]
			}
		}

	});

	Ext.define('Cursos', {
		extend: 'Ext.data.Model',

		fields: [
			{name: 'id', type: 'int'},
			{name: 'sisquali_id', type: 'string'},
			{name: 'nome', type: 'string'}
		]

	});

	var ds_curso = Ext.create('Ext.data.Store', {
		storeID: 'CursosStore',
		model: 'Cursos',
		autoLoad: true,
		proxy: {
			type: 'ajax',
			url: 'php/lista_Cursos.php',
			reader: {
				type: 'json', //json ou xml
				root: 'cursos',
				fields: [
					{name: 'id', type: 'int', mapping: 'id'},
					{name: 'sisquali_id', type: 'string', mapping: 'sisquali_id'},
					{name: 'nome', type: 'string', mapping: 'nome'}
				]
			}
		}

	});

	Ext.define('Temas', {
		extend: 'Ext.data.Model',

		fields: [
			{name: 'id', type: 'int'},
			{name: 'sisquali_id', type: 'string'},
			{name: 'nome', type: 'string'}
		]

	});

	var ds_tema = Ext.create('Ext.data.Store', {
		storeID: 'TemasStore',
		model: 'Temas',
		autoLoad: true,
		proxy: {
			type: 'ajax',
			url: 'php/lista_Temas.php',
			reader: {
				type: 'json', //json ou xml
				root: 'temas',
				fields: [
					{name: 'id', type: 'int', mapping: 'id'},
					{name: 'sisquali_id', type: 'string', mapping: 'sisquali_id'},
					{name: 'nome', type: 'string', mapping: 'nome'}
				]
			}
		}

	});

	Ext.define('Destinatarios', {
		extend: 'Ext.data.Model',

		fields: [
			{name: 'nome', type: 'string'},
			{name: 'cidade', type: 'string'},
			{name: 'uf', type: 'string'},
			{name: 'email', type: 'string'},
			{name: 'telefone', type: 'string'},
			{name: 'vencimentos', type: 'string'}
		]

	});

	var ds_destinatario = Ext.create('Ext.data.Store', {
		storeID: 'DestinatariosStore',
		model: 'Destinatarios',
		autoLoad: true,
		proxy: {
			type: 'ajax',
			url: 'php/lista_destinatarios.php',
			extraParams: {
				tipo_destinatario: 1,
				data_inicio: '',
				data_fim: '',
				polo: '',
				curso: ''
			},
			reader: {
				type: 'json', //json ou xml
				root: 'destinatarios',
				fields: [
					{name: 'nome', type: 'string', mapping: 'nome'},
					{name: 'cidade', type: 'string', mapping: 'cidade'},
					{name: 'uf', type: 'string', mapping: 'uf'},
					{name: 'email', type: 'string', mapping: 'email'},
					{name: 'telefone', type: 'string', mapping: 'telefone'},
					{name: 'vencimentos', typy: 'string', mapping: 'vencimentos'}
				]
			}
		}
	});

	var ds_remetente = Ext.create('Ext.data.Store', {
		autoLoad: false,
		fields: [
			{name: 'nome', type: 'string'},
			{name: 'cidade', type: 'string'},
			{name: 'uf', type: 'string'},
			{name: 'email', type: 'string'},
			{name: 'telefone', type: 'string'},
			{name: 'vencimentos', type: 'string'}
		]
	});

	Ext.require("Ext.form.field.ComboBox", function () {
	    Ext.override(Ext.form.field.ComboBox, {
	        beforeBlur: function () {
	            if (this.getRawValue().length === 0) {
	                this.lastSelection = [];
	            }
	            this.callOverridden();
	        }
	    });
	});

	var filt_nome = Ext.create('Ext.form.field.Text', {
		fieldLabel: 'Nome',
		columnWidth: .50,
		style: 'margin-right:50px;'
	});

	var filt_di = Ext.create('Ext.form.field.Date', {
		fieldLabel: 'Data Inicial',
		columnWidth: .25,
		format: 'd/m/Y',
		submitFormat: 'Y-m-d',
		style: 'margin-right:50px;',
	});

	var filt_df = Ext.create('Ext.form.field.Date', {
		fieldLabel: 'Data Final',
		columnWidth: .25,
		format: 'd/m/Y',
		submitFormat: 'Y-m-d',
		style: 'margin-right:50px;',
	});

	var filt_uf = Ext.create('Ext.form.field.ComboBox', {
		fieldLabel: 'UF',
		columnWidth: .50,
		style: 'margin-right:50px;',
		store: ds_uf,
		displayField: 'estado_nome',
		valueField: 'estado_sigla',
		emptyText: 'Escolha um Estado...',
		minChars: 1,
		queryMode: 'local',
		forceSelection: true,
		typeAhead: true,
		enableKeyEvents: true,
		listeners: {
			blur: function() {
				ds_cidade.clearFilter();
				if(this.getRawValue() !== '') {
					ds_cidade.filter("estado_sigla", this.getValue());	
				}
			}
		}
	});

	filt_uf.focus();

	var filt_polo = Ext.create('Ext.form.field.ComboBox', {
		fieldLabel: 'Polo',
		columnWidth: .50,
		store: ds_polo,
		displayField: 'nome',
		valueField: 'sisquali_id',
		emptyText: 'Escolha um Polo...',
		minChars: 1,
		queryMode: 'local',
		forceSelection: true,
		typeAhead: true
	});

	var filt_cidade = Ext.create('Ext.form.field.ComboBox', {
		fieldLabel: 'Cidade',
		columnWidth: .50,
		style: 'margin-right:50px;',
		store: ds_cidade,
		displayField: 'localidade_nome',
		valueField: 'localidade_id',
		emptyText: 'Escolha uma Cidade...',
		minChars: 1,
		queryMode: 'local',
		forceSelection: true,
		typeAhead: true,
		enableKeyEvents: true,
		listeners: {
			keyup: function() {
				ds_cidade.removeFilter('filt_ln');
				if (this.getRawValue() !== '') {
					ds_cidade.addFilter({
						id: 'filt_ln',
						property: 'localidade_nome', 
						value: this.getValue()
					});
				}
			}
		}
	});

	var filt_curso = Ext.create('Ext.form.field.ComboBox', {
		fieldLabel: 'Curso',
		columnWidth: .50,
		store: ds_curso,
		displayField: 'nome',
		valueField: 'sisquali_id',
		emptyText: 'Escolha um Curso...',
		minChars: 1,
		queryMode: 'local',
		forceSelection: true,
		typeAhead: true
	});

	function filtrosComuns() {
		ds_destinatario.clearFilter();
		if (filt_uf.getRawValue() !== '') {
			ds_destinatario.addFilter({
				id: 'filt_uf',
				property: 'uf',
				value: filt_uf.getValue()
			})
		}
		if (filt_nome.getRawValue() !== '') {
			ds_destinatario.addFilter({
				id: 'filt_nome',
				property: 'nome',
				value: filt_nome.getRawValue()
			})
		}
		if (filt_cidade.getRawValue() !== '') {
			ds_destinatario.addFilter({
				id: 'filt_cidade',
				property: 'cidade',
				value: filt_cidade.getRawValue()
			})
		}
	}

	var pnlFiltroAlunos = Ext.create('Ext.form.Panel', {
		title: 'Filtros',
		frame: false,
		renderTo: 'qlsms_filtro02',
		width: 1160,
		layout: 'column',
		border: false,
		bodyPadding: 20,
		collapsible: true,
		buttons: [{
			text: 'Filtrar',
			handler: function() {
				ds_destinatario.load({
					params: {
						'tipo_destinatario': filt_destinatario.getValue(),
						'data_inicio': filt_di.getValue(),
						'data_fim': filt_df.getValue(),
						'polo': filt_polo.getValue(),
						'curso': filt_curso.getValue()
					}
				});
				filtrosComuns();
			}
		}]
	});

	pnlFiltroAlunos.insert(0, filt_curso);
	pnlFiltroAlunos.insert(0, filt_cidade);
	pnlFiltroAlunos.insert(0, filt_polo);
	pnlFiltroAlunos.insert(0, filt_uf);
	pnlFiltroAlunos.insert(0, filt_df);
	pnlFiltroAlunos.insert(0, filt_di);
	pnlFiltroAlunos.insert(0, filt_nome);

	var filt_area = Ext.create('Ext.form.ComboBox', {
		fieldLabel: 'Área de Atuação',
		columnWidth: .50,
		store: areaAtuacao,
		queryMode: 'local',
		displayField: 'nome',
		valueField: 'id',
		emptyText: 'Escolha uma Área...',
		minChars: 1,
		typeAhead: true
	});

	var filt_tema = Ext.create('Ext.form.field.ComboBox', {
		fieldLabel: 'Temática',
		columnWidth: .50,
		store: ds_tema,
		queryMode: 'local',
		displayField: 'nome',
		valueField: 'id',
		emptyText: 'Escolha uma Temática...',
		minChars: 1,
		forceSelection: true,
		typeAhead: true
	});

	var pnlFiltroPalestrantes = Ext.create('Ext.form.Panel', {
		title: 'Filtros',
		frame: false,
		renderTo: 'qlsms_filtro02',
		width: 1160,
		layout: 'column',
		border: false,
		bodyPadding: 20,
		collapsible: true,
		items: [filt_tema
		],
		buttons: [{
			text: 'Filtrar',
			handler: function() {
				ds_destinatario.load({
					params: {
						'tipo_destinatario': filt_destinatario.getValue(),
						'data_inicio': '',
						'data_fim': '',
						'polo': '',
						'curso': ''
					}
				});
				filtrosComuns();
			}
		}]
	});

	pnlFiltroPalestrantes.hide();

	var pnlFiltroColaboradores = Ext.create('Ext.form.Panel', {
		title: 'Filtros',
		renderTo: 'qlsms_filtro02',
		width: 1160,
		layout: 'column',
		frame: false,
		border: false,
		bodyPadding: 20,
		collapsible: true,
		buttons: [{
			text: 'Filtrar',
			handler: function() {
				ds_destinatario.load({
					params: {
						'tipo_destinatario': filt_destinatario.getValue(),
						'data_inicio': '',
						'data_fim': '',
						'polo': '',
						'curso': ''
					}
				});
				filtrosComuns();
			}
		}]
	});

	pnlFiltroColaboradores.hide();

	var grdRemetentes = Ext.create('Ext.grid.Panel', {
		id: 'grdRemetentes',
		store: ds_remetente,
		columnWidth: 1,
		columns: [
			{ text: 'Nome', dataIndex: 'nome', width: 380},
			{ text: 'Cidade', dataIndex: 'cidade', width: 300},
			{ text: 'UF', dataIndex: 'uf', width: 50},
			{ text: 'e-mail', dataIndex: 'email', width: 240},
			{ text: 'Telefone', dataIndex: 'telefone', width: 100}
		],
		height: 200,
		width: 1120
	});

	var pnlListaRemetentes = Ext.create('Ext.form.Panel', {
		title: 'Remetentes Selecionados',
		renderTo: 'qlsms_lista02',
		width: 1160,
		layout: 'column',
		frame: false,
		border: false,
		bodyPadding: 20,
		collapsible: true,
		collapsed: true,
		items: [
			grdRemetentes
		],
		buttons: [{
			text: 'Limpar',
			handler: function() {
				Ext.MessageBox.confirm('Limpar a Lista','Deseja Remover todos os Remetentes Selecionados?', function(btn) {
					if(btn === 'yes') {
						ds_remetente.removeAll();						
					}
				});
			}
		}]
	});

	var grdDestinatarios = Ext.create('Ext.grid.Panel', {
		store: ds_destinatario,
		columnWidth: 1,
		selType: 'checkboxmodel',
		columns: [
			{ text: 'Nome', dataIndex: 'nome', width: 380},
			{ text: 'Cidade', dataIndex: 'cidade', width: 300},
			{ text: 'UF', dataIndex: 'uf', width: 50},
			{ text: 'e-mail', dataIndex: 'email', width: 240},
			{ text: 'Telefone', dataIndex: 'telefone', width: 100}
		],
		height: 400,
		width: 1120
	});

	var pnlListaDestinatarios = Ext.create('Ext.form.Panel', {
		title: 'Destinatários',
		renderTo: 'qlsms_lista01',
		width: 1160,
		layout: 'column',
		frame: false,
		border: false,
		bodyPadding: 20,
		collapsible: true,
		items: [
			grdDestinatarios
		],
		buttons: [{
			text: 'Selecionar',
			handler: function() {
				var s = grdDestinatarios.getSelectionModel().getSelection();
				console.log(s);
				Ext.each(s, function(item) {
					ds_remetente.add(item)
				});
				grdDestinatarios.getSelectionModel().deselectAll();
			}
		}]
	});

	var templateEmail = Ext.create('Ext.data.Store', {
		fields: ['id', 'nome'],
		data: [
			{"id": 1, "nome": "Mensagem Personalizada"},
			{"id": 2, "nome": "Carta de Cobrança"}
		]
	});

	var modeloEmail = Ext.create('Ext.form.ComboBox', {
		fieldLabel: 'Modelo',
		store: templateEmail,
		queryMode: 'local',
		displayField: 'nome',
		valueField: 'id',
		allowBlank: false,
		value: 1,
		forceSelection: true,
		columnWidth: 0.5,
		listeners: {
			change: function() {
				if (this.getValue() === 1) {
					corpoEmail.setVisible(true);
					pnlOperacaoEmail.setHeight(600);
				} else if (this.getValue() === 2) {
					corpoEmail.setVisible(false);
					pnlOperacaoEmail.setHeight(120);
				};
			}
		}

	});

	var corpoEmail = Ext.create('Ext.form.HtmlEditor', {
		columnWidth: 1,
		height: 480
	});

	var pnlOperacaoEmail = Ext.create('Ext.form.Panel', {
		title: 'e-mail',
		renderTo: 'qlsms_operacao',
		width: 1160,
		height: 600,
		layout: 'column',
		frame: false,
		collapsible: true,
		collapsed: true,
		bodyPadding: 20,
		items: [
			modeloEmail,
			corpoEmail
		],
		buttons: [{
			text: 'Enviar',
			handler: function() {
				ds_remetente.each(function(rec) {
					if (modeloEmail.getValue() === 1) {
						Ext.Ajax.request({
							method: 'POST',
							url: 'php/send_email.php',
							params: {
								'nome': rec.get('nome'),
								'email': rec.get('email'),
								'vencimentos': '01/01/2013, 01/02/2013'
							},
							success: function() {
								alert('E-mail enviado!');
							},
							failure: function() {
								alert('Algo Falhou!');
							}
						})
					} else if (modeloEmail.getValue() === 2) {
						Ext.Ajax.request({
							method: 'POST',
							url: 'php/send_email_cobranca01.php',
							params: {
								'nome': rec.get('nome'),
								'email': rec.get('email'),
								'vencimentos': rec.get('vencimentos')
							},
							success: function() {
								alert('E-mail enviado!');
							},
							failure: function() {
								alert('Algo Falhou!');
							}
						})
					}
				})
			}
		}]
	});

});

