<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Pluralizer;
use Illuminate\Filesystem\Filesystem;

class RepositoryBulider extends Command
{
    protected $files;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To make a repository';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FileSystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = $this->getSourceFilePath();

        $this->makeDirectory(dirname($path));

        $contents = $this->getSourceFile();

        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            $this->info("File : {$path} created");
        } else {
            $this->info("File : {$path} already exits");
        }
    }

    public function getStubPath()
    {
        return __DIR__ . '/../Command.stub';
    }

    public function getStubVariables()
    {
        return [
            'NAMESPACE'         => $this->getNamespace($this->argument('name')),
            'CLASS_NAME'        => $this->getSingularClassName($this->argument('name')),
        ];
    }

    public function getNameSpace($name)
    {
        $singluar = ucwords(Pluralizer::singular($name));
        $fileName = explode('/', $singluar)[0];
        return 'App\\Repositories\\' . $fileName;
    }

    public function getSingularClassName($name)
    {
        $singluar = ucwords(Pluralizer::singular($name));
        $fileName = last(explode('/', $singluar));
        return $fileName;
    }

    public function getSourceFile()
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }

    public function getStubContents($stub, $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('$' . $search . '$', $replace, $contents);
        }

        return $contents;
    }

    public function getSourceFilePath()
    {
        return base_path($this->getNamespace($this->argument('name'))) . '\\' . $this->getSingularClassName($this->argument('name')) . '.php';
    }

    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
