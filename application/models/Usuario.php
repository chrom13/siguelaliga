<?php

/**
 * Usuario
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Usuario extends BaseUsuario
{
    public static function sigueUnaLiga($idLiga, $idUsuario)
    {
        $query = Doctrine_Query::create()->from('UsuarioLigaSeguida')->where('idLiga = ' . $idLiga . ' AND idUsuario = ' . $idUsuario);
        $registro = $query->execute()->getFirst();

        if($registro)
        {
            return true;
        }

        else
        {
            return false;
        }
    }

    public static function obtenerUsuarioPorId($idUsuario)
    {
        $query = Doctrine_Query::create()->from('Usuario')->where('id = ' . $idUsuario);
        return $query->execute()->getFirst();
    }

    public static function obtenerLigasQueAdministraUnUsuario($idUsuario)
    {
        $query = Doctrine_Query::create()->from('Liga')->where('idUsuario = ' . $idUsuario);
        return $query->execute();
    }

    public static function obtenerLigasQueSigueUnUsuario($idUsuario)
    {
        $query = Doctrine_Query::create()->from('UsuarioLigaSeguida')->where('idUsuario = ' . $idUsuario);
        return $query->execute();
    }
}