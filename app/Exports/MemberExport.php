<?php

namespace App\Exports;

use App\Models\Member;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MemberExport implements FromView
{
    public function view(): View
    {
        $members = Member::withCount('orderans')->withSum('orderans', 'harga_total')->get();
        return view('admin.download-member', [
            'members' => $members
        ]);
    }
}
