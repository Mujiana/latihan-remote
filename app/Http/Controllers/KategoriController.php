<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kategori.index');
    }
    
	public function listData()
	{
	
	  $kategori = Kategori::orderBy('id_kategori', 'desc')->get();
      $no = 0;
      foreach($kategori as $list){
         $no ++;
         $row = array();
         $row[] = $no;
         $row[] = $list->nama_kategori;
		 $row[] = '<a onclick="editForm('.$list->id_kategori.')" class="btn btn-primary">Edit</a>
					<a onclick="deleteData('.$list->id_kategori.')" class="btn btn-danger">Hapus</a>';
         $data[] = $row;
      }
    
      $output = array("data" => $data);
	  return response()->json($output);
      //echo json_encode($output);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$kategori = new Kategori;
		$kategori->nama_kategori = $request['nama'];
		$kategori->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $kategori = Kategori::find($id);
	  echo json_encode($kategori);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $kategori = Kategori::find($id);
		$kategori->nama_kategori = $request['nama'];
		$kategori->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
    }
}
