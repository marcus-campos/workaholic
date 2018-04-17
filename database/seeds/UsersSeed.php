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
        $password = bcrypt('987987');
        $adminPassword = bcrypt('0rk4h0l1c');

        DB::insert("INSERT INTO users (id, name, email, password, photo, biography, cpf, cnpj, address, number, complement, neighborhood, phone, cep, city_id, score, role, remember_token, deleted_at, created_at, updated_at) VALUES ('". Str::orderedUuid()."', 'Marcus Vinícius Campos', 'campos.v.marcus@gmail.com', '" . $password . "', null, null, '11947469690', null, 'Rua Idalina Damásia', null, null, 'Jardim da Cidade', '(31) 99407-6639', '32604280', null, 0, 'user', 'EE3oH0Gz2m31tBvMF5Bcgrr3lJMvI29lc5neUbzs15ZGNwtHhk8a6BuKdZxY', null, '2018-03-22 21:05:10', '2018-03-22 21:05:10');");
        DB::insert("INSERT INTO users (id, name, email, password, photo, biography, cpf, cnpj, address, number, complement, neighborhood, phone, cep, city_id, score, role, remember_token, deleted_at, created_at, updated_at) VALUES ('". Str::orderedUuid()."', 'Marcus Campos', 'marcus_vinicius_campos@hotmail.com', '" . $password . "', null, null, '11947469690', null, 'Rua Idalina Damásia', null, null, 'Jardim da Cidade', '31 993195689', '32604280', null, 0, 'user', 'wMjcYpppczt7m4EV2Xy5iIY0qaZzeeWSTxNbilXIlOehgYuGSxsYr3cInAZW', null, '2018-03-28 22:14:56', '2018-03-28 22:14:56');");
        DB::insert("INSERT INTO users (id, name, email, password, photo, biography, cpf, cnpj, address, number, complement, neighborhood, phone, cep, city_id, score, role, remember_token, deleted_at, created_at, updated_at) VALUES ('". Str::orderedUuid()."', 'Admin', 'admin@orkaholic.com.br', '" . $adminPassword . "', null, null, '11947469690', null, 'Rua Idalina Damásia', null, null, 'Jardim da Cidade', '31 993195689', '32604280', null, 0, 'admin', 'wMjcYpppczt7m4EV2Xy5iIY0qaZzeeWSTxNbilXIlOehgYuGSxsYr3cInAZW', null, '2018-03-28 22:14:56', '2018-03-28 22:14:56');");
    }
}
