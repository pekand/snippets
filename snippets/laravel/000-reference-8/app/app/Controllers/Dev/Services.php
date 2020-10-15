<?php


namespace App\Controllers\Dev;

use Illuminate\Http\Request;
use App\Lib\Repositories\UserRepositoryContract;
use App\Lib\Repositories\UserRepository;
use App\Lib\Repositories\TicketRepository;
use App\Lib\Repositories\TaggedRepository;
use Illuminate\Contracts\Foundation\Application;
use Psr\Container\ContainerInterface;
use Illuminate\Support\Facades\Log;

class Services extends Controller
{
    private $primitiveValue = null;
    private $tickets = null;

    /**
     * Services constructor.
     *
     * @param $primitiveValue
     * @param TicketRepository $tickets
     * @param ContainerInterface $container
     */
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
     * @param Application $app
     * @param UserRepositoryContract $users1
     * @param TicketRepository $tickets
     * @param TaggedRepository $tagged
     *
     * @return array
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function main(Request $request, Application $app, UserRepositoryContract $users1, TicketRepository $tickets, TaggedRepository $tagged)
    {
        $users2 = $app->make('App\Lib\Repositories\UserRepository'); // get instance

        $users3 = resolve('App\Lib\Repositories\UserRepository'); // get instance

        $users4 = $app->makeWith('App\Lib\Repositories\UserRepository', ['param5']); // get instance

        try {
            $users5 = $this->container->get('App\Lib\Repositories\UserRepository'); // get instance
        } catch (\Psr\Container\NotFoundExceptionInterface $e) {
            Log::error("Error: Services: UserRepository: Exception". $e->getMessage());
        }

        $app->instance('App\Lib\Repositories\UserRepository', $users2); // override instance

        return [
            'users1'=>$users1->getUsers(),
            'users2'=>$users2->getUsers(),
            'users3'=>$users3->getUsers(),
            'users4'=>$users4->getUsers(),
            'users5'=>$users5->getUsers(),
            'tickets'=>$tickets->getTickets(),
            'tickets2'=>$this->tickets->getTickets(),
            'tagged'=>$tagged->dump(),
            'primitiveValue' =>$this->primitiveValue,
        ];
    }
}
