<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Usuario\BulkDestroyUsuario;
use App\Http\Requests\Admin\Usuario\DestroyUsuario;
use App\Http\Requests\Admin\Usuario\IndexUsuario;
use App\Http\Requests\Admin\Usuario\StoreUsuario;
use App\Http\Requests\Admin\Usuario\UpdateUsuario;
use App\Models\Usuario;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UsuariosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexUsuario $request
     * @return array|Factory|View
     */
    public function index(IndexUsuario $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Usuario::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id'],

            // set columns to searchIn
            ['id']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.usuario.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.usuario.create');

        return view('admin.usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUsuario $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreUsuario $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Usuario
        $usuario = Usuario::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/usuarios'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param Usuario $usuario
     * @throws AuthorizationException
     * @return void
     */
    public function show(Usuario $usuario)
    {
        $this->authorize('admin.usuario.show', $usuario);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Usuario $usuario
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Usuario $usuario)
    {
        $this->authorize('admin.usuario.edit', $usuario);


        return view('admin.usuario.edit', [
            'usuario' => $usuario,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUsuario $request
     * @param Usuario $usuario
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateUsuario $request, Usuario $usuario)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Usuario
        $usuario->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/usuarios'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyUsuario $request
     * @param Usuario $usuario
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyUsuario $request, Usuario $usuario)
    {
        $usuario->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyUsuario $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyUsuario $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Usuario::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
