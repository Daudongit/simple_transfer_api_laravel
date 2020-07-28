<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Balance;
use App\Transaction;

class TransferController extends Controller
{
    public function store(Request $request)
    {
        DB::transaction(function ()use($request) {
            $sender = Balance::where('account_nr',$request->from)->first();
            $sender->balance = $sender->balance - $request->amount;
            $sender->save();
            
            $receiver = Balance::where('account_nr',$request->to)->first();
            $receiver->balance = $receiver->balance - $request->amount;
            $receiver->save();
    
            Transaction::create([
                'reference'=>"receive_from_{$request->from}_".md5(time()),
                'amount'=>$request->amount,
                'account_nr'=>$request->to
            ]);
    
            Transaction::create([
                'reference'=>"send_to_{$request->to}_".md5(time()),
                'amount'=>$request->amount,
                'account_nr'=>$request->from
            ]);
        }); 
    
        return response()->json(['sucess'=>true]);
    }
}
