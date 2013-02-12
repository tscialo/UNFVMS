<?php

class comment {
    public $eID;
    public $userID;
    public $recipID;
    public $commentID;
    public $parentID;
    public $parentC;
    public $dVotes;
    public $uVotes;
    public $points;
    public $deleted;
    public $comment;
    public $created;
    public $used=false;
    public $myChildren=array();
    public $name;
    public $userName;
    public $updown=null;

    public function __construct($userID,$commentID,$parentID,$comment,$dVotes,$uVotes,$created,$name,$eID,$updown) {        
        $this->eID=$eID;
        $this->userID=$userID;
        //$this->recipID=$recipID;
        $this->commentID=$commentID;
        $this->parentID=$parentID;
        $this->dVotes=$dVotes;
        $this->uVotes=$uVotes;
        $this->comment=$comment;
        $this->created=$created;
        $this->name=$name;
        $this->userName=$name;
        $this->points = $uVotes - $dVotes;

        if(!is_null($updown)){
            $this->updown=$updown;
        }
        else{
            $this->updown='null';
        }
    }//end construct

    public function hasParent()
    {
        if($this->parentID==0){ return false;}
        else {return true;}
    }//end hasParent

    public function getID()
    {
        return $this->commentID;
    }//end getId

    public function getParent()
    {
        return $this->parentID;
    }//end getParent

    public function used()
    {
        $this->used=true;
    }//end used

    public function isUsed()
    {
        return $this->used;
    }//end isUsed

    public function addChild($c)
    {
        $this->myChildren[]=$c;
    }//end addChild

    public function addParent($c)
    {
        $this->parentC=$c;
    }//end addParent

    public function hasChildren()
    {
        if(count($this->myChildren)==0)
            return false;
        else
            return true;
    }//end hasChildren

    public function childCount()
    {
        return count($this->myChildren);
    }//end childCount

    private function childPrint()
    {
        if($this->childCount()==1)
            return '(1 child)';
        else
            return '('.$this->childCount().' children)';
    }//end childPrint

    public function voteArrows()
    {
        $uSrc="";
        $dSrc="";
        if($this->updown!='null'){
            if($this->updown==1){
                $uSrc='scripts/upVote.png';
                $dSrc='scripts/downArrow.png';
            }//end if
            else{
                $uSrc='scripts/upArrow.png';
                $dSrc='scripts/downVote.png';
            }//end else
        }//end if
        else{
            $uSrc='scripts/upArrow.png';
            $dSrc='scripts/downArrow.png';
        }//end else

        return '<div class=arrows><ul><li><img id="upArrow'.$this->commentID.'" class="imgVote" updown='.$this->updown.' src="'.$uSrc.'" onclick="upVote(this)" commentID='.$this->commentID.'
            linkID='.$this->eID.' userID='.$this->userID.'></img></li>
            <li><img id="downArrow'.$this->commentID.'" class="imgVote"  onclick="downVote(this)" src="'.$dSrc.'" updown='.$this->updown.' commentID='.$this->commentID.' eID='.$this->eID.' userID='.$this->userID.'></img></li></ul></div>';
    }//end voteArrows

    public function getHeader()
    {
        return '<div class="cHeader">
                    <span>'.$this->userName.'</span>
                    <span class="cNumVotes">'.$this->points.'</span>
                    <span class="cVotes">'.$this->getPoints().'(<span>'.$this->uVotes.'</span>
                    |
                    <span style="color:#cc0033;">'.abs($this->dVotes).'</span>) - '.$this->created.'</span>
                </div>';
    }//end getHeader

    public function getHiddenHeader()
    {
        return '<p class="cHeader cHHleft" style="display: none">'.$this->userName.'
                    <span class=cVotes>'.($this->uVotes - $this->dVotes).' '.$this->getPoints().' '
                    .$this->created.' '.$this->childPrint().'
                    </span>
                </p>';
    }//end getHiddenHeader

    public function getPoints(){

        if($this->points==1)
            return 'point';
        else
            return 'points';

    }//end getPoints

    public function getFooter($s)
    {
        return '<div class="commentReplyButton">Reply</div>';
    }//end getFooter

    public function replyForm($s)
    {
        $form = '<div class="replyForm"><form id=rF'.$this->commentID.' method="POST" >
        <input type="hidden" name="recipID" value="'.$this->userID.'" />
        <input type="hidden" name="parentID" value="'.$this->commentID.'" />
        <input type="hidden" name="isAJAX" value=1>
        <input type="hidden" name="eo" value="'.$s.'" />

        <textarea id="commentPostReply'.$this->commentID.'" class="rField commentPostReply" wrap="hard" style="width:325px;height:200px;" name="text"></textarea>
        <ul><li><input onKeyPress="return event.keyCode!=13" class="submitComment" cid="'.$this->commentID.'" name="comment" class="submit" value="Submit"/></li></ul>
        </form>
        </div>';

        return $form;
    }//end replyForm

    public function printComment($count){
        if($this->parentID!=0){
            $class ='cChild';
            if($count%2==0){
                $style='even';
            }//end if
            else{
                $style='odd';
            }//end else
        }//end if
        else{
            $class='cParent';
            $style='odd';
        }//end else



        echo '<div class="'.$class.' '.$style.'">';
        echo '<span class="toggleCommentView">[-]</span>';
        echo $this->getHiddenHeader();
        echo '<div class=cWrap cID="'.$this->commentID.'" uID="'.$this->userID.'">';
        echo '<div class="cRight">';
        echo $this->getHeader();
        echo '<div class="discComment">'.$this->comment.'</div>';
        echo '</div><!--end cRight-->';
        echo $this->getFooter('odd');
    }//end print comment

}//end comment

?>
