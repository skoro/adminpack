<?php

namespace Skoro\AdminPack\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Skoro\AdminPack\Repositories\OptionRepository;
use Skoro\AdminPack\Tests\TestCase;

class OptionEloquentRepositoryTest extends TestCase
{
    use RefreshDatabase;

    const TABLE = 'admin_options';

    protected function getRepo(): OptionRepository
    {
        return new OptionRepository();
    }

    /** @test */
    public function set_option()
    {
        $this->assertDatabaseMissing(self::TABLE, ['name' => 'test']);
        $this->getRepo()->set('test', 'value1');
        $this->assertDatabaseHas(self::TABLE, ['name' => 'test']);
    }

    /** @test */
    public function set_option_array()
    {
        $this->assertDatabaseMissing(self::TABLE, ['name' => 'test']);
        $value = [
            'field_a' => 101,
            'field_b' => 'string',
        ];
        $this->getRepo()->set('test', $value);
        $this->assertDatabaseHas(self::TABLE, ['name' => 'test']);
        $this->assertEquals($value, $this->getRepo()->get('test'));
    }

    /** @test */
    public function update_option()
    {
        $this->getRepo()->set('test', 1);
        $this->getRepo()->set('test', 2);
        $this->assertDatabaseMissing(self::TABLE, [
            'name' => 'test', 'value' => '1',
        ]);
        $this->assertDatabaseHas(self::TABLE, [
            'name' => 'test', 'value' => '2',
        ]);
    }

    /** @test */
    public function delete_option()
    {
        $this->getRepo()->set('test', 1);
        $this->assertDatabaseHas(self::TABLE, ['name' => 'test', 'value' => '1']);
        $this->getRepo()->delete('test');
        $this->assertDatabaseMissing(self::TABLE, ['name' => 'test']);
    }

    /** @test */
    public function get_all_names()
    {
        DB::table(self::TABLE)->delete(); // clean db is required without seeds.
        $this->getRepo()->set('test', 1);
        $this->getRepo()->set('abc', 2);
        $this->getRepo()->set('defg', 3);
        $all = $this->getRepo()->all();
        sort($all);
        $this->assertEquals(['abc', 'defg', 'test'], $all);
    }
}
