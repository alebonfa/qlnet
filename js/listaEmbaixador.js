Ext.define('Cadastro',{
        extend: 'Ext.data.Model',

        fields: [
            {name: 'ID', type: 'int'},
            {name: 'nome', type: 'string'},
            {name: 'email', type: 'string'}
        ]
    });

var store = Ext.create('Ext.data.Store',{
        autoLoad: true,
        
        proxy: {
            type: 'ajax',
            url: 'php/getCadastros.php',
            
            reader: {
                type: 'json', //json ou xml
                root: 'cadastros',
                //record: 'contato'
            }
        },
        model: 'Cadastro'
        
    })

Ext.onReady(function() {
    
    var grid = new Ext.grid.GridPanel({
        store: store,
        columns: [
            { id: 'id', header: "Id", width: 30, sortable: true, dataIndex: 'id' },
            { id:'name', header: "Nome", width: 200, sortable: true, dataIndex: 'nome' },
            { id:'email', header: "E-mail", width: 200, sortable: true, dataIndex: 'email' }
        ],
        /*stripeRows: true,*/
        autoExpandColumn: 'name',
        title: 'Cadastro de Embaixadores'
    });

    grid.render('grid');
});