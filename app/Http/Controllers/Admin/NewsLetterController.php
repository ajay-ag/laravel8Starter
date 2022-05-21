<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsLetter as ModelsNewsLetter;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
  public function __construct(){
    $this->middleware(['auth:admin','permission:Newsletter'],['only' => ['index','dataListing']]);
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    $this->data['title'] =  'Newsletter';
    return view('admin.newsletter.index', $this->data);
  }

  public function dataListing(Request $request)
  {

    // Listing columns to show
    $columns = array(
      0 => 'id',
      1 => 'email',
      2 => 'created_at',
    );

    $totalData = ModelsNewsLetter::count(); // datatable count

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');
    $search = $request->input('search.value');

    // generate a query
    $newsLetter = ModelsNewsLetter::select('id', 'email', 'created_at')->when($search, function ($query, $search) {
      return $query->where('email', 'LIKE', "%{$search}%");
    })->orderBy($order, $dir);

    $totalFiltered = $newsLetter->count();

    $data = [];

    $newsLetter = $newsLetter->offset($start)->limit($limit)->get();

    foreach ($newsLetter as $key => $item) {
      $row['id'] = $item->id;
      $row['email'] = $item->email;
      $row['created_at'] = date('m-d-Y', strtotime($item->created_at));
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
}
