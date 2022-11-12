<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Rutasnaranja\BulkDestroyRutasnaranja;
use App\Http\Requests\Admin\Rutasnaranja\DestroyRutasnaranja;
use App\Http\Requests\Admin\Rutasnaranja\IndexRutasnaranja;
use App\Http\Requests\Admin\Rutasnaranja\StoreRutasnaranja;
use App\Http\Requests\Admin\Rutasnaranja\UpdateRutasnaranja;
use App\Models\Rutasnaranja;
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

class RutasnaranjasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexRutasnaranja $request
     * @return array|Factory|View
     */
    public function index(IndexRutasnaranja $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Rutasnaranja::class)->processRequestAndGet(
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

        return view('admin.rutasnaranja.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.rutasnaranja.create');

        return view('admin.rutasnaranja.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRutasnaranja $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreRutasnaranja $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Rutasnaranja
        $rutasnaranja = Rutasnaranja::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/rutasnaranjas'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/rutasnaranjas');
    }

    /**
     * Display the specified resource.
     *
     * @param Rutasnaranja $rutasnaranja
     * @throws AuthorizationException
     * @return void
     */
    public function show(Rutasnaranja $rutasnaranja)
    {
        $this->authorize('admin.rutasnaranja.show', $rutasnaranja);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Rutasnaranja $rutasnaranja
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Rutasnaranja $rutasnaranja)
    {
        $this->authorize('admin.rutasnaranja.edit', $rutasnaranja);


        return view('admin.rutasnaranja.edit', [
            'rutasnaranja' => $rutasnaranja,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRutasnaranja $request
     * @param Rutasnaranja $rutasnaranja
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateRutasnaranja $request, Rutasnaranja $rutasnaranja)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Rutasnaranja
        $rutasnaranja->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/rutasnaranjas'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/rutasnaranjas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRutasnaranja $request
     * @param Rutasnaranja $rutasnaranja
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyRutasnaranja $request, Rutasnaranja $rutasnaranja)
    {
        $rutasnaranja->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyRutasnaranja $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyRutasnaranja $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Rutasnaranja::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
