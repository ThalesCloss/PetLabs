<?php

namespace App\Providers;

use App\equipamentoLaboratorio;
use App\laboratorio;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('autoriza-lab-eq',function(User $user,equipamentoLaboratorio $eq){
           return $user->id==$eq->laboratorio_id;
        });
        //chamar com facede
                //
        //Gate::denies('nome-dado',objetos);
        //na view @can('nome',obj);
        //auth()->user->can('nome',obj);
    }

}
