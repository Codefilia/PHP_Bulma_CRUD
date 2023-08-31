<?php
    require_once "main.php";

    /*== Almacenar Datos ==*/
    $nombre=limpiar_strings($_POST['usuario_nombre']);
    $apellido=limpiar_strings($_POST['usuario_apellido']);

    $usuario=limpiar_strings($_POST['usuario_usuario']);
    $email=limpiar_strings($_POST['usuario_email']);
    
    $clave_1=limpiar_strings($_POST['usuario_clave_1']);
    $clave_2=limpiar_strings($_POST['usuario_clave_2']);

    /*== Verificando campos obligatorios ==*/
    if($nombre=="" || $apellido=="" || $usuario=="" || $clave_1=="" || $clave_2==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
            ';
        exit();

    }else{

    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El <strong>NOMBRE</strong> no coincide con el formato solicitado
            </div>
            ';
        exit();

    }else{
    
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El <strong>APELLIDO</strong> no coincide con el formato solicitado
            </div>
            ';
        exit();

    }else{
    
    if(verificar_datos("[a-zA-Z0-9]{4,20}",$usuario)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El <strong>USUARIO</strong> no coincide con el formato solicitado
            </div>
            ';
        exit();

    }else{
        
    if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave_1) 
    || verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave_2)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Las <strong>CLAVES</strong> no coinciden con el formato solicitado
            </div>
            ';
        exit();

    }else{
    /*== Verificando email ==*/
    if($email!=""){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $check_email=conexion();
            $check_email=$check_email->query("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
            if($check_email->rowCount()>0){
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El correo electrónico ingresado ya se encuentra registrado, por favor elija otro
                    </div>
                    ';
                exit();
                }
                $check_email=null;
            }else{
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        Ha ingresado un correo electrónico no valido
                    </div>
                    ';
                exit();
            } 
        }

    /*== Verificando usuario ==*/
    $check_user=conexion();
    $check_user=$check_user->query("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
    if($check_user->rowCount()>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El <strong>USUARIO</strong> ingresado ya se encuentra registrado, por favor elija otro
            </div>
            ';
          exit();
      }
      $check_user=null;

    /*== Verificando claves ==*/
    if($clave_1!=$clave_2){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Las <strong>CLAVES</strong> que ha ingresado no coinciden
            </div>
            ';
        exit();
    }else{
        $clave=password_hash($clave_1,PASSWORD_BCRYPT,["cost"=>10]);
    }

    } 

    /*== Guardando datos ==*/
    $save_user=conexion();
    $save_user=$save_user->prepare("INSERT INTO usuario(usuario_nombre,usuario_apellido,usuario_usuario,usuario_pass,usuario_email) VALUES(:nombre,:apellido,:usuario,:clave,:email)");
  
    $input_texts=[
          ":nombre"=>$nombre,
          ":apellido"=>$apellido,
          ":usuario"=>$usuario,
          ":clave"=>$clave,
          ":email"=>$email
        ];
  
      $save_user->execute($input_texts);
  
      /*== Datos enviados de manera correcta ==*/
      if($save_user->rowCount()==1){
          echo '
              <div class="notification is-info is-success">
                  <strong>¡USUARIO REGISTRADO!</strong><br>
                  El usuario se registro con exito. 
              </div>
                ';
         }else{
          echo '
              <div class="notification is-danger is-danger">
                  <strong>¡Ocurrio un error inesperado!</strong><br>
                  No se pudo registrar el usuario, por favor intente nuevamente
              </div>
                ';
        }
      $save_user=null;
         }
        }
    }
}

                
                 
                
        
          
 
