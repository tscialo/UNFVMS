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
        $this->tabID=$tabID;
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
        return '<div class=cHeader id=cHeader'.$this->commentID.'><a href="index.php?tab=411&single='.$this->userID.'">'.$this->userName.'</a>
            <span class=cNumVotes id=votes'.$this->commentID.'>'.$this->points.'</span> <span class=cVotes>'.$this->getPoints().'
            (<span id=posVotes'.$this->commentID.'>'.$this->uVotes.'</span>|<span style="color:#cc0033;" id=negVotes'.$this->commentID.'>'.abs($this->dVotes).'</span>)'
            .' - '.$this->created.'</span></div>';
    }//end getHeader

    public function getHiddenHeader()
    {
        return '<p class="cHeader cHHleft" id=cHHeader'.$this->commentID.' style="display: none">'.$this->userName.' <span class=cVotes>'.($this->uVotes - $this->dVotes).' '.$this->getPoints().' '
            .$this->created.' '.$this->childPrint().'</span></p>';
    }//end getHiddenHeader

    public function getPoints(){

        if($this->points==1)
            return 'point';
        else
            return 'points';

    }//end getPoints

    public function getFooter($s)
    {
        return '<div class=cFooter>'.$this->replyClick().'</div><!--end cFooter-->'.$this->replyBox($s);
    }//end getFooter

    public function replyClick()
    {
        return '<a class="replyButton" title='.$this->commentID.' a="0" id="discComReply"><span class="bannerButton">Reply</span></a>';
    }//end replyClick

    public function replyBox($s)
    {
        return '<div id=replyDiv'.$this->commentID.' class=replyH style="display: none">'.$this->replyForm($s).'</div>';
    }//end replyBox

    public function getHiddenFooter(){
        return '<div id=hF'.$this->commentID.' style="display:none"></div>';
    }//end getHiddenFooter

    public function replyForm($s)
    {
        $form = '<div class="replyForm"><form id=rF'.$this->commentID.' method="POST" >
        <input type="hidden" name="linkID" value="'.$this->eID.'" />
        <input type="hidden" name="tab" value="'.$this->tabID.'" />
        <input type="hidden" name="ouID" value="'.$this->userID.'" />
        <input type="hidden" name="parentID" value="'.$this->commentID.'" />
        <input type="hidden" name="isAJAX" value=1>
        <input type="hidden" name="eo" value="'.$s.'" />

        <textarea id="commentPostReply'.$this->commentID.'" class="rField commentPostReply" wrap="hard" style="width:325px;height:200px;" name="text"></textarea>
        <ul><li><input onKeyPress="return event.keyCode!=13" class="submitComment" t="'.$this->tabID.'" cid="'.$this->commentID.'" name="comment" class="submit" value="Submit"/></li></ul>
        </form>
        </div>';

        return $form;
    }//end replyForm

}//end comment

?>
