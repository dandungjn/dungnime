<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateZiggyCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ziggy:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate file ziggy.js on Module Core.';

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
        $this->call('ziggy:generate', [
            'path' => 'Modules/Core/Resources/js/ziggy.js'
        ]);
    }
}
