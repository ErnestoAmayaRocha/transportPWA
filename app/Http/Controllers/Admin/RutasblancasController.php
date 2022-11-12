<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Rutasblanca\BulkDestroyRutasblanca;
use App\Http\Requests\Admin\Rutasblanca\DestroyRutasblanca;
use App\Http\Requests\Admin\Rutasblanca\IndexRutasblanca;
use App\Http\Requests\Admin\Rutasblanca\StoreRutasblanca;
use App\Http\Requests\Admin\Rutasblanca\UpdateRutasblanca;
use App\Models\Rutasblanca;
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

class RutasblancasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexRutasblanca $request
     * @return array|Factory|View
     */
    public function index(IndexRutasblanca $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Rutasblanca::class)->processRequestAndGet(
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

        return view('admin.rutasblanca.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.rutasblanca.create');

        return view('admin.rutasblanca.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRutasblanca $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreRutasblanca $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Rutasblanca
        $rutasblanca = Rutasblanca::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/rutasblancas'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/rutasblancas');
    }

    /**
     * Display the specified resource.
     *
     * @param Rutasblanca $rutasblanca
     * @throws AuthorizationException
     * @return void
     */
    public function show(Rutasblanca $rutasblanca)
    {
        $this->authorize('admin.rutasblanca.show', $rutasblanca);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Rutasblanca $rutasblanca
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Rutasblanca $rutasblanca)
    {
        $this->authorize('admin.rutasblanca.edit', $rutasblanca);


        return view('admin.rutasblanca.edit', [
            'rutasblanca' => $rutasblanca,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRutasblanca $request
     * @param Rutasblanca $rutasblanca
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateRutasblanca $request, Rutasblanca $rutasblanca)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Rutasblanca
        $rutasblanca->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/rutasblancas'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/rutasblancas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRutasblanca $request
     * @param Rutasblanca $rutasblanca
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyRutasblanca $request, Rutasblanca $rutasblanca)
    {
        $rutasblanca->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyRutasblanca $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyRutasblanca $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Rutasblanca::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
