<?php

class UsuarioController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // Obtenemos el usuario consultado
        $idUsuario = $this->_getParam('id');
        $usuario = Usuario::obtenerUsuarioPorId($idUsuario);

        // Verificamos si el usuario existe
        if($usuario)
        {
            // El usuario si existe

            // Verificamos si el visitante está firmado
            $usuarioFirmado = array();
            $auth = Zend_Auth::getInstance();
            if($auth->hasIdentity())
            {
                // Si está firmado
                $usuarioFirmado = $auth->getIdentity();
            }

            // Obtenemos las ligas que administra el usuario
            $ligasAdministradas = Usuario::obtenerLigasQueAdministraUnUsuario($idUsuario);

            // Obtenemos el número de seguidores de las ligas administradas
            $ligasAdministradasNumeroDeSeguidores = array();
            $ligasAdministradasBanderaSeguimiento = array();
            foreach($ligasAdministradas AS $liga)
            {
                $ligasAdministradasNumeroDeSeguidores[$liga->id] = Liga::obtenerNumeroDeSeguidores($liga->id);
                $ligasAdministradasBanderaSeguimiento[$liga->id] = false;

                // Bandera de seguimiento
                if($usuarioFirmado)
                {
                    // Usuario firmado

                    // Verificamos si el usuario sigue la liga
                    if(Usuario::sigueUnaLiga($liga->id, $usuarioFirmado->id))
                    {
                        // Si sigue la liga
                        $ligasAdministradasBanderaSeguimiento[$liga->id] = true;
                    }
                }
            }

            // Obtenemos las ligas que sigue el usuario
            $ligasSeguidas = Usuario::obtenerLigasQueSigueUnUsuario($idUsuario);

            // Obtenemos el número de seguidores de las ligas seguidas
            $ligasSeguidasNumeroDeSeguidores = array();
            $ligasSeguidasBanderaSeguimiento = array();
            foreach($ligasSeguidas AS $liga)
            {
                $ligasSeguidasNumeroDeSeguidores[$liga->id] = Liga::obtenerNumeroDeSeguidores($liga->id);
                $ligasSeguidasBanderaSeguimiento[$liga->id] = true;

                // Bandera de seguimiento
                if($usuarioFirmado)
                {
                    // Usuario firmado

                    // Verificamos si el usuario sigue la liga
                    if(Usuario::sigueUnaLiga($liga->id, $usuarioFirmado->id))
                    {
                        // Si sigue la liga
                        $ligasSeguidasBanderaSeguimiento[$liga->id] = true;
                    }
                }
            }

            // Datos de la vista
            $this->view->banderaUsuario = true;
            $this->view->usuario = $usuario;
            $this->view->ligasAdministradas = $ligasAdministradas;
            $this->view->ligasSeguidas = $ligasSeguidas;
            $this->view->ligasAdministradasNumeroDeSeguidores = $ligasAdministradasNumeroDeSeguidores;
            $this->view->ligasSeguidasNumeroDeSeguidores = $ligasSeguidasNumeroDeSeguidores;
            $this->view->ligasAdministradasBanderaSeguimiento = $ligasAdministradasBanderaSeguimiento;
            $this->view->ligasSeguidasBanderaSeguimiento = $ligasSeguidasBanderaSeguimiento;
            $this->view->usuarioFirmado = $usuarioFirmado;
        }

        else
        {
            // El usuario no existe
            $this->view->banderaUsuario = false;
        }
    }


}

