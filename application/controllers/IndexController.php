<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        
    }

    public function buscarAction()
    {
    }

    public function prebusquedaAction()
    {
        // Deshabilitamos el layout
        $this->_helper->layout->disableLayout();

        // Deshabilitamos la vista
        $this->_helper->viewRenderer->setNoRender(true);

        // Verificamos que exista criterio de búsqueda
        if(isset($_POST['q']))
        {
            // Si existe criterio de búsqueda

            // Damos formato a la búsqueda
            $criterio = DesarrollandoIdeas_Funciones::urlAmigable($_POST['q']);

            // Redireccionamos al usuario
            $this->_redirect('/buscar/' . $criterio);
        }

        else
        {
            // No existe criterio de búsqueda

            // Redireccionamos al usuario
            $this->_redirect('/buscar/0');
        }
    }


}





