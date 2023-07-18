<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceOrderMailable;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        // $todayDate = Carbon::now();
        // $orders = Order::whereDate('created_at',$todayDate)->paginate(10);

        $todayDate = Carbon::now()->format('Y-m-d');
        $orders = Order::when($request->date != null,function($q) use($request){

                            return $q->whereDate('created_at',$request->date);
                        },function($q) use ($todayDate){

                            return $q->whereDate('created_at',$todayDate);

                        })
                        ->when($request->status != null , function($q) use($request){
                            
                            return $q->where('status_message', $request->status);
                        })
                        ->paginate(10);

        return view('admin.orders.index',compact('orders'));
    }

    public function show(int $orderId)
    {
        $order = Order::where('id',$orderId)->first();
        if($order){
            return view('admin.orders.view',compact('order'));

        }
        else{
            return redirect('admin/orders/')->with('message','Order Id Not Found');

        }

    }

    public function updateOrderStatus(int $orderId, Request $request)
    {
        $order = Order::where('id',$orderId)->first();
        if($order){
            $order->update([
                'status_message' => $request->order_status
            ]);
            return redirect('admin/orders/'.$orderId)->with('message','Order Status Updated');
        }
        else{
            return redirect('admin/orders/'.$orderId)->with('message','Order Id Not Found');

        }
    }

//47 view invoice
    public function viewInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        //the compact is to pass the variable($order) to the html page
        return view('admin.invoice.generate-invoice',compact('order'));

    }


//47 generate Invoice
    public function generateInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        
        //from the githup to print the invoice

        $data = ['order' => $order];
        $pdf = Pdf::loadView('admin.invoice.generate-invoice' , $data);

        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice-'.$order->id.'-'.$todayDate.'pdf');
    }

    //60 mail Invoice
    public function mailInvoice(int $orderId)
    {
        try{
            $order = Order::findOrFail($orderId);
        
            Mail::to("$order->email")->send(new InvoiceOrderMailable($order));
    
            return redirect('admin/orders/'.$orderId)->with('message','Invoice Mail has Been Sent to'.$order->email );

        }   
        catch(\Exption $e){
            return redirect('admin/orders/'.$orderId)->with('message','Something want wrong.!');

        } 
    }

    
}
