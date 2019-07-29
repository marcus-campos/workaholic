<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') != 'production') {
            $adminPassword = bcrypt('2019@987987@');
            $password = bcrypt('2019!987987!');

            DB::insert("INSERT INTO users (id, name, email, password, photo, biography, cpf, cnpj, phone, score, role, remember_token, deleted_at, created_at, updated_at) VALUES ('" . Str::orderedUuid() . "', 'Freelancer', 'freelancer@workanywhere.com', '" . $password . "', null, null, '11947469690', null, '(31) 99407-6639', 0, 'freelancer', 'EE3oH0Gz2m31tBvMF5Bcgrr3lJMvI29lc5neUbzs15ZGNwtHhk8a6BuKdZxY', null, '2018-03-22 21:05:10', '2018-03-22 21:05:10');");
            DB::insert("INSERT INTO users (id, name, email, password, photo, biography, cpf, cnpj, phone, score, role, remember_token, deleted_at, created_at, updated_at) VALUES ('" . Str::orderedUuid() . "', 'Company', 'company@workanywhere.com', '" . $password . "', null, null, '11947469690', null, '31 993195689', 0, 'company', 'wMjcYpppczt7m4EV2Xy5iIY0qaZzeeWSTxNbilXIlOehgYuGSxsYr3cInAZW', null, '2018-03-28 22:14:56', '2018-03-28 22:14:56');");
            DB::insert("INSERT INTO users (id, name, email, password, photo, biography, cpf, cnpj, phone, score, role, remember_token, deleted_at, created_at, updated_at) VALUES ('" . Str::orderedUuid() . "', 'Admin', 'admin@workanywhere.com', '" . $adminPassword . "', null, null, '11947469690', null, '31 993195689', 0, 'admin', 'wMjcYpppczt7m4EV2Xy5iIY0qaZzeeWSTxNbilXIlOehgYuGSxsYr3cInAZW', null, '2018-03-28 22:14:56', '2018-03-28 22:14:56');");
            DB::insert("INSERT INTO users (id, name, email, password, photo, biography, cpf, cnpj, phone, score, role, remember_token, deleted_at, created_at, updated_at) VALUES ('" . Str::orderedUuid() . "', 'User', 'user@workanywhere.com', '" . $password . "', null, null, '11947469690', null, '31 993195689', 0, 'user', 'wMjcYpppczt7m4EV2Xy5iIY0qaZzeeWSTxNbilXIlOehgYuGSxsYr3cInAZW', null, '2018-03-28 22:14:56', '2018-03-28 22:14:56');");
        }
    }
}
