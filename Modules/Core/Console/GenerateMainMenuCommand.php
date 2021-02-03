<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateMainMenuCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:main-menu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate main menu and save to file on Storage.';

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
        \Storage::disk('public')->put('application_main_menu.json', json_encode(get_access_url(), JSON_PRETTY_PRINT));
        $this->info('Generate main menu completed.');
    }
}
