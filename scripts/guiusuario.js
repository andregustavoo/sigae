var salvarUsuario=function(id){
    if (id=="salvarusuario"){
        form.send("controller/controllerusuario.php","post",function(loader,response){
            if (response=="OK"){
                alert("Usuário Salvo com Sucesso");
                janela.close();
                grid.clearAll();
                grid.load("controller/controllerusuario.php?consultar=1");
            }else{
                alert("Erro salvando Usuário");
            }
        });
    }
}

function montarGUIUsuario(layout){
grid=montarGrid(layout,"controller/controllerusuario.php?consultar=1",

 "ID,Nome,Data de Nascimento,Telefone,E-mail,CPF,Classe,Login,Administrador,Função","5,15,10,10,10,10,10,10,10,10","ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
             var xmlToolbar='<toolbar><item id="novousuario" type="button" text="Novo" img="new.gif" imgdis="new_dis.gif"/>\n\
 <item id="excluirusuario" type="button" text="Excluir" img="delete.gif" imgdis="delete_dis.gif"/> \n\
<item id="editarusuario" type="button" text="Editar" img="edit.gif" imgdis="edit_dis.gif"/></toolbar>';

toolbar=montarToolbar(xmlToolbar,layout);
toolbar.attachEvent("onClick",function(id){
    if (id=="novousuario"){
        janela=montarJanela(layout,"Cadastro de Usuários");
        
        form=montarForm(janela,"controller/controllerusuario.php?form=1");
        form.attachEvent("onButtonClick",salvarUsuario);
        layout.dhxWins._engineRedrawWindowSize(janela);
    }else if(id=="excluirusuario"){
        var idusuario=grid.getSelectedId();
        if (idusuario!=null){
            dhtmlxAjax.post("controller/controllerusuario.php","excluir=1&id="+idusuario,function(loader){
            if (loader.xmlDoc.responseText=="OK"){
                alert("Usuário Excluido com Sucesso");
                grid.clearAll();
                grid.load("controller/controllerusuario.php?consultar=1");

            }else{
                alert("Erro excluindo usuário");
            }
            });
        }else{
            alert('Selecione um usuário para excluir!');
        }
    }else if(id=="editarusuario"){
        var idusuario=grid.getSelectedId();
        if (idusuario!=null){
            janela=montarJanela(layout,"Cadastro de Usuário");
            form=montarForm(janela,"controller/controllerusuario.php?form=1&idusuario="+idusuario);
            form.attachEvent("onButtonClick",salvarUsuario);
        }else{
            alert('Selecione um Usuário para editar');
        }
    }
});
}
