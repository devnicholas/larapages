<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lc:files 
        {plural : Content name in plural} 
        {singular : Content name in singular} 
        {--noModel : Don`t create a Model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating a CRUD basic files structure';

    /**
     * Define structure fields
     */
    private $slug = '';
    private $slugSingular = '';
    private $capitalName = '';
    private $capitalNameSingular = '';

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
     * @return int
     */
    public function handle()
    {
        $this->slug = strtolower($this->argument('plural'));
        $this->slugSingular = strtolower($this->argument('singular'));
        $this->capitalName = ucfirst($this->argument('plural'));
        $this->capitalNameSingular = ucfirst($this->argument('singular'));

        $this->warn('Creating controller...');
        $controllerContent = file_get_contents(base_path('app/Static/Controller.static'));
        $controllerContent = $this->replaceContent($controllerContent);

        file_put_contents(
            base_path('app/Http/Controllers/Admin/'.$this->capitalNameSingular.'Controller.php'), 
            $controllerContent
        );
        $this->info('Controller created');

        $this->warn('Creating views...');

        if(!file_exists(base_path('resources/views/admin/' . $this->slugSingular)))
            mkdir(base_path('resources/views/admin/' . $this->slugSingular));
        
        $this->createView('index');
        $this->createView('create');
        $this->createView('show');
        $this->info('Views created!');

        $this->warn('Generating routes...');
        $routesContent = file_get_contents(base_path('app/Static/routes.static'));
        $routesContent = $this->replaceContent($routesContent);
        $this->info('Routes generated! Add in yours file:');
        $this->line($routesContent);

        if(!$this->option('noModel')){
            $this->call('make:model', [
                'name' => 'Models/DB/'.$this->capitalName, '-m' => true
            ]);
        }

        return 0;
    }

    private function createView(String $type)
    {
        $baseContent = file_get_contents(base_path('app/Static/views/' . $type . '.static'));
        $baseContent = $this->replaceContent($baseContent);
        
        file_put_contents(
            base_path('resources/views/admin/' . $this->slugSingular . '/' . $type . '.blade.php'),
            $baseContent
        );
    }

    private function replaceContent($content)
    {
        $content = str_replace('__slug__', $this->slug, $content);
        $content = str_replace('__slug_singular__', $this->slugSingular, $content);
        $content = str_replace('__capital_name__', $this->capitalName, $content);
        $content = str_replace('__capital_name_singular__', $this->capitalNameSingular, $content);

        return $content;
    }
}
