<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Http\Requests\Front\UserRequest;
use App\Services\Front\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $service;

    /**
     * @param UserService $repository
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $datas = $this->service->paginate($request->perpage ?? 10);
        return inertia("front/user/index", compact("datas"));
    }

    /**
     * @param  string $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show($id)
    {
        $data = $this->service->find($id);
        return view("front.user.show", compact("data"));
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view("front.user.create");
    }

    /**
     * @param  UserRequest  $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->back()->withInput()->with("success", "保存しました");
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        $data = $this->service->find($id);
        return view("front.user.create", compact("data"));
    }

    /**
     * @param  CustomerRequest  $request
     * @param  string $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        $a = $this->service->update($id, $request->validated());
        return redirect()->back()->withInput()->with("success", "更新しました");
    }

    /**
     * @param  string $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $a = $this->service->delete($id);
        return redirect(route("user.index"))->withInput()->with("success", "削除しました");
    }
}
