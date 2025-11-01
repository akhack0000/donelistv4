<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Home Controller
 *
 * DonelistV4のホームページを表示
 */
class HomeController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->set('title', 'DonelistV4');
    }
}
