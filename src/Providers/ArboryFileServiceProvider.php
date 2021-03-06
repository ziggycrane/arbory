<?php


namespace Arbory\Base\Providers;

use Arbory\Base\Files\ArboryFile;
use Arbory\Base\Repositories\ArboryFilesRepository;
use Illuminate\Support\ServiceProvider;

class ArboryFileServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton( 'arbory_files', function ()
        {
            return new ArboryFilesRepository( 'local', ArboryFile::class );
        } );
    }
}
