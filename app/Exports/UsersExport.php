<?php

namespace App\Exports;


use App\Models\Member;
use App\Models\Share;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithStrictNullComparison
{
    protected $id;

    function __construct($form_date, $to_date) {
        $this->form_date = $form_date;
        $this->to_date = $to_date;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $allMember = Member::orderBy('name', 'desc')->get();
        $array = [];
        $array [1]['id']= 'Id';
        foreach ($allMember as $key => $data) {
            $array[$key] = [];
            if($this->form_date && $this->to_date){
                $form_date = Carbon::parse($this->form_date);
                $to_date = Carbon::parse($this->to_date)->addDay();
                $share = Share::where('member_id', $data->member_id)->where('created_at','<',$to_date)->where('created_at', '>=', $form_date)->get();
            }else{
                $share = Share::where('member_id', $data->member_id)->get();
            }
            $array[$key] ['id']= $data->id;
            $array[$key] ['member_id']= $data->member_id ;
            $array[$key] ['name']= $data->name;
            $array[$key] ['phone']= $data->phone;
            $array[$key] ['share_amount']= $share->sum('share_amount');
            $array[$key] ['deposit_amount']= $share->sum('deposit_amount'); 
            $array[$key] ['fine']= $share->sum('fine'); 
            $array[$key] ['others']= $share->sum('others'); 
            $array[$key] ['total']= $share->sum('share_amount')+$share->sum('deposit_amount')+$share->sum('fine')+$share->sum('others'); 
        }
            
        return collect($array);
    }
    public function headings(): array
    {
        return [
            ' #',
            ' User id',
            ' Name',
            ' Phone',
            ' Share Amount',
            ' Deposit Amount',
            ' Fine',
            ' Others',
            ' Total'
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                
                $cellRange = 'A1:I1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->insertNewRowBefore(1, 2);
                $event->sheet->mergeCells(sprintf('A1:I1'));
                $event->sheet->setCellValue('A1','SHOUHARDYA SANCHAYA & HRINDAN SAMABAYA SAMITY LTD.');
                $event->sheet->mergeCells(sprintf('A2:I2'));
                if($this->form_date && $this->to_date){
                    $event->sheet->setCellValue('A2','Share Report from '.$this->form_date. ' to '. $this->to_date);
                }else{
                    $event->sheet->setCellValue('A2','Share Report from all date');
                }
            },
        ];
    }
}
