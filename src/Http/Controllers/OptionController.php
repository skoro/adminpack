<?php

namespace Skoro\AdminPack\Http\Controllers;

use Skoro\AdminPack\Http\Requests\OptionRequest;
use Skoro\AdminPack\Services\UpdateOptionsService;
use Illuminate\Http\Request;

/**
 * Manage option controller.
 */
class OptionController extends AdminController
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->middleware('can:manageOptions');
    }

    /**
     * Options page.
     *
     * The action accepts the 't' query parameter that sets
     * the active tab in the view. By default, the first tab
     * will be opened.
     */
    public function index(Request $request)
    {
        $request->validate([
            't' => 'nullable|int|min:1',
        ]);

        return view('admin::options.index', [
            'active' => $request->input('t', 1),
        ]);
    }

    /**
     * Updates the options from the specific group.
     *
     * @param OptionRequest        $request
     * @param UpdateOptionsService $updateOptions
     */
    public function update(OptionRequest $request, UpdateOptionsService $updateOptions)
    {
        $keys = $updateOptions->fromValues($request->getValues());
        if (count($keys) > 0) {
            toast(__('Options have been updated.'));
        }

        return redirect()->route('admin.options', [
            't' => $request->input('t'),
        ]);
    }
}
