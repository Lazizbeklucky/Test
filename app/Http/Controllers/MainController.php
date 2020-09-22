<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cabinet;

use App\File;


class MainController extends Controller
{


//    private $array_data = [];


//    private function getIdFromTable($id)
//    {
// $array_data = [];
//      $namepath = [
//             1=>'cabinet',
//             2=>'cell',
//             3=>'folder',
//          ];
    
//     array_push($this->array_data,$this->findPath($id));
//     $text = '';
        
//     for ($i=1; $i < sizeof( $this->array_data ); $i++) { 
//         $text = $text.'/'.$namepath[$i].'-'.$this->array_data[$i][$i+1]; 

//     }
  
//       return $text;
//    }


  public function searchFile(Request $request)
  {
        $data =  Cabinet::where ('name','LIKE', '%' . $request->search_file . '%' )
                        ->whereOr('name','LIKE', '%' . $request->search_file)
                        ->whereOr('name','LIKE', $request->search_file.'%')
                        ->orderBy('type','asc')->get();

        $files =  File::where ('name','LIKE', '%' . $request->search_file . '%' )
                        ->whereOr('name','LIKE', '%' . $request->search_file)
                        ->whereOr('name','LIKE', $request->search_file.'%')
                        ->get();


          // $data = $data->map(function($item){

          //         if($item->type==1)
          //         {
          //           return collect([
          //           'id'=>$item->id,
          //           'name'=>$item->name,
          //           'type'=>$item->type,
          //           'parent_id'=>$item->parent_id,
          //           'path'=>'/'

          //         ]);
          //         }

          //         if($item->type==2)
          //         {

          //           return collect([
          //           'id'=>$item->id,
          //           'name'=>$item->name,
          //           'type'=>$item->type,
          //           'parent_id'=>$item->parent_id,
          //           'path'=>'/cabinet-'.$item->parent_id
          //         ]);

          //         }
          //         if($item->type==3)
          //         {

          //           return collect([
          //           'id'=>$item->id,
          //           'name'=>$item->name,
          //           'type'=>$item->type,
          //           'parent_id'=>$item->parent_id,
          //           'path'=>$this->getIdFromTable($item->id)

          //         ]);
                    
          //         }


                   
                  
          // });

          // dd($data);              

         $nameCheck = [
            1=>'Cabinet',
            2=>'Cell',
            3=>'Folder',
         ];

        
      return view('pages.search',[

        'items' => $data,
        'nameCheck' =>$nameCheck,
        'files' =>$files,
        'data' =>$request->search_file  
      
      ]);
  }

 
   public function index()
   {   
      $cabinets = Cabinet::where('parent_id',null)->orderBy('created_at','desc')->get();
      $routeName = 'cabinet'; 
      return view('pages.index',[
      'items' => $cabinets,
      'routeName' => $routeName
      ]);
   }

   public function createCabinet(Request $request)	
   {


      $data = new Cabinet;
      $data->name = $request->file_name;
      $data->type = 1;
      $data->save();
      return redirect()->back();
   }

   public function enterCabinet($id)
   {
    
    $breadcrumbs = [];
   
    $datas = Cabinet::where('id',$id)->where('type',1)->with(['getCellFromCabinet','getFilesFromCabinet'])->get();
   if(empty($datas[0]))
    {
      
      abort(404);
    }
      $name = 'Cabinet';
      $routeName = 'cell';
      return view('pages.cabinet',[
         
      'datas' => $datas[0],
      'name' =>$name,
      'routeName' => $routeName,
      'breadcrumbs' =>$breadcrumbs
      
      ]);  
   }

   public function createCell(Request $request)
   {
       
      $cell = new Cabinet;
      $cell->parent_id = $request->id;
      $cell->name = $request->file_name;
      $cell->type = 2;
      $cell->path ='/'.$request->url;
      $cell->save();
         return redirect()->back();
   }

   public function enterCell($cabinet,$id)
   {
      

      $datas = Cabinet::where('id',$id)
          ->where('parent_id',$cabinet)
          ->with(['getFilesFromCabinet','getFolderFromCabinet'])
          ->get();
         
          if(empty($datas[0]))
    {
      
      abort(404);
    }
       
      $name = 'Cell';
      $routeName = 'folder';
      return view('pages.cell',[
      'datas' => $datas[0],
      'name' =>$name,
      'routeName' => $routeName,
      
      ]);  
   }


    public function createFolder(Request $request)
   {
     
      $folder = new Cabinet;
      $folder->parent_id = $request->id;
      $folder->name = $request->file_name;
      $folder->path ='/'.$request->url;
      $folder->type = 3;
      $folder->save();
         return redirect()->back();
   }

 public function enterFolder($cabinet,$cell,$folder)
   {
    
    $file = Cabinet::where('id',$cell)->where('parent_id',$cabinet)->get();
    if(!empty($file[0]))
    {
      $data = Cabinet::where('id',$folder)
                    ->where('parent_id',$file[0]->id)
                    ->with(['getFilesFromCabinet'])
          ->get();

    }
    else
    {
      abort(404);
    }


          // dd($file);
  if(empty($data[0]))
    {
      abort(404);
    }
                      
     $name = 'Folder';
     return view('pages.folder',[
      'cabinet_id' =>$cabinet,
      'cell_id' => $cell,
     'datas' => $data[0],
     'name' =>$name,
    
      ]);  
   }





   public function createFile(Request $request)
   {
      $file = new File;
      $file->path ='/'.$request->url;

      $file->parent_id = $request->id;
      $file->name = $request->file_name;
      $file->body =$request->body;
      $file->save();
      return redirect()->back();
    
   }


   public function getAllData(Request $request)
   {
      $var = Cabinet::where('id',$request->id)->get();

      $data = Cabinet::where('type', '<', $var[0]->type)->orderBy('type','asc')->get();

     return Response()->json($data);
   }


   public function changeFolderPlace(Request $request)
   {

      Cabinet::where('id', $request->folderId)
            ->update(
              ['parent_id' => $request->folder_place],
              ['path' => '/'.$request->url],


            );
     
         return redirect()->back();
     dd($request->all());
   }


    // private function findPath($id)
    // {
    //   $array2 = [];
    //    $data =  Cabinet::where('id',$id)->get();

      
    //    if($data[0]->parent_id!=null)
    //    {
    //    $i = $this->findPath($data[0]->parent_id);
    //      array_push($this->array_data, $i );
    //    }
       
    //    switch ($data[0]->type) {
    //      case 1:

    //        $array2 = [$data[0]->type=>'/'];
    //        break;
    //        case 2:
    //        $array2 = [$data[0]->type=>$data[0]->parent_id];
    //        break;
    //        case 3:
    //        $array2 =[$data[0]->type=>$data[0]->parent_id];
    //        break;
    //    }
      
    //    return $array2;
    // }

   
}
