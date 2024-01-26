<?php
date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_ALL, 'pt_BR');

if(ENV_DEBUG){
    ini_set('display_errors',1);            
    ini_set('display_startup_erros',1);     
    error_reporting(E_ALL);         
}
