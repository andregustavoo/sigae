/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function montarJanela(layout,titulo){
    //layout.dhxWins.enableAutoViewport(false);
    var win=layout.dhxWins.createWindow("janela");
    win.setModal(true);
    win.setText(titulo);
    //win.allowResize();
    //win.setDimension(400,350);
    //win.center();
    return win;
}
function montarForm(janela,formURL){
    var form=janela.attachForm();
    form.attachEvent("onXLS", function() {
       dhtmlx.message({text:"Carregando...",id:"mensagem"});
    });
    form.attachEvent("onXLE", function() {
        dhtmlx.message.hide("mensagem");
    });
    form.loadStruct(formURL);
    var largura=300;
    var altura=350;
    janela.setDimension(largura,altura);
    janela.center();
    return form;
}
function montarGrid(layout,dataURL,cabecalhos,larguraColunas,tipoColunas){
    var grid=layout.cells("a").attachGrid();
    grid.setImagePath("imgs/");
    grid.setHeader(cabecalhos);
    grid.setInitWidthsP(larguraColunas);
    grid.attachEvent("onXLS", function() {
       dhtmlx.message({text:"Carregando...",id:"mensagem"});
    });
    grid.attachEvent("onXLE", function() {
        dhtmlx.message.hide("mensagem");
    });
    grid.load(dataURL);
    grid.setColTypes(tipoColunas);
    grid.init();
    var filter='';
    for(var i=0;i<grid.getColumnsNum();i++){
        filter=filter+'#text_filter';
        if(i!=grid.getColumnsNum()-1){
            filter=filter+','
        }
    }
    grid.attachHeader(filter);
    
    
    return grid;
}
function montarToolbar(xml,layout){
    layout.cells("a").detachToolbar();
    var toolbar2=layout.cells("a").attachToolbar();
    toolbar2.setIconPath("imgs/");
    toolbar2.loadXMLString(xml);
    return toolbar2;
}

