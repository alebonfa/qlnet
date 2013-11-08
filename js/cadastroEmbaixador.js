Ext.require([
    'Ext.form.*'
]);

Ext.onReady(function() {
    /*
     * define a User model
     */
    Ext.define('User', {
        extend: 'Ext.data.Model',
        fields: [
            {name: 'nome', type: 'string'},
            {name: 'email', type: 'string'}
        ],
        validations: [
            {type: 'length', field: 'nome', min: 2},
            {type: 'length', field: 'email', min: 2}
        ]
    });

    var required = '<span style="color:red;font-weight:bold" data-qtip="Required">*</span>';

    var formPanel = Ext.create('Ext.form.Panel', {
        frame       : true,
        title       : 'Cadastro de Embaixadores',
        url         : 'php/gravaCadastro.php',
        method      : 'POST',
        bodyPadding : 5,

        fieldDefaults: {
            labelAlign: 'left',
            labelWidth: 90,
            anchor: '99%',
            allowBlank: false,
            msgTarget: 'side'
        },

        //model: "User",

        items: [{
            xtype: 'textfield',
            name: 'nome',
            fieldLabel: 'Nome',
            //value: 'Digite seu nome',
            afterLabelTextTpl: required,
            tooltip: 'Digite o nome'
            
        },{
            xtype: 'textfield',
            name: 'email',
            fieldLabel: 'E-mail',
            //value: 'email@seunome.com',
            tooltip: 'Digite o e-mail',
            afterLabelTextTpl: required,
            vtype:'email'

        },{
            xtype: "radiogroup",
            fieldLabel: "Acesso",
            id: "grupoAcesso",
            defaults: {xtype: "radio",name: "acesso"},
            items: [
                {
                    boxLabel: "Administrador",
                    inputValue: "1",
                },
                {
                    boxLabel: "Coordenador",
                    inputValue: "2",
                },
                {
                    boxLabel: "Embaixador",
                    inputValue: "3",
                }
            ]
        }],

        validations: [
            {type: 'presence', field: 'nome', message: 'You have to enter a name, silly'},
        ],

        buttons: [{
        text: 'Salvar',
        handler: function() {
            // The getForm() method returns the Ext.form.Basic instance:
            var form = this.up('form').getForm();
            if (form.isValid()) {
                // Show a waiting message box
                Ext.MessageBox.show({
                    msg: 'Sending and processing the data...',
                    title: 'Please wait',
                    progressText: 'Sending and processing the data...',
                    progress: true,
                    closable: false,
                    width:300,
                    wait:true,
                    waitConfig: {interval:200}
                });
                // Submit the Ajax request and handle the response
                form.submit({
                    success: function(form, action) {
                       Ext.Msg.alert('Sucesso', 'Cadastro Realizado com Sucesso.');
                    },
                    failure: function(form, action) {
                        Ext.Msg.alert('Falha', action.result ? action.result.message : 'No response');
                    }
                });
            }
        }
    }]
    });

    formPanel.render('form-ct');

});
