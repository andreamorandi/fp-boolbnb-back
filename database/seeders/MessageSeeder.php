<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages = [
            [
                "lead_first_name" => "Geeno",
                "lead_last_name" => "Veffo",
                "lead_email" => "genoveffo@mail.com",
                "text" => "Zona centrale discreta e ben servita, si propone in vendita appartamento di 60 mq con due stanze e servizi da ristrutturare. L’immobile posto al secondo piano senza ascensore, è composto da soggiorno ingresso con balcone, ampia camera con esposizione angolare e due balconi, cucinino, pavimentazione tipica d’epoca, riscaldamento autonomo. Terrazzo privato.",
                "apartment_id" => "41"
            ]
        ];

        foreach ($messages as $key => $message) {
            $newMessages[] = $message;
        }
        Message::insert($newMessages);
    }
}
