<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Requests\swagger\pet\Index;
use App\Http\Requests\swagger\pet\Store as StoreRequest;
use App\Services\Swagger\Api\Pet\PetInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetController extends Controller
{
    const VALID_INPUT_STORE = [
        'id',
        'category.name',
        'category.id',
        'name',
        'photoUrls',
        'tags',
        'status',
    ];

    public function __construct(
        private PetInterface $pet
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Index $request) : view
    {
        $status = $request->input("status", config("swagger.pet.findByStatus.defaultStatus"));
        $data = $this->pet->findByStatus($status);

        return view("view.pet.index", [
            'data' => $data['data'],
            "statusCode" => $data['statusCode'],
            "status" => $status
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("view.pet.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $this->pet->create($request->only(self::VALID_INPUT_STORE));

        if ($data['statusCode'] === 200) {
            $data['create'] = true;
            return view("view.pet.view", $data);
        }

        return back()
            ->with($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {

        return view("view.pet.view",
            $this->pet->findById($id)
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
