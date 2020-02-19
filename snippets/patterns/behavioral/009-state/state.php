<?php

/*    
    Modify functionality of object by changing state.
    Video player is object which is controlled
    VideoPlayerContext is interface to controled object
    VideoPlayerContext change behavior by change state object in it
    State object change functionality of interface

    (pattern replac 'if's controling videoplayer state with state objects)
*/

class VideoPlayer {
    function play() 
    {
        echo "STATUS CHANGE: Video player play video\n";
    }

    function pause() 
    {
        echo "STATUS CHANGE:Video player stop play video\n";
        
    }

    function rewind() 
    {
        echo "STATUS CHANGE:Video player rewind to begining\n";
        
    }
}

class VideoPlayerContext
{
    private VideoPlayerState $state;
    private VideoPlayer $player;

    public function __construct(VideoPlayer $player){        
        $this->player = $player;
        $this->state = new StateOpened();
    }

    public function getVideoPlayer()
    {
        return $this->player;
    }

    public function setState(VideoPlayerState $state)
    {
        $this->state = $state;
    }

    function play() 
    {
        $this->state->play($this);
    }

    function pause() 
    {
        $this->state->pause($this);
    }

    function rewind() 
    {
        $this->state->rewind($this);
    }

}

interface VideoPlayerState
{
    public function play(VideoPlayerContext $context);
    public function pause(VideoPlayerContext $context);
    public function rewind(VideoPlayerContext $context);
}

class StateOpened implements VideoPlayerState
{
    function play(VideoPlayerContext $context) 
    {
        $player = $context->getVideoPlayer();
        $player->play();
        $context->setState(new StatePlaiing());
    }

    function pause(VideoPlayerContext $context) 
    {
        echo "ERROR: Can't pause wideo whitch not runing\n";
    }

    function rewind(VideoPlayerContext $context) 
    {
        echo "ERROR: Video is already on beggining\n";
    }
}

class StatePlaiing implements VideoPlayerState
{

    function play(VideoPlayerContext $context) 
    {
        echo "ERROR: Video is already plaiing\n";      
    }

    function pause(VideoPlayerContext $context) 
    {
        $player = $context->getVideoPlayer();
        $player->pause();
        $context->setState(new StatePaused());      
    }

    function rewind(VideoPlayerContext $context) 
    {
        $player = $context->getVideoPlayer();
        $player->rewind();
        $context->setState(new StateOpened());
    }
}

class StatePaused implements VideoPlayerState
{
    function play(VideoPlayerContext $context) 
    {
        $player = $context->getVideoPlayer();
        $player->play();
        $context->setState(new StatePlaiing());       
    }

    function pause(VideoPlayerContext $context) 
    {
        $player = $context->getVideoPlayer();  // if video is paused pause play video
        $player->play();
        $context->setState(new StatePlaiing());
    }

    function rewind(VideoPlayerContext $context) 
    {
        $player = $context->getVideoPlayer();
        $player->rewind();
        $context->setState(new StateOpened());
    }
}

$player = new VideoPlayer();
$videoPlayerContext = new VideoPlayerContext($player);

$videoPlayerContext->pause();
$videoPlayerContext->rewind();
$videoPlayerContext->play();

$videoPlayerContext->play();
$videoPlayerContext->pause();

$videoPlayerContext->play();
$videoPlayerContext->rewind();

$videoPlayerContext->play();
$videoPlayerContext->pause();
$videoPlayerContext->pause();
$videoPlayerContext->play();

