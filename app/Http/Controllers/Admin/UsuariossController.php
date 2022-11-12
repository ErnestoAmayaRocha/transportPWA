<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Usuarioss\BulkDestroyUsuarioss;
use App\Http\Requests\Admin\Usuarioss\DestroyUsuarioss;
use App\Http\Requests\Admin\Usuarioss\IndexUsuarioss;
use App\Http\Requests\Admin\Usuarioss\StoreUsuarioss;
use App\Http\Requests\Admin\Usuarioss\UpdateUsuarioss;
use App\Models\Usuarioss;
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

class UsuariossController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexUsuarioss $request
     * @return array|Factory|View
     */
    public function index(IndexUsuarioss $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Usuarioss::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'nombre', 'correo', 'telefono'],

            // set columns to searchIn
            ['id', 'nombre', 'correo', 'telefono']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.usuarioss.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.usuarioss.create');

        return view('admin.usuarioss.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUsuarioss $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreUsuarioss $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Usuarioss
        $usuarioss = Usuarioss::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/usuariosses'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/usuariosses');
    }

    /**
     * Display the specified resource.
     *
     * @param Usuarioss $usuarioss
     * @throws AuthorizationException
     * @return void
     */
    public function show(Usuarioss $usuarioss)
    {
        $this->authorize('admin.usuarioss.show', $usuarioss);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Usuarioss $usuarioss
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Usuarioss $usuarioss)
    {
        $this->authorize('admin.usuarioss.edit', $usuarioss);


        return view('admin.usuarioss.edit', [
            'usuarioss' => $usuarioss,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUsuarioss $request
     * @param Usuarioss $usuarioss
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateUsuarioss $request, Usuarioss $usuarioss)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Usuarioss
        $usuarioss->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/usuariosses'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/usuariosses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyUsuarioss $request
     * @param Usuarioss $usuarioss
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyUsuarioss $request, Usuarioss $usuarioss)
    {
        $usuarioss->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyUsuarioss $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyUsuarioss $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Usuarioss::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
