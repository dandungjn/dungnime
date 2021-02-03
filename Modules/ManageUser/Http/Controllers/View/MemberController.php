<?php

namespace Modules\ManageUser\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ManageUser\Http\Controllers\Helper\UserHelper;

class MemberController extends Controller
{
    /**
     * UserController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('member.index'), 'text' => 'Kelola Member'],
            ['href' => route('member.index'), 'text' => 'Member'],
        ];
        $this->helper = new UserHelper;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $table_headers = [
            [
                "text" => 'Nama Member',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama',
            ],
            [
                "text" => 'Email',
                "align" => 'left',
                "sortable" => false,
                "value" => 'email',
            ],
            [
                "text" => 'Nomor Handphone',
                "align" => 'center',
                "sortable" => false,
                "value" => 'telepon',
            ],
            [
                "text" => 'Terakhir Diubah',
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
           
        ];
        return view('manageuser::member.index')
             ->with('page_title', 'Member')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('member.create'), 'text' => 'Tambah Member'];

        return view('manageuser::member.create')
             ->with('page_title', 'Tambah Member')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with($this->helper->getHelper());
    }

    /**
     * Show the form for editing the specified resource.
     * @param User $member
     * @return Renderable
     */
    public function edit(User $member)
    {
        $this->breadcrumbs[] = ['href' => route('user.edit', [ $member->slug ]), 'text' => 'Ubah Member ' . $member->nama];

        return view('manageuser::member.edit')
             ->with('data', $member)
             ->with('page_title', 'Ubah Member ' . $member->nama)
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with($this->helper->getHelper());
    }
}
