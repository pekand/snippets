<?php


namespace App\Http\Controllers\Dev;

use Illuminate\Http\Request;
use App\Lib\Repositories\UserRepositoryContract;
use App\Lib\Repositories\UserRepository;
use App\Lib\Repositories\TicketRepository;
use App\Lib\Repositories\TaggedRepository;
use Illuminate\Contracts\Foundation\Application;
use Psr\Container\ContainerInterface;

class Services extends Controller
{
    private $primitiveValue = null;
    private $tickets = null;

    public function __construct($primitiveValue, TicketRepository $tickets, ContainerInterface $container)
    {
        $this->primitiveValue = $primitiveValue;
        $this->tickets = $tickets;
        $this->container = $container; // PSR-11 container resolvable only my constructor
    }

    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function main(Request $request, Application $app, UserRepositoryContract $users1, TicketRepository $tickets, TaggedRepository $tagged)
    {
        $users2 = $app->make('App\Lib\Repositories\UserRepository'); // get instance

        $users3 = resolve('App\Lib\Repositories\UserRepository'); // get instance

        $users4 = $app->makeWith('App\Lib\Repositories\UserRepository', ['param5']); // get instance

        try {
            $users5 = $this->container->get('App\Lib\Repositories\UserRepository'); // get instance
        } catch (\Psr\Container\NotFoundExceptionInterface $e){
            echo $e->getMessage();
        }

        $app->instance('App\Lib\Repositories\UserRepository', $users2); // override instance

        return [
            'users1'=>$users1->dump(),
            'users2'=>$users2->dump(),
            'users3'=>$users3->dump(),
            'users4'=>$users4->dump(),
            'users5'=>$users5->dump(),
            'tickets'=>$tickets->dump(),
            'tickets2'=>$this->tickets->dump(),
            'tagged'=>$tagged->dump(),
            'primitiveValue' =>$this->primitiveValue,
        ];
    }
}
