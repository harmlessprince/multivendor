<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Str;

class MakeInterfaceCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:interface';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Repository Interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Interface Repository';


    public function handle()
    {
        if (parent::handle() === false && !$this->option('force')) {
            return false;
        }

        if ($this->option('repository')) {
            $this->createRepository();
        }
    }
    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $className = $name . 'RepositoryInterface';
        $stub = parent::replaceClass($stub, $className);
        return $stub;
        // return str_replace(['dummy:command', '{{ class }}'], $this->option('name'), $stub);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $relativePath = '/stubs/interface.stub';
        return app_path() . '/Console/Commands' . $relativePath;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return 'App\Repositories\Contracts';
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        $name = $name . 'RepositoryInterface';

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . '.php';
    }
    /**
     * Create a repository file for the interface.
     *
     * @return void
     */
    protected function createRepository()
    {
        $className = Str::studly(class_basename($this->argument('name')));

        $this->call('make:repository', [
            'name' => "{$className}Repository",
        ]);
    }
    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the RepoInterface'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['repository', 'r', InputOption::VALUE_NONE, 'Create a new repository for the interface'],
        ];
    }
}
