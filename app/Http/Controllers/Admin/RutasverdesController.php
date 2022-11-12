<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Rutasverde\BulkDestroyRutasverde;
use App\Http\Requests\Admin\Rutasverde\DestroyRutasverde;
use App\Http\Requests\Admin\Rutasverde\IndexRutasverde;
use App\Http\Requests\Admin\Rutasverde\StoreRutasverde;
use App\Http\Requests\Admin\Rutasverde\UpdateRutasverde;
use App\Models\Rutasverde;
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

class RutasverdesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexRutasverde $request
     * @return array|Factory|View
     */
    public function index(IndexRutasverde $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Rutasverde::class)->processRequestAndGet(
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

        return view('admin.rutasverde.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.rutasverde.create');

        return view('admin.rutasverde.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRutasverde $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreRutasverde $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Rutasverde
        $rutasverde = Rutasverde::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/rutasverdes'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/rutasverdes');
    }

    /**
     * Display the specified resource.
     *
     * @param Rutasverde $rutasverde
     * @throws AuthorizationException
     * @return void
     */
    public function show(Rutasverde $rutasverde)
    {
        $this->authorize('admin.rutasverde.show', $rutasverde);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Rutasverde $rutasverde
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Rutasverde $rutasverde)
    {
        $this->authorize('admin.rutasverde.edit', $rutasverde);


        return view('admin.rutasverde.edit', [
            'rutasverde' => $rutasverde,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRutasverde $request
     * @param Rutasverde $rutasverde
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateRutasverde $request, Rutasverde $rutasverde)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Rutasverde
        $rutasverde->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/rutasverdes'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/rutasverdes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRutasverde $request
     * @param Rutasverde $rutasverde
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyRutasverde $request, Rutasverde $rutasverde)
    {
        $rutasverde->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyRutasverde $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyRutasverde $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Rutasverde::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
