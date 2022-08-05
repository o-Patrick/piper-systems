<?php

function validador($cnpj){
    if(strlen($cnpj) <> 14 || $cnpj == "00000000000000"){
        return false;
    } else{
        function parte1($cnpj){
            $multCnpj  = 1;      // multiplicação do cnpj
            $somaCnpj  = 0;      // soma do cnpj
            $restoCnpj = 0;

            $i = 11;    // índice no vetor
            $m = 2;     // multiplicador
            for($i; $i >= 0; $i--){
                $multCnpj = $cnpj[$i] * $m;
                $m++;
                if($m > 9){
                    $m = 2;
                }
                $somaCnpj += $multCnpj;
            }
            $restoCnpj = $somaCnpj % 11;

            if($restoCnpj != $cnpj[12]){
                $restoCnpj = 11 - $restoCnpj;
            }

            return $restoCnpj;
        } // parte 1

        function parte2($cnpj){
            $multCnpj  = 1;      // multiplicação do cnpj
            $somaCnpj  = 0;      // soma do cnpj
            $restoCnpj = 0;

            $i = 12;    // índice no vetor
            $m = 2;     // multiplicador
            for($i; $i >= 0; $i--){
                $multCnpj = $cnpj[$i] * $m;
                $m++;
                if($m > 9){
                    $m = 2;
                }
                $somaCnpj += $multCnpj;
            }
            $restoCnpj = $somaCnpj % 11;

            if($restoCnpj != $cnpj[13]){
                $restoCnpj = 11 - $restoCnpj;
            }

            return $restoCnpj;
        } // parte 2

        if(parte1($cnpj) != $cnpj[12]){     // primeiro dígito inválido
            return false;
        } elseif(parte2($cnpj) != $cnpj[13]){       //  segundo dígito inválido
            return false;
        } else{     // cnpj válido
            return true;
        }; // verificação final
    } // if cnpj diferente de tudo 0
} // validador

?>