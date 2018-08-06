<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                Total ISK
            </div>
            <div class="card-body text-center">
                <?php
                    $total = 0;
                    $user->characters->each(function ($character) use (&$total) {
                        $total += optional($character->wallet->last())->amount;
                    });
                ?>
                {{ number_format($total, 2) }} ISK
            </div>
        </div>
    </div>
</div>

