/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

 var salvarFuncao=function(id){
    if (id=="salvarfuncao"){
        form.send("controller/controllerfuncao.php","post",function(loader,response){
            if (response=="OK"){
                alert("Registro Salvo com Sucesso");
                janela.close();
                grid.clearAll();
                grid.load("controller/controllerfuncao.php?consultar=1");

            }else{
                alert("Erro salvando Função");
            }
        });
    }
}

function montarGUIFuncao(layout){
grid=montarGrid(layout,"controller/controllerfuncao.php?consultar=1",

 "ID,Descrição da Função,Setor","10,60,30","ro,ro,ro");
             var xmlToolbar='<toolbar><item id="novafuncao" type="button" text="Novo" img="new.gif" imgdis="new_dis.gif"/>\n\
 <item id="excluirfuncao" type="button" text="Excluir" img="delete.gif" imgdis="delete_dis.gif"/> \n\
<item id="editarfuncao" type="button" text="Editar" img="edit.gif" imgdis="edit_dis.gif"/></toolbar>';

                 toolbar=montarToolbar(xmlToolbar,layout);
                 toolbar.attachEvent("onClick",function(id){
                     if (id=="novafuncao"){
                         janela=montarJanela(layout,"Cadastro de Funções");
                         form=montarForm(janela,"controller/controllerfuncao.php?form=1");
                         form.attachEvent("onButtonClick",salvarFuncao);
                     }else if(id=="excluirfuncao"){
                         var idfuncao=grid.getSelectedId();
                         if (idfuncao!=null){
                             dhtmlxAjax.post("controller/controllerfuncao.php","excluir=1&id="+idfuncao,function(loader){
                             if (loader.xmlDoc.responseText=="OK"){
                                 alert("Função Excluida com Sucesso");
                                 grid.clearAll();
                                 grid.load("controller/controllerfuncao.php?consultar=1");
                             }else{
                                 alert("Erro excluindo Função");
                             }
                             });
                         }else{
                             alert('Selecione uma Função para excluir!');
                         }
                     }else if(id=="editarfuncao"){
                         var idfuncao=grid.getSelectedId();
                         if (idfuncao!=null){
                             janela=montarJanela(layout,"Cadastro de Funções");
                             form=montarForm(janela,"controller/controllerfuncao.php?form=1&idfuncao="+idfuncao);
                             form.attachEvent("onButtonClick",salvarFuncao);
                         }else{
                             alert('Selecione uma Função para editar');
                         }
                     }
                 });
}
