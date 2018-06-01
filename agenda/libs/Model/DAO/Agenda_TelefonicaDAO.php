<?php
/** @package Xpto::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("Agenda_TelefonicaMap.php");

/**
 * Agenda_TelefonicaDAO provides object-oriented access to the agenda_telefonica table.  This
 * class is automatically generated by ClassBuilder.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * Add any custom business logic to the Model class which is extended from this DAO class.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Xpto::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class Agenda_TelefonicaDAO extends Phreezable
{
	/** @var int */
	public $Id;

	/** @var string */
	public $Nome;

	/** @var char */
	public $Telefone;

	/** @var string */
	public $Email;

	/** @var date */
	public $DataNascimento;

	/** @var string */
	public $Endereco;



}
?>