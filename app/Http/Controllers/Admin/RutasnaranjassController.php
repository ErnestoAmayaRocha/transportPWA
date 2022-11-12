<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Rutasnaranjass\BulkDestroyRutasnaranjass;
use App\Http\Requests\Admin\Rutasnaranjass\DestroyRutasnaranjass;
use App\Http\Requests\Admin\Rutasnaranjass\IndexRutasnaranjass;
use App\Http\Requests\Admin\Rutasnaranjass\StoreRutasnaranjass;
use App\Http\Requests\Admin\Rutasnaranjass\UpdateRutasnaranjass;
use App\Models\Rutasnaranjass;
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

class RutasnaranjassController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexRutasnaranjass $request
     * @return array|Factory|View
     */
    public function index(IndexRutasnaranjass $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Rutasnaranjass::class)->processRequestAndGet(
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

        return view('admin.rutasnaranjass.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.rutasnaranjass.create');

        return view('admin.rutasnaranjass.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRutasnaranjass $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreRutasnaranjass $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Rutasnaranjass
        $rutasnaranjass = Rutasnaranjass::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/rutasnaranjasses'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/rutasnaranjasses');
    }

    /**
     * Display the specified resource.
     *
     * @param Rutasnaranjass $rutasnaranjass
     * @throws AuthorizationException
     * @return void
     */
    public function show(Rutasnaranjass $rutasnaranjass)
    {
        $this->authorize('admin.rutasnaranjass.show', $rutasnaranjass);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Rutasnaranjass $rutasnaranjass
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Rutasnaranjass $rutasnaranjass)
    {
        $this->authorize('admin.rutasnaranjass.edit', $rutasnaranjass);


        return view('admin.rutasnaranjass.edit', [
            'rutasnaranjass' => $rutasnaranjass,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRutasnaranjass $request
     * @param Rutasnaranjass $rutasnaranjass
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateRutasnaranjass $request, Rutasnaranjass $rutasnaranjass)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Rutasnaranjass
        $rutasnaranjass->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/rutasnaranjasses'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/rutasnaranjasses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRutasnaranjass $request
     * @param Rutasnaranjass $rutasnaranjass
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyRutasnaranjass $request, Rutasnaranjass $rutasnaranjass)
    {
        $rutasnaranjass->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyRutasnaranjass $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyRutasnaranjass $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Rutasnaranjass::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
