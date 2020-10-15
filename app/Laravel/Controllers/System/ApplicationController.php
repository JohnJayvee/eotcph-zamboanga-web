<?php

namespace App\Laravel\Controllers\System;

/*
 * Request Validator
 */
use App\Laravel\Requests\PageRequest;
use App\Laravel\Requests\System\ApplicationRequest;
/*
 * Models
 */
use App\Laravel\Models\Application;
use App\Laravel\Models\Department;
use App\Laravel\Models\ApplicationRequirements;

/* App Classes
 */
use Carbon,Auth,DB,Str,Helper;

class ApplicationController extends Controller
{
    protected $data;
	protected $per_page;
	
	public function __construct(){
		parent::__construct();
		array_merge($this->data, parent::get_data());
		$this->data['department'] = ['' => "All Peza Unit"] + Department::pluck('name','id')->toArray();
		$this->data['requirements'] =  ApplicationRequirements::pluck('name','id')->toArray();
		$this->per_page = env("DEFAULT_PER_PAGE",10);
	}

	public function  index(PageRequest $request){
		$this->data['page_title'] = "Application";
		$this->data['applications'] = Application::orderBy('created_at',"DESC")->get(); 
		return view('system.application.index',$this->data);
	}

	public function  create(PageRequest $request){
		$this->data['page_title'] .= "Application - Add new record";
		return view('system.application.create',$this->data);
	}
	public function store(ApplicationRequest $request){
		DB::beginTransaction();
		try{
			$new_application = new Application;
			$new_application->department_id = $request->get('department_id');
			$new_application->name = $request->get('name');
			$new_application->processing_fee = Helper::db_amount($request->get('processing_fee'));
			$new_application->processing_days = $request->get('processing_days');
			$new_application->requirements_id = implode(",", $request->get('requirements_id'));
			$new_application->save();
			DB::commit();
			session()->flash('notification-status', "success");
			session()->flash('notification-msg', "New Application has been added.");
			return redirect()->route('system.application.index');
		}catch(\Exception $e){
			DB::rollback();
			session()->flash('notification-status', "failed");
			session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
			return redirect()->back();
		}
	}

	public function  edit(PageRequest $request,$id = NULL){
		$this->data['page_title'] .= " - Edit record";
		$this->data['application'] = $request->get('application_data');
		return view('system.application.edit',$this->data);
	}

	public function  update(ApplicationRequest $request,$id = NULL){
		DB::beginTransaction();
		try{

			$application = $request->get('application_data');
			$application->department_id = $request->get('department_id');
			$application->name = $request->get('name');
			$application->processing_fee = Helper::db_amount($request->get('processing_fee'));
			$application->processing_days = $request->get('processing_days');
			$application->requirements_id = implode(",", $request->get('requirements_id'));
			$application->save();

			DB::commit();
			session()->flash('notification-status', "success");
			session()->flash('notification-msg', "Application had been modified.");
			return redirect()->route('system.application.index');
		}catch(\Exception $e){
			DB::rollback();
			session()->flash('notification-status', "failed");
			session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
			return redirect()->back();
		}
	}

	

	public function  destroy(PageRequest $request,$id = NULL){
		$application = $request->get('application_data');
		DB::beginTransaction();
		try{
			$application->delete();
			DB::commit();
			session()->flash('notification-status', "success");
			session()->flash('notification-msg', "Application removed successfully.");
			return redirect()->route('system.application.index');
		}catch(\Exception $e){
			DB::rollback();
			session()->flash('notification-status', "failed");
			session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
			return redirect()->back();
		}
	}
}
