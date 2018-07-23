@servers(['prod' => ['root@friendlyprobes.net']])

@setup
function message($message) {
return "echo '\033[32m" .$message. "\033[0m';\n";
}

$directory = '/var/www/auth.friendlyprobes.net';
@endsetup

@task('git')
    cd {{$directory}}

    {{ message("🌀  Updating Code from Git...") }}
    git reset --hard HEAD
    git fetch
    git pull origin master
@endtask

@task('composer')
    cd {{$directory}}

    {{ message("🚚  Running Composer...") }}
    composer install --prefer-dist --no-scripts --no-dev -q -o;
@endtask

@task('migrate', ['confirm' => true])
    cd {{$directory}}

    {{ message("📀  Backing up database...") }}
    php artisan backup:run --only-db --disable-notifications

    {{ message("🙈  Migrating database...") }}
    php artisan migrate --force
@endtask

@task('yarn', ['confirm' => true])
    cd {{$directory}}

    {{ message("🌅  Generating assets...") }}
    yarn config set ignore-engines true
    yarn --frozen-lockfile
    yarn run production --progress false
@endtask

@task('optimize')
    cd {{$directory}}

    {{ message("🙏  Optimizing...") }}
    bash version.sh
    php artisan clear-compiled;
    php artisan horizon:terminate
    php artisan config:clear
    php artisan cache:clear
    php artisan config:cache
    php artisan view:cache

    sudo service php7.1-fpm restart
    sudo supervisorctl restart asgard
@endtask

@task('start')
    {{ message("🏃  Starting deployment...") }}

    cd {{$directory}}
    php artisan down
    composer dump-autoload
@endtask

@task('done')
    chown -R www-data:www-data {{$directory}}
    cd {{$directory}}
    php artisan up

    {{ message("🚀  Application deployed!") }}
@endtask

@story('deploy')
    start
    git
    composer
    yarn
    migrate
    optimize
    done
@endstory

