<?php

namespace App\Http\Controllers\Admin;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Model\DL\User;
use App\Model\DL\Business;
use App\Model\DL\Manager;
use App\Model\DL\FeedBackBusiness;
use App\Model\DL\OrderWithBusiness;
use App\Model\DL\OrderOnlySend;
use App\Model\DL\OrderUserThree;



class SimplyGetMessageController extends Controller
{

    public function __construct()
    {
        
    }

    public function handle(Request $request, $type)
    {
        /*
        $b = OrderOnlySend::find(12);
        $a = $b->toArray();
        foreach($a as $k => $v)
        {
            echo "\t\t\t'' => \$this->{$k},\n";
        }
        print_r($b);
        print_r($b->toArr());
        return '';
        */
        
        

        $type = str_replace('-', '_', $type);
        if(!method_exists($this, $type)) return '';
        $query = $this->$type();
        $count = $query->count();
        $this->limitaion($request, $query);
        $items = $query->get();
        $container = [];
        foreach($items as $item)
        {
            $container[] = $item->toArr();
        }
        return [
            'total' => $count,
            'rows' => $container,
        ];
    }

    protected function limitaion($request, $query)
    {
        $pageSize = (int) $request->input('pageSize', 10);
        $pageNumber = (int) $request->input('pageNumber', 1);
        $offset = ($pageNumber - 1) * $pageSize;
        $query->offset($offset)->limit($pageSize);
    }

    protected function business_getAllBusinessPage()
    {
        return Business::where('state', 1);
    }

    protected function business_getAllBusinessSettledPage()
    {
        return Business::whereNotNull('BUSINESS_ID');
    }

    protected function orderWithBusiness_getAllPage()
    {
        return OrderWithBusiness::whereNotNull('ORDER_WITH_BUSINESS_ID');
    }

    protected function feedBackBusiness_getAllPage()
    {
        return FeedBackBusiness::whereNotNull('FEEDBACK_BUSINESS_ID');
    }

    protected function manager_getAllManagerPage()
    {
        return Manager::whereNotNull('STSTEM_MANANGER_ID');
    }

    protected function user_getAllPage()
    {
        return User::whereNotNull('ID');
    }

    protected function orderUserThree_getAllPage()
    {
        return OrderUserThree::whereNotNull('ORDER_USER_THREE_ID');
    }

    protected function orderOnlySend_getAllPage()
    {
        return OrderOnlySend::whereNotNull('ORDER_ONLY_SEND_ID');
    }

    

    


}
