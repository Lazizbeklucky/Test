<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabinet extends Model
{
   public function getCellFromCabinet()
   {
   	   return $this->hasMany(Cabinet::class,'parent_id')->where('type',2)->orderBy('created_at', 'desc');
   }
   public function getFilesFromCabinet()
   {
   	return $this->hasMany(File::class,'parent_id')->orderBy('created_at', 'desc');
   }

    public function getFolderFromCabinet()
   {
   	   return $this->hasMany(Cabinet::class,'parent_id')->where('type',3)->orderBy('created_at', 'desc');
   }

   
}
