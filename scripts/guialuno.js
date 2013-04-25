


var salvarAluno=function(id){
    if (id=="salvaraluno"){
        form.send("controller/controlleraluno.php","post",function(loader,response){
            if (loader.xmlDoc.statusText=="OK"){
                alert("Alun@ Salvo com Sucesso");
                janela.close();
                grid.clearAll();
                grid.load("controller/controlleraluno.php?consultar=1");
            }else{
                alert("Erro salvando Alun@");
            }
        });
    }
}

function montarGUIAluno(layout){
grid=montarGrid(layout,"controller/controlleraluno.php?consultar=1",

 "ID,Nome,Matrícula,Turma,Telefone,E-mail,CPF,Data de Nascimento","5,30,15,5,10,15,10,10","ro,ro,ro,ro,ro,ro,ro,ro");
             var xmlToolbar='<toolbar><item id="novoaluno" type="button" text="Novo" img="new.gif" imgdis="new_dis.gif"/>\n\
 <item id="excluiraluno" type="button" text="Excluir" img="delete.gif" imgdis="delete_dis.gif"/> \n\
<item id="editaraluno" type="button" text="Editar" img="edit.gif" imgdis="edit_dis.gif"/></toolbar>';

toolbar=montarToolbar(xmlToolbar,layout);
toolbar.attachEvent("onClick",function(id){
    if (id=="novoaluno"){
        janela=montarJanela(layout,"Cadastro de Alunos");
        
        form=montarForm(janela,"controller/controlleraluno.php?form=1");
        form.attachEvent("onButtonClick",salvarAluno);
        layout.dhxWins._engineRedrawWindowSize(janela);
    }else if(id=="excluiraluno"){
        var idAluno=grid.getSelectedId();
        if (idAluno!=null){
            dhtmlxAjax.post("controller/controlleraluno.php","excluir=1&id="+idAluno,function(loader){
            if (loader.xmlDoc.statusText=="OK"){
                alert("Alun@ Excluida com Sucesso");
                grid.clearAll();
                grid.load("controller/controlleraluno.php?consultar=1");

            }else{
                alert("Erro excluindo Alun@");
            }
            });
        }else{
            alert('Selecione uma alun@ para excluir!');
        }
    }else if(id=="editaraluno"){
        var idAluno=grid.getSelectedId();
        if (idAluno!=null){
            janela=montarJanela(layout,"Cadastro de Aluno");
            form=montarForm(janela,"controller/controlleraluno.php?form=1&idindividuo="+idAluno);
            form.attachEvent("onButtonClick",salvarAluno);
        }else{
            alert('Selecione uma alun@ para editar');
        }
    }
});
}

