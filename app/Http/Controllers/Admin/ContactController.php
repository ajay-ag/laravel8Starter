<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\DatatableTrait;

class ContactController extends Controller
{
  use DatatableTrait;
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->data['title'] =  'Contact';
    return view('admin.contact.index', $this->data);
  }


  public function dataListing(Request $request)
  {

    // Listing columns to show
    $columns = array(
      0 => 'name',
      1 => 'email',
      2 => 'phone',
      3 => 'subject',
      4 => 'action',
    );


    $totalData = Contact::count(); // table count

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');
    $search = $request->input('search.value');

    // dd($request);

    // DB::enableQueryLog();
    // genrate a query
    $contactCollection = Contact::when($search, function ($query, $search) {
      return $query->where('name', 'LIKE', "%{$search}%");
    });

    // dd($totalData);

    $totalFiltered = $contactCollection->count();

    $contactCollection = $contactCollection->offset($start)->limit($limit)->orderBy($order, $dir)->get();

    $data = [];
    // dd($contactCollection);
    foreach ($contactCollection as $key => $item) {

      // dd(route('admin.brand.edit', $item->id));
      $row['name'] = $item->name;
      $row['email'] = $item->email;
      $row['phone'] = $item->phone;
      $row['subject'] = $item->subject;

      $row['action'] = $this->action([
        collect([
          'text' => 'View',
          'class' => 'call-modal',
          'icon' => 'fa fa-eye',
          'action' => route('admin.contact.show', $item->id),
          'target' => '#contactview',
          'permission' => true
        ])
        // 'delete' => collect([
        //     'id' => $item->id,
        //     'action' => route('admin.brand.destroy', $item->id),
        // ])
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
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $contact = Contact::findOrFail($id);
    $html = view('admin.contact.view', ['contact' => $contact])->render();
    return response()->json(['html' => $html], 200);

    // $contact = Contact::findOrFail($id);
    // $html = view('admin.contact.view',[ 'contact' => $contact])->render() ;
  }
}
