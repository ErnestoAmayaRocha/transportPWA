<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Rutasamarilla\BulkDestroyRutasamarilla;
use App\Http\Requests\Admin\Rutasamarilla\DestroyRutasamarilla;
use App\Http\Requests\Admin\Rutasamarilla\IndexRutasamarilla;
use App\Http\Requests\Admin\Rutasamarilla\StoreRutasamarilla;
use App\Http\Requests\Admin\Rutasamarilla\UpdateRutasamarilla;
use App\Models\Rutasamarilla;
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

class RutasamarillasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexRutasamarilla $request
     * @return array|Factory|View
     */
    public function index(IndexRutasamarilla $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Rutasamarilla::class)->processRequestAndGet(
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

        return view('admin.rutasamarilla.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.rutasamarilla.create');

        return view('admin.rutasamarilla.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRutasamarilla $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreRutasamarilla $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Rutasamarilla
        $rutasamarilla = Rutasamarilla::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/rutasamarillas'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/rutasamarillas');
    }

    /**
     * Display the specified resource.
     *
     * @param Rutasamarilla $rutasamarilla
     * @throws AuthorizationException
     * @return void
     */
    public function show(Rutasamarilla $rutasamarilla)
    {
        $this->authorize('admin.rutasamarilla.show', $rutasamarilla);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Rutasamarilla $rutasamarilla
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Rutasamarilla $rutasamarilla)
    {
        $this->authorize('admin.rutasamarilla.edit', $rutasamarilla);


        return view('admin.rutasamarilla.edit', [
            'rutasamarilla' => $rutasamarilla,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRutasamarilla $request
     * @param Rutasamarilla $rutasamarilla
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateRutasamarilla $request, Rutasamarilla $rutasamarilla)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Rutasamarilla
        $rutasamarilla->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/rutasamarillas'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/rutasamarillas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRutasamarilla $request
     * @param Rutasamarilla $rutasamarilla
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyRutasamarilla $request, Rutasamarilla $rutasamarilla)
    {
        $rutasamarilla->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyRutasamarilla $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyRutasamarilla $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Rutasamarilla::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
