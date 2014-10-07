<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Torneo', 'doctrine');

/**
 * BaseTorneo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nombre
 * @property integer $idLiga
 * @property Liga $Liga
 * @property Doctrine_Collection $Aviso
 * @property Doctrine_Collection $Equipo
 * @property Doctrine_Collection $Jornada
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTorneo extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('torneo');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('nombre', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('idLiga', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Liga', array(
             'local' => 'idLiga',
             'foreign' => 'id'));

        $this->hasMany('Aviso', array(
             'local' => 'id',
             'foreign' => 'idTorneo'));

        $this->hasMany('Equipo', array(
             'local' => 'id',
             'foreign' => 'idTorneo'));

        $this->hasMany('Jornada', array(
             'local' => 'id',
             'foreign' => 'idTorneo'));
    }
}