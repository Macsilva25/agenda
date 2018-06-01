<?php
/** @package    Xpto::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * Administrar_UsuarioMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the Administrar_UsuarioDAO to the adm_usuarios datastore.
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
class Administrar_UsuarioMap implements IDaoMap, IDaoMap2
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
			self::$FM["Id"] = new FieldMap("Id","adm_usuarios","id",true,FM_TYPE_INT,11,null,true);
			self::$FM["Nome"] = new FieldMap("Nome","adm_usuarios","nome",false,FM_TYPE_VARCHAR,200,null,false);
			self::$FM["Usuario"] = new FieldMap("Usuario","adm_usuarios","usuario",false,FM_TYPE_VARCHAR,50,null,false);
			self::$FM["Senha"] = new FieldMap("Senha","adm_usuarios","senha",false,FM_TYPE_VARCHAR,50,null,false);
			self::$FM["DataCadastro"] = new FieldMap("DataCadastro","adm_usuarios","data_cadastro",false,FM_TYPE_DATETIME,null,null,false);
			self::$FM["Permissao"] = new FieldMap("Permissao","adm_usuarios","permissao",false,FM_TYPE_INT,3,null,false);
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