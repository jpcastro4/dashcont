<?php

function check_session(){

    $_this =& get_instance();

    if(!$_this->session->userdata('cliente_id')){

        redirect('dashboard/login');
    }
}

 
function check_adm_session(){

    $_this =& get_instance();

    if(!$_this->session->userdata('user_adm_id')){

        redirect('admin/entrar');
    }

    return true;
}

 

function valorFormat($valor){

    return preg_replace("/\./", ",", $valor ); 
}

function limitarTexto($texto, $limite){
  $contador = strlen($texto);
  if ( $contador >= $limite ) {      
      $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
      return $texto;
  }
  else{
    return $texto;
  }
}

?>