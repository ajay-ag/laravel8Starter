<?php

namespace App\Http\Controllers\Admin;

use FileUploader;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Traits\DatatableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
  use DatatableTrait;

   public function __construct(){
    $this->middleware(['auth:admin','permission:Categories|category-add|category-edit|category-delete'],['only' => ['index','dataList']]);
    $this->middleware(['auth:admin','permission:category-add'],['only' => ['create','store']]);
    $this->middleware(['auth:admin','permission:category-edit'],['only' => ['edit','update']]);
    $this->middleware(['auth:admin','permission:category-delete'],['only' => ['destroy']]);
  }

  public function index()
  {
      $this->data['title'] = 'Category';
      return $this->view('admin.categories.index');
  }


  public function create()
  {
    $this->data['title'] = 'Create';
    return $this->view('admin.categories.create');
  }


  public function dataList(Request $request)
  {
    // Listing columns to show
    $columns = array(
      0 => 'id',
      1 => 'name',
      3 => 'action',
    );


    $totalData = Category::count(); // datata table count

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');
    $search = $request->input('search.value');

    // dd($request);

    // DB::enableQueryLog();
    // generate a query
    $categoryCollection = Category::when($search, function ($query, $search) {
      return $query->where('description', 'LIKE', "%{$search}%")->orWhere('name', 'LIKE', "%{$search}%");
    });

    // dd($totalData);

    $totalFiltered = $categoryCollection->count();

    $categoryCollection = $categoryCollection->offset($start)->limit($limit)->orderBy($order, $dir)->get();

    $data = [];
    // dd($categoryCollection);
    foreach ($categoryCollection as $key => $item) {

      // dd(route('admin.brand.edit', $item->id));
      $row['id'] = $item->id;
      $row['name'] = '<b>' . $item->name . '</b>';
      $row['status'] = $this->status($item->is_active, $item->id, route('admin.category.status', ['id' => $item->id]));
      $row['permission'] = $this->permition($item->id);
      $row['action'] = $this->action([
        collect([
          'text' => 'Edit',
          'id' => $item->id,
          'action' => route('admin.category.edit', $item->id),
          'icon' => 'fa fa-pen',
          'permission' =>  request()->user()->can('category-edit') ? true:false
        ]),
        collect([
          'text' => 'Delete',
          'id' => $item->id,
          'action' => route('admin.category.destroy', ['category' => $item->id]),
          'class' => 'delete-confirmation',
          'icon' => 'fa fa-trash',
          'permission' => request()->user()->can('category-delete') ? true:false
        ])
      ]);

      $data[] = $row;
    }

    $json_data = array(
      "draw" => intval($request->input('draw')),
      "recordsTotal" => intval($totalData),
      "recordsFiltered" => intval($totalFiltered),
      "data" => $data,
    );

    return response()->json($json_data);
  }
  

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $category = new Category();
    $category->name = $request->name;
    $category->slug = $request->slug;
    $category->description = $request->description;
    $category->image = FileUploader::make($request->images)->upload('category');
    $category->save();

    return redirect()->route('admin.category.index')->with('success', 'Category Created Successfully');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Category  $category
   * @return \Illuminate\Http\Response
   */
  public function show(Category $category)
  {
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Category  $category
   * @return \Illuminate\Http\Response
   */
  public function edit(Category $category)
  {
    $this->data['title'] = 'Edit';
    $this->data['category'] = $category;
    return $this->view('admin.categories.edit');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Category  $category
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Category $category)
  {
    $category->name = $request->name;
    $category->slug = $request->slug;
    $category->description = $request->description;
    $category->image = FileUploader::make($request->images)->upload('category', $category->image);
    $category->save();
    return redirect()->route('admin.category.index')->with('success', 'Category Updated Successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Category  $category
   * @return \Illuminate\Http\Response
   */
  public function destroy(Category $category)
  {
    if(DB::table('sub_categories')->where('category_id', $category->id)->doesntExist()){
      $category->delete();
      return response()->json([
        'success' => true,
        'message' => 'Category Deleted SuccessFully'
      ], 200);
    }

    return response()->json([
      'success' => true,
      'message' => 'Category Used In Sub Category'
    ], 401);
  }

  public function changeStatus(Request $request, $id)
  {
    $category = Category::findOrFail($request->id);
    $category->is_active  = $request->status == 'true' ? null :  date('Y-m-d H:i:s');

    if ($category->save()) {
      $statuscode = 200;
    }

    $status = $request->status == 'true' ? 'active' : 'deactivate';
    $message = "Category $status successfully.";

    return response()->json([
      'success' => true,
      'message' => $message
    ], $statuscode ?? 400);
  }


  public function exists(Request $request)
  {
    $id = $request->get('id');
    $count = Category::when($id != null, function ($query) use ($request) {
      return $query->where('id', '!=', $request->id);
    })->where('name', $request->name)->count();
    if ($count > 0) {
      return 'false';
    } else {
      return 'true';
    }
  }

  public function categoryList(Request $request)
  {
    $category = Category::where('name', 'LIKE', "%$request->search%")
      ->whereNull('is_active')
      ->get();
    return CategoryResource::collection($category);
  }
}