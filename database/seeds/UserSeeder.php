<?php

use Illuminate\Database\Seeder;
use App\Services\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::make('admin', 'Example Admin', 'admin@mail.com', 'password', []);
        User::make('asesi', 'Example Asesi', 'asesi@mail.com', 'password', []);
        User::make('asesor', 'Example Asesor', 'asesor@mail.com', 'password', []);
        User::make('superadmin', 'Example Superadmin', 'superadmin@mail.com', 'password', []);
        $this->asesor();
    }

    private function asesor()
    {
        $asesors = $this->getAsesor();
        foreach ($asesors as $asesor) {
            User::make('asesor', $asesor['nama'], $asesor['username'].'@mail.com', bcrypt($asesor['password']), []);
        }
    }

    private function getAsesor()
    {
        return [
            [
                "nama" => "DWI FENDI DADANG A, S.Pd, MT.",
                "username" => "6l2hmygyhj6", 
                "password" => "1fb0jwv5bnh"
            ],
            [
                "nama" => "BUDI HARTONO, S. Kom.",
                "username" => "zwggn29o59", 
                "password" => "n3o2cdd8txp"
            ],
            [
                "nama" => "CHOIRUL ANWAR, S.Pd.",
                "username" => "zho92zcrai8", 
                "password" => "x40kdmussj"
            ],
            [
                "nama" => "HADI SUYONO, ST.",
                "username" => "k15snmcztyg", 
                "password" => "ky6p306w1n"
            ],
            [
                "nama" => "KHOIRUL IKHSAN FAKEH, S.ST.",
                "username" => "tqtmns8h28", 
                "password" => "kub0qini2x"
            ],
            [
                "nama" => "ARYA WIRA YUDHA, S.Kom.",
                "username" => "lp8faudqdt", 
                "password" => "yb2v3xlt4hj"
            ],
            [
                "nama" => "ASMIATI, S.Pd.",
                "username" => "jrmh68qts4t", 
                "password" => "hz4d7ogd5d4"
            ],
            [
                "nama" => "RENDY  ARYTIA RP, S.Pd.",
                "username" => "96k8qam4yvt", 
                "password" => "otkd1upkrg"
            ],
            [
                "nama" => "ALI HAMZAH, S.Kom.",
                "username" => "2vxp3bfkrpr", 
                "password" => "nyj255vcyjs"
            ],
            [
                "nama" => "ALI BASYAH, ST, M.Pd.",
                "username" => "n1tb24jmgto", 
                "password" => "ng82l7kq8t9"
            ],
            [
                "nama" => "M. KHOIRON, S.Kom.",
                "username" => "u0kdf9mo9l", 
                "password" => "x2ypxs6aeg"
            ],
            [
                "nama" => "LUSIANA INDRAWATI, S.Kom.",
                "username" => "f0om3zzoweb", 
                "password" => "n34jod3kwe"
            ],
            [
                "nama" => "VERA KUSUMANINGRUNM, S. Kom.",
                "username" => "5g0b5tyz8a", 
                "password" => "sns2admalp"
            ],
            [
                "nama" => "HASAN ISMAIL, S. Kom.",
                "username" => "xccn0u7lpe", 
                "password" => "q6536o7h1o"
            ],
        ];
    }
}
