<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Jornada', 'doctrine');

/**
 * BaseJornada
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nombre
 * @property integer $idTorneo
 * @property Torneo $Torneo
 * @property Doctrine_Collection $Partido
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseJornada extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('jornada');
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
        $this->hasColumn('idTorneo', 'integer', 4, array(
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
        $this->hasOne('Torneo', array(
             'local' => 'idTorneo',
             'foreign' => 'id'));

        $this->hasMany('Partido', array(
             'local' => 'id',
             'foreign' => 'idJornada'));
    }
}