<?php
/**
 * File name: PermissionController.php
 * Last modified: 2020.05.21 at 18:10:04
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 */

namespace App\Http\Controllers;

use App\DataTables\PermissionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Repositories\PermissionRepository;
use Flash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Request;
use Response;

class PermissionController extends Controller
{
    /** @var  PermissionRepository */
    private $permissionRepository;

    public function __construct(PermissionRepository $permissionRepo)
    {
        parent::__construct();
        $this->permissionRepository = $permissionRepo;
    }

    /**
     * Display a listing of the Permission.
     *
     * @param PermissionDataTable $permissionDataTable
     * @return Response
     */
    public function index(PermissionDataTable $permissionDataTable)
    {
        return $permissionDataTable->render('settings.permissions.index');
    }

    public function refreshPermissions(Request $request){
        Artisan::call('db:seed',['--class'=> 'DemoPermissionsPermissionsTableSeeder']);
        redirect()->back();
    }

    public function givePermissionToRole(Request $request){
        if(env('APP_DEMO',false)) {
            Flash::warning('This is only demo app you can\'t change this section ');
        }else{
            $input = Request::all();
            $this->permissionRepository->givePermissionToRole($input);
        }
    }

    public function revokePermissionToRole(Request $request){
        if(env('APP_DEMO',false)) {
            Flash::warning('This is only demo app you can\'t change this section ');
        }else{
            $input = Request::all();
            $this->permissionRepository->revokePermissionToRole($input);
        }
    }

    public function roleHasPermission(Request $request){
        $input = Request::all();
        //dd($input);
        $result = $this->permissionRepository->roleHasPermission($input);
        return json_encode($result);
    }


    /**
     * Show the form for creating a new Permission.
     *
     * @return Response
     */
    public function create()
    {
        return view('settings.permissions.create');
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param CreatePermissionRequest $request
     *
     * @return Response
     */
    public function store(CreatePermissionRequest $request)
    {
        if(env('APP_DEMO',false)) {
            Flash::warning('This is only demo app you can\'t change this section ');
            return redirect(route('permissions.index'));
        }
        $input = $request->all();

        $permission = $this->permissionRepository->create($input);

        Flash::success('Permission saved successfully.');

        return redirect(route('permissions.index'));
    }

    /**
     * Display the specified Permission.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $permission = $this->permissionRepository->findWithoutFail($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('permissions.index'));
        }

        return view('settings.permissions.show')->with('permission', $permission);
    }

    /**
     * Show the form for editing the specified Permission.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $permission = $this->permissionRepository->findWithoutFail($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('permissions.index'));
        }

        return view('settings.permissions.edit')->with('permission', $permission);
    }

    /**
     * Update the specified Permission in storage.
     *
     * @param int $id
     * @param UpdatePermissionRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update($id, UpdatePermissionRequest $request)
    {
        if(env('APP_DEMO',false)) {
            Flash::warning('This is only demo app you can\'t change this section ');
            return redirect(route('permissions.index'));
        }
        $permission = $this->permissionRepository->findWithoutFail($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('permissions.index'));
        }

        $permission = $this->permissionRepository->update($request->all(), $id);

        Flash::success('Permission updated successfully.');

        return redirect(route('permissions.index'));
    }

    /**
     * Remove the specified Permission from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        if(env('APP_DEMO',false)) {
            Flash::warning('This is only demo app you can\'t change this section ');
            return redirect(route('permissions.index'));
        }
        $permission = $this->permissionRepository->findWithoutFail($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('permissions.index'));
        }

        $this->permissionRepository->delete($id);

        Flash::success('Permission deleted successfully.');

        return redirect(route('permissions.index'));
    }
}
