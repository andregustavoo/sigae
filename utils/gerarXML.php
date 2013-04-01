<?php
    function gerarXMLGrid($tabela){
        $xml='';
        $xml=$xml.'<rows>';
        foreach($tabela as $linha){
             $xml= $xml . '<row id=\''.$linha[0].'\'>';
            for($i=0;$i<count($linha);$i++){
                if (isset($linha[$i]))
                  $xml = $xml . '<cell>'.$linha[$i].'</cell>';
            }

            $xml = $xml . '</row>';
        }
        $xml = $xml . '</rows>';
        return $xml;
    }
    
?>
