<?php

namespace App\Traits;
use Storage;

trait DatatablTrait {
  
    public function action($data) {
       return view('component.action')->with('list_item',$data)->render();
    }
    
    public function status($isYes, $id , $url , $table) {
        //dd($table);
            if( ($isYes=='yes' || $isYes=='YES' || $isYes=='Yes' ) && $isYes !== NULL ) {
                $isYes = '<div class="text-center">
                        <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input change-status" id="status_'.$id.'" name="status_'.$id.'" data-url="'.$url.'" data-table="'.$table.'" value="'.$id.'"  checked>
                        <label class="custom-control-label" for="status_'.$id.'"></label>
                        </div>
                    </div>';
            }else{
                $isYes ='
                        <div class="text-center">
                        <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input change-status" id="status_'.$id.'" name="status_'.$id.'" data-url="'.$url.'" value="'.$id.'" data-table="'.$table.'">
                        <label class="custom-control-label" for="status_'.$id.'"></label>
                        </div>
                    </div>';
            
            }
            return $isYes ;
    }
}   