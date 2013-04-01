/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/*
 * 
 *As variáveis aqui utlizadas foram declaradas na página index.php
 *form - Representa um formulário
 *janela - Representa uma window
 *grid - Representa um Grid
 */

 var salvarGrupoAtividade=function(id){
    if (id=="salvargrupoatividade"){
        form.send("controller/controllergrupoatividade.php","post",function(loader,response){
            if (response=="OK"){
                alert("Grupo Atividade Salvo com Sucesso");
                janela.close();
                grid.clearAll();
                grid.load("controller/controllergrupoatividade.php?consultar=1");

            }
        });
    }
}

function montarGUIGrupoAtividade(layout){
grid=montarGrid(layout,"controller/controllergrupoatividade.php?consultar=1",

 "ID,Descrição","10,90","ro,ro");
             var xmlToolbar='<toolbar><item id="novogrupoatividade" type="button" text="Novo" img="new.gif" imgdis="new_dis.gif"/>\n\
 <item id="excluirgrupoatividade" type="button" text="Excluir" img="delete.gif" imgdis="delete_dis.gif"/> \n\
<item id="editargrupoatividade" type="button" text="Editar" img="edit.gif" imgdis="edit_dis.gif"/></toolbar>';

toolbar=montarToolbar(xmlToolbar,layout);
toolbar.attachEvent("onClick",function(id){
    if (id=="novogrupoatividade"){
        janela=montarJanela(layout,"Cadastro de Grupos de Atividade");
        form=montarForm(janela,"controller/controllergrupoatividade.php?form=1");
        form.attachEvent("onButtonClick",salvarGrupoAtividade);
    }else if(id=="excluirgrupoatividade"){
        var idgrupo=grid.getSelectedId();
        if (idgrupo!=null){
            dhtmlxAjax.post("controller/controllergrupoatividade.php","excluir=1&id="+idgrupo,function(loader){
            if (loader.xmlDoc.responseText=="OK"){
                alert("Grupo de Atividade Excluido com Sucesso");
                grid.clearAll();
                grid.load("controller/controllergrupoatividade.php?consultar=1");

            }else{
                alert("Erro excluindo classe");
            }
            });
        }else{
            alert('Selecione um Grupo de Stividade para excluir!');
        }
    }else if(id=="editargrupoatividade"){
        var idgrupo=grid.getSelectedId();
        if (idgrupo!=null){
            janela=montarJanela(layout,"Cadastro de Grupo de Atividades");
            form=montarForm(janela,"controller/controllergrupoatividade.php?form=1&idgrupoatividade="+idgrupo);
            form.attachEvent("onButtonClick",salvarGrupoAtividade);
        }else{
            alert('Selecione um Grupo de Atividade para editar');
        }
    }
});
}
