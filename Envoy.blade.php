@servers(['local' => 'localhost', 'prod' => 'user@kopeisk.info'])

@task('sync', ['on' => 'local'])
echo "Running file synchronization"
rsync -arv app user@kopeisk.info:~/web/kopeisk.info/laravel
rsync -arv config user@kopeisk.info:~/web/kopeisk.info/laravel
rsync -arv database user@kopeisk.info:~/web/kopeisk.info/laravel
rsync -arv public user@kopeisk.info:~/web/kopeisk.info/laravel
rsync -arv resources user@kopeisk.info:~/web/kopeisk.info/laravel
rsync -arv routes user@kopeisk.info:~/web/kopeisk.info/laravel
rsync -arv .env user@kopeisk.info:~/web/kopeisk.info/laravel
rsync -arv composer.json user@kopeisk.info:~/web/kopeisk.info/laravel
rsync -arv composer.lock user@kopeisk.info:~/web/kopeisk.info/laravel
rsync -arv package.json user@kopeisk.info:~/web/kopeisk.info/laravel
rsync -arv package-lock.json user@kopeisk.info:~/web/kopeisk.info/laravel
rsync -arv webpack.mix.js user@kopeisk.info:~/web/kopeisk.info/laravel
@endtask

@task('migrate', ['on' => 'prod'])
echo "Running migrations"
cd ~/web/kopeisk.info/laravel
php ./artisan migrate
php ./artisan db:seed
@endtask

@task('rollback', ['on' => 'prod'])
echo "Running rollback"
cd ~/web/kopeisk.info/laravel
php ./artisan migrate:rollback
@endtask

@task('npm', ['on' => 'prod'])
echo "NPM installing dependencies"
cd ~/web/kopeisk.info/laravel
npm i
@endtask

@task('composer', ['on' => 'prod'])
echo "Composer installing dependencies"
cd ~/web/kopeisk.info/laravel
composer install
@endtask

@task('replace', ['on' => 'prod'])
echo "Replace the old files"
cd ~/web/kopeisk.info/laravel/public
@endtask

@story('deploy')
sync
composer
migrate
replace
@endstory
