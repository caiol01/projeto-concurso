<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use App\Repositories\VehicleRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class VehicleController extends Controller
{

    public $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * @return View
     */
    public function listVehicles(): View
    {
        $perPage = 6;
        $items = $this->vehicleRepository->paginate($perPage);

        return view('index', compact('items'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('form');
    }

    public function index(): View
    {
        $perPage = 10;
        $items = $this->vehicleRepository->paginate($perPage);

        return view('home', compact('items'));
    }

    public function store(VehicleRequest $request) {
        $data = $request->validated();

        if($request->file('image')){
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('assets/images'), $filename);
            $data['image'] = $filename;
        }

        $insert = $this->vehicleRepository->store($data);

        if(!$insert){
            return redirect()->back()->with('error', 'Erro ao cadastrar Veículo.');
        }

        return redirect()->route('home')->with('message', 'Veículo cadastrado com sucesso');
    }

    public function edit(int $id)
    {
        $item = $this->vehicleRepository->findById($id);

        return view('form', compact('item'));
    }

    public function update(VehicleRequest $request, int $id): RedirectResponse {
        $data = $request->validated();

        if($request->file('image')){
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('assets/images'), $filename);
            $data['image'] = $filename;
        }

        $insert = $this->vehicleRepository->update($id, $data);

        if(!$insert){
            return redirect()->back()->with('error', 'Erro ao atualizar Veículo.');
        }

        return redirect()->route('home')->with('message', 'Veículo atualizado com sucesso');
    }

    public function destroy(int $id): RedirectResponse {
        $delete = $this->vehicleRepository->delete($id);

        if(!$delete){
            return redirect()->back()->with('error', 'Erro ao excluir Veículo.');
        }

        return redirect()->route('home')->with('message', 'Veículo excluído com sucesso');
    }
}
