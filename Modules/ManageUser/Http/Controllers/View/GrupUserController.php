<?php

namespace Modules\ManageUser\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ManageUser\Entities\UserGroup;
use Modules\ManageUser\Http\Controllers\Helper\GrupUserHelper;

class GrupUserController extends Controller
{
    /**
     * GrupUserController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('grup-user.index'), 'text' => 'Kelola User'],
            ['href' => route('grup-user.index'), 'text' => 'Grup User'],
        ];
        $this->helper = new GrupUserHelper;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $table_headers = [
            [
                "text" => 'Nama Grup User',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama',
            ],
            [
                "text" => 'Deskripsi',
                "align" => 'left',
                "sortable" => false,
                "value" => 'deskripsi',
            ],
            [
                "text" => 'Terakhir Diubah',
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
           
        ];
        return view('manageuser::grup_user.index')
             ->with('page_title', 'User')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('grup-user.create'), 'text' => 'Tambah Grup User'];

        return view('manageuser::grup_user.create')
             ->with('page_title', 'Tambah Grup User')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with($this->helper->getHelper());
    }

    /**
     * Show the form for editing the specified resource.
     * @param User $grup_user
     * @return Renderable
     */
    public function edit(UserGroup $grup_user)
    {
        $this->breadcrumbs[] = ['href' => route('grup-user.edit', [ $grup_user->slug ]), 'text' => 'Ubah Grup User ' . $grup_user->nama];

        return view('manageuser::grup_user.edit')
             ->with('data', $grup_user)
             ->with('page_title', 'Ubah Grup User ' . $grup_user->nama)
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with($this->helper->getHelper());
    }
}
