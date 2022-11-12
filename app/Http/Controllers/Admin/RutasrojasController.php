<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Rutasroja\BulkDestroyRutasroja;
use App\Http\Requests\Admin\Rutasroja\DestroyRutasroja;
use App\Http\Requests\Admin\Rutasroja\IndexRutasroja;
use App\Http\Requests\Admin\Rutasroja\StoreRutasroja;
use App\Http\Requests\Admin\Rutasroja\UpdateRutasroja;
use App\Models\Rutasroja;
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

class RutasrojasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexRutasroja $request
     * @return array|Factory|View
     */
    public function index(IndexRutasroja $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Rutasroja::class)->processRequestAndGet(
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

        return view('admin.rutasroja.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.rutasroja.create');

        return view('admin.rutasroja.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRutasroja $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreRutasroja $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Rutasroja
        $rutasroja = Rutasroja::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/rutasrojas'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/rutasrojas');
    }

    /**
     * Display the specified resource.
     *
     * @param Rutasroja $rutasroja
     * @throws AuthorizationException
     * @return void
     */
    public function show(Rutasroja $rutasroja)
    {
        $this->authorize('admin.rutasroja.show', $rutasroja);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Rutasroja $rutasroja
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Rutasroja $rutasroja)
    {
        $this->authorize('admin.rutasroja.edit', $rutasroja);


        return view('admin.rutasroja.edit', [
            'rutasroja' => $rutasroja,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRutasroja $request
     * @param Rutasroja $rutasroja
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateRutasroja $request, Rutasroja $rutasroja)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Rutasroja
        $rutasroja->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/rutasrojas'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/rutasrojas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRutasroja $request
     * @param Rutasroja $rutasroja
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyRutasroja $request, Rutasroja $rutasroja)
    {
        $rutasroja->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyRutasroja $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyRutasroja $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Rutasroja::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
