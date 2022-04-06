<?php

namespace App\Http\Controllers;

use App\Models\Callists;
use Illuminate\Http\Request;

class CallistsController extends Controller
{
    //    
    /**
     * showGroup List
     *
     * @param  mixed $goupid
     * @return void
     */
    public function showGroup($groupid)
    {
        $callists = Callists::where('clid', $groupid)->orderBy('level','asc')->get();
        return view('callists.show', [
            'callists' => $callists,
            'groupID' => $groupid,
        ]);
    }    
    /**
     * SendCallist ID to the top base on clid group
     *
     * @param  mixed $id
     * @return void
     */
    public function moveTop($id)
    {
        $getCallistDetails = Callists::find($id);
        $clid = $getCallistDetails->clid;
        $getlevels = Callists::where('clid', $clid)->orderBy('level', 'asc')->get();


        $getList = array();
        foreach ($getlevels as $list) {
            array_push($getList, [
                'id' => $list->id,
                'level' => $list->level
            ]);
        }
        // echo 'Old List: <br/>';
        // echo '<pre>';
        // print_r($getList);
        // echo '</pre>';

        if($getCallistDetails->level == $getlevels[0]['id']){
            return redirect()->route('grouplist', ['groupid'=> $clid]);
        }else{

            $max = count($getList);
            $getRank = array_search($getCallistDetails->level, array_column($getList, 'level'));
            // echo '<br> eto :'.$getRank;
            // echo '<br> newRankList: ';

            $newRankList = array();
            // bring the selected ID to the top.
            array_push($newRankList, [
                'id'=> $getList[$getRank]['id'],
                'level'=>$getList[0]['level']
            ]);

            // get the next data before it.
            for($i=0; $i<$getRank;$i++){
                array_push($newRankList,[
                    'id'=>$getList[$i]['id'],
                    'level'=>$getList[$i+1]['level']
                ]);
            }
            // get the next data after it.
            for($a=$getRank+1; $a<$max; $a++){
                array_push($newRankList, [
                    'id'=>$getList[$a]['id'],
                    'level'=>$getList[$a]['level']
                ]);
            }
            // echo '<pre>';
            // print_r($newRankList);
            // echo '</pre>';

            // save the new List Order
            for($b=0; $b<$max; $b++){
                $newUpdate = Callists::find($newRankList[$b]['id']);
                $newUpdate->level = $newRankList[$b]['level'];
                $newUpdate->save();
                echo 'save';
            }
            // return to group list
            return redirect()->route('grouplist', ['groupid' => $clid]);
        }
    }

    public function moveUp($id)
    {
        $getCallistDetails = Callists::find($id);
        $clid = $getCallistDetails->clid;
        $getlevels = Callists::where('clid', $clid)->orderBy('level', 'asc')->get();

        $getList = array();
        foreach ($getlevels as $list) {
            array_push($getList, [
                'id' => $list->id,
                'level' => $list->level
            ]);
        }
        
        $max = count($getList);
        $getRank = array_search($getCallistDetails->level, array_column($getList, 'level'));
        if($getRank != 0){
            
            $newRankList = array();
            // get the next data before it.
            for ($i = 0; $i < $getRank-1; $i++) {
                array_push($newRankList, [
                    'id' => $getList[$i]['id'],
                    'level' => $getList[$i]['level']
                ]);
            }

            // the selected ID
            array_push($newRankList, [
                'id' => $getList[$getRank]['id'],
                'level' => $getList[$getRank - 1]['level']
            ]);
            // next data after seelcted.
            array_push($newRankList, [
                'id' => $getList[$getRank-1]['id'],
                'level' => $getList[$getRank]['level']
            ]);
            // get the next next data after it.
            for ($a = $getRank+1; $a < $max; $a++) {
                array_push($newRankList, [
                    'id' => $getList[$a]['id'],
                    'level' => $getList[$a]['level']
                ]);
            }
            // save the new List Order
            for ($b = 0; $b < $max; $b++) {
                $newUpdate = Callists::find($newRankList[$b]['id']);
                $newUpdate->level = $newRankList[$b]['level'];
                $newUpdate->save();
                echo 'save';
            }
            // return to group list
            return redirect()->route('grouplist', ['groupid' => $clid]);
        }else{
            // return to group list
            return redirect()->route('grouplist', ['groupid' => $clid]);
        }
    }

