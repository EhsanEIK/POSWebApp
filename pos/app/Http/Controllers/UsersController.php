<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PHPUnit\TextUI\XmlConfiguration\Groups;


class UsersController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->data['main_menu'] = 'Users';
        $this->data['sub_menu'] = 'Users';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request)
    {
        $this->data['groups']    = Group::all();
        
        $group_id                = $request->get('group');

        if ($group_id)
        {
            $this->data['users'] = User::where('group_id', $group_id)->get();
        }
        else
        {
            $this->data['users'] = User::all();
        }
        
        return view ('users.users', $this->data) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['mode']     = 'create';
        $this->data['headline'] = 'Create New User';
        $this->data['button'] = 'Save';

        $this->data['groups']   = Group::arrayForSelect();
        
        return view('users.form',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $formData=$request->all();
        if(User::Create($formData))
        {
            Session::flash('strong', 'Success!');
            Session::flash('message', 'User Created Successfully!');
        }
        return redirect()->to('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['user'] = User::findorfail($id);
        $this->data['tab_menu'] = 'user_show';

        return view('users.show',$this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['mode']     = 'edit';
        $this->data['headline'] = 'Update Informtation';
        $this->data['button'] = 'Update';

        $this->data['groups']   = Group::arrayForSelect();
        $this->data['user']     = User::findorfail($id);

        return view('users.form',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $data               = $request->all();

        $user               = User::findorfail($id);
        $user->group_id     = $data['group_id'];
        $user->name         = $data['name'];
        $user->phone        = $data['phone'];
        $user->email        = $data['email'];
        $user->address      = $data['address'];

        if($user->save())
        {
            Session::flash('strong', 'Update!');
            Session::flash('message', 'User Updated Successfully!');
        }
        return redirect()->to('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(User::findorfail($id)->delete())
        {
            Session::flash('strong', 'Delete!');
            Session::flash('message', 'User Deleted Successfully!');
        }
        return redirect()->to('users');

    }
}
