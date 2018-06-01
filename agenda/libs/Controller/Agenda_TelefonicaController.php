<?php
/** @package    Agenda Telefonica::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Agenda_Telefonica.php");

/**
 * Agenda_TelefonicaController is the controller class for the Agenda_Telefonica object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package Agenda Telefonica::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class Agenda_TelefonicaController extends AppBaseController
{

	/**
	 * Override here for any controller-specific functionality
	 *
	 * @inheritdocs
	 */
	protected function Init()
	{
		parent::Init();

		// TODO: add controller-wide bootstrap code
		
		// TODO: if authentiation is required for this entire controller, for example:
		// $this->RequirePermission(ExampleUser::$PERMISSION_USER,'SecureExample.LoginForm');
	}

	/**
	 * Displays a list view of Agenda_Telefonica objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Agenda_Telefonica records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new Agenda_TelefonicaCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Nome,Telefone,Email,DataNascimento,Endereco'
				, '%'.$filter.'%')
			);

			// TODO: this is generic query filtering based only on criteria properties
			foreach (array_keys($_REQUEST) as $prop)
			{
				$prop_normal = ucfirst($prop);
				$prop_equals = $prop_normal.'_Equals';

				if (property_exists($criteria, $prop_normal))
				{
					$criteria->$prop_normal = RequestUtil::Get($prop);
				}
				elseif (property_exists($criteria, $prop_equals))
				{
					// this is a convenience so that the _Equals suffix is not needed
					$criteria->$prop_equals = RequestUtil::Get($prop);
				}
			}

			$output = new stdClass();

			// if a sort order was specified then specify in the criteria
 			$output->orderBy = RequestUtil::Get('orderBy');
 			$output->orderDesc = RequestUtil::Get('orderDesc') != '';
 			if ($output->orderBy) $criteria->SetOrder($output->orderBy, $output->orderDesc);

			$page = RequestUtil::Get('page');

			if ($page != '')
			{
				// if page is specified, use this instead (at the expense of one extra count query)
				$pagesize = $this->GetDefaultPageSize();

				$administrar_agenda = $this->Phreezer->Query('Agenda_Telefonica',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $administrar_agenda->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $administrar_agenda->TotalResults;
				$output->totalPages = $administrar_agenda->TotalPages;
				$output->pageSize = $administrar_agenda->PageSize;
				$output->currentPage = $administrar_agenda->CurrentPage;
			}
			else
			{
				// return all results
				$administrar_agenda = $this->Phreezer->Query('Agenda_Telefonica',$criteria);
				$output->rows = $administrar_agenda->ToObjectArray(true, $this->SimpleObjectParams());
				$output->totalResults = count($output->rows);
				$output->totalPages = 1;
				$output->pageSize = $output->totalResults;
				$output->currentPage = 1;
			}


			$this->RenderJSON($output, $this->JSONPCallback());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method retrieves a single Agenda_Telefonica record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$agenda_telefonica = $this->Phreezer->Get('Agenda_Telefonica',$pk);
			$this->RenderJSON($agenda_telefonica, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Agenda_Telefonica record and render response as JSON
	 */
	public function Create()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$agenda_telefonica = new Agenda_Telefonica($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $agenda_telefonica->Id = $this->SafeGetVal($json, 'id');

			$agenda_telefonica->Nome = $this->SafeGetVal($json, 'nome');
			$agenda_telefonica->Telefone = $this->SafeGetVal($json, 'telefone');
			$agenda_telefonica->Email = $this->SafeGetVal($json, 'email');
			$agenda_telefonica->DataNascimento = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dataNascimento')));
			$agenda_telefonica->Endereco = $this->SafeGetVal($json, 'endereco');

			$agenda_telefonica->Validate();
			$errors = $agenda_telefonica->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$agenda_telefonica->Save();
				$this->RenderJSON($agenda_telefonica, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Agenda_Telefonica record and render response as JSON
	 */
	public function Update()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$pk = $this->GetRouter()->GetUrlParam('id');
			$agenda_telefonica = $this->Phreezer->Get('Agenda_Telefonica',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $agenda_telefonica->Id = $this->SafeGetVal($json, 'id', $agenda_telefonica->Id);

			$agenda_telefonica->Nome = $this->SafeGetVal($json, 'nome', $agenda_telefonica->Nome);
			$agenda_telefonica->Telefone = $this->SafeGetVal($json, 'telefone', $agenda_telefonica->Telefone);
			$agenda_telefonica->Email = $this->SafeGetVal($json, 'email', $agenda_telefonica->Email);
			$agenda_telefonica->DataNascimento = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dataNascimento', $agenda_telefonica->DataNascimento)));
			$agenda_telefonica->Endereco = $this->SafeGetVal($json, 'endereco', $agenda_telefonica->Endereco);

			$agenda_telefonica->Validate();
			$errors = $agenda_telefonica->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$agenda_telefonica->Save();
				$this->RenderJSON($agenda_telefonica, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Agenda_Telefonica record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$agenda_telefonica = $this->Phreezer->Get('Agenda_Telefonica',$pk);

			$agenda_telefonica->Delete();

			$output = new stdClass();

			$this->RenderJSON($output, $this->JSONPCallback());

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
}

?>
