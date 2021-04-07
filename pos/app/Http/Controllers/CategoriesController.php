<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Support\Facades\Session;
use App\Category;

class CategoriesController extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->data['main_menu'] = 'Products';
        $this->data['sub_menu'] = 'Categories';
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['categories']=Category::all();
        return view ('categories.categories', $this->data) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['mode']     = 'create';
        $this->data['headline'] = 'Create New Category';
        $this->data['button'] = 'Save';
        
        return view('categories.form',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $formData=$request->all();
        if(Category::Create($formData))
        {
            Session::flash('strong', 'Success!');
            Session::flash('message', 'Category Created Successfully!');
        }
        return redirect()->to('categories');
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

        $this->data['category']     = Category::findorfail($id);

        return view('categories.form',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCategoryRequest $request, $id)
    {
        $category        = Category::findorfail($id);
        $category->title = $request->get('title'); 

        if($category->save())
        {
            Session::flash('strong', 'Update!');
            Session::flash('message', 'Category Updated Successfully!');
        }
        return redirect()->to('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Category::findorfail($id)->delete())
        {
            Session::flash('strong', 'Delete!');
            Session::flash('message', 'Category Deleted Successfully!');
        }
        return redirect()->to('categories');
    }
}
