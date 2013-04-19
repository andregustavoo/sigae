


var salvarAluno=function(id){
    if (id=="salvaraluno"){
        form.send("controller/controlleraluno.php","post",function(loader,response){
            if (response=="OK"){
                alert("Pessoa Salva com Sucesso");
                janela.close();
                grid.clearAll();
                grid.load("controller/controllerindividuo.php?consultar=1");
            }else{
                alert("Erro salvando Pessoa");
            }
        });
    }
}

function montarGUIIndividuo(layout){
grid=montarGrid(layout,"controller/controllerindividuo.php?consultar=1",

 "ID,Nome,Data de Nascimento,Telefone,E-mail,CPF,Classe","5,30,10,10,15,10,20","ro,ro,ro,ro,ro,ro,ro");
             var xmlToolbar='<toolbar><item id="novoindividuo" type="button" text="Novo" img="new.gif" imgdis="new_dis.gif"/>\n\
 <item id="excluirindividuo" type="button" text="Excluir" img="delete.gif" imgdis="delete_dis.gif"/> \n\
<item id="editarindividuo" type="button" text="Editar" img="edit.gif" imgdis="edit_dis.gif"/></toolbar>';

toolbar=montarToolbar(xmlToolbar,layout);
toolbar.attachEvent("onClick",function(id){
    if (id=="novoindividuo"){
        janela=montarJanela(layout,"Cadastro de Pessoas");
        
        form=montarForm(janela,"controller/controllerindividuo.php?form=1");
        form.attachEvent("onButtonClick",salvarIndividuo);
        layout.dhxWins._engineRedrawWindowSize(janela);
    }else if(id=="excluirindividuo"){
        var idindividuo=grid.getSelectedId();
        if (idindividuo!=null){
            dhtmlxAjax.post("controller/controllerindividuo.php","excluir=1&id="+idindividuo,function(loader){
            if (loader.xmlDoc.responseText=="OK"){
                alert("Pessoa Excluida com Sucesso");
                grid.clearAll();
                grid.load("controller/controllerindividuo.php?consultar=1");

            }else{
                alert("Erro excluindo pessoa");
            }
            });
        }else{
            alert('Selecione uma pessoa para excluir!');
        }
    }else if(id=="editarindividuo"){
        var idindividuo=grid.getSelectedId();
        if (idindividuo!=null){
            janela=montarJanela(layout,"Cadastro de Pessoas");
            form=montarForm(janela,"controller/controllerindividuo.php?form=1&idindividuo="+idindividuo);
            form.attachEvent("onButtonClick",salvarIndividuo);
        }else{
            alert('Selecione uma Pessoa para editar');
        }
    }
});
}

