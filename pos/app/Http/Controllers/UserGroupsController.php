<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Group;

class UserGroupsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['main_menu'] = 'Users';
        $this->data['sub_menu'] = 'Groups';
    }

	public function Index()
    {
    	$this->data['groups']= Group::all();
    	return view('groups.groups', $this->data);
    }
	
    public function Create()
    {
        $this->data['mode']     = 'create';
        $this->data['headline'] = 'Create New Group';
        $this->data['button'] = 'Save';

    	return view('groups.form', $this->data);
    }

    public function Store(Request $request)
    {
    	$formData=$request->all();
    	if(Group::Create($formData))
    	{
    		Session::flash('strong', 'Success!');
    		Session::flash('message', 'User Group Created Successfully!');
    	}
    	return redirect()->to('groups');
    }

    public function Destroy($id)
    {
    	if(Group::findorfail($id)->delete())
    	{
    		Session::flash('strong', 'Delete!');
    		Session::flash('message', 'User Group Deleted Successfully!');
    	}
    	return redirect()->to('groups');
    }

    public function edit($id)
    {
        $this->data['mode']     = 'edit';
        $this->data['headline'] = 'Update Group';
        $this->data['button'] = 'Update';

        $this->data['group']     = Group::findorfail($id);

        return view('groups.form',$this->data);
    }

    public function update(Request $request, $id)
    {
        $data               = $request->all();

        $group               = Group::findorfail($id);
        $group->title        = $data['title'];

        if($group->save())
        {
            Session::flash('strong', 'Update!');
            Session::flash('message', 'User Group Updated Successfully!');
        }
        return redirect()->to('groups');
    }
}
