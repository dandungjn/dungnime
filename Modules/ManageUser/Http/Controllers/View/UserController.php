<?php

namespace Modules\ManageUser\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ManageUser\Entities\User;
use Modules\ManageUser\Http\Controllers\Helper\UserHelper;

class UserController extends Controller
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
            ['href' => route('user.index'), 'text' => 'Kelola User'],
            ['href' => route('user.index'), 'text' => 'User'],
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
                "text" => 'User',
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
                "text" => 'Grup User',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama_grup_user',
            ],
            [
                "text" => 'Terakhir Diubah',
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
           
        ];
        return view('manageuser::user.index')
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
        $this->breadcrumbs[] = ['href' => route('user.create'), 'text' => 'Tambah User'];

        return view('manageuser::user.create')
             ->with('page_title', 'Tambah User')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with($this->helper->getHelper());
    }

    /**
     * Show the form for editing the specified resource.
     * @param User $user
     * @return Renderable
     */
    public function edit(User $user)
    {
        $this->breadcrumbs[] = ['href' => route('user.edit', [ $user->slug ]), 'text' => 'Ubah User ' . $user->nama];

        return view('manageuser::user.edit')
             ->with('data', $user)
             ->with('page_title', 'Ubah User ' . $user->nama)
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with($this->helper->getHelper());
    }
}
