<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Rutasazule\BulkDestroyRutasazule;
use App\Http\Requests\Admin\Rutasazule\DestroyRutasazule;
use App\Http\Requests\Admin\Rutasazule\IndexRutasazule;
use App\Http\Requests\Admin\Rutasazule\StoreRutasazule;
use App\Http\Requests\Admin\Rutasazule\UpdateRutasazule;
use App\Models\Rutasazule;
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

class RutasazulesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexRutasazule $request
     * @return array|Factory|View
     */
    public function index(IndexRutasazule $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Rutasazule::class)->processRequestAndGet(
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

        return view('admin.rutasazule.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.rutasazule.create');

        return view('admin.rutasazule.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRutasazule $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreRutasazule $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Rutasazule
        $rutasazule = Rutasazule::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/rutasazules'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/rutasazules');
    }

    /**
     * Display the specified resource.
     *
     * @param Rutasazule $rutasazule
     * @throws AuthorizationException
     * @return void
     */
    public function show(Rutasazule $rutasazule)
    {
        $this->authorize('admin.rutasazule.show', $rutasazule);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Rutasazule $rutasazule
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Rutasazule $rutasazule)
    {
        $this->authorize('admin.rutasazule.edit', $rutasazule);


        return view('admin.rutasazule.edit', [
            'rutasazule' => $rutasazule,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRutasazule $request
     * @param Rutasazule $rutasazule
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateRutasazule $request, Rutasazule $rutasazule)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Rutasazule
        $rutasazule->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/rutasazules'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/rutasazules');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRutasazule $request
     * @param Rutasazule $rutasazule
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyRutasazule $request, Rutasazule $rutasazule)
    {
        $rutasazule->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyRutasazule $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyRutasazule $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Rutasazule::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
