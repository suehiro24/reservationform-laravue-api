<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WebRouteTest extends TestCase
{
    /**
     * ルートへのアクセス
     *
     * @return void
     */
    public function testRequestRoot()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * ルート以外へのアクセス
     *
     * @return void
     */
    public function testRequestHoge()
    {
        $response = $this->get('/hoge');

        $response->assertStatus(200);
    }

    /**
     * ルート以外へのアクセス 階層を深くする
     *
     * @return void
     */
    public function testRequestHogeSlashHoge()
    {
        $response = $this->get('/hoge/hoge');

        $response->assertStatus(200);
    }

    /**
     * ブランクへのアクセス
     *
     * @return void
     */
    public function testRequestBlank()
    {
        $response = $this->get('');

        $response->assertStatus(200);
    }
}
