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

 var salvarClasse=function(id){
    if (id=="salvarclasse"){
        form.send("controller/controllerclasse.php","post",function(loader,response){
            if (response=="OK"){
                alert("Registro Salvo com Sucesso");
                janela.close();
                grid.clearAll();
                grid.load("controller/controllerclasse.php?consultar=1");

            }else{
                alert("Erro salvando classe");
            }
        });
    }
}

function montarGUIClasse(layout){
grid=montarGrid(layout,"controller/controllerclasse.php?consultar=1",

 "ID,Descrição da Classe","10,90","ro,ro");
             var xmlToolbar='<toolbar><item id="novaclasse" type="button" text="Novo" img="new.gif" imgdis="new_dis.gif"/>\n\
 <item id="excluirclasse" type="button" text="Excluir" img="delete.gif" imgdis="delete_dis.gif"/> \n\
<item id="editarclasse" type="button" text="Editar" img="edit.gif" imgdis="edit_dis.gif"/></toolbar>';

                 toolbar=montarToolbar(xmlToolbar,layout);
                 toolbar.attachEvent("onClick",function(id){
                     if (id=="novaclasse"){
                         janela=montarJanela(layout,"Cadastro de Classes");
                         form=montarForm(janela,"controller/controllerclasse.php?form=1");
                         form.attachEvent("onButtonClick",salvarClasse);
                     }else if(id=="excluirclasse"){
                         var idclasse=grid.getSelectedId();
                         if (idclasse!=null){
                             dhtmlxAjax.post("controller/controllerclasse.php","excluir=1&id="+idclasse,function(loader){
                             if (loader.xmlDoc.responseText=="OK"){
                                 alert("Classe Excluida com Sucesso");
                                 grid.clearAll();
                                 grid.load("controller/controllerclasse.php?consultar=1");

                             }else{
                                 alert("Erro excluindo classe");
                             }
                             });
                         }else{
                             alert('Selecione uma classe para excluir!');
                         }
                     }else if(id=="editarclasse"){
                         var idclasse=grid.getSelectedId();
                         if (idclasse!=null){
                             janela=montarJanela(layout,"Cadastro de Classes");
                             form=montarForm(janela,"controller/controllerclasse.php?form=1&idclasse="+idclasse);
                             form.attachEvent("onButtonClick",salvarClasse);
                         }else{
                             alert('Selecione uma classe para editar');
                         }
                     }
                 });
}