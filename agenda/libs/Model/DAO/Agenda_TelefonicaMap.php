<?php
/** @package    Xpto::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * Agenda_TelefonicaMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the Agenda_TelefonicaDAO to the agenda_telefonica datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Xpto::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class Agenda_TelefonicaMap implements IDaoMap, IDaoMap2
{

	private static $KM;
	private static $FM;
	
	/**
	 * {@inheritdoc}
	 */
	public static function AddMap($property,FieldMap $map)
	{
		self::GetFieldMaps();
		self::$FM[$property] = $map;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public static function SetFetchingStrategy($property,$loadType)
	{
		self::GetKeyMaps();
		self::$KM[$property]->LoadType = $loadType;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetFieldMaps()
	{
		if (self::$FM == null)
		{
			self::$FM = Array();
			self::$FM["Id"] = new FieldMap("Id","agenda_telefonica","id",true,FM_TYPE_INT,11,null,true);
			self::$FM["Nome"] = new FieldMap("Nome","agenda_telefonica","nome",false,FM_TYPE_VARCHAR,200,null,false);
			self::$FM["Telefone"] = new FieldMap("Telefone","agenda_telefonica","telefone",false,FM_TYPE_CHAR,20,null,false);
			self::$FM["Email"] = new FieldMap("Email","agenda_telefonica","email",false,FM_TYPE_VARCHAR,100,null,false);
			self::$FM["DataNascimento"] = new FieldMap("DataNascimento","agenda_telefonica","data_nascimento",false,FM_TYPE_DATETIME,null,null,false);
			self::$FM["Endereco"] = new FieldMap("Endereco","agenda_telefonica","endereco",false,FM_TYPE_TEXT,null,null,false);
		}
		return self::$FM;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetKeyMaps()
	{
		if (self::$KM == null)
		{
			self::$KM = Array();
		}
		return self::$KM;
	}

}

?>