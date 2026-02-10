<?php

namespace Modules\Academique\Repositories;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Academique\Models\Cycle;
use Modules\Academique\Transformers\CycleRessource;

class CycleRepository
{
    /**
     * Liste des cycles sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $cycles = Cycle::all();
        return CycleRessource::collection($cycles);
    }

    /**
     * Création d'un cycle
     *
     * @param [type] $data
     * @return false|Cycle
     */
    public function store($data): false|Cycle
    {
        $cycle = new Cycle;
        $cycle->fill($data);
        if($cycle->save()){
            return $cycle;
        }
        return false;
    }

    /**
     * Récupérer tous les cycles
     *
     * @return AnonymousResourceCollection
     */
    public function paginate(): AnonymousResourceCollection
    {
        $cycles = Cycle::orderBy('id', 'desc')->paginate(10);
        return CycleRessource::collection($cycles);
    }

    /**
     * Rechercher un cycle par son libelle, ordre, session
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword): AnonymousResourceCollection
    {
        $cycles = Cycle::with('session', 'classe')->where(function ($query) use ($keyword) {
                $query->where('libelle', 'like', "%{$keyword}%")
                    ->orWhere('ordre', 'like', "%{$keyword}%");
                })->paginate(10);
        return CycleRessource::collection($cycles);
    }


    /**
     * Récupérer un cycle par son ID
     *
     * @param [type] $id
     * @return CycleRessource
     */
    public function show($id): CycleRessource
    {
        $cycle = Cycle::where('id', $id)->with(['session', 'classe'])->first();
        return CycleRessource::make($cycle);
    }


    /**
     * Mettre à jour un cycle
     *
     * @param [type] $id
     * @param [type] $data
     * @return false
     */
    public function update($id, $data)
    {
        $cycle = Cycle::find($id);
        $cycle->fill($data);
        if($cycle->save()){
            return $cycle;
        }
        return false;
    }

    /**
     * Supprimer d'un cycle
     *
     * @param [type] $id
     * @return true
     */
    public function delete($id): bool
    {
        $cycle = Cycle::find($id);
        if($cycle->delete()){
            return true;
        }
        return false;
    }
}
