<?php
    
class commentController {
    
    public $commentObjects = array();
    public $parents = array();
    public $count=0;
    private $sort = array();
    private $merdianNC=0;
    private $leftPtrNC;

    
    public function __construct($ctrl,$result,$eID){

        while($row = $result->fetch_assoc()) 
        {
            
            $timeSince = $ctrl->buildTime($row['created']);
            $this->commentObjects[] = new comment($row['userID'],$row['commentID'],$row['parentID'],
                $row['comment'],$row['dVotes'],$row['uVotes'],$timeSince,$row['firstName'],$eID,$row['updown']);
        }//end while
        
        foreach($this->commentObjects as $key => $C)
        {
            if(!$C->isUsed())
            {
                if(!$C->hasParent())
                {
                    $C->used();
                    $this->parents[]=$C;
                    unset($this->commentObjects[$key]);
                }//end if
            }//end if
        }//end foreach
        
        $this->recChildBuild($this->parents,$this->commentObjects);
        $this->recQuickSort(0,count($this->parents)-1);
        $count = count($this->parents);
        
        foreach($this->parents as $key => $p)
        {

            $p->printComment($key);

            $this->recChildPrint($p);

            echo '</div>';
            echo '</div>';

        }//end foreach

    unset($this->commentObjects);
    unset($this->parents);
    unset($this->count);
}//end construct
    
    public function recChildBuild($parents,$cO)
    {
        $newParents=array();
        if(count($cO)==0 && count($parents)==0)
        {
            return true;
        }//end if
        else
        {
            foreach($parents as $key => $p)
            {
                foreach($cO as $key1 => $C)
                {
                    if($p->getID()==$C->getParent())
                    {
                        $p->addChild($C);
                        $C->addParent($p);
                        unset($cO[$key1]);
                        $newParents[]=$C;
                    }//endif
                }//end foreach
            }//end foreach
            return $this->recChildBuild($newParents, $cO);
        }//end else
        unset($newParents);
        unset($cO);
    }//end recChildBuild
    
    public function recChildPrint($p)
    {
       $count=$this->count;
       $arr = array();
       $arr = $this->recQuickSortNC(0,count($p->myChildren)-1,$p->myChildren);

        foreach($arr as $key => $child)
            {                    
                if($count%2==0){
                    $style = 'even';
                }//end if
                else{
                    $style = 'odd';
                }//end else


                $child->printComment($count);

                
                $child->used();
                $this->count++;
                $this->recChildPrint($child);
                $this->count=0;
                echo '</div>';
                echo '</div>';
            }//end foreach                
    }//end recChildPrint




        // for the Nested Comment sorting
    
     private function recQuickSortNC($left,$right,$arr){
         $size = $right-$left+1;
         if($size<=3){
            return $this->manualSortNC($left,$right,$arr);
         }//end if
         else{
             $arr = $this->medianOf3NC($left,$right,$arr);
             $arr = $this->partitionItNC($left,$right,$this->merdianNC,$arr);
             $arr = $this->recQuickSortNC($left,$this->leftPtrNC-1,$arr);
             $arr = $this->recQuickSortNC($this->leftPtrNC+1,$right,$arr);
             return $arr;
         }//end else
     }//end quickSort

    private function medianOf3NC($left,$right,$arr){
        $center = ($left+$right)/2;
        if($arr[$left]->points<$arr[$center]->points){
            $arr=$this->swapNC($left,$center,$arr);
        }//end if
        if($arr[$left]->points<$arr[$right]->points){
            $arr=$this->swapNC($left,$right,$arr);
        }//end if
        if($arr[$center]->points<$arr[$right]->points){
            $arr=$this->swapNC($center,$right,$arr);
        }//end if
        $arr=$this->swapNC($center,$right-1,$arr);
        $this->merdianNC=$arr[$right-1];
        return $arr;

    }//end medianOf3

