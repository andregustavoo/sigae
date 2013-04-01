/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function montarJanela(layout,titulo){
    var win=layout.dhxWins.createWindow("janela");
    win.setModal(true);
    win.setText(titulo);
    win.allowResize();
    win.setDimension(200,200);
    win.centerOnScreen();
    return win;
}
function montarForm(janela,formURL){
    var form=janela.attachForm();
    form.loadStruct(formURL);
    return form;
}
function montarGrid(layout,dataURL,cabecalhos,larguraColunas,tipoColunas){
    var grid=layout.cells("a").attachGrid();
    grid.setImagePath("imgs/");
    grid.setHeader(cabecalhos);
    grid.setInitWidthsP(larguraColunas);
    grid.load(dataURL);
    grid.setColTypes(tipoColunas);
    grid.init();
    
    return grid;
}
function montarToolbar(xml,layout){
    layout.cells("a").detachToolbar();
    var toolbar2=layout.cells("a").attachToolbar();
    toolbar2.setIconPath("imgs/");
    toolbar2.loadXMLString(xml);
    return toolbar2;
}

