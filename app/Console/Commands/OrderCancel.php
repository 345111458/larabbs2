<?php

namespace App\Console\Commands;

use App\Http\Models\Topic;
use Illuminate\Console\Command;

class OrderCancel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:cancel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '30分钟未付款取消订单';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws
     */
    public function handle()
    {
        try {
            $unPaid = Topic::where('created_at','<',time()-30*60) //创建时间在30分钟以前
            ->where('category_id',1) // 刚下单未支付
            ->get();
            foreach ($unPaid as $order) {
                $order->cancel(); // 执行取消动作
            }
        } catch (\Exception $e) {
            throw $e;
        }
        return true;
    }
}