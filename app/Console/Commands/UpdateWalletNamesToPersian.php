<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Wallet;

class UpdateWalletNamesToPersian extends Command
{
    protected $signature = 'wallets:persian-names';
    protected $description = 'Update all wallet names to Persian names';

    public function handle()
    {
        $persianNames = [
            // Bank names
            'بانک تجارت',
            'بانک ملی',
            'بانک ملت',
            'بانک پارسیان',
            'بانک پاسارگاد',
            'بانک صادرات',
            'بانک اقتصاد نوین',
            'بانک کشاورزی',
            'بانک رفاه کارگران',
            'بانک توسعه تعاون',
            'بانک ایران زمین',
            'بانک دی',
            'بانک کارآفرین',
            'بانک سینا',
            'بانک شهر',
            'بانک قوامین',
            'بانک حکمت ایرانیان',
            'بانک سپه',
            'بانک صنعت و معدن',
            'بانک توسعه صادرات',
            'بانک آینده',
            'بانک گردشگری',
            'بانک خاورمیانه',
            'بانک انصار',

            // Account types
            'حساب جاری',
            'حساب چک ملی',
            'حساب چک تجارت',
            'حساب چک ملت',
            'حساب سپرده کوتاه‌مدت',
            'حساب سپرده بلندمدت',
            'حساب انتظار',
            'حساب اضطراری',
            'حساب خرج روزانه',
            'حساب مخارج شخصی',
            'حساب مخارج خانوادگی',
            'حساب پروژه',

            // Card types
            'کارت ملت',
            'کارت پاسارگاد',
            'کارت تجارت',
            'کارت ملی',
            'کارت پارسیان',
            'کارت صادرات',
            'کارت اقتصاد نوین',
            'کارت سینا',
            'کارت دی',
            'کارت شهر',
            'کارت کشاورزی',
            'کارت رفاه',

            // Savings and deposits
            'پس‌انداز پارسیان',
            'پس‌انداز ملت',
            'پس‌انداز تجارت',
            'پس‌انداز ملی',
            'صندوق پست',
            'صندوق امانات',
            'سپرده سرمایه‌گذاری',
            'سپرده قرض‌الحسنه',

            // Cash and wallet types
            'نقد خانه',
            'کیف پول',
            'پول نقد',
            'حقوق',
            'پاداش',
            'اضافه کاری',
            'فروش',
            'درآمد جانبی',
            'کمیسیون',
            'سود سپرده',

            // Business related
            'حساب کسب و کار',
            'حساب شرکت',
            'حساب تجاری',
            'صندوق فروشگاه',
            'حساب پروژه',
            'سرمایه گردان',
            'وجه نقد کسب و کار',

            // Investment related
            'طلا و جواهر',
            'سکه',
            'ارز',
            'دلار',
            'یورو',
            'بورس',
            'صندوق سرمایه‌گذاری',
            'سهام',
            'اوراق مشارکت',

            // Special purposes
            'مخارج سفر',
            'مخارج تحصیل',
            'مخارج درمان',
            'مخارج خودرو',
            'مخارج خانه',
            'مخارج عروسی',
            'هدیه و کمک',
            'صدقه و خیرات',
            'تعمیرات',
            'خرید لوازم',
            'قبوض و شارژ',
            'بیمه',
            'مالیات',
            'وام و اقساط',
            'اجاره',

            // Digital wallets
            'کیف پول دیجیتال',
            'اپلیکیشن بانکی',
            'پرداخت آنلاین',
            'اسنپ پی',
            'زرین پال',
            'پی پال',
            'ولت شارژ',

            // Miscellaneous
            'پول توجیبی',
            'مخارج ورزش',
            'سرگرمی و تفریح',
            'کتاب و مطالعه',
            'لباس و پوشاک',
            'آرایشی بهداشتی',
            'مواد غذایی',
            'رستوران و بیرون',
            'حمل و نقل',
            'سوخت خودرو',
            'تعمیر خودرو',
            'موبایل و اینترنت',
            'برق و گاز و آب',
            'ضروری خانه',
            'فرش و مبلمان',
            'لوازم برقی',
            'باغ و گل',
            'حیوان خانگی'
        ];

        $wallets = Wallet::all();

        if ($wallets->isEmpty()) {
            $this->info('No wallets found.');
            return;
        }

        $this->info("Found {$wallets->count()} wallets. Updating names...");

        $progressBar = $this->output->createProgressBar($wallets->count());
        $progressBar->start();

        foreach ($wallets as $index => $wallet) {
            $randomName = $persianNames[array_rand($persianNames)];

            $wallet->update(['name' => $randomName]);

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine();
        $this->info('All wallet names updated to Persian successfully!');
    }
}
