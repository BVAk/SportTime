<?php

use Illuminate\Database\Seeder;

class AbonnementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('abonnements')->insert([
            ['period'=>'3 місяці','name' => 'Стандартна', 'description' => 'Час відвідування - з 9:00 до 22:00. Що включає карта - групові тренування. Термін дії - 3 місяці', 'price' => '1400.00'],
            ['period'=>'1 місяць','name' => 'Стандартна', 'description' => 'Час відвідування - з 9:00 до 22:00. Що включає карта - групові тренування. Термін дії - 1 місяць', 'price' => '500.00'],
            ['period'=>'1 день','name' => 'Стандартна', 'description' => 'Час відвідування - з 9:00 до 22:00. Що включає карта - групові тренування. Термін дії - 1 день', 'price' => '100.00'],
            ['period'=>'3 місяці','name' => 'Активне тренування', 'description' => 'Час відвідування - з 9:00 до 22:00. Що включає карта - тренажерний зал, групові тренування. Термін дії - 3 місяці', 'price' => '1710.00'],
            ['period'=>'1 місяці','name' => 'Активне тренування', 'description' => 'Час відвідування - з 9:00 до 22:00. Що включає карта - тренажерний зал, групові тренування. Термін дії - 1 місяць', 'price' => '700.00'],
            ['period'=>'3 місяці','name' => 'Тренажерний зал', 'description' => 'Час відвідування - з 9:00 до 22:00, у вихідні з 9:00 до 21:00. Карта включає: тренажерний зал, вступний інструктаж. Термін дії - 3 місяці', 'price' => '1400.00'],
            ['period'=>'1 місяць','name' => 'Тренажерний зал', 'description' => 'Час відвідування - з 9:00 до 22:00, у вихідні з 9:00 до 21:00. Карта включає: тренажерний зал, вступний інструктаж. Термін дії - 1 місяць', 'price' => '500.00'],
            ['period'=>'1 день','name' => 'Тренажерний зал', 'description' => 'Час відвідування - з 9:00 до 22:00, у вихідні з 9:00 до 21:00. Карта включає: тренажерний зал, вступний інструктаж. Термін дії - 1 день', 'price' => '100.00'],
            ['period'=>'1 тренування','name' => 'Дитяча', 'description' => 'Дитячі напрямки - карате (6-10 років), танці (10-15 років), рукопашний бій (10-17 років)ю Термін дії - 1 заняття', 'price' => '75'],
            ['period'=>'1 місяць','name' => 'Дитяча', 'description' => 'Дитячі напрямки - карате (6-10 років), танці (10-15 років), рукопашний бій (10-17 років). Термін дії - 1 місяць', 'price' => '400'],
            ['period'=>'1 тренування','name' => 'Персональні тренування в тренажерному залі', 'description' => 'Термін дії - 1 тренування', 'price' => '150'],
            ['period'=>'6 тренувань','name' => 'Персональні тренування в тренажерному залі', 'description' => 'Термін дії - 6 тренувань', 'price' => '750'],
            ['period'=>'12 тренувань','name' => 'Персональні тренування в тренажерному залі', 'description' => 'Термін дії - 12 тренувань', 'price' => '1420'],
            ['period'=>'1 тренування','name' => 'Персональні тренування в тренажерному залі', 'description' => 'Спліт тренування на 2-х чоловік', 'price' => '250'],
            ['period'=>'1 тренування','name' => 'Персональні тренування в фітнес залі', 'description' => 'Термін дії - 1 тренування', 'price' => '150'],
            ['period'=>'6 тренувань','name' => 'Персональні тренування в фітнес залі', 'description' => 'Термін дії - 6 тренувань', 'price' => '750'],
            ['period'=>'1 тренування','name' => 'Персональні тренування в фітнес залі', 'description' => 'Спліт тренування на 2-х чоловік', 'price' => '250'],
             ]);
    
    }
}