    public function moveDown($id)
    {
        $getCallistDetails = Callists::find($id);
        $clid = $getCallistDetails->clid;
        $getlevels = Callists::where('clid', $clid)->orderBy('level', 'asc')->get();

        $getList = array();
        foreach ($getlevels as $list) {
            array_push($getList, [
                'id' => $list->id,
                'level' => $list->level
            ]);
        }
        echo 'Old List: <br/>';
        echo '<pre>';
        print_r($getList);
        echo '</pre>';


        $max = count($getList);
        $getRank = array_search($getCallistDetails->level, array_column($getList, 'level'));
        if ($getRank < $max-1) {

            $newRankList = array();

            if($getRank == 0){
                array_push($newRankList, [
                    'id' => $getList[$getRank+1]['id'],
                    'level' => $getList[$getRank]['level']
                ]);

                // the selected ID
                array_push($newRankList, [
                    'id' => $getList[$getRank]['id'],
                    'level' => $getList[$getRank + 1]['level']
                ]);
            }else{
                //2 data before selected ID 
                for($a=0; $a<$getRank;$a++){
                    array_push($newRankList, [
                        'id' => $getList[$a]['id'],
                        'level' => $getList[$a]['level']
                    ]);
                }
                // before the Selected ID
                array_push($newRankList, [
                    'id' => $getList[$getRank+1]['id'],
                    'level' => $getList[$getRank]['level']
                ]);

                // the selected ID
                array_push($newRankList, [
                    'id' => $getList[$getRank]['id'],
                    'level' => $getList[$getRank + 1]['level']
                ]);
            }
            

            // 2 data after the selected ID
            for($i=$getRank+2;$i<$max;$i++){
                array_push($newRankList, [
                    'id' => $getList[$i]['id'],
                    'level' => $getList[$i]['level']
                ]);
            }

            
            echo '<pre>';
            print_r($newRankList);
            echo '</pre>';

            // // save the new List Order
            for ($b = 0; $b < $max; $b++) {
                $newUpdate = Callists::find($newRankList[$b]['id']);
                $newUpdate->level = $newRankList[$b]['level'];
                $newUpdate->save();
                echo 'save';
            }
            // // return to group list
            return redirect()->route('grouplist', ['groupid' => $clid]);
        }else{
            // return to group list
            return redirect()->route('grouplist', ['groupid' => $clid]);
        }
    }
    public function moveBottom($id)
    {
        $getCallistDetails = Callists::find($id);
        $clid = $getCallistDetails->clid;
        $getlevels = Callists::where('clid', $clid)->orderBy('level', 'asc')->get();

        $getList = array();
        foreach ($getlevels as $list) {
            array_push($getList, [
                'id' => $list->id,
                'level' => $list->level
            ]);
        }
        echo 'Old List: <br/>';
        echo '<pre>';
        print_r($getList);
        echo '</pre>';


        $max = count($getList);
        $getRank = array_search($getCallistDetails->level, array_column($getList, 'level'));
        if ($getRank == $max - 1) {
            // return to group list
            return redirect()->route('grouplist', ['groupid' => $clid]);
        }else{

            $newRankList = array();

            if($getRank == 0){
                //after selected will be bring on the top of it..
                for ($i = 1; $i < $max; $i++) {
                    array_push($newRankList, [
                        'id' => $getList[$i]['id'],
                        'level' => $getList[$i-1]['level']
                    ]);
                }
                //selected ID
                array_push($newRankList, [
                    'id' => $getList[$getRank]['id'],
                    'level' => $getList[$max-1]['level']
                ]);
            }else{
                // before the Selected ID
                for($i=0;$i<$getRank;$i++){
                    array_push($newRankList, [
                        'id' => $getList[$i]['id'],
                        'level' => $getList[$i]['level']
                    ]);
                }
                for ($i = $getRank+1; $i < $max; $i++) {
                    array_push($newRankList, [
                        'id' => $getList[$i]['id'],
                        'level' => $getList[$i-1]['level']
                    ]);
                }
                //selected ID
                array_push($newRankList, [
                    'id' => $getList[$getRank]['id'],
                    'level' => $getList[$max - 1]['level']
                ]);
            }

            echo '<pre>';
            print_r($newRankList);
            echo '</pre>';

            // save the new List Order
            for ($b = 0; $b < $max; $b++) {
                $newUpdate = Callists::find($newRankList[$b]['id']);
                $newUpdate->level = $newRankList[$b]['level'];
                $newUpdate->save();
                echo 'save';
            }

            // return to group list
            return redirect()->route('grouplist', ['groupid' => $clid]);
        } 
    }
}
