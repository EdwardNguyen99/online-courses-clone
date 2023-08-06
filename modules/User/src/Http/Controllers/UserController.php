<?php

namespace Modules\User\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\User\src\Http\Request\UserRequest;
use Modules\User\src\Repositories\UserRepository;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        $pageTitle = 'Quan ly nguoi dung';

        return view('user::lists', compact('pageTitle'));
    }
    public function create()
    {
        $pageTitle = 'Them nguoi dung';

        return view('user::add', compact('pageTitle'));
    }

    /***
     * @param  UserRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'password' => bcrypt($request->password),
          ]);

        return redirect()->route('admin.users.index')->with('msg', __('user::messages.create.success'));
    }

    /**
     * @return array
     */
    public function data()
    {
        $users = $this->userRepository->getAllUsers();

        return DataTables::of($users)
            ->addColumn('edit', function ($user) {
                return '<a href="' . route('admin.users.edit', $user) . '" class="btn btn-warning">Sửa</a>';
            })
            ->addColumn('delete', function ($user) {
                return '<a href="' . route('admin.users.delete', $user) . '" class="btn btn-danger delete-action">Xóa</a>';
            })
            ->editColumn('created_at', function ($user) {
                return Carbon::parse($user->created_at)->format('d/m/Y H:i:s');
            })
            ->rawColumns(['edit', 'delete'])
            ->toJson();
    }
    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            abort(404);
        }
        $pageTitle = 'Cap nhat nguoi dung';
        return view('user::edit', compact('user', 'pageTitle'));
    }
    public function update(UserRequest $request, $id)
    {
        $data = $request->except('__token', 'password');
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $this->userRepository->update($id, $data);
        return back()->with('msg', __('user::messages.update.success'));
    }
    public function delete($id)
    {
        $this->userRepository->delete($id);
        return back()->with('msg', __('user::messages.delete.success'));
    }
}
