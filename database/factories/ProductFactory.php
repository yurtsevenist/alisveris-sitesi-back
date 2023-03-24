<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $urunler=['Gömlek','Pantolon','T-Shirt','Kazak','Şort','Mayo','Süveter','Takım Elibise','Ceket'];
        $kategori=['Erkek Giyim','Kadın Giyim','Çocuk Giyim'];
        $beden=['S','M','L','XL'];
        return [
            'name' => $urunler[rand(0,8)],
            'category' => $kategori[rand(0,2)],
            'size'=>$beden[rand(0,3)] ,   
            'info'=>$this->faker->text(100),
            'price'=>$this->faker->randomFloat(2, 9, 100),
            'review'=>$this->faker->randomNumber(3),
            'point'=>$this->faker->numberBetween(0, 5),
            'number'=>$this->faker->numberBetween(0, 300),
        ];
    }
}
