<?php

class LigaController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // Obtenemos la liga
        $idLiga = $this->_getParam('id');
        $liga = Liga::obtenerLigaPorId($idLiga);

        // Verificamos si la liga existe
        if($liga)
        {
            // La liga si existe

            // Obtenemos el número de seguidores de la liga
            $numeroDeSeguidores = Liga::obtenerNumeroDeSeguidores($idLiga);

            // Obtenemos los usuarios que siguen esa liga
            $seguidores = UsuarioLigaSeguida::obtenerUsuariosQueSiganUnaLiga($idLiga, 10);

            // Obtenemos el último torneo de la liga
            $torneo = Liga::obtenerUltimoTorneoDeUnaLiga($idLiga);

            // Verificamos que exista el torneo
            if($torneo)
            {
                // Si existe el torneo
                $this->view->banderaTorneo = true;

                // Obtenemos los avisos del torneo
                $this->view->avisos = Torneo::obtenerAvisosDeUnTorneo($torneo->id);

                // Obtenemos los equipos del torneo
                $this->view->equipos = Torneo::obtenerEquiposDeUnTorneo($torneo->id);

                // Obtenemos las jornadas del torneo
                $this->view->jornadas = Torneo::obtenerJornadasDeUnTorneo($torneo->id);

                // Obtenemos los partidos de las jornadas
                $partidos = array();
                foreach($this->view->jornadas AS $registro)
                {
                    $partidos[$registro->id] = Jornada::obtenerPartidosDeUnaJornada($registro->id);
                }

                $this->view->partidos = $partidos;
            }

            else
            {
                // No existe el torneo
                $this->view->banderaTorneo = false;
            }

            // Datos de la vista
            $this->view->banderaLiga = true;
            $this->view->liga = $liga;
            $this->view->numeroDeSeguidores = $numeroDeSeguidores;
            $this->view->seguidores = $seguidores;
        }

        else
        {
            // La liga no existe
            $this->view->banderaLiga = false;
        }

        // Obtenemos las ligas más seguidas
        $this->view->ligasMasSeguidas = UsuarioLigaSeguida::obtenerLigasMasSeguidas(5);
    }


}

