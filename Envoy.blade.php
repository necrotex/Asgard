@servers(['prod' => ['root@friendlyprobes.net']])

@setup
function log($message) {
return "echo '\033[32m" .$message. "\033[0m';\n";
}
@endsetup

@task('git')
    {{ log("🌀  Updating Code from Git...") }}
    git reset --hard HEAD
    git pull origin master
@endtask

@task('composer')
    {{ log("🚚  Running Composer...") }}
    composer install --prefer-dist --no-scripts --no-dev -q -o;
@endtask

@task('migrate')
    {{ log("📀  Backing up database...") }}
    php artisan backup:run --only-db

    {{ log("🙈  Migrating database...") }}
    php artisan migrate --force
@endtask

@task('yarn')
    {{ log("🌅  Generating assets...") }}
    yarn config set ignore-engines true
    yarn --frozen-lockfile
    yarn run production --progress false
@endtask

@task('optimize')
    {{ log("🙏  Optimizing...") }}
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


@story('deploy')
    {{ log("🏃  Starting deployment...") }}

    git
    composer
    yarn
    migrate
    optimize

    {{ log("🚀  Application deployed!") }}
@endstory

