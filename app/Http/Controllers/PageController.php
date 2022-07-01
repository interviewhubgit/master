<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::latest()->paginate(5);
      
        return view('pages.index',compact('pages'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        //dd($categories);
        return view('pages.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'required|mimes:png,jpg,gif,jpeg|max:4096'
            // 'parent_id' => 'required'
        ]);


       //dd($request->file('file'));
        if($request->file('file')) {
            $fileName = time().'_'.$request->file->getClientOriginalName(); 
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public'); 
            $image = time().'_'.$request->file->getClientOriginalName();
            $file_path = '/storage/' . $filePath;

            $request->request->add(['image' => $image]);
            $request->request->add(['file_path' => $file_path]);
        }
      
        Page::create($request->all());
       
        return redirect()->route('pages.index')
                        ->with('success','Page created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return view('pages.show',compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $categories=Category::all();
        return view('pages.edit',compact('page','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required',
           // 'parent_id' => 'required',
        ]);

        if($request->file('file')) {
            $fileName = time().'_'.$request->file->getClientOriginalName(); 
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public'); 
            $image = time().'_'.$request->file->getClientOriginalName();
            $file_path = '/storage/' . $filePath;

            $request->request->add(['image' => $image]);
            $request->request->add(['file_path' => $file_path]);
        }
      
        $page->update($request->all());
      
        return redirect()->route('pages.index')
                        ->with('success','Page updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
       
        return redirect()->route('pages.index')
                        ->with('success','Page deleted successfully');
    }
}
