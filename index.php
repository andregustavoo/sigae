<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script type="text/javascript" src="dhtmlx.js"></script>
        <script type="text/javascript" src="types/ftypes.js"></script>
        <script type="text/javascript" src="scripts/gui.js"></script>
        <script type="text/javascript" src="scripts/guiclasse.js"></script>
        <script type="text/javascript" src="scripts/guifuncao.js"></script>
        <script type="text/javascript" src="scripts/guigrupoatividade.js"></script>
        <script type="text/javascript" src="scripts/guiindividuo.js"></script>
        <script type="text/javascript" src="scripts/guialuno.js"></script>
        <script type="text/javascript" src="scripts/guiusuario.js"></script>
        <link rel="STYLESHEET" type="text/css" href="dhtmlx.css"/>
        <link rel="STYLESHEET" type="text/css" href="types/ftypes.css"/>
        <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
        <script type="text/javascript">
            //TODO Modularizar melhor
            var layout, grid, menu, toolbar,maintoolbar;
            var gl_view_type = "dlist";
            var gl_view_bg = "";
            var form,janela;
            
            function doOnLoad(){
                    
                 layout = new dhtmlXLayoutObject(document.body, "1C");
                 layout.cells("a").setText("SIGAE");
                  layout.dhxWins.setImagePath("imgs/");
                 menu=layout.attachMenu();
                 menu.loadXML("xml/menu.xml");
                 menu.attachEvent("onClick",function(id){
                    if (id=="classe"){
                        montarGUIClasse(layout);
                        layout.cells("a").setText("SIGAE - Classe");
                    }else if(id=="grupoatividade"){
                        montarGUIGrupoAtividade(layout);
                         layout.cells("a").setText("SIGAE - Grupo de Atividade");
                    }else if(id=="funcao"){
                        montarGUIFuncao(layout);
                         layout.cells("a").setText("SIGAE - Função");
                    }else if(id=="cadastroindividuo"){
                        montarGUIIndividuo(layout);
                         layout.cells("a").setText("SIGAE - Pessoa");
                    }else if(id=="cadastroaluno"){
                        montarGUIAluno(layout);
                        layout.cells("a").setText("SIGAE - Aluno");
                    }else if(id=="novousuario"){
                        montarGUIUsuario(layout);
                        layout.cells("a").setText("SIGAE - Usuário");
                    }
                 });   
                 maintoolbar=layout.attachToolbar();
                 maintoolbar.setIconPath("imgs/");
                 maintoolbar.loadXML("xml/toolbarprincipal.xml");
            }
           
        </script>
    </head>
    
    <body onload="doOnLoad();">
       
        <div id="form"> </div>
        <div id="grid"></div>
       
    </body>
</html>
