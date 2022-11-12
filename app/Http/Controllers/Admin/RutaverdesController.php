<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Rutaverde\BulkDestroyRutaverde;
use App\Http\Requests\Admin\Rutaverde\DestroyRutaverde;
use App\Http\Requests\Admin\Rutaverde\IndexRutaverde;
use App\Http\Requests\Admin\Rutaverde\StoreRutaverde;
use App\Http\Requests\Admin\Rutaverde\UpdateRutaverde;
use App\Models\Rutaverde;
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

class RutaverdesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexRutaverde $request
     * @return array|Factory|View
     */
    public function index(IndexRutaverde $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Rutaverde::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'nombre_ruta', 'costo'],

            // set columns to searchIn
            ['id', 'nombre_ruta']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.rutaverde.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.rutaverde.create');

        return view('admin.rutaverde.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRutaverde $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreRutaverde $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Rutaverde
        $rutaverde = Rutaverde::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/rutaverdes'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/rutaverdes');
    }

    /**
     * Display the specified resource.
     *
     * @param Rutaverde $rutaverde
     * @throws AuthorizationException
     * @return void
     */
    public function show(Rutaverde $rutaverde)
    {
        $this->authorize('admin.rutaverde.show', $rutaverde);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Rutaverde $rutaverde
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Rutaverde $rutaverde)
    {
        $this->authorize('admin.rutaverde.edit', $rutaverde);


        return view('admin.rutaverde.edit', [
            'rutaverde' => $rutaverde,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRutaverde $request
     * @param Rutaverde $rutaverde
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateRutaverde $request, Rutaverde $rutaverde)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Rutaverde
        $rutaverde->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/rutaverdes'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/rutaverdes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRutaverde $request
     * @param Rutaverde $rutaverde
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyRutaverde $request, Rutaverde $rutaverde)
    {
        $rutaverde->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyRutaverde $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyRutaverde $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Rutaverde::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
