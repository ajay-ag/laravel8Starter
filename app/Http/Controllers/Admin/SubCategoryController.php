<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use App\Traits\DatatableTrait;
use Illuminate\Http\Request;
use FileUploader;


class SubCategoryController extends Controller
{
  use DatatableTrait;

  public function __construct(){
    $this->middleware(['auth:admin','permission:SubCategories|subcategory-add|subcategory-edit|subcategory-delete'],['only' => ['index','dataList']]);
    $this->middleware(['auth:admin','permission:subcategory-add'],['only' => ['create','store']]);
    $this->middleware(['auth:admin','permission:subcategory-edit'],['only' => ['edit','update']]);
    $this->middleware(['auth:admin','permission:subcategory-delete'],['only' => ['destroy']]);
  }

  public function index()
  {
    $this->data['title'] = 'Sub Category';
    return $this->view('admin.subcategories.index');
  }


  public function create()
  {
    $this->data['title'] = 'Create';
    return $this->view('admin.subcategories.create');
  }


  public function dataList(Request $request)
  {
    // Listing colomns to show
    $columns = array(
      'id',
      'name',
      'category_id',
      'action',
    );


    $totalData = SubCategory::count(); // datata table count

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');
    $search = $request->input('search.value');


    // dd($request);

    // DB::enableQueryLog();
    // generate a query
    $subCategoryCollection = SubCategory::with('category')->when($search, function ($query, $search) {
      return $query->whereLike(['name', 'category.name'], $search);
    });

    // dd($totalData);

    $totalFiltered = $subCategoryCollection->count();
    $subCategoryCollection = $subCategoryCollection->offset($start)->limit($limit)->orderBy($order, $dir)->get();
    $data = [];

    foreach ($subCategoryCollection as $key => $item) {
      // dd(route('admin.brand.edit', $item->id));
      $row['id'] = $item->id;
      $row['name'] = '<b>' . $item->name . '</b>';
      $row['category'] = '<b>' . $item->category->name . '</b>';
      $row['status'] = $this->status($item->is_active, $item->id, route('admin.sub-category.status', $item->id));
      $row['permission'] = $this->permition($item->id);
      $row['action'] = $this->action([
        collect([
          'text' => 'Edit',
          'id' => $item->id,
          'action' => route('admin.sub-category.edit', $item->id),
          'icon' => 'fa fa-pen',
          'permission' => request()->user()->can('subcategory-edit') ? true:false
        ]),
        collect([
          'text' => 'Delete',
          'id' => $item->id,
          'action' => route('admin.sub-category.destroy', $item->id),
          'class' => 'delete-confirmation',
          'icon' => 'fa fa-trash',
          'permission' => request()->user()->can('subcategory-delete') ? true:false

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
    $category = new SubCategory();
    $category->name = $request->name;
    $category->slug = $request->slug;
    $category->category_id = $request->category;
    $category->description = $request->description;
    $category->image = FileUploader::make($request->images)->upload('sub-category');
    $category->save();

    return redirect()->route('admin.sub-category.index')->with('success', 'SubCategory Created Successfully');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\SubCategory  $category
   * @return \Illuminate\Http\Response
   */
  public function show(SubCategory $category)
  {
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\SubCategory  $category
   * @return \Illuminate\Http\Response
   */
  public function edit(SubCategory $subCategory)
  {
    $this->data['title'] = 'Edit';
    $this->data['category'] = $subCategory;
    return $this->view('admin.subcategories.edit');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\SubCategory  $category
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, SubCategory $subCategory)
  {
    $category = $subCategory;
    $category->name = $request->name;
    $category->slug = $request->slug;
    $category->category_id = $request->category;
    $category->description = $request->description;
    $category->image = FileUploader::make($request->images)->upload('sub-category', $category->image);
    $category->save();
    return redirect()->route('admin.sub-category.index')->with('success', 'Sub category Updated Successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\SubCategory  $category
   * @return \Illuminate\Http\Response
   */
  public function destroy(SubCategory $subCategory)
  {
    $subCategory->delete();

    return response()->json([
      'success' => true,
      'message' => 'Sub Category Deleted SuccessFully'
    ], 200);
  }

  public function changeStatus(Request $request, $id)
  {
    $category = SubCategory::findOrFail($request->id);
    $category->is_active  = $request->status == 'true' ? null :  date('Y-m-d H:i:s');

    if ($category->save()) {
      $statuscode = 200;
    }

    $status = $request->status == 'true' ? 'active' : 'deactivate';
    $message = "SubCategory $status successfully.";

    return response()->json([
      'success' => true,
      'message' => $message
    ], $statuscode ?? 400);
  }


  public function exists(Request $request)
  {
    $id = $request->get('id', null);
    $category_id = $request->get('category_id');
    $count = SubCategory::when($id != null, function ($query) use ($request, $category_id) { // edit time
      return $query->where('id', '!=', $request->id)->where('category_id', $category_id);
    })->when($id == null && $category_id != null, function ($query) use ($request, $category_id) { // create time
      return $query->where('category_id', $category_id);
    })->where('name', $request->name)->count();
    if ($count > 0) {
      return 'false';
    } else {
      return 'true';
    }
  }
}
