<?php

namespace App\Modules\Admin\Analitics\Exports;

use App\Modules\Admin\User\Models\User;
use App\Services\Date\DateService;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeadsExport implements FromCollection, WithHeadings
{
    private $user;
    private $dateStart;
    private $dateEnd;

    /**
     * LeadsExport constructor.
     * @param $user
     */
    public function __construct(User $user, $dateStart = null, $dateEnd = null)
    {
        $this->user = $user;

        //set date
        $this->dateStart = new Carbon('first day of this month');
        if (isset($dateStart) && DateService::isValid($dateStart, "d.m.Y")) {
            $this->dateStart = Carbon::createFromFormat("d.m.Y", $dateStart);
        }

        $this->dateEnd = new Carbon('last day of this month');
        if (isset($dateEnd) && DateService::isValid($dateEnd, "d.m.Y")) {
            $this->dateEnd = Carbon::createFromFormat("d.m.Y", $dateEnd);
        }
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $leads = $this->user->leads()
            ->whereDate('leads.created_at', '>=', $this->dateStart)
            ->whereDate('leads.created_at', '<=', $this->dateEnd)
            ->with('source','unit','user')
            ->where('status_id','3')
            ->get();

        return $leads->map(function($item) {
            return [
                is_object($item->created_at) ? $item->created_at->format('d.m.Y') : Carbon::now()->format('d.m.Y'),
                $item->user->firstname,
                $item->link,
                $item->phone,
                $item->source ? $item->source->title : '',
                $item->unit ? $item->unit->title : '',
                $item->isQualityLead ? 'Да' : 'Нет',
                $item->is_add_sale  ? 'Да' : 'Нет',
                $item->is_robot  ? 'Да' : 'Нет',
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Дата',
            'Менеджер',
            'Ссылка',
            'Телефон',
            'Источник',
            'Подразделение',
            'Статус',
            'Доп. продажа',
            'Создан роботом',
        ];
    }
}
