<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;
use App\Moda;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $stocksTable = \Lava::DataTable();

        $stocksTable->addStringColumn('Trucks')
                    ->addNumberColumn('Free')
                    ->addNumberColumn('Used');

        // // Random Data For Example
        // for ($a = 1; $a < 5; $a++) {
        //     $stocksTable->addRow([
        //     '2015-10-' . $a, rand(800,1000), rand(800,1000)
        //     ]);
        // }
        $chart = \Lava::ColumnChart('MyStocks', $stocksTable,['isStacked'  => true,  'title' => 'Graphic Vehicle Usage', 'hAxis' => ['title' => 'Trucks']]);
        // $datas = $chart->render('LineChart', 'MyStocks', 'stocks-chart');
        // Carbon::setLocale('id');
        $now = Carbon::now()->setTimezone('Asia/Jakarta');
        $datas['nowDate'] = $now->format('l, d F Y');
        $datas['greeting'] = '';
        if ($now->hour < 12) {
            $datas['greeting'] = 'morning';
        } else if ($now->hour < 18) {
            $datas['greeting'] = 'afternoon';
        } else {
            $datas['greeting'] = 'evening';
        }
        $datas['outstanding'] = Order::where('status','=','0')->count();
        // $datas['expire'] = Moda::where([['endTo','>',$now],['endTo','<',$now->addWeek()]])->count();
        $datas['expire'] = Moda::whereBetween('endTo',[Carbon::now(), $now->addWeek()])->count();
        $namaList = (Moda::select('nama')->distinct()->get());
        foreach ($namaList as $value) {
            $stocksTable->addRow([
                ($value['nama']), Moda::where([['nama',$value['nama']],['quantity','>','0']])->count(), Moda::where([['nama',$value['nama']],['quantity','0']])->count()
                ]);
        }
        $firstDay = Carbon::now()->subDays(3);
        $lastDay = Carbon::now()->addDays(3);
        
        $handlingTbl = \Lava::DataTable();

        $handlingTbl->addStringColumn('Date')
                    ->addNumberColumn('Outstanding')
                    ->addNumberColumn('In Delivery')
                    ->addNumberColumn('Delivered');
        $handling = \Lava::ColumnChart('Handling', $handlingTbl,['isStacked'  => true,  'title' => 'Graphic Sales Order Handling' . "\nfrom " . $firstDay->format('Y-m-d') . ' to ' . $lastDay->format('Y-m-d'), 'hAxis' => ['title' => 'Date']]);
        
        while (!($firstDay->isSameDay($lastDay))) {
            $dataOrder = Order::where('deliveryDate',$firstDay->format('Y-m-d'))->get();
            $outs = 0;
            $indel = 0;
            $deliv = 0;
            foreach($dataOrder as $val) {
                if ($val['status'] == 0) {
                    $outs++;
                } else if ($val['status'] == 1) {
                    $indel++;
                } else {
                    $deliv++;
                }
            }
            $handlingTbl->addRow([$firstDay->format('d-m'),$outs,$indel,$deliv]);
            $firstDay->addDay();
            
        }

        return view('newHome', compact('datas'));
    }
}
