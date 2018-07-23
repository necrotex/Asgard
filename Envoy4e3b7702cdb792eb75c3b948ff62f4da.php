<?php $message = isset($message) ? $message : null; ?>
<?php $__container->servers(['prod' => ['root@friendlyprobes.net']]); ?>

<?php
function log($message) {
return "echo '\033[32m" .$message. "\033[0m';\n";
}
?>

<?php $__container->startTask('git'); ?>
    <?php echo log("🌀  Updating Code from Git..."); ?>

    git reset --hard HEAD
    git pull origin master
<?php $__container->endTask(); ?>

<?php $__container->startTask('composer'); ?>
    <?php echo log("🚚  Running Composer..."); ?>

    composer install --prefer-dist --no-scripts --no-dev -q -o;
<?php $__container->endTask(); ?>

<?php $__container->startTask('migrate'); ?>
    <?php echo log("📀  Backing up database..."); ?>

    php artisan backup:run --only-db

    <?php echo log("🙈  Migrating database..."); ?>

    php artisan migrate --force
<?php $__container->endTask(); ?>

<?php $__container->startTask('yarn'); ?>
    <?php echo log("🌅  Generating assets..."); ?>

    yarn config set ignore-engines true
    yarn --frozen-lockfile
    yarn run production --progress false
<?php $__container->endTask(); ?>

<?php $__container->startTask('optimize'); ?>
    <?php echo log("🙏  Optimizing..."); ?>

    bash version.sh
    php artisan clear-compiled;
    php artisan horizon:terminate
    php artisan config:clear
    php artisan cache:clear
    php artisan config:cache
    php artisan view:cache

    sudo service php7.1-fpm restart
    sudo supervisorctl restart asgard

<?php $__container->endTask(); ?>


<?php $__container->startMacro('deploy'); ?>
    <?php echo log("🏃  Starting deployment..."); ?>


    git
    composer
    yarn
    migrate
    optimize

    <?php echo log("🚀  Application deployed!"); ?>

<?php $__container->endMacro(); ?>

