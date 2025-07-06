<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Requests\swagger\pet\Index;
use App\Http\Requests\swagger\pet\Store as StoreRequest;
use App\Http\Requests\swagger\pet\Update as UpdateRequest;
use App\Services\Swagger\Api\Pet\PetInterface;
use Illuminate\Contracts\View\View;

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
    const VALID_INPUT_UPDATE_POST = [
        'name',
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
    public function edit(int $id)
    {
        return view("view.pet.updatePut",
            $this->pet->findById($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        $data = $this->pet
            ->updatePut($request->only(self::VALID_INPUT_STORE));

        if ($data['statusCode'] === 200) {
            $data['update'] = true;
        }//TODO tutaj poprawić bo nie wyswietlająsięw szablonie komunikaty

        return redirect(route("pet.edit", [
            "pet" => $id
        ]))
            ->with($data);
    }

    public function updatePost(UpdateRequest $request, int $id) {
        $data = $this->pet
            ->updatePost($id, $request->only(self::VALID_INPUT_UPDATE_POST));

        if ($data['statusCode'] === 200) {
            $data['update'] = true;
            $data['data']['id'] = $id;
            return view("view.pet.updatePost", $data);
        }
        return back()
            ->with($data);
    }
    public function updateViewPost(int $id) {

        return view("view.pet.updatePost",
            $this->pet->findById($id)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
