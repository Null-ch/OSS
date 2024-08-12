<?php

namespace App\Console\Commands;

use App\Models\CartProduct;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use App\Events\ProductRemovedFromCartEvent;

class CheckAndRemoveOldCartProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:old_сart_products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверить и удалить содержимое устаревших корзин';

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
     */
    public function handle()
    {
        $threshold = Carbon::now()->subDay();
        $this->info('Начинаю очистку содержимого устаревших корзин...');
        $bar = $this->output->createProgressBar(CartProduct::where('updated_at', '<', $threshold)->count());

        CartProduct::where('updated_at', '>', $threshold)->each(function ($cartProduct) use ($bar) {
            $cartProduct->delete();
            event(new ProductRemovedFromCartEvent($cartProduct->product_id, $cartProduct->quantity));
            $bar->advance();
        });

        $bar->finish();
        $this->info('Устаревшие корзины очищены');
    }
}
