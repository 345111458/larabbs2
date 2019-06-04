<?php

namespace App\Observers;

use App\Models\Reply;


use App\Notifications\TopicReplied;
// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{

	// 创建数据时，
    public function creating(Reply $reply)
    {

    	// $reply->content = clean($reply->content , 'user_topic_body');
    }

    public function updating(Reply $reply)
    {
        //
    }


    //监控 入库【前】执行
    public function saving(Reply $reply){
    	$reply->content = clean($reply->content , 'user_topic_body');
    }


    //监控 入库【后】执行
    public function saved(Reply $reply){

    	$reply->topic->reply_count = $reply->topic->replies->count();
    	$reply->topic->save();

    	$reply->topic->user->notify(new TopicReplied($reply));
    }


    public function deleted(Reply $reply){

        $reply->topic->updateReplyCount();
    }

    
}