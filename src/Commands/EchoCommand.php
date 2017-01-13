<?php

/*
 * Sometime too hot the eye of heaven shines
 */

namespace EchoServer\Commands;

use EchoServer\Server;
use Illuminate\Console\Command;

class EchoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'echo {action : start | stop | reload | quit}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start echo';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $action = $this->argument('action');

        switch ($action) {

            case 'start':
                $this->start();
                break;
        }
    }


    public function start()
    {
        $serv = new Server();
    }
}