    private function partitionItNC($left,$right,$pivot,$arr){
        $leftPtr = $left-1;
        $rightPtr= $right;
        while(true){
            while($arr[++$leftPtr]->points>$pivot->points){continue;}
                while($arr[--$rightPtr]->points<$pivot->points){continue;}
                    if($leftPtr>=$rightPtr){ break;}
                    else{
                        $arr=$this->swapNC($leftPtr,$rightPtr,$arr);
                    }//end else
        }//end while
        $arr=$this->swapNC($leftPtr,$right-1,$arr);
        $this->leftPtrNC=$leftPtr;
        return $arr;
    }//end partitionIt

    private function swapNC($dex1,$dex2,$arr){
        $temp = $arr[$dex1];
        $arr[$dex1] = $arr[$dex2];
        $arr[$dex2]=$temp;
        return $arr;
    }//end swap

    private function manualSortNC($left,$right,$arr){
        $size = $right-$left+1;
        if($size<=1){
            return $arr;
        }//end if
        if($size==2){
            if($arr[$left]->points<$arr[$right]->points){
                $arr = $this->swapNC($left,$right,$arr);
            }//end if
            return $arr;
        }//end if
        else{
            if($arr[$left]->points<$arr[$right-1]->points){$arr=$this->swapNC($left,$right-1,$arr);}
                if($arr[$left]->points<$arr[$right]->points){$arr=$this->swapNC($left,$right,$arr);}
                    if($arr[$right-1]->points<$arr[$right]->points){$arr=$this->swapNC($right-1,$right,$arr);}
            return $arr;
        }//end else
    }//end manualSort

    //for parent Comments sort
     private function recQuickSort($left,$right){
         $size = $right-$left+1;
         if($size<=3){
            $this->manualSort($left,$right);
         }//end if
         else{
             $median = $this->medianOf3($left,$right);
             $partition = $this->partitionIt($left,$right,$median);
             $this->recQuickSort($left,$partition-1);
             $this->recQuickSort($partition+1,$right);
         }//end else
     }//end quickSort

    private function medianOf3($left,$right){
        $center = ($left+$right)/2;
        if($this->parents[$left]->points<$this->parents[$center]->points){
            $this->swap($left,$center);
        }//end if
        if($this->parents[$left]->points<$this->parents[$right]->points){
            $this->swap($left,$right);
        }//end if
        if($this->parents[$center]->points<$this->parents[$right]->points){
            $this->swap($center,$right);
        }//end if
        $this->swap($center,$right-1);
        return $this->parents[$right-1];

    }//end medianOf3

    private function partitionIt($left,$right,$pivot){
        $leftPtr = $left-1;
        $rightPtr= $right;
        while(true){
            while($this->parents[++$leftPtr]->points>$pivot->points){continue;}
                while($this->parents[--$rightPtr]->points<$pivot->points){continue;}
                    if($leftPtr>=$rightPtr){ break;}
                    else{
                        $this->swap($leftPtr,$rightPtr);
                    }//end else
        }//end while
        $this->swap($leftPtr,$right-1);
        return $leftPtr;
    }//end partitionIt

    private function swap($dex1,$dex2){
        $temp = $this->parents[$dex1];
        $this->parents[$dex1] = $this->parents[$dex2];
        $this->parents[$dex2]=$temp;
    }//end swap

    private function manualSort($left,$right){
        $size = $right-$left+1;
        if($size<=1){
            return;
        }//end if
        if($size==2){
            if($this->parents[$left]->points<$this->parents[$right]->points){
                $this->swap($left,$right);
            }//end if
            return;
        }//end if
        else{
            if($this->parents[$left]->points<$this->parents[$right-1]->points){$this->swap($left,$right-1);}
                if($this->parents[$left]->points<$this->parents[$right]->points){$this->swap($left,$right);}
                    if($this->parents[$right-1]->points<$this->parents[$right]->points){$this->swap($right-1,$right);}
        }//end else
    }//end manualSort



























}//end class commentController

?>
